@props(['reports'])

<x-table class="w-full">
    <x-slot name="head">
        <x-table.heading :multiColumn="false" class="text-left">{{ __('Document') }}</x-table.heading>
        <x-table.heading :multiColumn="false" class="text-left">{{ __('Date') }}</x-table.heading>
        <x-table.heading :multiColumn="false" class="text-left">{{ __('User') }}</x-table.heading>

    </x-slot>
    <x-slot name="body">
        @forelse($reports as $report)
            <x-table.row>
                <x-table.cell>
                    @if($report->current_file_id)
                        @php($file = App\Models\File::find($report->current_file_id))
                        <div class="ml-2">
                            <x-file-with-modal :file="$file" svg_location="left" icon_class="w-4 h-4" />
                        </div>
                    @endif
                </x-table.cell>
                <x-table.cell>
                    {{ data_get($report->data, 'maintenance_date') }}
                </x-table.cell>
                <x-table.cell>
                    <span>{{ $report->user->name }}</span>
                    @if (isset($report->user->data['title']))
                        <span class="leading-5 text-gray-500">({{ $report->user->data['title'] }})</span>
                    @endif
                </x-table.cell>
            </x-table.row>
        @empty
            <x-table.cell solspan="3">
                <span class="text-gray-500">{{ __('No maintenance found') }}</span>
            </x-table.cell>
        @endforelse
    </x-slot>
</x-table>
