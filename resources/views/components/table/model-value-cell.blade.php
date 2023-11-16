@props([
    'key',
    'column',
    'model',
])

@if($column['type'] == 'relationship')
    <x-table.cell>
        {{ $model->{$column['relationship']} ? $model->{$column['relationship']}->{ $column['class']::LABEL_KEY } : '' }}
    </x-table.cell>
@elseif($column['type'] == 'calculated')
        <x-table.cell>{{ optional($model)->{$key} }}</x-table.cell>
@elseif($column['type'] == 'select')
    <x-table.cell>{{ implode(', ', optional($model->data)[$key] ?? []) }}</x-table.cell>
@elseif($column['type'] == 'date')
    <x-table.cell>
        {{ optional($model->data)[$key] ? Carbon\Carbon::parse(optional($model->data)[$key])->format('Y.m.d') : '' }}
    </x-table.cell>
@elseif($column['type'] == 'welding_certificate')
    <x-table.cell>
        @if($model->current_file_id)
            @php($file = App\Models\File::find($model->current_file_id))
        @endif
    </x-table.cell>
@else
    <x-table.cell>{{ optional($model->data)[$key] }}</x-table.cell>
@endif
