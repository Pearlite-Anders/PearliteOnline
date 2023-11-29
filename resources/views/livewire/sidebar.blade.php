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
                    <svg class="block w-5 h-5 mt-px text-gray-500 align-middle rounded-full" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <ul class="px-0 py-1 m-0 text-black" role="none" style="list-style: none;">
                    <li class="text-left" style="list-style: outside none none;">
                        <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 cursor-pointer hover:bg-gray-100" role="menuitem" style="list-style: outside none none;">
                            <div class="inline-flex items-center" style="list-style: outside none none;">
                            <!-- https://iconbuddy.app/circle-flags -->
                            <svg class="block w-3 h-3 mr-2 align-middle rounded-full" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>
                                English
                            </div>
                        </a>
                    </li>
                    <li class="text-left" style="list-style: outside none none;">
                        <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 cursor-pointer hover:bg-gray-100" role="menuitem" style="list-style: outside none none;">
                            <div class="inline-flex items-center" style="list-style: outside none none;">
                                <svg class="block w-3 h-3 mr-2 align-middle rounded-full" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#d80027" d="M0 0h133.6l32.7 20.3 34-20.3H512v222.6L491.4 256l20.6 33.4V512H200.3l-31.7-20.4-35 20.4H0V289.4l29.4-33L0 222.7z"/><path fill="#eee" d="M133.6 0v222.6H0v66.8h133.6V512h66.7V289.4H512v-66.8H200.3V0h-66.7z"/></g></svg>
                                Danish
                            </div>
                        </a>
                    </li>
                </ul>
            </x-slot>
        </x-dropdown>
    </div>


</aside>
