<div>
    <x-button.primary wire:click="toggleMaintenanceFormOpen" class="{{ $class }}" @click.stop="console.log('stop')">
        {{ $buttonText }}
    </x-button.primary>

    <!-- New maintenance form -->
    @if($maintenanceFormOpen)
        <x-modal id="maintenance-form" maxWidth="lg">

            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="mx-0 mt-0 mb-2 font-bold leading-7 text-md">
                        {{ __('New maintenance') }}
                    </h3>
                    <div class="relative block max-w-md">
                        <div class="flex mb-2 item-center">
                            <x-label for="maintenance_date" :value="__('Select date for maintenance')" class="!mb-0" />
                        </div>
                        <div>
                            <x-input.date wire:model="maintenance_date" id="maintenance_date" class="w-full" />
                        </div>
                        <div class="flex mt-4 mb-2 item-center">
                            <x-label for="maintenance_file" :value="__('Upload of documentation')" class="!mb-0" />
                        </div>
                        <div x-data="{}" @click.stop="console.log('stop')">
                            <x-input.filepond wire:model="maintenance_file" id="maintenance_file" class="w-full" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
                <x-button.primary wire:click="createReport" @click.stop="console.log('stop')">
                    {{ __('Create') }}
                </x-button.primary>
                <x-button.secondary
                    wire:click="toggleMaintenanceFormOpen"
                    @click.stop="console.log('stop')"
                >{{ __('Cancel') }}</x-button.secondary>
            </div>
        </x-modal>
    @endif
</div>
