<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\StoryElement;
use App\Services\StoryGenerationService;
use App\Services\ImageGenerationService;
use App\Services\TextToSpeechService;
use App\Services\VideoCompilationService;
use App\Services\PdfMagazineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{
    protected $storyService;
    protected $imageService;
    protected $ttsService;
    protected $videoService;
    protected $pdfService;

    public function __construct(
        StoryGenerationService $storyService,
        ImageGenerationService $imageService,
        TextToSpeechService $ttsService,
        VideoCompilationService $videoService,
        PdfMagazineService $pdfService
    ) {
        $this->storyService = $storyService;
        $this->imageService = $imageService;
        $this->ttsService = $ttsService;
        $this->videoService = $videoService;
        $this->pdfService = $pdfService;
    }

    /**
     * Display a listing of user's stories
     */
    public function index()
    {
        $stories = Auth::user()->stories()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new story
     */
    public function create()
    {
        $themes = $this->getAvailableThemes();
        $styles = $this->getAvailableStyles();
        $voices = $this->ttsService->getAvailableVoices();

        // Get available AI agents
        $textAgents = config('services.ai_agents.text', []);
        $imageAgents = config('services.ai_agents.image', []);
        $voiceAgents = config('services.ai_agents.voice', []);

        // Get previous values from user's stories for autocomplete
        $userStories = Auth::user()->stories()->latest()->take(20)->get();
        $previousChildNames = $userStories->pluck('settings.child_name')->filter()->unique()->values();
        $previousInterests = $userStories->pluck('settings.interests')->filter()->unique()->values();
        $previousLessons = $userStories->pluck('settings.lesson')->filter()->unique()->values();

        return view('stories.create', compact(
            'themes',
            'styles',
            'voices',
            'textAgents',
            'imageAgents',
            'voiceAgents',
            'previousChildNames',
            'previousInterests',
            'previousLessons'
        ));
    }

    /**
     * Store a newly created story in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string',
            'style' => 'required|string',
            'child_name' => 'nullable|string|max:100',
            'age' => 'nullable|integer|min:1|max:18',
            'interests' => 'nullable|string',
            'lesson' => 'nullable|string',
            'voice' => 'required|string',
            'num_images' => 'integer|min:1|max:10',
            'text_agent' => 'nullable|string',
            'image_agent' => 'nullable|string',
            'voice_agent' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Create story record
            $story = Story::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'theme' => $request->theme,
                'style' => $request->style,
                'status' => 'processing',
                'settings' => [
                    'child_name' => $request->child_name,
                    'age' => $request->age,
                    'interests' => $request->interests,
                    'lesson' => $request->lesson,
                    'voice' => $request->voice,
                    'num_images' => $request->num_images ?? 4,
                    'text_agent' => $request->text_agent ?? 'gemini_flash',
                    'image_agent' => $request->image_agent ?? 'gemini_imagen',
                    'voice_agent' => $request->voice_agent ?? 'openai_tts',
                ],
            ]);

            DB::commit();

            // Dispatch async job for story generation
            \App\Jobs\GenerateStoryJob::dispatch($story->id, $request->all());

            return redirect()->route('stories.show', $story)
                ->with('success', 'Your story is being generated! This may take a few minutes.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Story creation failed: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Failed to create story. Please try again.');
        }
    }

    /**
     * Display the specified story
     */
    public function show(Story $story)
    {
        $this->authorize('view', $story);

        $story->load('elements', 'uploads');

        return view('stories.show', compact('story'));
    }

    /**
     * Show the form for editing the specified story
     */
    public function edit(Story $story)
    {
        $this->authorize('update', $story);

        return view('stories.edit', compact('story'));
    }

    /**
     * Update the specified story in storage
     */
    public function update(Request $request, Story $story)
    {
        $this->authorize('update', $story);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,processing,completed,failed',
        ]);

        $story->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('stories.show', $story)
            ->with('success', 'Story updated successfully!');
    }

    /**
     * Generate story content (can be called manually or via job)
     */
    public function generate(Story $story)
    {
        $this->authorize('update', $story);

        try {
            $settings = $story->settings ?? [];

            // Step 1: Generate story text
            $storyContent = $this->storyService->generateStory(
                $story->theme,
                $story->style,
                $settings
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

            // Step 2: Generate scene descriptions
            $numImages = $settings['num_images'] ?? 4;
            $textAgent = $settings['text_agent'] ?? 'openai_gpt4';
            $sceneDescriptions = $this->storyService->generateSceneDescriptions($storyContent, $numImages, $textAgent);

            // Step 3: Generate images
            $imageAgent = $settings['image_agent'] ?? 'dalle3';
            $imagePaths = $this->imageService->generateImagesForScenes($sceneDescriptions, 'vivid', $imageAgent);

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

            // Step 4: Generate voice narration
            $voice = $settings['voice'] ?? 'nova';
            $voiceAgent = $settings['voice_agent'] ?? 'openai_tts';
            $audioPath = $this->ttsService->convertStoryToSpeech($storyContent, $voice, $voiceAgent);

            $story->update(['voice_file_path' => $audioPath]);

            StoryElement::create([
                'story_id' => $story->id,
                'type' => 'voice',
                'file_path' => $audioPath,
                'order' => 999,
            ]);

            // Step 5: Generate video (optional, can be heavy)
            if ($imagePaths) {
                $videoPath = $this->videoService->compileStoryVideo(
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
            }

            // Step 6: Generate PDF magazine
            $pdfPath = $this->pdfService->generateMagazine($story);
            $story->update(['pdf_file_path' => $pdfPath]);

            // Mark as completed
            $story->update(['status' => 'completed']);

            return response()->json([
                'success' => true,
                'message' => 'Story generated successfully!',
                'story' => $story->fresh(),
            ]);

        } catch (\Exception $e) {
            Log::error('Story generation failed: ' . $e->getMessage());
            $story->update(['status' => 'failed']);

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate story: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download story as PDF
     */
    public function downloadPdf(Story $story)
    {
        $this->authorize('view', $story);

        if (!$story->pdf_file_path) {
            return back()->with('error', 'PDF not available for this story.');
        }

        return $this->pdfService->downloadPdf($story->pdf_file_path, $story->title . '.pdf');
    }

    /**
     * Regenerate PDF for existing story
     */
    public function regeneratePdf(Story $story)
    {
        $this->authorize('update', $story);

        try {
            // Delete old PDF if exists
            if ($story->pdf_file_path) {
                \Storage::disk('public')->delete($story->pdf_file_path);
            }

            // Generate new PDF
            $pdfPath = $this->pdfService->generateMagazine($story);
            $story->update(['pdf_file_path' => $pdfPath]);

            return back()->with('success', 'PDF regenerated successfully!');
        } catch (\Exception $e) {
            Log::error('PDF regeneration failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to regenerate PDF: ' . $e->getMessage());
        }
    }

    /**
     * Regenerate video for existing story
     */
    public function regenerateVideo(Story $story)
    {
        $this->authorize('update', $story);

        try {
            // Check if story has the required elements
            $story->load('elements');
            $images = $story->elements->where('type', 'image')->pluck('file_path')->filter()->toArray();
            
            if (empty($images)) {
                return back()->with('error', 'No images available to create video.');
            }

            if (!$story->voice_file_path) {
                return back()->with('error', 'No audio narration available to create video.');
            }

            // Delete old video if exists
            if ($story->video_file_path) {
                \Storage::disk('public')->delete($story->video_file_path);
                
                // Delete old video element
                StoryElement::where('story_id', $story->id)
                    ->where('type', 'video')
                    ->delete();
            }

            // Generate new video
            $videoPath = $this->videoService->compileStoryVideo(
                $images,
                $story->voice_file_path,
                $story->content
            );

            $story->update(['video_file_path' => $videoPath]);

            // Create video element
            StoryElement::create([
                'story_id' => $story->id,
                'type' => 'video',
                'file_path' => $videoPath,
                'order' => 1000,
            ]);

            return back()->with('success', 'Video generated successfully! 🎬');
        } catch (\Exception $e) {
            Log::error('Video regeneration failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to generate video: ' . $e->getMessage());
        }
    }

    /**
     * Download story video
     */
    public function downloadVideo(Story $story)
    {
        $this->authorize('view', $story);

        if (!$story->video_file_path) {
            return back()->with('error', 'Video not available for this story.');
        }

        $fullPath = storage_path('app/public/' . $story->video_file_path);
        return response()->download($fullPath, $story->title . '.mp4');
    }

    /**
     * Delete the specified story
     */
    public function destroy(Story $story)
    {
        $this->authorize('delete', $story);

        // Delete associated files
        if ($story->voice_file_path) {
            \Storage::disk('public')->delete($story->voice_file_path);
        }
        if ($story->video_file_path) {
            \Storage::disk('public')->delete($story->video_file_path);
        }
        if ($story->pdf_file_path) {
            \Storage::disk('public')->delete($story->pdf_file_path);
        }

        // Delete element files
        foreach ($story->elements as $element) {
            if ($element->file_path) {
                \Storage::disk('public')->delete($element->file_path);
            }
        }

        $story->delete();

        return redirect()->route('stories.index')
            ->with('success', 'Story deleted successfully.');
    }

    /**
     * Get available themes
     */
    protected function getAvailableThemes(): array
    {
        return [
            'adventure' => 'Adventure',
            'fantasy' => 'Fantasy',
            'science' => 'Science & Learning',
            'friendship' => 'Friendship',
            'animals' => 'Animals',
            'space' => 'Space Exploration',
            'nature' => 'Nature',
            'magic' => 'Magic & Wizards',
            'pirates' => 'Pirates',
            'dinosaurs' => 'Dinosaurs',
            'underwater' => 'Underwater World',
            'fairy_tale' => 'Fairy Tale',
        ];
    }

    /**
     * Get available styles
     */
    protected function getAvailableStyles(): array
    {
        return [
            'colorful' => 'Colorful & Vibrant',
            'cartoon' => 'Cartoon Style',
            'watercolor' => 'Watercolor Art',
            'digital' => 'Digital Art',
            'storybook' => 'Classic Storybook',
            'comic' => 'Comic Book',
            '3d' => '3D Rendered',
            'minimalist' => 'Minimalist',
        ];
    }
}
