@extends('layouts.guest')

@section('title', $informasi->judul . ' - StuntGuard Jember')

@section('content')
    @php
        $urlFoto = $informasi->thumbnail
            ? (\Illuminate\Support\Str::startsWith($informasi->thumbnail, ['http://', 'https://'])
                ? $informasi->thumbnail : asset(ltrim($informasi->thumbnail, '/')))
            : null;
    @endphp
    <div class="sg-public-detail mx-auto max-w-[1200px] px-4 pb-16 pt-7 sm:px-6 md:px-8 lg:px-12">
    <a href="{{ route('public.informasi.index') }}" class="mb-6 inline-flex items-center gap-2 rounded-xl border border-pink-200 bg-white px-4 py-2.5 text-sm font-semibold text-pink-700 transition-colors hover:bg-pink-50">
        <span class="material-symbols-outlined text-lg">arrow_back</span> Semua Artikel
    </a>
    <article class="max-w-3xl mx-auto bg-white rounded-3xl border border-pink-100 overflow-hidden">
        <div class="sg-detail-media sg-detail-article">
            @if ($urlFoto)
                <img src="{{ $urlFoto }}" alt="{{ $informasi->judul }}" class="w-full max-h-[390px] object-cover">
            @else
                <svg class="sg-placeholder-art" aria-hidden="true" viewBox="0 0 280 180"><circle cx="140" cy="90" r="67" fill="#fffaf0" opacity=".6"/><path d="M76 43q35-7 64 15 29-22 64-15v99q-35-8-64 13-29-21-64-13z" fill="#fffdf7" stroke="#92776a" stroke-width="2"/><path d="M140 59v95M89 69l35 9m-35 8 35 9m-35 8 35 9m34-34 32-9m-32 27 32-9m-32 27 32-9" stroke="#bca594" stroke-width="3" stroke-linecap="round"/></svg>
            @endif
        </div>
        <div class="p-6 md:p-10">
            <div class="flex flex-wrap items-center gap-3 text-xs mb-4">
                <span class="bg-pink-100 text-pink-700 rounded-full px-3 py-1 font-bold">{{ $informasi->category }}</span>
                <span class="text-stone-500">{{ $informasi->created_at?->translatedFormat('d F Y') ?? '-' }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-stone-900 leading-snug">{{ $informasi->judul }}</h1>
            <p class="mt-5 text-base text-stone-600 font-medium leading-relaxed">{{ $informasi->summary }}</p>
            <hr class="border-pink-100 my-6">
            @if (filled($informasi->content))
                <div class="text-sm md:text-base text-stone-700 leading-8 whitespace-pre-line wrap-break-word">{{ $informasi->content }}</div>
            @else
                <p class="text-sm text-stone-500">Belum ada isi artikel tambahan.</p>
            @endif
        </div>
    </article>
    </div>
@endsection
