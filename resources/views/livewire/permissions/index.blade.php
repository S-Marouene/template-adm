<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 text-body-emphasis">{{ __('Permissions') }}</h1>
            <p class="text-body-secondary mb-0">{{ __('Manage system permissions') }}</p>
        </div>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary" wire:navigate>
            <i class="bi bi-plus-lg"></i>
            {{ __('Add Permission') }}
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="position-relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="form-control pe-5"
                    placeholder="{{ __('Search permissions...') }}"
                >
                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 text-body-secondary"></i>
            </div>
        </div>
        <div class="col-md-4">
            <select wire:model.live="selectedGroup" class="form-select">
                <option value="">{{ __('All Groups') }}</option>
                @foreach($groups as $group)
                    <option value="{{ $group }}">{{ ucfirst($group) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Permissions Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>
                            <button wire:click="sortBy('name')" class="btn btn-link p-0 text-decoration-none d-flex align-items-center">
                                {{ __('Name') }}
                                @if($sortField === 'name')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th>
                            <button wire:click="sortBy('display_name')" class="btn btn-link p-0 text-decoration-none d-flex align-items-center">
                                {{ __('Display Name') }}
                                @if($sortField === 'display_name')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th>
                            <button wire:click="sortBy('group')" class="btn btn-link p-0 text-decoration-none d-flex align-items-center">
                                {{ __('Group') }}
                                @if($sortField === 'group')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Roles') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                        <tr>
                            <td>
                                <code class="small">{{ $permission->name }}</code>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $permission->display_name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary text-capitalize">{{ $permission->group }}</span>
                            </td>
                            <td>
                                <span class="text-body-secondary" style="max-width: 200px; display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $permission->description ?: '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $permission->roles_count }} {{ __('roles') }}</span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-outline-primary btn-sm" wire:navigate>
                                        <i class="bi bi-pencil"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <button wire:click="confirmDeletePermission({{ $permission->id }})" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-body-secondary">
                                {{ __('No permissions found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($permissions->hasPages())
            <div class="card-footer bg-light">
                {{ $permissions->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($deletePermissionId)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Permission') }}</h5>
                        <button type="button" class="btn-close" wire:click="cancelDelete"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-body-secondary">
                            {{ __('Are you sure you want to delete this permission? This action cannot be undone.') }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" wire:click="cancelDelete">
                            {{ __('Cancel') }}
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="deletePermission">
                            {{ __('Delete Permission') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Toast Messages -->
    @if(session('status'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
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
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
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