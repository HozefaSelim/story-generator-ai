<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VideoCompilationService
{
    protected ?string $ffmpegPath = null;
    protected ?string $ffprobePath = null;

    public function __construct()
    {
        $this->ffmpegPath = $this->findFFmpegPath();
        $this->ffprobePath = $this->findFFprobePath();
        
        Log::info('VideoCompilationService initialized', [
            'ffmpeg_path' => $this->ffmpegPath,
            'ffprobe_path' => $this->ffprobePath,
            'ffmpeg_exists' => $this->ffmpegPath ? file_exists($this->ffmpegPath) : false,
        ]);
    }

    /**
     * Find FFmpeg executable path
     */
    protected function findFFmpegPath(): ?string
    {
        // Get user profile path from environment
        $userProfile = getenv('USERPROFILE') ?: getenv('HOME');
        
        // Check common Windows installation paths
        $possiblePaths = [
            // WinGet installation path (most common on Windows 11)
            $userProfile . '\\AppData\\Local\\Microsoft\\WinGet\\Links\\ffmpeg.exe',
            'C:\\Users\\hothe\\AppData\\Local\\Microsoft\\WinGet\\Links\\ffmpeg.exe',
            'C:\\Users\\' . get_current_user() . '\\AppData\\Local\\Microsoft\\WinGet\\Links\\ffmpeg.exe',
            'C:\\ffmpeg\\bin\\ffmpeg.exe',
            'C:\\ffmpeg\\ffmpeg.exe',
            'C:\\Program Files\\ffmpeg\\bin\\ffmpeg.exe',
            'C:\\Program Files (x86)\\ffmpeg\\bin\\ffmpeg.exe',
            '/usr/bin/ffmpeg',
            '/usr/local/bin/ffmpeg',
        ];

        foreach ($possiblePaths as $path) {
            if ($path && file_exists($path)) {
                Log::info('Found FFmpeg at: ' . $path);
                return $path;
            }
        }

        // Try to find via where command on Windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec('where ffmpeg 2>&1', $output, $returnCode);
            if ($returnCode === 0 && !empty($output[0]) && file_exists(trim($output[0]))) {
                Log::info('Found FFmpeg via where command: ' . trim($output[0]));
                return trim($output[0]);
            }
        }

        Log::warning('FFmpeg not found in any known location');
        // Fallback: just use 'ffmpeg' and hope it's in PATH
        return null;
    }

    /**
     * Find FFprobe executable path
     */
    protected function findFFprobePath(): ?string
    {
        // Get user profile path from environment
        $userProfile = getenv('USERPROFILE') ?: getenv('HOME');
        
        // Check common Windows installation paths
        $possiblePaths = [
            // WinGet installation path (most common on Windows 11)
            $userProfile . '\\AppData\\Local\\Microsoft\\WinGet\\Links\\ffprobe.exe',
            'C:\\Users\\hothe\\AppData\\Local\\Microsoft\\WinGet\\Links\\ffprobe.exe',
            'C:\\Users\\' . get_current_user() . '\\AppData\\Local\\Microsoft\\WinGet\\Links\\ffprobe.exe',
            'C:\\ffmpeg\\bin\\ffprobe.exe',
            'C:\\ffmpeg\\ffprobe.exe',
            'C:\\Program Files\\ffmpeg\\bin\\ffprobe.exe',
            'C:\\Program Files (x86)\\ffmpeg\\bin\\ffprobe.exe',
            '/usr/bin/ffprobe',
            '/usr/local/bin/ffprobe',
        ];

        foreach ($possiblePaths as $path) {
            if ($path && file_exists($path)) {
                return $path;
            }
        }

        return null;
    }

    /**
     * Get FFmpeg command
     */
    protected function getFFmpegCommand(): string
    {
        return $this->ffmpegPath ? escapeshellarg($this->ffmpegPath) : 'ffmpeg';
    }

    /**
     * Get FFprobe command
     */
    protected function getFFprobeCommand(): string
    {
        return $this->ffprobePath ? escapeshellarg($this->ffprobePath) : 'ffprobe';
    }

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
            // Get audio duration to calculate image display time
            $audioDuration = $this->getAudioDuration($audioPath);
            $numImages = count($images);
            $imageDuration = $audioDuration > 0 ? ($audioDuration / $numImages) : 5;
            
            Log::info("Video compilation: audio={$audioDuration}s, images={$numImages}, duration per image={$imageDuration}s");
            
            // Prepare images with text overlays
            $preparedImages = $this->prepareImagesWithText($images, $storyText, $tempDir);
            
            // Create video from images with calculated duration
            $imageVideoPath = $this->createVideoFromImages($preparedImages, $tempDir, $imageDuration);
            
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
     * Get audio file duration in seconds
     */
    protected function getAudioDuration(string $audioPath): float
    {
        $fullPath = Storage::disk('public')->path($audioPath);
        
        $ffprobe = $this->getFFprobeCommand();
        $command = sprintf(
            '%s -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 %s 2>&1',
            $ffprobe,
            escapeshellarg($fullPath)
        );

        exec($command, $output, $returnCode);
        
        $duration = isset($output[0]) ? (float) trim($output[0]) : 0.0;
        Log::info("Audio duration detected: {$duration} seconds");
        
        return $duration;
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
    protected function createVideoFromImages(array $images, string $tempDir, float $imageDuration = 5.0): string
    {
        $outputPath = $tempDir . '/images_video.mp4';
        
        if (!$this->isFFmpegAvailable()) {
            throw new \Exception('FFmpeg is required for video compilation. Please install FFmpeg.');
        }

        // Create a concat file for FFmpeg
        $concatFile = $tempDir . '/concat.txt';
        $concatContent = '';
        
        foreach ($images as $image) {
            // Each image shows for calculated duration based on audio length
            $concatContent .= "file '" . $image . "'\n";
            $concatContent .= "duration " . number_format($imageDuration, 2, '.', '') . "\n";
        }
        // Add last image again to prevent truncation
        $concatContent .= "file '" . end($images) . "'\n";
        
        file_put_contents($concatFile, $concatContent);
        
        Log::info("Concat file created with duration {$imageDuration}s per image");

        // Run FFmpeg command
        $ffmpeg = $this->getFFmpegCommand();
        $command = sprintf(
            '%s -f concat -safe 0 -i %s -vsync vfr -pix_fmt yuv420p %s 2>&1',
            $ffmpeg,
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

        $ffmpeg = $this->getFFmpegCommand();
        // Use audio duration as the primary timeline (-shortest removed to keep full audio)
        $command = sprintf(
            '%s -i %s -i %s -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 %s 2>&1',
            $ffmpeg,
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
        
        $ffmpeg = $this->getFFmpegCommand();
        $command = sprintf(
            '%s -i %s -vf "drawtext=text=\'%s\':fontfile=/Windows/Fonts/arial.ttf:fontsize=24:fontcolor=white:x=(w-text_w)/2:y=h-100:borderw=2:bordercolor=black" %s 2>&1',
            $ffmpeg,
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
        if ($this->ffmpegPath && file_exists($this->ffmpegPath)) {
            return true;
        }

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
        
        $ffprobe = $this->getFFprobeCommand();
        $command = sprintf(
            '%s -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 %s',
            $ffprobe,
            escapeshellarg($fullPath)
        );

        exec($command, $output);
        
        return isset($output[0]) ? (float) $output[0] : 0.0;
    }
}

