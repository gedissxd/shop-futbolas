<div class="locale-switcher">
    <flux:dropdown align="end">
        <button class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition">
           {{ strtoupper(app()->getLocale()) }}
        </button>

        <flux:menu>
            <flux:menu.item href="" class="bg-gray-100 dark:bg-gray-700">
                <div class="flex items-center">
                    <span class="mr-2">LT</span>
                    <span>{{ __('Lithuanian') }}</span>
                </div>
            </flux:menu.item>
            <flux:menu.item href="" class="bg-gray-100 dark:bg-gray-700">
                <div class="flex items-center">
                    <span class="mr-2">EN</span>
                    <span>{{ __('English') }}</span>
                </div>
            </flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</div> 