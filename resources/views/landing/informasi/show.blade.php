@extends('layouts.guest')

@section('title', $informasi->judul . ' - StunGuard Jember')

@section('content')
    @php
        $urlFoto = $informasi->thumbnail
            ? (\Illuminate\Support\Str::startsWith($informasi->thumbnail, ['http://', 'https://'])
                ? $informasi->thumbnail : asset(ltrim($informasi->thumbnail, '/')))
            : null;
    @endphp
    <a href="{{ route('public.informasi.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-rose-700 hover:underline mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span> Semua Artikel
    </a>
    <article class="max-w-3xl mx-auto bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden">
        @if ($urlFoto)
            <img src="{{ $urlFoto }}" alt="{{ $informasi->judul }}" class="w-full max-h-[390px] object-cover">
        @endif
        <div class="p-6 md:p-10">
            <div class="flex flex-wrap items-center gap-3 text-xs mb-4">
                <span class="bg-rose-100 text-rose-800 rounded-full px-3 py-1 font-bold">{{ $informasi->category }}</span>
                <span class="text-stone-500">{{ $informasi->created_at?->translatedFormat('d F Y') ?? '-' }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-stone-900 leading-snug">{{ $informasi->judul }}</h1>
            <p class="mt-5 text-base text-stone-600 font-medium leading-relaxed">{{ $informasi->summary }}</p>
            <hr class="border-stone-100 my-6">
            @if (filled($informasi->content))
                <div class="text-sm md:text-base text-stone-700 leading-8 whitespace-pre-line wrap-break-word">{{ $informasi->content }}</div>
            @else
                <p class="text-sm text-stone-500">Belum ada isi artikel tambahan.</p>
            @endif
        </div>
    </article>
@endsection
