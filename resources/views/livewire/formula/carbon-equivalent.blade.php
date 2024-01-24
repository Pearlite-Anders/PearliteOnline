<div>
    <x-form-header>
        <x-slot name="title">{{ __('Carbon Equivalent') }}</x-slot>
    </x-form-header>
    <div class="bottom-0 right-0 px-4 pt-8 pb-4 leading-6 border-b-0 border-gray-200 border-solid text-blackborder-t border-x-0">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-4">
                <div>
                    <x-label for="c" value="C (Carbon)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="c"
                        placeholder="0,15"
                    />
                </div>
                <div>
                    <x-label for="c" value="Mn (Mangan)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="mn"
                        placeholder="1,40"
                    />
                </div>
                <div>
                    <x-label for="c" value="Cr (Chromium)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="cr"
                        placeholder="0,036"
                    />
                </div>
                <div>
                    <x-label for="c" value="Mo (Molybdenum)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="mo"
                        placeholder="0,014"
                    />
                </div>
                <div>
                    <x-label for="c" value="V (Vanadium)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="v"
                        placeholder="0,0041"
                    />
                </div>
                <div>
                    <x-label for="c" value="Ni (Nickel)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="ni"
                        placeholder="0,075"
                    />
                </div>
                <div>
                    <x-label for="c" value="Cu (Copper)" class="!mb-0" />
                    <x-input
                        :live="true"
                        wire:model="cu"
                        placeholder="0,181"
                    />
                </div>
            </div>

            <div class="mt-8">
                <x-label value="" />
                <h3 class="mx-0 mt-0 mb-2 text-lg font-bold leading-7">
                    {{ __('Carbon Equivalent') }}
                </h3>
                <x-label for="c" value="EN 1011-2, C.1" class="!font-bold" />
                <div class="flex items-center space-x-2 leading-tight">
                    <div>
                        CE =
                    </div>
                    <div>
                        {{ $c ?? 'C' }}
                    </div>
                    <div>+</div>
                    <div class="flex flex-col items-center">
                        <div>{{ $mn ?? 'Mn' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>6</div>
                    </div>
                    <div>+</div>
                    <div class="flex flex-col items-center">
                        <div>{{ $cr ?? 'Cr' }} + {{ $mo ?? 'Mo' }} + {{ $v ?? 'V' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>5</div>
                    </div>
                    <div>+</div>
                    <div class="flex flex-col items-center">
                        <div>{{ $ni ?? 'Ni' }} + {{ $cu ?? 'Cu' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>15</div>
                    </div>
                    <div>=</div>
                    <div>
                        {{ $this->ce ? $this->ce : '' }} %
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <x-label for="c" value="EN 1011-2, C.2" class="!font-bold" />
                <div class="flex items-center space-x-2 leading-tight">
                    <div>
                        CET =
                    </div>
                    <div>
                        {{ $c ?? 'C' }}
                    </div>
                    <div>+</div>
                    <div class="flex flex-col items-center">
                        <div>{{ $mn ?? 'Mn' }} + {{ $mo ?? 'Mo' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>10</div>
                    </div>
                    <div>+</div>
                    <div class="flex flex-col items-center">
                        <div>{{ $cr ?? 'Cr' }} + {{ $cu ?? 'Cu' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>20</div>
                    </div>

                    <div>+</div>
                    <div class="flex flex-col items-center">
                        <div>{{ $ni ?? 'Ni' }}</div>
                        <div class="h-[1px] bg-black w-full"></div>
                        <div>40</div>
                    </div>
                    <div>=</div>
                    <div>
                        {{ $this->cet ? $this->cet : '' }} %
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
