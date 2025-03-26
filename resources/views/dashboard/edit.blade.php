<x-layouts.app title="Dashboard">
    <h1 class="text-2xl font-bold mb-4">{{ __('Edit Product') }}</h1>
    <form action="{{ route('dashboard.update', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <flux:input name="name" type="text" required value="{{ old('name', $product->name) }}" label="{{ __('Name') }}" class="mb-4"/>
        <flux:input name="price" type="number" step="any" required value="{{ old('price', $product->price) }}" label="{{ __('Price') }}" class="mb-4"/>
        <flux:input name="description" type="text" required value="{{ old('description', $product->description) }}" label="{{ __('Description') }}" class="mb-4"/>
        <flux:input name="image" type="text" required value="{{ old('image', $product->image) }}" label="{{ __('Image URL') }}" class="mb-4"/>
        <flux:input name="variant" type="text" required value="{{ old('variant', $product->variant) }}" label="{{ __('Variants') }}" class="mb-4"/>
        <flux:input name="stock" type="number" min="0" required value="{{ old('stock', $product->stock) }}" label="{{ __('Stock') }}" class="mb-4"/>
        <flux:button type="submit" class="bg-green-800!">{{ __('Update') }}</flux:button>
        <flux:button href="{{ route('dashboard') }}">{{ __('Cancel') }}</flux:button>
    </form>

    <h1>{{ __('Preview') }}</h1>
   
        <div class="bg-white  rounded-lg w-1/4">
           <div class="w-full h-48 overflow-hidden h-[360px]">
               <img src="{{ $product->image }}" alt="Product Image" class="w-full h-full object-cover rounded-t-lg">
           </div>
           
           <div class="p-4  flex flex-col">
               <h2 class="text-lg font-medium text-gray-800 mb-1">{{ $product->name }}</h2>
               
               <div class="mt-auto">
                   <p class="text-lg font-bold text-gray-900">${{ $product->price }}</p>
               </div>
           </div>
       </div>

    <livewire:add-to-cart :product="$product" />
</x-layouts.app>
