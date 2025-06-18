<div>
    <!-- listen for escape with a alpinejs block -->
    <div x-data @keydown.escape.window="$wire.cancelConfirmDelete"></div>

    <x-index-header>
        <x-slot name="heading">
            <x-icon.users class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('System Users') }}
        </x-slot>
        <x-slot name="buttons">
            @can('create', App\Models\User::class)
                <x-button.link href="{{ route('backoffice.system-users.create') }}" class="inline-flex items-center justify-center">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add system User') }}
                </x-button.link>
            @endcan
        </x-slot>
    </x-index-header>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <div class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                        <x-table.heading sortable>{{ __('Role') }}</x-table.heading>
                        <x-table.heading />
                    </x-slot>
                    <x-slot name="body">
                        @foreach($users as $user)
                            <x-table.row :wire:key="$user->id">
                                <x-table.cell>{{ $user->name }}</x-table.cell>
                                <x-table.cell>{{ $user->humanRole() }}</x-table.cell>

                                <x-table.cell class="text-right">
                                    @can('update', $user)
                                        <x-button.link
                                            href="{{ route('backoffice.system-users.edit', $user) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endcan

                                    @can('delete', $user)
                                        @if($confirming == $user->id)
                                            <x-button
                                                wire:click="delete({{ $user->id }})"
                                                class="bg-red-700 hover:bg-red-800"
                                            >
                                                <x-icon.check class="w-4 h-4 text-white" />
                                            </x-button>
                                            <x-button
                                                wire:click="cancelConfirmDelete"
                                                class="bg-cyan-600 hover:bg-cyan-700"
                                            >
                                                <x-icon.x class="w-4 h-4 text-white" />
                                            </x-button>
                                        @else
                                            <x-button
                                                wire:click="confirmDelete({{ $user->id }})"
                                                class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                            >
                                                <x-icon.trash class="w-4 h-4 text-red-600" />
                                            </x-button>
                                        @endif
                                    @endcan
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
            @if ($users->hasPages())
                <div class="px-6 py-4 bg-white border-t">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
