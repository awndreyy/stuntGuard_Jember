@php
    $urlFoto = $resep->gambar
        ? (\Illuminate\Support\Str::startsWith($resep->gambar, ['http://', 'https://'])
            ? $resep->gambar : asset(ltrim($resep->gambar, '/')))
        : null;
@endphp
<article class="bg-white rounded-3xl overflow-hidden hover:shadow-xs transition-all flex flex-col border border-pink-100">
    <a href="{{ route('public.resep.show', $resep) }}" class="relative h-52 w-full bg-pink-50 flex items-center justify-center overflow-hidden" aria-label="Lihat resep {{ $resep->nama_resep }}">
        @if ($urlFoto)
            <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" src="{{ $urlFoto }}" alt="{{ $resep->nama_resep }}" loading="lazy">
        @else
            <span class="material-symbols-outlined text-6xl text-pink-200">restaurant</span>
        @endif
        <span class="absolute top-3 left-3 bg-white/95 text-pink-600 text-xs px-3 py-1 rounded-full font-bold shadow-sm">
            {{ $resep->kategori_usia }} Bulan
        </span>
    </a>
    <div class="p-4 sm:p-6 flex flex-col flex-1 justify-between gap-4">
        <div>
            <div class="flex items-center gap-1 text-xs text-pink-700 font-bold mb-2">
                <span class="material-symbols-outlined text-[16px]">nutrition</span>
                <span>Informasi Gizi per Resep</span>
            </div>
            <h3 class="text-base font-bold text-stone-900 line-clamp-2">
                <a href="{{ route('public.resep.show', $resep) }}" class="hover:text-pink-600">{{ $resep->nama_resep }}</a>
            </h3>
            <p class="text-xs text-stone-600 mt-2">
                {{ count($resep->bahan ?? []) }} bahan · {{ count($resep->cara_pembuatan ?? []) }} langkah pembuatan
            </p>
        </div>
        <div>
            <div class="flex flex-wrap gap-1.5 py-1">
                <span class="bg-pink-100/60 text-pink-900 text-xs px-2.5 py-0.5 rounded-full">{{ number_format($resep->kalori ?? 0, 0, ',', '.') }} kkal</span>
                <span class="bg-pink-100 text-stone-600 text-xs px-2.5 py-0.5 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">timer</span> {{ $resep->waktu_memasak }} Menit
                </span>
                <span class="bg-pink-100 text-pink-700 text-xs px-2.5 py-0.5 rounded-full">{{ $resep->porsi }} Porsi</span>
            </div>
            <div class="flex items-center justify-between pt-3 mt-2 border-t border-pink-200/30">
                <span class="text-xs text-stone-600">Protein: {{ $resep->protein ?? 0 }} g</span>
                <a class="text-pink-600 text-xs font-bold hover:text-pink-800 flex items-center gap-0.5" href="{{ route('public.resep.show', $resep) }}">
                    Buka Resep <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</article>
