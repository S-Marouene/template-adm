<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class Create extends Component
{
    use WithFileUploads;
    
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone = '';
    public string $address = '';
    public $profile_picture;
    public array $selectedRoles = [];

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // 2MB max
            'selectedRoles' => ['array'],
            'selectedRoles.*' => ['exists:roles,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        // Handle profile picture upload
        if ($this->profile_picture) {
            $path = $this->profile_picture->store('profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $user = User::create($validated);
        
        // Assign roles to user
        if (!empty($this->selectedRoles)) {
            $user->roles()->sync($this->selectedRoles);
        }

        session()->flash('status', 'User created successfully!');

        $this->redirect(route('users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.users.create', [
            'roles' => Role::all(),
        ]);
    }
}