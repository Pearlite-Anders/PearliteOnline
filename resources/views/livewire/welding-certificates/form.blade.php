<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Welding certificate') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <div>
            <x-label for="form.number" :value="__('Welding certificate no.')" />
            <x-input
                wire:model="form.number"
                placeholder="{{ __('2301502') }}"
                required
            />
            <x-input-error for="form.number" class="mt-2" />
        </div>
        <div>
            <x-label for="form.welder_id" :value="__('Welder')" />
            <x-input.choices
                class="block w-full mt-1"
                wire:model="form.welder_id"
                :options="auth()->user()->currentCompany->users()->where('role', App\Models\User::USER_ROLE)->get()->pluck('name', 'id')->toArray()"
                :selected="$form->welder_id"
                prettyname="welder_id"
                placeholder="{{ __('Choose user') }}"
            />
            <x-input-error for="form.welder_id" class="mt-2" />
        </div>
        <div>
            <x-label for="form.designation" :value="__('Designation')" />
            <x-input
                wire:model="form.designation"
                placeholder="{{ __('135 P BW FM1 S s12 PA ss nb') }}"
            />
            <x-input-error for="form.designation" class="mt-2" />
        </div>
        <div>
            <x-label for="form.welding_process" :value="__('Welding process')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.welding_process"
                :options="App\Models\Setting::get('welding_processes')"
                :selected="$form->welding_process"
                prettyname="welding_process"
                placeholder="{{ __('135') }}"
            />
            <x-input-error for="form.welding_process" class="mt-2" />
        </div>
        <div>
            <x-label for="form.plate_pipe" :value="__('Plate or pipe')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.plate_pipe"
                :options="App\Models\Setting::get('plate_pipes')"
                :selected="$form->plate_pipe"
                prettyname="plate_pipe"
                placeholder="{{ __('P') }}"
            />
            <x-input-error for="form.plate_pipe" class="mt-2" />
        </div>
        <div>
            <x-label for="form.type_of_weld" :value="__('Type of Weld')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.type_of_weld"
                :options="App\Models\Setting::get('filler_material_types')"
                :selected="$form->type_of_weld"
                prettyname="type_of_weld"
                placeholder="{{ __('BW') }}"
            />
            <x-input-error for="form.type_of_weld" class="mt-2" />
        </div>
        <div>
            <x-label for="form.material_group" :value="__('Material group')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.material_group"
                :options="App\Models\Setting::get('material_groups')"
                :selected="$form->material_group"
                prettyname="material_group"
                placeholder="{{ __('1.1') }}"
            />
            <x-input-error for="form.material_group" class="mt-2" />
        </div>
        <div>
            <x-label for="form.filler_material_type" :value="__('Filler material type')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.filler_material_type"
                :options="App\Models\Setting::get('filler_material_types')"
                :selected="$form->filler_material_type"
                prettyname="filler_material_type"
                placeholder="{{ __('S') }}"
            />
            <x-input-error for="form.filler_material_type" class="mt-2" />
        </div>
        <div>
            <x-label for="form.filler_material_group" :value="__('Filler material group')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.filler_material_group"
                :options="App\Models\Setting::get('filler_material_groups')"
                :selected="$form->filler_material_group"
                prettyname="filler_material_group"
                placeholder="{{ __('FM1') }}"
            />
            <x-input-error for="form.filler_material_group" class="mt-2" />
        </div>
        <div>
            <x-label for="form.filler_material_designation" :value="__('Filler material designation')" />
            <x-input
                wire:model="form.filler_material_designation"
                placeholder="{{ __('G42 4 M21 3Si1') }}"
            />
            <x-input-error for="form.filler_material_designation" class="mt-2" />
        </div>
        <div>
            <x-label for="form.shielding_gas" :value="__('Shielding gas')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.shielding_gas"
                :options="App\Models\Setting::get('shielding_gases')"
                :selected="$form->shielding_gas"
                prettyname="shielding_gas"
                placeholder="{{ __('M21') }}"
            />
            <x-input-error for="form.shielding_gas" class="mt-2" />
        </div>
        <div>
            <x-label for="form.type_of_current_and_polarity" :value="__('Type of current and polarity')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.type_of_current_and_polarity"
                :options="App\Models\Setting::get('type_of_current_and_polarities')"
                :selected="$form->type_of_current_and_polarity"
                prettyname="type_of_current_and_polarity"
                placeholder="{{ __('DC+') }}"
            />
            <x-input-error for="form.type_of_current_and_polarity" class="mt-2" />
        </div>
        <div>
            <x-label for="form.material_thickness" :value="__('Material thickness')" />
            <x-input
                wire:model="form.material_thickness"
                placeholder="{{ __('12') }}"
                postfix="mm"
            />
            <x-input-error for="form.material_thickness" class="mt-2" />
        </div>
        <div>
            <x-label for="form.deposited_thickness" :value="__('Deposited thickness')" />
            <x-input
                wire:model="form.deposited_thickness"
                placeholder="{{ __('12') }}"
                postfix="mm"
            />
            <x-input-error for="form.deposited_thickness" class="mt-2" />
        </div>
        <div>
            <x-label for="form.outside_pip_diameter" :value="__('Outside pip diameter')" />
            <x-input
                wire:model="form.outside_pip_diameter"
                placeholder="{{ __('') }}"
                prefix="Ø"
                postfix="mm"
            />
            <x-input-error for="form.outside_pip_diameter" class="mt-2" />
        </div>
        <div>
            <x-label for="form.welding_position" :value="__('Welding position')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.welding_position"
                :options="App\Models\Setting::get('welding_positions')"
                :selected="$form->welding_position"
                prettyname="welding_position"
                placeholder="{{ __('PA') }}"
            />
            <x-input-error for="form.welding_position" class="mt-2" />
        </div>
        <div>
            <x-label for="form.weld_details" :value="__('Weld details')" />
            <x-input.choices
                multiple
                class="block w-full mt-1"
                wire:model="form.weld_details"
                :options="App\Models\Setting::get('weld_detailses')"
                :selected="$form->weld_details"
                prettyname="weld_details"
                placeholder="{{ __('ss nb, ml') }}"
            />
            <x-input-error for="form.weld_details" class="mt-2" />
        </div>
    </div>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <div>
            <x-label for="form.date_examination" :value="__('Date of examination')" />
            <x-input.date
                wire:model="form.date_examination"
            />
            <x-input-error for="form.number" class="mt-2" />
        </div>
        <div>
            <x-label for="date_expiration" :value="__('Certificate expiration date')" />
            <x-input
                value="{{ $this->date_expiration }}"
                disabled
            />
        </div>
        <div></div>
        <div>
            <x-label for="form.last_signature" :value="__('Last signature date')" />
            <x-input.date
                wire:model="form.last_signature"
            />
            <x-input-error for="form.number" class="mt-2" />
        </div>
        <div>
            <x-label for="date_next_signature" :value="__('Next signature date')" />
            <x-input
                value="{{ $this->date_next_signature }}"
                disabled
            />
        </div>
    </div>
</div>

<!-- <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Files') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <x-input.filepond
            wire:model="form.new_certificate"
        />

    </div>

</div> -->
