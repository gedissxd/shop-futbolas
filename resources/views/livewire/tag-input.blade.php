<div>
        <flux:label>{{ __('Tags') }}</flux:label>
        @foreach ($tags as $index => $tag)
            <div class="flex items-center mb-2">
                <flux:input type="text" wire:model.live="tags.{{ $index }}" placeholder="{{ __('Enter tag') }}" />
                @if (count($tags) > 1 || ($tags[$index] !== '' && count($tags) === 1))
                    <flux:button type="button" wire:click="removeTagInput({{ $index }})" class="ml-2 text-red-500 hover:text-red-700">
                        <flux:icon name="trash" class="w-4 h-4"/>
                    </flux:button>
                @endif
            </div>
        @endforeach

        <flux:button type="button" wire:click="addTagInput"  class="mt-2 p-2 mb-2">
            {{ __('Add Tag') }}
        </flux:button>

    <input type="hidden" name="{{ $inputName }}" value="{{ $tagString }}">
</div>
