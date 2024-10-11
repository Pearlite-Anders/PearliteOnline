<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <x-icon.arrow-path class="w-4 h-4 mr-2 text-gray-500 align-middle duration-75 ease-in-out animate-spin" />
    <span class="text-sm text-gray-500">{{ $slot }}</span>
</div>
