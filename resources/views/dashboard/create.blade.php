<x-layouts.app title="Create Product">
    <form method="POST" action="{{ route('dashboard.store') }}">
        @csrf
        <flux:input  name="name" type="text" required label="Name" class="mb-4"/>
        <flux:input name="price" type="number" step="any" required label="Price" class="mb-4"/>
        <flux:input  name="description" type="text" required label="Description" class="mb-4"/>
        <flux:input name="variant" type="text" required label="Variants" class="mb-4"/>
        <flux:input name="image" type="text" required label="Image URL" class="mb-4"/>
        
        <div class="flex gap-2">
            <flux:button type="submit" variant="primary">Save Product</flux:button>
            <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
        </div>
    </form>
</x-layouts.app>
