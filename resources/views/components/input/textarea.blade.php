@props([
    'disabled' => false,
    'prefix' => '',
    'postfix' => '',
])

@php($class = 'block w-full leading-tight border-gray-300 rounded-md shadow-sm bg-gray-50 placeholder:text-gray-400 placeholder:text-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')

<div class="relative">
    <textarea
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => $class]) !!}
    ></textarea>
</div>
