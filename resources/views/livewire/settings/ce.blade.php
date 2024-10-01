<div
    id="multiple-choice"
    @unless($section == 'ce')
        class="hidden"
    @endunless
>
    <x-settings-page>
        <x-slot name="heading">
            <x-icon.ce class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('CE') }}
        </x-slot>

        @php($arraySections = [
            'supplier_assessment_frequencies' => __('Assessment frequency (in months)'),
        ])
        <x-setting-section class="mb-4">
            <x-slot name="title">
                {{ __('Fields') }}
            </x-slot>

            <x-slot name="description">
            </x-slot>

            <x-slot name="form">
                <div class="col-span-5 space-y-4">
                    <div>
                        <div class="flex mb-2 item-center">
                            <x-label for="ce.identification_number" :value="__('The notified body\'s identification number')" class="!mb-0" />
                        </div>
                        <x-input
                            id="ce.identification_number"
                            type="text"
                            class="block w-full"
                            wire:model="settings.ce_identification_number"
                            placeholder="01234"
                        />
                    </div>
                    <div>
                        <x-label for="ce.company" :value="__('Company')" />
                        <x-input
                            id="ce.company"
                            class="block w-full"
                            wire:model="settings.ce_company"
                            placeholder="Smedemester ApS"
                        />
                    </div>
                    <div>
                        <x-label for="ce.company_address" :value="__('Company adress')" />
                        <x-input
                            id="ce.company_address"
                            class="block w-full"
                            wire:model="settings.ce_company_address"
                            placeholder="Smedevej 12"
                        />
                    </div>
                    <div class="flex space-x-4">
                        <div>
                            <x-label for="ce.company_zip" :value="__('Zipcode')" />
                            <x-input
                                id="ce.company_zip"
                                class="block w-full"
                                wire:model="settings.ce_company_zip"
                                placeholder="7400"
                            />
                        </div>
                        <div class="flex-grow">
                            <x-label for="ce.company_city" :value="__('City')" />
                            <x-input
                                id="ce.company_city"
                                class="block w-full"
                                wire:model="settings.ce_company_city"
                                placeholder="7400"
                            />
                        </div>
                    </div>
                    <div>
                        <x-label for="ce.certificate_number" :value="__('Certificate number')" />
                        <x-input
                            id="ce.certificate_number"
                            type="text"
                            class="block w-full"
                            wire:model="settings.ce_certificate_number"
                            placeholder="01234-CPR-654321"
                        />
                    </div>
                    <div>
                        <div class="flex mb-2 item-center">
                            <x-label for="ce.release_of_cadmium" :value="__('Release of Cadmium')" class="!mb-0" />
                            <x-tooltip-question-mark :tooltip="__('Normally, there is no testing for the content of CADMIUM, therefore “NPD” is indicated')" class="h-4 ml-1 mt-[2px]" />
                        </div>
                        <x-input
                            id="ce.release_of_cadmium"
                            type="text"
                            class="block w-full"
                            wire:model="settings.ce_release_of_cadmium"
                            placeholder="NPD"
                        />
                    </div>
                    <div>
                        <div class="flex mb-2 item-center">
                            <x-label for="ce.release_of_lead" :value="__('Release of Lead')" class="!mb-0" />
                            <x-tooltip-question-mark :tooltip="__('Normally, there is no testing for emission of radioactivity, therefore “NPD” is indicated')" class="h-4 ml-1 mt-[2px]" />
                        </div>
                        <x-input
                            id="ce.emission_of_radioactivity"
                            type="text"
                            class="block w-full"
                            wire:model="settings.ce_emission_of_radioactivity"
                            placeholder="NPD"
                        />
                    </div>
                    <div></div>
                </div>
            </x-slot>
        </x-setting-section>

        <x-setting-section class="mb-4">
            <x-slot name="title">
                {{ __('Weldability') }}
            </x-slot>

            <x-slot name="description">
            </x-slot>

            <x-slot name="form">
                <div class="col-span-5">
                    <div class="flex w-full space-x-2">
                        <div class="flex-1 text-sm">{{ __('Weldability') }}</div>
                        <div class="flex-1 text-sm">{{ __('Technical delivery conditions') }}</div>
                        <div class="flex-1 text-sm">{{ __('Facture toughness') }}</div>
                    </div>
                </div>
                @foreach($settings['ce_weldability_group'] as $key => $process)
                    <div class="col-span-5">
                        <div class="flex w-full space-x-2">
                            <div class="flex-1">
                                <x-input
                                    id="ce_weldability_group.{{ $key }}[0]"
                                    type="text"
                                    class="block w-full"
                                    wire:model="settings.ce_weldability_group.{{ $key }}.0"
                                />
                            </div>
                            <div class="flex-1">
                                <x-input
                                    id="ce_weldability_group.{{ $key }}[1]"
                                    type="text"
                                    class="block w-full"
                                    wire:model="settings.ce_weldability_group.{{ $key }}.1"
                                />
                            </div>
                            <div class="flex-1">
                                <x-input
                                    id="ce_weldability_group.{{ $key }}[2]"
                                    type="text"
                                    class="block w-full"
                                    wire:model="settings.ce_weldability_group.{{ $key }}.2"
                                />
                            </div>
                        </div>
                        <x-input-error for="ce_weldability_group.{{ $key }}.0" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end col-span-1">
                        @if($confirming == 'ce_weldability_group.'. $key)
                            <x-button
                                wire:click="deleteArrayItem('ce_weldability_group', '{{ $key }}')"
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
                                wire:click="confirmDelete('ce_weldability_group.{{ $key }}')"
                                class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                            >
                                <x-icon.trash class="w-5 h-5 text-red-600" />
                            </x-button>
                        @endif
                    </div>
                @endforeach
                <div class="col-span-6">
                    <x-button.secondary
                        wire:click="addArrayItem('ce_weldability_group', [])"
                        class="flex items-center"
                    >
                        <x-icon.plus class="w-4 h-4 mr-2 text-gray-700" /> {{ __('Add option') }}
                    </x-button.secondary>
                </div>
            </x-slot>
        </x-setting-section>

        @php($arraySections = [
            'ce_surface' => __('Surface'),
            'ce_standards' => __('Standards'),
            'ce_tolerance_classes' => __('Tolerance classes'),
            'ce_behavior_in_fires' => __('Fire resistance'),
            'ce_execution_standards' => __('Execution standard'),
            'ce_execution_classes' => __('Execution class'),
        ])

        @foreach($arraySections as $arraySectionKey => $arraySectionName)
            <x-setting-section class="mb-4">
                <x-slot name="title">
                    {{ $arraySectionName }}
                </x-slot>

                <x-slot name="description">
                </x-slot>

                <x-slot name="form">
                    @foreach($settings[$arraySectionKey] as $key => $process)
                        <div class="col-span-5">
                            <x-input
                                id="{{ $arraySectionKey }}.{{ $key }}"
                                type="text"
                                class="block w-full"
                                wire:model="settings.{{ $arraySectionKey }}.{{ $key }}"
                            />
                            <x-input-error for="{{ $arraySectionKey }}.{{ $key }}" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end col-span-1">
                            @if($confirming == $arraySectionKey .'.'. $key)
                                <x-button
                                    wire:click="deleteArrayItem('{{ $arraySectionKey }}', '{{ $key }}')"
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
                                    wire:click="confirmDelete('{{ $arraySectionKey }}.{{ $key }}')"
                                    class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                >
                                    <x-icon.trash class="w-5 h-5 text-red-600" />
                                </x-button>
                            @endif
                        </div>
                    @endforeach
                    <div class="col-span-6">
                        <x-button.secondary
                            wire:click="addArrayItem('{{ $arraySectionKey }}')"
                            class="flex items-center"
                        >
                            <x-icon.plus class="w-4 h-4 mr-2 text-gray-700" /> {{ __('Add option') }}
                        </x-button.secondary>
                    </div>
                </x-slot>
            </x-setting-section>
        @endforeach

        <div class="flex justify-end">
            <x-button.primary
                wire:click="save"
                wire:loading.attr="disabled"
                class="mt-4"
            >
                {{ __('Save') }}
            </x-button>
        </div>
    </x-settings-page>
</div>
