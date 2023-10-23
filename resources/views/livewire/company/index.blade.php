<div>
    <x-index-header>
        <x-slot name="heading">
            <x-icon.companies class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Companies') }}
        </x-slot>
        <x-slot name="buttons">
            <x-button.link href="{{ route('companies.create') }}" class="inline-flex items-center justify-center">
                <x-icon.plus class="mr-2 -ml-1 align-middle" />
                {{ __('Add company') }}
            </x-button.link>
        </x-slot>
    </x-index-header>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <div class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                        <x-table.heading />
                    </x-slot>
                    <x-slot name="body">
                        @foreach($companies as $company)
                            <x-table.row>
                                <x-table.cell>{{ $company->name }}</x-table.cell>

                                <x-table.cell class="text-right">
                                    @if(auth()->user()->currentCompany()->is($company))
                                        <x-button.link
                                            href="{{ route('switch-company', $company) }}"
                                            class="text-gray-600 bg-cyan-600 hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.switch class="w-4 h-4 text-white-600" />
                                        </x-button.link>
                                    @else
                                        <x-button.link
                                            href="{{ route('switch-company', $company) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.switch class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endif
                                    @if(auth()->user()->isAdmin())
                                        <x-button.link
                                            href="{{ route('companies.edit', $company) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endif
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</div>
