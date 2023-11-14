<div>
    <!-- listen for escape with a alpinejs block -->
    <div x-data @keydown.escape.window="$wire.cancelConfirmDelete"></div>

    <x-index-header>
        <x-slot name="heading">
            <x-icon.welding-certificate class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Welding Certificates') }}
        </x-slot>
        <x-slot name="search">
            <div class="flex space-x-2">
                <div class="relative mt-1 lg:w-64 xl:w-64">
                    <input
                        type="search"
                        wire:model.live.debounce.500ms="search"
                        class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                        placeholder="{{ __('Search..') }}"
                    />
                </div>
                <x-table-filters :filters="$filters" :model="$model" :filter_columns="$filter_columns" />
            </div>
        </x-slot>
        <x-slot name="buttons">
            <livewire:table-columns :columns="$columns" />
            @can('create', App\Models\WeldingCertificate::class)
                <x-button.link href="{{ route('welding-certificates.create') }}" class="inline-flex items-center justify-center">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add Welding Certificate') }}
                </x-button.link>
            @endcan
        </x-slot>
    </x-index-header>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <x-table>
                <x-slot name="head">
                    @foreach($columns as $column)
                        @continue($column->visible === false)
                        @if(
                            App\Models\WeldingCertificate::SYSTEM_COLUMNS[$column->key]['type'] == 'relationship' ||
                            App\Models\WeldingCertificate::SYSTEM_COLUMNS[$column->key]['type'] == 'calculated'
                        )
                            <x-table.heading wire:click="sortBy('{{ $column->key }}' )" sortable :multiColumn="false" :direction="$sorts['{{ $column->key }}'] ?? null">{{ App\Models\WeldingCertificate::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                        @else
                            <x-table.heading wire:click="sortBy('data->{{ $column->key }}')" sortable :multiColumn="false" :direction="$sorts['data->{{ $column->key }}'] ?? null">{{ App\Models\WeldingCertificate::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                        @endif
                    @endforeach
                    <x-table.heading />
                </x-slot>
                <x-slot name="body">
                    @foreach($weldingCertificates as $weldingCertificate)
                        <x-table.row>
                            @foreach($columns as $column)
                                @continue($column->visible === false)
                                <x-table.model-value-cell
                                    :key="$column->key"
                                    :column="App\Models\WeldingCertificate::SYSTEM_COLUMNS[$column->key]"
                                    :model="$weldingCertificate"
                                />
                            @endforeach

                            <x-table.cell class="text-right">
                                <div class="flex">
                                    @can('update', $weldingCertificate)
                                        <x-button.link
                                            href="{{ route('welding-certificates.edit', $weldingCertificate) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endcan
                                    @can('delete', $weldingCertificate)
                                        @if($confirming == $weldingCertificate->id)
                                            <x-button
                                                wire:click="delete({{ $weldingCertificate->id }})"
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
                                                wire:click="confirmDelete({{ $weldingCertificate->id }})"
                                                class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                            >
                                                <x-icon.trash class="w-4 h-4 text-red-600" />
                                            </x-button>
                                        @endif
                                    @endcan
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            <div class="overflow-hidden">
            </div>
            @if ($weldingCertificates->hasPages())
                <div class="px-6 py-4 bg-white border-t">
                    {{ $weldingCertificates->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
