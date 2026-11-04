@php
    $urlFoto = $resep->gambar
        ? asset(ltrim($resep->gambar, '/'))
        : null;
@endphp

<article class="sg-recipe-card group flex h-full flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white transition-colors hover:border-pink-300 focus-within:border-pink-400">
    <a href="{{ route('public.resep.show', $resep) }}"
       class="sg-card-media relative block aspect-square sm:aspect-[16/9] w-full overflow-hidden bg-pink-50"
       aria-label="Lihat resep {{ $resep->nama_resep }}">
        @if ($urlFoto)
            <img src="{{ $urlFoto }}" alt="{{ $resep->nama_resep }}" loading="lazy"
                 class="h-full w-full object-cover">
        @else
            <svg class="sg-placeholder-art" aria-hidden="true" viewBox="0 0 280 180"><ellipse cx="140" cy="151" rx="85" ry="11" fill="#695440" opacity=".1"/><path d="M56 78q8 74 84 74t84-74" fill="#b86272"/><ellipse cx="140" cy="78" rx="84" ry="29" fill="#fffaf0"/><ellipse cx="140" cy="79" rx="70" ry="22" fill="#e3bb78"/><path d="M101 76l15-9 11 13-15 8zm47-11 19 5-5 15-17-4z" fill="#c67a47"/><path d="M126 67l6-9 9 8-6 9m41 8 7-9 9 8-8 7" fill="#698752"/><path d="m203 63 27-37" stroke="#958271" stroke-width="8" stroke-linecap="round"/><path d="M88 105q14 26 39 29" stroke="#fff" stroke-width="4" fill="none" opacity=".6"/></svg>
        @endif
        <span class="absolute left-3 top-3 rounded-full border border-pink-100 bg-white px-3 py-1.5 text-xs font-bold text-pink-700">
            {{ $resep->kategori_usia }} bulan
        </span>
    </a>

    <div class="sg-card-body flex flex-1 flex-col p-5">
        <div>
            <p class="mb-2 flex items-center gap-1.5 text-xs font-bold uppercase tracking-wide text-pink-700">
                <span class="material-symbols-outlined text-[16px]" aria-hidden="true">nutrition</span>
                Resep MPASI
            </p>
            <h3 class="line-clamp-2 text-lg font-bold leading-snug text-stone-900">
                <a href="{{ route('public.resep.show', $resep) }}" class="transition-colors hover:text-pink-700">
                    {{ $resep->nama_resep }}
                </a>
            </h3>
            <p class="mt-2 text-sm leading-relaxed text-stone-600">
                {{ count($resep->bahan ?? []) }} bahan <span class="px-1 text-stone-400">·</span> {{ count($resep->cara_pembuatan ?? []) }} langkah pembuatan
            </p>
        </div>

        <div class="sg-card-nutrition mt-4 grid grid-cols-2 gap-3 rounded-xl border border-pink-100 bg-pink-50 p-3">
            <div>
                <p class="text-sm font-medium text-stone-600">Energi / resep</p>
                <p class="mt-1 text-base font-extrabold text-stone-900">{{ number_format($resep->kalori ?? 0, 0, ',', '.') }} <span class="text-sm font-medium text-stone-600">kkal</span></p>
            </div>
            <div class="border-l border-pink-200 pl-3">
                <p class="text-sm font-medium text-stone-600">Protein / resep</p>
                <p class="mt-1 text-base font-extrabold text-stone-900">{{ $resep->protein ?? 0 }} <span class="text-sm font-medium text-stone-600">g</span></p>
            </div>
        </div>

        <div class="mt-auto pt-4">
            <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm font-medium text-stone-600">
                <span class="inline-flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px] text-pink-700" aria-hidden="true">schedule</span>
                    {{ $resep->waktu_memasak }} menit
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px] text-pink-700" aria-hidden="true">restaurant</span>
                    {{ $resep->porsi }} porsi
                </span>
            </div>
            <div class="mt-4 border-t border-stone-100 pt-4">
                <a href="{{ route('public.resep.show', $resep) }}"
                   class="inline-flex items-center gap-1.5 text-sm font-bold text-pink-700 transition-colors hover:text-pink-800 focus-visible:rounded focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-pink-600">
                    Lihat detail resep
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</article>
