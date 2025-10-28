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
                    <div class="relative group">
                        <button class="text-white/90 hover:text-white font-medium transition-colors">
                            {{ Auth::user()->name }}
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 rounded-2xl bg-white/10 backdrop-blur-lg border border-white/20 shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-white hover:bg-white/10 rounded-t-2xl transition-colors">
                                Dashboard
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-white hover:bg-white/10 transition-colors">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-white hover:bg-white/10 rounded-b-2xl transition-colors">
                                    Log Out
                                </button>
                            </form>
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
