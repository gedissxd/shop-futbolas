<div>
    <flux:header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('home') }}" class="flex items-center" wire:navigate>
            <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-25">
        </a>

        <flux:spacer />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" :href="route('home')" wire:navigate>{{ __('Home') }}</flux:navbar.item>
            <flux:navbar.item icon="shopping-cart" :href="route('products')" wire:navigate>{{ __('Shop') }}</flux:navbar.item>
            <flux:navbar.item icon="shopping-bag" :href="route('cart')" >{{ __('Cart') }} ({{ $cartCount }})</flux:navbar.item>
        </flux:navbar>

        <flux:spacer />
        <div class="mr-2">
        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />
        </div>
        <flux:separator vertical class="h-[50px] m-auto"/>
        <div class="ml-2">
        <livewire:locale-switch/>
        </div>
        <!-- User Menu -->
        @auth
        <flux:dropdown position="top" align="end">
            <flux:profile
                class="cursor-pointer"
                :initials="auth()->user()->initials()"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                @if (Auth::user()->is_admin ?? false)
                <flux:menu.item href="{{ route('dashboard') }}" icon="layout-grid" wire:navigate>{{ __('Dashboard') }}</flux:menu.item>
                @endif

                <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
        @else
        <flux:navbar class="space-x-2">
            <flux:navbar.item href="{{ route('login') }}" wire:navigate>{{ __('Login') }}</flux:navbar.item>
            <flux:navbar.item href="{{ route('register') }}" wire:navigate>{{ __('Register') }}</flux:navbar.item>
        </flux:navbar>
        @endauth
    </flux:header>

    <!-- Mobile Sidebar -->
    <flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('home') }}" class="ml-1 flex items-center space-x-2" wire:navigate>
           <img src="{{ asset('svg/logo no background fill.svg') }}" alt="logo" class="size-15">
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Navigation')">
                <flux:navlist.item icon="home" :href="route('home')" wire:navigate>{{ __('Home') }}</flux:navlist.item>
                <flux:navlist.item icon="shopping-cart" :href="route('products')" wire:navigate>{{ __('Shop') }}</flux:navlist.item>
                <flux:navlist.item icon="shopping-bag" :href="route('cart')" wire:navigate>{{ __('Cart') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
    </flux:sidebar>
</div>
