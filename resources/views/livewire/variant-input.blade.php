<div>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Variants') }}</label>
    @foreach ($variants as $index => $variant)
        <div class="flex items-center mb-2">
            <input type="text" wire:model.live="variants.{{ $index }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter variant') }}">
            @if (count($variants) > 1)
                <button type="button" wire:click="removeVariantInput({{ $index }})" class="ml-2 text-red-500 hover:text-red-700">
                    {{ __('Remove') }}
                </button>
            @endif
        </div>
    @endforeach

    <button type="button" wire:click="addVariantInput" class="text-blue-500 hover:text-blue-700 mt-2">
        {{ __('+ Add Variant') }}
    </button>

    <input type="hidden" name="{{ $inputName }}" value="{{ $variantString }}">
</div>
