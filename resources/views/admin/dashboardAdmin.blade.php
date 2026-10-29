@extends('layouts.admin')

@php($title = 'Dashboard Admin')

@section('content')
        <!-- Top Row: Welcome & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 shrink-0">
            <div>
            <h1 class="text-lg sm:text-xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                Dashboard Overview
            </h1>
            <p class="text-xs text-stone-500 mt-0.5">
                Monitoring gizi anak & pengelolaan resep MPASI StuntGuard Kabupaten Jember.
        `    </p>
            </div>
        </div>

        <!-- Section A: 3 KPI Cards (Compact Widescreen Grid) -->
        <section class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-3.5 shrink-0">

            <!-- KPI 1: Pengguna Aktif -->
            <div class="bg-white rounded-xl p-3.5 border border-stone-200/80 shadow-2xs hover:border-rose-300 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-stone-500">Total Pengguna</span>
                    <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-800 flex items-center justify-center">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-stone-900 tracking-tight">{{ number_format($totalUsers) }}</span>
                </div>
                <p class="text-[10px] text-stone-400 mt-1">Akun orang tua yang terdaftar</p>
            </div>

            <!-- KPI 2: Anak Terindikasi Stunting -->
            <div class="bg-white rounded-xl p-3.5 border border-stone-200/80 shadow-2xs hover:border-amber-300 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-stone-500">Anak Terindikasi Stunting</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-stone-900 tracking-tight">{{ number_format($totalStunting) }}</span>
                </div>
                <p class="text-[10px] text-stone-400 mt-1">Berdasarkan pengukuran PB/U atau TB/U terakhir</p>
            </div>

            <!-- KPI 3: Basis Data Resep MPASI -->
            <div class="bg-white rounded-xl p-3.5 border border-stone-200/80 shadow-2xs hover:border-emerald-300 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase tracking-wider text-stone-500">Resep MPASI</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <span class="text-2xl font-bold text-stone-900 tracking-tight">{{ number_format($totalResep) }}</span>
                </div>
                <p class="text-[10px] text-stone-400 mt-1">Resep lokal pangan bergizi tinggi</p>
            </div>

        </section>

        <!-- Section B: Main 16:9 Split Content (Resep MPASI Left + 10 Terbaru Right) -->
        <section class="flex-1 grid grid-cols-1 lg:grid-cols-12 gap-3.5 min-h-0">

            <!-- Left Panel: Kelola Resep MPASI Terbaru (lg:col-span-7) -->
            <div class="lg:col-span-7 bg-white rounded-xl border border-stone-200/80 shadow-2xs flex flex-col min-h-[320px] lg:min-h-[320px] overflow-hidden">

                <!-- Card Header with Category Tabs -->
                <div class="px-4 py-3 border-b border-stone-100 flex flex-wrap items-center justify-between gap-2 shrink-0">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-800 flex items-center justify-center">
                            <i data-lucide="soup" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-stone-900">Kelola Resep MPASI Terbaru</h2>
                            <p class="text-[10px] text-stone-400 font-normal">Daftar menu bergizi berdasarkan usia</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1 bg-stone-100/80 p-0.5 rounded-lg text-[11px] font-medium">
                            @foreach(['semua' => 'Semua', '6-8' => '6-8 Bln', '9-11' => '9-11 Bln', '12-23' => '12-23 Bln'] as $nilai => $label)
                                <a href="{{ route('dashboardAdmin', ['kategori' => $nilai]) }}"
                                   class="px-2.5 py-1 rounded-md {{ $kategori === $nilai ? 'bg-white text-rose-900 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">{{ $label }}</a>
                            @endforeach
                        </div>
                        <a href="{{ route('mpasi.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-700 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg transition-colors">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i><span>Tambah</span>
                        </a>
                    </div>
                </div>

                <!-- Data Table Container -->
                <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead class="sticky top-0 bg-stone-50/90 backdrop-blur-xs border-b border-stone-100 text-[10px] font-bold text-stone-500 uppercase tracking-wider z-10">
                            <tr>
                                <th class="py-2.5 px-4 whitespace-nowrap">Judul Resep</th>
                                <th class="py-2.5 px-3 whitespace-nowrap">Kategori</th>
                                <th class="py-2.5 px-3 whitespace-nowrap">Waktu Memasak</th>
                                <th class="py-2.5 px-4 text-right whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-xs">

                        @forelse($resepList as $resep)
                        <tr class="hover:bg-rose-50/40 transition-colors group">
                            <td class="py-2.5 px-4 font-medium text-stone-900 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-6.5 h-6.5 rounded-md bg-rose-50 text-rose-800 flex items-center justify-center shrink-0">
                                        <i data-lucide="utensils" class="w-3 h-3"></i>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-semibold text-stone-800">{{ $resep->nama_resep }}</span>
                                        <span class="block text-[10px] text-stone-400">{{ $resep->kalori }} kkal • {{ $resep->porsi }} porsi</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2.5 px-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/60">
                                    {{ $resep->kategori_usia }} bulan
                                </span>
                            </td>
                            <td class="py-2.5 px-3 text-[11px] text-stone-600 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    {{ $resep->waktu_memasak }} menit
                                </span>
                            </td>
                            <td class="py-2.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('mpasi.edit', $resep->id_resep) }}" class="p-1 text-stone-400 hover:text-rose-800 hover:bg-white rounded transition-colors" title="Edit resep" aria-label="Edit {{ $resep->nama_resep }}">
                                         <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                     </a>
                                     <form action="{{ route('mpasi.destroy', $resep->id_resep) }}" method="POST" onsubmit="return confirm('Hapus resep ini?')">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="p-1 text-stone-400 hover:text-red-600 hover:bg-white rounded transition-colors cursor-pointer" title="Hapus resep" aria-label="Hapus {{ $resep->nama_resep }}">
                                             <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                         </button>
                                     </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-stone-400 text-xs">Belum ada data resep MPASI.</td>
                        </tr>
                        @endforelse

                    </tbody>
                    </table>
                </div>

            <!-- Card Footer -->
            <div class="px-4 py-2 bg-stone-50 border-t border-stone-100 flex items-center justify-between text-[11px] text-stone-500 shrink-0">
                <span>Menampilkan {{ count($resepList) }} dari {{ $totalResep }} resep</span>
                <a href="{{ route('kelolaMpasi') }}" class="font-semibold text-rose-800 hover:underline flex items-center gap-1">
                Lihat Semua <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            </div>

            <!-- Right Panel: Riwayat Pengukuran Balita Pengguna (lg:col-span-5) -->
            <div class="lg:col-span-5 bg-white rounded-xl border border-stone-200/80 shadow-2xs flex flex-col min-h-[300px] lg:min-h-[320px] overflow-hidden">

            <!-- Card Header -->
            <div class="px-4 py-3 border-b border-stone-100 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-800 flex items-center justify-center">
                    <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-stone-900">Riwayat Pengukuran Balita</h2>
                    <p class="text-[10px] text-stone-400 font-normal">Antropometri Standar WHO</p>
                </div>
                </div>
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Terbaru
                </span>
            </div>

            <!-- Table Container -->
            <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
                <table class="w-full text-left border-collapse min-w-[380px]">
                <thead class="sticky top-0 bg-stone-50/90 backdrop-blur-xs border-b border-stone-100 text-[10px] font-bold text-stone-500 uppercase tracking-wider z-10">
                    <tr>
                    <th class="py-2.5 px-4 whitespace-nowrap">Nama Anak</th>
                    <th class="py-2.5 px-2 whitespace-nowrap">Usia</th>
                    <th class="py-2.5 px-3 whitespace-nowrap">Status PB/U–TB/U</th>
                    <th class="py-2.5 px-4 text-right whitespace-nowrap">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">

                    @forelse($logGiziList as $log)
                    <tr class="hover:bg-rose-50/40 transition-colors">
                        <td class="py-2.5 px-4 font-medium text-stone-900 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-stone-100 text-stone-700 font-bold text-[10px] flex items-center justify-center shrink-0">
                            {{ mb_strtoupper(mb_substr($log->balita?->nama_balita ?? $log->nama_balita, 0, 1)) }}
                            </div>
                            <div>
                            <span class="block text-xs font-semibold text-stone-800">{{ $log->balita?->nama_balita ?? $log->nama_balita }}</span>
                            </div>
                        </div>
                        </td>
                        <td class="py-2.5 px-2 text-[11px] font-medium text-stone-600 whitespace-nowrap">{{ $log->umur_bulan }} bln</td>
                        <td class="py-2.5 px-3 whitespace-nowrap">
                        @if($log->z_score_tbu === null)
                            <span class="text-stone-500 text-[10px]">Belum tersedia</span>
                        @elseif($log->z_score_tbu < -3)
                            <span class="text-red-700 font-semibold text-[10px]">Sangat pendek</span>
                        @elseif($log->z_score_tbu < -2)
                            <span class="text-red-700 font-semibold text-[10px]">Pendek (stunting)</span>
                        @elseif($log->z_score_tbu <= 3)
                            <span class="text-emerald-700 font-semibold text-[10px]">Normal</span>
                        @else
                            <span class="text-amber-700 font-semibold text-[10px]">Tinggi</span>
                        @endif
                        </td>
                        <td class="py-2.5 px-4 text-right text-[10px] text-stone-400 whitespace-nowrap">{{ $log->tanggal_pengukuran?->format('d/m/Y') ?? $log->created_at?->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-stone-400 text-xs">Belum ada riwayat pemeriksaan.</td>
                    </tr>
                    @endforelse

                </tbody>
                </table>
            </div>
        </div>

        </section>
@endsection
