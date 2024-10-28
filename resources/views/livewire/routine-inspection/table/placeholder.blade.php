<div>
    <div class="flex flex-col leading-6 text-black">
        <div class="overflow-x-auto">
            <x-table>
                <x-slot name="head">

                    <x-table.heading>&nbsp;</x-table.heading>
                    <x-table.heading>&nbsp;</x-table.heading>
                    <x-table.heading>&nbsp;</x-table.heading>
                    <x-table.heading>&nbsp;</x-table.heading>

                </x-slot>
                <x-slot name="body">
                    <x-table.row
                        :can_edit="false"
                        class="cursor-pointer hover:bg-gray-50"
                    >
                        <x-table.cell>&nbsp;</x-table.cell>
                        <x-table.cell>&nbsp;</x-table.cell>
                        <x-table.cell>&nbsp;</x-table.cell>

                        <x-table.cell class="text-right">
                            <div class="flex justify-end">

                                <x-button
                                    class="text-gray-600 bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                >
                                    <x-icon.pencil class="w-4 h-4 text-gray-800" />
                                </x-button>
                                <x-button
                                    class="bg-transparent hover:bg-gray-100 hover:text-gray-900"
                                >
                                    <x-icon.trash class="w-4 h-4 text-red-600" />
                                </x-button>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                </x-slot>
            </x-table>
        </div>
    </div>
</div>
