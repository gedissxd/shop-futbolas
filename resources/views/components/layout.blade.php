<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite('resources/css/app.css')

    </head>
    <body class="bg-gray-100">
        <flux:navbar class="flex justify-center p-10!">
    <flux:navbar.item href="{{ route('home') }}" class="duration-300  ease-in-out hover:bg-sky-400!">Home</flux:navbar.item>
    <flux:navbar.item href="{{ route('products') }}" class="hover:bg-sky-400!">Shop</flux:navbar.item>
    <flux:navbar.item href="{{ route('cart') }}" class="hover:bg-sky-400">Cart</flux:navbar.item>
    <flux:navbar.item href="{{ route('about') }}">About</flux:navbar.item>
    <flux:navbar.item href="{{ route('login') }}">Login</flux:navbar.item>
    <flux:navbar.item href="{{ route('register') }}">Register</flux:navbar.item>
    <flux:navbar.item href="{{ route('logout') }}">Logout</flux:navbar.item>
    <flux:navbar.item href="{{ route('dashboard') }}" icon="shopping-cart">Dashboard</flux:navbar.item>
    </flux:navbar>

        {{ $slot }}
    </body>
</html>
