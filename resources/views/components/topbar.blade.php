@php
use Illuminate\Support\Facades\Storage;
@endphp

<nav class="navbar navbar-expand-lg topbar">
    <div class="container-fluid">
        <!-- Left Side - Mobile Toggle -->
        <button class="btn btn-outline-secondary d-lg-none me-2" type="button" data-sidebar-toggle>
            <i class="bi bi-list"></i>
        </button>

        <!-- Right Side - Actions -->
        <div class="navbar-nav ms-auto d-flex flex-row align-items-center gap-2">
            <!-- Language Switcher -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-globe me-1"></i>
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" data-locale="en">
                        <span class="me-2">🇺🇸</span>English
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-locale="fr">
                        <span class="me-2">🇫🇷</span>Français
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-locale="es">
                        <span class="me-2">🇪🇸</span>Español
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-locale="ar">
                        <span class="me-2">🇸🇦</span>العربية
                    </a></li>
                </ul>
            </div>

            <!-- Theme Toggle Button -->
            <button class="btn btn-outline-secondary btn-sm" data-theme-toggle>
                <i class="bi bi-sun theme-icon light-icon"></i>
                <i class="bi bi-moon theme-icon dark-icon d-none"></i>
                <i class="bi bi-display theme-icon system-icon d-none"></i>
            </button>

            <!-- User Menu -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile" class="rounded-circle object-fit-cover me-2" style="width: 24px; height: 24px;">
                    @else
                        <span class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px; font-size: 0.75rem;">
                            {{ auth()->user()->initials() }}
                        </span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                    <li class="px-3 py-2">
                        <div class="d-flex align-items-center">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile" class="rounded-circle object-fit-cover me-2" style="width: 32px; height: 32px;">
                            @else
                                <span class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.875rem;">
                                    {{ auth()->user()->initials() }}
                                </span>
                            @endif
                            <div class="flex-grow-1">
                                <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                                <div class="text-muted small">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('settings.profile') }}" wire:navigate>
                        <i class="bi bi-person me-2"></i>
                        {{ __('app.profile') }}
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('settings.password') }}" wire:navigate>
                        <i class="bi bi-key me-2"></i>
                        {{ __('app.password') }}
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                {{ __('app.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

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
    icons.forEach(icon => icon.classList.add('d-none'));
    
    if (theme === 'dark') {
        html.setAttribute('data-bs-theme', 'dark');
        document.querySelector('.dark-icon')?.classList.remove('d-none');
    } else if (theme === 'light') {
        html.setAttribute('data-bs-theme', 'light');
        document.querySelector('.light-icon')?.classList.remove('d-none');
    } else { // system
        document.querySelector('.system-icon')?.classList.remove('d-none');
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            html.setAttribute('data-bs-theme', 'dark');
        } else {
            html.setAttribute('data-bs-theme', 'light');
        }
    }
};

// Store reference to the click handler to properly remove it
let topbarClickHandler = null;

// Handle theme and language clicks
function handleTopbarClicks(e) {
    // Handle theme toggle button
    if (e.target.closest('[data-theme-toggle]')) {
        e.preventDefault();
        // Get current theme from HTML attributes
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        Livewire.dispatch('setTheme', { theme: nextTheme });
    }
    
    // Handle language selection
    if (e.target.closest('[data-locale]')) {
        const locale = e.target.closest('[data-locale]').dataset.locale;
        Livewire.dispatch('setLanguage', { locale: locale });
    }
}

// Initialize theme and event listeners
function initializeTopbar() {
    // Theme management
    const theme = @js(session('theme', 'system'));
    applyTheme(theme);
    
    // Remove existing event listener if it exists
    if (topbarClickHandler) {
        document.removeEventListener('click', topbarClickHandler);
    }
    
    // Store and add new event listener
    topbarClickHandler = handleTopbarClicks;
    document.addEventListener('click', topbarClickHandler);
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