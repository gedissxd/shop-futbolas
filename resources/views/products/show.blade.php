<x-layout>

    <div class="flex p-16 mt-16">
        
        <img src="https://placehold.co/600x400" alt="{{ $product->name }}" class="w-1/2 mr-16 rounded-lg">
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
<flux:modal.trigger name="add-to-cart">
    <flux:button>Add to cart</flux:button>
</flux:modal.trigger>

<flux:modal name="add-to-cart" variant="flyout">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Cart</flux:heading>
            <flux:subheading>Products in your cart</flux:subheading>
        </div>

       

        <div class="flex">
            <flux:spacer />

            <flux:button type="submit" variant="primary" class="w-full" href="{{ route('cart') }}">Checkout</flux:button>
        </div>
    </div>
    
</flux:modal>
</div>
</div>
        </div>
    </div>
</x-layout>

