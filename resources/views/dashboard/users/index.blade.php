<x-layouts.app title="Users">


@foreach ($users as $user)
<div class="bg-blue-300 p-4 rounded-lg flex gap-4 mt-4">
  
    <div>
    <h2 class="text-lg font-bold">{{ $user->name }}</h2>
    <p class="text-sm text-gray-600">{{ $user->email }}</p>
    </div>
    <div class="flex ml-auto gap-2">
        <flux:button href="{{ route('dashboard.users.edit', $user->id) }}">Edit</flux:button>
        <form action="" method="POST">
            @csrf
            @method('DELETE')
            <flux:button type="submit" variant="danger" class="cursor-pointer">Delete</flux:button>
        </form>
     
    </div>
</div>
@endforeach



</x-layouts.app>
