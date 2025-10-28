<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="heading-lg mb-2">📚 My Stories</h2>
                <p class="text-slate-400">Manage and view all your AI-generated stories</p>
            </div>
            <a href="{{ route('stories.create') }}" class="btn-primary px-6 py-3 whitespace-nowrap">
                <span class="text-xl">✨</span>
                Create New Story
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container-app">
            @if($stories->count() > 0)
                <!-- Stories Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($stories as $story)
                        <div class="card group overflow-hidden hover:scale-105 hover:shadow-2xl transition-all duration-300">
                            <!-- Story Cover -->
                            <div class="relative h-56 overflow-hidden">
                                @if($story->cover_image)
                                    <img src="{{ asset('storage/' . $story->cover_image) }}" alt="{{ $story->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center">
                                        <span class="text-8xl opacity-30">📚</span>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    @if($story->status === 'completed')
                                        <span class="px-3 py-1.5 bg-green-500/90 backdrop-blur-sm text-white rounded-full text-xs font-bold shadow-lg">✓ Completed</span>
                                    @elseif($story->status === 'processing')
                                        <span class="px-3 py-1.5 bg-yellow-500/90 backdrop-blur-sm text-white rounded-full text-xs font-bold shadow-lg animate-pulse">⏳ Processing</span>
                                    @elseif($story->status === 'failed')
                                        <span class="px-3 py-1.5 bg-red-500/90 backdrop-blur-sm text-white rounded-full text-xs font-bold shadow-lg">✗ Failed</span>
                                    @else
                                        <span class="px-3 py-1.5 bg-slate-500/90 backdrop-blur-sm text-white rounded-full text-xs font-bold shadow-lg">Draft</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Story Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-gradient transition-colors">
                                    {{ $story->title }}
                                </h3>
                                
                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-lg text-xs font-semibold border border-indigo-500/30">
                                        {{ ucfirst($story->theme) }}
                                    </span>
                                    <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-lg text-xs font-semibold border border-purple-500/30">
                                        {{ ucfirst($story->style) }}
                                    </span>
                                </div>

                                <!-- Meta Info -->
                                <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $story->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3">
                                    <a href="{{ route('stories.show', $story) }}" class="flex-1 btn-primary py-2.5 text-sm justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('stories.edit', $story) }}" class="btn-secondary py-2.5 px-4 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $stories->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="card-gradient p-16 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-3xl mb-6 shadow-2xl">
                        <span class="text-6xl">📖</span>
                    </div>
                    <h3 class="heading-md mb-4">No Stories Yet</h3>
                    <p class="text-slate-400 text-lg mb-8 max-w-md mx-auto">
                        Ready to create your first magical story? Start your journey into the world of AI-powered storytelling!
                    </p>
                    <a href="{{ route('stories.create') }}" class="btn-primary px-8 py-4 text-lg inline-flex items-center gap-3">
                        <span class="text-2xl">✨</span>
                        <span>Create Your First Story</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

