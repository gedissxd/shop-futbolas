<div class="mx-auto p-4 sm:p-6 text-white w-full max-w-4xl mt-6 sm:mt-12 mb-10 sm:mb-20">
    @if(count($carts) > 0)
        <div>
            <div class="col-span-1 bg-zinc-800 p-3 sm:p-4 rounded-lg border border-yellow-200">
                <div class="space-y-4">
                    @foreach ($carts as $cart)
                    <div class="border-b border-zinc-700 pb-4 mb-4 last:border-0 last:mb-0 last:pb-0">
                        <div class="flex items-center gap-3">
                            <img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}" class="size-16 sm:size-20 md:size-24 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="font-medium">{{ $cart->product->name }}</h3>
                                <div class="text-sm text-zinc-400">Size: {{ $cart->size }}</div>
                                <div class="text-sm text-zinc-400">Price: {{ $cart->product->price * $cart->quantity }}€</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center border border-zinc-600 rounded-lg">
                                <button class="p-2 cursor-pointer @php if($cart->quantity == 1) { echo 'hidden'; } @endphp" wire:click="decrement({{ $cart->id }})">
                                    <flux:icon.minus class="w-5 h-5" />
                                </button>
                                <button class="p-2 text-red-300 hover:text-red-900 @php if($cart->quantity > 1) { echo 'hidden'; } @endphp" wire:click="delete({{ $cart->id }})">
                                    <flux:icon.trash class="w-5 h-5"/>
                                </button>
                                <span class="px-4 font-medium">{{ $cart->quantity }}</span>
                                <button class="p-2 cursor-pointer" wire:click="increment({{ $cart->id }})">
                                    <flux:icon.plus class="w-5 h-5" />
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4 border-t border-zinc-700 pt-4">
                    <h3 class="text-right font-medium text-lg">Total: {{ $this->getCartTotal() }}€</h3>
                    <div class="mt-6 border-t border-zinc-700 pt-6">


                        <h3 class="font-medium text-lg mb-4">Pickup Method</h3>
                        <div class="space-y-4">
                            <div>
                                <flux:radio.group>
                                    <flux:radio value="shop" label="Shop" checked />
                                    <flux:radio value="terminal" label="Terminal" />
                                </flux:radio.group>
                            </div>
                            
                            
                            <div class="flex flex-col space-y-4">
                                <flux:select placeholder="Choose terminal..." class="w-full">
                                    @foreach ($terminals as $terminal)
                                        <flux:select.option value="{{ $terminal->id }}">{{ $terminal->city }}: {{ $terminal->adress }} {{ $terminal->name }}</flux:select.option> 
                                    @endforeach
                                </flux:select>
                                <flux:input placeholder="+370" label="Phone number" class="w-full" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-6">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <flux:button type="submit" variant="primary" class="px-6 py-2">Checkout</flux:button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-8 bg-zinc-800 rounded-lg border border-yellow-200">
            <p class="text-white mb-4">Your cart is empty</p>
            <a href="{{ route('products') }}" class="text-blue-500 hover:underline">Continue Shopping</a>
        </div>
    @endif
</div>