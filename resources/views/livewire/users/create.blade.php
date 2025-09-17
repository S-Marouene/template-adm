<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Create User') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Add a new user to the system') }}</p>
        </div>
        <flux:button :href="route('users.index')" variant="ghost" wire:navigate>
            <flux:icon name="arrow-left" class="size-4" />
            {{ __('Back to Users') }}
        </flux:button>
    </div>

    <!-- User Form -->
    <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-lg">
        <form wire:submit="save" class="p-6 space-y-6">
            <!-- Name -->
            <div>
                <flux:input
                    wire:model="name"
                    label="{{ __('Full Name') }}"
                    placeholder="{{ __('Enter full name') }}"
                    required
                    autofocus
                />
            </div>

            <!-- Email -->
            <div>
                <flux:input
                    wire:model="email"
                    label="{{ __('Email Address') }}"
                    type="email"
                    placeholder="{{ __('Enter email address') }}"
                    required
                />
            </div>

            <!-- Password -->
            <div>
                <flux:input
                    wire:model="password"
                    label="{{ __('Password') }}"
                    type="password"
                    placeholder="{{ __('Enter password') }}"
                    required
                    viewable
                />
            </div>

            <!-- Confirm Password -->
            <div>
                <flux:input
                    wire:model="password_confirmation"
                    label="{{ __('Confirm Password') }}"
                    type="password"
                    placeholder="{{ __('Confirm password') }}"
                    required
                    viewable
                />
            </div>

            <!-- Roles -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('Assign Roles') }}</label>
                @if($roles->count() > 0)
                    <div class="space-y-2">
                        @foreach($roles as $role)
                            <label class="flex items-center space-x-3 cursor-pointer p-2 rounded hover:bg-gray-50 dark:hover:bg-zinc-700">
                                <input
                                    type="checkbox"
                                    wire:model="selectedRoles"
                                    value="{{ $role->id }}"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                />
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $role->display_name }}
                                    </div>
                                    @if($role->description)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $role->description }}
                                        </div>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No roles available.') }}</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                <flux:button :href="route('users.index')" variant="ghost" wire:navigate>
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ __('Create User') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>