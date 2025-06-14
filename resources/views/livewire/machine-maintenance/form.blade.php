<div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Upload Image') }}
        </h3>
        <div class="grid grid-cols-1 gap-6 mb-6">
            <x-input.filepond
                multiple
                wire:model="form.new_images"
            />
        </div>
    </div>
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Images') }}
        </h3>
        @if (isset($machineMaintenance) && $machineMaintenance->images)
            <div class="overflow-auto max-h-[215px]">
                <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                    @foreach(array_reverse($machineMaintenance->images) as $file_id)
                        @php( $file = \App\Models\File::find($file_id) )
                        <li class="relative">
                            <x-image-with-modal
                                :file="$file"
                                svg_location="left"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>

<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Maintenance') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\MachineMaintenance::SYSTEM_COLUMNS as $key => $column)
            @if(in_array($column['type'], ['file', 'welding_certificate']) || optional($column)['hidden']) @continue @endif
            @include('livewire.common.field')
        @endforeach

    </div>
</div>

<div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Upload File') }}
        </h3>
        <div class="grid grid-cols-1 gap-6 mb-6">
            <x-input.filepond
                multiple
                wire:model="form.new_files"
            />
        </div>


    </div>
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Files') }}
        </h3>
        @if (isset($machineMaintenance) && $machineMaintenance->files)
            <div class="overflow-auto max-h-[215px]">
                <ul>
                    @foreach(array_reverse($machineMaintenance->files) as $file_id)
                        @php( $file = \App\Models\File::find($file_id) )
                        @if ($file)
                            <li class="py-1">
                                <div class="flex items-center">
                                    <div class="grow">
                                        <x-file-with-modal
                                            :file="$file"
                                            svg_location="left"
                                        />
                                    </div>
                                    @can('delete', $machineMaintenance)
                                        <div class="flex" x-data @click.prevent.stop="">
                                            @if($confirmingFile == $file_id)
                                                <x-button
                                                    wire:click="deleteFile({{ $file_id }})"
                                                    class="bg-red-700 hover:bg-red-800"
                                                >
                                                    <x-icon.check class="w-4 h-4 text-white" />
                                                </x-button>
                                                <x-button
                                                    wire:click="cancelConfirmDeleteFile"
                                                    class="bg-cyan-600 hover:bg-cyan-700"
                                                >
                                                    <x-icon.x class="w-4 h-4 text-white" />
                                                </x-button>
                                            @else
                                                <x-button
                                                    wire:click="confirmDeleteFile({{ $file_id}})"
                                                    class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                                >
                                                    <x-icon.trash class="w-4 h-4 text-red-600" />
                                                </x-button>
                                            @endif
                                        </div>
                                    @endcan
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>
