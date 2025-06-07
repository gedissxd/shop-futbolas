<div>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tags') }}</label>
    @foreach ($tags as $index => $tag)
        <div class="flex items-center mb-2">
            <input type="text" wire:model.live="tags.{{ $index }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter tag') }}">
            {{-- Logic for showing remove button: show if more than one tag input exists, or if it's the single input but it's not empty --}}
            @if (count($tags) > 1 || ($tags[$index] !== '' && count($tags) === 1))
                <button type="button" wire:click="removeTagInput({{ $index }})" class="ml-2 text-red-500 hover:text-red-700">
                    {{ __('Remove') }}
                </button>
            @endif
        </div>
    @endforeach

    <button type="button" wire:click="addTagInput" class="text-blue-500 hover:text-blue-700 mt-2">
        {{ __('+ Add Tag') }}
    </button>

    <input type="hidden" name="{{ $inputName }}" value="{{ $tagString }}">
</div>
