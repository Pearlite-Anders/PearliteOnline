<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <div class="mb-4 text-black lg:mb-5">
        <div class="">
            <x-label for="form.password" :value="__('Name')" />
            <x-input
                wire:model="form.name"
                placeholder="{{ __('Name') }}"
                required
            />
            <x-input-error for="form.name" class="mt-2" />
        </div>
    </div>
</div>