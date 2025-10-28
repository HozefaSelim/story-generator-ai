<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Storage;

class ImageGenerationService
{
    /**
     * Generate an image using DALL-E
     */
    public function generateImage(string $description, string $style = 'vivid'): string
    {
        $prompt = $this->enhancePromptForChildren($description);

        $response = OpenAI::images()->create([
            'model' => 'dall-e-3',
            'prompt' => $prompt,
            'size' => '1024x1024',
            'quality' => 'standard',
            'style' => $style, // 'vivid' or 'natural'
            'n' => 1,
        ]);

        $imageUrl = $response->data[0]->url;

        // Download and save the image
        return $this->downloadAndSaveImage($imageUrl);
    }

    /**
     * Generate multiple images for story scenes
     */
    public function generateImagesForScenes(array $sceneDescriptions, string $style = 'vivid'): array
    {
        $imagePaths = [];

        foreach ($sceneDescriptions as $index => $description) {
            try {
                $imagePath = $this->generateImage($description, $style);
                $imagePaths[$index] = $imagePath;
            } catch (\Exception $e) {
                // Log error and continue with other images
                \Log::error("Failed to generate image for scene {$index}: " . $e->getMessage());
                $imagePaths[$index] = null;
            }
        }

        return $imagePaths;
    }

    /**
     * Integrate user's photo into the story
     * This would require additional image manipulation
     */
    public function integrateUserPhoto(string $userPhotoPath, string $sceneDescription): string
    {
        // For this implementation, we'll enhance the prompt to describe the child
        // In a production environment, you might use additional APIs or image processing
        
        $prompt = $sceneDescription . " The main character should match the appearance of the child in the reference photo.";
        
        // In a real implementation, you might use OpenAI's image variation endpoint
        // or another service that can integrate the user's photo
        
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
     * Download and save the generated image
     */
    protected function downloadAndSaveImage(string $imageUrl): string
    {
        $imageContent = file_get_contents($imageUrl);
        $fileName = 'story-images/' . uniqid() . '.png';
        
        Storage::disk('public')->put($fileName, $imageContent);
        
        return $fileName;
    }

    /**
     * Edit an image using the DALL-E edit endpoint (if user wants to modify)
     */
    public function editImage(string $imagePath, string $prompt): string
    {
        // This would use OpenAI's image edit endpoint
        // Implementation would depend on specific requirements
        
        return $imagePath; // Placeholder
    }
}

