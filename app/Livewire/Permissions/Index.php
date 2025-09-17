<?php

namespace App\Livewire\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'sort')]
    public string $sortField = 'group';

    #[Url(as: 'direction')]
    public string $sortDirection = 'asc';

    #[Url(as: 'group')]
    public string $selectedGroup = '';

    public ?int $deletePermissionId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedGroup(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function confirmDeletePermission(int $permissionId): void
    {
        $this->deletePermissionId = $permissionId;
    }

    public function deletePermission(): void
    {
        if ($this->deletePermissionId) {
            $permission = Permission::find($this->deletePermissionId);
            
            if ($permission) {
                // Check if permission is in use
                if ($permission->roles()->count() > 0) {
                    session()->flash('error', 'Cannot delete permission that is assigned to roles.');
                } else {
                    $permission->delete();
                    session()->flash('status', 'Permission deleted successfully!');
                }
            }
            
            $this->deletePermissionId = null;
        }
    }

    public function cancelDelete(): void
    {
        $this->deletePermissionId = null;
    }

    public function getPermissions(): Builder
    {
        return Permission::query()
            ->when($this->search, function (Builder $query) {
                $query->where(function (Builder $subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('display_name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedGroup, function (Builder $query) {
                $query->where('group', $this->selectedGroup);
            })
            ->withCount('roles')
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.permissions.index', [
            'permissions' => $this->getPermissions()->paginate(10),
            'groups' => Permission::getGroups(),
        ]);
    }
}