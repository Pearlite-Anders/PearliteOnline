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

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="flex justify-between mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm font-semibold text-gray-800">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center mt-4">
                    <x-button.primary class="">
                        {{ __('Log in') }}
                    </x-button.primary>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
