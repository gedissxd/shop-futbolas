<div>
    <form wire:submit="save">
        <flux:input wire:model="name" name="name" type="text" required label="Name" class="mb-4"/>
        <flux:input wire:model="price" name="price" type="number" step="any" required label="Price" class="mb-4"/>
        <flux:input wire:model="description" name="description" type="text" required label="Description" class="mb-4"/>
        <flux:input wire:model="image" name="image" type="text" required label="Image URL" class="mb-4"/>
        <flux:button type="submit" class="bg-green-800!">Create</flux:button>
        <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
    </form>
</div>
