<div>
    <!-- listen for escape with a alpinejs block -->
    <div x-data @keydown.escape.window="$wire.cancelConfirmDelete"></div>

    <x-form-header backlink="{{ route('documents.show', ['document' => $this->document->id]) }}">
        <x-slot name="title">{{ __('Document revisions') }}</x-slot>
    </x-form-header>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <x-table>
                <x-slot name="head">
                    <x-table.heading :multiColumn="false" class="text-left">{{ __('revision date') }}</x-table.heading>
                    @foreach($columns as $column)
                        @continue($column->visible === false)
                        <x-table.heading :multiColumn="false" class="text-left">{{ App\Models\DocumentRevision::SYSTEM_COLUMNS[$column->key]['label'] }}</x-table.heading>
                    @endforeach
                    <x-table.heading />
                </x-slot>
                <x-slot name="body">
                    @foreach($revisions as $revision)
                        <x-table.row
                            class="cursor-pointer hover:bg-gray-50"
                        >
                            <x-table.cell>
                                {{ $revision->created_at->format('Y-m-d H:i') }}
                            </x-table.cell>
                            @foreach($columns as $column)
                                @continue($column->visible === false)
                                <x-table.model-value-cell
                                    :key="$column->key"
                                    :column="App\Models\DocumentRevision::SYSTEM_COLUMNS[$column->key]"
                                    :model="$revision"
                                />
                            @endforeach

                            @if($revision->id == $document->currentRevision->id)
                                <x-table.cell class="text-left">
                                    <span class="text-gray-600 px-4 py-2">{{ __('Current') }}</span>
                                </x-table.cell>
                            @else
                                <x-table.cell class="text-right">
                                    <div class="flex">
                                        @can('view', $revision->document)
                                            <x-button.link
                                                href="{{ route('documents.show', [$revision->document->id, 'revision' => $revision->id]) }}"
                                                class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900 leading-none"
                                                target="_blank"
                                            >
                                                <span class="text-gray-800 leading-none">
                                                    {{ __('Preview') }}
                                                </span>
                                            </x-button.link>
                                        @endcan
                                        @can('update', $revision->document)
                                            <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                                @if($confirmingRestore == $revision->id)
                                                    <x-button
                                                        wire:click="restore({{ $revision->id }})"
                                                        class="bg-red-700 hover:bg-red-800"
                                                    >
                                                        <x-icon.check class="w-4 h-4 text-white" />
                                                    </x-button>
                                                    <x-button
                                                        wire:click="cancelConfirmRestore"
                                                        class="bg-cyan-600 hover:bg-cyan-700"
                                                    >
                                                        <x-icon.x class="w-4 h-4 text-white" />
                                                    </x-button>
                                                @else
                                                    <x-button
                                                        wire:click="confirmRestore({{ $revision->id }})"
                                                        class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                                    >
                                                        <span class="text-gray-800 leading-none">
                                                            {{ __('Restore') }}
                                                        </span>
                                                    </x-button>
                                                @endif
                                            </div>
                                        @endcan

                                        @can('delete', $revision->document)
                                            <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                                @if($confirming == $revision->id)
                                                    <x-button
                                                        wire:click="delete({{ $revision->id }})"
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
                                                        wire:click="confirmDelete({{ $revision->id }})"
                                                        class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                                    >
                                                        <x-icon.trash class="w-4 h-4 text-red-600" />
                                                    </x-button>
                                                @endif
                                            </div>
                                        @endcan
                                    </div>
                                </x-table.cell>
                            @endif
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            <div class="overflow-hidden">
            </div>
            @if ($revisions->hasPages())
                <div class="px-6 py-4 bg-white border-t">
                    {{ $revisions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
