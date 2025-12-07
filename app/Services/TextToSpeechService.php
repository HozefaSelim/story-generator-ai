<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class TextToSpeechService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }

    /**
     * Convert text to speech using OpenAI's TTS
     */
    public function convertTextToSpeech(string $text, string $voice = 'alloy', string $agent = 'openai_tts'): string
    {
        // Available voices: alloy, echo, fable, onyx, nova, shimmer

        $model = $this->getModelFromAgent($agent);

        $response = Http::timeout(120)->withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/audio/speech', [
                    'model' => $model,
                    'input' => $text,
                    'voice' => $voice,
                    'response_format' => 'mp3',
                ]);

        if ($response->successful()) {
            $fileName = 'story-audio/' . uniqid() . '.mp3';
            Storage::disk('public')->put($fileName, $response->body());
            return $fileName;
        }

        throw new \Exception('Failed to generate speech: ' . $response->body());
    }

    /**
     * Get model name from agent configuration
     */
    protected function getModelFromAgent(string $agent): string
    {
        $agentConfig = config("services.ai_agents.voice.{$agent}");
        return $agentConfig['model'] ?? 'tts-1';
    }

    /**
     * Convert story to speech with multiple segments
     */
    public function convertStoryToSpeech(string $storyContent, string $voice = 'nova', string $agent = 'openai_tts'): string
    {
        // Split story into manageable chunks if it's too long
        $chunks = $this->splitTextIntoChunks($storyContent);

        if (count($chunks) === 1) {
            return $this->convertTextToSpeech($storyContent, $voice, $agent);
        }

        // Generate audio for each chunk and merge them
        $audioFiles = [];
        foreach ($chunks as $index => $chunk) {
            $audioFiles[] = $this->convertTextToSpeech($chunk, $voice, $agent);
        }

        // Merge audio files
        return $this->mergeAudioFiles($audioFiles);
    }

    /**
     * Split text into chunks suitable for TTS
     */
    protected function splitTextIntoChunks(string $text, int $maxLength = 4000): array
    {
        // OpenAI TTS has a limit of 4096 characters
        if (strlen($text) <= $maxLength) {
            return [$text];
        }

        $chunks = [];
        $sentences = preg_split('/(?<=[.!?])\s+/', $text);
        $currentChunk = '';

        foreach ($sentences as $sentence) {
            if (strlen($currentChunk . $sentence) > $maxLength) {
                if (!empty($currentChunk)) {
                    $chunks[] = trim($currentChunk);
                    $currentChunk = $sentence;
                } else {
                    // Single sentence is too long, force split
                    $chunks[] = substr($sentence, 0, $maxLength);
                    $currentChunk = substr($sentence, $maxLength);
                }
            } else {
                $currentChunk .= ($currentChunk ? ' ' : '') . $sentence;
            }
        }

        if (!empty($currentChunk)) {
            $chunks[] = trim($currentChunk);
        }

        return $chunks;
    }

    /**
     * Merge multiple audio files into one
     */
    protected function mergeAudioFiles(array $audioFiles): string
    {
        if (count($audioFiles) === 1) {
            return $audioFiles[0];
        }

        // This is a simplified version. In production, you'd use FFmpeg or similar
        // For now, we'll just return the first file
        // TODO: Implement proper audio merging with FFmpeg

        $mergedFileName = 'story-audio/' . uniqid() . '_merged.mp3';

        // Placeholder - in production, use FFmpeg to merge audio files
        // For now, just copy the first file as a placeholder
        Storage::disk('public')->copy($audioFiles[0], $mergedFileName);

        return $mergedFileName;
    }

    /**
     * Get available voices
     */
    public function getAvailableVoices(): array
    {
        return [
            'alloy' => 'Alloy - Neutral',
            'echo' => 'Echo - Warm',
            'fable' => 'Fable - British',
            'onyx' => 'Onyx - Deep',
            'nova' => 'Nova - Youthful (recommended for children)',
            'shimmer' => 'Shimmer - Bright',
        ];
    }
}

