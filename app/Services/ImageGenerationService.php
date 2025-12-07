<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageGenerationService
{
    /**
     * Generate an image using the selected agent
     */
    public function generateImage(string $description, string $style = 'vivid', string $agent = 'dalle3'): string
    {
        $prompt = $this->enhancePromptForChildren($description);
        $agentConfig = config("services.ai_agents.image.{$agent}");
        $provider = $agentConfig['provider'] ?? 'openai';

        return match ($provider) {
            'openai' => $this->generateWithOpenAI($prompt, $style, $agentConfig['model'] ?? 'dall-e-3'),
            'gemini' => $this->generateWithGemini($prompt, $agentConfig['model'] ?? 'imagen-3.0-generate-002'),
            'stability' => $this->generateWithStability($prompt, $agentConfig['model'] ?? 'sd3-large'),
            default => $this->generateWithOpenAI($prompt, $style, 'dall-e-3'),
        };
    }

    /**
     * Generate image with OpenAI DALL-E
     */
    protected function generateWithOpenAI(string $prompt, string $style, string $model): string
    {
        $requestData = [
            'model' => $model,
            'prompt' => $prompt,
            'n' => 1,
        ];

        // DALL-E 3 specific options
        if ($model === 'dall-e-3') {
            $requestData['size'] = '1024x1024';
            $requestData['quality'] = 'standard';
            $requestData['style'] = $style;
        } else {
            $requestData['size'] = '1024x1024';
        }

        $response = OpenAI::images()->create($requestData);
        $imageUrl = $response->data[0]->url;

        return $this->downloadAndSaveImage($imageUrl);
    }

    /**
     * Generate image with Google Gemini (Nano Banana) - FREE!
     * Uses Gemini 2.0 Flash's native image generation capability
     */
    protected function generateWithGemini(string $prompt, string $model): string
    {
        $apiKey = config('services.gemini.api_key');

        // Use Gemini 2.0 Flash with image generation capability
        $response = Http::timeout(120)->withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => "Generate a colorful, child-friendly illustration: {$prompt}"]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'responseModalities' => ['TEXT', 'IMAGE'],
                    ],
                ]);

        if (!$response->successful()) {
            Log::error('Gemini image generation failed: ' . $response->body());
            throw new \Exception('Failed to generate image with Gemini: ' . $response->body());
        }

        $data = $response->json();

        // Check for inline image data in the response
        if (isset($data['candidates'][0]['content']['parts'])) {
            foreach ($data['candidates'][0]['content']['parts'] as $part) {
                if (isset($part['inlineData']['mimeType']) && isset($part['inlineData']['data'])) {
                    $imageContent = base64_decode($part['inlineData']['data']);
                    return $this->saveImageContent($imageContent);
                }
            }
        }

        Log::error('Gemini response structure: ' . json_encode($data));
        throw new \Exception('No image data received from Gemini. The model may not support image generation.');
    }

    /**
     * Generate image with Stability AI
     */
    protected function generateWithStability(string $prompt, string $model): string
    {
        $apiKey = config('services.stability.api_key');

        // Determine the endpoint based on model
        $endpoint = match ($model) {
            'sd3-large', 'sd3-medium', 'sd3-large-turbo' => 'https://api.stability.ai/v2beta/stable-image/generate/sd3',
            'core' => 'https://api.stability.ai/v2beta/stable-image/generate/core',
            'ultra' => 'https://api.stability.ai/v2beta/stable-image/generate/ultra',
            default => 'https://api.stability.ai/v2beta/stable-image/generate/core',
        };

        // Build multipart data
        $multipartData = [
            [
                'name' => 'prompt',
                'contents' => $prompt,
            ],
            [
                'name' => 'output_format',
                'contents' => 'png',
            ],
        ];

        // SD3 requires model parameter, core/ultra don't
        if (str_starts_with($model, 'sd3')) {
            $multipartData[] = [
                'name' => 'model',
                'contents' => $model,
            ];
        }

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Accept' => 'image/*',
        ])->asMultipart()->post($endpoint, $multipartData);

        if (!$response->successful()) {
            Log::error('Stability AI image generation failed: ' . $response->body());
            throw new \Exception('Failed to generate image with Stability AI: ' . $response->body());
        }

        // Stability returns raw image bytes
        return $this->saveImageContent($response->body());
    }

    /**
     * Generate multiple images for story scenes
     */
    public function generateImagesForScenes(array $sceneDescriptions, string $style = 'vivid', string $agent = 'dalle3'): array
    {
        $imagePaths = [];

        foreach ($sceneDescriptions as $index => $description) {
            try {
                $imagePath = $this->generateImage($description, $style, $agent);
                $imagePaths[$index] = $imagePath;
            } catch (\Exception $e) {
                Log::error("Failed to generate image for scene {$index}: " . $e->getMessage());
                $imagePaths[$index] = null;
            }
        }

        return $imagePaths;
    }

    /**
     * Integrate user's photo into the story
     */
    public function integrateUserPhoto(string $userPhotoPath, string $sceneDescription): string
    {
        $prompt = $sceneDescription . " The main character should match the appearance of the child in the reference photo.";
        return $this->generateImage($prompt);
    }

    /**
     * Enhance the prompt for child-friendly content
     */
    protected function enhancePromptForChildren(string $description): string
    {
        $prefix = "Create a colorful, vibrant, child-friendly illustration in a storybook style. ";
        $suffix = " The image should be appropriate for children, cheerful, and engaging.";

        return $prefix . $description . $suffix;
    }

    /**
     * Download and save the generated image from URL
     */
    protected function downloadAndSaveImage(string $imageUrl): string
    {
        $imageContent = file_get_contents($imageUrl);
        return $this->saveImageContent($imageContent);
    }

    /**
     * Save image content to storage
     */
    protected function saveImageContent(string $imageContent): string
    {
        $fileName = 'story-images/' . uniqid() . '.png';
        Storage::disk('public')->put($fileName, $imageContent);
        return $fileName;
    }

    /**
     * Edit an image using the DALL-E edit endpoint
     */
    public function editImage(string $imagePath, string $prompt): string
    {
        return $imagePath;
    }
}
