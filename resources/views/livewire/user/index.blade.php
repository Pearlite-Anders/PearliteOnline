<div>
    <div class="items-center justify-between block p-4 bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
      <div class="w-full mb-1 text-black">
        <div class="my-2 md:my-4">
          <h1 class="m-0 text-xl font-semibold leading-7 text-gray-900 sm:text-2xl sm:leading-8">
            {{ __('Users') }}
          </h1>
        </div>
        <div class="sm:flex">
          <div class="items-center hidden mb-3 sm:mb-0 sm:flex">

          </div>
          <div class="flex items-center ml-auto">
            @can('create', App\Models\User::class)
                <x-button.link href="{{ route('users.create') }}" class="inline-flex items-center justify-center">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add User') }}
                </x-button.link>
            @endcan
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <div class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                        <x-table.heading />
                    </x-slot>
                    <x-slot name="body">
                        @foreach($users as $user)
                            <x-table.row>
                                <x-table.cell>{{ $user->name }}</x-table.cell>

                                <x-table.cell class="text-right">
                                    @can('update', $user)
                                        <x-button.link
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
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
