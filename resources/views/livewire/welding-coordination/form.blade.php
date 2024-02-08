<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Welding Coordination') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\WeldingCoordination::getColumns() as $key => $column)
            @if(in_array($column['type'], ['file', 'welding_certificate'])) @continue @endif
            @include('livewire.common.field')
        @endforeach

    </div>
</div>

<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Upload') }}
        </h3>
        <div class="grid grid-cols-1 gap-6 mb-6">
            <x-input.filepond wire:model="form.files" multiple />
        </div>

        @if ($form->current_files)
            <div class="flex flex-wrap -mx-2">
                @foreach ($form->current_files as $file)
                    <div class="p-2">
                        <x-file-with-modal
                            :file="$file"
                        />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
