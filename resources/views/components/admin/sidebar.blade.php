@php
    $kelolaUserAktif = request()->is('kelolaUser*')
        || request()->is('users/*/balita')
        || request()->is('users/*/balita/*/riwayat')
        || request()->is('balita/*/riwayat-halaman');
@endphp

<!-- Mobile -->
<div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-30 hidden md:hidden transition-opacity"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed md:sticky top-0 h-screen w-64 bg-[#FDF5F6] border-r border-[#F3DDE1] z-40 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 shrink-0 shadow-xs">
    <div class="flex flex-col h-full">

        <!-- Logo Area -->
        <div class="h-16 px-5 border-b border-[#F3DDE1] flex items-center justify-center shrink-0">
            <a href="{{ route('dashboardAdmin') }}" class="flex items-center min-w-0" aria-label="StuntGuard Jember">
                <img src="{{ asset('images/logo-16.9.png') }}" alt="StuntGuard Jember" class="h-12 w-auto max-h-12.5 max-w-45 object-contain">
            </a>
            <!-- Close button for mobile -->
            <button onclick="toggleSidebar()" class="md:hidden text-[#7A636B] hover:text-[#C82353] p-1 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-5">

            <!-- Group 1: MAIN -->
            <div>
                <span class="px-2.5 text-xs font-bold tracking-wider text-[#7A636B] uppercase">Main</span>

                <nav class="mt-1.5 space-y-1">
                    <a href="{{ route('dashboardAdmin') }}"
                       class="group flex items-center gap-2.5 px-3 py-2 rounded-xl transition-all
                       {{ request()->routeIs('dashboardAdmin')
                               ? 'bg-[#D6285A] text-white shadow-sm'
                               : 'text-[#2D1F24] hover:text-[#C82353] hover:bg-[#FAEAEF]' }}">

                        <i data-lucide="layout-dashboard"
                           class="w-4 h-4 transition-colors
                           {{ request()->routeIs('dashboardAdmin')
                                   ? 'text-white'
                                   : 'text-[#7A636B] group-hover:text-[#C82353]' }}"></i>

                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                </nav>
            </div>

            <!-- Group 2: MANAJEMEN KONTEN -->
            <div>
                <span class="px-2.5 text-xs font-semibold tracking-wider text-[#7A636B] uppercase">MANAJEMEN KONTEN</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kelola Informasi -->
                    <a href="{{ route('kelolaInformasi') }}"
                       class="group flex items-start gap-2.5 px-3 py-2 rounded-xl transition-all
                       {{ request()->is('kelolaInformasi*')
                               ? 'bg-[#D6285A] text-white shadow-sm'
                               : 'text-[#2D1F24] hover:text-[#C82353] hover:bg-[#FAEAEF]' }}">
                        <i data-lucide="book-open"
                           class="w-4 h-4 mt-0.5 transition-colors
                           {{ request()->is('kelolaInformasi*')
                                   ? 'text-white'
                                   : 'text-[#7A636B] group-hover:text-[#C82353]' }}"></i>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kelola Informasi</span>
                            <span class="block text-xs font-normal leading-tight mt-0.5
                                {{ request()->is('kelolaInformasi*') ? 'text-white/80' : 'text-[#7A636B]' }}">
                                Edukasi & Trimester
                            </span>
                        </div>
                    </a>
                    <!-- Kelola MPASI -->
                    <a href="{{ route('kelolaMpasi') }}"
                       class="group flex items-start gap-2.5 px-3 py-2 rounded-xl transition-all
                       {{ (request()->is('kelolaMpasi*') || request()->routeIs('mpasi.create', 'mpasi.edit'))
                               ? 'bg-[#D6285A] text-white shadow-sm'
                               : 'text-[#2D1F24] hover:text-[#C82353] hover:bg-[#FAEAEF]' }}">
                        <i data-lucide="utensils-crossed"
                           class="w-4 h-4 mt-0.5 transition-colors
                           {{ (request()->is('kelolaMpasi*') || request()->routeIs('mpasi.create', 'mpasi.edit'))
                                   ? 'text-white'
                                   : 'text-[#7A636B] group-hover:text-[#C82353]' }}"></i>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kelola MPASI</span>
                            <span class="block text-xs font-normal leading-tight mt-0.5
                                {{ (request()->is('kelolaMpasi*') || request()->routeIs('mpasi.create', 'mpasi.edit')) ? 'text-white/80' : 'text-[#7A636B]' }}">
                                Resep 6-23 Bulan
                            </span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Group 3: PENGATURAN SISTEM -->
            <div>
                <span class="px-2.5 text-xs font-bold tracking-wider text-[#7A636B] uppercase">Pengaturan Sistem</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kalkulator Gizi -->
                    <a href="{{ route('kalkulatorGizi') }}"
                       class="group flex items-start gap-2.5 px-3 py-2 rounded-xl transition-all
                       {{ request()->is('kalkulatorGizi*')
                               ? 'bg-[#D6285A] text-white shadow-sm'
                               : 'text-[#2D1F24] hover:text-[#C82353] hover:bg-[#FAEAEF]' }}">
                        <i data-lucide="calculator"
                           class="w-4 h-4 mt-0.5 transition-colors
                           {{ request()->is('kalkulatorGizi*')
                                   ? 'text-white'
                                   : 'text-[#7A636B] group-hover:text-[#C82353]' }}"></i>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kalkulator Gizi</span>
                            <span class="block text-xs font-normal leading-tight mt-0.5
                                {{ request()->is('kalkulatorGizi*') ? 'text-white/80' : 'text-[#7A636B]' }}">
                                Pengukuran Balita
                            </span>
                        </div>
                    </a>
                    <!-- Kelola User -->
                    <a href="{{ route('kelolaUser') }}"
                       class="group flex items-start gap-2.5 px-3 py-2 rounded-xl transition-all
                       {{ $kelolaUserAktif
                               ? 'bg-[#D6285A] text-white shadow-sm'
                               : 'text-[#2D1F24] hover:text-[#C82353] hover:bg-[#FAEAEF]' }}">
                        <i data-lucide="users"
                           class="w-4 h-4 mt-0.5 transition-colors
                           {{ $kelolaUserAktif
                                   ? 'text-white'
                                   : 'text-[#7A636B] group-hover:text-[#C82353]' }}"></i>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kelola User</span>
                            <span class="block text-xs font-normal leading-tight mt-0.5
                                {{ $kelolaUserAktif ? 'text-white/80' : 'text-[#7A636B]' }}">
                                Pengguna & Balita
                            </span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Logout Button Area inside Sidebar -->
        <div class="p-3 border-t border-[#F3DDE1] shrink-0">
            <form action="{{ route('logout') }}" method="POST" data-confirm="logout">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-[#9F1239] hover:text-[#9F1239] bg-[#FDF2F4] hover:bg-[#FAEAEF] border border-[#F2CFD6] hover:border-[#E8A5B3] transition-all font-semibold text-sm cursor-pointer group">
                    <div class="w-7 h-7 rounded-lg bg-[#F9DCE2] group-hover:bg-[#F3CAD3] text-[#9F1239] flex items-center justify-center transition-colors shrink-0">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    </div>
                    <div class="text-left min-w-0">
                        <span class="block leading-tight text-xs font-semibold">Logout Akun</span>
                        <span class="block text-xs text-[#7A636B] group-hover:text-[#9F1239]/80 font-normal leading-tight mt-0.5">Keluar dari sistem</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</aside>
