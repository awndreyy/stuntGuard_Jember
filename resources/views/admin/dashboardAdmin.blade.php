<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'StuntGuard Jember - Admin Dashboard' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
        theme: {
            extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            colors: {
                teal: {
                750: '#0f6157',
                800: '#115e59',
                900: '#134e4a',
                }
            }
            }
        }
        }
    </script>

    <style>
        body {
        font-family: 'Inter', sans-serif;
        -webkit-font-smoothing: antialiased;
        }
        /* Custom subtle scrollbar for tables & sidebars */
        ::-webkit-scrollbar {
        width: 5px;
        height: 5px;
        }
        ::-webkit-scrollbar-track {
        background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper (16:9 Full Viewport Height Container) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

        <!-- Header Component -->
        <x-admin.header searchPlaceholder="Cari data pengguna, resep MPASI..." />

        <!-- Main Content Canvas (16:9 Screen Fit with Zero Vertical Overflow) -->
        <main class="flex-1 overflow-y-auto md:overflow-hidden p-3.5 sm:p-5 flex flex-col gap-3.5 max-w-[1920px] w-full mx-auto">

        <!-- Top Row: Welcome & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 shrink-0">
            <div>
            <h1 class="text-lg sm:text-xl font-bold tracking-tight text-slate-900 flex items-center gap-2">
                Dashboard Overview
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Monitoring gizi anak & pengelolaan resep MPASI StuntGuard Kabupaten Jember.
            </p>
            </div>
        </div>

        <!-- Section A: 3 KPI Cards (Compact Widescreen Grid) -->
        <section class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-3.5 shrink-0">

            <!-- KPI 1: Pengguna Aktif -->
            <div class="bg-white rounded-xl p-3.5 border border-slate-200/80 shadow-2xs hover:border-teal-300 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Total Pengguna</span>
                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-800 flex items-center justify-center">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-slate-900 tracking-tight">{{ number_format($totalUsers ?? 2450) }}</span>
                </div>
                <p class="text-[10px] text-slate-400 mt-1">Ibu hamil & balita terdaftar Jember</p>
            </div>

            <!-- KPI 2: Anak Terindikasi Stunting -->
            <div class="bg-white rounded-xl p-3.5 border border-slate-200/80 shadow-2xs hover:border-amber-300 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Anak Terindikasi Stunting</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-slate-900 tracking-tight">{{ number_format($totalStunting ?? 45) }}</span>
                </div>
                <p class="text-[10px] text-slate-400 mt-1">Anak terindikasi stunting</p>
            </div>

            <!-- KPI 3: Basis Data Resep MPASI -->
            <div class="bg-white rounded-xl p-3.5 border border-slate-200/80 shadow-2xs hover:border-emerald-300 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Resep MPASI</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-slate-900 tracking-tight">{{ number_format($totalResep ?? 128) }}</span>
                </div>
                <p class="text-[10px] text-slate-400 mt-1">Resep lokal pangan bergizi tinggi</p>
            </div>

        </section>

        <!-- Section B: Main 16:9 Split Content (Resep MPASI Left + Live Log Right) -->
        <section class="flex-1 grid grid-cols-1 lg:grid-cols-12 gap-3.5 min-h-0">

            <!-- Left Panel: Kelola Resep MPASI Terbaru (lg:col-span-7) -->
            <div class="lg:col-span-7 bg-white rounded-xl border border-slate-200/80 shadow-2xs flex flex-col min-h-[320px] lg:min-h-0 overflow-hidden">

                <!-- Card Header with Category Tabs -->
                <div class="px-4 py-3 border-b border-slate-100 flex flex-wrap items-center justify-between gap-2 shrink-0">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-800 flex items-center justify-center">
                            <i data-lucide="soup" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Kelola Resep MPASI Terbaru</h2>
                            <p class="text-[10px] text-slate-400 font-normal">Daftar menu bergizi berdasarkan usia</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Filter Tabs -->
                        <div class="hidden sm:flex items-center bg-slate-100/80 p-0.5 rounded-lg text-[11px] font-medium text-slate-600">
                            <button class="px-2.5 py-1 rounded-md bg-white text-teal-900 shadow-2xs font-semibold">Semua</button>
                            <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">6-8 Bln</button>
                            <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">9-11 Bln</button>
                            <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">12-23 Bln</button>
                        </div>

                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-800 hover:bg-teal-900 text-white text-xs font-semibold rounded-lg transition-colors">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Tambah</span>
                        </button>
                    </div>
                </div>

                <!-- Data Table Container -->
                <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead class="sticky top-0 bg-slate-50/90 backdrop-blur-xs border-b border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider z-10">
                            <tr>
                                <th class="py-2.5 px-4 whitespace-nowrap">Judul Resep</th>
                                <th class="py-2.5 px-3 whitespace-nowrap">Kategori</th>
                                <th class="py-2.5 px-3 whitespace-nowrap">Tekstur</th>
                                <th class="py-2.5 px-4 text-right whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs">

                        @forelse($resepList ?? [
                            ['title' => 'Bubur Hati Ayam & Bayam', 'subtitle' => 'Kaya zat besi & asam folat', 'kategori' => '6-8 Bulan', 'tekstur' => 'Lumat Saring', 'color' => 'blue'],
                            ['title' => 'Pure Salmon Tempe Wortel', 'subtitle' => 'Omega-3 & protein nabati', 'kategori' => '6-8 Bulan', 'tekstur' => 'Lumat Halus', 'color' => 'blue'],
                            ['title' => 'Nasi Tim Daging Cincang', 'subtitle' => 'Tekstur adaptif stimulasi kunyah', 'kategori' => '9-11 Bulan', 'tekstur' => 'Cincang Kasar', 'color' => 'indigo'],
                            ['title' => 'Sup Bola Ikan Tenggiri Sayur', 'subtitle' => 'Pangan keluarga padat nutrisi', 'kategori' => '12-23 Bulan', 'tekstur' => 'Menu Keluarga', 'color' => 'emerald'],
                            ['title' => 'Purée Hati Sapi & Labu Kuning', 'subtitle' => 'Tinggi vitamin A & zat besi', 'kategori' => '6-8 Bulan', 'tekstur' => 'Lumat Saring', 'color' => 'blue']
                            ] as $resep)
                        <tr class="hover:bg-teal-50/40 transition-colors group">
                            <td class="py-2.5 px-4 font-medium text-slate-900 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-6.5 h-6.5 rounded-md bg-teal-50 text-teal-800 flex items-center justify-center shrink-0">
                                        <i data-lucide="utensils" class="w-3 h-3"></i>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-semibold text-slate-800">{{ $resep['title'] ?? $resep->nama_resep }}</span>
                                        <span class="block text-[10px] text-slate-400">{{ $resep['subtitle'] ?? $resep->deskripsi_singkat }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2.5 px-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/60">
                                    {{ $resep['kategori'] ?? $resep->kategori_usia }}
                                </span>
                            </td>
                            <td class="py-2.5 px-3 text-[11px] text-slate-600 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    {{ $resep['tekstur'] ?? $resep->tekstur }}
                                </span>
                            </td>
                            <td class="py-2.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <!-- tombol edit -->
                                    <button class="p-1 text-slate-400 hover:text-teal-800 hover:bg-white rounded transition-colors cursor-pointer" title="Edit">
                                    <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <!-- tombol hapus -->
                                    <button class="p-1 text-slate-400 hover:text-red-600 hover:bg-white rounded transition-colors cursor-pointer" title="Hapus">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-400 text-xs">Belum ada data resep MPASI.</td>
                        </tr>
                        @endforelse

                    </tbody>
                    </table>
                </div>

            <!-- Card Footer -->
            <div class="px-4 py-2 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 shrink-0">
                <span>Menampilkan {{ count($resepList ?? [1,2,3,4,5]) }} dari {{ $totalResep ?? 128 }} resep</span>
                <a href="#" class="font-semibold text-teal-800 hover:underline flex items-center gap-1">
                Lihat Semua <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            </div>

            <!-- Right Panel: Log Riwayat Kalkulator Gizi Pengguna (lg:col-span-5) -->
            <div class="lg:col-span-5 bg-white rounded-xl border border-slate-200/80 shadow-2xs flex flex-col min-h-[300px] lg:min-h-0 overflow-hidden">

            <!-- Card Header -->
            <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-800 flex items-center justify-center">
                    <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Log Riwayat Kalkulator Gizi</h2>
                    <p class="text-[10px] text-slate-400 font-normal">Antropometri Standar WHO</p>
                </div>
                </div>
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live Log
                </span>
            </div>

            <!-- Table Container -->
            <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
                <table class="w-full text-left border-collapse min-w-[380px]">
                <thead class="sticky top-0 bg-slate-50/90 backdrop-blur-xs border-b border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider z-10">
                    <tr>
                    <th class="py-2.5 px-4 whitespace-nowrap">Nama Anak</th>
                    <th class="py-2.5 px-2 whitespace-nowrap">Usia</th>
                    <th class="py-2.5 px-3 whitespace-nowrap">Status Gizi</th>
                    <th class="py-2.5 px-4 text-right whitespace-nowrap">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">

                    @forelse($logGiziList ?? [
                    ['initial' => 'R', 'nama' => 'Rayyan Al-Fatih', 'usia' => '8 Bln', 'status' => 'Normal', 'waktu' => '09:15 WIB', 'type' => 'emerald'],
                    ['initial' => 'A', 'nama' => 'Azkia Putri', 'usia' => '14 Bln', 'status' => 'Stunting', 'waktu' => '08:40 WIB', 'type' => 'red'],
                    ['initial' => 'B', 'nama' => 'Bima Arya', 'usia' => '10 Bln', 'status' => 'Wasting', 'waktu' => 'Kemarin', 'type' => 'amber'],
                    ['initial' => 'C', 'nama' => 'Cantika Dewi', 'usia' => '19 Bln', 'status' => 'Normal', 'waktu' => 'Kemarin', 'type' => 'emerald'],
                    ['initial' => 'D', 'nama' => 'Danendra Rama', 'usia' => '7 Bln', 'status' => 'Normal', 'waktu' => 'Kemarin', 'type' => 'emerald']
                    ] as $log)
                    <tr class="hover:bg-teal-50/40 transition-colors">
                        <td class="py-2.5 px-4 font-medium text-slate-900 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px] flex items-center justify-center shrink-0">
                            {{ $log['initial'] ?? strtoupper(substr($log->nama_anak ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                            <span class="block text-xs font-semibold text-slate-800">{{ $log['nama'] ?? $log->nama_anak }}</span>
                            </div>
                        </div>
                        </td>
                        <td class="py-2.5 px-2 text-[11px] font-medium text-slate-600 whitespace-nowrap">{{ $log['usia'] ?? $log->usia }}</td>
                        <td class="py-2.5 px-3 whitespace-nowrap">
                        @if(($log['type'] ?? $log->status_type) == 'emerald' || ($log['status'] ?? '') == 'Normal')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Normal
                            </span>
                        @elseif(($log['type'] ?? $log->status_type) == 'red' || ($log['status'] ?? '') == 'Stunting')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-red-100 text-red-800 border border-red-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> Stunting
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-900 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> {{ $log['status'] ?? 'Wasting' }}
                            </span>
                        @endif
                        </td>
                        <td class="py-2.5 px-4 text-right text-[10px] text-slate-400 whitespace-nowrap">{{ $log['waktu'] ?? $log->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-slate-400 text-xs">Belum ada riwayat pemeriksaan.</td>
                    </tr>
                    @endforelse

                </tbody>
                </table>
            </div>

            <!-- Card Footer -->
            <div class="px-4 py-2 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500 shrink-0">
                <span>Sinkronisasi posyandu aktif</span>
                <a href="#" class="font-semibold text-teal-800 hover:underline flex items-center gap-1">
                Buka Log Complete <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            </div>

        </section>

        <!-- Footer -->
        <footer class="text-center py-1">
            <span class="text-[10px] text-emerald-800 hidden xl:inline text-center">© 2026 StuntGuard Jember</span>
        </footer>

        </main>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Toggle Mobile Sidebar
        function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');

        const isClosed = sidebar.classList.contains('-translate-x-full');
        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
        }

        // format tanggal
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
        const today = new Date().toLocaleDateString('id-ID', dateOptions);
        const dateElement = document.getElementById('current-date');
        if (dateElement) {
        dateElement.innerText = today;
        }
    </script>

</body>
</html>
