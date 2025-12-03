<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[var(--bg)] text-[var(--text)]">
            <x-site-header />

            <!-- Add padding for fixed header -->
            <div class="pt-24">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-slate-900/60 border-b border-slate-800">
                        <div class="container-app py-4 sm:py-6">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="pb-6 container-app">
                    {{ $slot }}
                </main>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>
