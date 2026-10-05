<!-- Mobile Overlay -->
<div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-30 hidden md:hidden transition-opacity"></div>

<!-- Left Sidebar -->
<aside id="sidebar" class="fixed md:sticky top-0 h-screen w-72 bg-white border-r border-stone-200 z-40 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 shrink-0 shadow-xs">
    <div class="flex flex-col h-full">

        <!-- Top Brand Logo Area -->
        <div class="h-20 px-4 border-b border-stone-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-rose-50 p-1.5 shadow-sm ring-1 ring-rose-100">
                    <img src="{{ asset('images/logoBesar.png') }}" alt="Logo StuntGuard" class="w-full h-full rounded-xl object-cover">
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-base tracking-tight text-rose-700">StuntGuard</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-rose-50 text-rose-700 border border-rose-200/60">JEMBER</span>
                    </div>
                    <p class="text-[10px] text-stone-400 font-medium leading-none mt-0.5">Monitoring Gizi & MPASI</p>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="md:hidden text-stone-400 hover:text-stone-600 p-1 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-5">
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-[0.16em] text-stone-400 uppercase">Main</span>
                <nav class="mt-2 space-y-1.5">
                    <a href="{{ route('dashboardAdmin') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-2xl transition-all {{ request()->routeIs('dashboardAdmin') ? 'bg-rose-700 text-white shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('dashboardAdmin') ? 'bg-white/15 text-white' : 'bg-stone-100 text-stone-500 group-hover:bg-rose-50 group-hover:text-rose-700' }}">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        </span>
                        <span class="text-xs font-semibold">Dashboard Overview</span>
                    </a>
                </nav>
            </div>

            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-[0.16em] text-stone-400 uppercase">Manajemen Konten</span>
                <nav class="mt-2 space-y-1.5">
                    <a href="{{ route('kelolaInformasi') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-2xl transition-all {{ request()->routeIs('kelolaInformasi') || request()->is('kelolaInformasi*') ? 'bg-rose-700 text-white shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kelolaInformasi') || request()->is('kelolaInformasi*') ? 'bg-white/15 text-white' : 'bg-stone-100 text-stone-500 group-hover:bg-rose-50 group-hover:text-rose-700' }} ">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kelola Informasi</span>
                            <span class="block text-[10px] {{ request()->routeIs('kelolaInformasi') || request()->is('kelolaInformasi*') ? 'text-rose-100' : 'text-stone-400' }} leading-tight mt-0.5">Edukasi & Trimester</span>
                        </div>
                    </a>

                    <a href="{{ route('kelolaMpasi') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-2xl transition-all {{ request()->routeIs('kelolaMpasi') || request()->is('kelolaMpasi*') ? 'bg-rose-700 text-white shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kelolaMpasi') || request()->is('kelolaMpasi*') ? 'bg-white/15 text-white' : 'bg-stone-100 text-stone-500 group-hover:bg-rose-50 group-hover:text-rose-700' }} ">
                            <i data-lucide="utensils-crossed" class="w-4 h-4"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kelola MPASI</span>
                            <span class="block text-[10px] {{ request()->routeIs('kelolaMpasi') || request()->is('kelolaMpasi*') ? 'text-rose-100' : 'text-stone-400' }} leading-tight mt-0.5">Resep 6-23 Bulan</span>
                        </div>
                    </a>
                </nav>
            </div>

            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-[0.16em] text-stone-400 uppercase">Pengaturan Sistem</span>
                <nav class="mt-2 space-y-1.5">
                    <a href="{{ route('kalkulatorGizi') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-2xl transition-all {{ request()->routeIs('kalkulatorGizi') || request()->is('kalkulatorGizi*') ? 'bg-rose-700 text-white shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kalkulatorGizi') || request()->is('kalkulatorGizi*') ? 'bg-white/15 text-white' : 'bg-stone-100 text-stone-500 group-hover:bg-rose-50 group-hover:text-rose-700' }} ">
                            <i data-lucide="calculator" class="w-4 h-4"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kalkulator Gizi</span>
                            <span class="block text-[10px] {{ request()->routeIs('kalkulatorGizi') || request()->is('kalkulatorGizi*') ? 'text-rose-100' : 'text-stone-400' }} leading-tight mt-0.5">Parameter WHO</span>
                        </div>
                    </a>

                    <a href="{{ route('kelolaUser') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-2xl transition-all {{ request()->routeIs('kelolaUser') || request()->is('kelolaUser*') ? 'bg-rose-700 text-white shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kelolaUser') || request()->is('kelolaUser*') ? 'bg-white/15 text-white' : 'bg-stone-100 text-stone-500 group-hover:bg-rose-50 group-hover:text-rose-700' }} ">
                            <i data-lucide="users" class="w-4 h-4"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <span class="block text-xs font-semibold">Kelola User</span>
                            <span class="block text-[10px] {{ request()->routeIs('kelolaUser') || request()->is('kelolaUser*') ? 'text-rose-100' : 'text-stone-400' }} leading-tight mt-0.5">Pengguna & Balita</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-3 border-t border-stone-100 shrink-0">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-2xl text-stone-600 hover:text-rose-700 hover:bg-rose-50 border border-stone-200/80 hover:border-rose-200 transition-all font-semibold text-xs cursor-pointer group">
                    <div class="w-8 h-8 rounded-xl bg-stone-100 group-hover:bg-rose-100 text-stone-500 group-hover:text-rose-700 flex items-center justify-center transition-colors shrink-0">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    </div>
                    <div class="text-left min-w-0">
                        <span class="block leading-tight text-xs font-semibold">Logout Akun</span>
                        <span class="block text-[10px] text-stone-400 group-hover:text-rose-600/70 font-normal leading-tight mt-0.5">Keluar dari sistem</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</aside>
