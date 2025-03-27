<div
    id="multiple-choice"
    @unless($section == 'document')
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
                        <x-label for="document.document_notification_before_next_review" :value="__('Notify days before next review')" />
                        <x-input
                            id="document.document_notification_before_next_review"
                            type="number"
                            class="block w-full"
                            wire:model="settings.document_notification_before_next_review"
                        />
                        <x-input-error for="" class="mt-2" />
                    </div>
                </div>
            </x-slot>
        </x-setting-section>
    </x-settings-page>
</div>
