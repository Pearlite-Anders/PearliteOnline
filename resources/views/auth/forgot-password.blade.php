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

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="block">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-button.primary>
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
</div>
    </x-authentication-card>
</x-guest-layout>
