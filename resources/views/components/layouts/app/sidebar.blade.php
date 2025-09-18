<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" data-bs-theme="{{ session('theme', 'system') === 'dark' ? 'dark' : (session('theme', 'system') === 'light' ? 'light' : (request()->cookie('theme') === 'dark' ? 'dark' : 'light')) }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        <!-- Main Layout -->
        <div class="d-flex vh-100">
            <!-- Sidebar -->
            <div class="sidebar d-lg-block offcanvas-lg offcanvas-start" id="sidebar">
                <div class="d-flex flex-column h-100 p-3">
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-4 text-decoration-none" wire:navigate>
                        <x-app-logo />
                    </a>

                    <!-- Navigation -->
                    <nav class="flex-grow-1">
                        <h6 class="text-muted text-uppercase small fw-bold mb-3">{{ __('app.platform') }}</h6>
                        <ul class="nav nav-pills flex-column mb-4">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" wire:navigate>
                                    <i class="bi bi-house me-2"></i>
                                    {{ __('app.dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}" wire:navigate>
                                    <i class="bi bi-people me-2"></i>
                                    {{ __('app.users') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}" wire:navigate>
                                    <i class="bi bi-shield-check me-2"></i>
                                    {{ __('app.roles') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}" href="{{ route('permissions.index') }}" wire:navigate>
                                    <i class="bi bi-key me-2"></i>
                                    {{ __('app.permissions') }}
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Bottom Links and User Profile -->
                    <div class="mt-auto">
                        <ul class="nav nav-pills flex-column mb-3">
                            <li class="nav-item">
                                <a class="nav-link" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                                    <i class="bi bi-github me-2"></i>
                                    {{ __('app.repository') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                                    <i class="bi bi-book me-2"></i>
                                    {{ __('app.documentation') }}
                                </a>
                            </li>
                        </ul>

                        <!-- User Profile -->
                        <div class="dropdown dropup">
                            <button class="btn btn-outline-secondary w-100 d-flex align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <span class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.875rem;">
                                    {{ auth()->user()->initials() }}
                                </span>
                                <div class="flex-grow-1 text-start">
                                    <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                                    <div class="text-muted small">{{ auth()->user()->email }}</div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end w-100">
                                <li><a class="dropdown-item" href="{{ route('settings.profile') }}" wire:navigate>
                                    <i class="bi bi-gear me-2"></i>
                                    {{ __('app.settings') }}
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
            </div>

            <!-- Main Content Area -->
            <div class="main-content">
                <!-- Topbar -->
                <x-topbar />
                
                <!-- Page Content -->
                <main class="flex-grow-1 overflow-auto p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
    </body>
</html>