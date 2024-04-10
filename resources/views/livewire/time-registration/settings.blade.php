<div class="max-w-5xl px-4 pt-8 pb-4 leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0">
    <div id="multiple-choice">
        <x-setting-section class="mb-4">
            <x-slot name="title">
                {{ __('Tasks') }}
            </x-slot>

            <x-slot name="description">
            </x-slot>

            <x-slot name="form">
                @foreach($settings as $key => $process)
                    <div class="col-span-5">
                        <x-input
                            id="settings.{{ $key }}"
                            type="text"
                            class="block w-full"
                            wire:model="settings.{{ $key }}"
                        />
                        <x-input-error for="settings.{{ $key }}" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end col-span-1">
                        @if($confirming == $key)
                            <x-button
                                wire:click="deleteArrayItem({{ $key }})"
                                class="bg-red-700 hover:bg-red-800"
                            >
                                <x-icon.check class="w-4 h-4 text-white" />
                            </x-button>
                            <x-button
                                wire:click="cancelConfirmDelete"
                                class="bg-cyan-600 hover:bg-cyan-700"
                            >
                                <x-icon.x class="w-4 h-4 text-white" />
                            </x-button>
                        @else
                            <x-button
                                wire:click="confirmDelete({{ $key }}')"
                                class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                            >
                                <x-icon.trash class="w-5 h-5 text-red-600" />
                            </x-button>
                        @endif
                    </div>
                @endforeach
                <div class="col-span-6">
                    <x-button.secondary
                        wire:click="addArrayItem()"
                        class="flex items-center"
                    >
                        <x-icon.plus class="w-4 h-4 mr-2 text-gray-700" /> {{ __('Add option') }}
                    </x-button.secondary>
                </div>
            </x-slot>
        </x-setting-section>

        <div class="flex justify-end">
            <x-button.primary
                wire:click="save"
                wire:loading.attr="disabled"
                class="mt-4"
            >
                {{ __('Save') }}
            </x-button>
        </div>
    </div>
</div>
