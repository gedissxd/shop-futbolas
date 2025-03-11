<div>
    <div class="flex p-16 mt-16">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-1/2 mr-16 rounded-lg">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold text-white">{{ $product->name }}</h1>
            <p class="text-white mt-5">{{ $product->description }}</p>
            <p class="text-white">{{ $product->price }}€</p>
            
            @if (session()->has('message'))
                <div class="p-4 mb-4 mt-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @error('size') 
                <div class="p-4 mb-4 mt-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ $message }}
                </div>
            @enderror
            
            <div class="mt-5">
                <flux:select wire:model="size" placeholder="Choose size...">
                    <flux:select.option value="S">S</flux:select.option>
                    <flux:select.option value="M">M</flux:select.option>
                    <flux:select.option value="L">L</flux:select.option>
                    <flux:select.option value="XL">XL</flux:select.option>
                </flux:select>
            </div>

            
            <div class="mt-5">
               <flux:button wire:click="addToCart">Add to cart</flux:button>
               
            </div>
        </div>
    </div>
</div>
