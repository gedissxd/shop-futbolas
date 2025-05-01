<div>
    <div class="flex p-8 gap-8 max-w-7xl mx-auto">

        <div class="w-1/2">
            <img src="{{ $this->getCurrentImageUrl() }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-md mb-4">
            @if($product->images->count() > 1)
                <div class="flex gap-2">
                    @foreach($product->images as $image)
                        <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}"
                             class="size-20 cursor-pointer rounded border hover:border-primary-500 {{ $currentImage == $image->image ? 'border-primary-500 border-2' : '' }}"
                             wire:click="changeImage('{{ $image->image }}')">
                    @endforeach
                </div>
            @endif
        </div>
        <div class="w-1/2">
            <h1 class="text-2xl font-bold text-black dark:text-white">{{ $product->name }}</h1>
            <div class="mt-2">
                {{ $product->stock > 0 ? __('In stock: ') . $product->stock : __('Out of stock') }}
            </div>
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
            <flux:radio.group wire:model="size" variant="segmented" class="mt-5 shadow-md w-fit">
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
    @if($this->getSimilarProducts())
    <h1 class="text-2xl font-bold text-black dark:text-white flex justify-center">{{ __('Similar products') }}</h1>
   
    <div class="mt-5 flex gap-4  mx-auto mb-10 ml-10 justify-center">
  
        @foreach($this->getSimilarProducts() as $similarProduct)
        <div class="flex">
            <x-product-card :product="$similarProduct" />
        </div>
        @endforeach
        @endif
    </div>
</div>
