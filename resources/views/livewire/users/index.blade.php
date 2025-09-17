<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Users') }}</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Manage user accounts and permissions') }}</p>
        </div>
        <flux:button :href="route('users.create')" variant="primary" wire:navigate>
            <flux:icon name="plus" class="size-4" />
            {{ __('Add User') }}
        </flux:button>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <flux:input
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('Search users...') }}"
                clearable
            >
                <x-slot name="iconTrailing">
                    <flux:icon name="magnifying-glass" class="size-4" />
                </x-slot>
            </flux:input>
        </div>
    </div>

    <!-- Users Table -->
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
                            <button wire:click="sortBy('email')" class="group inline-flex">
                                {{ __('Email') }}
                                @if($sortField === 'email')
                                    <flux:icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="ml-2 size-4" />
                                @else
                                    <flux:icon name="chevron-up-down" class="ml-2 size-4 opacity-0 group-hover:opacity-100" />
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Email Verified') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Roles') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <button wire:click="sortBy('created_at')" class="group inline-flex">
                                {{ __('Created') }}
                                @if($sortField === 'created_at')
                                    <flux:icon name="{{ $sortDirection === 'asc' ? 'chevron-up' : 'chevron-down' }}" class="ml-2 size-4" />
                                @else
                                    <flux:icon name="chevron-up-down" class="ml-2 size-4 opacity-0 group-hover:opacity-100" />
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-500 text-white text-sm font-medium">
                                            {{ $user->initials() }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                        {{ __('Verified') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                        {{ __('Unverified') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($user->roles as $role)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                            {{ $role->display_name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('No roles') }}</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <flux:button 
                                    :href="route('users.edit', $user)" 
                                    size="sm" 
                                    variant="subtle" 
                                    wire:navigate
                                >
                                    <flux:icon name="pencil" class="size-4" />
                                    {{ __('Edit') }}
                                </flux:button>
                                
                                @if($user->id !== auth()->id())
                                    <flux:button 
                                        wire:click="confirmDeleteUser({{ $user->id }})" 
                                        size="sm" 
                                        variant="danger"
                                    >
                                        <flux:icon name="trash" class="size-4" />
                                        {{ __('Delete') }}
                                    </flux:button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                {{ __('No users found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-3 border-t border-gray-200 dark:border-zinc-700">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($deleteUserId)
        <flux:modal :show="$deleteUserId !== null" class="max-w-lg">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('Delete User') }}</flux:heading>
                    <flux:subheading>
                        {{ __('Are you sure you want to delete this user? This action cannot be undone.') }}
                    </flux:subheading>
                </div>

                <div class="flex justify-end space-x-3">
                    <flux:button wire:click="cancelDelete" variant="ghost">
                        {{ __('Cancel') }}
                    </flux:button>
                    <flux:button wire:click="deleteUser" variant="danger">
                        {{ __('Delete User') }}
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
</div>