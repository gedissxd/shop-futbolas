<x-layouts.app title="Orders">

    <div class="text-xl font-bold mb-4">In cart</div>
    @php
        // Group cart items by user_id
        $cartsByUser = $cartItems->groupBy('user_id');
    @endphp

    @foreach ($cartsByUser as $userId => $userCarts)
        <div class="mb-8  pb-4 border p-4 rounded-lg border-yellow-300">
            <h2 class="text-xl font-bold mb-4">Cart: {{ $userCarts->first()->user->email }}</h2>
            
            @foreach ($userCarts as $cart)
                <div class="border-b border-zinc-700 pt-4 pb-4 mb-4 last:mb-0 last:pb-0">
                    <div class="flex items-center gap-3">
                        <img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}" class="size-16 sm:size-20 md:size-24 object-cover rounded">
                        <div class="flex-1">
                            <h3 class="font-medium">{{ $cart->product->name }}</h3>
                            <div class="text-sm text-zinc-400">Size: {{ $cart->size }}</div>
                            <div class="text-sm text-zinc-400">Price: {{ $cart->product->price * $cart->quantity }}€</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="text-xl font-bold mb-4">Completed orders</div>
</x-layouts.app>

