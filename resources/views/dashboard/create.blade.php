<x-layouts.app title="Create Product">
    <form action="{{ route('dashboard') }}" method="POST">
        @csrf
        <flux:input name="name" label="Name" />
        <flux:input name="price" label="Price" />
        <flux:input name="description" label="Description" />
        <flux:input name="image" label="Image" />
        <flux:button type="submit" class="mt-4 bg-green-500! cursor-pointer">Create</flux:button>
        <flux:button href="{{ route('dashboard') }}" class="mt-4">Cancel</flux:button>
    </form>
</x-layouts.app>
