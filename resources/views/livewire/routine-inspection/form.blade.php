<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Routine inspection') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        @foreach(App\Models\RoutineInspection::SYSTEM_COLUMNS as $key => $column)
            @if(optional($column)['hidden']) @continue @endif
            @include('livewire.common.field')
        @endforeach

    </div>
</div>
