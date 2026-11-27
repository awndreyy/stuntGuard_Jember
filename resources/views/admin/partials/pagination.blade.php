<div class="flex shrink-0 flex-wrap items-center justify-between gap-3 rounded-xl border border-stone-200 bg-white px-4 py-3 text-xs text-stone-500">
    <p>Menampilkan {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }} {{ $label }}</p>
    {{ $paginator->onEachSide(1)->links('admin.partials.pagination-links', ['label' => $label]) }}
</div>
