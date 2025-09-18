<section class="container-fluid">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="mb-5">
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email" required autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                        <div class="mt-3 p-3 bg-warning-subtle border border-warning rounded">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                <div>
                                    <p class="mb-1 fw-medium">{{ __('Your email address is unverified.') }}</p>
                                    <button type="button" class="btn btn-link p-0 text-decoration-underline" wire:click.prevent="resendVerificationNotification">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </div>
                            </div>
                            
                            @if (session('status') === 'verification-link-sent')
                                <div class="mt-2 text-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

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
