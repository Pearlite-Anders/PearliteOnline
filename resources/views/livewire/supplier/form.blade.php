<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Supplier') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\Supplier::SYSTEM_COLUMNS as $key => $column)
            @if(in_array($column['type'], ['file', 'welding_certificate']) || optional($column)['hidden']) @continue @endif
            @include('livewire.common.field')
        @endforeach

    </div>
</div>

<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="mb-4 leading-6 text-black bg-white rounded-lg shadow">
        <div class="p-4 xl:p-8 sm:p-6">
            <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Documents') }}
            </h3>
            <div class="grid grid-cols-1 gap-6">
                <x-input.filepond multiple wire:model="form.files"/>
            </div>
        </div>
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                <x-table.heading sortable>{{ __('Active') }}</x-table.heading>
                <x-table.heading sortable>{{ __('Upload date') }}</x-table.heading>
                <x-table.heading />
            </x-slot>
            <x-slot name="body">
                @foreach($form->documents as $document)
                    <x-table.row>
                        <x-table.cell>
                            @if ($document->file?->isPDF() || $document->file?->isImage())
                                <x-file-with-modal :file="$document->file" svg_location="left" icon_class="w-4 h-4" />
                            @else
                                <a
                                    href="{{ $document->file?->temporary_url_new() }}"
                                    class="inline-flex items-center text-sm cursor-pointer"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                    {{ $document->file?->name }}
                                </a>
                            @endif
                        </x-table.cell>

                        <x-table.cell>
                            <x-button wire:click="toggleStatus({{ $document->id }})" class="text-sm">
                                @if (isset($document->data['status']) && $document->data['status'] == 'active')
                                    <x-icon.check class="w-5 h-5 text-green-500" />
                                @else
                                    <x-icon.x class="w-5 h-5 text-red-500" />
                                @endif
                            </x-button>
                        </x-table.cell>

                        <x-table.cell>
                            {{ $document->created_at->format('Y.m.d') }}
                        </x-table.cell>

                        <x-table.cell class="text-right">
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
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>

    </div>
</div>
