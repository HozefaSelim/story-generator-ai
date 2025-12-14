<header class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur-md border-b border-slate-800/50">
    <nav class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="flex items-center justify-between h-24">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <span class="text-3xl sm:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-400">
                    stories
                </span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                @auth
                    <a href="{{ route('stories.index') }}" class="text-white/90 hover:text-white font-medium transition-colors">
                        Examples
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-white/90 hover:text-white font-medium transition-colors">
                        Pricing
                    </a>
                    
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 text-white/90 hover:text-white font-medium transition-colors">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute right-0 mt-3 w-56 rounded-xl border border-cyan-500/30 shadow-2xl shadow-black/80 overflow-hidden"
                             style="display: none; background: #0f172a;">
                            <div class="px-4 py-3 border-b border-slate-700/50" style="background: #1e293b;">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-cyan-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-2" style="background: #0f172a;">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-200 hover:text-cyan-300 hover:bg-cyan-500/10 transition-colors">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('stories.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-200 hover:text-cyan-300 hover:bg-cyan-500/10 transition-colors">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    My Stories
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-200 hover:text-cyan-300 hover:bg-cyan-500/10 transition-colors">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>
                            </div>
                            <div class="border-t border-slate-700/50 py-2" style="background: #0f172a;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('stories.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-full font-semibold shadow-lg hover:shadow-xl hover:shadow-blue-500/30 hover:scale-105 transition-all duration-300">
                        Generate your story
                    </a>
                @else
                    <a href="{{ route('stories.index') }}" class="text-white/90 hover:text-white font-medium transition-colors">
                        Examples
                    </a>
                    <a href="#pricing" class="text-white/90 hover:text-white font-medium transition-colors">
                        Pricing
                    </a>
                    <a href="{{ route('login') }}" class="text-white/90 hover:text-white font-medium transition-colors">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-full font-semibold shadow-lg hover:shadow-xl hover:shadow-blue-500/30 hover:scale-105 transition-all duration-300">
                        Generate your story
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden p-2 rounded-lg bg-white/10 backdrop-blur-sm hover:bg-white/20" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-4 space-y-2">
            @auth
                <a href="{{ route('stories.index') }}" class="block px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                    Examples
                </a>
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                    Profile
                </a>
                <a href="{{ route('stories.create') }}" class="block px-4 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold text-center">
                    Generate your story
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('stories.index') }}" class="block px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                    Examples
                </a>
                <a href="#pricing" class="block px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                    Pricing
                </a>
                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-white hover:bg-white/10 transition-colors">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold text-center">
                    Generate your story
                </a>
            @endauth
        </div>
    </nav>
</header>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
