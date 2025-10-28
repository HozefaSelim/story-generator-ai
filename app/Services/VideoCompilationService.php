<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VideoCompilationService
{
    /**
     * Compile story elements into a video
     * 
     * This service combines images, text, and audio into a video file
     * Requires FFmpeg to be installed on the server
     */
    public function compileStoryVideo(array $images, string $audioPath, string $storyText): string
    {
        $videoFileName = 'story-videos/' . uniqid() . '.mp4';
        $tempDir = storage_path('app/temp/video-' . uniqid());
        
        // Create temporary directory
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        try {
            // Prepare images with text overlays
            $preparedImages = $this->prepareImagesWithText($images, $storyText, $tempDir);
            
            // Create video from images
            $imageVideoPath = $this->createVideoFromImages($preparedImages, $tempDir);
            
            // Add audio to video
            $finalVideoPath = $this->addAudioToVideo($imageVideoPath, $audioPath, $videoFileName);
            
            // Clean up temporary files
            $this->cleanupTempDir($tempDir);
            
            return $finalVideoPath;
        } catch (\Exception $e) {
            Log::error('Video compilation failed: ' . $e->getMessage());
            $this->cleanupTempDir($tempDir);
            throw $e;
        }
    }

    /**
     * Prepare images with text overlays
     */
    protected function prepareImagesWithText(array $images, string $text, string $tempDir): array
    {
        // Split text into segments matching number of images
        $textSegments = $this->splitTextIntoSegments($text, count($images));
        $preparedImages = [];

        foreach ($images as $index => $imagePath) {
            $fullImagePath = Storage::disk('public')->path($imagePath);
            $outputPath = $tempDir . '/image_' . str_pad($index, 3, '0', STR_PAD_LEFT) . '.png';
            
            // Add text overlay using FFmpeg or ImageMagick
            if ($this->isFFmpegAvailable()) {
                $this->addTextOverlayWithFFmpeg($fullImagePath, $outputPath, $textSegments[$index] ?? '');
            } else {
                // Fallback: just copy the image without text
                copy($fullImagePath, $outputPath);
            }
            
            $preparedImages[] = $outputPath;
        }

        return $preparedImages;
    }

    /**
     * Create video from images
     */
    protected function createVideoFromImages(array $images, string $tempDir): string
    {
        $outputPath = $tempDir . '/images_video.mp4';
        
        if (!$this->isFFmpegAvailable()) {
            throw new \Exception('FFmpeg is required for video compilation. Please install FFmpeg.');
        }

        // Create a concat file for FFmpeg
        $concatFile = $tempDir . '/concat.txt';
        $concatContent = '';
        
        foreach ($images as $image) {
            // Each image shows for 5 seconds
            $concatContent .= "file '" . $image . "'\n";
            $concatContent .= "duration 5\n";
        }
        // Add last image again to prevent truncation
        $concatContent .= "file '" . end($images) . "'\n";
        
        file_put_contents($concatFile, $concatContent);

        // Run FFmpeg command
        $command = sprintf(
            'ffmpeg -f concat -safe 0 -i %s -vsync vfr -pix_fmt yuv420p %s 2>&1',
            escapeshellarg($concatFile),
            escapeshellarg($outputPath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode !== 0 || !file_exists($outputPath)) {
            Log::error('FFmpeg failed: ' . implode("\n", $output));
            throw new \Exception('Failed to create video from images');
        }

        return $outputPath;
    }

    /**
     * Add audio to video
     */
    protected function addAudioToVideo(string $videoPath, string $audioPath, string $outputFileName): string
    {
        $fullAudioPath = Storage::disk('public')->path($audioPath);
        $outputPath = Storage::disk('public')->path($outputFileName);
        
        // Ensure directory exists
        $outputDir = dirname($outputPath);
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $command = sprintf(
            'ffmpeg -i %s -i %s -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 -shortest %s 2>&1',
            escapeshellarg($videoPath),
            escapeshellarg($fullAudioPath),
            escapeshellarg($outputPath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode !== 0 || !file_exists($outputPath)) {
            Log::error('FFmpeg audio merge failed: ' . implode("\n", $output));
            throw new \Exception('Failed to add audio to video');
        }

        return $outputFileName;
    }

    /**
     * Add text overlay to image using FFmpeg
     */
    protected function addTextOverlayWithFFmpeg(string $imagePath, string $outputPath, string $text): void
    {
        // Escape text for FFmpeg drawtext filter
        $escapedText = str_replace([':', "'", '\\'], ['\\:', "\\'", '\\\\'], $text);
        
        $command = sprintf(
            'ffmpeg -i %s -vf "drawtext=text=\'%s\':fontfile=/Windows/Fonts/arial.ttf:fontsize=24:fontcolor=white:x=(w-text_w)/2:y=h-100:borderw=2:bordercolor=black" %s 2>&1',
            escapeshellarg($imagePath),
            $escapedText,
            escapeshellarg($outputPath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            // Fallback: copy without text
            copy($imagePath, $outputPath);
        }
    }

    /**
     * Split text into segments
     */
    protected function splitTextIntoSegments(string $text, int $numSegments): array
    {
        $sentences = preg_split('/(?<=[.!?])\s+/', $text);
        $segmentSize = ceil(count($sentences) / $numSegments);
        $segments = [];

        for ($i = 0; $i < $numSegments; $i++) {
            $segmentSentences = array_slice($sentences, $i * $segmentSize, $segmentSize);
            $segments[] = implode(' ', $segmentSentences);
        }

        return $segments;
    }

    /**
     * Check if FFmpeg is available
     */
    protected function isFFmpegAvailable(): bool
    {
        exec('ffmpeg -version 2>&1', $output, $returnCode);
        return $returnCode === 0;
    }

    /**
     * Clean up temporary directory
     */
    protected function cleanupTempDir(string $tempDir): void
    {
        if (file_exists($tempDir)) {
            $files = glob($tempDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($tempDir);
        }
    }

    /**
     * Get video duration
     */
    public function getVideoDuration(string $videoPath): float
    {
        $fullPath = Storage::disk('public')->path($videoPath);
        
        $command = sprintf(
            'ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 %s',
            escapeshellarg($fullPath)
        );

        exec($command, $output);
        
        return isset($output[0]) ? (float) $output[0] : 0.0;
    }
}

