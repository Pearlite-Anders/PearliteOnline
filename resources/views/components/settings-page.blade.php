@props(['section'])

<div class="hidden lg:block">
    <x-index-header>
        <x-slot name="heading">
            {{ $heading }}
        </x-slot>
    </x-index-header>
</div>
<div class="max-w-5xl leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0 pt-8 pb-4 px-4">
    {{ $slot }}
</div>
