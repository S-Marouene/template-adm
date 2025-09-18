<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    
    public string $name = '';

    public string $email = '';
    
    public string $phone = '';
    
    public string $address = '';
    
    public $profile_picture;
    
    public $existing_profile_picture = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->existing_profile_picture = $user->profile_picture ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // 2MB max
        ]);

        // Handle profile picture upload
        if ($this->profile_picture) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new profile picture
            $path = $this->profile_picture->store('profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        
        // Update the existing profile picture for display
        $this->existing_profile_picture = $user->profile_picture;
        
        // Clear the uploaded file
        $this->profile_picture = null;

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
    
    /**
     * Remove the profile picture.
     */
    public function removeProfilePicture(): void
    {
        $user = Auth::user();
        
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        
        $user->update(['profile_picture' => null]);
        $this->existing_profile_picture = '';
        
        $this->dispatch('profile-updated', name: $user->name);
    }
}
