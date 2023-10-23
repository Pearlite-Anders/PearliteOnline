@props([
    'title',
])

<div class="items-center justify-between block p-4 leading-6 text-black bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
    <div class="flex items-center text-black">
        @if (isset($attributes['backlink']))
            <div class="pr-3 border-r border-gray-100 border-solid">
                <x-button.secondary href="{{ $attributes->get('backlink') }}" class="inline-flex justify-center">
                    <x-icon.left-arrow class="block w-6 h-6 align-middle" />
                </x-button.secondary>
            </div>
        @endif
        <div class="flex pl-4 text-gray-500">
            {{ $title }}
        </div>
    </div>
</div>
