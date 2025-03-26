<x-layouts.app title="Edit User">
    <form action="" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <flux:input name="name" label="{{ __('Name') }}" value="{{ $user->name }}" />
        <flux:input name="email" label="{{ __('Email address') }}" value="{{ $user->email }}" />
        <flux:input name="is_admin" label="{{ __('Is Admin (1 is yes, 0 is no)') }}" value="{{ $user->is_admin }}" />
        <flux:button variant="primary" type="submit">{{ __('Update') }}</flux:button>
    </form>
</x-layouts.app>
