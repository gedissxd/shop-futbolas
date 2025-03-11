<x-layouts.app title="Dashboard">

    @if (session()->has('message'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)" 
         x-show="show"
         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" 
         role="alert">
        {{ session('message') }}
    </div>
    @endif
    <div class="mb-5">
        <flux:button href="{{ route('dashboard.create') }}">Add Product</flux:button>
    </div>
    <div class="space-y-4">
        @foreach ($products as $product)
            <div class="bg-blue-300 p-4 rounded-lg flex gap-4">
                <div>
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="size-15 rounded-lg">
                </div>
                <div>
                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                <p class="text-sm text-gray-600">{{ $product->description }}</p>
                <p class="text-lg font-bold">${{ $product->price }}</p>
                </div>
                <div class="flex ml-auto gap-2">
                    <flux:button href="{{ route('dashboard.update', $product->id) }}">Edit</flux:button>
                    <form action="{{ route('dashboard.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <flux:button type="submit" variant="danger" class="cursor-pointer">Delete</flux:button>
                    </form>
                 
                </div>
            </div>
         
        @endforeach
    </div>
</x-layouts.app>

