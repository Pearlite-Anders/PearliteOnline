<div wire:ignore>
    <div
        class="relative"
        x-data="{
            value: '{{ $attributes['value'] }}',
            picker: null,
            init() {
                this.picker = flatpickr(this.$refs.picker, {
                    dateFormat: 'Y.m.d',
                    defaultDate: this.value,
                    inline: {{ $attributes['inline'] ? 'true' : 'false' }},
                    onChange: (date, dateString) => {
                        this.value = date;
                        $wire.set('{{ $attributes['wire:model'] }}', dateString)
                    },
                    locale: {
                        firstDayOfWeek: 1
                    }
                });

                $wire.$watch('{{$attributes['wire:model']}}', (value, old) => {
                    if(this.value != value) {
                        this.value = value;
                    }
                })

                this.$watch('value', () => {
                    this.picker.setDate(this.value);
                })
            },
        }"
    >
        <input
            class="block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 {{ $attributes['inline'] ? 'max-w-[310px]' : '' }} }}"
            x-ref="picker"
            type="text"
            placeholder="{{ $attributes['placeholder'] ?? '' }}"
        >
        <button
            type="button"
            class="absolute top-[11px] right-0 px-3"
            @click="picker.clear()"
            x-show="value && value.length"
        >
            <x-icon.x class="w-4 h-4" />
        </button>

    </div>
</div>
