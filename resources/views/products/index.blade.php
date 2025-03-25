<x-layout title="Shop">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:grid-cols-4 lg:grid-cols-3 justify-center mx-auto  mb-10 p-16"> 
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</x-layout>

