<div>
    <x-form-header backlink="{{ route('machine-maintenance.index') }}">
        <x-slot name="title">{{ __('Edit Maintenance') }}</x-slot>
    </x-form-header>
    <form
        class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="update"
    >
        @include('livewire.machine-maintenance.form')

        <div class="items-center text-black sm:flex">
            <div class="mb-3 sm:mb-0 sm:flex">
                <x-button.primary type="submit" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button.primary>
            </div>
        </div>
    </form>

    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="py-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:py-8 sm:py-6">
            <div class="flex justify-between mx-0 mt-0 mb-4 px-4 xl:px-8 sm:px-6">
                <h3 class=" text-xl font-bold leading-7">
                    {{ __('Machine maintenances') }}
                </h3>
                <div>
                    <livewire:machine-maintenance.maintenance :$machineMaintenance />
                </div>
            </div>

            <livewire:reports :$reports :allow-delete="auth()->user()->can('delete', $machineMaintenance)" date-field="maintenance_date" />
        </div>
    </div>
</div>
