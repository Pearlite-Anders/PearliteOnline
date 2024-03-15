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
            @if(in_array($column['type'], ['file', 'welding_certificate'])) @continue @endif
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
                        <li class="py-1">
                            <x-file-with-modal
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
