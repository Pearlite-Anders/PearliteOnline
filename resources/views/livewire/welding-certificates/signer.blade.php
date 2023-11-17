<div>
    <x-button.primary
        wire:click="toggleOpen"
        class="!py-0 !px-2 !leading-6 !text-xs"
    >{{ __('Sign') }}</x-button.primary>

    @if($open)
        <x-modal id="signer" maxWidth="lg">
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Sign certificate') }}
                </h3>

                <div class="flex justify-center mt-4">
                    <x-input.date
                        wire:model="date"
                        value="{{ $date }}"
                        placeholder="{{ __('Date') }}"
                        :inline="true"
                    />
                </div>
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
            <x-button.primary
                wire:click="sign"
            >{{ __('Sign') }}</x-button.primary>
            <x-button.secondary
                wire:click="toggleOpen"
            >{{ __('Cancel') }}</x-button.secondary>
        </div>
        </x-modal>
    @endif



</div>
