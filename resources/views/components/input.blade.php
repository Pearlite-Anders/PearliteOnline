@props([
    'disabled' => false,
    'prefix' => '',
    'postfix' => '',
    'required' => false,
])

@php($class = 'block w-full leading-tight border-gray-300 rounded-md shadow-sm bg-gray-50 placeholder:text-gray-400 placeholder:text-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')

@if($attributes->get('live'))
    @php($attributes = $attributes->merge(['wire:model.live' => $attributes->get('wire:model')]))
    @php($attributes = $attributes->filter(fn($value, $key) => $key !== 'wire:model'))
    @php($attributes = $attributes->filter(fn($value, $key) => $key !== 'live'))
@endif

<div class="relative">
    @if($prefix)
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">{{ $prefix }}</span>
        </div>
        @php($class .= ' pl-5')
    @endif
    <input {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} {!! $attributes->merge(['class' => $class]) !!}>
    @if($postfix)
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">{{ $postfix }}</span>
        </div>
    @endif
</div>
<!-- show error -->
@error($attributes->get('wire:model'))
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror
