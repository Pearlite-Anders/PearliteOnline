

@if ($filters->view == 'card')
    <a class="" href="{{ route('documents.edit', ['document' => $task->id]) }}" wire:navigate>
        <div class="px-4 py-3 sm:px-6 sm:py-4">
            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">{{ __('Document') }}</span>
            <p>{{ data_get($task->currentRevision->data, 'title') }}</p>
        </div>
    </a>

@else
    @if($task->current_file_id)
        @php($file = App\Models\File::find($task->current_file_id))
    @endif
    <x-table.row
        :edit_link="route('documents.edit', ['document' => $task->id])"
        :can_edit="auth()->user()->can('update', $task)"
        class="cursor-pointer hover:bg-gray-50"
    >
        <x-table.cell>{{ __('Document') }}</x-table.cell>

        <x-table.cell x-data @click.prevent.stop="console.log('stop')">
            <x-document-preview
                :document="$task"
                icon_class="w-5 h-5 text-gray-800"
            />
        </x-table.cell>
        <x-table.cell x-data @click.prevent.stop="console.log('stop')">

        </x-table.cell>
        <x-table.cell>{{ data_get($task->currentRevision->data, 'title') }}</x-table.cell>
        <x-table.cell>{{ data_get($task->currentRevision->data, 'title') }}</x-table.cell>
        <x-table.cell>{{ $task->latest_evaluation }}</x-table.cell>
        <x-table.date-status-cell :date="$task->nextEvaluation()" />
        <x-table.cell>{{ $task->owner?->name }}</x-table.cell>
    </x-table.row>
@endif
