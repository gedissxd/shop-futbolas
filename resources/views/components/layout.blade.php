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
    <body class="bg-gray-600 min-h-screen flex flex-col overflow-y-scroll">
        <flux:navbar class="flex justify-between items-center bg-blue-300 h-15">
            <div class="ml-4">
                <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-20">
            </div>
            <div class="flex items-center justify-center flex-grow gap-2">
                <flux:navbar.item href="{{ route('home') }}" icon="home" class="duration-300 hover:bg-blue-400!" >Home</flux:navbar.item>
                <flux:navbar.item href="{{ route('products') }}" icon="shopping-cart" class="duration-300 hover:bg-blue-400!" >Shop</flux:navbar.item>
                
                
            </div>
            <div class="flex items-center mr-4">
                @auth
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="duration-300 bg-blue-300 text-gray-200 hover:bg-blue-400 py-2 px-4 rounded-md font-semibold text-sm">Logout</button>
                </form>
                <flux:navbar.item href="{{ route('dashboard') }}" class="duration-300 hover:bg-blue-400!">Dashboard</flux:navbar.item>
                @endauth
                @guest
                <flux:navbar.item href="{{ route('login') }}" class="duration-300 hover:bg-blue-400!">Login</flux:navbar.item>
                <flux:navbar.item href="{{ route('register') }}" class="duration-300 hover:bg-blue-400!">Register</flux:navbar.item>
                @endguest
            </div>
        </flux:navbar>

        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        <footer class="bg-blue-300 h-15 w-full">
            <div class="flex items-center justify-center h-full">
                <p class="text-gray-200 text-sm"></p>
            </div>
        </footer>
        
        @fluxScripts
    </body>
</html>
