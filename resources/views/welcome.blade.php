<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen" style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);">
        <x-site-header />

        <!-- Hero Section -->
        <main class="w-full relative overflow-hidden">
            <!-- Animated Background Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10 pointer-events-none"></div>
            
            <div class="container-app py-16 sm:py-24 text-center relative z-10">
                <!-- Badge -->
                <div class="mb-8 animate-fade-in-up">
                    <span class="inline-flex items-center gap-2 px-5 py-2.5 glass rounded-full text-sm font-semibold text-indigo-300 border border-indigo-500/30">
                        <span class="text-lg">✨</span>
                        Powered by OpenAI GPT-4 & DALL-E 3
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="heading-xl mb-6 animate-fade-in-up animation-delay-200">
                    Create <span class="text-gradient">Magical Stories</span><br>
                    for Children with AI
                </h1>

                <p class="text-xl sm:text-2xl text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-400">
                    Generate personalized, illustrated storybooks with voice narration and stunning videos in minutes
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-20 animate-fade-in-up animation-delay-600">
                    @auth
                        <a href="{{ route('stories.create') }}" class="btn-primary text-lg px-10 py-4">
                            <span class="text-xl">🎨</span>
                            Create Your Story
                            <span class="text-xl">→</span>
                        </a>
                        <a href="{{ route('stories.index') }}" class="btn-ghost text-lg px-10 py-4">
                            <span class="text-xl">📚</span>
                            My Stories
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary text-lg px-10 py-4">
                            <span class="text-xl">🎨</span>
                            Get Started Free
                            <span class="text-xl">→</span>
                        </a>
                        <a href="{{ route('login') }}" class="btn-ghost text-lg px-10 py-4">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="card p-8 text-center hover:scale-105 transition-transform">
                        <div class="text-5xl sm:text-6xl font-extrabold text-gradient mb-3">1000+</div>
                        <div class="text-slate-400 font-medium">Stories Created</div>
                    </div>
                    <div class="card p-8 text-center hover:scale-105 transition-transform">
                        <div class="text-5xl sm:text-6xl font-extrabold text-gradient mb-3">50+</div>
                        <div class="text-slate-400 font-medium">Themes Available</div>
                    </div>
                    <div class="card p-8 text-center hover:scale-105 transition-transform">
                        <div class="text-5xl sm:text-6xl font-extrabold text-gradient mb-3">100%</div>
                        <div class="text-slate-400 font-medium">AI-Powered</div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="bg-slate-900/50 py-20 relative">
                <div class="container-app">
                    <div class="text-center mb-16">
                        <h2 class="heading-lg mb-4">
                            Everything You Need to Create <span class="text-gradient">Magic</span>
                        </h2>
                        <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                            Powered by cutting-edge AI technology to bring imagination to life
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Feature 1 -->
                        <div class="card p-6 hover:scale-105 transition-transform">
                            <div class="text-5xl mb-4">📚</div>
                            <h3 class="text-xl font-bold text-white mb-3">AI-Generated Stories</h3>
                            <p class="text-slate-400 leading-relaxed">Unique, personalized narratives created by GPT-4, tailored to your child's interests</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="card p-6 hover:scale-105 transition-transform">
                            <div class="text-5xl mb-4">🎨</div>
                            <h3 class="text-xl font-bold text-white mb-3">Beautiful Illustrations</h3>
                            <p class="text-slate-400 leading-relaxed">Stunning custom artwork generated by DALL-E 3 for every scene in your story</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="card p-6 hover:scale-105 transition-transform">
                            <div class="text-5xl mb-4">🎙️</div>
                            <h3 class="text-xl font-bold text-white mb-3">Voice Narration</h3>
                            <p class="text-slate-400 leading-relaxed">Professional AI voice narration in 6 different styles to bring stories to life</p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="card p-6 hover:scale-105 transition-transform">
                            <div class="text-5xl mb-4">🎬</div>
                            <h3 class="text-xl font-bold text-white mb-3">Video Stories</h3>
                            <p class="text-slate-400 leading-relaxed">Engaging animated videos that combine images, narration, and music</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="py-20 relative">
                <div class="container-app">
                    <div class="card-gradient p-12 sm:p-16 text-center max-w-4xl mx-auto">
                        <h2 class="heading-lg mb-4">
                            Ready to Create <span class="text-gradient">Magic</span>?
                        </h2>
                        <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto leading-relaxed">
                            Start generating personalized, AI-powered stories for your children today. No credit card required!
                        </p>
                        <a href="{{ route('register') }}" class="btn-primary text-lg px-12 py-5 inline-flex items-center gap-3">
                            <span class="text-2xl">🎨</span>
                            <span class="font-bold">Create Your First Story</span>
                            <span class="text-2xl">→</span>
                        </a>
                        <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-sm text-slate-400">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                No credit card
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Free to start
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Cancel anytime
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
