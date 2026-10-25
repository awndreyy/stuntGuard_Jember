@extends('layouts.guest')

@section('title', 'Resep MPASI - StunGuard Jember')

@section('content')
    <div class="mb-8">
        <a href="{{ route('home') }}#resep-mpasi" class="inline-flex items-center gap-1 text-sm font-semibold text-rose-700 hover:underline mb-4">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Beranda
        </a>
        <h1 class="text-3xl font-bold text-stone-900">Kumpulan Resep MPASI</h1>
        <p class="text-sm text-stone-600 mt-2">Resep yang dikelola admin, lengkap dengan bahan dan cara pembuatan.</p>
    </div>

    @if ($resep->isEmpty())
        <div class="rounded-3xl bg-white border border-stone-200 text-center px-5 py-16">
            <span class="material-symbols-outlined text-5xl text-emerald-200">restaurant</span>
            <p class="font-semibold text-stone-700 mt-3">Belum ada resep MPASI yang tersedia.</p>
            <p class="text-sm text-stone-500 mt-1">Resep akan muncul setelah ditambahkan oleh admin.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($resep as $item)
                @include('landing.partials.recipeCard', ['resep' => $item])
            @endforeach
        </div>
        <div class="mt-8">{{ $resep->links() }}</div>
    @endif
@endsection
