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

                @if($errors->any())
                    <div class="p-4 mt-2 rounded-md bg-red-50">
                        <div class="flex">
                            <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                            </svg>
                            </div>
                            <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">{{ __('There were some errors, you need to fix first.') }}</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="pl-5 space-y-1 list-disc">
                                @foreach($errors->all() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                @else
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
                @endif
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
            @if($welding_certificate->data['signed'] < $welding_certificate->data['max_signatures'] && !$errors->any())
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
