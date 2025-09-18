<div class="row">
    <div class="col-md-3 col-lg-2 mb-4">
        <nav class="nav nav-pills flex-column">
            <a class="nav-link {{ request()->routeIs('settings.profile') ? 'active' : '' }}" href="{{ route('settings.profile') }}" wire:navigate>{{ __('Profile') }}</a>
            <a class="nav-link {{ request()->routeIs('settings.password') ? 'active' : '' }}" href="{{ route('settings.password') }}" wire:navigate>{{ __('Password') }}</a>
        </nav>
    </div>

    <div class="col-md-9 col-lg-10">
        <div class="mb-4">
            <h2 class="h4 fw-semibold mb-1">{{ $heading ?? '' }}</h2>
            <p class="text-muted mb-0">{{ $subheading ?? '' }}</p>
        </div>

        <div class="col-lg-8">
            {{ $slot }}
        </div>
    </div>
</div>
