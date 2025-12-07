<?php

namespace App\Jobs;

use App\Models\Story;
use App\Models\StoryElement;
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
    ): void {
        $story = Story::findOrFail($this->storyId);

        try {
            $story->update(['status' => 'processing']);
            $settings = $story->settings ?? [];

            // Get selected agents from settings
            $textAgent = $settings['text_agent'] ?? 'gemini_flash';
            $imageAgent = $settings['image_agent'] ?? 'gemini_imagen';
            $voiceAgent = $settings['voice_agent'] ?? 'openai_tts';

            Log::info("Generating story {$story->id} with agents: text={$textAgent}, image={$imageAgent}, voice={$voiceAgent}");

            // Step 1: Generate story text
            Log::info("Step 1: Generating story text...");
            $storyContent = $storyService->generateStory(
                $story->theme,
                $story->style,
                array_merge($settings, ['text_agent' => $textAgent])
            );

            $story->update([
                'content' => $storyContent,
                'status' => 'processing'
            ]);

            // Save text as element
            StoryElement::create([
                'story_id' => $story->id,
                'type' => 'text',
                'content' => $storyContent,
                'order' => 0,
            ]);

            Log::info("Step 1 complete: Story text generated");

            // Step 2: Generate scene descriptions
            Log::info("Step 2: Generating scene descriptions...");
            $numImages = $settings['num_images'] ?? 4;
            $sceneDescriptions = $storyService->generateSceneDescriptions($storyContent, $numImages, $textAgent);

            Log::info("Step 2 complete: {$numImages} scene descriptions generated");

            // Step 3: Generate images
            Log::info("Step 3: Generating images with {$imageAgent}...");
            $imagePaths = $imageService->generateImagesForScenes($sceneDescriptions, 'vivid', $imageAgent);

            foreach ($imagePaths as $index => $imagePath) {
                if ($imagePath) {
                    StoryElement::create([
                        'story_id' => $story->id,
                        'type' => 'image',
                        'file_path' => $imagePath,
                        'order' => $index + 1,
                        'metadata' => ['description' => $sceneDescriptions[$index] ?? ''],
                    ]);
                }
            }

            Log::info("Step 3 complete: Images generated");

            // Step 4: Generate voice narration
            Log::info("Step 4: Generating voice narration with {$voiceAgent}...");
            $voice = $settings['voice'] ?? 'nova';
            $audioPath = $ttsService->convertStoryToSpeech($storyContent, $voice, $voiceAgent);

            $story->update(['voice_file_path' => $audioPath]);

            StoryElement::create([
                'story_id' => $story->id,
                'type' => 'voice',
                'file_path' => $audioPath,
                'order' => 999,
            ]);

            Log::info("Step 4 complete: Voice narration generated");

            // Step 5: Generate video (optional)
            if (!empty(array_filter($imagePaths))) {
                Log::info("Step 5: Generating video...");
                try {
                    $videoPath = $videoService->compileStoryVideo(
                        array_filter($imagePaths),
                        $audioPath,
                        $storyContent
                    );

                    $story->update(['video_file_path' => $videoPath]);

                    StoryElement::create([
                        'story_id' => $story->id,
                        'type' => 'video',
                        'file_path' => $videoPath,
                        'order' => 1000,
                    ]);

                    Log::info("Step 5 complete: Video generated");
                } catch (\Exception $e) {
                    Log::warning("Video generation skipped: " . $e->getMessage());
                }
            }

            // Step 6: Generate PDF magazine
            Log::info("Step 6: Generating PDF...");
            try {
                $pdfPath = $pdfService->generateMagazine($story->fresh());
                $story->update(['pdf_file_path' => $pdfPath]);
                Log::info("Step 6 complete: PDF generated");
            } catch (\Exception $e) {
                Log::warning("PDF generation skipped: " . $e->getMessage());
            }

            // Mark as completed
            $story->update(['status' => 'completed']);
            Log::info("Story {$story->id} generated successfully!");

        } catch (\Exception $e) {
            Log::error("Failed to generate story {$story->id}: " . $e->getMessage());
            Log::error($e->getTraceAsString());
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
