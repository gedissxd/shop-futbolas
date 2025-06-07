<div>
    <flux:label>{{ __('Variants') }}</flux:label>
    @foreach ($variants as $index => $variant)
        <div class="flex items-center mb-2">
            <flux:input type="text" wire:model.live="variants.{{ $index }}" placeholder="{{ __('Enter variant') }}" />
            @if (count($variants) > 1)
                <flux:button type="button" wire:click="removeVariantInput({{ $index }})" class="ml-2 text-red-500 hover:text-red-700">
                <flux:icon name="trash" class="w-4 h-4"/>
                </flux:button>
            @endif
        </div>
    @endforeach

    <flux:button type="button" wire:click="addVariantInput" class="mt-2 p-2 mb-2">
        {{ __('Add Variant') }}
    </flux:button>

    <input type="hidden" name="{{ $inputName }}" value="{{ $variantString }}">
</div>
