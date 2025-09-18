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
class Edit extends Component
{
    use WithFileUploads;
    public User $user;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone = '';
    public string $address = '';
    public $profile_picture;
    public array $selectedRoles = [];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
    }

    public function save(): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // 2MB max
            'selectedRoles' => ['array'],
            'selectedRoles.*' => ['exists:roles,id'],
        ];

        // Only validate password if it's provided
        if (!empty($this->password)) {
            $rules['password'] = ['required', 'string', 'confirmed', Rules\Password::defaults()];
        }

        $validated = $this->validate($rules);

        // Hash password if provided
        if (!empty($this->password)) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle profile picture upload
        if ($this->profile_picture) {
            // Delete old profile picture if exists
            if ($this->user->profile_picture) {
                Storage::disk('public')->delete($this->user->profile_picture);
            }
            
            $path = $this->profile_picture->store('profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $this->user->update($validated);
        
        // Update user roles
        $this->user->roles()->sync($this->selectedRoles);

        session()->flash('status', 'User updated successfully!');

        $this->redirect(route('users.index'), navigate: true);
    }

    public function removeProfilePicture(): void
    {
        if ($this->user->profile_picture) {
            Storage::disk('public')->delete($this->user->profile_picture);
            $this->user->update(['profile_picture' => null]);
            
            session()->flash('status', 'Profile picture removed successfully!');
        }
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'roles' => Role::all(),
        ]);
    }
}