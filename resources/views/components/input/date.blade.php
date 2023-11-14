<div wire:ignore>
    <div
        x-data="{
            value: '{{ $attributes['value'] }}',
            init() {
                let picker = flatpickr(this.$refs.picker, {
                    dateFormat: 'Y.m.d',
                    defaultDate: this.value,
                    onChange: (date, dateString) => {
                        this.value = date;
                        @this.set('{{ $attributes['wire:model'] }}', dateString)
                    }
                });

                console.log(this.value);
                console.log(this.value);

                this.$watch('value', () => picker.setDate(this.value))
            },
        }"
    >
        <input
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            x-ref="picker"
            type="text"
        >
    </div>
</div>
