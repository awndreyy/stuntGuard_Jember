@php
    $featured = $featured ?? false;
    $urlFoto = $artikel->thumbnail
        ? (\Illuminate\Support\Str::startsWith($artikel->thumbnail, ['http://', 'https://'])
            ? $artikel->thumbnail : asset(ltrim($artikel->thumbnail, '/')))
        : null;
@endphp
<article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white transition-colors hover:border-pink-300 {{ $featured ? 'sm:flex-row' : '' }}">
    <a href="{{ route('public.informasi.show', $artikel) }}" class="relative flex aspect-[16/9] w-full shrink-0 items-center justify-center overflow-hidden bg-pink-50 {{ $featured ? 'sm:aspect-auto sm:w-[42%] sm:min-h-[240px]' : '' }}" aria-label="Baca {{ $artikel->judul }}">
        @if ($urlFoto)
            <img class="h-full w-full object-cover" src="{{ $urlFoto }}" alt="{{ $artikel->judul }}" loading="lazy">
        @else
            <span class="material-symbols-outlined text-6xl text-pink-200">article</span>
        @endif
        <span class="absolute top-3 left-3 bg-white text-pink-700 text-xs px-2.5 py-1 rounded-full font-bold border border-pink-100">
            {{ $artikel->category }}
        </span>
    </a>
    <div class="flex flex-1 flex-col justify-between gap-3 p-5 {{ $featured ? 'sm:p-7' : '' }}">
        <div>
            <p class="flex items-center gap-1 text-xs text-stone-600 mb-2">
                <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                {{ $artikel->created_at?->translatedFormat('d M Y') ?? '-' }}
            </p>
            <h3 class="text-lg font-bold text-stone-900 group-hover:text-pink-700 transition-colors leading-snug line-clamp-2">
                <a href="{{ route('public.informasi.show', $artikel) }}">{{ $artikel->judul }}</a>
            </h3>
            <p class="text-sm leading-relaxed text-stone-600 mt-2 line-clamp-3">{{ $artikel->summary }}</p>
        </div>
        <a href="{{ route('public.informasi.show', $artikel) }}" class="text-sm text-pink-700 font-semibold flex items-center gap-1 pt-2 hover:text-pink-800">
            Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        </a>
    </div>
</article>
