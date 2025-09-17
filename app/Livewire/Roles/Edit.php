<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Edit extends Component
{
    public Role $role;
    public string $name = '';
    public string $display_name = '';
    public string $description = '';
    public array $selectedPermissions = [];

    public function mount(Role $role): void
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->display_name = $role->display_name;
        $this->description = $role->description ?? '';
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($this->role->id), 'regex:/^[a-zA-Z0-9_-]+$/'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'selectedPermissions' => ['array'],
            'selectedPermissions.*' => ['exists:permissions,id'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->role->update([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        $this->role->permissions()->sync($this->selectedPermissions);

        session()->flash('status', 'Role updated successfully!');

        $this->redirect(route('roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.roles.edit', [
            'permissions' => Permission::all()->groupBy('group'),
        ]);
    }
}