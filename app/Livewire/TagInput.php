<?php

namespace App\Livewire;

use Livewire\Component;

class TagInput extends Component
{
    public $tags = ['']; // Initialize with one empty input field
    public $tagString = '';
    public string $inputName = 'tags'; // Default name for the hidden input

    public function mount($existingTags = null, $inputName = 'tags')
    {
        if ($existingTags !== null) { // Check if existingTags is actually passed
            $this->tags = explode(',', $existingTags);
            // If existingTags was an empty string, explode results in an array with one empty string.
            // If we want truly no tags to result in one empty input field for usability:
            if (count($this->tags) === 1 && $this->tags[0] === '') {
                 $this->tags = [''];
            } elseif (empty($this->tags)) { // If $existingTags was something else that resulted in empty after explode (e.g. only commas)
                 $this->tags = [''];
            }
        } else {
            $this->tags = ['']; // Default for create form if no existingTags
        }
        $this->inputName = $inputName;
        $this->updateTagString(); // Initial update
    }

    public function addTagInput()
    {
        $this->tags[] = '';
        $this->updateTagString();
    }

    public function removeTagInput($index)
    {
        if (count($this->tags) > 1 || (count($this->tags) === 1 && $this->tags[0] !== '')) { // Allow removing if it's the last one but not empty
            unset($this->tags[$index]);
            $this->tags = array_values($this->tags); // Re-index array
            if (empty($this->tags)) { // If all removed, add one empty back
                $this->tags = [''];
            }
            $this->updateTagString();
        }
    }

    // This will be called automatically when $tags changes from the frontend
    public function updatedTags()
    {
        $this->updateTagString();
    }

    // Custom logic to handle direct updates to individual tag inputs
    // The `$key` will be in the format 'tags.0', 'tags.1', etc.
    public function updated($key, $value)
    {
        if (str_starts_with($key, 'tags.')) {
            $this->updateTagString();
        }
    }

    private function updateTagString()
    {
        // Filter out any null or truly empty strings before joining
        $this->tagString = implode(',', array_filter($this->tags, function($value) {
            return $value !== null && $value !== '';
        }));
    }

    public function render()
    {
        return view('livewire.tag-input');
    }
}
