<x-layouts.app title="Edit User">
    <form action="" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <flux:input name="name" label="Name" value="{{ $user->name }}" />
        <flux:input name="email" label="Email" value="{{ $user->email }}" />
        <flux:input name="is_admin" label="Is Admin" value="{{ $user->is_admin }}" />
        <flux:button type="submit">Update</flux:button>
    </form>
</x-layouts.app>
