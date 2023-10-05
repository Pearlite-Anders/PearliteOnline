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

<div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
    <h3 class="mx-0 mt-0 mb-4 text-xl font-bold leading-7">
        {{ __('Permissions') }}
    </h3>
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <div></div>
        <div class="hidden font-bold md:block">{{ __('View') }}</div>
        <div class="hidden font-bold md:block">{{ __('Edit') }}</div>

        @foreach(auth()->user()->currentCompany->modules() as $module_key => $module)
            <div class="text-lg font-bold">{{ $module->name }}</div>

            @foreach($module->permissions as $permission => $permission_name)
                <div
                    x-data="{ value: $wire.get('form.permissions.{{ $module_key }}.{{ $permission }}') }"
                    class="flex items-center space-x-4 md:space-x-0"
                >
                    <label class="w-24 md:hidden">{{ $permission_name }}</label>
                    <button
                        x-ref="toggle"
                        @click="value = ! value; $wire.set('form.permissions.{{ $module_key }}.{{ $permission }}', value)"
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

        @endforeach
    </div>
</div>
