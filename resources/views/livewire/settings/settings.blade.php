<div>
    <x-index-header>
        <x-slot name="heading">
            <x-icon.settings class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Settings') }}
        </x-slot>
        <x-slot name="search">
            <ul role="list" class="flex flex-none min-w-full text-sm font-semibold leading-6 text-gray-400 gap-x-4">
                <li>
                    <button
                        @if($section == 'welding-certificates')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('welding-certificates')"
                    >{{ __('Welding Certificates') }}</button>
                </li>
                <li>
                    <button
                        @if($section == 'wpqr')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('wpqr')"
                    >{{ __('WPQR') }}</button>
                </li>
                <li>
                    <button
                        @if($section == 'wps')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('wps')"
                    >{{ __('WPS') }}</button>
                </li>
                <li>
                    <button
                        @if($section == 'ce')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('ce')"
                    >{{ __('CE') }}</button>
                </li>
                <li>
                    <button
                        @if($section == 'supplier')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('supplier')"
                    >{{ __('Supplier') }}</button>
                </li>
                <li>
                    <button
                        @if($section == 'maintenance')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('maintenance')"
                    >{{ __('Maintenance') }}</button>
                </li>
                <li>
                    <button
                        @if($section == 'multiple-choice')
                            aria-current="page"
                            class="text-cyan-500"
                        @endif
                        wire:click="setSection('multiple-choice')"
                    >{{ __('Common Multiple Choice Fields') }}</button>
                </li>
            </ul>
        </x-slot>
    </x-index-header>

    <div class="max-w-5xl px-4 pt-8 pb-4 leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0">
        @include('livewire.settings.welding-certificates')
        @include('livewire.settings.wpqr')
        @include('livewire.settings.maintenance')
        @include('livewire.settings.wps')
        @include('livewire.settings.ce')
        @include('livewire.settings.supplier')
        @include('livewire.settings.multiple-choice')
    </div>

</div>
