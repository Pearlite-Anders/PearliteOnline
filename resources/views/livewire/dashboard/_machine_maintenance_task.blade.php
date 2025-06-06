@if ($filters->view == 'card')
    <a class="" href="{{ route('machine-maintenance.edit', ['machineMaintenance' => $task->id]) }}" wire:navigate>
        <div class="px-4 py-3 sm:px-6 sm:py-4">
            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">{{ __('Maintenance') }}</span>
            <p>{{ __('Its time for maintenance of') }}: {{ $task->data['name'] }}</p>
        </div>
    </a>
@else
    <x-table.row
        :edit_link="route('machine-maintenance.edit', ['machineMaintenance' => $task->id])"
        :can_edit="auth()->user()->can('update', $task)"
        class="cursor-pointer hover:bg-gray-50"
    >
        <x-table.cell>{{ __('Maintenance') }}</x-table.cell>
        <x-table.cell />
        <x-table.cell></x-table>
        <x-table.cell>{{ $task->data['serial_number'] }}</x-table.cell>
        <x-table.cell>{{ $task->data['name'] }}</x-table>
        <x-table.cell>{{ $task->latest_maintenance_date }}</x-table>
        <x-table.date-status-cell :date="$task->nextMaintenanceDate()" />
        <x-table.cell>{{ $task->responsible_user?->name }}</x-table>
    </x-table.row>
@endif
