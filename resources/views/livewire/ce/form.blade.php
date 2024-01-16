<div
    class="grid grid-cols-1 gap-6"
>
    @foreach(App\Models\Ce::getColumns()->except(['project_id', 'method', 'execution_standard', 'execution_class', 'file']) as $key => $column)
        @include('livewire.common.field', ['live' => true])
    @endforeach
</div>
