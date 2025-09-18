@php
use Illuminate\Support\Facades\Storage;
@endphp

<section class="container-fluid">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile information')">
        <form wire:submit="updateProfileInformation" class="mb-5">
            <!-- Profile Picture -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            @if($existing_profile_picture)
                                <img src="{{ Storage::url($existing_profile_picture) }}" alt="Profile" class="rounded-circle object-fit-cover" style="width: 80px; height: 80px;">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 1.5rem;">
                                    {{ auth()->user()->initials() }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" wire:model="profile_picture" accept="image/*">
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">{{ __('Upload a profile picture (Max: 2MB, JPG, PNG, GIF)') }}</div>
                            @if($existing_profile_picture)
                                <button type="button" class="btn btn-outline-danger btn-sm mt-2" wire:click="removeProfilePicture">
                                    <i class="bi bi-trash me-1"></i>
                                    {{ __('Remove Picture') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Basic Information -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email" required autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" wire:model="phone" autocomplete="tel">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" wire:model="address" rows="3" autocomplete="street-address"></textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email Verification Warning -->
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <div class="flex-grow-1">
                                <strong>{{ __('Your email address is unverified.') }}</strong><br>
                                <button type="button" class="btn btn-link p-0 text-decoration-underline" wire:click.prevent="resendVerificationNotification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <div class="mt-2 text-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Save Button -->
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            {{ __('Save') }}
                        </button>
                        
                        <x-action-message on="profile-updated">
                            <span class="text-success">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ __('Saved.') }}
                            </span>
                        </x-action-message>
                    </div>
                </div>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
