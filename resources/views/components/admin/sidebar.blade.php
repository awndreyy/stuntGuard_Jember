<!-- Mobile Overlay -->
<div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-30 hidden md:hidden transition-opacity"></div>

<!-- Left Sidebar -->
<aside id="sidebar" class="fixed md:sticky top-0 h-screen w-64 bg-white border-r border-slate-200 z-40 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 shrink-0 shadow-xs">
    <div class="flex flex-col h-full">

        <!-- Top Brand Logo Area -->
        <div class="h-16 px-5 border-b border-slate-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-teal-800 text-white flex items-center justify-center shadow-sm shadow-teal-900/20">
                    <i data-lucide="shield-check" class="w-5 h-5 stroke-[2.2]"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-base tracking-tight text-teal-800">StuntGuard</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-teal-50 text-teal-700 border border-teal-200/60">JEMBER</span>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium leading-none mt-0.5">Monitoring Gizi & MPASI</p>
                </div>
            </div>
            <!-- Close button for mobile -->
            <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-5">

            <!-- Group 1: MAIN -->
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Main</span>
                <nav class="mt-1.5 space-y-1">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl {{ request()->is('/') ? 'bg-teal-800 text-white font-semibold text-xs shadow-sm shadow-teal-900/15' : 'text-slate-600 hover:text-teal-800 hover:bg-slate-50' }} transition-all">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 {{ request()->is('/') ? 'stroke-[2.2]' : 'text-slate-400 group-hover:text-teal-800' }} transition-colors"></i>
                        <span class="text-xs font-semibold">Dashboard Overview</span>
                    </a>
                </nav>
            </div>

            <!-- Group 2: MANAJEMEN KONTEN -->
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Manajemen Konten</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kelola Informasi -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                        <i data-lucide="book-open" class="w-4 h-4 mt-0.5 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola Informasi</span>
                            <span class="block text-[10px] text-slate-400 font-normal leading-tight mt-0.5">Edukasi & Trimester</span>
                        </div>
                    </a>
                    <!-- Kelola MPASI -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                        <i data-lucide="utensils-crossed" class="w-4 h-4 mt-0.5 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola MPASI</span>
                            <span class="block text-[10px] text-slate-400 font-normal leading-tight mt-0.5">Resep 6-23 Bulan</span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Group 3: PENGATURAN SISTEM -->
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Pengaturan Sistem</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kalkulator Gizi -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                        <i data-lucide="calculator" class="w-4 h-4 mt-0.5 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kalkulator Gizi</span>
                            <span class="block text-[10px] text-slate-400 font-normal leading-tight mt-0.5">Parameter WHO</span>
                        </div>
                    </a>
                    <!-- Kelola User -->
                    <a href="{{ url('/kelolaUser') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl {{ request()->is('kelolaUser*') ? 'bg-teal-800 text-white shadow-sm shadow-teal-900/15' : 'text-slate-600 hover:text-teal-800 hover:bg-slate-50' }} transition-all">
                        <i data-lucide="users" class="w-4 h-4 mt-0.5 {{ request()->is('kelolaUser*') ? 'text-teal-100' : 'text-slate-400 group-hover:text-teal-800' }} transition-colors"></i>
                        <div class="flex-1">
                            <span class="block text-xs font-semibold">Kelola User</span>
                            <span class="block text-[10px] {{ request()->is('kelolaUser*') ? 'text-teal-200' : 'text-slate-400' }} font-normal leading-tight mt-0.5">Pengguna & Akses</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Footer Info Box inside Sidebar -->
        <div class="p-3 border-t border-slate-100 shrink-0">
            <div class="bg-teal-50/80 border border-teal-100 rounded-xl p-2.5 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-teal-800/10 text-teal-800 flex items-center justify-center shrink-0">
                    <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5">
                        <span class="text-[11px] font-semibold text-teal-900">Wilayah Jember</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>
                    <p class="text-[10px] text-teal-700/80 truncate">Sinkron Posyandu Aktif</p>
                </div>
            </div>
        </div>
    </div>
</aside>
