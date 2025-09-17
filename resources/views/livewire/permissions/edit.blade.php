<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Edit Permission') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Update permission information') }}</p>
        </div>
        <flux:button :href="route('permissions.index')" variant="ghost" wire:navigate>
            <flux:icon name="arrow-left" class="size-4" />
            {{ __('Back to Permissions') }}
        </flux:button>
    </div>

    <!-- Permission Form -->
    <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-lg">
        <form wire:submit="save" class="p-6 space-y-6">
            <!-- Permission Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <flux:input
                        wire:model="name"
                        label="{{ __('Permission Name') }}"
                        placeholder="{{ __('e.g., users.read, posts.write') }}"
                        required
                        autofocus
                    />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('System name (use dots for namespacing)') }}
                    </p>
                </div>

                <!-- Display Name -->
                <div>
                    <flux:input
                        wire:model="display_name"
                        label="{{ __('Display Name') }}"
                        placeholder="{{ __('e.g., View Users, Create Posts') }}"
                        required
                    />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('Human readable name') }}
                    </p>
                </div>
            </div>

            <!-- Group and Description -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Group -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Group') }}</label>
                    <input
                        type="text"
                        wire:model="group"
                        list="existing-groups"
                        placeholder="{{ __('e.g., users, posts, dashboard') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                    />
                    <datalist id="existing-groups">
                        @foreach($existingGroups as $existingGroup)
                            <option value="{{ $existingGroup }}">{{ ucfirst($existingGroup) }}</option>
                        @endforeach
                    </datalist>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('Group to organize permissions') }}
                    </p>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Description') }}</label>
                    <textarea
                        wire:model="description"
                        placeholder="{{ __('Describe what this permission allows...') }}"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                    ></textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                <flux:button :href="route('permissions.index')" variant="ghost" wire:navigate>
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ __('Update Permission') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>