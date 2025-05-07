<div
    id="time-registration"
    @unless($section == 'time-registration')
        class="hidden"
    @else
        class="w-full"
    @endunless
>
    <x-settings-page>
        <x-setting-section class="mb-4">
            <x-slot name="title">
                {{ __('Base') }}
            </x-slot>

            <x-slot name="description">
            </x-slot>

            <x-slot name="form">
                <div class="col-span-5 space-y-4">
                    <div>
                        <x-label for="time-registration.default_break_duration" :value="__('Default break duration')" />
                        <x-input
                            id="time-registration.default_break_duration"
                            type="number"
                            class="block w-full"
                            wire:model="settings.time_registration_default_break_duration"
                        />
                        <x-input-error for="" class="mt-2" />
                    </div>
                </div>
            </x-slot>
        </x-setting-section>
    </x-settings-page>
</div>
