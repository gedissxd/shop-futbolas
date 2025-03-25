<div>
    <div class="flex p-8">
        
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-1/2 mr-16 rounded-lg">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold text-white">{{ $product->name }}</h1>
            <p class="text-white mt-5">{{ $product->description }}</p>
            <p class="text-white">{{ $product->price }}€</p>
            
            <div class="mt-2">
                {{ $product->stock > 0 ? __('In stock: ') . $product->stock : __('Out of stock') }}
            </div>
            
            @if ($message)
            <div x-data="{ show: true }" 
                 x-init="setTimeout(() => { show = false; $wire.set('message', null); }, 1000)" 
                 x-show="show"
                 class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" 
                 role="alert">
                {{ $message }}
            </div>
            @endif

            @error('size') 
                <div class="p-4 mb-4 mt-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ $message }}
                </div>
            @enderror
          
            
           
            <flux:radio.group wire:model="size" variant="segmented" class="mt-5">
                @foreach (explode(',', $product->variant) as $variant)
                    <flux:radio label="{{ $variant }}" value="{{ $variant }}" />
                @endforeach
            </flux:radio.group>
            
            <div class="mt-5">
                <flux:button variant="primary" wire:click="addToCart" :disabled="$product->stock <= 0">{{ __('Add to cart') }}</flux:button>
            </div>
        </div>
    </div>
</div>
