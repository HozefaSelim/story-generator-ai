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

            // Generate story content (this calls all the AI services)
            $controller = app(\App\Http\Controllers\StoryController::class);
            $controller->generate($story);

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
