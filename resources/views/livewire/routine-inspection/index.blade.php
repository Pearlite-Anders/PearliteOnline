<div>
    <!-- listen for escape with a alpinejs block -->
    <div x-data @keydown.escape.window="$wire.cancelConfirmDelete"></div>

    <x-index-header>
        <x-slot name="heading">
            <x-icon.calendar-date-range class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Routine inspections') }}
        </x-slot>
        <x-slot name="search">
            <div class="grid w-full grid-cols-1 gap-4 pr-16 md:grid-cols-8">
                <div class="relative col-span-2">
                    <input
                        type="search"
                        wire:model.live.debounce.500ms="search"
                        class="block w-full p-2 m-0 text-base text-gray-900 border border-gray-300 border-solid rounded-lg appearance-none bg-gray-50 cursor-text sm:text-sm sm:leading-5 focus:border-cyan-600 focus:outline-offset-2"
                        placeholder="{{ __('Global search..') }}"
                    />
                </div>
                <x-table-filters :filters="$filters" :model="$model" :filter_columns="$filter_columns" :show_modal="$showFilterSettingsModal" />
            </div>
        </x-slot>
        <x-slot name="buttons">
            <livewire:table-columns :columns="$columns" />
            @can('create', App\Models\RoutineInspection::class)
                <x-button.link href="{{ route('routine-inspection.create') }}" class="inline-flex items-center justify-center whitespace-nowrap">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add Routine inspection') }}
                </x-button.link>
            @endcan
        </x-slot>
    </x-index-header>

    <livewire:routine-inspection.wps lazy />
    <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-6 mx-6 my-5">
        <livewire:routine-inspection.welder />
        <livewire:routine-inspection.welding-equipment />
    </div>
    <livewire:routine-inspection.table :columns="$columns" :filters="$filters" :filter_columns="$filter_columns" :search="$search" lazy />
</div>

<script>
function dragDropFilters() {
    return {
        draggableColumns: @entangle('filter_columns'),
        draggingIndex: null,
        targetIndex: null,

        startDrag(event, index) {
            this.draggingIndex = index;
            event.dataTransfer.effectAllowed = 'move';
        },
        dragEnter(event, index) {
            this.targetIndex = index;
            event.target.closest('.draggable-column').classList.add('bg-gray-200');
        },
        dragLeave(event) {
            this.targetIndex = null;
            event.target.closest('.draggable-column').classList.remove('bg-gray-200');
        },
        drop(event, targetIndex) {
            if (this.draggingIndex !== null) {
                this.$wire.call('reorderFilters', this.draggingIndex, targetIndex);
            }
            this.draggingIndex = null;
            this.targetIndex = null;
            event.target.closest('.draggable-column').classList.remove('bg-gray-200');
        },
        endDrag(event) {
            this.targetIndex = null;
            event.target.closest('.draggable-column').classList.remove('drag-over');
        },
        toggleVisibility(column) {
            this.$wire.call('toggleFilterVisibility', column.label);
        }
    };
}
</script>