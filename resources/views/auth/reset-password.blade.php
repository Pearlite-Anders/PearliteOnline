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
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="block">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button.primary class="ml-4" type="submit" wire:loading.attr="disabled">
                        {{ __('Reset Password') }}
                    </x-button.primary>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
