<x-layout>
    <div class="flex p-16">
        <img src="https://placehold.co/600x400" alt="{{ $product->name }}" class="w-1/2 mr-16">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
            <p class="text-white mt-5">{{ $product->description }}</p>
            <p class="text-white">{{ $product->price }}</p>
            <form action="">
            
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

            <flux:button type="submit" variant="primary" class="w-full">Checkout</flux:button>
        </div>
    </div>
</flux:modal>
            </form>
        </div>
    </div>
</x-layout>

