<div>
    @if ($tasks->count() > 0)
        <span class="flex rounded-full bg-red-500 text-white text-xs h-5 w-5 items-center justify-center">
            @if ($tasks->count() > 9)
                9+
            @else
                {{ $tasks->count() }}
            @endif
        </span>
    @endif
</div>
