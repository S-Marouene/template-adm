<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 text-body-emphasis">{{ __('Edit Permission') }}</h1>
            <p class="text-body-secondary mb-0">{{ __('Update permission information') }}</p>
        </div>
        <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary" wire:navigate>
            <i class="bi bi-arrow-left"></i>
            {{ __('Back to Permissions') }}
        </a>
    </div>

    <!-- Permission Form -->
    <div class="card">
        <div class="card-body">
            <form wire:submit="save">
                <!-- Permission Information -->
                <div class="row g-3 mb-4">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">{{ __('Permission Name') }}</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('e.g., users.read, posts.write') }}"
                            required
                            autofocus
                        >
                        <div class="form-text">
                            {{ __('System name (use dots for namespacing)') }}
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
                            placeholder="{{ __('e.g., View Users, Create Posts') }}"
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

                <!-- Group and Description -->
                <div class="row g-3 mb-4">
                    <!-- Group -->
                    <div class="col-md-6">
                        <label for="group" class="form-label">{{ __('Group') }}</label>
                        <input
                            type="text"
                            id="group"
                            wire:model="group"
                            list="existing-groups"
                            class="form-control @error('group') is-invalid @enderror"
                            placeholder="{{ __('e.g., users, posts, dashboard') }}"
                            required
                        >
                        <datalist id="existing-groups">
                            @foreach($existingGroups as $existingGroup)
                                <option value="{{ $existingGroup }}">{{ ucfirst($existingGroup) }}</option>
                            @endforeach
                        </datalist>
                        <div class="form-text">
                            {{ __('Group to organize permissions') }}
                        </div>
                        @error('group')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea
                            id="description"
                            wire:model="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="{{ __('Describe what this permission allows...') }}"
                            rows="3"
                        ></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary" wire:navigate>
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Permission') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>