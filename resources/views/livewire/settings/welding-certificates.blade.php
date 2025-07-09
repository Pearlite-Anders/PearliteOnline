<div
    id="welding-certificates"
    @unless($section == 'welding-certificates')
        class="hidden"
    @else
        class="w-full"
    @endunless
>
    <x-settings-page>
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
                        <x-label for="welding_certificates.welding_certificate_notification_users" :value="__('Notification user(s)')" />
                        <x-input.choices
                            id="welding_certificates.welding_certificate_notification_users"
                            type="text"
                            class="block w-full"
                            wire:model="settings.welding_certificate_notification_users"
                            :options="$users"
                            prettyname="welding_certificate_notification_users"
                            multiple="true"
                            :selected="data_get($settings, 'welding_certificate_notification_users', [])"
                        />
                        <x-input-error for="" class="mt-2" />
                        <p class="mt-2 text-sm text-gray-500">{{ __('Separate multiple emails with a comma.') }}</p>
                    </div>
                </div>
            </x-slot>
        </x-setting-section>

    </x-settings-page>

</div>
