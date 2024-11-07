<div class="overflow-x-auto">
    <x-table>
        <x-slot name="head">
            <x-table.heading />
            @foreach($columns as $column)
                @continue($column->visible === false)
                @if(
                    App\Models\Wpqr::SYSTEM_COLUMNS[$column->key]['type'] == 'relationship' ||
                    App\Models\Wpqr::SYSTEM_COLUMNS[$column->key]['type'] == 'calculated'
                )
                    <x-table.heading wire:click="sortBy('{{ $column->key }}' )" sortable :multiColumn="false" :direction="$sorts['{{ $column->key }}'] ?? null">{{ App\Models\Wpqr::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                @else
                    <x-table.heading wire:click="sortBy('data->{{ $column->key }}')" sortable :multiColumn="false" :direction="$sorts['data->{{ $column->key }}'] ?? null">{{ App\Models\Wpqr::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                @endif
            @endforeach
            <x-table.heading />
        </x-slot>
        <x-slot name="body">
            @foreach($wpqrs as $wpqr)
                <x-table.row
                    :edit_link="route($editRoute, $wpqr)"
                    :can_edit="auth()->user()->can('update', $wpqr)"
                    class="cursor-pointer hover:bg-gray-50"
                >
                    <x-table.cell>
                        <div x-data @click.stop="console.log('stop')" class="flex items-center justify-center -mx-6 -my-1">
                            <input
                                type="checkbox"
                                wire:model.live="selected"
                                value="{{ $wpqr->id }}"
                                class="border-gray-300 rounded text-cyan-600 focus:ring-cyan-500"
                            />
                        </div>
                    </x-table.cell>
                    @foreach($columns as $column)
                        @continue($column->visible === false)
                        <x-table.model-value-cell
                            :key="$column->key"
                            :column="App\Models\Wpqr::SYSTEM_COLUMNS[$column->key]"
                            :model="$wpqr"
                        />
                    @endforeach

                    <x-table.cell class="text-right">
                        <div class="flex">
                            @can('update', $wpqr)
                                <x-button.link
                                    href="{{ route($editRoute, $wpqr) }}"
                                    class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                >
                                    <x-icon.pencil class="w-4 h-4 text-gray-800" />
                                </x-button.link>
                            @endcan
                            @can('delete', $wpqr)
                                <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                    @if($confirming == $wpqr->id)
                                        <x-button
                                            type="button"
                                            wire:click="delete({{ $wpqr->id }})"
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
                                            wire:click="confirmDelete({{ $wpqr->id }})"
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
    @if ($wpqrs->hasPages())
        <div class="px-6 py-4 bg-white border-t">
            {{ $wpqrs->links() }}
        </div>
    @endif
</div>
