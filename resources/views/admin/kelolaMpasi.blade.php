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
                <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                    Pangan Lokal Jember
                </span>
            </div>
            <p class="text-xs text-stone-500 mt-0.5">
                Kelola direktori menu dan resep Makanan Pendamping ASI bergizi untuk balita usia 6–23 bulan.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="openRecipeModal('create')" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white text-xs font-semibold rounded-xl transition-all shadow-sm hover:shadow cursor-pointer w-full sm:w-auto">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Tambah Resep Baru</span>
            </button>
        </div>
    </div>

    <!-- Total Resep, 6-8, 9-11, 12-23 -->
    @include('components.admin.cardStatistikMpasi')

    <!-- Filter & Toolbar -->
    <div class="bg-white p-3 rounded-2xl border border-stone-200 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-3 shrink-0">
        <!-- Filter Usia -->
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
            <button onclick="filterCategory('all', this)" class="category-tab active-tab px-3 py-1.5 rounded-xl text-xs font-semibold bg-rose-700 text-white shadow-xs transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                <span>Semua Usia</span>
                <span class="px-1.5 py-0.2 rounded-md bg-white/20 text-[10px]">{{ $totalResep }}</span>
            </button>
            <button onclick="filterCategory('6-8', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span>6-8 Bulan</span>
                <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total68 }}</span>
            </button>
            <button onclick="filterCategory('9-11', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                <span>9-11 Bulan</span>
                <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total911 }}</span>
            </button>
            <button onclick="filterCategory('12-23', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>12-23 Bulan</span>
                <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total1223 }}</span>
            </button>
        </div>

        <!-- Search Field -->
        <div class="flex items-center gap-2">
            <div class="relative w-full sm:w-72">
                <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-stone-400">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                </span>
                <input type="text" id="recipeSearchInput" oninput="searchRecipes()" placeholder="Cari nama resep / bahan..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-stone-50 border border-stone-200 rounded-xl text-stone-700 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
            </div>
        </div>
    </div>

    <!-- TABEL RESEP -->
    @include('admin.partials.table-mpasi')

    <!-- Hidden Global Delete Form -->
    <form id="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal Tambah / Edit Resep -->
    @include('components.admin.modalTambahMpasi')

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
        window.mpasiStoreUrl = "{{ route('mpasi.store') }}";
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

    @if(isset($errors) && $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('recipeModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    if (window.lucide) lucide.createIcons();
                }
            });
        </script>
    @endif
@endpush
