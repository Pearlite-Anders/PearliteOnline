@props([
    'file',
    'svg_location' => 'top'
])

<div x-data="{ open: false }" class="inline-flex">
    @if($svg_location == 'left')
        <div
            class="inline-flex items-center text-sm cursor-pointer"
            @click="open = true"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            {{ $file->name }}
        </div>
    @else
        <div
            class="inline-flex flex-col items-center text-sm cursor-pointer"
            @click="open = true"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            {{ $file->name }}
        </div>
    @endif

    <!-- Modal -->
    <div
        x-show="open"
        style="display: none"
        x-on:keydown.escape.prevent.stop="open = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-50 overflow-y-auto"
    >
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Panel -->
        <div
            x-show="open" x-transition
            x-on:click="open = false"
            class="relative flex items-center justify-center min-h-screen p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="open"
                class="relative w-full max-w-2xl p-12 overflow-y-auto bg-white shadow-lg rounded-xl"
            >
                @if($file->isPDF())
                    <iframe
                        src="{{ $file->temporary_url() }}"
                        frameborder="0"
                        class="w-full aspect-[1/1.4]"
                    ></iframe>
                    <iframe
                        src="{{ $file->temporary_url() }}"
                        frameborder="0"
                        class="w-full aspect-[1/1.4]"
                    ></iframe>
                @elseif($file->isImage())
                    <img src="{{ $file->temporary_url() }}" alt="{{ $file->name }}" />
                @endif
            </div>
        </div>
    </div>
</div>
