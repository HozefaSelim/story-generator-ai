<x-guest-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6">
                    Create Magical Stories for Children with AI
                </h1>
                <p class="text-xl mb-8 text-gray-100">
                    Generate personalized, illustrated storybooks with voice narration and video
                </p>
                <div class="space-x-4">
                    @auth
                        <a href="{{ route('stories.create') }}" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Create Your Story
                        </a>
                        <a href="{{ route('stories.index') }}" class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                            My Stories
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">
                Amazing Features
            </h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">AI-Generated Stories</h3>
                    <p class="text-gray-600">Unique, personalized stories created by advanced AI</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Beautiful Illustrations</h3>
                    <p class="text-gray-600">Custom images generated for each scene</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414 1.414m9.9-2.828a9 9 0 01-12.728 0"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Voice Narration</h3>
                    <p class="text-gray-600">Professional voice narration in multiple styles</p>
                </div>

                <!-- Feature 4 -->
                <div class="text-center p-6">
                    <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Video Stories</h3>
                    <p class="text-gray-600">Animated videos combining images and audio</p>
                </div>

                <!-- Feature 5 -->
                <div class="text-center p-6">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Print as Magazine</h3>
                    <p class="text-gray-600">Download beautiful PDFs ready to print</p>
                </div>

                <!-- Feature 6 -->
                <div class="text-center p-6">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Personalized</h3>
                    <p class="text-gray-600">Make your child the hero of the story</p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">
                How It Works
            </h2>
            
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h3 class="font-semibold mb-2">Choose Theme</h3>
                    <p class="text-gray-600 text-sm">Select from adventure, fantasy, science, and more</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h3 class="font-semibold mb-2">Personalize</h3>
                    <p class="text-gray-600 text-sm">Add child's name, age, and interests</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h3 class="font-semibold mb-2">Generate</h3>
                    <p class="text-gray-600 text-sm">AI creates story, images, and voice</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h3 class="font-semibold mb-2">Enjoy & Share</h3>
                    <p class="text-gray-600 text-sm">Watch, download, or print your story</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ auth()->check() ? route('stories.create') : route('register') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                    Start Creating Now
                </a>
            </div>
        </div>
    </div>

    @auth
    <!-- Recent Stories Section -->
    @if($recentStories && $recentStories->count() > 0)
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Your Recent Stories</h2>
                <a href="{{ route('stories.index') }}" class="text-purple-600 hover:text-purple-700 font-semibold">
                    View All →
                </a>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($recentStories as $story)
                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                    <div class="bg-gradient-to-r from-purple-400 to-blue-400 h-32"></div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $story->title }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($story->description, 80) }}</p>
                        <a href="{{ route('stories.show', $story) }}" class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                            View Story →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @endauth

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-4">
                Ready to Create Magic?
            </h2>
            <p class="text-xl mb-8">
                Start generating personalized stories for your children today!
            </p>
            <a href="{{ auth()->check() ? route('stories.create') : route('register') }}" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                {{ auth()->check() ? 'Create Story' : 'Sign Up Free' }}
            </a>
        </div>
    </div>
</x-guest-layout>

