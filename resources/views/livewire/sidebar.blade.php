<aside id="sidebar" class="fixed top-0 left-0 flex-col flex-shrink-0 hidden w-64 h-full pt-16 duration-75 md:flex">
    <div class="relative flex flex-1 min-h-0 pt-0 border-r">
        <div class="flex flex-col flex-1 overflow-auto">
            <div class="flex-1 px-3 leading-6 text-black bg-white">
                @if(auth()->user()->currentCompany)
                    <ul class="px-0 pt-0 pb-2 m-0 text-black list-none">
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
                        @can('viewAny', App\Models\Welder::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('welder.index') }}" :active="request()->routeIs('welder.*')">
                                    <x-icon.welder class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Welders') }}
                                </x-nav-link>
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
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 justify-center hidden w-full p-4 leading-6 text-black lg:flex">
        @if(Auth::user()->isAdmin() || Auth::user()->isPartner())
            <a
                href="{{ route('companies.index') }}"
                class="inline-flex justify-center p-2 text-gray-900 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
                title="Companies"
            >
                <x-icon.companies class="block w-6 h-6 align-middle" />
            </a>
        @endif
        @if(Auth::user()->isAdmin())
            <a
                href="{{ route('system-users.index') }}"
                class="inline-flex justify-center p-2 text-gray-900 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
                title="System user"
            >
                <x-icon.users class="block w-6 h-6 align-middle" />
            </a>
        @endif

        @if(auth()->user()->currentCompany && auth()->user()->can('viewAny', App\Models\Settings::class))
            <a
                href="{{ route('settings') }}"
                class="inline-flex justify-center p-2 text-gray-900 rounded cursor-pointer hover:bg-gray-100 hover:text-gray-900"
            >
                <x-icon.settings class="block w-6 h-6 text-gray-500 align-middle" />
            </a>
        @endif


        <x-dropdown align="bottom" width="48">
            <x-slot name="trigger">
                <button
                    type="button"
                    data-dropdown-toggle="language-dropdown"
                    class="inline-flex justify-center p-2 my-0 text-center text-gray-500 normal-case bg-transparent rounded cursor-pointer bg-none hover:bg-gray-100 hover:text-gray-900"
                >
                    <x-flag/>
                </button>
            </x-slot>

            <x-slot name="content">
                <ul class="px-0 py-1 m-0 text-black" role="none" style="list-style: none;">
                    <li class="text-left" style="list-style: outside none none;">
                        <a href="{{ route('locale', 'en') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 cursor-pointer hover:bg-gray-100" role="menuitem" style="list-style: outside none none;">
                            <div class="inline-flex items-center" style="list-style: outside none none;">
                                <x-icon.en class="block w-3 h-3 mr-2 align-middle rounded-full" />
                                {{ __('English') }}
                            </div>
                        </a>
                    </li>
                    <li class="text-left" style="list-style: outside none none;">
                        <a href="{{ route('locale', 'da') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 cursor-pointer hover:bg-gray-100" role="menuitem" style="list-style: outside none none;">
                            <div class="inline-flex items-center" style="list-style: outside none none;">
                                <x-icon.da class="block w-3 h-3 mr-2 align-middle rounded-full" />
                                {{ __('Danish') }}
                            </div>
                        </a>
                    </li>
                </ul>
            </x-slot>
        </x-dropdown>
    </div>


</aside>
