<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="h2 fw-semibold mb-2">{{ __('Create User') }}</h1>
            <p class="text-muted mb-0">{{ __('Add a new user to the system') }}</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary" wire:navigate>
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('Back to Users') }}
        </a>
    </div>

    <!-- User Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form wire:submit="save" class="row g-3">
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" placeholder="{{ __('Enter full name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email" placeholder="{{ __('Enter email address') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-md-6">
                    <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password" placeholder="{{ __('Enter password') }}" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password')">
                            <i class="bi bi-eye" id="password-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" wire:model="password_confirmation" placeholder="{{ __('Confirm password') }}" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password_confirmation')">
                            <i class="bi bi-eye" id="password_confirmation-eye"></i>
                        </button>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" wire:model="phone" placeholder="{{ __('Enter phone number') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-md-6">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" wire:model="address" placeholder="{{ __('Enter address') }}" rows="3"></textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Profile Picture -->
                <div class="col-12">
                    <label class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if ($profile_picture)
                                <img src="{{ $profile_picture->temporaryUrl() }}" class="rounded-circle" width="80" height="80" alt="Profile preview" style="object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="bi bi-person-fill text-white fs-2"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" wire:model="profile_picture" accept="image/*">
                            <div class="form-text">{{ __('Upload a profile picture (max 2MB, JPG, PNG, GIF)') }}</div>
                            @error('profile_picture')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($profile_picture)
                            <div class="col-auto">
                                <button type="button" class="btn btn-outline-danger btn-sm" wire:click="$set('profile_picture', null)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Roles -->
                <div class="col-12">
                    <label class="form-label">{{ __('Assign Roles') }}</label>
                    @if($roles->count() > 0)
                        <div class="row g-2">
                            @foreach($roles as $role)
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-check p-3 border rounded">
                                        <input type="checkbox" class="form-check-input" id="role_{{ $role->id }}" wire:model="selectedRoles" value="{{ $role->id }}">
                                        <label class="form-check-label w-100" for="role_{{ $role->id }}">
                                            <div class="fw-medium">{{ $role->display_name }}</div>
                                            @if($role->description)
                                                <div class="text-muted small">{{ $role->description }}</div>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">{{ __('No roles available.') }}</p>
                    @endif
                </div>

                <!-- Actions -->
                <div class="col-12">
                    <hr class="my-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary" wire:navigate>
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus me-1"></i>
                            {{ __('Create User') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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