<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="h2 fw-semibold mb-2">{{ __('Create Role') }}</h1>
            <p class="text-muted mb-0">{{ __('Create a new role and assign permissions') }}</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary" wire:navigate>
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('Back to Roles') }}
        </a>
    </div>

    <!-- Role Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form wire:submit="save">
                <!-- Role Information -->
                <div class="row g-3 mb-4">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">{{ __('Role Name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name" placeholder="{{ __('e.g., admin, user') }}" required autofocus>
                        <div class="form-text">{{ __('System name (lowercase, no spaces)') }}</div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Name -->
                    <div class="col-md-6">
                        <label for="display_name" class="form-label">{{ __('Display Name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" wire:model="display_name" placeholder="{{ __('e.g., Administrator, User') }}" required>
                        <div class="form-text">{{ __('Human readable name') }}</div>
                        @error('display_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description" placeholder="{{ __('Describe what this role can do...') }}" rows="3"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Permissions -->
                <div class="mb-4">
                    <h4 class="h5 fw-semibold mb-3">{{ __('Permissions') }}</h4>
                    
                    @if($permissions->count() > 0)
                        <div class="row g-3">
                            @foreach($permissions as $group => $groupPermissions)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-capitalize">{{ $group }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                @foreach($groupPermissions as $permission)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-check p-3 border rounded">
                                                            <input type="checkbox" class="form-check-input" id="permission_{{ $permission['id'] }}" wire:model="selectedPermissions" value="{{ $permission['id'] }}">
                                                            <label class="form-check-label w-100" for="permission_{{ $permission['id'] }}">
                                                                <div class="fw-medium">{{ $permission['display_name'] }}</div>
                                                                @if($permission['description'])
                                                                    <div class="text-muted small">{{ $permission['description'] }}</div>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-shield-exclamation display-1 text-muted"></i>
                            </div>
                            <p class="text-muted mb-3">{{ __('No permissions available. Create some permissions first.') }}</p>
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary" wire:navigate>
                                <i class="bi bi-plus me-1"></i>
                                {{ __('Create Permission') }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <hr class="my-4">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary" wire:navigate>
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-shield-plus me-1"></i>
                        {{ __('Create Role') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>