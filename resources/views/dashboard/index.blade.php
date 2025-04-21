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
        <flux:button href="{{ route('dashboard.create') }}">{{ __('Add Product') }}</flux:button>
    </div>
    <div class="space-y-4">
        @foreach ($products as $product)
            <div class="bg-blue-300 p-4 rounded-lg flex gap-4">
                <div>
                    @if($product->images->isNotEmpty())
                <img src="{{ $product->images->first()->getUrl() }}" alt="{{ $product->name }}" class="size-25 rounded-lg">
                @endif
                </div>
                <div>
                <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                <p class="text-sm text-gray-600">{{ $product->description }}</p>
                <p class="text-lg font-bold">${{ $product->price }}</p>
                <p class="text-sm text-gray-600 font-bold {{ $product->stock === 0 ? 'text-red-600' : '' }}">
                    {{ __('Stock') }}: {{ $product->stock }} {{ $product->stock === 0 ? '(Out of stock)' : '' }}
                </p>
                </div>
                <div class="flex ml-auto gap-2">
                    <flux:button href="{{ route('dashboard.edit', $product->id) }}">{{ __('Edit') }}</flux:button>
                    
                    <flux:modal.trigger name="delete-product-{{ $product->id }}">
                        <flux:button variant="danger">{{ __('Delete') }}</flux:button>
                    </flux:modal.trigger>
                    
                    <flux:modal name="delete-product-{{ $product->id }}" class="min-w-[22rem]">
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">{{ __('Delete product?') }}</flux:heading>
                                <flux:text class="mt-2">
                                    <p>{{ __("You're about to delete") }} "{{ $product->name }}".</p>
                                    <p>{{ __('This action cannot be reversed.') }}</p>
                                </flux:text>
                            </div>
                            <div class="flex gap-2">
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                                </flux:modal.close>
                                <form action="{{ route('dashboard.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" variant="danger">{{ __('Delete product') }}</flux:button>
                                </form>
                            </div>
                        </div>
                    </flux:modal>
                </div>
            </div>
         
        @endforeach
    </div>
</x-layouts.app>

