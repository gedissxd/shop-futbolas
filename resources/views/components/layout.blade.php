<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Laravel' }}</title>
        <link rel="icon" href="{{ asset('svg/logo no background fill.svg') }}" class="size-32">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
 
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @fluxAppearance
    </head>
    <body class="bg-white dark:bg-zinc-900 min-h-screen flex flex-col">
        <livewire:nav-bar />

        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        <footer class="border-t border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
            <div class="container mx-auto px-6 py-8">
                <div class="flex flex-col items-center justify-center gap-6 text-center">
                    <!-- Logo Section -->
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-24">
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="text-center">
                        <h3 class="font-semibold text-lg mb-3 text-zinc-800 dark:text-zinc-200">{{ __('Contact Us') }}</h3>
                        <div class="space-y-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <span>info@futbolas.com</span>
                            </div>
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span>+370 600 12345</span>
                            </div>
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Vilnius, Lithuania</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        @fluxScripts
    </body>
</html>
