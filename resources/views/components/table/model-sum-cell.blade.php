@props([
    'key',
    'column',
    'models'
])


@if(isset($column['sum']) && $column['sum'] == true)
    {{ $models->sum(function($model) use ($key) { return $model->data[$key] ?? 0; }) }}
    @if (isset($column['postfix']) && $column['postfix'])
        {{ $column['postfix'] }}
    @endif
@endif
