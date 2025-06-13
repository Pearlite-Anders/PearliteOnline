@if ($filters->view == 'card')
    <a class="" href="{{ route('supplier.edit', ['supplier' => $task->id]) }}" wire:navigate>
        <div class="px-4 py-3 sm:px-6 sm:py-4">
            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">Supplier</span>
            <p>{{ __('Its time for assesment of') }}: {{ $task->data['name'] }}</p>
        </div>
    </a>
@else
    <x-table.row
        :edit_link="route('supplier.edit', ['supplier' => $task->id])"
        :can_edit="auth()->user()->can('update', $task)"
        class="cursor-pointer hover:bg-gray-50"
    >
        <x-table.cell>{{ __('Supplier') }}</x-table.cell>
        <x-table.cell />
        <x-table.cell>
            <livewire:supplier.assessment :supplier="$task" class="!py-0 !px-2 !leading-6 !text-xs" :button-text="__('Sign')" />
        </x-table>
        <x-table.cell />
        <x-table.cell>{{ $task->data['name'] }}</x-table>
        <x-table.cell>{{ $task->latest_assessment_date }}</x-table>
        <x-table.date-status-cell :date="$task->nextAssessment()" />
        <x-table.cell>{{ $task->responsible_user?->name }}</x-table>
    </x-table.row>
@endif
