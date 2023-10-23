<div>
    <!-- listen for escape with a alpinejs block -->
    <div x-data @keydown.escape.window="$wire.cancelConfirmDelete"></div>

    <div class="items-center justify-between block p-4 bg-white border-t-0 border-b border-gray-200 border-solid sm:flex border-x-0">
      <div class="w-full mb-1 text-black">
        <div class="my-2 md:my-4">
          <h1 class="flex items-center m-0 text-xl font-semibold leading-7 text-gray-900 sm:text-2xl sm:leading-8">
            <x-icon.welding-certificate class="w-6 h-6 mr-2 text-gray-500 align-middle duration-75 ease-in-out" />
            {{ __('Welding Certificates') }}
          </h1>
        </div>
        <div class="sm:flex">
          <div class="items-center hidden mb-3 sm:mb-0 sm:flex">

          </div>
          <div class="flex items-center ml-auto">
            @can('create', App\Models\WeldingCertificate::class)
                <x-button.link href="{{ route('welding-certificates.create') }}" class="inline-flex items-center justify-center">
                    <x-icon.plus class="mr-2 -ml-1 align-middle" />
                    {{ __('Add Welding Certificate') }}
                </x-button.link>
            @endcan
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <div class="overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable>{{ __('Number') }}</x-table.heading>
                        <x-table.heading />
                    </x-slot>
                    <x-slot name="body">
                        @foreach($weldingCertificates as $weldingCertificate)
                            <x-table.row>
                                <x-table.cell>{{ $weldingCertificate->number }}</x-table.cell>

                                <x-table.cell class="text-right">
                                    @can('update', $weldingCertificate)
                                        <x-button.link
                                            href="{{ route('welding-certificates.edit', $weldingCertificate) }}"
                                            class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            <x-icon.pencil class="w-4 h-4 text-gray-600" />
                                        </x-button.link>
                                    @endcan

                                    @can('delete', $weldingCertificate)
                                        @if($confirming == $weldingCertificate->id)
                                            <x-button
                                                wire:click="delete({{ $weldingCertificate->id }})"
                                                class="bg-red-700 hover:bg-red-800"
                                            >
                                                <x-icon.check class="w-4 h-4 text-white" />
                                            </x-button>
                                            <x-button
                                                wire:click="cancelConfirmDelete"
                                                class="bg-cyan-600 hover:bg-cyan-700"
                                            >
                                                <x-icon.x class="w-4 h-4 text-white" />
                                            </x-button>
                                        @else
                                            <x-button
                                                wire:click="confirmDelete({{ $weldingCertificate->id }})"
                                                class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                            >
                                                <x-icon.trash class="w-4 h-4 text-red-600" />
                                            </x-button>
                                        @endif
                                    @endcan
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
            @if ($weldingCertificates->hasPages())
                <div class="px-6 py-4 bg-white border-t">
                    {{ $weldingCertificates->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
