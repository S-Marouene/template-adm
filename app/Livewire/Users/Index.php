<?php

namespace App\Livewire\Users;

use App\Models\User;
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

    public ?int $deleteUserId = null;

    public function mount(): void
    {
        // Ensure user has permission to manage users
        abort_unless(auth()->user(), 403);
    }

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

    public function confirmDeleteUser(int $userId): void
    {
        $this->deleteUserId = $userId;
    }

    public function deleteUser(): void
    {
        if ($this->deleteUserId) {
            $user = User::find($this->deleteUserId);
            
            if ($user && $user->id !== auth()->id()) {
                $user->delete();
                $this->dispatch('user-deleted', name: $user->name);
            }
            
            $this->deleteUserId = null;
        }
    }

    public function cancelDelete(): void
    {
        $this->deleteUserId = null;
    }

    public function getUsers(): Builder
    {
        return User::query()
            ->with('roles')
            ->when($this->search, function (Builder $query) {
                $query->where(function (Builder $subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => $this->getUsers()->paginate(10),
        ]);
    }
}