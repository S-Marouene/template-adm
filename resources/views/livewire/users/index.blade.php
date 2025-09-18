@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="h2 fw-semibold mb-2">{{ __('Users') }}</h1>
            <p class="text-muted mb-0">{{ __('Manage user accounts and permissions') }}</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary" wire:navigate>
            <i class="bi bi-plus me-1"></i>
            {{ __('Add User') }}
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-12 col-sm-6">
            <div class="input-group">
                <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search users by name, email, phone, or address...') }}">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="min-width: 1200px;">
                <thead class="table-light">
                    <tr>
                        <th class="px-3 py-3 fw-medium">{{ __('Photo') }}</th>
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
                            <button type="button" class="btn btn-link p-0 text-decoration-none text-dark fw-medium" wire:click="sortBy('email')">
                                {{ __('Email') }}
                                @if($sortField === 'email')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-3 py-3 fw-medium">{{ __('Phone') }}</th>
                        <th class="px-3 py-3 fw-medium">{{ __('Address') }}</th>
                        <th class="px-3 py-3 fw-medium">{{ __('Email Verified') }}</th>
                        <th class="px-3 py-3 fw-medium">{{ __('Roles') }}</th>
                        <th class="px-3 py-3">
                            <button type="button" class="btn btn-link p-0 text-decoration-none text-dark fw-medium" wire:click="sortBy('created_at')">
                                {{ __('Created') }}
                                @if($sortField === 'created_at')
                                    <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="bi bi-chevron-expand ms-1 opacity-50"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-3 py-3 text-end fw-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="px-3 py-3">
                                @if($user->profile_picture)
                                    <img src="{{ Storage::url($user->profile_picture) }}" class="rounded-circle" width="40" height="40" alt="{{ $user->name }}" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-fill text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                <div class="fw-medium">{{ $user->name }}</div>
                            </td>
                            <td class="px-3 py-3 text-muted">{{ $user->email }}</td>
                            <td class="px-3 py-3">
                                @if($user->phone)
                                    <div class="text-muted">{{ $user->phone }}</div>
                                @else
                                    <span class="text-muted small">{{ __('Not provided') }}</span>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                @if($user->address)
                                    <div class="text-muted" style="max-width: 200px;" title="{{ $user->address }}">
                                        {{ Str::limit($user->address, 50) }}
                                    </div>
                                @else
                                    <span class="text-muted small">{{ __('Not provided') }}</span>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">{{ __('Verified') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('Unverified') }}</span>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                <div class="d-flex flex-wrap gap-1">
                                    @forelse($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->display_name }}</span>
                                    @empty
                                        <span class="text-muted small">{{ __('No roles') }}</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-3 py-3 text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-3 py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                                        <i class="bi bi-pencil me-1"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <button type="button" class="btn btn-sm btn-outline-danger" wire:click="confirmDeleteUser({{ $user->id }})">
                                            <i class="bi bi-trash me-1"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                {{ __('No users found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="card-footer bg-light">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($deleteUserId)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete User') }}</h5>
                        <button type="button" class="btn-close" wire:click="cancelDelete"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">{{ __('Are you sure you want to delete this user? This action cannot be undone.') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelDelete">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteUser">{{ __('Delete User') }}</button>
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
</div>