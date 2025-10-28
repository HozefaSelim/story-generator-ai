<x-guest-layout>
    <x-site-header />

    <!-- Hero Section -->
    <div class="relative overflow-hidden h-screen flex items-center bg-slate-900">
        <!-- Hero Container -->
        <div class="relative max-w-[95%] xl:max-w-[1400px] mx-auto px-6 sm:px-8 lg:px-12 w-full">
            <div class="relative">
                <!-- Dark Card with Kid Background Image -->
                <div class="relative overflow-hidden rounded-xl shadow-2xl" style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(20, 20, 30, 0.4) 50%, transparent 100%), url('/images/kid-background.png') right center/cover; background-position: 70% center;">
                    <div class="absolute inset-0 backdrop-blur-[1px] bg-gradient-to-r from-black/35 via-black/15 to-transparent"></div>

                    <!-- Content Container -->
                    <div class="relative z-10 px-8 sm:px-12 lg:px-20 xl:px-28 py-12 sm:py-16 lg:py-20 xl:py-24 mt-16">
                        <!-- Main Content -->
                        <div class="max-w-4xl">
                            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 lg:mb-8 leading-tight">
                                <span class="text-white block mb-1 sm:mb-2">Create personalised, instant</span>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-blue-400 to-blue-500 block mb-1 sm:mb-2">bedtime stories</span>
                                <span class="text-white block">in seconds.</span>
                            </h1>

                            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-200 mb-8 lg:mb-10 leading-relaxed max-w-2xl">
                                Generate a story about your child, with family members as characters, add a genre, art style, moral and much more – using artificial intelligence.
                            </p>

                            <!-- CTA Button -->
                            <div class="flex flex-wrap gap-4 items-center">
                                @auth
                                    <a href="{{ route('stories.create') }}" class="group relative inline-flex items-center justify-center px-8 sm:px-10 py-4 sm:py-5 bg-gradient-to-r from-cyan-400 to-blue-500 text-white rounded-full font-semibold text-lg sm:text-xl shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 hover:scale-105 transition-all duration-300">
                                        <span class="mr-2 sm:mr-3">Generate your story</span>
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center px-8 sm:px-10 py-4 sm:py-5 bg-gradient-to-r from-cyan-400 to-blue-500 text-white rounded-full font-semibold text-lg sm:text-xl shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 hover:scale-105 transition-all duration-300">
                                        <span class="mr-2 sm:mr-3">Generate your story</span>
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-gradient-to-b from-slate-900 via-purple-900 to-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full text-sm font-semibold mb-4 shadow-lg">✨ FEATURES</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4">
                    Everything You Need to Create
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-pink-400"> Magic</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Powered by cutting-edge AI technology to bring imagination to life
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-2xl hover:shadow-purple-500/50 transition-all duration-300 hover:-translate-y-2 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-blue-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">📖 AI-Generated Stories</h3>
                        <p class="text-gray-300 leading-relaxed">Unique, personalized narratives created by GPT-4, tailored to your child's interests and age</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 hover:-translate-y-2 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">🎨 Beautiful Illustrations</h3>
                        <p class="text-gray-300 leading-relaxed">Stunning custom artwork generated by DALL-E 3 for every scene in your story</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-2xl hover:shadow-green-500/50 transition-all duration-300 hover:-translate-y-2 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414 1.414m9.9-2.828a9 9 0 01-12.728 0"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">🎙️ Voice Narration</h3>
                        <p class="text-gray-300 leading-relaxed">Professional AI voice narration in 6 different styles to bring stories to life</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-2xl hover:shadow-red-500/50 transition-all duration-300 hover:-translate-y-2 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-pink-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-red-500 to-red-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">🎬 Video Stories</h3>
                        <p class="text-gray-300 leading-relaxed">Engaging animated videos that combine images, narration, and music</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="group relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-2xl hover:shadow-yellow-500/50 transition-all duration-300 hover:-translate-y-2 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/20 to-orange-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-yellow-500 to-orange-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">📚 Print as Magazine</h3>
                        <p class="text-gray-300 leading-relaxed">Download gorgeous PDFs designed for printing as keepsake storybooks</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="group relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transition-all duration-300 hover:-translate-y-2 border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-rose-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-pink-500 to-rose-500 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">👶 Fully Personalized</h3>
                        <p class="text-gray-300 leading-relaxed">Make your child the star! Upload photos and customize every detail</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="relative py-24 bg-gradient-to-b from-slate-900 to-indigo-900 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-purple-500 rounded-full -translate-x-1/2 -translate-y-1/2 opacity-20"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-500 rounded-full translate-x-1/3 translate-y-1/3 opacity-20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full text-sm font-semibold mb-4 shadow-lg">🚀 HOW IT WORKS</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4">
                    Create Your Story in
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-pink-400"> 4 Simple Steps</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    From idea to magical storybook in just minutes
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                <!-- Connecting Line -->
                <div class="hidden lg:block absolute top-16 left-0 right-0 h-0.5 bg-gradient-to-r from-purple-500/50 via-blue-500/50 to-purple-500/50"></div>

                <!-- Step 1 -->
                <div class="relative text-center group">
                    <div class="relative inline-flex items-center justify-center w-20 h-20 mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl transform rotate-6 group-hover:rotate-12 transition-transform"></div>
                        <div class="relative bg-white w-16 h-16 rounded-2xl flex items-center justify-center text-3xl font-bold text-purple-600 shadow-lg">
                            1
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 group-hover:shadow-2xl group-hover:shadow-purple-500/50 transition-shadow">
                        <h3 class="text-xl font-bold mb-2">🎭 Choose Theme</h3>
                        <p class="text-gray-300">Select from 50+ themes: adventure, fantasy, science, and more</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center group">
                    <div class="relative inline-flex items-center justify-center w-20 h-20 mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl transform rotate-6 group-hover:rotate-12 transition-transform"></div>
                        <div class="relative bg-white w-16 h-16 rounded-2xl flex items-center justify-center text-3xl font-bold text-blue-600 shadow-lg">
                            2
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 group-hover:shadow-2xl group-hover:shadow-blue-500/50 transition-shadow">
                        <h3 class="text-xl font-bold mb-2">✏️ Personalize</h3>
                        <p class="text-gray-300">Add child's name, age, interests, and even upload a photo</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center group">
                    <div class="relative inline-flex items-center justify-center w-20 h-20 mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl transform rotate-6 group-hover:rotate-12 transition-transform"></div>
                        <div class="relative bg-white w-16 h-16 rounded-2xl flex items-center justify-center text-3xl font-bold text-pink-600 shadow-lg">
                            3
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 group-hover:shadow-2xl group-hover:shadow-pink-500/50 transition-shadow">
                        <h3 class="text-xl font-bold mb-2">🤖 Generate</h3>
                        <p class="text-gray-300">AI creates unique story, stunning images, and voice narration</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="relative text-center group">
                    <div class="relative inline-flex items-center justify-center w-20 h-20 mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl transform rotate-6 group-hover:rotate-12 transition-transform"></div>
                        <div class="relative bg-white w-16 h-16 rounded-2xl flex items-center justify-center text-3xl font-bold text-green-600 shadow-lg">
                            4
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 group-hover:shadow-2xl group-hover:shadow-green-500/50 transition-shadow">
                        <h3 class="text-xl font-bold mb-2">🎉 Enjoy & Share</h3>
                        <p class="text-gray-300">Watch video, download PDF, or share with family and friends</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-16">
                <a href="{{ auth()->check() ? route('stories.create') : route('register') }}" class="group inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-yellow-400 to-orange-500 text-gray-900 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-orange-500/50 hover:scale-105 transition-all duration-300">
                    <span class="mr-2">✨</span>
                    Start Creating Now
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <p class="mt-4 text-gray-300 font-medium">⚡ No credit card required • ✅ Start for free</p>
            </div>
        </div>
    </div>

    @auth
    <!-- Recent Stories Section -->
    @if($recentStories && $recentStories->count() > 0)
    <div class="py-20 bg-gradient-to-b from-indigo-900 to-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Your Recent Stories</h2>
                <a href="{{ route('stories.index') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold flex items-center">
                    View All
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($recentStories as $story)
                <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-purple-500/50 transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-r from-purple-500 to-blue-500 h-40 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-6xl">📚</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2">{{ $story->title }}</h3>
                        <p class="text-sm text-gray-300 mb-4 leading-relaxed">{{ Str::limit($story->description, 80) }}</p>
                        <a href="{{ route('stories.show', $story) }}" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold text-sm">
                            View Story
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
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
    <div class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 py-24 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-96 h-96 bg-purple-500/20 rounded-full -top-48 -left-48 animate-pulse"></div>
            <div class="absolute w-96 h-96 bg-pink-500/20 rounded-full -bottom-48 -right-48 animate-pulse animation-delay-2000"></div>
        </div>

        <div class="relative max-w-5xl mx-auto text-center px-4">
            <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-md rounded-full border border-white/30 mb-6 shadow-lg">
                <span class="text-sm font-semibold">🌟 Join thousands of happy parents</span>
            </div>
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6">
                Ready to Create
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-300"> Magic?</span>
            </h2>
            <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-3xl mx-auto">
                Start generating personalized, AI-powered stories for your children today. No credit card required!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ auth()->check() ? route('stories.create') : route('register') }}" class="group relative inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-yellow-400 to-orange-500 text-gray-900 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-orange-500/50 hover:scale-105 transition-all duration-300">
                    <span class="mr-2">{{ auth()->check() ? '🎨' : '🚀' }}</span>
                    {{ auth()->check() ? 'Create Your First Story' : 'Get Started Free' }}
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            <div class="mt-8 flex flex-wrap justify-center items-center gap-6 text-sm text-gray-200 font-medium">
                <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> No credit card</span>
                <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> Free to start</span>
                <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> Cancel anytime</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="col-span-2 md:col-span-1">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 text-transparent bg-clip-text mb-4">Story Generator AI</h3>
                    <p class="text-gray-400 text-sm mb-4">Creating magical memories through AI-powered storytelling for children worldwide.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg></a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="font-bold mb-4">Product</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Features</a></li>
                        <li><a href="#" class="hover:text-white transition">How It Works</a></li>
                        <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition">Examples</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Story Generator AI. All rights reserved. Built with ❤️ for children's education.</p>
            </div>
        </div>
    </footer>
</x-guest-layout>

