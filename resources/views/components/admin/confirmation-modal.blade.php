<dialog id="confirmationModal" aria-labelledby="confirmationTitle" aria-describedby="confirmationMessage"
    class="m-auto max-h-[calc(100dvh-2rem)] w-[calc(100%-2rem)] max-w-sm overflow-y-auto rounded-3xl border border-rose-100 bg-white p-0 text-stone-800 shadow-xl backdrop:bg-stone-950/45">
    <div class="p-6 sm:p-7 text-center">
        <div class="mx-auto mb-5 flex size-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600" aria-hidden="true">
            <svg data-confirm-icon="delete" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 6h18M9 6V4h6v2M5 6l1 14h12l1-14M10 10v6M14 10v6" />
            </svg>
            <svg data-confirm-icon="logout" class="hidden size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" />
            </svg>
        </div>
        <h2 id="confirmationTitle" class="text-xl font-bold tracking-tight text-stone-900">Hapus data?</h2>
        <p id="confirmationMessage" class="mt-2 break-words text-sm leading-relaxed text-stone-600"></p>
        <div class="mt-6 grid grid-cols-2 gap-3">
            <button type="button" data-confirm-cancel autofocus
                class="min-h-11 cursor-pointer rounded-xl border-stone-50 px-4 py-3 text-sm font-semibold text-stone-700 transition-colors hover:bg-rose-50 hover:text-rose-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600">Batal</button>
            <button type="button" data-confirm-accept
                class="min-h-11 cursor-pointer rounded-xl bg-rose-800 px-4 py-3 text-sm font-semibold text-white transition-colors hover:bg-rose-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-800 disabled:cursor-wait disabled:opacity-60">Ya, Hapus</button>
        </div>
    </div>
</dialog>
