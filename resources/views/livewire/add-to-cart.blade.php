<div>
    <div class="flex p-8">
        
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-1/2 mr-16 rounded-lg shadow-md">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold text-black dark:text-white">{{ $product->name }}</h1>
            <p class="text-black dark:text-white mt-5">{{ $product->description }}</p>
            <p class="text-black dark:text-white">{{ $product->price }}€</p>
            
            <div class="mt-2">
                {{ $product->stock > 0 ? __('In stock: ') . $product->stock : __('Out of stock') }}
            </div>
            
            @if ($message)
            <div x-data="{ show: true }" 
            x-init="setTimeout(() => { show = false; $wire.set('message', null); }, 1000)" 
            x-show="show">
            <flux:callout variant="success" icon="check-circle" heading="{{ __($message) }}" class="mt-5"/>
            </div>
            

            @endif

            @error('size') 
            <flux:callout variant="danger" icon="x-circle" heading="{{ __($message) }}" class="mt-5" />

            @enderror
          
            
           
            <flux:radio.group wire:model="size" variant="segmented" class="mt-5 shadow-md">
                @foreach (explode(',', $product->variant) as $variant)
                    <flux:radio label="{{ $variant }}" value="{{ $variant }}" />
                @endforeach
            </flux:radio.group>
            
            <div class="mt-5">
                <flux:button variant="primary" wire:click="addToCart" :disabled="$product->stock <= 0" >{{ __('Add to cart') }}</flux:button>
            </div>
        </div>
    </div>
</div>
