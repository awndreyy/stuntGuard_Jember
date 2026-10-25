@extends('layouts.guest')

@section('title', 'Informasi Kesehatan Balita - StunGuard Jember')

@section('content')
    <div class="mb-8">
        <a href="{{ route('home') }}#informasi-kesehatan" class="inline-flex items-center gap-1 text-sm font-semibold text-rose-700 hover:underline mb-4">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Beranda
        </a>
        <h1 class="text-3xl font-bold text-stone-900">Informasi & Edukasi Kesehatan Balita</h1>
        <p class="text-sm text-stone-600 mt-2">Artikel terbaru dari pengelola StunGuard Jember.</p>
    </div>

    @if ($artikel->isEmpty())
        <div class="rounded-3xl bg-white border border-stone-200 text-center px-5 py-16">
            <span class="material-symbols-outlined text-5xl text-rose-200">article</span>
            <p class="font-semibold text-stone-700 mt-3">Belum ada artikel yang tersedia.</p>
            <p class="text-sm text-stone-500 mt-1">Artikel akan muncul setelah ditambahkan oleh admin.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($artikel as $item)
                @include('landing.partials.articleCard', ['artikel' => $item])
            @endforeach
        </div>
        <div class="mt-8">{{ $artikel->links() }}</div>
    @endif
@endsection
