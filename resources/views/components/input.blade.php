@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block p-2 m-0 w-full text-base leading-6 text-gray-900 bg-gray-50 rounded-lg border border-gray-300 border-solid appearance-none cursor-text sm:text-sm sm:leading-5 focus:border-gray-300 focus:outline-offset-2']) !!}>
