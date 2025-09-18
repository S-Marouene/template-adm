<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 text-body-emphasis">{{ __('Edit Role') }}</h1>
            <p class="text-body-secondary mb-0">{{ __('Update role information and permissions') }}</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary" wire:navigate>
            <i class="bi bi-arrow-left"></i>
            {{ __('Back to Roles') }}
        </a>
    </div>

    <!-- Role Form -->
    <div class="card">
        <div class="card-body">
            <form wire:submit="save">
                <!-- Role Information -->
                <div class="row g-3 mb-4">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">{{ __('Role Name') }}</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('e.g., admin, user') }}"
                            required
                            autofocus
                        >
                        <div class="form-text">
                            {{ __('System name (lowercase, no spaces)') }}
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Name -->
                    <div class="col-md-6">
                        <label for="display_name" class="form-label">{{ __('Display Name') }}</label>
                        <input
                            type="text"
                            id="display_name"
                            wire:model="display_name"
                            class="form-control @error('display_name') is-invalid @enderror"
                            placeholder="{{ __('e.g., Administrator, User') }}"
                            required
                        >
                        <div class="form-text">
                            {{ __('Human readable name') }}
                        </div>
                        @error('display_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea
                        id="description"
                        wire:model="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="{{ __('Describe what this role can do...') }}"
                        rows="3"
                    ></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Permissions -->
                <div class="mb-4">
                    <h4 class="h5 text-body-emphasis mb-3">{{ __('Permissions') }}</h4>
                    
                    @if($permissions->count() > 0)
                        <div class="row g-4">
                            @foreach($permissions as $group => $groupPermissions)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0 text-capitalize">{{ $group }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                @foreach($groupPermissions as $permission)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-check">
                                                            <input
                                                                type="checkbox"
                                                                id="permission_{{ $permission['id'] }}"
                                                                wire:model="selectedPermissions"
                                                                value="{{ $permission['id'] }}"
                                                                class="form-check-input"
                                                            >
                                                            <label class="form-check-label" for="permission_{{ $permission['id'] }}">
                                                                <div class="fw-medium">{{ $permission['display_name'] }}</div>
                                                                @if($permission['description'])
                                                                    <small class="text-body-secondary">{{ $permission['description'] }}</small>
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
                            <i class="bi bi-shield-exclamation display-1 text-body-secondary mb-3"></i>
                            <p class="text-body-secondary">{{ __('No permissions available. Create some permissions first.') }}</p>
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary mt-2" wire:navigate>
                                {{ __('Create Permission') }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary" wire:navigate>
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Role') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>