<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Welding certificate') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\WeldingCertificate::SYSTEM_COLUMNS as $key => $column)
            @if(in_array($column['type'], ['file', 'welding_certificate']) || optional($column)['hidden']) @continue @endif
            @include('livewire.common.field')
        @endforeach

    </div>
</div>

<div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Certificate') }}
        </h3>
        <div class="grid grid-cols-1 gap-6 mb-6">
            <x-input.filepond
                wire:model="form.new_certificate"
            />
        </div>

        <script src="https://unpkg.com/pdfjs-dist@3/build/pdf.min.js"></script>
        <script src="https://unpkg.com/konva@9/konva.min.js"></script>
        @if(!$form->new_certificate)
            @if ($form->current_file)
                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div>
                        <div class="inline-flex flex-col items-center">
                            <x-file-with-modal
                                :file="$form->current_file"
                                :path="$form->current_file->temporary_url()"
                            />
                            <div class="flex mt-2 space-x-4">
                                @include('livewire.welding-certificates.signature-editor')
                                <livewire:welding-certificates.signer  :file="$form->current_file" :welding_certificate="$weldingCertificate" />
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Previous certificates') }}
        </h3>
        @if (isset($weldingCertificate) && $weldingCertificate->previous_files)
            <div class="overflow-auto max-h-[215px]">
                <ul>
                    @foreach(array_reverse($weldingCertificate->previous_files) as $file_id)
                        @php( $file = \App\Models\File::find($file_id) )
                        <li class="py-1" wire:key="file-{{ $file_id }}">
                            <div class="flex gap-x-4 justify-end">
                                <div class="flex flex-grow">
                                    <x-file-with-modal
                                        :file="$file"
                                        svg_location="left"
                                    />
                                </div>
                                <div class="flex">
                                <div class="flex" x-data @click.prevent.stop="console.log('stop')">
                                    @if($confirming == $file_id)
                                        <x-button
                                            wire:click="delete({{ $file_id }})"
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
                                            wire:click="confirmDelete({{ $file_id }})"
                                            class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.trash class="w-4 h-4 text-red-600" />
                                        </x-button>
                                    @endif
                                </div>
                                </div>
                             </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>
