<?php

namespace App\Livewire\Permissions;

use App\Models\Permission;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Edit extends Component
{
    public Permission $permission;
    public string $name = '';
    public string $display_name = '';
    public string $description = '';
    public string $group = '';

    public function mount(Permission $permission): void
    {
        $this->permission = $permission;
        $this->name = $permission->name;
        $this->display_name = $permission->display_name;
        $this->description = $permission->description ?? '';
        $this->group = $permission->group;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'name')->ignore($this->permission->id), 'regex:/^[a-zA-Z0-9_.-]+$/'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'group' => ['required', 'string', 'max:255'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->permission->update([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'group' => $this->group,
        ]);

        session()->flash('status', 'Permission updated successfully!');

        $this->redirect(route('permissions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.permissions.edit', [
            'existingGroups' => Permission::getGroups(),
        ]);
    }
}