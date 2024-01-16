<div>
    <x-form-header backlink="{{ route('ce.index') }}">
        <x-slot name="title">{{ __('New Ce Marking') }}</x-slot>
    </x-form-header>
    <form
        class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="create"
    >

        @include('livewire.ce.setup')
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <div class="flex-row-reverse gap-6 md:flex">
                <div class="flex-1 mb-6 md:mb-0">
                    @include('livewire.ce.preview')
                </div>
                <div class="flex-1">
                    @include('livewire.ce.form')
                </div>
            </div>
        </div>




        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-button.primary>
            </div>
        </div>
    </form>
</div>
