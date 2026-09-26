<!-- Mobile Overlay -->
<div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-30 hidden md:hidden transition-opacity"></div>

<!-- Left Sidebar -->
<aside id="sidebar" class="fixed md:sticky top-0 h-screen w-64 bg-white border-r border-stone-200 z-40 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 shrink-0 shadow-xs">
    <div class="flex flex-col h-full">

        <!-- Top Brand Logo Area -->
        <div class="h-16 px-5 border-b border-stone-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-rose-700 text-white flex items-center justify-center shadow-sm">
                    <i data-lucide="shield-check" class="w-5 h-5 stroke-[2.2]"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-base tracking-tight text-rose-700">StuntGuard</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-rose-50 text-rose-700 border border-rose-200/60">JEMBER</span>
                    </div>
                    <p class="text-[10px] text-stone-400 font-medium leading-none mt-0.5">Monitoring Gizi & MPASI</p>
                </div>
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
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-stone-400 uppercase">Main</span>
                <nav class="mt-1.5 space-y-1">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl {{ request()->is('/') ? 'bg-rose-700 text-white font-semibold text-xs shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }} transition-all">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 {{ request()->is('/') ? 'stroke-[2.2]' : 'text-stone-400 group-hover:text-rose-700' }} transition-colors"></i>
                        <span class="text-xs font-semibold">Dashboard Overview</span>
                    </a>
                </nav>
            </div>

            <!-- Group 2: MANAJEMEN KONTEN -->
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-stone-400 uppercase">Manajemen Konten</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kelola Informasi -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-stone-600 hover:text-rose-700 hover:bg-stone-50 transition-colors">
                        <i data-lucide="book-open" class="w-4 h-4 mt-0.5 text-stone-400 group-hover:text-rose-700 transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola Informasi</span>
                            <span class="block text-[10px] text-stone-400 font-normal leading-tight mt-0.5">Edukasi & Trimester</span>
                        </div>
                    </a>
                    <!-- Kelola MPASI -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-stone-600 hover:text-rose-700 hover:bg-stone-50 transition-colors">
                        <i data-lucide="utensils-crossed" class="w-4 h-4 mt-0.5 text-stone-400 group-hover:text-rose-700 transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola MPASI</span>
                            <span class="block text-[10px] text-stone-400 font-normal leading-tight mt-0.5">Resep 6-23 Bulan</span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Group 3: PENGATURAN SISTEM -->
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-stone-400 uppercase">Pengaturan Sistem</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kalkulator Gizi -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-stone-600 hover:text-rose-700 hover:bg-stone-50 transition-colors">
                        <i data-lucide="calculator" class="w-4 h-4 mt-0.5 text-stone-400 group-hover:text-rose-700 transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kalkulator Gizi</span>
                            <span class="block text-[10px] text-stone-400 font-normal leading-tight mt-0.5">Parameter WHO</span>
                        </div>
                    </a>
                    <!-- Kelola User -->
                    <a href="{{ url('/kelolaUser') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl {{ request()->is('kelolaUser*') ? 'bg-rose-700 text-white shadow-sm' : 'text-stone-600 hover:text-rose-700 hover:bg-stone-50' }} transition-all">
                        <i data-lucide="users" class="w-4 h-4 mt-0.5 {{ request()->is('kelolaUser*') ? 'text-rose-100' : 'text-stone-400 group-hover:text-rose-700' }} transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola User</span>
                            <span class="block text-[10px] {{ request()->is('kelolaUser*') ? 'text-rose-200' : 'text-stone-400' }} font-normal leading-tight mt-0.5">Pengguna & Akses</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Footer Info Box inside Sidebar -->
        <div class="p-3 border-t border-stone-100 shrink-0">
            <div class="bg-rose-50/80 border border-rose-100 rounded-xl p-2.5 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-rose-700/10 text-rose-700 flex items-center justify-center shrink-0">
                    <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5">
                        <span class="text-[11px] font-semibold text-rose-900">Wilayah Jember</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>
                    <p class="text-[10px] text-rose-700/80 truncate">Sinkron Posyandu Aktif</p>
                </div>
            </div>
        </div>
    </div>
</aside>
