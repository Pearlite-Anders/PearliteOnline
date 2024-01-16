<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="hidden w-2/3 leading-6 text-black lg:flex">
            <img
            class="block h-auto max-w-full leading-6 text-black align-middle rounded-l-lg"
            src="https://picsum.photos/600/800"

            alt="login image"
            />
        </div>

        <div class="w-full p-6 leading-6 text-black lg:px-16 lg:py-0 sm:p-8">
            <div x-data="{ recovery: false }">
                <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                </div>
                <div class="mb-4 text-sm text-gray-600" x-cloak x-show="recovery">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </div>
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('two-factor.login') }}">
                    @csrf
                    <div class="mt-4" x-show="! recovery">
                        <x-label for="code" value="{{ __('Code') }}" />
                        <x-input id="code" class="block w-full mt-1" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                    </div>
                    <div class="mt-4" x-cloak x-show="recovery">
                        <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                        <x-input id="recovery_code" class="block w-full mt-1" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                    </div>
                    <div class="mt-4 ">
                        <button type="button" class="block text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                                        x-show="! recovery"
                                        x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                            {{ __('Use a recovery code') }}
                        </button>

                        <button type="button" class="block text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                                        x-cloak
                                        x-show="recovery"
                                        x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                            {{ __('Use an authentication code') }}
                        </button>
                        <x-button.primary class="mt-4" type="submit" wire:loading.attr="disabled">
                            {{ __('Log in') }}
                        </x-button.primary>
                    </div>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
