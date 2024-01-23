<div class="bg-white">
    <!-- make markup where we have a label with: View and then three status button: All, Inactive & Active -->
    <div class="flex items-center justify-between px-4 py-3 border-b">
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-900">View</span>
            </div>
            <div class="flex items-center space-x-2">
                <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if(optional($filters)['status'] == '') border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                    <input
                        type="radio"
                        wire:model.live="filters.status"
                        value=""
                        class="hidden"
                    />
                    <span>{{ __('All') }}</span>
                </label>
                <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if(optional($filters)['status'] == 'active') border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                    <input
                        type="radio"
                        wire:model.live="filters.status"
                        value="active"
                        class="hidden"
                    />
                    <span>{{ __('Active') }}</span>
                </label>
                <label class="flex px-2 py-1 text-sm leading-none border rounded-md cursor-pointer focus:outline-none focus:ring-4 ring-cyan-300/25 @if(optional($filters)['status'] == 'inactive') border-cyan-400 bg-slate-50 @else bg-white  border-gray-200 @endif">
                    <input
                        type="radio"
                        wire:model.live="filters.status"
                        value="inactive"
                        class="hidden"
                    />
                    <span>{{ __('Inactive') }}</span>
                </label>
            </div>
        </div>

    </div>
</div>
