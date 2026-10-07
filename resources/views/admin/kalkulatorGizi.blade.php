@extends('layouts.admin')

@section('title', 'Kalkulator Gizi')

@section('content')
    <!-- Top Row: Title -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 shrink-0">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-lg sm:text-xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                    Kalkulator Gizi & Stunting Balita
                </h1>
            </div>
            <p class="text-xs text-stone-500 mt-0.5">
                Hitung dan simulasikan status gizi serta deteksi dini risiko stunting balita berdasarkan indikator TB/U WHO.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

        <!-- Form Kalkulator (Kiri) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-stone-200 shadow-2xs p-4 sm:p-5">
            <div class="flex items-center gap-2 mb-4 pb-3 border-b border-stone-100">
                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center">
                    <i data-lucide="calculator" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-stone-900">Form Pengukuran Balita</h2>
                </div>
            </div>

            <form action="{{ route('kalkulator.calculate') }}" method="POST" class="space-y-3.5" id="kalkulatorForm">
                @csrf

                <!-- Nama Balita (Searchable Dropdown / Manual Input) -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold text-stone-700">
                            Nama Balita <span class="text-rose-500">*</span>
                        </label>
                    </div>

                    <div class="relative" id="balitaSelectWrapper">
                        <!-- Hidden input yang dikirim ke controller -->
                        <input type="hidden" name="nama" id="inputNamaBalita" required value="{{ old('nama', $hasil['nama'] ?? '') }}">

                        <!-- Trigger Button Dropdown -->
                        <button
                            type="button"
                            id="balitaSelectTrigger"
                            onclick="toggleBalitaDropdown()"
                            class="w-full flex items-center justify-between px-3 py-2 text-xs bg-white border {{ $errors->has('nama') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 transition-all cursor-pointer text-left shadow-2xs hover:bg-stone-50/60"
                        >
                            <div class="flex items-center gap-2.5 truncate">
                                <div class="w-6 h-6 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center shrink-0">
                                    <i data-lucide="baby" class="w-3.5 h-3.5"></i>
                                </div>
                                <div class="truncate">
                                    <span id="selectedBalitaText" class="{{ old('nama', $hasil['nama'] ?? '') ? 'font-semibold text-stone-800' : 'text-stone-400' }} truncate block">
                                        {{ old('nama', $hasil['nama'] ?? 'Pilih nama balita yang terdaftar...') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <i data-lucide="chevron-down" id="balitaSelectChevron" class="w-4 h-4 text-stone-400 transition-transform duration-200"></i>
                            </div>
                        </button>

                        <!-- Dropdown Content (Searchable List) -->
                        <div
                            id="balitaDropdownMenu"
                            class="absolute left-0 right-0 top-full mt-1.5 bg-white border border-stone-200 rounded-xl shadow-xl z-30 hidden overflow-hidden transition-all"
                        >
                            <!-- Search Field in Dropdown -->
                            <div class="p-2 border-b border-stone-100 bg-stone-50/70">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-stone-400">
                                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="balitaSearchInput"
                                        oninput="filterBalitas(this.value)"
                                        placeholder="Ketik nama balita, NIK, atau nama orang tua..."
                                        class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-1 focus:ring-rose-700 focus:border-rose-700"
                                    >
                                </div>

                                <!-- Opsi Gunakan Nama Manual -->
                                <div id="manualNameAction" class="mt-1.5 hidden">
                                    <button
                                        type="button"
                                        onclick="selectManualName()"
                                        class="w-full text-left px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-[11px] font-semibold flex items-center gap-1.5 transition-colors cursor-pointer"
                                    >
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5 shrink-0"></i>
                                        <span class="truncate">Gunakan nama manual: "<span id="manualNamePreview"></span>"</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Options List -->
                            <div id="balitaOptionsList" class="max-h-56 overflow-y-auto divide-y divide-stone-50 py-1">
                                @if(isset($balitas) && count($balitas) > 0)
                                    @foreach($balitas as $balitaItem)
                                        <button
                                            type="button"
                                            onclick="selectBalita('{{ addslashes($balitaItem->nama_balita) }}', '{{ $balitaItem->jenis_kelamin }}', '{{ $balitaItem->tanggal_lahir }}', '{{ addslashes($balitaItem->orangTua->name ?? 'Tidak ada data') }}', '{{ $balitaItem->nik ?? '-' }}')"
                                            class="balita-option w-full text-left px-3 py-2.5 hover:bg-rose-50/70 transition-colors flex items-center justify-between gap-2.5 cursor-pointer"
                                            data-nama="{{ strtolower($balitaItem->nama_balita) }}"
                                            data-nik="{{ strtolower($balitaItem->nik ?? '') }}"
                                            data-parent="{{ strtolower($balitaItem->orangTua->name ?? '') }}"
                                        >
                                            <div class="flex items-center gap-2.5 min-w-0">
                                                <div class="w-7 h-7 rounded-full {{ $balitaItem->jenis_kelamin === 'Laki-laki' ? 'bg-sky-100 text-sky-700' : 'bg-rose-100 text-rose-700' }} font-bold text-[10px] flex items-center justify-center shrink-0">
                                                    {{ strtoupper(substr($balitaItem->nama_balita, 0, 2)) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="flex items-center gap-1.5">
                                                        <p class="text-xs font-semibold text-stone-800 truncate">{{ $balitaItem->nama_balita }}</p>
                                                        <span class="text-[9px] font-semibold px-1.5 py-0.2 rounded {{ $balitaItem->jenis_kelamin === 'Laki-laki' ? 'bg-sky-50 text-sky-700 border border-sky-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                                            {{ $balitaItem->jenis_kelamin }}
                                                        </span>
                                                    </div>
                                                    <p class="text-[10px] text-stone-400 truncate mt-0.5">
                                                        Ortu: <strong class="font-medium text-stone-600">{{ $balitaItem->orangTua->name ?? '-' }}</strong> • Lahir: {{ \Carbon\Carbon::parse($balitaItem->tanggal_lahir)->translatedFormat('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <span class="text-[10px] px-2 py-1 rounded-lg bg-stone-100 text-stone-600 shrink-0 font-semibold group-hover:bg-rose-700 group-hover:text-white transition-colors">
                                                Pilih
                                            </span>
                                        </button>
                                    @endforeach
                                @else
                                    <div class="px-3 py-4 text-center text-xs text-stone-400">
                                        Belum ada data balita terdaftar
                                    </div>
                                @endif
                                <div id="noBalitaMatch" class="px-3 py-4 text-center text-xs text-stone-400 hidden">
                                    Tidak ada balita terdaftar yang cocok dengan pencarian
                                </div>
                            </div>
                        </div>
                    </div>

                    @error('nama')
                        <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Jenis Kelamin & Usia -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="jenis_kelamin" class="block text-xs font-semibold text-stone-700 mb-1">Jenis Kelamin <span class="text-rose-500">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full px-3 py-2 text-xs border border-stone-200 rounded-xl focus:outline-none focus:border-rose-700 focus:ring-1 focus:ring-rose-700 bg-white transition-all">
                            <option value="L" {{ (old('jenis_kelamin', $hasil['jenis_kelamin'] ?? '') == 'Laki-laki' || old('jenis_kelamin') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ (old('jenis_kelamin', $hasil['jenis_kelamin'] ?? '') == 'Perempuan' || old('jenis_kelamin') == 'P') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="usia_bulan" class="block text-xs font-semibold text-stone-700">Usia (Bulan) <span class="text-rose-500">*</span></label>
                            <span id="usiaAutoBadge" class="text-[10px] text-emerald-600 font-medium hidden">✓ Otomatis terhitung</span>
                        </div>
                        <input type="text" inputmode="numeric" name="usia_bulan" id="usia_bulan" min="1" max="60" maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required value="{{ old('usia_bulan', $hasil['usia_bulan'] ?? '') }}" placeholder="0 - 60 Bulan" class="w-full px-3 py-2 text-xs border border-stone-200 {{ $errors->has('usia_bulan') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl focus:outline-none focus:border-rose-700 focus:ring-1 focus:ring-rose-700 bg-white transition-all">
                        @error('usia_bulan')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Berat & Tinggi Badan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="berat" class="block text-xs font-semibold text-stone-700 mb-1">Berat Badan (kg) <span class="text-rose-500">*</span></label>
                        <input type="text" inputmode="numeric" step="0.1" name="berat" id="berat" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required value="{{ old('berat', $hasil['berat'] ?? '') }}" placeholder="min: 1" class="w-full px-3 py-2 text-xs border border-stone-200 {{ $errors->has('berat') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl focus:outline-none focus:border-rose-700 focus:ring-1 focus:ring-rose-700 bg-white transition-colors">
                    </div>

                    <div>
                        <label for="tinggi" class="block text-xs font-semibold text-stone-700 mb-1">Tinggi / Panjang Badan (cm) <span class="text-rose-500">*</span></label>
                        <input type="text" inputmode="numeric" step="0.1" name="tinggi" id="tinggi" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required value="{{ old('tinggi', $hasil['tinggi'] ?? '') }}" placeholder="min: 20" class="w-full px-3 py-2 text-xs border border-stone-200 {{ $errors->has('tinggi') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl focus:outline-none focus:border-rose-700 focus:ring-1 focus:ring-rose-700 bg-white transition-colors">
                    </div>
                    @error('berat')
                        <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                    @error('tinggi')
                        <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Posisi Pengukuran (Terlentang / Berdiri) -->
                <div>
                    <label class="block text-xs font-semibold text-stone-700 mb-1.5">
                        Posisi Pengukuran <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-2.5">
                        <label class="relative flex items-center gap-2.5 p-2.5 border rounded-xl cursor-pointer transition-all border-stone-200 bg-white hover:bg-stone-50/80">
                            <input type="radio" name="posisi_badan" id="posisi_terlentang" value="terlentang" class="text-rose-700 focus:ring-rose-700 w-3.5 h-3.5 border-stone-300" {{ old('posisi_badan', $hasil['posisi_badan'] ?? 'terlentang') === 'terlentang' ? 'checked' : '' }}>
                            <div>
                                <span class="block text-xs font-semibold text-stone-800 leading-tight">Terlentang</span>
                                <span class="block text-[10px] text-stone-400 mt-0.5">Berbaring (0 - 23 Bulan)</span>
                            </div>
                        </label>
                        <label class="relative flex items-center gap-2.5 p-2.5 border rounded-xl cursor-pointer transition-all border-stone-200 bg-white hover:bg-stone-50/80">
                            <input type="radio" name="posisi_badan" id="posisi_berdiri" value="berdiri" class="text-rose-700 focus:ring-rose-700 w-3.5 h-3.5 border-stone-300" {{ old('posisi_badan', $hasil['posisi_badan'] ?? '') === 'berdiri' ? 'checked' : '' }}>
                            <div>
                                <span class="block text-xs font-semibold text-stone-800 leading-tight">Berdiri</span>
                                <span class="block text-[10px] text-stone-400 mt-0.5">Tegak (≥ 24 Bulan)</span>
                            </div>
                        </label>
                    </div>
                    @error('posisi_badan')
                        <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Lingkar Kepala & Lingkar Lengan Atas (LiLA) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="lingkar_kepala" class="block text-xs font-semibold text-stone-700">Lingkar Kepala (cm)</label>
                            <span class="text-[10px] text-stone-400">Opsional</span>
                        </div>
                        <input type="text" inputmode="numeric" step="0.1" name="lingkar_kepala" id="lingkar_kepala" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" value="{{ old('lingkar_kepala', $hasil['lingkar_kepala'] ?? '') }}" placeholder="Contoh: 45.0" class="w-full px-3 py-2 text-xs border border-stone-200 {{ $errors->has('lingkar_kepala') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl focus:outline-none focus:border-rose-700 focus:ring-1 focus:ring-rose-700 bg-white transition-colors">
                        @error('lingkar_kepala')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="lila" class="block text-xs font-semibold text-stone-700">Lingkar Lengan Atas (LiLA) (cm)</label>
                            <span class="text-[10px] text-stone-400">Opsional</span>
                        </div>
                        <input type="text" inputmode="numeric" step="0.1" name="lila" id="lila" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" value="{{ old('lila', $hasil['lila'] ?? '') }}" placeholder="Contoh: 14.5" class="w-full px-3 py-2 text-xs border border-stone-200 {{ $errors->has('lila') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl focus:outline-none focus:border-rose-700 focus:ring-1 focus:ring-rose-700 bg-white transition-colors">
                        @error('lila')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 bg-rose-700 hover:bg-rose-600 text-white text-xs font-semibold rounded-xl transition-all shadow-sm hover:shadow flex items-center justify-center gap-2 cursor-pointer">
                        <i data-lucide="scale" class="w-4 h-4"></i>
                        <span>Hitung Status Gizi</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Hasil Kalkulasi (Kanan) -->
        <div class="lg:col-span-5 flex flex-col gap-4">
            <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs p-4 sm:p-5 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-3 pb-3 border-b border-stone-100">
                        <div class="w-8 h-8 rounded-lg bg-stone-100 text-stone-700 flex items-center justify-center">
                            <i data-lucide="activity" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-stone-900">Hasil Analisis</h2>
                            <p class="text-[11px] text-stone-400">Ringkasan status pertumbuhan anak</p>
                        </div>
                    </div>

                    @if(isset($hasil))
                        <div class="space-y-3">
                            <div class="bg-stone-50 p-3.5 rounded-xl border border-stone-100 text-xs space-y-2">
                                <div class="flex justify-between items-center"><span class="text-stone-500">Nama Balita:</span> <span class="font-bold text-stone-800">{{ $hasil['nama'] }}</span></div>
                                <div class="flex justify-between items-center"><span class="text-stone-500">Jenis Kelamin:</span> <span class="font-medium text-stone-700">{{ $hasil['jenis_kelamin'] }}</span></div>
                                <div class="flex justify-between items-center"><span class="text-stone-500">Usia:</span> <span class="font-medium text-stone-700">{{ $hasil['usia_bulan'] }} Bulan</span></div>
                                <div class="flex justify-between items-center"><span class="text-stone-500">Berat / Tinggi:</span> <span class="font-medium text-stone-700">{{ $hasil['berat'] }} kg / {{ $hasil['tinggi'] }} cm</span></div>
                                @if(!empty($hasil['posisi_badan']))
                                    <div class="flex justify-between items-center"><span class="text-stone-500">Posisi Ukur:</span> <span class="font-medium text-stone-700 capitalize">{{ $hasil['posisi_badan'] }}</span></div>
                                @endif
                                @if(!empty($hasil['lingkar_kepala']))
                                    <div class="flex justify-between items-center"><span class="text-stone-500">Lingkar Kepala:</span> <span class="font-medium text-stone-700">{{ $hasil['lingkar_kepala'] }} cm</span></div>
                                @endif
                                @if(!empty($hasil['lila']))
                                    <div class="flex justify-between items-center"><span class="text-stone-500">LiLA:</span> <span class="font-medium text-stone-700">{{ $hasil['lila'] }} cm</span></div>
                                @endif
                                @if(isset($hasil['z_score']))
                                    <div class="flex justify-between items-center pt-1 border-t border-stone-200/60"><span class="text-stone-500">Z-Score (TB/U):</span> <span class="font-semibold text-stone-700">{{ $hasil['z_score'] }} SD</span></div>
                                @endif
                            </div>

                            @php
                                $badgeStyles = match($hasil['badge_color'] ?? 'emerald') {
                                    'rose' => 'bg-rose-50 border-rose-200 text-rose-700 title-text-rose-900',
                                    'amber' => 'bg-amber-50 border-amber-200 text-amber-700 title-text-amber-900',
                                    'teal' => 'bg-teal-50 border-teal-200 text-teal-700 title-text-teal-900',
                                    default => 'bg-emerald-50 border-emerald-200 text-emerald-700 title-text-emerald-900',
                                };
                                $titleTextColor = match($hasil['badge_color'] ?? 'emerald') {
                                    'rose' => 'text-rose-900',
                                    'amber' => 'text-amber-900',
                                    'teal' => 'text-teal-900',
                                    default => 'text-emerald-900',
                                };
                                $subtitleTextColor = match($hasil['badge_color'] ?? 'emerald') {
                                    'rose' => 'text-rose-700',
                                    'amber' => 'text-amber-700',
                                    'teal' => 'text-teal-700',
                                    default => 'text-emerald-700',
                                };
                            @endphp

                            <div class="p-4 rounded-xl border {{ $badgeStyles }} text-center">
                                <span class="block text-[11px] font-semibold {{ $subtitleTextColor }} uppercase tracking-wider mb-1">Indikator Stunting (TB/U)</span>
                                <h3 class="text-base font-bold {{ $titleTextColor }}">{{ $hasil['status_stunting'] }}</h3>
                            </div>
                        </div>
                    @else
                        <div class="py-12 text-center text-stone-400 text-xs flex flex-col items-center justify-center gap-2">
                            <i data-lucide="clipboard-list" class="w-10 h-10 text-stone-300"></i>
                            <p>Isi form di samping dan klik <b>Hitung Status Gizi</b> untuk melihat hasil analisis.</p>
                        </div>
                    @endif
                </div>

                <!-- Info Card -->
                <div class="mt-4 p-3 bg-rose-50/70 rounded-xl border border-rose-100 flex items-start gap-2.5">
                    <i data-lucide="info" class="w-4 h-4 text-rose-700 shrink-0 mt-0.5"></i>
                    <p class="text-[11px] text-rose-950 leading-relaxed">
                        Pengukuran ini berdasarkan standar baku antropometri pertumbuhan anak balita WHO (Permenkes RI).
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script>
    function toggleBalitaDropdown() {
        const menu = document.getElementById('balitaDropdownMenu');
        const chevron = document.getElementById('balitaSelectChevron');
        const searchInput = document.getElementById('balitaSearchInput');

        if (!menu) return;

        const isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            if (chevron) chevron.classList.add('rotate-180');
            if (searchInput) {
                searchInput.value = '';
                filterBalitas('');
                setTimeout(() => searchInput.focus(), 50);
            }
        } else {
            menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    }

    function filterBalitas(query) {
        const normalized = query.toLowerCase().trim();
        const options = document.querySelectorAll('.balita-option');
        const manualAction = document.getElementById('manualNameAction');
        const manualPreview = document.getElementById('manualNamePreview');
        const noMatch = document.getElementById('noBalitaMatch');
        let visibleCount = 0;

        options.forEach(opt => {
            const nama = opt.getAttribute('data-nama') || '';
            const nik = opt.getAttribute('data-nik') || '';
            const parent = opt.getAttribute('data-parent') || '';

            if (nama.includes(normalized) || nik.includes(normalized) || parent.includes(normalized)) {
                opt.style.display = '';
                visibleCount++;
            } else {
                opt.style.display = 'none';
            }
        });

        if (noMatch) {
            noMatch.classList.toggle('hidden', visibleCount > 0);
        }

        if (manualAction && manualPreview) {
            if (normalized.length > 0) {
                manualPreview.textContent = query.trim();
                manualAction.classList.remove('hidden');
            } else {
                manualAction.classList.add('hidden');
            }
        }
    }

    function selectBalita(nama, gender, birthDate, parentName, nik) {
        // Set nama balita
        const inputNama = document.getElementById('inputNamaBalita');
        const selectedText = document.getElementById('selectedBalitaText');
        const badge = document.getElementById('balitaSelectionBadge');

        if (inputNama) inputNama.value = nama;
        if (selectedText) {
            selectedText.textContent = nama;
            selectedText.className = 'font-semibold text-stone-800 truncate block';
        }
        if (badge) {
            badge.textContent = `Orang Tua: ${parentName}`;
            badge.className = 'text-[10px] font-semibold text-rose-700 truncate';
        }

        // Auto-select jenis kelamin
        const selectJk = document.getElementById('jenis_kelamin');
        if (selectJk) {
            if (gender === 'Laki-laki' || gender === 'L') {
                selectJk.value = 'L';
            } else if (gender === 'Perempuan' || gender === 'P') {
                selectJk.value = 'P';
            }
            // Flash effect
            highlightField(selectJk);
        }

        // Auto-calculate usia bulan dari tanggal lahir
        if (birthDate) {
            const inputUsia = document.getElementById('usia_bulan');
            const usiaBadge = document.getElementById('usiaAutoBadge');
            const calculatedMonths = calculateAgeInMonths(birthDate);

            if (inputUsia) {
                inputUsia.value = calculatedMonths;
                highlightField(inputUsia);
            }
            if (usiaBadge) {
                usiaBadge.classList.remove('hidden');
            }

            // Auto-pilih posisi pengukuran (0-23 bln: Terlentang, >= 24 bln: Berdiri)
            const radioTerlentang = document.getElementById('posisi_terlentang');
            const radioBerdiri = document.getElementById('posisi_berdiri');
            if (calculatedMonths < 24 && radioTerlentang) {
                radioTerlentang.checked = true;
            } else if (calculatedMonths >= 24 && radioBerdiri) {
                radioBerdiri.checked = true;
            }
        }

        toggleBalitaDropdown();
        if (window.lucide) lucide.createIcons();
    }

    function selectManualName() {
        const searchInput = document.getElementById('balitaSearchInput');
        const customName = searchInput ? searchInput.value.trim() : '';

        if (!customName) return;

        const inputNama = document.getElementById('inputNamaBalita');
        const selectedText = document.getElementById('selectedBalitaText');
        const badge = document.getElementById('balitaSelectionBadge');
        const usiaBadge = document.getElementById('usiaAutoBadge');

        if (inputNama) inputNama.value = customName;
        if (selectedText) {
            selectedText.textContent = customName;
            selectedText.className = 'font-semibold text-stone-800 truncate block';
        }
        if (badge) {
            badge.textContent = 'Input manual (Belum terdaftar)';
            badge.className = 'text-[10px] font-medium text-amber-600';
        }
        if (usiaBadge) {
            usiaBadge.classList.add('hidden');
        }

        toggleBalitaDropdown();
    }

    function calculateAgeInMonths(birthDateStr) {
        const birth = new Date(birthDateStr);
        const today = new Date();

        let months = (today.getFullYear() - birth.getFullYear()) * 12;
        months += (today.getMonth() - birth.getMonth());

        if (today.getDate() < birth.getDate()) {
            months--;
        }

        return Math.max(0, Math.min(60, months));
    }

    function highlightField(el) {
        el.classList.add('ring-2', 'ring-rose-400', 'bg-rose-50/50');
        setTimeout(() => {
            el.classList.remove('ring-2', 'ring-rose-400', 'bg-rose-50/50');
        }, 1000);
    }

    // Close dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('balitaSelectWrapper');
        const menu = document.getElementById('balitaDropdownMenu');
        const chevron = document.getElementById('balitaSelectChevron');

        if (wrapper && menu && !wrapper.contains(e.target)) {
            menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    });
</script>
@endpush
