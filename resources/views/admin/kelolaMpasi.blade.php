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

    <!-- Filter & Toolbar -->
    <div class="bg-white p-3 rounded-2xl border border-stone-200 flex flex-col md:flex-row md:items-center justify-between gap-3 shrink-0">
        <!-- Filter Usia -->
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
            <button onclick="filterCategory('all', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold  transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer {{ request('kategori_usia', 'all') === 'all' ? 'active-tab bg-brand text-white shadow-xs' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                <span>Semua Usia</span>
                <span class="px-1.5 py-0.2 rounded-md bg-white/20 text-[10px]">{{ $totalResep }}</span>
            </button>
            <button onclick="filterCategory('6-8', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold  transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer {{ request('kategori_usia', 'all') === '6-8' ? 'active-tab bg-brand text-white shadow-xs' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span>6-8 Bulan</span>
                <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total68 }}</span>
            </button>
            <button onclick="filterCategory('9-11', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold  transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer {{ request('kategori_usia', 'all') === '9-11' ? 'active-tab bg-brand text-white shadow-xs' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                <span>9-11 Bulan</span>
                <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total911 }}</span>
            </button>
            <button onclick="filterCategory('12-23', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold  transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer {{ request('kategori_usia', 'all') === '12-23' ? 'active-tab bg-brand text-white shadow-xs' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
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
                <input type="text" id="recipeSearchInput" value="{{ request('q', '') }}" oninput="searchRecipes()" placeholder="Cari nama resep / bahan..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-stone-50 border border-stone-200 rounded-xl text-stone-700 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-pink-700/20 focus:border-pink-700 focus:bg-white transition-all">
            </div>
        </div>
    </div>

    <!-- TABEL RESEP -->
    @include('admin.partials.table-mpasi')

    <!-- Hidden Global Delete Form -->
    <form id="globalDeleteForm" method="POST" data-confirm="delete" data-confirm-kind="resep" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal Detail / Preview Resep -->
    @include('components.admin.modalDetailMpasi')
@endsection

@push('scripts')
    <!-- Pass dynamic data to external JS -->
    <script>
        window.recipesData = @json($mpasis->keyBy('id_resep'));
    </script>
    <!-- Script Khusus Interaktivitas Halaman MPASI -->
    @vite(['resources/js/kelola-mpasi.js'])
@endpush
