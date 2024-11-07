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
                        <x-nav-link href="{{ route('wpqr.index') }}" :active="request()->routeIs('wpqr.*')">
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
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 justify-center hidden w-full p-4 leading-6 text-black bg-white lg:flex border-r">
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
