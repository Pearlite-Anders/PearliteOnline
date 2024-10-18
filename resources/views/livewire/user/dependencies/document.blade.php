<div class="overflow-x-auto">
    <x-table>
        <x-slot name="head">
            @foreach($columns as $column)
                @continue($column->visible === false)

                <x-table.heading wire:click="sortBy('data->{{ $column->key }}')" sortable :multiColumn="false" :direction="$sorts['data->{{ $column->key }}'] ?? null">{{ App\Models\Document::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>

            @endforeach
            <x-table.heading />
        </x-slot>
        <x-slot name="body">
            @foreach($documents as $document)
                <x-table.row
                    :edit_link="route('documents.edit', $document)"
                    :can_edit="auth()->user()->can('update', $document)"
                    class="cursor-pointer hover:bg-gray-50"
                >
                    @foreach($columns as $column)
                        @continue($column->visible === false)
                        <x-table.model-value-cell
                            :key="$column->key"
                            :column="App\Models\Document::SYSTEM_COLUMNS[$column->key]"
                            :model="$document->currentRevision"
                        />
                    @endforeach

                    <x-table.cell class="text-right">
                        <div class="flex justify-end">
                            @can('update', $document)
                                <x-button.link
                                    href="{{ route('documents.edit', $document) }}"
                                    class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                >
                                    <x-icon.pencil class="w-4 h-4 text-gray-800" />
                                </x-button.link>
                            @endcan
                            @can('delete', $document)
                                <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                    @if($confirming == $document->id)
                                        <x-button
                                            wire:click="delete({{ $document->id }})"
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
                                            wire:click="confirmDelete({{ $document->id }})"
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
    @if ($documents->hasPages())
        <div class="px-6 py-4 bg-white border-t">
            {{ $documents->links() }}
        </div>
    @endif
</div>
