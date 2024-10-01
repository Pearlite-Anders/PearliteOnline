<div
    id="multiple-choice"
    @unless($section == 'multiple-choice')
        class="hidden"
    @endunless
>
    <x-settings-page>
        <x-slot name="heading">
            <x-icon.adjustments-horizontal class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Common Multiple Choice Fields') }}
        </x-slot>

        <x-setting-section class="mb-4">
                <x-slot name="title">
                    {{ __('Signatures') }}
                </x-slot>

                <x-slot name="description">
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-5">
                        <div class="flex w-full space-x-2">
                            <div class="flex-1 text-sm">{{ __('Name') }}</div>
                            <div class="flex-1 text-sm">{{ __('Title') }}</div>
                        </div>
                    </div>
                    @if(is_array($settings['signature_group']))
                        @foreach($settings['signature_group'] as $key => $process)
                            <div class="col-span-5">
                                <div class="flex w-full space-x-2">
                                    <div class="flex-1">
                                        <x-input
                                            id="signature_group.{{ $key }}[0]"
                                            type="text"
                                            class="block w-full"
                                            wire:model="settings.signature_group.{{ $key }}.0"
                                        />
                                    </div>
                                    <div class="flex-1">
                                        <x-input
                                            id="signature_group.{{ $key }}[1]"
                                            type="text"
                                            class="block w-full"
                                            wire:model="settings.signature_group.{{ $key }}.1"
                                        />
                                    </div>
                                </div>
                                <x-input-error for="signature_group.{{ $key }}.0" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end col-span-1">
                                @if($confirming == 'signature_group.'. $key)
                                    <x-button
                                        wire:click="deleteArrayItem('signature_group', '{{ $key }}')"
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
                                        wire:click="confirmDelete('signature_group.{{ $key }}')"
                                        class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <x-icon.trash class="w-5 h-5 text-red-600" />
                                    </x-button>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <div class="col-span-6">
                        <x-button.secondary
                            wire:click="addArrayItem('signature_group', [])"
                            class="flex items-center"
                        >
                            <x-icon.plus class="w-4 h-4 mr-2 text-gray-700" /> {{ __('Add option') }}
                        </x-button.secondary>
                    </div>
                </x-slot>
            </x-setting-section>

        @php($arraySections = [
            'welding_processes' => __('Welding processes'),
            'plate_pipes' => __('Plate or pipe'),
            'type_of_welds' => __('Type of Weld'),
            'material_groups' => __('Material group'),
            'filler_material_types' => __('Filler material type'),
            'filler_material_groups' => __('Filler material group'),
            'shielding_gases' => __('Shielding gas'),
            'type_of_current_and_polarities' => __('Type of current and polarity'),
            'welding_positions' => __('Welding position'),
            'weld_detailses' => __('Weld details'),
            'type_of_joints' => __('Type of joint'),
            'type_of_joint_preparations' => __('Type of joint preparation'),
            'layers' => __('Layers'),
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
                            @if($confirming == '{{ $arraySectionKey }}.'. $key)
                                <x-button
                                    wire:click="deleteArrayItem({{ $arraySectionKey }}, {{ $key }})"
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
