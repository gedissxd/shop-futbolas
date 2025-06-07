<?php

namespace App\Livewire;

use Livewire\Component;

class VariantInput extends Component
{
    public $variants = ['']; // Initialize with one empty input field
    public $variantString = '';
    public string $inputName = 'variant'; // Default name for the hidden input

    // Allow passing the existing variants when editing a product
    public function mount($existingVariants = null, $inputName = 'variant')
    {
        if ($existingVariants) {
            $this->variants = explode(',', $existingVariants);
            if (empty($this->variants)) { // Ensure there's always at least one input
                $this->variants = [''];
            }
        } else {
            $this->variants = ['']; // Default for create form
        }
        $this->inputName = $inputName;
        $this->updateVariantString(); // Initial update
    }

    public function addVariantInput()
    {
        $this->variants[] = '';
        $this->updateVariantString();
    }

    public function removeVariantInput($index)
    {
        if (count($this->variants) > 1) { // Prevent removing the last input field
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants); // Re-index array
            $this->updateVariantString();
        }
    }

    // This will be called automatically when $variants changes from the frontend
    public function updatedVariants()
    {
        $this->updateVariantString();
    }

    // Custom logic to handle direct updates to individual variant inputs
    // The `$key` will be in the format 'variants.0', 'variants.1', etc.
    public function updated($key, $value)
    {
        if (str_starts_with($key, 'variants.')) {
            $this->updateVariantString();
        }
    }

    private function updateVariantString()
    {
        // Filter out any null or truly empty strings before joining,
        // but allow strings that are just spaces (user might be typing)
        $this->variantString = implode(',', array_filter($this->variants, function($value) {
            return $value !== null && $value !== '';
        }));
    }

    public function render()
    {
        return view('livewire.variant-input');
    }
}
