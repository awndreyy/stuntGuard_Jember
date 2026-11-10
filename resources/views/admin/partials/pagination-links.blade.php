<nav role="navigation" aria-label="Halaman {{ $label ?? 'data' }}" class="flex flex-wrap items-center gap-1">
    @if ($paginator->onFirstPage())
        <span aria-disabled="true" class="inline-flex min-h-11 items-center rounded-xl border border-stone-200 px-3 text-stone-400">Sebelumnya</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex min-h-11 items-center rounded-xl border border-stone-200 bg-white px-3 hover:bg-pink-50 focus-visible:outline-2 focus-visible:outline-pink-700">Sebelumnya</a>
    @endif
    @if ($paginator->hasPages())
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="hidden px-2 sm:inline">{{ $element }}</span>
            @else
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="hidden min-h-11 min-w-11 items-center justify-center rounded-xl bg-brand px-3 text-white sm:inline-flex">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" aria-label="Halaman {{ $page }}" class="hidden min-h-11 min-w-11 items-center justify-center rounded-xl border border-stone-200 bg-white px-3 hover:bg-pink-50 focus-visible:outline-2 focus-visible:outline-pink-700 sm:inline-flex">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
    <span class="px-2 sm:hidden">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex min-h-11 items-center rounded-xl border border-stone-200 bg-white px-3 hover:bg-pink-50 focus-visible:outline-2 focus-visible:outline-pink-700">Selanjutnya</a>
    @else
        <span aria-disabled="true" class="inline-flex min-h-11 items-center rounded-xl border border-stone-200 px-3 text-stone-400">Selanjutnya</span>
    @endif
</nav>
