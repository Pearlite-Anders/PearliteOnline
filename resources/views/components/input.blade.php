@props([
    'disabled' => false,
    'prefix' => '',
    'postfix' => '',
])

@php($class = 'block w-full mt-1 border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50')



<div class="relative">
    @if($prefix)
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">{{ $prefix }}</span>
        </div>
        @php($class .= ' pl-7')
    @endif
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $class]) !!}>
    @if($postfix)
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">{{ $postfix }}</span>
        </div>
    @endif
</div>
