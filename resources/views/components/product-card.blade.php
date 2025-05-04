<a href="{{ route('products.show', $product->id) }}" wire:navigate.hover>
    <div class="bg-white w-[430px] rounded-lg">
       <div class="w-full h-[360px] overflow-hidden">
        
        @if($product->images->first())
           <img src="{{ $product->images->first()->getUrl() }}" alt="Product Image" class="w-full h-full object-cover rounded-t-lg">
        @else
           <img src="https://placehold.co/600x400" alt="No Image Available" class="w-full h-full object-cover rounded-t-lg">
        @endif
       </div>
       
       <div class="flex flex-wrap gap-2 mt-2 ml-2">
       @foreach($product->tags as $tag)
       <flux:badge variant="pill" color="orange" class="text-gray-500!">{{ $tag->name }}</flux:badge>
       @endforeach
       </div>
   
       
       <div class="p-4 flex flex-col">
           <h2 class="text-lg font-medium text-gray-800 mb-1">{{ $product->name }}</h2>
           
           <div class="mt-auto">
               <p class="text-lg font-bold text-gray-900">{{ $product->price }}€</p>
           </div>
       </div>
   </div>
</a>