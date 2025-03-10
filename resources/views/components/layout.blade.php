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
        <flux:navbar class="flex justify-between items-center {{ $hasVideo ?? false ? 'bg-transparent' : 'bg-blue-900' }} h-18 absolute top-0 left-0 right-0 z-10">
            <div class="ml-4">
                <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-25">
            </div>
            <div class="flex items-center justify-center flex-grow gap-2">
                <flux:navbar.item href="{{ route('home') }}" icon="home" class="duration-300 hover:bg-blue-400!" >Home</flux:navbar.item>
                <flux:navbar.item href="{{ route('products') }}" icon="shopping-cart" class="duration-300 hover:bg-blue-400!" >Shop</flux:navbar.item>
                <flux:navbar.item href="{{ route('cart') }}" icon="shopping-bag" class="duration-300 hover:bg-blue-400!" >Cart (0)</flux:navbar.item>
                
                
            </div>
            <div class="flex items-center mr-4">
                @auth
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="duration-300  text-gray-200 hover:bg-blue-400 py-2 px-4 rounded-md font-semibold text-sm">Logout</button>
                </form>
                @endauth
                @if (Auth::user()->is_admin)
                <flux:navbar.item href="{{ route('dashboard') }}" class="duration-300 hover:bg-blue-400!">Dashboard</flux:navbar.item>
                @endif
                
                
                @guest
                <flux:navbar.item href="{{ route('login') }}" class="duration-300 hover:bg-blue-400!">Login</flux:navbar.item>
                <flux:navbar.item href="{{ route('register') }}" class="duration-300 hover:bg-blue-400!">Register</flux:navbar.item>
                @endguest
            </div>
        </flux:navbar>

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
