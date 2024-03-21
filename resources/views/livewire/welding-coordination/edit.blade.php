<div>
    <x-form-header backlink="{{ route('welding-coordination.index') }}">
        <x-slot name="title">{{ __('Edit Welding Coordination') }}</x-slot>
    </x-form-header>
    <form
        class="px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="update"
    >
        @include('livewire.welding-coordination.form')
        <div class="items-center text-black sm:flex">
            <div class="mb-3 space-x-4 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button.primary>
                <x-button.link href="{{ route('welding-coordination.print', $weldingCoordination) }}" target="_blank">
                    {{ __('Print PDF') }}
                </x-button.link>
            </div>
        </div>
    </form>
</div>
