<a class="" href="{{ route('supplier.edit', ['supplier' => $task->id]) }}" wire:navigate>
    <div class="px-4 py-3 sm:px-6 sm:py-4">
        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 mb-3">Supplier</span>
        <p>{{ __('Its time for assesment of') }}: {{ $task->data['name'] }}</p>
    </div>
</a>
