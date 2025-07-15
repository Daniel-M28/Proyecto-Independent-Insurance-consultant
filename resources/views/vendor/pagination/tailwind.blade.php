@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6">
        <ul class="inline-flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 bg-zinc-700 text-gray-400 border border-zinc-600 rounded-md cursor-not-allowed">
                         Anterior
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-4 py-2 bg-blue-600 text-white border border-zinc-600 rounded-md hover:bg-blue-700">
                         Anterior
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li>
                        <span class="px-4 py-2 bg-zinc-700 text-gray-400 border border-zinc-600 rounded-md">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-4 py-2 bg-blue-600 text-white border border-zinc-600 rounded-md font-semibold">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-4 py-2 bg-zinc-800 text-gray-300 border border-zinc-600 rounded-md hover:bg-blue-600 hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-4 py-2 bg-blue-600 text-white border border-zinc-600 rounded-md hover:bg-blue-700">
                        Siguiente 
                    </a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 bg-zinc-700 text-gray-400 border border-zinc-600 rounded-md cursor-not-allowed">
                         
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
