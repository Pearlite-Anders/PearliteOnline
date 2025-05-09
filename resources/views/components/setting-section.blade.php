@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6 block lg:grid-cols-2 ']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white shadow sm:p-6 sm:rounded-md">
            <div class="grid grid-cols-6 gap-6">
                {{ $form }}

            </div>
        </div>
    </div>
</div>
