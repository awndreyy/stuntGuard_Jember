@extends('layouts.guest')

@section('title', 'Informasi Kesehatan Balita - StuntGuard Jember')

@section('content')
    <div class="mx-auto max-w-[1200px] px-4 pb-16 pt-7 sm:px-6 md:px-8 lg:px-12">
    <div class="mb-10 rounded-3xl border border-pink-100 bg-pink-50 px-6 py-8 sm:px-10 sm:py-10">
        <a href="{{ route('home') }}#informasi-kesehatan" class="inline-flex items-center gap-1 text-sm font-semibold text-pink-600 hover:text-pink-800 mb-4">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Beranda
        </a>
        <h1 class="text-3xl font-extrabold text-stone-900">Informasi & Edukasi Kesehatan Balita</h1>
        <p class="text-sm text-stone-600 mt-2">Artikel terbaru dari pengelola StuntGuard Jember.</p>
    </div>

    @if ($artikel->isEmpty())
        <div class="rounded-3xl bg-white border border-pink-100 text-center px-5 py-16">
            <span class="material-symbols-outlined text-5xl text-pink-200">article</span>
            <p class="font-semibold text-stone-700 mt-3">Belum ada artikel yang tersedia.</p>
            <p class="text-sm text-stone-500 mt-1">Artikel akan muncul setelah ditambahkan oleh admin.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($artikel as $item)
                @include('landing.partials.articleCard', ['artikel' => $item])
            @endforeach
        </div>
        <div class="mt-8">{{ $artikel->links() }}</div>
    @endif
    </div>
@endsection
