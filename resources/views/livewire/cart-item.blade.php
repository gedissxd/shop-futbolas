<div class="mx-auto p-6 text-white w-full md:w-3/4 mt-12 mb-20">
    @if(count($carts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="col-span-1 md:col-span-3 bg-zinc-800 p-4 rounded-lg shadow-sm">
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
                            <td class="py-4 px-4 text-right">{{ $cart->product->price * $cart->quantity }}€</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-span-1 space-y-4">
                <div class="bg-zinc-800 p-4 rounded-lg shadow-sm">
                    <div class="flex gap-2">
                        <flux:icon.truck variant="mini" class="w-4 h-4 mt-1"/>   <h3 class="font-medium mb-3">Pickup Method</h3>
                    </div>
                    
                    <flux:radio.group wire:model="payment" label="Select your pickup method" icon="shopping-cart">
                        <flux:radio value="cc" label="Take at shop" checked />
                        <flux:radio value="paypal" label="Take at LP Express terminal" />
                        <flux:select wire:model="terminal" placeholder="Choose terminal...">
                            @foreach ($terminals as $terminal)
                                <flux:select.option>{{ $terminal->city }}: {{ $terminal->adress }} {{ $terminal->name }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </flux:radio.group>
                </div>
                <div class="p-4 rounded-lg bg-zinc-800 shadow-sm">
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-4">Order Summary</h3>
                        
                        <div class="flex justify-between items-center font-medium">
                            <span>Total: </span>
                            <span>{{ $this->getCartTotal() }}€</span>
                        </div>
                    </div>
                    
                    <div>
                        <flux:button  variant="primary" class="w-full px-6 py-2">Checkout</flux:button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-8 bg-zinc-800 rounded-lg shadow-sm">
            <p class="text-white mb-4">Your cart is empty</p>
            <a href="{{ route('products') }}" class="text-blue-500 hover:underline">Continue Shopping</a>
        </div>
    @endif
</div>