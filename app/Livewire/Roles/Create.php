<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public string $name = '';
    public string $display_name = '';
    public string $description = '';
    public array $selectedPermissions = [];

    public function mount(): void
    {
        // Initialize empty permissions array
        $this->selectedPermissions = [];
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'selectedPermissions' => ['array'],
            'selectedPermissions.*' => ['exists:permissions,id'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        if (!empty($this->selectedPermissions)) {
            $role->permissions()->sync($this->selectedPermissions);
        }

        session()->flash('status', 'Role created successfully!');

        $this->redirect(route('roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.roles.create', [
            'permissions' => Permission::all()->groupBy('group'),
        ]);
    }
}