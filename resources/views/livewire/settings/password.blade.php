<section class="container-fluid">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form method="POST" wire:submit="updatePassword">
            <div class="row g-3">
                <div class="col-12">
                    <label for="current_password" class="form-label">{{ __('Current password') }} <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" wire:model="current_password" required autocomplete="current-password">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('current_password')">
                            <i class="bi bi-eye" id="current_password-eye"></i>
                        </button>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">{{ __('New password') }} <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password" required autocomplete="new-password">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password')">
                            <i class="bi bi-eye" id="password-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" wire:model="password_confirmation" required autocomplete="new-password">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password_confirmation')">
                            <i class="bi bi-eye" id="password_confirmation-eye"></i>
                        </button>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-shield-check me-1"></i>
                            {{ __('Save') }}
                        </button>
                        
                        <x-action-message on="password-updated">
                            <span class="text-success">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ __('Saved.') }}
                            </span>
                        </x-action-message>
                    </div>
                </div>
            </div>
        </form>
    </x-settings.layout>
</section>

<script>
function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.className = 'bi bi-eye-slash';
    } else {
        field.type = 'password';
        eye.className = 'bi bi-eye';
    }
}
</script>
