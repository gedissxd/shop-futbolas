<x-layout title="Contact Us">
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 gap-12">
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">{{ __('Send us a message') }}</h2>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <flux:input 
                                name="first_name" 
                                :label="__('First Name')" 
                                type="text" 
                                required 
                                placeholder="{{ __('John') }}"
                                value="{{ old('first_name') }}"
                            />
                            
                            <flux:input 
                                name="last_name" 
                                :label="__('Last Name')" 
                                type="text" 
                                required 
                                placeholder="{{ __('Doe') }}"
                                value="{{ old('last_name') }}"
                            />
                        </div>

                        <flux:input 
                            name="email" 
                            :label="__('Email Address')" 
                            type="email" 
                            required 
                            placeholder="john@example.com"
                            value="{{ old('email') }}"
                        />

                        <flux:input 
                            name="phone" 
                            :label="__('Phone Number')" 
                            type="tel" 
                            placeholder="+370 612 34567"
                            value="{{ old('phone') }}"
                        />

                        <div>
                            <flux:select name="subject" :label="__('Subject')" placeholder="{{ __('Select a subject') }}">
                                <flux:select.option value="general">{{ __('General Inquiry') }}</flux:select.option>
                                <flux:select.option value="order">{{ __('Order Support') }}</flux:select.option>
                                <flux:select.option value="product">{{ __('Product Question') }}</flux:select.option>
                                <flux:select.option value="complaint">{{ __('Complaint') }}</flux:select.option>
                                <flux:select.option value="suggestion">{{ __('Suggestion') }}</flux:select.option>
                                <flux:select.option value="other">{{ __('Other') }}</flux:select.option>
                            </flux:select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Message') }}
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="6" 
                                required
                                placeholder="{{ __('Tell us how we can help you...') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            >{{ old('message') }}</textarea>
                        </div>

                        <flux:button variant="primary" type="submit" class="w-full">
                            {{ __('Send Message') }}
                        </flux:button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>