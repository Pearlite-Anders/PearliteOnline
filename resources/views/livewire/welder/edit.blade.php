<div>
    <x-form-header backlink="{{ route('welder.index') }}">
        <x-slot name="title">{{ __('Edit Welder') }}</x-slot>
    </x-form-header>
    <form
        class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="update"
    >
        @include('livewire.welder.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button.primary>
            </div>
        </div>
    </form>

    <div class="p-4 leading-6 text-black">
        <div class="px-4 pb-8 mb-4 leading-6 text-black bg-white rounded-lg shadow">
            <livewire:welding-certificates.index :preset_filters="['welder_id' => $welder->id]" :hide_filters="true" :hide_search="true" />
        </div>
    </div>
</div>
