<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StoryGenerationService
{
    /**
     * Generate a story based on theme and style
     */
    public function generateStory(string $theme, string $style, array $additionalParams = []): string
    {
        $prompt = $this->buildPrompt($theme, $style, $additionalParams);
        
        // Get the selected AI agent (default to gpt-4)
        $agent = $additionalParams['text_agent'] ?? 'openai_gpt4';
        $agentConfig = config("services.ai_agents.text.{$agent}");
        $provider = $agentConfig['provider'] ?? 'openai';

        $systemPrompt = 'You are a creative children\'s story writer. Create engaging, educational, and age-appropriate stories that captivate young readers.';

        return match ($provider) {
            'openai' => $this->generateWithOpenAI($systemPrompt, $prompt, $agentConfig['model'] ?? 'gpt-4'),
            'gemini' => $this->generateWithGemini($systemPrompt, $prompt, $agentConfig['model'] ?? 'gemini-pro'),
            default => $this->generateWithOpenAI($systemPrompt, $prompt, 'gpt-4'),
        };
    }

    /**
     * Generate text with OpenAI
     */
    protected function generateWithOpenAI(string $systemPrompt, string $userPrompt, string $model): string
    {
        $response = OpenAI::chat()->create([
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userPrompt]
            ],
            'temperature' => 0.8,
            'max_tokens' => 2000,
        ]);

        return $response->choices[0]->message->content;
    }

    /**
     * Generate text with Google Gemini
     */
    protected function generateWithGemini(string $systemPrompt, string $userPrompt, string $model): string
    {
        $apiKey = config('services.gemini.api_key');
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $systemPrompt . "\n\n" . $userPrompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.8,
                'maxOutputTokens' => 2000,
            ],
        ]);

        if (!$response->successful()) {
            Log::error('Gemini text generation failed: ' . $response->body());
            throw new \Exception('Failed to generate text with Gemini: ' . $response->body());
        }

        $data = $response->json();
        
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        }

        throw new \Exception('No text data received from Gemini');
    }

    /**
     * Build the prompt for story generation
     */
    protected function buildPrompt(string $theme, string $style, array $additionalParams): string
    {
        $prompt = "Create a children's story with the following specifications:\n\n";
        $prompt .= "Theme: {$theme}\n";
        $prompt .= "Style: {$style}\n";

        if (isset($additionalParams['child_name'])) {
            $prompt .= "Main Character Name: {$additionalParams['child_name']}\n";
        }

        if (isset($additionalParams['age'])) {
            $prompt .= "Target Age: {$additionalParams['age']} years old\n";
        }

        if (isset($additionalParams['interests'])) {
            $prompt .= "Include elements about: {$additionalParams['interests']}\n";
        }

        if (isset($additionalParams['lesson'])) {
            $prompt .= "Educational Value: {$additionalParams['lesson']}\n";
        }

        $prompt .= "\nPlease write a complete, engaging story that is suitable for children. ";
        $prompt .= "Make it imaginative, fun, and include educational values. ";
        $prompt .= "Structure the story with a clear beginning, middle, and end.";

        return $prompt;
    }

    /**
     * Generate scene descriptions for image generation
     */
    public function generateSceneDescriptions(string $storyContent, int $numberOfScenes = 4, string $agent = 'openai_gpt4'): array
    {
        $prompt = "Given the following children's story, create {$numberOfScenes} distinct scene descriptions that would make good illustrations. ";
        $prompt .= "Each description should be detailed enough for AI image generation, focusing on visual elements, characters, setting, and mood.\n\n";
        $prompt .= "Story:\n{$storyContent}\n\n";
        $prompt .= "Return the scene descriptions as a numbered list (1-{$numberOfScenes}).";

        $systemPrompt = 'You are an expert at creating visual scene descriptions for children\'s book illustrations.';

        $agentConfig = config("services.ai_agents.text.{$agent}");
        $provider = $agentConfig['provider'] ?? 'openai';

        $content = match ($provider) {
            'openai' => $this->generateWithOpenAI($systemPrompt, $prompt, $agentConfig['model'] ?? 'gpt-4'),
            'gemini' => $this->generateWithGemini($systemPrompt, $prompt, $agentConfig['model'] ?? 'gemini-pro'),
            default => $this->generateWithOpenAI($systemPrompt, $prompt, 'gpt-4'),
        };
        
        return $this->parseSceneDescriptions($content);
    }

    /**
     * Parse scene descriptions from the response
     */
    protected function parseSceneDescriptions(string $content): array
    {
        $lines = explode("\n", $content);
        $scenes = [];

        foreach ($lines as $line) {
            if (preg_match('/^\d+[\.\)]\s*(.+)$/i', trim($line), $matches)) {
                $scenes[] = trim($matches[1]);
            }
        }

        return $scenes;
    }
}
