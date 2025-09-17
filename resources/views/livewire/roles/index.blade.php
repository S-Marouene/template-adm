<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Roles') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Manage user roles and their permissions') }}</p>
        </div>
        <flux:button :href="route('roles.create')" variant="primary" wire:navigate>
            <flux:icon name="plus" class="size-4" />
            {{ __('Add Role') }}
        </flux:button>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <flux:input
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('Search roles...') }}"
                clearable
            >
                <x-slot name="iconTrailing">
                    <flux:icon name="magnifying-glass" class="size-4" />
                </x-slot>
            </flux:input>
        </div>
    </div>

    <!-- Roles Table -->
    <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <button wire:click="sortBy('name')" class="group inline-flex">
                                {{ __('Name') }}
                                @if($sortField === 'name')
                                    <flux:icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="ml-2 size-4" />
                                @else
                                    <flux:icon name="chevron-up-down" class="ml-2 size-4 opacity-0 group-hover:opacity-100" />
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <button wire:click="sortBy('display_name')" class="group inline-flex">
                                {{ __('Display Name') }}
                                @if($sortField === 'display_name')
                                    <flux:icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="ml-2 size-4" />
                                @else
                                    <flux:icon name="chevron-up-down" class="ml-2 size-4 opacity-0 group-hover:opacity-100" />
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Description') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Users') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Permissions') }}
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($roles as $role)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $role->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $role->display_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 dark:text-gray-300 max-w-xs truncate">
                                    {{ $role->description ?: '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                    {{ $role->users_count }} {{ __('users') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                    {{ $role->permissions_count }} {{ __('permissions') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <flux:button 
                                    :href="route('roles.edit', $role)" 
                                    size="sm" 
                                    variant="subtle" 
                                    wire:navigate
                                >
                                    <flux:icon name="pencil" class="size-4" />
                                    {{ __('Edit') }}
                                </flux:button>
                                
                                <flux:button 
                                    wire:click="confirmDeleteRole({{ $role->id }})" 
                                    size="sm" 
                                    variant="danger"
                                >
                                    <flux:icon name="trash" class="size-4" />
                                    {{ __('Delete') }}
                                </flux:button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                {{ __('No roles found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($roles->hasPages())
            <div class="px-6 py-3 border-t border-gray-200 dark:border-zinc-700">
                {{ $roles->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($deleteRoleId)
        <flux:modal :show="$deleteRoleId !== null" class="max-w-lg">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('Delete Role') }}</flux:heading>
                    <flux:subheading>
                        {{ __('Are you sure you want to delete this role? This action cannot be undone.') }}
                    </flux:subheading>
                </div>

                <div class="flex justify-end space-x-3">
                    <flux:button wire:click="cancelDelete" variant="ghost">
                        {{ __('Cancel') }}
                    </flux:button>
                    <flux:button wire:click="deleteRole" variant="danger">
                        {{ __('Delete Role') }}
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endif

    <!-- Flash Messages -->
    @if(session('status'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md shadow-lg dark:bg-green-800 dark:border-green-700 dark:text-green-100">
                <div class="flex items-center">
                    <flux:icon name="check-circle" class="size-5 mr-2" />
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md shadow-lg dark:bg-red-800 dark:border-red-700 dark:text-red-100">
                <div class="flex items-center">
                    <flux:icon name="exclamation-circle" class="size-5 mr-2" />
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif
</div>