
@props([
    'initial_value' => false,
])

<div
    x-data="{ value: {{ $initial_value ? 'true' : 'false'}}}"
    class="flex items-center space-x-4 md:space-x-0"
>
    <span x-text="value"></span>
    <button
        x-ref="toggle"
        @click="value = ! value; $wire.set('{{ $attributes['wire:model'] }}', value)"
        type="button"
        role="switch"
        :aria-checked="value"
        :class="value ? 'bg-cyan-600' : 'bg-slate-300'"
        class="relative inline-flex py-1 transition rounded-full w-14"
    >
        <span
            :class="value ? 'translate-x-7' : 'translate-x-1'"
            class="w-6 h-6 transition bg-white rounded-full shadow-md"
            aria-hidden="true"
        ></span>
    </button>
</div>
