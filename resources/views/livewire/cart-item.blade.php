<div class="mx-auto p-6 text-black w-3/4  mt-12 rounded-lg mt-25 mb-20 grid grid-cols-4 gap-6">
    @if(count($carts) > 0)
        <div class="col-span-3 bg-white p-4 rounded-lg">
            
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="py-3 px-4 text-left"></th>
                        <th class="py-3 px-4 text-left">Product</th>
                        <th class="py-3 px-4 text-center">Quantity</th>
                        <th class="py-3 px-4 text-center">Size</th>
                        <th class="py-3 px-4 text-right">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                    <tr>
                        <td class="py-4 px-4">
                            <img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="py-4 px-4 font-medium">{{ $cart->product->name }}</td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="p-1 cursor-pointer @php if($cart->quantity == 1) { echo 'hidden'; } @endphp" wire:click="decrement({{ $cart->id }})">
                                    <flux:icon.minus class="w-4 h-4" />
                                </button>
                                <button class="p-2 text-red-300 hover:text-red-900 @php if($cart->quantity > 1) { echo 'hidden'; } @endphp" wire:click="delete({{ $cart->id }})">
                                    <flux:icon.trash class="w-5 h-5"/>
                                </button>
                                <span class="mx-1 font-medium">{{ $cart->quantity }}</span>
                                <button class="p-1 cursor-pointer" wire:click="increment({{ $cart->id }})">
                                    <flux:icon.plus class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-center">{{ $cart->size }}</td>
                        <td class="py-4 px-4 text-right">${{ $cart->product->price * $cart->quantity }}</td>
                        <td class="py-4 px-4 text-center">
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-span-1">
            <div class="border p-4 rounded-lg bg-white">
                <div class="mb-6 text-lg font-semibold">
                    <span class="block mb-4">Order Summary</span>
                    <div class="flex justify-between items-center">
                        <span>Total: </span>
                        <span>${{ $this->getCartTotal() }}</span>
                    </div>
                </div>
                
                <div>
                    <flux:button class="w-full px-6 py-2">Checkout</flux:button>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-8 col-span-4 bg-white rounded-lg">
            <p class="text-gray-500 mb-4">Your cart is empty</p>
            <a href="{{ route('products') }}" class="text-blue-500 hover:underline">Continue Shopping</a>
        </div>
    @endif
</div>