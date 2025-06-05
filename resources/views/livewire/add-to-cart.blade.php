<div>
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 gap-4 lg:gap-8 max-w-7xl mx-auto">

        <div class="w-full lg:w-1/2">
            @if($product->images->first())
            <img src="{{ $this->getCurrentImageUrl() }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-md mb-4">
            @else
            <img src="https://placehold.co/600x400" alt="No Image Available" class="w-full rounded-lg shadow-md mb-4">
            @endif
            @if($product->images->count() > 1)
                <div class="flex gap-2 overflow-x-auto">
                    @foreach($product->images as $image)
                        <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}"
                             class="size-16 lg:size-20 cursor-pointer rounded border hover:border-primary-500 flex-shrink-0 {{ $currentImage == $image->image ? 'border-primary-500 border-2' : '' }}"
                             wire:click="changeImage('{{ $image->image }}')">
                    @endforeach
                </div>
            @endif
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="text-xl lg:text-2xl font-bold text-black dark:text-white">{{ $product->name }}</h1>
            <p class="text-black dark:text-white">{{ $product->price }}€</p>
            <div class="text-black dark:text-white mt-5 prose prose-sm max-w-none dark:prose-invert">{!! $product->description !!}</div>




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
          <div class="flex flex-col gap-4">
            <flux:select wire:model="size" class="mt-5" placeholder="{{ __('Select size') }}">
                @foreach (explode(',', $product->variant) as $variant)
                    <flux:select.option class="text-black dark:text-white dark:bg-zinc-800" label="{{ $variant }}" value="{{ $variant }}" />
                @endforeach
            </flux:select>

            <div class="mt-5">
                <flux:button variant="primary" wire:click="addToCart" :disabled="$product->stock <= 0" class="w-full sm:w-auto">{{ __('Add to cart') }}</flux:button>
            </div>

            
          </div>
        </div>
    </div>
    @if($this->getSimilarProducts()->count() > 0)
    <h1 class="mt-20 lg:mt-80 text-xl lg:text-2xl font-bold text-black dark:text-white flex justify-center">{{ __('Similar products') }}</h1>
   
    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6 mx-auto mb-10 p-4 lg:p-8 justify-items-center max-w-7xl">
  
        @foreach($this->getSimilarProducts() as $similarProduct)
        <div class="w-full">
            <x-product-card :product="$similarProduct" />
        </div>
        @endforeach
        @endif
    </div>
</div>
