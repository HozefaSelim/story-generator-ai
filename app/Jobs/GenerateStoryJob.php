<?php

namespace App\Jobs;

use App\Models\Story;
use App\Services\StoryGenerationService;
use App\Services\ImageGenerationService;
use App\Services\TextToSpeechService;
use App\Services\VideoCompilationService;
use App\Services\PdfMagazineService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateStoryJob implements ShouldQueue
{
    use Queueable;

    public $timeout = 600; // 10 minutes timeout
    public $tries = 3;

    protected $storyId;
    protected $params;

    /**
     * Create a new job instance.
     */
    public function __construct(int $storyId, array $params)
    {
        $this->storyId = $storyId;
        $this->params = $params;
    }

    /**
     * Execute the job.
     */
    public function handle(
        StoryGenerationService $storyService,
        ImageGenerationService $imageService,
        TextToSpeechService $ttsService,
        VideoCompilationService $videoService,
        PdfMagazineService $pdfService
    ): void
    {
        $story = Story::findOrFail($this->storyId);
        
        try {
            $story->update(['status' => 'processing']);
            $settings = $story->settings ?? [];

            // Step 1: Generate story text
            Log::info("Generating story text for story {$story->id}");
            $storyContent = $storyService->generateStory(
                $story->theme,
                $story->style,
                $settings
            );

            $story->update([
                'content' => $storyContent,
                'status' => 'processing'
            ]);

            // Save text as element
            \App\Models\StoryElement::create([
                'story_id' => $story->id,
                'type' => 'text',
                'content' => $storyContent,
                'order' => 0,
            ]);

            // Step 2: Generate scene descriptions
            Log::info("Generating scene descriptions for story {$story->id}");
            $numImages = $settings['num_images'] ?? 4;
            $sceneDescriptions = $storyService->generateSceneDescriptions($storyContent, $numImages);

            // Step 3: Generate images
            Log::info("Generating images for story {$story->id}");
            $imagePaths = $imageService->generateImagesForScenes($sceneDescriptions);

            foreach ($imagePaths as $index => $imagePath) {
                if ($imagePath) {
                    \App\Models\StoryElement::create([
                        'story_id' => $story->id,
                        'type' => 'image',
                        'file_path' => $imagePath,
                        'order' => $index + 1,
                        'metadata' => ['description' => $sceneDescriptions[$index] ?? ''],
                    ]);
                }
            }

            // Step 4: Generate voice narration
            Log::info("Generating voice narration for story {$story->id}");
            $voice = $settings['voice'] ?? 'nova';
            $audioPath = $ttsService->convertStoryToSpeech($storyContent, $voice);

            $story->update(['voice_file_path' => $audioPath]);

            \App\Models\StoryElement::create([
                'story_id' => $story->id,
                'type' => 'voice',
                'file_path' => $audioPath,
                'order' => 999,
            ]);

            // Step 5: Generate video (optional, requires FFmpeg)
            if ($imagePaths) {
                try {
                    Log::info("Generating video for story {$story->id}");
                    $videoPath = $videoService->compileStoryVideo(
                        array_filter($imagePaths),
                        $audioPath,
                        $storyContent
                    );

                    $story->update(['video_file_path' => $videoPath]);

                    \App\Models\StoryElement::create([
                        'story_id' => $story->id,
                        'type' => 'video',
                        'file_path' => $videoPath,
                        'order' => 1000,
                    ]);
                    
                    Log::info("Video generated successfully for story {$story->id}");
                } catch (\Exception $e) {
                    // Video generation is optional - log the error but don't fail the job
                    Log::warning("Video generation skipped for story {$story->id}: " . $e->getMessage());
                }
            }

            // Step 6: Generate PDF magazine (optional)
            try {
                Log::info("Generating PDF for story {$story->id}");
                $pdfPath = $pdfService->generateMagazine($story);
                $story->update(['pdf_file_path' => $pdfPath]);
                Log::info("PDF generated successfully for story {$story->id}");
            } catch (\Exception $e) {
                // PDF generation is optional - log the error but don't fail the job
                Log::warning("PDF generation skipped for story {$story->id}: " . $e->getMessage());
            }

            // Mark as completed
            $story->update(['status' => 'completed']);

            Log::info("Story {$story->id} generated successfully");

        } catch (\Exception $e) {
            Log::error("Failed to generate story {$story->id}: " . $e->getMessage());
            $story->update(['status' => 'failed']);
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        $story = Story::find($this->storyId);
        if ($story) {
            $story->update(['status' => 'failed']);
        }
        Log::error("Story generation job failed for story {$this->storyId}: " . $exception->getMessage());
    }
}
