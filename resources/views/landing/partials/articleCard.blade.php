@php
    $featured = $featured ?? false;
    $urlFoto = $artikel->thumbnail
        ? (\Illuminate\Support\Str::startsWith($artikel->thumbnail, ['http://', 'https://'])
            ? $artikel->thumbnail : asset(ltrim($artikel->thumbnail, '/')))
        : null;
@endphp
<article class="sg-article-card group flex h-full flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white transition-colors hover:border-pink-300 {{ $featured ? 'sm:flex-row' : '' }}">
    <a href="{{ route('public.informasi.show', $artikel) }}" class="sg-card-media relative flex aspect-[16/9] w-full shrink-0 items-center justify-center overflow-hidden bg-pink-50 {{ $featured ? 'sm:aspect-auto sm:w-[42%] sm:min-h-[240px]' : '' }}" aria-label="Baca {{ $artikel->judul }}">
        @if ($urlFoto)
            <img class="h-full w-full object-cover" src="{{ $urlFoto }}" alt="{{ $artikel->judul }}" loading="lazy">
        @else
            <svg class="sg-placeholder-art" aria-hidden="true" viewBox="0 0 280 180"><circle cx="140" cy="90" r="67" fill="#fffaf0" opacity=".6"/><path d="M76 43q35-7 64 15 29-22 64-15v99q-35-8-64 13-29-21-64-13z" fill="#fffdf7" stroke="#92776a" stroke-width="2"/><path d="M140 59v95M89 69l35 9m-35 8 35 9m-35 8 35 9m34-34 32-9m-32 27 32-9m-32 27 32-9" stroke="#bca594" stroke-width="3" stroke-linecap="round"/></svg>
        @endif
        <span class="absolute top-3 left-3 bg-white text-pink-700 text-xs px-2.5 py-1 rounded-full font-bold border border-pink-100">
            {{ $artikel->category }}
        </span>
    </a>
    <div class="sg-card-body flex flex-1 flex-col justify-between gap-3 p-5 {{ $featured ? 'sm:p-7' : '' }}">
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
        <a href="{{ route('public.informasi.show', $artikel) }}" class="sg-card-link text-sm text-pink-700 font-semibold flex items-center gap-1 pt-2 hover:text-pink-800">
            Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        </a>
    </div>
</article>
