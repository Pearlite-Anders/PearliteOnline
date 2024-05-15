<div>
    <x-button.secondary
        class="flex items-center"
        wire:click="toggleModal"
    >
        <x-icon.plus class="mr-2 -ml-1 align-middle" />
        {{ __('Attach') }}
    </x-button.secondary>

    @if($showModal)
        <x-modal maxWidth="sm">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ sprintf(__('Click on a %s to attach'), $name) }}
                    </h3>

                    <div class="mt-4 text-gray-600">
                        @forelse($models as $single_model)
                            <div
                                wire:click="attachModel({{$single_model->id}})"
                                class="flex items-center px-1 py-1 transition-all duration-300 cursor-pointer hover:bg-gray-100"
                            >
                                {{ $single_model->getColumnValue($name_field) }}
                            </div>
                        @empty
                            <p class="italic">{{ sprintf(__('No %s to attach'), $name) }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 text-right bg-gray-100">
                <x-button.secondary wire:click="toggleModal">
                    {{ __('Close') }}
                </x-button.secondary>
            </div>
        </x-modal>
    @endif
</div>
