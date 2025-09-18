<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="h2 fw-semibold mb-2">{{ __('Roles') }}</h1>
            <p class="text-muted mb-0">{{ __('Manage user roles and their permissions') }}</p>
        </div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary" wire:navigate>
            <i class="bi bi-plus me-1"></i>
            {{ __('Add Role') }}
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-12 col-sm-6">
            <div class="input-group">
                <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search roles...') }}">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Roles Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3 py-3">
                            <button type="button" class="btn btn-link p-0 text-decoration-none text-dark fw-medium" wire:click="sortBy('name')">
                                {{ __('Name') }}
                                @if($sortField === 'name')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-3 py-3">
                            <button type="button" class="btn btn-link p-0 text-decoration-none text-dark fw-medium" wire:click="sortBy('display_name')">
                                {{ __('Display Name') }}
                                @if($sortField === 'display_name')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-3 py-3 fw-medium">{{ __('Description') }}</th>
                        <th class="px-3 py-3 fw-medium">{{ __('Users') }}</th>
                        <th class="px-3 py-3 fw-medium">{{ __('Permissions') }}</th>
                        <th class="px-3 py-3 text-end fw-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td class="px-3 py-3">
                                <div class="fw-medium">{{ $role->name }}</div>
                            </td>
                            <td class="px-3 py-3">{{ $role->display_name }}</td>
                            <td class="px-3 py-3">
                                <div class="text-muted" style="max-width: 200px;">
                                    {{ $role->description ?: '-' }}
                                </div>
                            </td>
                            <td class="px-3 py-3">
                                <span class="badge bg-primary">{{ $role->users_count }} {{ __('users') }}</span>
                            </td>
                            <td class="px-3 py-3">
                                <span class="badge bg-success">{{ $role->permissions_count }} {{ __('permissions') }}</span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                                        <i class="bi bi-pencil me-1"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" wire:click="confirmDeleteRole({{ $role->id }})">
                                        <i class="bi bi-trash me-1"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                {{ __('No roles found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($roles->hasPages())
            <div class="card-footer bg-light">
                {{ $roles->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($deleteRoleId)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Role') }}</h5>
                        <button type="button" class="btn-close" wire:click="cancelDelete"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">{{ __('Are you sure you want to delete this role? This action cannot be undone.') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelDelete">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteRole">{{ __('Delete Role') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if(session('status'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast show" role="alert">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong class="me-auto">{{ __('Success') }}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast show" role="alert">
                <div class="toast-header bg-danger text-white">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <strong class="me-auto">{{ __('Error') }}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif
</div>