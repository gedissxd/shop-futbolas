<x-layout title="Shop">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:grid-cols-4 lg:grid-cols-3 justify-center mx-auto mb-10 p-16"> 
        @foreach ($products as $product)
            <div x-data="{ shown: false }" 
                 x-intersect="shown = true"
                 :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }"
                 class="transition-all duration-700 ease-in-out">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
</x-layout>

