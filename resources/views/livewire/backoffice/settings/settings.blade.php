<div>
    <div class="flex h-full w-full flex-col">
        <div>
            <x-index-header :hide_search_on_mobile="false">
                <x-slot name="heading">
                    <x-icon.settings class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                    {{ __('Settings') }}
                </x-slot>
                <x-slot name="search">
                    <ul role="list" class="flex flex-none min-w-full text-sm font-semibold leading-6 text-gray-400 gap-x-4 lg:hidden">
                        <li>
                            <button
                                @if($section == 'time-registration')
                                    aria-current="page"
                                    class="text-cyan-500"
                                @endif
                                wire:click="setSection('time-registration')"
                            >{{ __('Time registration') }}</button>
                        </li>
                    </ul>
                </x-slot>
            </x-index-header>
        </div>

        <div class="flex">
            @include('livewire.backoffice.settings.sections')
            @include('livewire.backoffice.settings.time-registration')

            <div class="fixed bottom-0 bg-gray-100 w-full">
                <div class="flex justify-start">
                    <x-button.primary
                        wire:click="save"
                        wire:loading.attr="disabled"
                        class="m-4"
                    >
                        {{ __('Save') }}
                    </x-button>
                </div>
            </div>
        </div>

    </div>

</div>
