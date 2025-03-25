<x-layout title="Shop">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 justify-center mx-auto  mb-10 p-16"> 
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</x-layout>

