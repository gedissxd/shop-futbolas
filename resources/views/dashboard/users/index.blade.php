<x-layouts.app title="Users">


@foreach ($users as $user)
<div class="bg-blue-300 p-4 rounded-lg flex gap-4 mt-4">
  
    <div>
    <h2 class="text-lg font-bold">{{ $user->name }}</h2>
    <p class="text-sm text-gray-600">{{ $user->email }}</p>
    <h1 class="text-sm text-red-500 font-bold">@php echo $user->is_admin ? 'Admin' : 'User' @endphp</h1>
    <h3 class="text-sm text-gray-600">{{ $user->created_at }}</h3>
    </div>
   
    <div class="flex ml-auto gap-2">
        <flux:button href="{{ route('dashboard.users.edit', $user->id) }}">{{ __('Edit') }}</flux:button>
        <flux:modal.trigger name="delete-user-{{ $user->id }}">
            <flux:button variant="danger">{{ __('Delete') }}</flux:button>
        </flux:modal.trigger>
        
        <flux:modal name="delete-user-{{ $user->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('Delete user?') }}</flux:heading>
                    <flux:text class="mt-2">
                        <p>{{ __("You're about to delete") }} "{{ $user->name }}".</p>
                        <p>{{ __('This action cannot be reversed.') }}</p>
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                    </flux:modal.close>
                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <flux:button type="submit" variant="danger">{{ __('Delete user') }}</flux:button>
                    </form>
                </div>
            </div>
        </flux:modal>
     
    </div>
</div>
@endforeach



</x-layouts.app>
