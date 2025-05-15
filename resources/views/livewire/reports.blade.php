<x-table class="w-full">
    <x-slot name="head">
        <x-table.heading :multiColumn="false" class="text-left">{{ __('Document') }}</x-table.heading>
        <x-table.heading :multiColumn="false" class="text-left">{{ __('Date') }}</x-table.heading>
        <x-table.heading :multiColumn="false" class="text-left">{{ __('User') }}</x-table.heading>
        @if ($allowDelete)
            <x-table.heading :multiColumn="false" class="text-right"></x-table.heading>
        @endif
    </x-slot>
    <x-slot name="body">
        @forelse($reports as $report)
            <x-table.row wire:key="report-{{ $report['id'] }}">
                <x-table.cell>
                    @if($report['current_file_id'])
                        @php($file = App\Models\File::find($report['current_file_id']))
                        <div class="ml-2">
                            <x-file-with-modal :file="$file" svg_location="left" icon_class="w-4 h-4" />
                        </div>
                    @endif
                </x-table.cell>
                <x-table.cell>
                    {{ data_get($report, 'data.' . $dateField) }}
                </x-table.cell>
                <x-table.cell>
                    <span>{{ data_get($report, 'user.name') }}</span>
                    @if (data_get($report, 'user.data.title'))
                        <span class="leading-5 text-gray-500">({{ data_get($report, 'user.data.title') }})</span>
                    @endif
                </x-table.cell>
                @if ($allowDelete)
                    <x-table.cell>
                        <div class="flex justify-end" x-data @click.prevent.stop="">
                                @if($confirmingDeleteReport == $report['id'])
                                    <x-button
                                        wire:click="deleteReport({{ $report['id'] }})"
                                        class="bg-red-700 hover:bg-red-800"
                                    >
                                        <x-icon.check class="w-4 h-4 text-white" />
                                    </x-button>
                                    <x-button
                                        wire:click="cancelConfirmDelete"
                                        class="bg-cyan-600 hover:bg-cyan-700"
                                    >
                                        <x-icon.x class="w-4 h-4 text-white" />
                                    </x-button>
                                @else
                                    <x-button
                                        wire:click="confirmDeleteReport({{ $report['id'] }})"
                                        class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <x-icon.trash class="w-4 h-4 text-red-600" />
                                    </x-button>
                                @endif

                        </div>
                    </x-table.cell>
                @endif
            </x-table.row>
        @empty
            <x-table.cell solspan="3">
                <span class="text-gray-500">{{ __('No maintenance found') }}</span>
            </x-table.cell>
        @endforelse
    </x-slot>
</x-table>
