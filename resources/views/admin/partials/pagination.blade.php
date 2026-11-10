<div class="shrink-0 border-t border-stone-100 bg-stone-50 px-4 py-3">
    <div class="flex flex-col gap-3 text-xs text-stone-600 sm:flex-row sm:items-center sm:justify-between">
        <p>Menampilkan {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }} {{ $label }}</p>
        {{ $paginator->onEachSide(1)->links('admin.partials.pagination-links', ['label' => $label]) }}
    </div>
</div>
