<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 container mx-auto px-4 py-8"> 
        @foreach ($products as $product)
            <div x-data="{ shown: false }" 
                 x-intersect="shown = true"
                 :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }"
                 class="transition-all duration-700 ease-in-out flex justify-center">
                <x-product-card :key="$product->id" :product="$product" />
            </div>
        @endforeach
    </div>
</div> 