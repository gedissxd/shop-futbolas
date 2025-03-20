<x-layout title="Shop">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 justify-center mx-auto  mb-10 p-16"> 
        @foreach ($products as $product)
        <a href="{{ route('products.show', $product->id) }}" wire:navigate>
         <div class="bg-white  w-full rounded-lg">
            <div class="w-full h-48 overflow-hidden h-[360px]">
                <img src="{{ $product->image }}" alt="Product Image" class="w-full h-full object-cover rounded-t-lg">
            </div>
            
            <div class="p-4  flex flex-col">
                <h2 class="text-lg font-medium text-gray-800 mb-1">{{ $product->name }}</h2>
                
                <div class="mt-auto">
                    <p class="text-lg font-bold text-gray-900">{{ $product->price }}€</p>
                </div>
            </div>
        </div>
    </a>
        @endforeach
    </div>
</x-layout>

