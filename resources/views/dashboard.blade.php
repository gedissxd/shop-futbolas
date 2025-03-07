<x-layouts.app title="Dashboard">
    <flux:modal.trigger name="edit-profile">
        <flux:button>Edit profile</flux:button>
    </flux:modal.trigger>
    
    <flux:modal name="edit-profile" variant="flyout">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:subheading>Make changes to your personal details.</flux:subheading>
            </div>
    
            <flux:input label="Name" placeholder="Your name" />
    
            <flux:input label="Date of birth" type="date" />
    
            <div class="flex">
                <flux:spacer />
    
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</x-layouts.app>
