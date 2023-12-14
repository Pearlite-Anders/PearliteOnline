@props([
    'key',
    'column',
    'model',
])


@if($column['type'] == 'welding_certificate')
    <x-table.cell x-data @click.prevent.stop="console.log('stop')">
        @if($model->current_file_id)
            @php($file = App\Models\File::find($model->current_file_id))
            @if($file)
                <div class="flex items-center space-x-2">
                    <x-file-with-modal
                        :file="$file"
                        :hide_name="true"
                        icon_class="w-5 h-5 text-gray-800"
                    />
                    <livewire:welding-certificates.signer :file="$file" :welding_certificate="$model" class="!py-0 !px-2 !leading-6 !text-xs" />
                </div>
            @endif
        @endif
    </x-table.cell>
@elseif($column['type'] == 'file')
    <x-table.cell x-data @click.prevent.stop="console.log('stop')">
        @if($model->current_file_id)
            @php($file = App\Models\File::find($model->current_file_id))
            @if($file)
                <x-file-with-modal
                    :file="$file"
                    :hide_name="true"
                    icon_class="w-5 h-5 text-gray-800"
                />
            @endif
        @endif
    </x-table.cell>
@else
    <x-table.cell class="whitespace-nowrap">{{ $model->getColumnValue($key) }}</x-table.cell>
@endif
