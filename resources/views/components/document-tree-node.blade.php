@props(['document', 'leftPadding' => 3, 'currentId'])

@if (auth()->user()->can('view', $document))
    <li>
        <a
            href="{{ route('documents.show', ['document' => $document->id]) }}"
            wire:navigate
            @if ($document->id == $currentId)
                class="group flex gap-x-3 rounded-lg p-2 pl-{{ $leftPadding }} text-sm font-semibold leading-6 text-gray-900 bg-cyan-50"
            @else
                class="group flex gap-x-3 rounded-lg p-2 pl-{{ $leftPadding }} text-sm font-normal leading-6 text-gray-900 hover:bg-cyan-50"
            @endif
        >
            {{ $document->currentRevision->data['title'] }}
        </a>
    </li>
    @if ($document->children->isNotEmpty())
        @foreach ($document->children as $child)
            <x-document-tree-node :document="$child" :left-padding="(int)$leftPadding + 3" :current-id="$currentId" />
        @endforeach
    @endif
@endif
