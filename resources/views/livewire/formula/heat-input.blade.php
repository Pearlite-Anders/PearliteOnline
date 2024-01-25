<div>
    <x-form-header>
        <x-slot name="title">{{ __('Heat Input') }}</x-slot>
    </x-form-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <div class="grid grid-cols-1 gap-2 mb-6 md:gap-6 md:grid-cols-4">
                <div class="md:col-span-4">
                    <x-label for="c" value="Welding Process - K Factor"/>

                    <fieldset class="max-w-2xl">
                        <div class="relative -space-y-px bg-white rounded-md">
                            <label class="relative grid grid-cols-5 p-4 py-2 border cursor-pointer rounded-tl-md rounded-tr-md focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <span class="font-medium ml-7">{{ __('Process no') }}</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    <span class="font-medium">{{ __('Weilding Process') }}</span>
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">{{ __('K Factor') }}</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="12" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">12</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('Submerged Arc Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">1,0</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="111" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">111</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('Metal Inert Gas Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,8</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="131" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">131</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('MIG Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,8</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="135" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">135</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('MAG Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,8</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="114" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">114</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('Self-Shielded Tubular Cored Arc Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,8</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="136" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">136</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('Tubular Cored wire Metal Arc Welding with active gas shield') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,8</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="137" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">137</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('Tubular Cored wire Metal Arc Welding with inert gas shield') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,8</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="141" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">141</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('TIG Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,6</span>
                            </label>
                            <label class="relative grid grid-cols-5 p-4 border cursor-pointer focus:outline-none md:pl-4 md:pr-6">
                                <span class="flex items-center text-sm">
                                    <input type="radio" name="k_factor" wire:model.live="k_factor" value="15" class="w-4 h-4 border-gray-300 text-cyan-600 focus:ring-cyan-600 active:ring-2 active:ring-offset-2 active:ring-cyan-600">
                                    <span class="ml-3">15</span>
                                </span>
                                <span class="col-span-3 pl-0 ml-6 text-sm text-center md:ml-0">
                                    {{ __('Plasma Arc Welding') }}
                                </span>
                                <span class="pl-1 ml-6 text-sm md:ml-0 md:pl-0 md:text-right">0,6</span>
                            </label>


                        </div>
                    </fieldset>


                </div>

                <div>
                    <x-label for="c" :value="__('Voltage (V)')" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model.live="v"
                        placeholder="120"
                        postfix="V"
                    />
                </div>
                <div>
                    <x-label for="c" :value="__('Amperage (A)')" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model.live="a"
                        placeholder="23"
                        postfix="A"
                    />
                </div>
                <div>
                    <x-label for="c" :value="__('Welding Time (s)')" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model.live="t"
                        placeholder="60"
                        postfix="sek."
                    />
                </div>
                <div>
                    <x-label for="c" :value="__('Welding length (mm)')" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model.live="l"
                        placeholder="300"
                        postfix="mm"
                    />
                </div>

            </div>

            <div class="mt-8">
                <x-label value="" />
                <h3 class="mx-0 mt-0 mb-2 text-lg font-bold leading-7">
                    {{ __('Heat Input') }}
                </h3>
                <div class="flex items-center space-x-2 leading-tight">
                    <div>
                        Heat input =
                    </div>
                    <div class="flex flex-col items-center">
                        <div>{{ $v ?? 'V' }} x {{ $a ?? 'A' }} x {{ $t ?? 's' }} x {{ $this->k_factor_value() ?? 'k-factor' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>{{ $l ?? 'mm' }} x 1000</div>
                    </div>
                    <div>=</div>
                    <div>
                        {{ $this->heat_input ? $this->heat_input : '' }}
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
