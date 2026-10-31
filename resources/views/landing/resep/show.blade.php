@extends('layouts.guest')

@section('title', $resep->nama_resep . ' - StuntGuard Jember')

@section('content')
    @php
    $urlFoto = $resep->gambar
        ? asset(ltrim($resep->gambar, '/'))
        : null;
    @endphp
    <div class="mx-auto max-w-[1200px] px-4 pb-16 pt-7 sm:px-6 md:px-8 lg:px-12">
    <a href="{{ route('public.resep.index') }}" class="mb-6 inline-flex items-center gap-2 rounded-xl border border-pink-200 bg-white px-4 py-2.5 text-sm font-semibold text-pink-700 transition-colors hover:bg-pink-50">
        <span class="material-symbols-outlined text-lg">arrow_back</span> Semua Resep
    </a>
    <article class="max-w-4xl mx-auto bg-white rounded-3xl overflow-hidden border border-pink-100">
        <div class="relative h-56 sm:h-80 bg-pink-50 flex items-center justify-center">
            @if ($urlFoto)
                <img src="{{ $urlFoto }}" alt="{{ $resep->nama_resep }}" class="w-full h-full object-cover">
            @else
                <span class="material-symbols-outlined text-7xl text-pink-200">restaurant</span>
            @endif
        </div>
        <div class="p-6 md:p-10">
            <div class="flex flex-wrap gap-2 text-xs font-semibold mb-3">
                <span class="rounded-full bg-pink-100 text-pink-700 px-3 py-1">Usia {{ $resep->kategori_usia }} bulan</span>
                <span class="rounded-full bg-pink-100 text-stone-700 px-3 py-1">{{ $resep->waktu_memasak }} menit</span>
                <span class="rounded-full bg-pink-100 text-pink-700 px-3 py-1">{{ $resep->porsi }} porsi</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-stone-900">{{ $resep->nama_resep }}</h1>

            <section class="mt-8" aria-label="Informasi nutrisi">
                <h2 class="text-lg font-bold text-stone-900 mb-3">Informasi Gizi</h2>
                <p class="text-xs text-stone-500 mb-3">Nilai gizi berikut per 1 porsi</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-center">
                    @foreach ([
                        ['Energi', $resep->kalori, 'kkal'],
                        ['Karbohidrat', $resep->karbohidrat, 'g'],
                        ['Lemak', $resep->lemak, 'g'],
                        ['Protein', $resep->protein, 'g'],
                        ['Zat Besi', $resep->zat_besi, 'mg'],
                        ['Seng', $resep->seng, 'mg'],
                    ] as [$label, $value, $unit])
                        <div class="rounded-2xl bg-stone-50 border border-pink-100 p-4">
                            <p class="text-xs text-stone-500">{{ $label }}</p>
                            <p class="text-lg font-bold text-pink-600">{{ $value ?? 0 }} {{ $unit }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <section>
                    <h2 class="text-lg font-bold text-stone-900 mb-3">Bahan yang Dibutuhkan</h2>
                    @forelse (($resep->bahan ?? []) as $bahan)
                        <p class="py-2 border-b border-pink-100 text-sm text-stone-700 flex items-start gap-2">
                            <span class="material-symbols-outlined text-base text-pink-600">check_circle</span> {{ $bahan }}
                        </p>
                    @empty
                        <p class="text-sm text-stone-500">Bahan belum dicantumkan.</p>
                    @endforelse
                </section>
                <section>
                    <h2 class="text-lg font-bold text-stone-900 mb-3">Cara Pembuatan</h2>
                    <ol class="space-y-3 list-decimal pl-5 marker:text-pink-600 marker:font-bold">
                        @forelse (($resep->cara_pembuatan ?? []) as $langkah)
                            <li class="text-sm text-stone-700 leading-relaxed pl-1">{{ $langkah }}</li>
                        @empty
                            <li class="text-sm text-stone-500">Langkah pembuatan belum dicantumkan.</li>
                        @endforelse
                    </ol>
                </section>
            </div>
        </div>
    </article>
    </div>
@endsection
