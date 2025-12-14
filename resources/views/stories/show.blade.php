<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="heading-lg">{{ $story->title }}</h2>
                    @if($story->status === 'completed')
                        <span class="px-3 py-1.5 bg-green-500/20 backdrop-blur-sm text-green-300 rounded-full text-xs font-bold border border-green-500/30">✓ Completed</span>
                    @elseif($story->status === 'processing')
                        <span class="px-3 py-1.5 bg-yellow-500/20 backdrop-blur-sm text-yellow-300 rounded-full text-xs font-bold border border-yellow-500/30 animate-pulse">⏳ Processing</span>
                    @elseif($story->status === 'failed')
                        <span class="px-3 py-1.5 bg-red-500/20 backdrop-blur-sm text-red-300 rounded-full text-xs font-bold border border-red-500/30">✗ Failed</span>
                    @else
                        <span class="px-3 py-1.5 bg-slate-500/20 backdrop-blur-sm text-slate-300 rounded-full text-xs font-bold border border-slate-500/30">Draft</span>
                    @endif
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-lg text-sm font-semibold border border-indigo-500/30">
                        {{ ucfirst($story->theme) }}
                    </span>
                    <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-lg text-sm font-semibold border border-purple-500/30">
                        {{ ucfirst($story->style) }}
                    </span>
                    <span class="flex items-center gap-2 text-sm text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $story->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            <div class="flex gap-3">
                @if($story->pdf_file_path)
                    <a href="{{ route('stories.download-pdf', $story) }}" class="btn-secondary px-5 py-2.5 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        PDF
                    </a>
                    <form method="POST" action="{{ route('stories.regenerate-pdf', $story) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-ghost px-4 py-2.5 whitespace-nowrap text-sm" title="Regenerate PDF">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </form>
                @endif
                @if($story->video_file_path)
                    <a href="{{ route('stories.download-video', $story) }}" class="btn-secondary px-5 py-2.5 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Video
                    </a>
                    <form method="POST" action="{{ route('stories.regenerate-video', $story) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-ghost px-4 py-2.5 whitespace-nowrap text-sm" title="Regenerate Video">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </form>
                @elseif($story->status === 'completed' && $story->voice_file_path)
                    <form method="POST" action="{{ route('stories.regenerate-video', $story) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-primary px-5 py-2.5 whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Generate Video
                        </button>
                    </form>
                @endif
                <a href="{{ route('stories.index') }}" class="btn-ghost px-5 py-2.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container-app max-w-6xl">
            @if($story->status === 'completed' && $story->content)
                <!-- Story Content -->
                <div class="space-y-8">
                    <!-- Personalization Info -->
                    @if($story->settings && (isset($story->settings['child_name']) || isset($story->settings['age'])))
                        <div class="card-gradient p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-purple-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-3xl">👶</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white mb-1">Personalized Story</h3>
                                    <p class="text-slate-300">
                                        @if(isset($story->settings['child_name']))
                                            Created for <span class="text-gradient font-bold">{{ $story->settings['child_name'] }}</span>
                                        @endif
                                        @if(isset($story->settings['age']))
                                            <span class="text-slate-400">• Age {{ $story->settings['age'] }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- AI Agents Used -->
                    @php
                        $textAgent = $story->settings['text_agent'] ?? 'openai_gpt4';
                        $imageAgent = $story->settings['image_agent'] ?? 'dalle3';
                        $voiceAgent = $story->settings['voice_agent'] ?? 'openai_tts';
                        
                        $textAgentConfig = config("services.ai_agents.text.{$textAgent}", ['name' => 'GPT-4', 'icon' => '🤖']);
                        $imageAgentConfig = config("services.ai_agents.image.{$imageAgent}", ['name' => 'DALL-E 3', 'icon' => '🎨']);
                        $voiceAgentConfig = config("services.ai_agents.voice.{$voiceAgent}", ['name' => 'TTS', 'icon' => '🎙️']);
                    @endphp
                    <div class="card p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-lg">🤖</span>
                            <h4 class="text-sm font-semibold text-slate-300">AI Agents Used</h4>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-500/20 text-indigo-300 rounded-lg text-xs font-medium border border-indigo-500/30">
                                {{ $textAgentConfig['icon'] ?? '🤖' }} {{ $textAgentConfig['name'] ?? 'GPT-4' }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-500/20 text-purple-300 rounded-lg text-xs font-medium border border-purple-500/30">
                                {{ $imageAgentConfig['icon'] ?? '🎨' }} {{ $imageAgentConfig['name'] ?? 'DALL-E 3' }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-pink-500/20 text-pink-300 rounded-lg text-xs font-medium border border-pink-500/30">
                                {{ $voiceAgentConfig['icon'] ?? '🎙️' }} {{ $voiceAgentConfig['name'] ?? 'TTS' }}
                            </span>
                        </div>
                    </div>

                    <!-- Story Text and Images -->
                    <div class="card p-10">
                        <div class="prose prose-lg prose-invert max-w-none">
                            @if($story->elements && $story->elements->where('type', 'image')->count() > 0)
                                @foreach($story->elements->where('type', 'image') as $index => $element)
                                    <div class="not-prose mb-10">
                                        <div class="rounded-2xl overflow-hidden shadow-2xl hover:shadow-indigo-500/20 transition-shadow duration-300">
                                            <img src="{{ asset('storage/' . $element->file_path) }}" alt="Scene {{ $index + 1 }}" class="w-full h-auto">
                                        </div>
                                        @if($element->metadata && isset($element->metadata['description']))
                                            <p class="text-sm text-slate-400 mt-3 italic text-center">{{ $element->metadata['description'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            @endif

                            <div class="text-lg leading-relaxed text-slate-200 whitespace-pre-line">
                                {{ $story->content }}
                            </div>
                        </div>
                    </div>

                    <!-- Audio Player -->
                    @if($story->voice_file_path)
                        <div class="card p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414 1.414m9.9-2.828a9 9 0 01-12.728 0"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">🎙️ Listen to the Story</h3>
                                    <p class="text-slate-400 text-sm">Professional AI narration</p>
                                </div>
                            </div>
                            <audio controls class="w-full" controlsList="nodownload">
                                <source src="{{ asset('storage/' . $story->voice_file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @endif

                    <!-- Video Player -->
                    @if($story->video_file_path)
                        <div class="card p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">🎬 Watch the Story</h3>
                                    <p class="text-slate-400 text-sm">Animated video with narration</p>
                                </div>
                            </div>
                            <video controls class="w-full rounded-xl" controlsList="nodownload">
                                <source src="{{ asset('storage/' . $story->video_file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @elseif($story->voice_file_path && $story->elements && $story->elements->where('type', 'image')->count() > 0)
                        <!-- Video Generation CTA -->
                        <div class="card p-8 border-2 border-dashed border-red-500/30 bg-red-500/5">
                            <div class="flex flex-col sm:flex-row items-center gap-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 text-center sm:text-left">
                                    <h3 class="text-xl font-bold text-white mb-2">🎬 Create Story Video</h3>
                                    <p class="text-slate-400 text-sm mb-4">
                                        Combine your story images and narration into a beautiful video!
                                    </p>
                                    <form method="POST" action="{{ route('stories.regenerate-video', $story) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="btn-primary px-6 py-3">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Generate Video Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Cards -->
                    <div class="grid md:grid-cols-2 gap-6 mt-8">
                        <a href="{{ route('stories.edit', $story) }}" class="card p-8 hover:scale-105 transition-transform group">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-indigo-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white group-hover:text-gradient transition-colors">Edit Story</h3>
                                    <p class="text-slate-400 text-sm">Modify story details</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('stories.create') }}" class="card p-8 hover:scale-105 transition-transform group">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-purple-500/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white group-hover:text-gradient transition-colors">Create Another</h3>
                                    <p class="text-slate-400 text-sm">Generate a new story</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif($story->status === 'processing')
                <!-- Processing State -->
                <div class="card-gradient p-16 text-center">
                    <div class="inline-flex items-center justify-center w-28 h-28 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-3xl mb-8 shadow-2xl animate-pulse">
                        <span class="text-7xl">⏳</span>
                    </div>
                    <h3 class="heading-md mb-4">✨ Crafting Your Magical Story</h3>
                    <p class="text-slate-300 text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                        Our AI is working its magic! We're generating your personalized story with beautiful illustrations and voice narration. This typically takes 2-5 minutes.
                    </p>
                    
                    <!-- Progress Steps with Dynamic Agents -->
                    @php
                        $textAgent = $story->settings['text_agent'] ?? 'openai_gpt4';
                        $imageAgent = $story->settings['image_agent'] ?? 'dalle3';
                        $voiceAgent = $story->settings['voice_agent'] ?? 'openai_tts';
                        
                        $textAgentConfig = config("services.ai_agents.text.{$textAgent}", ['name' => 'GPT-4', 'icon' => '🤖']);
                        $imageAgentConfig = config("services.ai_agents.image.{$imageAgent}", ['name' => 'DALL-E 3', 'icon' => '🎨']);
                        $voiceAgentConfig = config("services.ai_agents.voice.{$voiceAgent}", ['name' => 'TTS', 'icon' => '🎙️']);
                    @endphp
                    <div class="max-w-3xl mx-auto mb-10">
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                            <div class="card p-4">
                                <div class="text-3xl mb-2">{{ $textAgentConfig['icon'] ?? '📝' }}</div>
                                <div class="text-sm font-semibold text-white">Writing Story</div>
                                <div class="text-xs text-slate-400 mt-1">{{ $textAgentConfig['name'] ?? 'GPT-4' }}</div>
                            </div>
                            <div class="card p-4">
                                <div class="text-3xl mb-2">{{ $imageAgentConfig['icon'] ?? '🎨' }}</div>
                                <div class="text-sm font-semibold text-white">Creating Art</div>
                                <div class="text-xs text-slate-400 mt-1">{{ $imageAgentConfig['name'] ?? 'DALL-E 3' }}</div>
                            </div>
                            <div class="card p-4">
                                <div class="text-3xl mb-2">{{ $voiceAgentConfig['icon'] ?? '🎙️' }}</div>
                                <div class="text-sm font-semibold text-white">Adding Voice</div>
                                <div class="text-xs text-slate-400 mt-1">{{ $voiceAgentConfig['name'] ?? 'TTS' }}</div>
                            </div>
                            <div class="card p-4">
                                <div class="text-3xl mb-2">📚</div>
                                <div class="text-sm font-semibold text-white">Finalizing</div>
                                <div class="text-xs text-slate-400 mt-1">PDF & Video</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button onclick="location.reload()" class="btn-primary px-8 py-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Refresh Status
                        </button>
                        <a href="{{ route('stories.index') }}" class="btn-ghost px-8 py-4">
                            Back to Stories
                        </a>
                    </div>
                </div>
            @elseif($story->status === 'failed')
                <!-- Failed State -->
                <div class="card-gradient p-16 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-red-500/20 rounded-3xl mb-6 shadow-2xl border-2 border-red-500/30">
                        <span class="text-6xl">❌</span>
                    </div>
                    <h3 class="heading-md mb-4 text-red-400">Story Generation Failed</h3>
                    <p class="text-slate-300 text-lg mb-8 max-w-md mx-auto">
                        We encountered an issue while generating your story. This could be due to API limits or temporary service issues.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <form method="POST" action="{{ route('stories.generate', $story) }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-primary px-8 py-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Try Again
                            </button>
                        </form>
                        <a href="{{ route('stories.index') }}" class="btn-ghost px-8 py-4">
                            Back to Stories
                        </a>
                    </div>
                </div>
            @else
                <!-- Draft State -->
                <div class="card-gradient p-16 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-slate-500/20 rounded-3xl mb-6 shadow-2xl">
                        <span class="text-6xl">📝</span>
                    </div>
                    <h3 class="heading-md mb-4">Draft Story</h3>
                    <p class="text-slate-300 text-lg mb-8 max-w-md mx-auto">
                        This story hasn't been generated yet. Start the generation process to create your magical story!
                    </p>
                    <form method="POST" action="{{ route('stories.generate', $story) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-primary px-10 py-4 text-lg">
                            <span class="text-xl">✨</span>
                            Start Generation
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
