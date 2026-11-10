<nav role="navigation" aria-label="Halaman {{ $label ?? 'data' }}" class="flex flex-wrap items-center gap-1">
    @if ($paginator->onFirstPage())
        <span aria-disabled="true" class="inline-flex h-9 items-center rounded-lg border border-stone-200 px-3 text-stone-400 opacity-60">Sebelumnya</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex h-9 items-center rounded-lg border border-stone-200 bg-white px-3 hover:bg-rose-50 hover:text-rose-700">Sebelumnya</a>
    @endif

    @if (!$paginator->hasPages())
        <span aria-current="page" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg bg-rose-700 px-2 font-semibold text-white">1</span>
    @else
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-1 text-stone-400">{{ $element }}</span>
            @else
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg bg-rose-700 px-2 font-semibold text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" aria-label="Halaman {{ $page }}" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-stone-200 bg-white px-2 hover:bg-rose-50 hover:text-rose-700">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex h-9 items-center rounded-lg border border-stone-200 bg-white px-3 hover:bg-rose-50 hover:text-rose-700">Selanjutnya</a>
    @else
        <span aria-disabled="true" class="inline-flex h-9 items-center rounded-lg border border-stone-200 px-3 text-stone-400 opacity-60">Selanjutnya</span>
    @endif
</nav>
