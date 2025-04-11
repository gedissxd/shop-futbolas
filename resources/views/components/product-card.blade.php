<a href="{{ route('products.show', $product->id) }}" wire:navigate.hover>
    <div class="bg-white  w-full rounded-lg">
       <div class="w-full h-48 overflow-hidden h-[360px]">
        @if($product->images->first())
           <img src="{{ asset($product->images->first()->image) }}" alt="Product Image" class="w-full h-full object-cover rounded-t-lg">
        @endif
       </div>
       
       <div class="p-4  flex flex-col">
           <h2 class="text-lg font-medium text-gray-800 mb-1">{{ $product->name }}</h2>
           
           <div class="mt-auto">
               <p class="text-lg font-bold text-gray-900">{{ $product->price }}€</p>
           </div>
       </div>
   </div>
</a>