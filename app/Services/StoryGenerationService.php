<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class StoryGenerationService
{
    /**
     * Generate a story based on theme and style
     */
    public function generateStory(string $theme, string $style, array $additionalParams = []): string
    {
        $prompt = $this->buildPrompt($theme, $style, $additionalParams);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a creative children\'s story writer. Create engaging, educational, and age-appropriate stories that captivate young readers.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.8,
            'max_tokens' => 2000,
        ]);

        return $response->choices[0]->message->content;
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
    public function generateSceneDescriptions(string $storyContent, int $numberOfScenes = 4): array
    {
        $prompt = "Given the following children's story, create {$numberOfScenes} distinct scene descriptions that would make good illustrations. ";
        $prompt .= "Each description should be detailed enough for AI image generation, focusing on visual elements, characters, setting, and mood.\n\n";
        $prompt .= "Story:\n{$storyContent}\n\n";
        $prompt .= "Return the scene descriptions as a numbered list (1-{$numberOfScenes}).";

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert at creating visual scene descriptions for children\'s book illustrations.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.7,
        ]);

        $content = $response->choices[0]->message->content;
        
        // Parse the numbered list into an array
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
            // Match lines starting with number
            if (preg_match('/^\d+[\.\)]\s*(.+)$/i', trim($line), $matches)) {
                $scenes[] = trim($matches[1]);
            }
        }

        return $scenes;
    }
}

