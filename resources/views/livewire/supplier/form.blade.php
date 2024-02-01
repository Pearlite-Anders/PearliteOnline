<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Supplier') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\Supplier::SYSTEM_COLUMNS as $key => $column)
            @if(in_array($column['type'], ['file', 'welding_certificate'])) @continue @endif
            @include('livewire.common.field')
        @endforeach

    </div>
</div>

<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
        <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
            {{ __('Upload Logo') }}
        </h3>
        <div class="grid grid-cols-1 gap-6 mb-6">
            <x-input.filepond wire:model="form.new_file"/>
        </div>

        @if ($form->current_file)
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <div class="inline-flex flex-col items-center">
                        <x-file-with-modal
                            :file="$form->current_file"
                            :path="$form->current_file->temporary_url()"
                        />
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
