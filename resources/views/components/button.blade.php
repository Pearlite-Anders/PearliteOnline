@if($attributes->get('href'))
    <a
        {{ $attributes->merge([
            'class' => 'inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md transition ease-in-out duration-150',
        ]) }}
    >
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' => 'py-2 px-4 border-0 rounded-md text-sm leading-5 font-medium focus:outline-none transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
        ]) }}
    >
        {{ $slot }}
    </button>
@endif
