@php
    $kelolaUserAktif = request()->is('kelolaUser*')
        || request()->is('users/*/balita')
        || request()->is('users/*/balita/*/riwayat')
        || request()->is('balita/*/riwayat-halaman');
@endphp

<!-- Mobile -->
<div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-30 hidden md:hidden transition-opacity"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed md:sticky top-0 h-screen w-64 bg-white border-r border-pink-100 z-40 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 shrink-0 shadow-xs">
    <div class="flex flex-col h-full">

        <!-- Logo Area -->
        <div class="h-16 px-5 border-b border-pink-100 flex items-center justify-between shrink-0">
            <div class="flex-1 flex items-center justify-center min-w-0">
                <img
                    src="{{ asset('images/logo-16.9.png') }}"
                    alt="StuntGuard Jember - Monitoring Gizi dan MPASI"
                    class="w-full max-w-50 h-auto object-contain">
            </div>
            <!-- Close button for mobile -->
            <button onclick="toggleSidebar()" class="md:hidden text-stone-400 hover:text-stone-600 p-1 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-5">

            <!-- Group 1: MAIN -->
        <div>
            <span class="px-2.5 text-xs font-bold tracking-wider text-stone-500 uppercase">Main</span>

            <nav class="mt-1.5 space-y-1">
                <a href="{{ route('dashboardAdmin') }}"
                class="group flex items-center gap-2.5 px-3 py-2 rounded-xl transition-all
                {{ request()->routeIs('dashboardAdmin')
                        ? 'bg-brand text-white shadow-sm'
                        : 'text-stone-600 hover:text-pink-700 hover:bg-stone-50' }}">

                    <i data-lucide="layout-dashboard"
                    class="w-4 h-4
                    {{ request()->routeIs('dashboardAdmin')
                            ? 'text-pink-100': 'text-stone-400 group-hover:text-pink-700' }}"></i>

                    <span class="text-sm font-semibold">Dashboard</span>
                </a>
            </nav>
        </div>

            <!-- Group 2: MANAJEMEN KONTEN -->
            <div>
                <span class="px-2.5 text-xs font-semibold tracking-wider text-stone-500">MANAJEMEN KONTEN</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kelola Informasi -->
                    <a href="{{ route('kelolaInformasi') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl {{ request()->is('kelolaInformasi*') ? 'bg-brand text-white shadow-sm' : 'text-stone-600 hover:text-pink-700 hover:bg-stone-50' }} transition-all">
                        <i data-lucide="book-open" class="w-4 h-4 mt-0.5 {{ request()->is('kelolaInformasi*') ? 'text-pink-100' : 'text-stone-400 group-hover:text-pink-700' }} transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola Informasi</span>
                            <span class="block text-xs {{ request()->is('kelolaInformasi*') ? 'text-pink-100' : 'text-stone-500' }} font-normal leading-tight mt-0.5">Edukasi & Trimester</span>
                        </div>
                    </a>
                    <!-- Kelola MPASI -->
                    <a href="{{ route('kelolaMpasi') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl {{ (request()->is('kelolaMpasi*') || request()->routeIs('mpasi.create', 'mpasi.edit')) ? 'bg-brand text-white shadow-sm' : 'text-stone-600 hover:text-pink-700 hover:bg-stone-50' }} transition-all">
                        <i data-lucide="utensils-crossed" class="w-4 h-4 mt-0.5 {{ (request()->is('kelolaMpasi*') || request()->routeIs('mpasi.create', 'mpasi.edit')) ? 'text-pink-100' : 'text-stone-400 group-hover:text-pink-700' }} transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola MPASI</span>
                            <span class="block text-xs {{ (request()->is('kelolaMpasi*') || request()->routeIs('mpasi.create', 'mpasi.edit')) ? 'text-pink-100' : 'text-stone-500' }} font-normal leading-tight mt-0.5">Resep 6-23 Bulan</span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Group 3: PENGATURAN SISTEM -->
            <div>
                <span class="px-2.5 text-xs font-bold tracking-wider text-stone-500 uppercase">Pengaturan Sistem</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kalkulator Gizi -->
                    <a href="{{ route('kalkulatorGizi') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl {{ request()->is('kalkulatorGizi*') ? 'bg-brand text-white shadow-sm' : 'text-stone-600 hover:text-pink-700 hover:bg-stone-50' }} transition-all">
                        <i data-lucide="calculator" class="w-4 h-4 mt-0.5 {{ request()->is('kalkulatorGizi*') ? 'text-pink-100' : 'text-stone-400 group-hover:text-pink-700' }} transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kalkulator Gizi</span>
                            <span class="block text-xs {{ request()->is('kalkulatorGizi*') ? 'text-pink-100' : 'text-stone-500' }} font-normal leading-tight mt-0.5">Pengukuran Balita</span>
                        </div>
                    </a>
                    <!-- Kelola User -->
                    <a href="{{ route('kelolaUser') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl {{ $kelolaUserAktif ? 'bg-brand text-white shadow-sm' : 'text-stone-600 hover:text-pink-700 hover:bg-stone-50' }} transition-all">
                        <i data-lucide="users" class="w-4 h-4 mt-0.5 {{ $kelolaUserAktif ? 'text-pink-100' : 'text-stone-400 group-hover:text-pink-700' }} transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola User</span>
                            <span class="block text-xs {{ $kelolaUserAktif ? 'text-pink-100' : 'text-stone-500' }} font-normal leading-tight mt-0.5">Pengguna & Balita</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Logout Button Area inside Sidebar -->
        <div class="p-3 border-t border-stone-100 shrink-0">
            <form action="{{ route('logout') }}" method="POST" data-confirm="logout">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 border border-red-200 hover:border-red-300 transition-all font-semibold text-sm cursor-pointer group">
                    <div class="w-7 h-7 rounded-lg bg-red-100 group-hover:bg-red-200 text-red-600 group-hover:text-red-800 flex items-center justify-center transition-colors shrink-0">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    </div>
                    <div class="text-left min-w-0">
                        <span class="block leading-tight text-xs font-semibold">Logout Akun</span>
                        <span class="block text-xs text-red-400 group-hover:text-red-600 font-normal leading-tight mt-0.5">Keluar dari sistem</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</aside>
