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
                <livewire:welding-certificates.signer :file="$file" :welding_certificate="$model" class="!py-0 !px-2 !leading-6 !text-xs" />
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
@elseif($column['type'] == 'rich_text')
    <x-table.cell>
        <div
            x-data="{ show: false }"
            @click.prevent.stop="console.log('stop')"
        >
            <x-button
                @click="show = true"
                class="!py-1 flex items-center !px-2 text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
            >

                <x-icon.eye class="w-4 h-4 text-gray-800" />
                <span class="ml-1 text-gray-600">{{ __('Show') }}</span>
            </x-button>

            <x-alpine-modal maxWidth="2xl">
                <div class="p-4">{!! $model->getColumnValue($key) !!}</div>
            </x-alpine-modal>
        </div>
    </x-table.cell>
@elseif($column['type'] == 'textarea')
    <x-table.cell>
        <div class="w-20 max-w-full ">
            <p class="truncate">
                {{ $model->getColumnValue($key) }}
            </p>
        </div>
    </x-table.cell>
@elseif($column['type'] == 'company')
    <x-table.cell>
        <div class="w-20 max-w-full ">
            <p class="truncate">
                {{ $model->company?->data['name'] ?? '' }}
            </p>
        </div>
    </x-table.cell>
@elseif($column['type'] == 'calculated' || $column['type'] == 'date')
    <x-table.cell class="whitespace-nowrap">
        <div class="flex items-center">
            {{ $model->getColumnValue($key) }}
            @if (isset($column['indicator']) && $column['indicator'] == true && $column['filter'] == 'date' && $model->needsReview && $model->getColumnTimeDiff($key) !== null)
                @if ($model->getColumnTimeDiff($key) <= 0)
                    <span class="inline-block ml-2 h-2 w-2 bg-red-700 rounded-xl">&nbsp;</span>
                @elseif($model->getColumnTimeDiff($key) <= 14)
                    <span class="inline-block ml-2 h-2 w-2 bg-yellow-700 rounded-xl">&nbsp;</span>
                @else
                    <span class="inline-block ml-2 h-2 w-2 bg-green-700 rounded-xl">&nbsp;</span>
                @endif
            @endif
        </div>
    </x-table.cell>
@else
    <x-table.cell class="whitespace-nowrap">{{ $model->getColumnValue($key) }}</x-table.cell>
@endif
