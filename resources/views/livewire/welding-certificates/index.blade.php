<div>
    <!-- listen for escape with a alpinejs block -->
    <div x-data @keydown.escape.window="$wire.cancelConfirmDelete"></div>

    <x-index-header :compressed_header="$compressed_header">
        <x-slot name="heading">
            <x-icon.welding-certificate class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Welding Certificates') }}
        </x-slot>
        <x-slot name="search">
            <div class="grid w-full grid-cols-1 gap-4 pr-16 md:grid-cols-8">
                @unless($hide_search)
                    <div class="relative col-span-2">
                        <input
                            type="search"
                            wire:model.live.debounce.500ms="search"
                            class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                            placeholder="{{ __('Global search..') }}"
                        />
                    </div>
                @endunless
                @unless($hide_filters)
                    <x-table-filters :filters="$filters" :model="$model" :filter_columns="$filter_columns" :show_modal="$showFilterSettingsModal" />
                @endunless
            </div>
        </x-slot>
        <x-slot name="buttons">
            <livewire:table-columns :columns="$columns" />
            @can('create', App\Models\WeldingCertificate::class)
                <x-button.link href="{{ route('welding-certificates.create').( $project_id ? '?project_id='. $project_id : '') }}" class="inline-flex items-center justify-center whitespace-nowrap">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add Welding Certificate') }}
                </x-button.link>

                @if($project_id)
                    @if($selected)
                        <x-button.secondary class="flex items-center" wire:click="detachFromProject">
                            <x-icon.minus class="mr-2 -ml-1 align-middle" />
                            {{ __('Detach from project') }}
                        </x-button.secondary>
                    @else
                        <livewire:attach-from-project
                            :model="App\Models\WeldingCertificate::class"
                            :project_id="$project_id"
                            :name="__('Welding Certificate')"
                            name_field="number"
                        />
                    @endif
                @else
                    @if($selected)
                        <livewire:attach-to-project
                            :model="App\Models\WeldingCertificate::class"
                            :selected="$selected"
                        />
                    @endif
                @endif
            @endcan
        </x-slot>
    </x-index-header>

    <div class="flex flex-col leading-6 text-black">
        @unless($hide_filters)
            <x-filter-status :filters="$filters" />
        @endunless
        <div class="overflow-x-auto">
            <x-table>
                <x-slot name="head">
                    <x-table.heading />
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
                        <x-table.row
                            :edit_link="route('welding-certificates.edit', $weldingCertificate)"
                            :can_edit="auth()->user()->can('update', $weldingCertificate)"
                            class="cursor-pointer hover:bg-gray-50"
                            :wire:key="$weldingCertificate->id"
                        >
                            <x-table.cell>
                                <div x-data @click.stop="console.log('stop')" class="flex items-center justify-center -mx-6 -my-1">
                                    <input
                                        type="checkbox"
                                        wire:model.live="selected"
                                        value="{{ $weldingCertificate->id }}"
                                        class="border-gray-300 rounded text-cyan-600 focus:ring-cyan-500"
                                    />
                                </div>
                            </x-table.cell>
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
                                            <x-icon.pencil class="w-4 h-4 text-gray-800" />
                                        </x-button.link>
                                    @endcan
                                    @can('delete', $weldingCertificate)
                                        <div class="flex" x-data @click.prevent.stop="console.log('stop')">
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
            @if ($weldingCertificates->hasPages())
                <div class="px-6 py-4 bg-white border-t">
                    {{ $weldingCertificates->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function dragDropFilters() {
    return {
        draggableColumns: @entangle('filter_columns'),
        draggingIndex: null,
        targetIndex: null,

        startDrag(event, index) {
            this.draggingIndex = index;
            event.dataTransfer.effectAllowed = 'move';
        },
        dragEnter(event, index) {
            this.targetIndex = index;
            event.target.closest('.draggable-column').classList.add('bg-gray-200');
        },
        dragLeave(event) {
            this.targetIndex = null;
            event.target.closest('.draggable-column').classList.remove('bg-gray-200');
        },
        drop(event, targetIndex) {
            if (this.draggingIndex !== null) {
                this.$wire.call('reorderFilters', this.draggingIndex, targetIndex);
            }
            this.draggingIndex = null;
            this.targetIndex = null;
            event.target.closest('.draggable-column').classList.remove('bg-gray-200');
        },
        endDrag(event) {
            this.targetIndex = null;
            event.target.closest('.draggable-column').classList.remove('drag-over');
        },
        toggleVisibility(column) {
            this.$wire.call('toggleFilterVisibility', column.label);
        }
    };
}
</script>
