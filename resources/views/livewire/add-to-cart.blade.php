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

            <div class="mt-5 space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Variants:</h3>
                    @if($product->variants->isEmpty())
                        <p class="text-sm text-gray-500 dark:text-gray-400">This product currently has no variants.</p>
                    @else
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($product->variants as $variant)
                                <button
                                    type="button"
                                    wire:click="setSelectedVariant({{ $variant->id }})"
                                    class="px-4 py-2 border rounded-md text-sm font-medium focus:outline-none
                                        {{ $selectedVariantId == $variant->id
                                            ? 'bg-primary-600 text-white border-primary-600 ring-2 ring-primary-500'
                                            : 'bg-white dark:bg-zinc-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-600' }}
                                        {{ $variant->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                    {{ $variant->name }}
                                    @if($variant->stock <= 0) (Out of stock) @endif
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($this->selectedVariant)
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Stock for {{ $this->selectedVariant->name }}: {{ $this->selectedVariant->stock }}
                    </p>
                @elseif($product->variants->isNotEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">Please select a variant to see stock information.</p>
                @endif

                {{-- Quantity Input (Optional, could be added if needed) --}}
                {{-- <div class="mt-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                    <input type="number" id="quantity" name="quantity" wire:model="quantity" min="1"
                           class="mt-1 block w-20 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                </div> --}}

                <div class="mt-6">
                    <flux:button
                        variant="primary"
                        wire:click="addToCart"
                        :disabled="!$this->selectedVariant || $this->selectedVariant->stock <= 0 || $this->selectedVariant->stock < $this->quantity"
                        class="w-full sm:w-auto">
                        {{ __('Add to cart') }}
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
    @if($this->getSimilarProducts()->count() > 0)
    <h1 class="mt-20 lg:mt-80 text-xl lg:text-2xl font-bold text-black dark:text-white flex justify-center">{{ __('Similar products') }}</h1>
   
    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6 mx-auto mb-10 p-4 lg:p-8 justify-items-center max-w-7xl">
        @foreach($this->getSimilarProducts() as $similarProduct)
            <div class="w-full">
                <x-product-card :product="$similarProduct" /> {{-- Assuming product-card is updated or does not rely on old stock/variant structure --}}
            </div>
        @endforeach
    @endif
    </div>
</div>
