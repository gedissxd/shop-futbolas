<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        
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
        
        <x-footer />
        
        @fluxScripts
    </body>
</html>
