<x-layout title="Home">
    <div class="relative">
        <video src="{{ asset('video/kick.mp4') }}" autoplay muted loop class="w-full h-[700px] object-cover"></video>
        <div class="absolute inset-0 flex items-center justify-center">
            <flux:button variant="primary" class="text-white">Start shopping</flux:button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 justify-center mx-auto  mb-10 p-16"> 
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</x-layout>
