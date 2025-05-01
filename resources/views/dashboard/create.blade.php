<x-layouts.app title="{{ __('Create Product') }}">
    @include('partials.tinymce-head')
    <form method="POST" action="{{ route('dashboard.store') }}" enctype="multipart/form-data">
        @csrf
        <flux:input  name="name" type="text" required label="{{ __('Name') }}" class="mb-4"/>
        <flux:input name="price" type="number" step="any" required label="{{ __('Price') }}" class="mb-4"/>
        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-medium">{{ __('Description') }}</label>
            <textarea id="description" name="description" class="tinymce-editor">{{ old('description') }}</textarea>
        </div>
        <flux:input name="variant" type="text" required label="{{ __('Variants') }}" class="mb-4"/>
        <flux:input name="image[]" type="file" required label="{{ __('Images') }}" class="mb-4" multiple/>
        <flux:input name="stock" type="number" min="0" required label="{{ __('Stock') }}" class="mb-4"/>
        <flux:input name="tags" type="text" required label="{{ __('Tags') }}" class="mb-4"/>
        <div class="mb-4">
            <flux:checkbox name="featured" value="1" label="{{ __('Featured Product') }}" />
        </div>
        
        <div class="flex gap-2">
            <flux:button type="submit" variant="primary">{{ __('Create Product') }}</flux:button>
            <flux:button href="{{ route('dashboard') }}">{{ __('Cancel') }}</flux:button>
        </div>
    </form>
</x-layouts.app>
