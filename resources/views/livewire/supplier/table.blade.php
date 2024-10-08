<div>
    <x-filter-status :filters="$filters" />
    <div class="overflow-x-auto">
        <x-table>
            <x-slot name="head">
                @foreach($columns as $column)
                    @continue($column->visible === false)
                    @if(
                        App\Models\Supplier::SYSTEM_COLUMNS[$column->key]['type'] == 'relationship' ||
                        App\Models\Supplier::SYSTEM_COLUMNS[$column->key]['type'] == 'calculated'
                    )
                        <x-table.heading wire:click="sortBy('{{ $column->key }}' )" sortable :multiColumn="false" :direction="$sorts['{{ $column->key }}'] ?? null">{{ App\Models\Supplier::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                    @else
                        <x-table.heading wire:click="sortBy('data->{{ $column->key }}')" sortable :multiColumn="false" :direction="$sorts['data->{{ $column->key }}'] ?? null">{{ App\Models\Supplier::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                    @endif
                @endforeach
                <x-table.heading />
            </x-slot>
            <x-slot name="body">
                @foreach($suppliers as $supplier)
                    <x-table.row
                        :edit_link="route('supplier.edit', $supplier)"
                        :can_edit="!$hideActions && auth()->user()->can('update', $supplier)"
                        class="hover:bg-gray-50 cursor-pointer"
                    >
                        @foreach($columns as $column)
                            @continue($column->visible === false)
                            <x-table.model-value-cell
                                :key="$column->key"
                                :column="App\Models\Supplier::SYSTEM_COLUMNS[$column->key]"
                                :model="$supplier"
                            />
                        @endforeach

                        <x-table.cell class="text-right">
                            @if(!$hideActions)
                                <div class="flex">
                                    @can('update', $supplier)
                                        <x-button.link
                                            href="{{ route('supplier.edit', $supplier) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-800" />
                                        </x-button.link>
                                    @endcan
                                    @can('delete', $supplier)
                                        <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                            @if($confirming == $supplier->id)
                                                <x-button
                                                    wire:click="delete({{ $supplier->id }})"
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
                                                    wire:click="confirmDelete({{ $supplier->id }})"
                                                    class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                                >
                                                    <x-icon.trash class="w-4 h-4 text-red-600" />
                                                </x-button>
                                            @endif
                                        </div>
                                    @endcan
                                </div>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
        <div class="overflow-hidden">
        </div>
        @if ($suppliers->hasPages())
            <div class="px-6 py-4 bg-white border-t">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
</div>
