
    <div
        class="relative w-full"
        x-data="{
            value: '{{ $attributes['value'] }}',
            picker: null,
            init() {
                this.picker = mdtimepicker(
                    this.$refs.picker,
                    {
                        is24hour: true,
                        clearBtn: true,
                        timeFormat: 'hh:mm',
                        format: 'hh:mm',
                        events: {
                            timeChanged: function(data, timepicker) {
                                $wire.set('{{ $attributes['wire:model'] }}', data.value);
                            }
                        }
                    }
                );
            },
        }"
    >
        <input
            class="block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 {{ $attributes['inline'] ? 'max-w-[310px]' : '' }} }}"
            type="text"
            placeholder="{{ $attributes['placeholder'] ?? '' }}"
            value="{{ $value }}"
            x-ref="picker"
        >
</div>
