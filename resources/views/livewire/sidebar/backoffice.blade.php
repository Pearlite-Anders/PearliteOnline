<aside id="sidebar" class="fixed top-0 left-0 flex-col flex-shrink-0 hidden w-64 h-full pt-16 duration-75 md:flex">
    <div class="relative flex flex-1 min-h-0 pt-0 border-r">
        <div class="flex flex-col flex-1 overflow-auto">
            <div class="flex-1 px-3 pb-16 leading-6 text-black bg-white">

                <ul class="px-0 pt-0 pb-2 m-0 text-black list-none">
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link href="{{ route('backoffice.dashboard') }}" :active="request()->routeIs('backoffice.dashboard')">
                            <x-icon.home class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </li>
                    <li class="mt-2 mb-0 text-left list-outside">
                        <hr class="border-t border-gray-200">
                    </li>
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link href="{{ route('backoffice.wps.index') }}" :active="request()->routeIs('backoffice.wps.*')">
                            <x-icon.wps class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('WPS') }}
                        </x-nav-link>
                    </li>
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link href="{{ route('backoffice.wpqr.index') }}" :active="request()->routeIs('backoffice.wpqr.*')">
                            <x-icon.wpqr class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('WPQR') }}
                        </x-nav-link>
                    </li>
                </ul>

                @if(
                    auth()->user()->can('viewAny', App\Models\TimeRegistration::class) ||
                    auth()->user()->can('viewAny', App\Models\TimeRegistration::class)
                )
                    <ul class="px-0 pt-0 pb-2 m-0 text-black list-none border-t">
                        @can('viewAny', App\Models\TimeRegistration::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('backoffice.time-registration.index') }}" :active="request()->routeIs('backoffice.time-registration.*')">
                                    <x-icon.time-registration class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Time registration') }}
                                </x-nav-link>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\TimeRegistration::class)
                            <li class="mt-2 mb-0 text-left list-outside">
                                <x-nav-link href="{{ route('backoffice.internal-order.index') }}" :active="request()->routeIs('backoffice.internal-order.*')">
                                    <x-icon.order class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                    {{ __('Order') }}
                                </x-nav-link>
                            </li>
                        @endcan
                    </ul>
                @endif

                <ul class="px-0 pt-0 pb-2 m-0 text-black list-none border-t">
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link href="{{ route('backoffice.companies.index') }}" :active="request()->routeIs('backoffice.companies.*')">
                            <x-icon.companies class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('Companies') }}
                        </x-nav-link>
                    </li>

                    @if(Auth::user()->isAdmin())
                        <li class="mt-2 mb-0 text-left list-outside">
                            <x-nav-link href="{{ route('backoffice.system-users.index') }}" :active="request()->routeIs('backoffice.system-users.*')">
                                <x-icon.users class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                {{ __('System users') }}
                            </x-nav-link>
                        </li>
                    @endif
                </ul>

                <ul class="px-0 pt-0 pb-2 m-0 text-black list-none border-t">
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link href="{{ route('backoffice.settings') }}" :active="request()->routeIs('backoffice.settings')">
                            <x-icon.settings class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('Settings') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 justify-center hidden w-full p-4 leading-6 text-black bg-white lg:flex border-r">

    </div>


</aside>
