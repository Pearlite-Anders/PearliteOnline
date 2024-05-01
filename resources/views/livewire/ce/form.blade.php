<div
    class="grid grid-cols-1 gap-6"
>
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Component data') }}
    </h3>
    @foreach(App\Models\Ce::getColumns()->except(['project_id', 'method', 'date', 'execution_class', 'tolerance_class', 'file']) as $key => $column)
        @include('livewire.common.field', ['live' => true])
    @endforeach
</div>
