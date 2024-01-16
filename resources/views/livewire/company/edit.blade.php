<div>
    <x-form-header backlink="{{ route('companies.index') }}">
        <x-slot name="title">{{ __('Edit company:') }} {{ $company->data['name'] }}</x-slot>
    </x-form-header>
    <form
        class="px-4 pt-8 pb-4 leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0"
        wire:submit="update"
    >
        @include('livewire.company.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button.primary>
            </div>
        </div>
    </form>
</div>
