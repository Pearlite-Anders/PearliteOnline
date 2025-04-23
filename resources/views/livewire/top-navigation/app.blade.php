<nav x-data="{ open: false }" class="fixed z-30 w-full bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block w-auto h-9" />
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if(auth()->user()->isPartner() || auth()->user()->isAdmin())
                    <!-- Show users current company and a dropdown for them to switch -->
                    <div class="relative ml-3">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300">
                                        @if(auth()->user()->currentCompany)
                                            {{ auth()->user()->currentCompany->data['name'] }}
                                        @else
                                            {{ __('Select company') }}
                                        @endif

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                @foreach(auth()->user()->companies as $company)
                                    <x-dropdown-link href="{{ route('switch-company', $company) }}">
                                        {{ $company->data['name'] }}
                                    </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Show users current company name as pill -->
                    @if(auth()->user()->currentCompany)
                        <span class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300">
                            {{ auth()->user()->currentCompany->data['name'] }}
                        </span>
                    @endif
                @endif

                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Lang::locale() == 'en')
                                <x-dropdown-link href="{{ route('locale', 'da') }}">
                                    <div class="flex items-center w-full justify-between">
                                        {{ __('Switch to Danish') }}
                                        <x-icon.da class="block w-3 h-3 mr-2 align-middle rounded-full" />
                                    </div>

                                </x-dropdown-link>
                            @else
                                <x-dropdown-link href="{{ route('locale', 'en') }}">
                                    <div class="flex items-center w-full justify-between">
                                        {{ __('Switch to English') }}
                                        <x-icon.en class="block w-3 h-3 mr-2 align-middle rounded-full" />
                                    </div>
                                </x-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            @can('access-backoffice')
                                <div class="border-t border-gray-200"></div>

                                <x-dropdown-link href="{{ route('backoffice.dashboard') }}">
                                    {{ __('Backoffice') }}
                                </x-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <hr class="border-t border-gray-200">
            @can('viewAny', App\Models\WeldingCertificate::class)
                <x-responsive-nav-link href="{{ route('welding-certificates.index') }}" :active="request()->routeIs('welding-certificates.*')">
                    {{ __('Welding Certificates') }}
                </x-responsive-nav-link>
            @endcan
            @can('viewAny', App\Models\Wps::class)
                <x-responsive-nav-link href="{{ route('wps.index') }}" :active="request()->routeIs('wps.*')">
                    {{ __('WPS') }}
                </x-responsive-nav-link>
            @endcan
            @can('viewAny', App\Models\Wpqr::class)
                <x-responsive-nav-link href="{{ route('wpqr.index') }}" :active="request()->routeIs('wpqr.*')">
                    {{ __('WPQR') }}
                </x-responsive-nav-link>
            @endcan
            @can('viewAny', App\Models\WeldingCoordination::class)
                <x-responsive-nav-link href="{{ route('welding-coordination.index') }}" :active="request()->routeIs('welding-coordination.*')">
                    {{ __('Welding Coordination') }}
                </x-responsive-nav-link>
            @endcan
            @if(
                auth()->user()->can('viewAny', App\Models\WeldingCertificate::class) ||
                auth()->user()->can('viewAny', App\Models\Wps::class) ||
                auth()->user()->can('viewAny', App\Models\Wpqr::class) ||
                auth()->user()->can('viewAny', App\Models\WeldingCoordination::class)
            )
                <hr class="border-t border-gray-200">
            @endif
            @can('viewAny', App\Models\MachineMaintenance::class)
                <x-responsive-nav-link href="{{ route('machine-maintenance.index') }}" :active="request()->routeIs('machine-maintenance.*')">
                    {{ __('Machine Maintenance') }}
                </x-responsive-nav-link>
            @endcan
            @can('viewAny', App\Models\Supplier::class)
                <x-responsive-nav-link href="{{ route('supplier.index') }}" :active="request()->routeIs('supplier.*')" class="flex">
                    <div class="flex-1 flex items-center">
                        {{ __('Suppliers') }}
                    </div>
                    <div class="flex-0 flex items-center">
                        <x-sidebar-entry-notifications module="{{ App\Enums\Module::Supplier->value }}" />
                    </div>
                </x-responsive-nav-link>
            @endcan
            @if(
                auth()->user()->can('viewAny', App\Models\MachineMaintenance::class) ||
                auth()->user()->can('viewAny', App\Models\Supplier::class)
            )
                <hr class="border-t border-gray-200">
            @endif
            @can('viewAny', App\Models\Project::class)
                <x-responsive-nav-link href="{{ route('project.index') }}" :active="request()->routeIs('project.*')">
                    {{ __('Projects') }}
                </x-responsive-nav-link>
                <hr class="border-t border-gray-200">
            @endcan
            @can('viewAny', App\Models\Ce::class)
                <x-responsive-nav-link href="{{ route('ce.index') }}" :active="request()->routeIs('ce.*')">
                    {{ __('CE') }}
                </x-responsive-nav-link>
                <hr class="border-t border-gray-200">
            @endcan

            @can('viewAny', App\Models\Formula::class)
                <div
                    class="mt-2 mb-0 text-left list-outside"
                    x-data="{ open: {{ request()->routeIs('formulas.*') ? 'true' : 'false'}} }"
                >
                    <button
                        @click="open = !open"
                        type="button"
                        class="flex items-center w-full py-2 pl-3 pr-4 text-base font-normal text-gray-900 border-l-4 border-transparent rounded-lg cursor-pointer hover:bg-cyan-50"
                    >
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
                </div>
                <hr class="border-t border-gray-200">
            @endcan

            @can('viewAny', App\Models\User::class)
                <x-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @endcan

            @can('viewAny', App\Models\Welder::class)
                <x-responsive-nav-link href="{{ route('welder.index') }}" :active="request()->routeIs('welder.*')">
                    {{ __('Welders') }}
                </x-responsive-nav-link>
            @endcan




        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="mr-3 shrink-0">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
