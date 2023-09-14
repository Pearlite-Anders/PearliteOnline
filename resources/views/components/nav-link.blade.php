@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-base font-normal text-gray-900 rounded-lg cursor-pointer bg-cyan-50'
            : 'flex items-center p-2 text-base font-normal text-gray-900 rounded-lg cursor-pointer hover:bg-cyan-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
