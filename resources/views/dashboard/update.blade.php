<x-layouts.app title="Dashboard">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
    <form action="{{ route('dashboard.update', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <flux:input  type="text" required  value="{{ $product->name }}" class="mb-4"/>
        <flux:input  type="number" required value="{{ $product->price }}" class="mb-4"/>
        <flux:input  type="text" required value="{{ $product->description }}" class="mb-4"/>
        <flux:input  type="text" required value="{{ $product->image }}" class="mb-4"/>
        <flux:button type="submit">Update</flux:button>
        <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
    </form>
</x-layouts.app>
