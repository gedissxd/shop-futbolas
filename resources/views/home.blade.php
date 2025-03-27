<x-layout title="Home">
    <div class="relative">
         <video src="{{ asset('video/kick.mp4') }}" autoplay muted loop class="w-full h-[700px] object-cover"></video>
        <div class="absolute inset-0 flex items-center justify-center">
            <flux:button variant="primary" class="text-white" href="{{ route('products') }}" wire:navigate >{{ __('Start shopping') }}</flux:button>
        </div>
    </div>
    <h1 class="text-center text-2xl font-bold mt-10">{{ __('Featured products') }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:grid-cols-4 lg:grid-cols-3 justify-center mx-auto  mb-10 p-16"> 
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</x-layout>
