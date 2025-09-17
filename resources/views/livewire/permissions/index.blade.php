<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Permissions') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Manage system permissions') }}</p>
        </div>
        <flux:button :href="route('permissions.create')" variant="primary" wire:navigate>
            <flux:icon name="plus" class="size-4" />
            {{ __('Add Permission') }}
        </flux:button>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <flux:input
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('Search permissions...') }}"
                clearable
            >
                <x-slot name="iconTrailing">
                    <flux:icon name="magnifying-glass" class="size-4" />
                </x-slot>
            </flux:input>
        </div>
        <div class="w-full sm:w-48">
            <select
                wire:model.live="selectedGroup"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
            >
                <option value="">{{ __('All Groups') }}</option>
                @foreach($groups as $group)
                    <option value="{{ $group }}">{{ ucfirst($group) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Permissions Table -->
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
                            <button wire:click="sortBy('group')" class="group inline-flex">
                                {{ __('Group') }}
                                @if($sortField === 'group')
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
                            {{ __('Roles') }}
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($permissions as $permission)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white font-mono">
                                    {{ $permission->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $permission->display_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 capitalize">
                                    {{ $permission->group }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 dark:text-gray-300 max-w-xs truncate">
                                    {{ $permission->description ?: '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                    {{ $permission->roles_count }} {{ __('roles') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <flux:button 
                                    :href="route('permissions.edit', $permission)" 
                                    size="sm" 
                                    variant="subtle" 
                                    wire:navigate
                                >
                                    <flux:icon name="pencil" class="size-4" />
                                    {{ __('Edit') }}
                                </flux:button>
                                
                                <flux:button 
                                    wire:click="confirmDeletePermission({{ $permission->id }})" 
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
                                {{ __('No permissions found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($permissions->hasPages())
            <div class="px-6 py-3 border-t border-gray-200 dark:border-zinc-700">
                {{ $permissions->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($deletePermissionId)
        <flux:modal :show="$deletePermissionId !== null" class="max-w-lg">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('Delete Permission') }}</flux:heading>
                    <flux:subheading>
                        {{ __('Are you sure you want to delete this permission? This action cannot be undone.') }}
                    </flux:subheading>
                </div>

                <div class="flex justify-end space-x-3">
                    <flux:button wire:click="cancelDelete" variant="ghost">
                        {{ __('Cancel') }}
                    </flux:button>
                    <flux:button wire:click="deletePermission" variant="danger">
                        {{ __('Delete Permission') }}
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