<div>
    <flux:navbar class="flex justify-between items-center {{ $hasVideo ?? false ? 'bg-transparent' : 'bg-blue-900' }} h-18 absolute top-0 left-0 right-0 z-10">
            <div class="ml-4">
                <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-25">
            </div>
            <div class="flex items-center justify-center flex-grow gap-2">
                <flux:navbar.item href="{{ route('home') }}" icon="home" class="duration-300 hover:bg-blue-400!" wire:navigate>Home</flux:navbar.item>
                <flux:navbar.item href="{{ route('products') }}" icon="shopping-cart" class="duration-300 hover:bg-blue-400!" wire:navigate>Shop</flux:navbar.item>
                <flux:navbar.item href="{{ route('cart') }}" icon="shopping-bag" class="duration-300 hover:bg-blue-400!" wire:navigate>Cart ({{ $cartCount }})</flux:navbar.item>
                
                
            </div>
            <div class="flex items-center mr-4">
                @auth
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="duration-300  text-gray-200 hover:bg-blue-400 py-2 px-4 rounded-md font-semibold text-sm">Logout</button>
                </form>
                @endauth
                @if (Auth::user()->is_admin ?? false)
                <flux:navbar.item href="{{ route('dashboard') }}" class="duration-300 hover:bg-blue-400!">Dashboard</flux:navbar.item>
                @endif
                
                
                @guest
                <flux:navbar.item href="{{ route('login') }}" class="duration-300 hover:bg-blue-400!">Login</flux:navbar.item>
                <flux:navbar.item href="{{ route('register') }}" class="duration-300 hover:bg-blue-400!">Register</flux:navbar.item>
                @endguest
            </div>
        </flux:navbar>
</div>
