@extends('layouts.admin')

@section('title', 'Kelola Resep MPASI')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 shrink-0">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-lg sm:text-xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                    Kelola Resep MPASI
                </h1>
            </div>
            <p class="text-xs text-stone-500 mt-0.5">
                Kelola direktori menu dan resep Makanan Pendamping ASI bergizi untuk balita usia 6–23 bulan.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('mpasi.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-brand hover:bg-brand-hover text-white text-xs font-semibold rounded-xl hover:shadow cursor-pointer w-full sm:w-auto">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Tambah Resep Baru</span>
            </a>
        </div>
    </div>

    <!-- Total Resep, 6-8, 9-11, 12-23 -->
    @include('components.admin.cardStatistikMpasi')

    <form method="GET" action="{{ route('kelolaMpasi') }}" class="flex shrink-0 flex-wrap items-end gap-3 rounded-2xl border border-stone-200 bg-white p-3">
        <label class="flex flex-col gap-1 text-xs text-stone-600">
            Kategori usia
            <select name="kategori_usia" class="min-h-11 rounded-xl border border-stone-200 bg-stone-50 px-3 focus:outline-pink-700">
                @foreach (['all' => 'Semua Usia', '6-8' => '6–8 Bulan', '9-11' => '9–11 Bulan', '12-23' => '12–23 Bulan'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('kategori_usia', 'all') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label class="flex min-w-0 flex-1 flex-col gap-1 text-xs text-stone-600">
            Cari resep
            <input type="search" name="q" maxlength="100" value="{{ request('q') }}" placeholder="Nama resep / bahan..." class="min-h-11 w-full rounded-xl border border-stone-200 bg-stone-50 px-3 focus:outline-pink-700">
        </label>
        <button class="min-h-11 cursor-pointer rounded-xl bg-brand px-4 text-xs font-semibold text-white hover:bg-brand-hover focus-visible:outline-2 focus-visible:outline-pink-700">Terapkan</button>
        <a href="{{ route('kelolaMpasi') }}" class="inline-flex min-h-11 items-center rounded-xl px-3 text-xs text-pink-700 hover:bg-pink-50 focus-visible:outline-2 focus-visible:outline-pink-700">Reset</a>
    </form>

    <!-- TABEL RESEP -->
    @include('admin.partials.table-mpasi')

    <!-- Hidden Global Delete Form -->
    <form id="globalDeleteForm" method="POST" data-confirm="delete" data-confirm-kind="resep" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal Detail / Preview Resep -->
    @include('components.admin.modalDetailMpasi')

    <!-- NOTIFIKASI TOAST -->
    <div id="toastNotification" class="fixed top-5 left-1/2 -translate-x-1/2 bg-stone-900 text-white px-4 py-3 rounded-2xl shadow-xl z-50 hidden items-center gap-3 transition-all duration-300">
        <div id="toastIcon" class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
            <i data-lucide="check" class="w-4 h-4"></i>
        </div>
        <div>
            <p id="toastTitle" class="text-xs font-bold">Berhasil</p>
            <p id="toastMessage" class="text-[11px] text-stone-300">Data resep MPASI berhasil diperbarui.</p>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Pass dynamic data to external JS -->
    <script>
        window.recipesData = @json($mpasis->keyBy('id_resep'));
    </script>
    <!-- Script Khusus Interaktivitas Halaman MPASI -->
    @vite(['resources/js/kelola-mpasi.js'])

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast('Berhasil', "{{ session('success') }}", 'success');
            });
        </script>
    @endif


@endpush
