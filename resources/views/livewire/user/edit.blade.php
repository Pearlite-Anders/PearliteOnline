<div>
    <x-form-header backlink="{{ route('users.index') }}">
        <x-slot name="title">{{ __('Edit user:') }} {{ $user->name }}</x-slot>
    </x-form-header>

    <form
        class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0"
        wire:submit="update"
    >
        @include('livewire.user.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary>
                    {{ __('Update') }}
                </x-button.primary>
            </div>
        </div>
    </form>
</div>
