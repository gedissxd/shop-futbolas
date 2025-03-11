<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="icon" href="{{ asset('svg/logo no background fill.svg') }}">
 
        @vite('resources/css/app.css')
        @fluxAppearance
    </head>
    <body class="bg-zinc-900 min-h-screen flex flex-col overflow-y-scroll">
        <livewire:nav-bar />

        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        <footer class="bg-blue-900  w-full">
            
            <div class="flex justify-between">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-25">
                </div>
          
            </div>
        </footer>
        
        @fluxScripts
    </body>
</html>
