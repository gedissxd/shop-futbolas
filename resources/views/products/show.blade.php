<x-layout>
    <div class="flex p-16 mt-16">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-1/2 mr-16 rounded-lg">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold text-white">{{ $product->name }}</h1>
            <p class="text-white mt-5">{{ $product->description }}</p>
            <p class="text-white">{{ $product->price }}€</p>
            
            <div class="mt-5">
                <flux:select wire:model="size" placeholder="Choose size...">
                    <flux:select.option>S</flux:select.option>
                    <flux:select.option>M</flux:select.option>
                    <flux:select.option>L</flux:select.option>
                    <flux:select.option>XL</flux:select.option>
                </flux:select>
            </div>
            <div class="mt-5">
                <flux:button wire:click="addToCart">Add to cart</flux:button>
            </div>
        </div>
    </div>
</x-layout>

