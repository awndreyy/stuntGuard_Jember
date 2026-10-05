<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Gizi - StuntGuard Jember</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        teal: { 750: '#0f6157', 800: '#115e59', 900: '#134e4a' }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

        <!-- Header Component -->
        <x-admin.header searchPlaceholder="Ketik nama balita atau pengukuran..." />

        <!-- Main Content Canvas -->
        <main class="flex-1 overflow-y-auto p-3.5 sm:p-5 flex flex-col gap-3.5 max-w-full">

            <!-- Top Row: Title -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 shrink-0">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold tracking-tight text-slate-900 flex items-center gap-2">
                        Kalkulator Gizi & Stunting Balita
                    </h1>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Hitung dan simulasikan status gizi balita berdasarkan indikator standar WHO.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                <!-- Form Kalkulator (Kiri) -->
                <div class="lg:col-span-7 bg-white rounded-xl border border-slate-200/80 shadow-2xs p-4 sm:p-5">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-800 flex items-center justify-center">
                            <i data-lucide="calculator" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Form Pengukuran Balita</h2>
                            <p class="text-[11px] text-slate-400">Masukkan data fisik balita untuk mengecek status gizi</p>
                        </div>
                    </div>

                    <form action="{{ route('kalkulator.calculate') }}" method="POST" class="space-y-3.5">
                        @csrf

                        <!-- Nama Balita -->
                        <div>
                            <label for="nama" class="block text-xs font-semibold text-slate-700 mb-1">Nama Balita <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" required value="{{ old('nama', $hasil['nama'] ?? '') }}" placeholder="Contoh: Ananda Ahmad" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-teal-800">
                        </div>

                        <!-- Jenis Kelamin & Usia -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="jenis_kelamin" class="block text-xs font-semibold text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-teal-800 bg-white">
                                    <option value="L" {{ (old('jenis_kelamin', $hasil['jenis_kelamin'] ?? '') == 'Laki-laki' || old('jenis_kelamin') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ (old('jenis_kelamin', $hasil['jenis_kelamin'] ?? '') == 'Perempuan' || old('jenis_kelamin') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label for="usia_bulan" class="block text-xs font-semibold text-slate-700 mb-1">Usia (Bulan) <span class="text-red-500">*</span></label>
                                <input type="number" name="usia_bulan" id="usia_bulan" min="0" max="60" required value="{{ old('usia_bulan', $hasil['usia_bulan'] ?? '') }}" placeholder="0 - 60 Bulan" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-teal-800">
                            </div>
                        </div>

                        <!-- Berat & Tinggi Badan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="berat" class="block text-xs font-semibold text-slate-700 mb-1">Berat Badan (kg) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.1" name="berat" id="berat" required value="{{ old('berat', $hasil['berat'] ?? '') }}" placeholder="Contoh: 10.5" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-teal-800">
                            </div>

                            <div>
                                <label for="tinggi" class="block text-xs font-semibold text-slate-700 mb-1">Tinggi / Panjang Badan (cm) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.1" name="tinggi" id="tinggi" required value="{{ old('tinggi', $hasil['tinggi'] ?? '') }}" placeholder="Contoh: 78.0" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-teal-800">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full py-2.5 bg-teal-800 hover:bg-teal-900 text-white text-xs font-semibold rounded-lg transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="scale" class="w-4 h-4"></i>
                                <span>Hitung Status Gizi</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Hasil Kalkulasi (Kanan) -->
                <div class="lg:col-span-5 flex flex-col gap-4">
                    <div class="bg-white rounded-xl border border-slate-200/80 shadow-2xs p-4 sm:p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-3 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                    <i data-lucide="activity" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h2 class="text-sm font-bold text-slate-900">Hasil Analisis</h2>
                                    <p class="text-[11px] text-slate-400">Ringkasan status pertumbuhan anak</p>
                                </div>
                            </div>

                            @if(isset($hasil))
                                <div class="space-y-3">
                                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100 text-xs space-y-1.5">
                                        <div class="flex justify-between"><span class="text-slate-500">Nama Balita:</span> <span class="font-bold text-slate-800">{{ $hasil['nama'] }}</span></div>
                                        <div class="flex justify-between"><span class="text-slate-500">Jenis Kelamin:</span> <span class="font-medium text-slate-700">{{ $hasil['jenis_kelamin'] }}</span></div>
                                        <div class="flex justify-between"><span class="text-slate-500">Usia:</span> <span class="font-medium text-slate-700">{{ $hasil['usia_bulan'] }} Bulan</span></div>
                                        <div class="flex justify-between"><span class="text-slate-500">Berat / Tinggi:</span> <span class="font-medium text-slate-700">{{ $hasil['berat'] }} kg / {{ $hasil['tinggi'] }} cm</span></div>
                                    </div>

                                    <div class="p-4 rounded-xl bg-{{ $hasil['badge_color'] }}-50 border border-{{ $hasil['badge_color'] }}-200 text-center">
                                        <span class="block text-[11px] font-semibold text-{{ $hasil['badge_color'] }}-800 uppercase tracking-wider mb-1">Indikator Stunting (TB/U)</span>
                                        <h3 class="text-base font-bold text-{{ $hasil['badge_color'] }}-900">{{ $hasil['status_stunting'] }}</h3>
                                    </div>
                                </div>
                            @else
                                <div class="py-12 text-center text-slate-400 text-xs flex flex-col items-center justify-center gap-2">
                                    <i data-lucide="clipboard-list" class="w-10 h-10 text-slate-300"></i>
                                    <p>Isi form di samping dan klik <b>Hitung Status Gizi</b> untuk melihat hasil analisis.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Info Card -->
                        <div class="mt-4 p-3 bg-teal-50/60 rounded-lg border border-teal-100 flex items-start gap-2.5">
                            <i data-lucide="info" class="w-4 h-4 text-teal-800 shrink-0 mt-0.5"></i>
                            <p class="text-[11px] text-teal-900 leading-relaxed">
                                Pengukuran ini berdasarkan standar pertumbuhan anak balita WHO. Hasil dapat disimpan ke rekam medis balita.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <footer class="text-center py-1">
                <span class="text-[10px] text-rose-700/80 hidden xl:inline text-center">© 2026 StuntGuard Jember</span>
            </footer>

        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>