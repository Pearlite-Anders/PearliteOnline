@if (!$document->isRoot())
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex space-x-4 rounded-md bg-white px-6 shadow">
            @foreach($document->ancestors as $ancestor)
                @if ($loop->first)
                    <li class="flex">
                        <div class="flex items-center">
                            <a href="{{ route('documents.show', ['document' => $ancestor->id]) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $ancestor->currentRevision->data["title"] }}
                            </a>
                        </div>
                    </li>
                @else
                    <li class="flex">
                        <div class="flex items-center">
                            <svg class="h-full w-6 flex-shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
                                <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                            </svg>
                            <a href="{{ route('documents.show', ['document' => $ancestor->id]) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $ancestor->currentRevision->data["title"] }}
                            </a>
                        </div>
                    </li>
                @endif
            @endforeach
            <li class="flex">
                <div class="flex items-center">
                    <svg class="h-full w-6 flex-shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <a href="{{ route('documents.show', ['document' => $document->id]) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                        {{ $document->currentRevision->data["title"] }}
                    </a>
                </div>
            </li>
        </ol>
    </nav>
@endif
