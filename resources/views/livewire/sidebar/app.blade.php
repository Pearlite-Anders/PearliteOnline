<aside id="sidebar" class="fixed top-0 left-0 flex-col flex-shrink-0 hidden w-64 h-full pt-16 duration-75 md:flex">
    <div class="relative flex flex-1 min-h-0 pt-0 border-r">
        <div class="flex flex-col flex-1 overflow-auto">
            <div class="flex-1 px-3 pb-16 leading-6 text-black bg-white">
                @if(auth()->user()->currentCompany)
                    <ul class="px-0 pt-0 pb-2 m-0 text-black list-none">
                        <li class="mt-2 mb-0 text-left list-outside">
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                <x-icon.home class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </li>
                        <li class="mt-2 mb-0 text-left list-outside">
                            <hr class="border-t border-gray-200">
                        </li>
                        @can('viewAny', App\Models\WeldingCertificate::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('welding-certificates.index') }}" :active="request()->routeIs('welding-certificates.*')">
                                    <x-icon.welding-certificate class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Welding Certificates') }}
                                </x-nav-link>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\Wps::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('wps.index') }}" :active="request()->routeIs('wps.*')">
                                    <x-icon.wps class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('WPS') }}
                                </x-nav-link>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\Wpqr::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('wpqr.index') }}" :active="request()->routeIs('wpqr.*')">
                                    <x-icon.wpqr class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('WPQR') }}
                                </x-nav-link>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\WeldingCoordination::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('welding-coordination.index') }}" :active="request()->routeIs('welding-coordination.*')">
                                    <x-icon.welding-coordination class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Welding Coordination') }}
                                </x-nav-link>
                            </li>
                        @endcan

                        @can('viewAny', App\Models\Document::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('documents.index') }}" :active="request()->routeIs('documents.*')">
                                    <x-icon.book class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Documents') }}
                                </x-nav-link>
                            </li>
                        @endcan

                        @if(
                            auth()->user()->can('viewAny', App\Models\WeldingCertificate::class) ||
                            auth()->user()->can('viewAny', App\Models\Wps::class) ||
                            auth()->user()->can('viewAny', App\Models\Wpqr::class) ||
                            auth()->user()->can('viewAny', App\Models\WeldingCoordination::class)
                        )
                            <li class="mt-2 mb-0 text-left list-outside">
                                <hr class="border-t border-gray-200">
                            </li>
                        @endif
                        @can('viewAny', App\Models\MachineMaintenance::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('machine-maintenance.index') }}" :active="request()->routeIs('machine-maintenance.*')">
                                    <x-icon.maintenance class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Maintenance') }}
                                </x-nav-link>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\Supplier::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('supplier.index') }}" :active="request()->routeIs('supplier.*')">
                                    <x-icon.truck class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Supplier') }}
                                </x-nav-link>
                            </li>
                        @endcan
                        @if(
                            auth()->user()->can('viewAny', App\Models\MachineMaintenance::class) ||
                            auth()->user()->can('viewAny', App\Models\Supplier::class)
                        )
                            <li class="mt-2 mb-0 text-left list-outside">
                                <hr class="border-t border-gray-200">
                            </li>
                        @endif

                        @can('viewAny', App\Models\Project::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('project.index') }}" :active="request()->routeIs('project.*')">
                                    <x-icon.project class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Projects') }}
                                </x-nav-link>
                            </li>
                            <li class="mt-2 mb-0 text-left list-outside">
                                <hr class="border-t border-gray-200">
                            </li>
                        @endcan
                        @can('viewAny', App\Models\Ce::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('ce.index') }}" :active="request()->routeIs('ce.*')">
                                    <x-icon.ce class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('CE Marking') }}
                                </x-nav-link>
                            </li>
                            <li class="mt-2 mb-0 text-left list-outside">
                                <hr class="border-t border-gray-200">
                            </li>
                        @endcan

                        @can('viewAny', App\Models\Formula::class)
                            <li
                                class="mt-2 mb-0 text-left list-outside"
                                x-data="{ open: {{ request()->routeIs('formulas.*') ? 'true' : 'false'}} }"
                            >
                                <button
                                    @click="open = !open"
                                    type="button"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 rounded-lg cursor-pointer hover:bg-cyan-50"
                                >
                                    <x-icon.calculator class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Formulas') }}
                                    <x-icon.plus x-show="!open" class="w-4 h-4 ml-auto text-gray-500 align-middle duration-75 ease-in-out" />
                                    <x-icon.minus x-show="open" class="w-4 h-4 ml-auto text-gray-500 align-middle duration-75 ease-in-out" />


                                </button>
                                <ul
                                    x-show="open"
                                    x-cloak
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="px-0 pt-0 pb-2 m-0 text-black list-none ml-7"
                                >
                                    <li class="mt-2 mb-0 text-left list-outside">
                                        <x-nav-link class="text-sm" href="{{ route('formulas.carbon-equivalent') }}" :active="request()->routeIs('formulas.carbon-equivalent')">
                                            {{ __('Carbon Equivalent') }}
                                        </x-nav-link>
                                    </li>
                                    <li class="mt-2 mb-0 text-left list-outside">
                                        <x-nav-link class="text-sm" href="{{ route('formulas.heat-input') }}" :active="request()->routeIs('formulas.heat-input')">
                                            {{ __('Heat Input') }}
                                        </x-nav-link>
                                    </li>
                                    <li class="mt-2 mb-0 text-left list-outside">
                                        <x-nav-link class="text-sm" href="{{ route('formulas.z-value') }}" :active="request()->routeIs('formulas.z-value')">
                                            {{ __('Z Value') }}
                                        </x-nav-link>
                                    </li>
                                    <li class="mt-2 mb-0 text-left list-outside">
                                        <x-nav-link class="text-sm" href="{{ route('formulas.welding-speed') }}" :active="request()->routeIs('formulas.welding-speed')">
                                            {{ __('Welding speed pr. heat input') }}
                                        </x-nav-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="mt-2 mb-0 text-left list-outside">
                                <hr class="border-t border-gray-200">
                            </li>
                        @endcan

                        @can('viewAny', App\Models\User::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                                    <x-icon.users class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Users') }}
                                </x-nav-link>
                            </li>
                        @endcan

                        @can('viewAny', App\Models\Welder::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('welder.index') }}" :active="request()->routeIs('welder.*')">
                                    <x-icon.welder class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Welders') }}
                                </x-nav-link>
                            </li>
                        @endcan

                        @if(auth()->user()->currentCompany && auth()->user()->can('viewAny', App\Models\Settings::class))
                            <li class="mt-2 mb-0 text-left list-outside">
                                <hr class="border-t border-gray-200">
                            </li>
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('settings') }}" :active="request()->routeIs('settings')">

                                    <x-icon.settings class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Settings') }}
                                </x-nav-link>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 justify-center hidden w-full p-4 leading-6 text-black bg-white lg:flex border-r">

    </div>


</aside>
