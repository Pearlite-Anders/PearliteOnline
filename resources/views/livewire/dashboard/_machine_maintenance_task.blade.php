<a class="" href="{{ route('machine-maintenance.edit', ['machineMaintenance' => $task->id]) }}">
    <div class="px-4 py-3 sm:px-6 sm:py-4">
        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">{{ _('Maintenance') }}</span>
        <p>{{ __('Its time for maintenance of') }}: {{ $task->data['name'] }}</p>
    </div>
</a>
