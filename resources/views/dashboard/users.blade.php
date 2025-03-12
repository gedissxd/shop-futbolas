<x-layouts.app title="Users">

<h1>Users</h1>

@foreach ($users as $user)
<div class="bg-blue-300 p-4 rounded-lg shadow-md mt-2">
        <h3 class="text-lg font-medium mb-2">{{ $user->name }}</h3>
        <p class="text-sm text-gray-600">{{ $user->email }}</p>
    </div>
@endforeach

</x-layouts.app>
