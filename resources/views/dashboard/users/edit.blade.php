<x-layouts.app title="Edit User">
    <form action="" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <flux:input name="name" label="{{ __('Name') }}" value="{{ $user->name }}" />
        <flux:input name="email" label="{{ __('Email address') }}" value="{{ $user->email }}" />
            <flux:select name="is_admin" label="{{ __('Is Admin') }}" value="{{ $user->is_admin }}" placeholder="{{ __('Select an option') }}" variant="default">
                <flux:select.option value="1">{{ __('Yes') }}</flux:select.option>
                <flux:select.option value="0">{{ __('No') }}</flux:select.option>
            </flux:select>
        <flux:button variant="primary" type="submit">{{ __('Update') }}</flux:button>
    </form>
</x-layouts.app>
