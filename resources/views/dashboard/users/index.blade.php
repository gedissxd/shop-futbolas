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
        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <flux:button type="submit" variant="danger" class="cursor-pointer">{{ __('Delete') }}</flux:button>
        </form>
     
    </div>
</div>
@endforeach



</x-layouts.app>
