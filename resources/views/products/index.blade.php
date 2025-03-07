<x-layout>

  <div class="grid grid-cols-4 gap-4 justify-center max-w-7xl mx-auto mt-10 mb-10"> 
    @foreach ($products as $product)
    <a href="{{ route('products.show', $product->id) }}" >
     <div class="bg-white rounded-lg overflow-hidden w-full h-[360px] border border-gray-200">
        <div class="w-full h-48 overflow-hidden">
            <img src="https://placehold.co/600x400" alt="Product Image" class="w-full h-full object-cover">
        </div>
        
        <div class="p-4 h-[150px] flex flex-col">
            <h2 class="text-lg font-medium text-gray-800 mb-1">{{ $product->name }}</h2>
            <p class="text-gray-500 text-sm mb-3 overflow-y-auto flex-grow line-clamp-3">{{ $product->description }}</p>
            
            <div class="mt-auto">
                <p class="text-lg font-bold text-gray-900">${{ $product->price }}</p>
            </div>
        </div>
    </div>
</a>
    @endforeach
</div>
</x-layout>

