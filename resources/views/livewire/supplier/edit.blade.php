<div>
    <x-form-header backlink="{{ route('supplier.index') }}">
        <x-slot name="title">{{ __('Edit Supplier') }}</x-slot>
    </x-form-header>
    <form
        class="px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0"
        wire:submit="update"
    >
        @include('livewire.supplier.form')
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
            <div class="flex justify-between px-4 mx-0 mt-0 mb-4 xl:px-8 sm:px-6">
                <h3 class="text-xl font-bold leading-7 ">
                    {{ __('Supplier assessments') }}
                </h3>
                <div>
                    <livewire:supplier.assessment :$supplier />
                </div>
            </div>

            <livewire:reports :$reports :allow-delete="auth()->user()->can('delete', $supplier)" date-field="assessment_date" />
        </div>
    </div>
</div>
