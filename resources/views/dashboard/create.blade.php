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

        {{-- Variants Section --}}
        <div class="mb-4 p-4 border border-gray-300 rounded-md">
            <h3 class="text-lg font-semibold mb-2">{{ __('Product Variants') }}</h3>
            <div id="variants-container" class="space-y-3">
                {{-- Dynamic variants will be added here --}}
            </div>
            <button type="button" id="add-variant-button" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{ __('Add Variant') }}</button>
        </div>

        <flux:input name="image[]" type="file" required label="{{ __('Images') }}" class="mb-4" multiple/>
        <flux:input name="tags" type="text" required label="{{ __('Tags') }}" class="mb-4"/>
        <div class="mb-4">
            <flux:checkbox name="featured" value="1" label="{{ __('Featured Product') }}" />
        </div>
        
        <div class="flex gap-2">
            <flux:button type="submit" variant="primary">{{ __('Create Product') }}</flux:button>
            <flux:button href="{{ route('dashboard') }}">{{ __('Cancel') }}</flux:button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addVariantButton = document.getElementById('add-variant-button');
            const variantsContainer = document.getElementById('variants-container');
            let variantIndex = 0;

            addVariantButton.addEventListener('click', function () {
                const index = variantIndex++;
                const variantHtml = `
                    <div class="variant-group p-3 border border-gray-200 rounded-md bg-gray-50 relative">
                        <h4 class="text-md font-medium mb-2">Variant ${index + 1}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="variants_${index}_name" class="block mb-1 text-sm font-medium">Name</label>
                                <input type="text" name="variants[${index}][name]" id="variants_${index}_name" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="variants_${index}_stock" class="block mb-1 text-sm font-medium">Stock</label>
                                <input type="number" name="variants[${index}][stock]" id="variants_${index}_stock" required min="0" class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <button type="button" class="remove-variant-button absolute top-2 right-2 mt-1 mr-1 px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">Remove</button>
                    </div>
                `;
                variantsContainer.insertAdjacentHTML('beforeend', variantHtml);
            });

            variantsContainer.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-variant-button')) {
                    e.target.closest('.variant-group').remove();
                }
            });

            // Optionally, add one variant group by default if needed
            // addVariantButton.click();
        });
    </script>
</x-layouts.app>
