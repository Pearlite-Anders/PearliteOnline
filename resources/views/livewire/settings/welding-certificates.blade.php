<div
    id="welding-certificates"
    @unless($section == 'welding-certificates')
        class="hidden"
    @endunless
>

<x-setting-section class="mb-4">
    <x-slot name="title">
        {{ __('Notifications') }}
    </x-slot>

    <x-slot name="description">
    </x-slot>

    <x-slot name="form">
        <div class="col-span-5 space-y-4">
            <div>
                <x-label for="welding_certificates.welding_certificate_notification_before_expiration" :value="__('Notify days before expiration')" />
                <x-input
                    id="welding_certificates.welding_certificate_notification_before_expiration"
                    type="number"
                    class="block w-full"
                    wire:model="settings.welding_certificate_notification_before_expiration"
                />
                <x-input-error for="" class="mt-2" />
            </div>
            <div>
                <x-label for="welding_certificates.welding_certificate_notification_before_verification" :value="__('Notify days before Verification')" />
                <x-input
                    id="welding_certificates.welding_certificate_notification_before_verification"
                    type="number"
                    class="block w-full"
                    wire:model="settings.welding_certificate_notification_before_verification"
                />
                <x-input-error for="" class="mt-2" />
            </div>
            <div>
                <x-label for="welding_certificates.welding_certificate_notification_email" :value="__('Notification email(s)')" />
                <x-input
                    id="welding_certificates.welding_certificate_notification_email"
                    type="text"
                    class="block w-full"
                    wire:model="settings.welding_certificate_notification_email"
                />
                <x-input-error for="" class="mt-2" />
                <p class="mt-2 text-sm text-gray-500">{{ __('Separate multiple emails with a comma.') }}</p>
            </div>
        </div>
    </x-slot>
</x-setting-section>

@php($arraySections = [
    'welding_processes' => __('Welding processes'),
    'plate_pipes' => __('Plate or pipe'),
    'type_of_welds' => __('Type of Weld'),
    'material_groups' => __('Material group'),
    'filler_material_types' => __('Filler material type'),
    'filler_material_groups' => __('Filler material group'),
    'shielding_gases' => __('Shielding gas'),
    'type_of_current_and_polarities' => __('Type of current and polarity'),
    'welding_positions' => __('Welding position'),
    'weld_detailses' => __('Weld details'),

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
