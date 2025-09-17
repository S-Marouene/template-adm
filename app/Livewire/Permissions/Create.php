<?php

namespace App\Livewire\Permissions;

use App\Models\Permission;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public string $name = '';
    public string $display_name = '';
    public string $description = '';
    public string $group = 'general';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name', 'regex:/^[a-zA-Z0-9_.-]+$/'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'group' => ['required', 'string', 'max:255'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        Permission::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'group' => $this->group,
        ]);

        session()->flash('status', 'Permission created successfully!');

        $this->redirect(route('permissions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.permissions.create', [
            'existingGroups' => Permission::getGroups(),
        ]);
    }
}