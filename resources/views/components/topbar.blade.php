<div class="bg-white dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700 px-4 py-3">
    <div class="flex items-center justify-between max-w-7xl mx-auto">
        <!-- Left Side - Mobile Toggle -->
        <div class="flex items-center">
            <!-- Mobile Sidebar Toggle -->
            <flux:sidebar.toggle class="lg:hidden mr-4" icon="bars-3" />
            <!-- Can add breadcrumbs or page title here later -->
        </div>

        <!-- Right Side - Actions -->
        <div class="flex items-center space-x-4 rtl:space-x-reverse">
            <!-- Language Switcher -->
            <flux:dropdown position="bottom" align="end">
                <flux:button variant="ghost" size="sm">
                    <flux:icon name="language" class="size-4" />
                    <span class="ml-2 text-sm font-medium rtl:ml-0 rtl:mr-2">{{ strtoupper(app()->getLocale()) }}</span>
                    <flux:icon name="chevron-down" class="ml-1 size-3 rtl:ml-0 rtl:mr-1" />
                </flux:button>

                <flux:menu class="w-40">
                    <flux:menu.item data-locale="en">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-lg">🇺🇸</span>
                            <span>English</span>
                        </div>
                    </flux:menu.item>
                    <flux:menu.item data-locale="fr">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-lg">🇫🇷</span>
                            <span>Français</span>
                        </div>
                    </flux:menu.item>
                    <flux:menu.item data-locale="es">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-lg">🇪🇸</span>
                            <span>Español</span>
                        </div>
                    </flux:menu.item>
                    <flux:menu.item data-locale="ar">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-lg">🇸🇦</span>
                            <span>العربية</span>
                        </div>
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>

            <!-- Theme Toggle Button -->
            <flux:button variant="ghost" size="sm" data-theme-toggle>
                <flux:icon name="sun" class="size-4 theme-icon light-icon" />
                <flux:icon name="moon" class="size-4 theme-icon dark-icon hidden" />
                <flux:icon name="computer-desktop" class="size-4 theme-icon system-icon hidden" />
            </flux:button>

            

            <!-- User Menu -->
            <flux:dropdown position="bottom" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                />

                <flux:menu class="w-48">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="user" wire:navigate>{{ __('app.profile') }}</flux:menu.item>
                        <flux:menu.item :href="route('settings.password')" icon="key" wire:navigate>{{ __('app.password') }}</flux:menu.item>
                        <flux:menu.item :href="route('settings.appearance')" icon="paint-brush" wire:navigate>{{ __('app.appearance') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('app.logout') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>
</div>

<!-- Language Switcher Component -->
<livewire:actions.set-language />

<!-- Theme Switcher Component -->
<livewire:actions.toggle-theme />

<script>
// Make applyTheme function global so it can be called from Livewire
window.applyTheme = function(theme) {
    const html = document.documentElement;
    const icons = document.querySelectorAll('.theme-icon');
    
    // Hide all theme icons
    icons.forEach(icon => icon.classList.add('hidden'));
    
    if (theme === 'dark') {
        html.classList.add('dark');
        document.querySelector('.dark-icon')?.classList.remove('hidden');
    } else if (theme === 'light') {
        html.classList.remove('dark');
        document.querySelector('.light-icon')?.classList.remove('hidden');
    } else { // system
        document.querySelector('.system-icon')?.classList.remove('hidden');
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
    }
};

// Initialize theme and event listeners
function initializeTopbar() {
    // Theme management
    const theme = @js(session('theme', 'system'));
    applyTheme(theme);
    
    // Remove existing event listeners to prevent duplicates
    document.removeEventListener('click', handleTopbarClicks);
    
    // Add new event listeners
    document.addEventListener('click', handleTopbarClicks);
}

// Handle theme and language clicks
function handleTopbarClicks(e) {
    // Handle theme toggle button
    if (e.target.closest('[data-theme-toggle]')) {
        e.preventDefault();
        // Get current theme from HTML classes
        const isDark = document.documentElement.classList.contains('dark');
        const nextTheme = isDark ? 'light' : 'dark';
        
        Livewire.dispatch('setTheme', { theme: nextTheme });
    }
    
    // Handle language selection
    if (e.target.closest('[data-locale]')) {
        const locale = e.target.closest('[data-locale]').dataset.locale;
        Livewire.dispatch('setLanguage', { locale: locale });
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', initializeTopbar);

// Reinitialize after Livewire navigation
document.addEventListener('livewire:navigated', initializeTopbar);

// Listen for Livewire initialization
document.addEventListener('livewire:initialized', function() {
    // Listen for theme changes from Livewire
    Livewire.on('theme-changed', function(data) {
        applyTheme(data.theme);
    });
});

// Listen for system theme changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
    const currentTheme = @js(session('theme', 'system'));
    if (currentTheme === 'system') {
        applyTheme('system');
    }
});
</script>