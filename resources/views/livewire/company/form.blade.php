<div class="mb-4 text-black lg:mb-5 lg:pl-4">
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
