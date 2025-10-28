<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Header Navigation -->
    <header class="absolute top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center">
                <span class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent">stories</span>
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-medium">Home</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-purple-600 font-medium">Dashboard</a>
                @endauth
            </div>
        </nav>
    </header>
    
    <div class="flex min-h-screen pt-16">
        <!-- Left Side - Image Carousel -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-purple-600 via-blue-600 to-cyan-500">
            <div id="imageCarousel" class="absolute inset-0 transition-opacity duration-1000">
                <!-- Image 1 -->
                <div class="carousel-item active absolute inset-0">
                    <img src="/images/auth-slide-1.jpg" alt="Join Our Community" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                </div>
                <!-- Image 2 -->
                <div class="carousel-item absolute inset-0 opacity-0">
                    <img src="/images/auth-slide-2.jpg" alt="Personalized Characters" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                </div>
                <!-- Image 3 -->
                <div class="carousel-item absolute inset-0 opacity-0">
                    <img src="/images/auth-slide-3.jpg" alt="Educational & Fun" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                </div>
            </div>

            <!-- Typing Input Box -->
            <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 w-[90%] max-w-2xl z-20">
                <div class="bg-white rounded-2xl shadow-2xl p-3">
                    <div class="flex items-center gap-3">
                        <!-- Plus Icon -->
                        <button type="button" class="flex-shrink-0 text-gray-600 hover:text-gray-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                        
                        <!-- Input -->
                        <input type="text" id="carouselTyping" readonly
                            class="flex-1 px-3 py-3 text-black text-base bg-white rounded-xl border-0 focus:outline-none cursor-default font-normal"
                            value=""
                            style="background-color: white !important; color: black !important;">
                        
                        <!-- Microphone Icon -->
                        <button type="button" class="flex-shrink-0 text-gray-600 hover:text-gray-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                            </svg>
                        </button>
                        
                        <!-- Send Icon -->
                        <button type="button" class="flex-shrink-0 bg-black text-white rounded-lg p-2 hover:bg-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Carousel Indicators -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
                <button class="carousel-indicator w-2 h-2 rounded-full bg-white active" data-index="0"></button>
                <button class="carousel-indicator w-2 h-2 rounded-full bg-white/40" data-index="1"></button>
                <button class="carousel-indicator w-2 h-2 rounded-full bg-white/40" data-index="2"></button>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Create Account</h2>
                    <p class="text-gray-600 text-sm">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">Login</a>
                    </p>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition-all duration-200"
                            style="background-color: white !important; color: black !important;"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition-all duration-200"
                            style="background-color: white !important; color: black !important;"
                            placeholder="yourname@mail.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition-all duration-200"
                                style="background-color: white !important; color: black !important;"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition-all duration-200"
                                style="background-color: white !important; color: black !important;"
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full px-6 py-4 bg-black text-white rounded-full font-semibold hover:bg-gray-800 transition-all duration-300 mt-6">
                        Create Account
                    </button>

                    <!-- Terms -->
                    <p class="text-xs text-gray-500 text-center mt-4">
                        By registering, you agree to our <a href="#" class="text-blue-600 hover:text-blue-700">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-blue-700">Privacy Policy</a>
                    </p>
                </form>

                <!-- Social Login -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">or sign up with</span>
                        </div>
                    </div>

                    <button type="button" class="mt-4 w-full flex items-center justify-center gap-3 px-6 py-3 border border-gray-200 rounded-lg bg-white hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="text-gray-700 font-medium">Sign up with Google</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Typing animation for carousel texts
        const typingTexts = [
            "Join Our Community",
            "Personalized Characters",
            "Educational & Fun"
        ];
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeEffect() {
            const input = document.getElementById('carouselTyping');
            const currentText = typingTexts[textIndex];

            if (!isDeleting) {
                input.value = currentText.substring(0, charIndex + 1);
                charIndex++;

                if (charIndex === currentText.length) {
                    isDeleting = true;
                    setTimeout(typeEffect, 2000); // Pause at end
                    return;
                }
            } else {
                input.value = currentText.substring(0, charIndex - 1);
                charIndex--;

                if (charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % typingTexts.length;
                    setTimeout(typeEffect, 500); // Pause before next
                    return;
                }
            }

            setTimeout(typeEffect, isDeleting ? 50 : 100);
        }

        // Start typing effect
        typeEffect();

        // Image Carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const indicators = document.querySelectorAll('.carousel-indicator');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? '1' : '0';
            });
            indicators.forEach((indicator, i) => {
                if (i === index) {
                    indicator.classList.add('active', 'bg-white');
                    indicator.classList.remove('bg-white/40');
                } else {
                    indicator.classList.remove('active', 'bg-white');
                    indicator.classList.add('bg-white/40');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Auto-advance slides every 4 seconds
        setInterval(nextSlide, 4000);

        // Manual navigation
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
