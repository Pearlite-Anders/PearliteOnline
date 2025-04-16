

<aside class="hidden px-6 pt-8 border-b border-gray-900/5 lg:block lg:w-80 lg:flex-none lg:border-0">
    <nav class="flex-none px-4 sm:px-6 lg:px-0" aria-label="Sidebar">
        <ul role="list" class="-mx-2 space-y-1">
            <li class="mb-0 text-left list-outside">
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
                </li>
            @endcan
            @can('viewAny', App\Models\Document::class)
                <li class="mt-2 mb-0 text-left list-outside">
                    <x-nav-link wire:click="setSection('document')" :active="$section == 'document'">
                        <x-icon.book class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                        {{ __('Documents') }}
                    </x-nav-link>
                </li>
            @endcan
            @can('viewAny', App\Models\TimeRegistration::class)
                <li class="mt-2 mb-0 text-left list-outside">
                    <x-nav-link wire:click="setSection('time-registration')" :active="$section == 'time-registration'">
                        <x-icon.time-registration class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                        {{ __('Time Registration') }}
                    </x-nav-link>
                </li>
            @endif
            <li class="mt-2 mb-0 text-left list-outside">
                <x-nav-link wire:click="setSection('multiple-choice')" :active="$section == 'multiple-choice'">
                    <x-icon.adjustments-horizontal class="w-5 h-5 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
                    {{ __('Common Multiple Choice Fields') }}
                </x-nav-link>
            </li>
        </ul>
    </nav>
</aside>
