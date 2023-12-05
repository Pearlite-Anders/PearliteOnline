<div
    id="multiple-choice"
    @unless($section == 'wpqr')
        class="hidden"
    @endunless
>

@php($arraySections = [
])

@foreach($arraySections as $arraySectionKey => $arraySectionName)
    <x-setting-section class="mb-4">
        <x-slot name="title">
            {{ $arraySectionName }}
        </x-slot>

        <x-slot name="description">
        </x-slot>

        <x-slot name="form">
            @foreach($settings[$arraySectionKey] as $key => $process)
                <div class="col-span-5">
                    <x-input
                        id="{{ $arraySectionKey }}.{{ $key }}"
                        type="text"
                        class="block w-full"
                        wire:model="settings.{{ $arraySectionKey }}.{{ $key }}"
                    />
                    <x-input-error for="{{ $arraySectionKey }}.{{ $key }}" class="mt-2" />
                </div>
                <div class="flex items-center justify-end col-span-1">
                    @if($confirming == '{{ $arraySectionKey }}.'. $key)
                        <x-button
                            wire:click="deleteArrayItem({{ $arraySectionKey }}, {{ $key }})"
                            class="bg-red-700 hover:bg-red-800"
                        >
                            <x-icon.check class="w-4 h-4 text-white" />
                        </x-button>
                        <x-button
                            wire:click="cancelConfirmDelete"
                            class="bg-cyan-600 hover:bg-cyan-700"
                        >
                            <x-icon.x class="w-4 h-4 text-white" />
                        </x-button>
                    @else
                        <x-button
                            wire:click="confirmDelete('{{ $arraySectionKey }}.{{ $key }}')"
                            class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                        >
                            <x-icon.trash class="w-5 h-5 text-red-600" />
                        </x-button>
                    @endif
                </div>
            @endforeach
            <div class="col-span-6">
                <x-button.secondary
                    wire:click="addArrayItem('{{ $arraySectionKey }}')"
                    class="flex items-center"
                >
                    <x-icon.plus class="w-4 h-4 mr-2 text-gray-700" /> {{ __('Add option') }}
                </x-button.secondary>
            </div>
        </x-slot>
    </x-setting-section>
@endforeach

<div class="flex justify-end">
    <x-button.primary
        wire:click="save"
        wire:loading.attr="disabled"
        class="mt-4"
    >
        {{ __('Save') }}
    </x-button>
</div>




</div>
