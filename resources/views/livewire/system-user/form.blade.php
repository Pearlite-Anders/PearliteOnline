<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('General information') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <div>
            <x-label for="form.name" :value="__('Name')" />
            <x-input
                wire:model="form.name"
                placeholder="{{ __('Name') }}"
                required
            />
            <x-input-error for="form.name" class="mt-2" />
        </div>
        <div>
            <x-label for="form.email" :value="__('Email')" />
            <x-input
                wire:model="form.email"
                placeholder="{{ __('Email') }}"
                required
            />
            <x-input-error for="form.name" class="mt-2" />
        </div>
        <div></div>
        <div>
            <x-label for="form.role" :value="__('Role')" />
            <x-input.select
                wire:model.live="form.role"
                placeholder="{{ __('Select a role') }}"
                required
            >
                <option value="{{ App\Models\User::PARTNER_ROLE }}">{{ __('Partner') }}</option>
                <option value="{{ App\Models\User::ADMIN_ROLE }}">{{ __('Admin') }}</option>
            </x-input.select>
            <x-input-error for="form.role" class="mt-2" />
        </div>

        <div>
            <x-label for="form.password" :value="__('Password')" />
            <x-input
                type="password"
                wire:model="form.password"
                placeholder="{{ __('Password') }}"
            />
            <x-input-error for="form.password" class="mt-2" />
        </div>
    </div>
</div>

@if($this->form->role == \App\Models\User::PARTNER_ROLE)
<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Companies') }}
    </h3>
    <div class="grid grid-cols-2 gap-6 mb-6">
        <div></div>
        <div class="font-bold">{{ __('Access') }}</div>


        @foreach($companies as $company)
            <div class="text-lg font-bold">{{ $company->data['name'] }}</div>
            <div
                x-data="{ value: $wire.get('form.companies.{{ $company->id }}') }"
                class="flex items-center space-x-4 md:space-x-0"
            >
                <button
                    x-ref="toggle"
                    @click="value = ! value; $wire.set('form.companies.{{ $company->id }}', value)"
                    type="button"
                    role="switch"
                    :aria-checked="value"
                    :class="value ? 'bg-cyan-600' : 'bg-slate-300'"
                    class="relative inline-flex py-1 transition rounded-full w-14"
                >
                    <span
                        :class="value ? 'translate-x-7' : 'translate-x-1'"
                        class="w-6 h-6 transition bg-white rounded-full shadow-md"
                        aria-hidden="true"
                    ></span>
                </button>
            </div>
        @endforeach
    </div>
</div>
@endif
