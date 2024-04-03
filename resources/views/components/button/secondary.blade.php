<x-button
    type="button"
    {{ $attributes->merge(['class' => 'text-gray-700 bg-gray-100 border-gray-300 active:bg-gray-300 hover:bg-gray-300 active:text-gray-800 hover:text-gray-800']) }}
>{{ $slot }}</x-button>
