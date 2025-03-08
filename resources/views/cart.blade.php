<x-layout>
    <div class="flex justify-center mx-auto mt-10">
    <flux:fieldset>
    <flux:legend>Shipping address</flux:legend>

    <div class="space-y-6">
        <flux:input label="Street address line 1" placeholder="123 Main St" class="max-w-sm" />
        <flux:input label="Street address line 2" placeholder="Apartment, studio, or floor" class="max-w-sm" />

        <div class="grid grid-cols-2 gap-x-4 gap-y-6">
            <flux:input label="City" placeholder="San Francisco" />
            <flux:input label="State / Province" placeholder="CA" />
            <flux:input label="Postal / Zip code" placeholder="12345" />
            <flux:select label="Country">
                <option selected>United States</option>
                <!-- ... -->
            </flux:select>
        </div>
    </div>
</flux:fieldset>
</div>
</x-layout>

