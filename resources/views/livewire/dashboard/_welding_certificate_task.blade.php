

@if ($filters->view == 'card')
    <a class="" href="{{ route('welding-certificates.edit', ['weldingCertificate' => $task->id]) }}" wire:navigate>
        <div class="px-4 py-3 sm:px-6 sm:py-4">
            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">{{ __('Welding certificate') }}</span>
            <p>Welding certificate</p>
        </div>
    </a>

@else
    @if($task->current_file_id)
        @php($file = App\Models\File::find($task->current_file_id))
    @endif
    <x-table.row
        :edit_link="route('welding-certificates.edit', ['weldingCertificate' => $task->id])"
        :can_edit="auth()->user()->can('update', $task)"
        class="cursor-pointer hover:bg-gray-50"
    >
        <x-table.cell>{{ __('Welding certificate') }}</x-table.cell>

        <x-table.cell x-data @click.prevent.stop="console.log('stop')">
            @if($task->current_file_id && $file)
                <x-file-with-modal
                    :file="$file"
                    :hide_name="true"
                    icon_class="w-5 h-5 text-gray-800"
                />
            @endif
        </x-table.cell>
        <x-table.cell x-data @click.prevent.stop="console.log('stop')">
            @if($task->current_file_id && $file)
                <livewire:welding-certificates.signer :file="$file" :welding_certificate="$task" class="!py-0 !px-2 !leading-6 !text-xs" />
            @endif
        </x-table.cell>
        <x-table.cell>{{ $task->data['number'] }}</x-table.cell>
        <x-table.cell>{{ $task->welder?->name }}</x-table>
        <x-table.cell>{{ $task->latest_signature }}</x-table>
        <x-table.date-status-cell :date="$task->nextSignatureOrExpire()" />
        <x-table.cell>
            {{ \App\Models\Setting::get('welding_certificate_notification_email', null, $task->company->id) }}
        </x-table>
    </x-table.row>
@endif
