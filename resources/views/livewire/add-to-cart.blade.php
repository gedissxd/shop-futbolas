<div>
    <div class="flex p-8">
        
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-1/2 mr-16 rounded-lg">
        <div class="w-1/2">
            <h1 class="text-2xl font-bold text-white">{{ $product->name }}</h1>
            <p class="text-white mt-5">{{ $product->description }}</p>
            <p class="text-white">{{ $product->price }}€</p>
            
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
            <flux:radio.group wire:model="color" class="flex gap-4 mt-5">
            <flux:radio value="red" label="Red"/>
            <flux:radio value="blue" label="Blue" />
            <flux:radio value="green" label="Green" />
            </flux:radio.group>
            
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
