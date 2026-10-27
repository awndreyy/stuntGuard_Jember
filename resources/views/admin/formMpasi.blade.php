@extends('layouts.admin')

@php
    $mpasi = $mpasi ?? null;
    $isEdit = $mpasi !== null;
    $title = $isEdit ? 'Edit Resep MPASI' : 'Tambah Resep MPASI';
@endphp

@section('content')
    <div class="flex flex-wrap items-start justify-between gap-3 shrink-0">
        <div>
            <a href="{{ route('kelolaMpasi') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-stone-500 hover:text-rose-700 mb-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Kelola Resep MPASI
            </a>
            <h1 class="text-xl font-bold tracking-tight text-stone-900">{{ $title }}</h1>
            <p class="text-xs text-stone-500 mt-1">{{ $isEdit ? 'Perbarui detail resep dan panduan gizi.' : 'Lengkapi data resep dan panduan gizi untuk balita.' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 w-full max-w-5xl mx-auto">
        <form id="recipeForm" action="{{ $isEdit ? route('mpasi.update', $mpasi->id_resep) : route('mpasi.store') }}"
              method="POST" enctype="multipart/form-data" novalidate class="p-4 sm:p-6 space-y-5 text-xs">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            @if($errors->any())
                <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 p-3 text-rose-700">
                    <p class="font-semibold">Data belum dapat disimpan. Periksa kolom yang ditandai di bawah.</p>
                </div>
            @endif

            @include('admin.partials.form-mpasi')

            <div class="pt-4 border-t border-stone-100 flex flex-wrap items-center justify-end gap-2">
                <a href="{{ route('kelolaMpasi') }}" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold rounded-xl transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2 bg-rose-700 hover:bg-rose-600 text-white font-semibold rounded-xl shadow-xs transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Resep' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/kelola-mpasi.js'])
@endpush
