<div>
    <x-form-header backlink="{{ route('companies.index') }}">
        <x-slot name="title">{{ $company->data['name'] }}</x-slot>
    </x-form-header>
    <div class="px-4 pt-8 pb-4 leading-6 text-black border-t border-b-0 border-gray-200 border-solid border-x-0">
        <div class="p-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <h3 class="flex items-center mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Company') }}
                <a href="{{ route('companies.edit', $company) }}" class="ml-2 text-gray-600">
                    <x-icon.pencil class="w-4 h-4 text-gray-600" />
                </a>
            </h3>
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                @foreach(App\Models\Company::SYSTEM_COLUMNS as $key => $column)
                    @if(in_array($column['type'], ['file', 'welding_certificate']) || optional($column)['hidden']) @continue @endif
                    <div class="@if($column['type'] == 'textarea') md:col-span-3 @endif">
                        <x-label for="{{ $key }}" :value="__($column['label'])" />
                        {!! $company->getColumnValue($key) !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="p-4">
        <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <x-card-with-footer :link="route('switch-company', $company).'?redirect='.route('wpqr.index')">
                <x-slot:icon>
                    <x-icon.wpqr class="w-8 h-8 text-gray-600" />
                </x-slot:icon>
                <x-slot:title>
                    {{ __('WPQR')}}
                </x-slot>
                <x-slot:number>
                    {{ $company->wpqrs()->count() }}
                </x-slot>
            </x-card-with-footer>
            <x-card-with-footer :link="route('switch-company', $company).'?redirect='.route('wps.index')">
                <x-slot:icon>
                    <x-icon.wps class="w-8 h-8 text-gray-600" />
                </x-slot:icon>
                <x-slot:title>
                    {{ __('WPS')}}
                </x-slot>
                <x-slot:number>
                    {{ $company->wps()->count() }}
                </x-slot>
            </x-card-with-footer>
            <x-card-with-footer :link="route('switch-company', $company).'?redirect='.route('welding-certificates.index')">
                <x-slot:icon>
                    <x-icon.welding-certificate class="w-8 h-8 text-gray-600" />
                </x-slot:icon>
                <x-slot:title>
                    {{ __('Welding Certificates')}}
                </x-slot>
                <x-slot:number>
                    {{ $company->weldingcertificates()->count() }}
                </x-slot>
            </x-card-with-footer>
            <x-card-with-footer :link="route('switch-company', $company).'?redirect='.route('welder.index')">
                <x-slot:icon>
                    <x-icon.welder class="w-8 h-8 text-gray-600" />
                </x-slot:icon>
                <x-slot:title>
                    {{ __('Active Welders')}}
                </x-slot>
                <x-slot:number>
                    {{ $company->welders()->where('data->status', 'active')->count() }}
                </x-slot>
            </x-card-with-footer>
        </dl>
    </div>

    <div class="p-4 leading-6 text-black">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <h3 class="flex items-center mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Bruger') }}
            </h3>
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                        @foreach($company->modules() as $module_key => $module)
                            <x-table.heading>
                                {{ $module->name }}
                            </x-table.heading>
                        @endforeach
                    </x-table.row>
                </x-slot>
                <x-slot name="body">
                    @foreach($company->users()->where('role', App\Models\User::USER_ROLE)->get() as $key => $user)
                        <x-table.row>
                            <x-table.cell>
                                {{ $user->name }}
                            </x-table.cell>
                            @foreach($company->modules() as $module_key => $module)
                                <x-table.cell class="text-center">
                                    @php($persmissions = [])
                                    @foreach($module->permissions as $permission => $permission_name)
                                        @if($user->can($module_key .'.'. $permission))
                                            @php($persmissions[] = $permission)
                                        @endif
                                    @endforeach
                                    @if(in_array('edit', $persmissions))
                                        <span class="text-green-600">{{ __('Edit') }}</span>
                                    @elseif(in_array('view', $persmissions))
                                        <span class="text-cyan-600">{{ __('View') }}</span>
                                    @else
                                    @endif
                                </x-table.cell>
                            @endforeach
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
    <div class="p-4 leading-6 text-black">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <h3 class="flex items-center mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Partners') }}
            </h3>
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading sortable>{{ __('Name') }}</x-table.heading>
                    </x-table.row>
                </x-slot>
                <x-slot name="body">
                    @foreach($company->users()->where('role', App\Models\User::USER_ROLE)->get() as $key => $user)
                        <x-table.row>
                            @foreach($company->users()->where('role', App\Models\User::PARTNER_ROLE)->get() as $key => $user)
                                <x-table.cell >
                                    {{ $user->name }}
                                </x-table.cell>
                            @endforeach
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>

        </div>
    </div>

    <div class="p-4 leading-6 text-black">
        <div class="px-4 pb-8 mb-4 leading-6 text-black bg-white rounded-lg shadow">
            <livewire:contact-person.index :company="$company" />
        </div>
    </div>


</div>
