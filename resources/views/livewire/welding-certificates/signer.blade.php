<div>
    <x-button.primary
        type="button"
        wire:click="toggleOpen"
        class="{{ $class }}"
    >{{ __('Sign') }}</x-button.primary>

    @if($open)
        <x-modal id="signer" maxWidth="lg">
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Sign certificate') }}
                </h3>

                @if($welding_certificate->data['signed'] >= $welding_certificate->data['max_signatures'])
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ __('This certificate has been signed maximum amount of times.') }}
                        </p>
                    </div>
                @else

                <div class="flex justify-center mt-4">
                    <x-input.date
                        wire:model="date"
                        value="{{ $date }}"
                        placeholder="{{ __('Date') }}"
                        :inline="true"
                    />
                </div>
                @endif
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
            @if($welding_certificate->data['signed'] < $welding_certificate->data['max_signatures'])
                <x-button.primary
                    type="button"
                    wire:click="sign"
                    wire:loading.remove
                >{{ __('Sign') }}</x-button.primary>
                <x-button.primary
                    wire:loading
                    wire:target="sign"
                    class="opacity-50 cursor-wait"
                >{{ __('Signing...') }}</x-button.primary>
            @endif
            <x-button.secondary
                wire:click="toggleOpen"
            >{{ __('Cancel') }}</x-button.secondary>
        </div>
        </x-modal>
    @endif



</div>
