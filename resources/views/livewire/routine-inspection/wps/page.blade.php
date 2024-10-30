<div>
    <div class="grid grid-cols-1 gap-6 mx-6 my-5 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
        @foreach($wpss as $wps)
            <div class="grid grid-cols-2 rounded-lg bg-white p-8">
                <div>
                    <div class="flex flex-col h-full justify-between">
                        <div>
                            <p class="text-sm text-gray-500">{{ $wps->data['number'] }}</p>
                            <h3 class="text-lg font-semibold text-gray-900">{{ number_format($wps->total_length, 0, ',', '.') }} cm.</h3>
                        </div>
                        <div>
                            <!-- <div>
                                <span class="text-sm ml-2">
                                    Scope:
                                </span>
                                <span class="text-sm font-semibold">
                                    20%
                                </span>
                            </div> -->
                            <div>
                                <span class="inline-block h-2 w-2 bg-green-700"></span>
                                <span class="text-sm">
                                    Inspected:
                                </span>
                                <span class="text-sm font-semibold">
                                    @if ($wps->total_length > 0)
                                        {{ number_format(($wps->inspected_length / $wps->total_length) * 100) }} %
                                    @else
                                        100%
                                    @endif
                                </span>
                                <span class="text-xs text-gray-500">
                                    ({{ number_format($wps->inspected_length, 0, ',', '.') }} cm)
                                </span>
                            </div>
                            <div>
                                <span class="inline-block h-2 w-2 bg-gray-400"></span>
                                <span class="text-sm">
                                    Not Inspected:
                                </span>
                                <span class="text-sm font-semibold">
                                    @if ($wps->total_length > 0)
                                        {{ number_format(100 - (($wps->inspected_length / $wps->total_length) * 100)) }} %
                                    @else
                                        100%
                                    @endif
                                </span>
                                <span class="text-xs text-gray-500">
                                    ({{ number_format($wps->total_length - $wps->inspected_length, 0, ',', '.') }} cm)
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <div
                    x-data="routine_inspection_wps_chart(['{{ _('Inspected') }}', '{{ _('Not Inspected') }}'], [{{ $wps->total_length == 0 ? 1 : $wps->total_length  }}, {{ $wps->total_length - $wps->inspected_length < 0 ? 0 : $wps->total_length - $wps->inspected_length }} ])"
                    class="w-full flex justify-end align-middle items-center max-h-48"
                >
                    <canvas x-ref="canvas"></canvas>
                </div>
            </div>
        @endforeach
    </div>
</div>
