<x-app-layout>
    <div class="py-12">
        <div class="container-app">
            <!-- Hero Welcome Card -->
            <div class="relative overflow-hidden card-gradient p-12 mb-10">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
                
                <div class="relative flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="flex-1">
                        <div class="inline-block px-4 py-2 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-full border border-indigo-500/30 mb-4">
                            <span class="text-sm font-bold text-indigo-300">✨ AI-Powered Storytelling</span>
                        </div>
                        <h3 class="text-4xl lg:text-5xl font-extrabold mb-4">
                            Ready to Create <span class="text-gradient">Magic</span>?
                        </h3>
                        <p class="text-slate-300 text-lg mb-8 max-w-2xl leading-relaxed">
                            Transform your ideas into beautiful, illustrated stories with AI. Perfect for children's education, entertainment, and imagination.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('stories.create') }}" class="btn-primary px-10 py-5 text-lg group">
                                <span class="text-2xl">✨</span>
                                <span>Create New Story</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="{{ route('stories.index') }}" class="btn-ghost px-10 py-5 text-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                View My Stories
                            </a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-48 h-48 lg:w-64 lg:h-64 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-2xl shadow-indigo-500/50 rotate-3 hover:rotate-6 transition-transform duration-500">
                            <span class="text-9xl">📚</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="card p-8 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-4xl font-extrabold text-gradient">0</div>
                        </div>
                    </div>
                    <div class="text-slate-400 font-semibold">Stories Created</div>
                </div>

                <div class="card p-8 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-4xl font-extrabold text-gradient">12</div>
                        </div>
                    </div>
                    <div class="text-slate-400 font-semibold">Themes Available</div>
                </div>

                <div class="card p-8 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-4xl font-extrabold text-gradient">8</div>
                        </div>
                    </div>
                    <div class="text-slate-400 font-semibold">Visual Styles</div>
                </div>

                <div class="card p-8 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-4xl font-extrabold text-gradient">∞</div>
                        </div>
                    </div>
                    <div class="text-slate-400 font-semibold">Possibilities</div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div>
                <h3 class="heading-md mb-6 flex items-center gap-3">
                    <span>🚀</span>
                    Quick Actions
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- View Stories -->
                    <a href="{{ route('stories.index') }}" class="card p-8 hover:scale-105 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 group">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-white mb-2 group-hover:text-gradient transition-colors">My Stories</h4>
                                <p class="text-slate-400 text-sm leading-relaxed">Browse and manage all your created stories</p>
                            </div>
                        </div>
                    </a>

                    <!-- Create Story -->
                    <a href="{{ route('stories.create') }}" class="card p-8 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-300 group">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-white mb-2 group-hover:text-gradient transition-colors">New Story</h4>
                                <p class="text-slate-400 text-sm leading-relaxed">Start creating a new AI-powered story</p>
                            </div>
                        </div>
                    </a>

                    <!-- Profile Settings -->
                    <a href="{{ route('profile.edit') }}" class="card p-8 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-300 group">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-white mb-2 group-hover:text-gradient transition-colors">Settings</h4>
                                <p class="text-slate-400 text-sm leading-relaxed">Manage your account and preferences</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
