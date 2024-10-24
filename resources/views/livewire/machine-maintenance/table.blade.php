<div>
    @unless($hide_filters)
        <x-filter-status :filters="$filters" />
    @endunless
    <div class="overflow-x-auto">
        <x-table>
            <x-slot name="head">
                @foreach($columns as $column)
                    @continue($column->visible === false)
                    @if(
                        App\Models\MachineMaintenance::SYSTEM_COLUMNS[$column->key]['type'] == 'relationship' ||
                        App\Models\MachineMaintenance::SYSTEM_COLUMNS[$column->key]['type'] == 'calculated'
                    )
                        <x-table.heading wire:click="sortBy('{{ $column->key }}' )" sortable :multiColumn="false" :direction="$sorts['{{ $column->key }}'] ?? null">{{ App\Models\MachineMaintenance::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                    @else
                        <x-table.heading wire:click="sortBy('data->{{ $column->key }}')" sortable :multiColumn="false" :direction="$sorts['data->{{ $column->key }}'] ?? null">{{ App\Models\MachineMaintenance::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                    @endif
                @endforeach
                <x-table.heading />
            </x-slot>
            <x-slot name="body">
                @foreach($machineMaintenances as $machineMaintenance)
                    <x-table.row
                        :edit_link="route('machine-maintenance.edit', $machineMaintenance)"
                        :can_edit="auth()->user()->can('update', $machineMaintenance)"
                        class="cursor-pointer hover:bg-gray-50"
                    >
                        @foreach($columns as $column)
                            @continue($column->visible === false)
                            <x-table.model-value-cell
                                :key="$column->key"
                                :column="App\Models\MachineMaintenance::SYSTEM_COLUMNS[$column->key]"
                                :model="$machineMaintenance"
                            />
                        @endforeach

                        <x-table.cell class="text-right">
                            <div class="flex">
                                @can('update', $machineMaintenance)
                                    <x-button.link
                                        href="{{ route('machine-maintenance.edit', $machineMaintenance) }}"
                                        class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <x-icon.pencil class="w-4 h-4 text-gray-800" />
                                    </x-button.link>
                                @endcan
                                @can('delete', $machineMaintenance)
                                    <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                        @if($confirming == $machineMaintenance->id)
                                            <x-button
                                                wire:click="delete({{ $machineMaintenance->id }})"
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
                                                wire:click="confirmDelete({{ $machineMaintenance->id }})"
                                                class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                            >
                                                <x-icon.trash class="w-4 h-4 text-red-600" />
                                            </x-button>
                                        @endif
                                    </div>
                                @endcan
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
        <div class="overflow-hidden">
        </div>
        @if ($machineMaintenances->hasPages())
            <div class="px-6 py-4 bg-white border-t">
                {{ $machineMaintenances->links() }}
            </div>
        @endif
    </div>
</div>
