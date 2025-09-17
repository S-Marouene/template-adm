<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Users Management Routes
    Route::get('users', App\Livewire\Users\Index::class)->name('users.index');
    Route::get('users/create', App\Livewire\Users\Create::class)->name('users.create');
    Route::get('users/{user}/edit', App\Livewire\Users\Edit::class)->name('users.edit');
    
    // Roles Management Routes
    Route::get('roles', App\Livewire\Roles\Index::class)->name('roles.index');
    Route::get('roles/create', App\Livewire\Roles\Create::class)->name('roles.create');
    Route::get('roles/{role}/edit', App\Livewire\Roles\Edit::class)->name('roles.edit');
    
    // Permissions Management Routes
    Route::get('permissions', App\Livewire\Permissions\Index::class)->name('permissions.index');
    Route::get('permissions/create', App\Livewire\Permissions\Create::class)->name('permissions.create');
    Route::get('permissions/{permission}/edit', App\Livewire\Permissions\Edit::class)->name('permissions.edit');
});

require __DIR__.'/auth.php';
