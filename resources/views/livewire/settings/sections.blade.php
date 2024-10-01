<aside id="settings-sidebar" class="fixed top-0 left-64 flex-col flex-shrink-0 w-64 h-full pt-16 duration-75 hidden lg:flex">
    <div class="relative flex flex-1 min-h-0 pt-0 border-r">
        <div class="flex flex-col flex-1 overflow-auto">
            <div class="flex-1 px-3 pb-16 leading-6 text-black bg-white">
                <ul class="px-0 pt-0 pb-2 m-0 text-black list-none">
                    <li class="mt-2 mb-0 text-left list-outside">
                        <p class="flex items-center p-2 text-base font-semibold text-gray-900">
                            {{ __('Settings') }}
                        </p>
                    </li>
                    <li class="mt-2 mb-0 text-left list-outside">
                        <hr class="border-t border-gray-200">
                    </li>

                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link wire:click="setSection('welding-certificates')" :active="$section == 'welding-certificates'">
                            <x-icon.welding-certificate class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('Welding Certificates') }}
                        </x-nav-link>
                    </li>
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link wire:click="setSection('wps')" :active="$section == 'wps'">
                            <x-icon.wps class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('WPS') }}
                        </x-nav-link>
                    </li>
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link wire:click="setSection('wpqr')" :active="$section == 'wpqr'">
                            <x-icon.wpqr class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('WPQR') }}
                        </x-nav-link>
                    </li>
                    @can('viewAny', App\Models\MachineMaintenance::class)
                        <li class="mt-2 mb-0 text-left list-outside">
                            <x-nav-link wire:click="setSection('maintenance')" :active="$section == 'maintenance'">
                                <x-icon.maintenance class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                {{ __('Maintenance') }}
                            </x-nav-link>
                        </li>
                    @endcan
                    @can('viewAny', App\Models\Supplier::class)
                        <li class="mt-2 mb-0 text-left list-outside">
                            <x-nav-link wire:click="setSection('supplier')" :active="$section == 'supplier'">
                                <x-icon.truck class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                {{ __('Supplier') }}
                            </x-nav-link>
                        </li>
                    @endcan

                    @can('viewAny', App\Models\Ce::class)
                        <li class="mt-2 mb-0 text-left list-outside">
                            <x-nav-link wire:click="setSection('ce')" :active="$section == 'ce'">
                                <x-icon.ce class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                                {{ __('CE') }}
                            </x-nav-link>
                        </l>
                    @endcan
                    <li class="mt-2 mb-0 text-left list-outside">
                        <x-nav-link wire:click="setSection('multiple-choice')" :active="$section == 'multiple-choice'">
                            <x-icon.adjustments-horizontal class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                            {{ __('Common Multiple Choice Fields') }}
                        </x-nav-link>
                    </l>
                </ul>
            </div>
        </div>
    </div>
</aside>
