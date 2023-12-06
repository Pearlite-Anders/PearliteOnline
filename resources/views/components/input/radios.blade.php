<div
    x-data="{ value: '{{ $attributes['selected'] }}' }"
    x-radio
    x-model="value"
    class="flex space-x-2"
>
    @foreach($attributes['options'] as $key => $label)
        <div
            x-radio:option
            value="{{ $key }}"
            class="flex px-2 py-2 text-sm leading-tight bg-white border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25"
            :class="{ 'border-cyan-400 bg-slate-50': $radioOption.isChecked, 'border-gray-200': !$radioOption.isChecked }"
            wire:click="$set('{{ $attributes['wire:model'] }}', '{{ $key }}')"
            @click="$radioOption.check()"
        >
            <p x-radio:label>{{ $label }}</p>
        </div>
    @endforeach
</div>
