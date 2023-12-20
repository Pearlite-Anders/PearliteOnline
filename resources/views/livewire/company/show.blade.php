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
                    @if(in_array($column['type'], ['file', 'welding_certificate'])) @continue @endif
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
            <table class="w-full table-fixed">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-collapse">Navn</th>
                        @foreach($company->modules() as $module_key => $module)
                            <th <th class="p-2 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-collapse">
                                {{ $module->name }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->users()->where('role', App\Models\User::USER_ROLE)->get() as $key => $user)
                        <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="p-2 text-sm font-normal leading-5 text-gray-900 border-collapse whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            @foreach($company->modules() as $module_key => $module)
                                <td class="p-2 text-sm font-normal leading-5 text-center text-gray-900 border-collapse whitespace-nowrap">
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

                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="p-4 leading-6 text-black">
        <div class="p-4 mb-4 leading-6 text-black bg-white rounded-lg shadow xl:p-8 sm:p-6">
            <h3 class="flex items-center mx-0 mt-0 mb-4 text-xl font-bold leading-7">
                {{ __('Partners') }}
            </h3>
            <table class="w-full table-fixed">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-collapse">Navn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->users()->where('role', App\Models\User::PARTNER_ROLE)->get() as $key => $user)
                        <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="p-2 text-sm font-normal leading-5 text-gray-900 border-collapse whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


</div>
