<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Create Role') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Create a new role and assign permissions') }}</p>
        </div>
        <flux:button :href="route('roles.index')" variant="ghost" wire:navigate>
            <flux:icon name="arrow-left" class="size-4" />
            {{ __('Back to Roles') }}
        </flux:button>
    </div>

    <!-- Role Form -->
    <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-lg">
        <form wire:submit="save" class="p-6 space-y-6">
            <!-- Role Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <flux:input
                        wire:model="name"
                        label="{{ __('Role Name') }}"
                        placeholder="{{ __('e.g., admin, user') }}"
                        required
                        autofocus
                    />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('System name (lowercase, no spaces)') }}
                    </p>
                </div>

                <!-- Display Name -->
                <div>
                    <flux:input
                        wire:model="display_name"
                        label="{{ __('Display Name') }}"
                        placeholder="{{ __('e.g., Administrator, User') }}"
                        required
                    />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('Human readable name') }}
                    </p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Description') }}</label>
                <textarea
                    wire:model="description"
                    placeholder="{{ __('Describe what this role can do...') }}"
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                ></textarea>
            </div>

            <!-- Permissions -->
            <div>
                <flux:heading size="lg" class="mb-4">{{ __('Permissions') }}</flux:heading>
                
                @if($permissions->count() > 0)
                    <div class="space-y-6">
                        @foreach($permissions as $group => $groupPermissions)
                            <div class="border border-gray-200 dark:border-zinc-700 rounded-lg p-4">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-3 capitalize">
                                    {{ $group }}
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($groupPermissions as $permission)
                                        <label class="flex items-center space-x-3 cursor-pointer p-2 rounded hover:bg-gray-50 dark:hover:bg-zinc-700">
                                            <input
                                                type="checkbox"
                                                wire:model="selectedPermissions"
                                                value="{{ $permission['id'] }}"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                            />
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $permission['display_name'] }}
                                                </div>
                                                @if($permission['description'])
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $permission['description'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 text-gray-500 dark:text-gray-400">
                        <flux:icon name="shield-exclamation" class="size-12 mx-auto mb-2" />
                        <p>{{ __('No permissions available. Create some permissions first.') }}</p>
                        <flux:button :href="route('permissions.create')" variant="primary" class="mt-3" wire:navigate>
                            {{ __('Create Permission') }}
                        </flux:button>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                <flux:button :href="route('roles.index')" variant="ghost" wire:navigate>
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ __('Create Role') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>