<div>
    <input type="hidden" name="pickupMethod" value="{{ $pickupMethod }}">
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