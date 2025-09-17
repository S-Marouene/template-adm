<?php

namespace App\Livewire\Roles;

use App\Models\Role;
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
    public string $sortField = 'created_at';

    #[Url(as: 'direction')]
    public string $sortDirection = 'desc';

    public ?int $deleteRoleId = null;

    public function updatedSearch(): void
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

    public function confirmDeleteRole(int $roleId): void
    {
        $this->deleteRoleId = $roleId;
    }

    public function deleteRole(): void
    {
        if ($this->deleteRoleId) {
            $role = Role::find($this->deleteRoleId);
            
            if ($role) {
                // Check if role is in use
                if ($role->users()->count() > 0) {
                    session()->flash('error', 'Cannot delete role that is assigned to users.');
                } else {
                    $role->delete();
                    session()->flash('status', 'Role deleted successfully!');
                }
            }
            
            $this->deleteRoleId = null;
        }
    }

    public function cancelDelete(): void
    {
        $this->deleteRoleId = null;
    }

    public function getRoles(): Builder
    {
        return Role::query()
            ->when($this->search, function (Builder $query) {
                $query->where(function (Builder $subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('display_name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->withCount(['users', 'permissions'])
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => $this->getRoles()->paginate(10),
        ]);
    }
}