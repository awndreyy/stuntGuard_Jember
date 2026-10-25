@php
    $urlFoto = $artikel->thumbnail
        ? (\Illuminate\Support\Str::startsWith($artikel->thumbnail, ['http://', 'https://'])
            ? $artikel->thumbnail : asset(ltrim($artikel->thumbnail, '/')))
        : null;
@endphp
<article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all flex flex-col group border border-pink-100">
    <a href="{{ route('public.informasi.show', $artikel) }}" class="relative h-44 w-full overflow-hidden bg-pink-50 flex items-center justify-center" aria-label="Baca {{ $artikel->judul }}">
        @if ($urlFoto)
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $urlFoto }}" alt="{{ $artikel->judul }}" loading="lazy">
        @else
            <span class="material-symbols-outlined text-6xl text-pink-200">article</span>
        @endif
        <span class="absolute top-3 left-3 bg-white/95 text-pink-700 text-xs px-2.5 py-1 rounded-full font-bold shadow-sm">
            {{ $artikel->category }}
        </span>
    </a>
    <div class="p-4 flex flex-col flex-1 justify-between gap-2">
        <div>
            <p class="flex items-center gap-1 text-xs text-stone-500 mb-2">
                <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                {{ $artikel->created_at?->translatedFormat('d M Y') ?? '-' }}
            </p>
            <h3 class="text-base font-bold text-stone-900 group-hover:text-pink-600 transition-colors leading-snug line-clamp-3">
                <a href="{{ route('public.informasi.show', $artikel) }}">{{ $artikel->judul }}</a>
            </h3>
            <p class="text-xs text-stone-600 mt-2 line-clamp-3">{{ $artikel->summary }}</p>
        </div>
        <a href="{{ route('public.informasi.show', $artikel) }}" class="text-xs text-pink-600 font-semibold flex items-center gap-1 pt-2 hover:underline">
            Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        </a>
    </div>
</article>
