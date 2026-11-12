@php
    $featured = $featured ?? false;
    $urlFoto = $artikel->thumbnail
        ? (\Illuminate\Support\Str::startsWith($artikel->thumbnail, ['http://', 'https://'])
            ? $artikel->thumbnail : asset(ltrim($artikel->thumbnail, '/')))
        : null;
@endphp

<article class="sg-article-card group flex h-full flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white transition-colors hover:border-pink-300 focus-within:border-pink-400 {{ $featured ? 'sm:flex-row' : '' }}">
    <a href="{{ route('public.informasi.show', $artikel) }}"
       class="sg-card-media relative block aspect-square sm:aspect-[16/9] w-full overflow-hidden bg-pink-50 {{ $featured ? 'sm:aspect-auto sm:w-[42%] sm:min-h-[240px]' : '' }}"
       aria-label="Baca {{ $artikel->judul }}">
        @if ($urlFoto)
            <img class="h-full w-full object-cover" src="{{ $urlFoto }}" alt="{{ $artikel->judul }}" loading="lazy">
        @else
            <svg class="sg-placeholder-art" aria-hidden="true" viewBox="0 0 280 180"><circle cx="140" cy="90" r="67" fill="#fffaf0" opacity=".6"/><path d="M76 43q35-7 64 15 29-22 64-15v99q-35-8-64 13-29-21-64-13z" fill="#fffdf7" stroke="#92776a" stroke-width="2"/><path d="M140 59v95M89 69l35 9m-35 8 35 9m-35 8 35 9m34-34 32-9m-32 27 32-9m-32 27 32-9" stroke="#bca594" stroke-width="3" stroke-linecap="round"/></svg>
        @endif
        <span class="absolute left-3 top-3 rounded-full border border-pink-100 bg-white px-3 py-1.5 text-xs font-bold text-pink-700">
            {{ $artikel->category }}
        </span>
    </a>

    <div class="sg-card-body flex flex-1 flex-col p-5 {{ $featured ? 'sm:p-7' : '' }}">
        <div>
            <p class="mb-2 flex items-center gap-1.5 text-xs font-bold uppercase tracking-wide text-pink-700">
                <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                {{ $artikel->created_at?->translatedFormat('d M Y') ?? '-' }}
            </p>
            <h3 class="line-clamp-2 text-lg font-bold leading-snug text-stone-900">
                <a href="{{ route('public.informasi.show', $artikel) }}" class="transition-colors hover:text-pink-700">
                    {{ $artikel->judul }}
                </a>
            </h3>
            <p class="mt-2 text-sm leading-relaxed text-stone-600 line-clamp-3">{{ $artikel->summary }}</p>
        </div>

        <div class="mt-auto pt-4">
            <div class="border-t border-stone-100 pt-4">
                <a href="{{ route('public.informasi.show', $artikel) }}"
                   class="inline-flex items-center gap-1.5 text-sm font-bold text-pink-700 transition-colors hover:text-pink-800 focus-visible:rounded focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-pink-600">
                    Baca Selengkapnya
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</article>
