<a href="{{ route('products.show', $product->name) }}" wire:navigate.hover class="block w-full h-full text-black dark:text-white hover:scale-102 transition-all duration-300">
    <div class="rounded-lg h-full flex flex-col overflow-hidden">
        <!-- Product Image -->
        <div class="w-full aspect-square overflow-hidden">
            @if($product->images->first())
                <img src="{{ $product->images->first()->getUrl() }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover rounded-lg">
            @else
                <img src="https://placehold.co/400x400/f3f4f6/9ca3af?text=No+Image" 
                     alt="No Image Available" 
                     class="w-full h-full object-cover rounded-lg">
            @endif
        </div>
        
        <!-- Product Info -->
        <div class="p-4 flex flex-col flex-grow space-y-2">
            <!-- Product Name -->
            <h3 class="text-sm font-medium line-clamp-2 leading-tight">
                {{ $product->name }}
            </h3>
            
            <!-- Price -->
            <div class="mt-auto">
                <p class="text-lg font-bold">
                    {{ number_format($product->price, 0) }}€
                </p>
            </div>
        </div>
    </div>
</a>