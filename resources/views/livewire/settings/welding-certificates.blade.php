<div
    id="welding-certificates"
    @unless($section == 'welding-certificates')
        class="hidden"
    @endunless
>
    <x-settings-page>
        <x-slot name="heading">
            <x-icon.welding-certificate class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Welding Certificates') }}
        </x-slot>

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

        <div class="flex justify-end">
            <x-button.primary
                wire:click="save"
                wire:loading.attr="disabled"
                class="mt-4"
            >
                {{ __('Save') }}
            </x-button>
        </div>

    </x-settings-page>

</div>
