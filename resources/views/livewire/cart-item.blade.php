<div class="mx-auto p-4 sm:p-6 text-white w-full max-w-4xl mt-6 sm:mt-12 mb-10 sm:mb-20">
    @if(count($carts) > 0)
        <div>
            <div class="col-span-1 dark:bg-zinc-800 p-3 sm:p-4 rounded-lg border shadow-md border-zinc-200 dark:border-yellow-200">
                <div class="space-y-4">
                    @if  (session()->has('error'))
                        <div x-data="{ show: true }"
                             x-init="setTimeout(() => { show = false; }, 3000)"
                             x-show="show">
                            <flux:callout variant="danger" icon="x-circle" heading="{{ session('error') }}" />
                        </div>


                    @endif
                    @foreach ($carts as $cart)

                    <div class="border-b border-zinc-700 pb-4 mb-4 last:border-0 last:mb-0 last:pb-0">
                        <div class="flex items-center gap-3">
                            @if($cart->product && $cart->product->images->count() > 0)
                                <img src="{{ $cart->product->images->first()->getUrl() }}" alt="{{ $cart->product->name }}" class="size-16 sm:size-20 md:size-24 object-cover rounded">
                            @else
                                <div class="size-16 sm:size-20 md:size-24 bg-zinc-600 rounded flex items-center justify-center">
                                    <flux:icon.photo class="w-8 h-8 text-zinc-400" />
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-medium text-black dark:text-white">{{ $cart->product->name }}</h3>
                                <div class="text-sm text-zinc-400">{{ __('Size') }}: {{ $cart->size }}</div>
                                <div class="text-sm text-zinc-400">{{ __('Price') }}: {{ $cart->product->price * $cart->quantity }}€</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center border border-zinc-600 rounded-lg">
                                <button class="p-2 cursor-pointer {{ $cart->quantity == 1 ? 'hidden' : '' }}" wire:click="decrement({{ $cart->id }})">
                                    <flux:icon.minus class="w-5 h-5 text-black dark:text-white" />
                                </button>
                                <button class="p-2 text-red-300 hover:text-red-900 {{ $cart->quantity > 1 ? 'hidden' : '' }}" wire:click="delete({{ $cart->id }})">
                                    <flux:icon.trash class="w-5 h-5"/>
                                </button>
                                <span class="px-4 font-medium text-black dark:text-white">{{ $cart->quantity }}</span>
                                <button class="p-2 cursor-pointer" wire:click="increment({{ $cart->id }})">
                                    <flux:icon.plus class="w-5 h-5 text-black dark:text-white" />
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4 border-t border-zinc-700 pt-4">
                    <h3 class="text-right font-medium text-lg">{{ __('Total') }}: {{ $this->getCartTotal() }}€</h3>
                    <div class="mt-6 border-t border-zinc-700 pt-6">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pickupMethod" value="{{ $pickupMethod }}">
                            <div class="space-y-4">
                                <div>
                                    <flux:radio.group label="{{ __('Pickup Method') }}">
                                        <flux:radio value="shop" wire:click="setPickupMethod('shop')" label="{{ __('Shop') }}" name="pickupMethod" checked />
                                        <flux:radio value="terminal" wire:click="setPickupMethod('terminal')" label="{{ __('LP Express Terminal') }}" name="pickupMethod"/>

                                        <flux:radio value="omniva" wire:click="setPickupMethod('omniva')" label="{{ __('Omniva Terminal') }}" name="pickupMethod"/>

                                    </flux:radio.group>
                                    @if($pickupMethod === 'terminal')
                                    <flux:select placeholder="{{ __('Choose terminal...') }}" class="w-full" name="terminal_id" class="mt-4">
                                        @foreach ($this->getTerminals() as $terminal)
                                            <flux:select.option wire:key="terminal-{{ $terminal->id }}" value="{{ $terminal->id }}">{{ $terminal->city }}: {{ $terminal->address }} {{ $terminal->name }}</flux:select.option>
                                        @endforeach
                                    </flux:select>
                                    @endif
                                    @if($pickupMethod === 'omniva')
                                        <flux:select placeholder="{{ __('Choose terminal...') }}" class="w-full" name="terminal_id" class="mt-4">
                                            @foreach ($this->getPickupPoints() as $terminal)
                                                <flux:select.option wire:key="terminal-{{ $terminal['NAME'] }}" value="{{ $terminal['NAME'] }}">{{ $terminal['NAME'] }}: {{ $terminal['A5_NAME'] }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        @endif
                                </div>

                                <div class="flex flex-col space-y-4">

                                </div>
                                <flux:input placeholder="+370"  label="{{ __('Phone number') }}" required class="w-full" name="phone" value="{{ old('phone') }}" />

                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <flux:button type="submit" variant="primary" class="px-6 py-2">{{ __('Checkout') }}</flux:button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-8 bg-zinc-800 rounded-lg border border-yellow-200">
            <p class="text-white mb-4">{{ __('Your cart is empty') }}</p>
            <a href="{{ route('products') }}" class="text-blue-500 hover:underline"{{ __('Continue Shopping') }}</a>
        </div>
    @endif
</div>
