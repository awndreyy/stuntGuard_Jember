@extends('layouts.guest')
@section('title', 'StuntGuard Jember - Pemantauan Tumbuh Kembang & Gizi Balita')

@section('content')
    {{-- Hero: warna solid, ilustrasi dari aset lokal, CTA tetap menuju bagian yang sama. --}}
    <section class="border-b border-pink-100 bg-[#FFF8FB] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-[1200px] px-4 md:px-8 lg:px-12">
            <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-7">
                    <h1 class="max-w-[720px] text-3xl font-extrabold leading-tight tracking-tight text-stone-900 sm:text-4xl lg:text-[44px] lg:leading-[1.16]">
                        Pantau Tumbuh Kembang &amp; Gizi Si Kecil dengan
                        <span class="text-pink-600">Kasih Sayang</span>
                    </h1>
                    <p class="mt-5 max-w-xl text-sm leading-7 text-stone-700 sm:text-base">
                        Aplikasi kesehatan digital untuk Ayah &amp; Bunda di Jember. Cek status gizi balita berdasarkan referensi pertumbuhan WHO dan temukan inspirasi resep MPASI.
                    </p>
                    <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                        <a href="#kalkulator-widget" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-pink-600 px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-pink-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">
                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">calculate</span>
                            Cek Gizi Anak Sekarang
                        </a>
                        <a href="#resep-mpasi" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl border border-pink-200 bg-white px-6 py-3 text-sm font-bold text-pink-700 transition-colors hover:border-pink-300 hover:bg-pink-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">
                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">restaurant_menu</span>
                            Lihat Resep MPASI
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <div class="mx-auto max-w-[380px] rounded-[28px] border border-pink-200 bg-white p-5 sm:p-7">
                        <div class="rounded-2xl bg-pink-50 p-6 sm:p-8">
                            <img src="{{ asset('images/logo-StuntGuard.png') }}" alt="Ilustrasi anak sehat StuntGuard" class="mx-auto aspect-square w-full max-w-[245px] rounded-2xl object-contain" decoding="async">
                        </div>
                        <div class="mt-5 flex items-center justify-between gap-3">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-pink-700">Pendamping keluarga</p>
                                <p class="mt-1 text-sm font-semibold text-stone-800">Ukur, pahami, dan pantau tumbuh kembang</p>
                            </div>
                            <span class="material-symbols-outlined shrink-0 text-[30px] text-pink-600" aria-hidden="true">child_care</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-3 sm:grid-cols-3">
                <div class="flex items-center gap-3 rounded-2xl border border-pink-100 bg-white px-5 py-4">
                    <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-pink-50 text-pink-700"><span class="material-symbols-outlined" aria-hidden="true">child_care</span></span>
                    <div><p class="text-xl font-extrabold text-stone-900">{{ number_format($jumlahBalita, 0, ',', '.') }}</p><p class="text-xs font-medium text-stone-600">Balita terpantau</p></div>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-pink-100 bg-white px-5 py-4">
                    <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-pink-50 text-pink-700"><span class="material-symbols-outlined" aria-hidden="true">restaurant_menu</span></span>
                    <div><p class="text-xl font-extrabold text-stone-900">{{ number_format($jumlahResep, 0, ',', '.') }}</p><p class="text-xs font-medium text-stone-600">Resep MPASI tersedia</p></div>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-pink-100 bg-white px-5 py-4">
                    <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-pink-50 text-pink-700"><span class="material-symbols-outlined" aria-hidden="true">article</span></span>
                    <div><p class="text-xl font-extrabold text-stone-900">{{ number_format($jumlahArtikel, 0, ',', '.') }}</p><p class="text-xs font-medium text-stone-600">Artikel kesehatan</p></div>
                </div>
            </div>
        </div>
    </section>

    <section id="kalkulator-widget" class="py-16 bg-white border-y border-pink-100 scroll-mt-20">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <div class="inline-flex items-center gap-1.5 bg-pink-100 text-pink-700 px-3.5 py-1 rounded-full text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>Referensi pertumbuhan WHO</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">Kalkulator Cek Gizi Balita</h2>
                <p class="text-sm text-stone-600 mt-2">
                    Masukkan data pengukuran untuk melihat hasil Z-score berdasarkan tabel WHO. Hasil ini merupakan skrining awal, bukan diagnosis medis.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch bg-pink-50 p-5 sm:p-8 rounded-3xl border border-pink-200/80">
                <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-2xl border border-pink-100 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2.5 pb-4 mb-6 border-b border-pink-100">
                            <span class="w-7 h-7 rounded-full bg-pink-500 text-white text-xs font-bold flex items-center justify-center">1</span>
                            <h3 class="text-base sm:text-lg font-bold text-stone-900">Masukkan Data Ukuran Anak</h3>
                        </div>

                        <form id="nutriForm" class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-stone-700 mb-2">Pilih Jenis Kelamin Anak</label>
                                <div class="grid grid-cols-2 gap-2.5 bg-pink-50/70 p-1.5 rounded-2xl border border-pink-100">
                                    <button id="btnBoy" type="button" onclick="setGender('boy')" class="py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center gap-1.5 bg-pink-600 text-white transition-colors cursor-pointer" aria-pressed="true">
                                        <span class="material-symbols-outlined text-[18px]">male</span>
                                        <span>Laki-laki</span>
                                    </button>
                                    <button id="btnGirl" type="button" onclick="setGender('girl')" class="py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center gap-1.5 text-stone-600 hover:text-pink-600 transition-all cursor-pointer" aria-pressed="false">
                                        <span class="material-symbols-outlined text-[18px]">female</span>
                                        <span>Perempuan</span>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="inputAge" class="block text-sm font-bold text-stone-700 mb-1.5">Usia Saat Ini</label>
                                    <div class="relative">
                                        <input id="inputAge" type="number" min="0" max="60" value="14" required class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 pr-14 text-base font-bold text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-stone-400">Bulan</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="inputWeight" class="block text-sm font-bold text-stone-700 mb-1.5">Berat Badan</label>
                                    <div class="relative">
                                        <input id="inputWeight" type="number" step="0.1" min="1" max="50" value="9.8" required class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 pr-12 text-base font-bold text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-stone-400">kg</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="inputHeight" class="block text-sm font-bold text-stone-700 mb-1.5">Tinggi / Panjang Badan</label>
                                    <div class="relative">
                                        <input id="inputHeight" type="number" step="0.1" min="30" max="130" value="78" required class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 pr-12 text-base font-bold text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-stone-400">cm</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="inputPosition" class="block text-sm font-bold text-stone-700 mb-1.5">Posisi Pengukuran</label>
                                <select id="inputPosition" class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 text-sm text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                                    <option value="terlentang">Terlentang (panjang badan)</option>
                                    <option value="berdiri">Berdiri (tinggi badan)</option>
                                </select>
                                <p class="text-xs text-stone-600 mt-1">Untuk usia di bawah 24 bulan gunakan panjang badan; usia 24 bulan ke atas gunakan tinggi badan. Sistem melakukan koreksi 0,7 cm jika posisi tidak sesuai.</p>
                            </div>

                            <p id="guestCalcError" role="alert" aria-live="polite" class="hidden text-xs text-rose-700"></p>

                            <div class="pt-2">
                                <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-sm font-bold flex items-center justify-center gap-2 transition-all cursor-pointer">
                                    <span class="material-symbols-outlined text-[20px]">analytics</span>
                                    <span>Hitung Z-score WHO</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <p class="text-xs text-stone-600 mt-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">info</span>
                        <span>Untuk anak di bawah 24 bulan, tinggi badan diukur secara terlentang.</span>
                    </p>
                </div>

                <div id="resultBox" class="lg:col-span-5 bg-white p-4 sm:p-5 rounded-2xl border border-stone-200 transition-all duration-300">
                    <div class="flex items-start gap-2.5 mb-3">
                        <div class="w-9 h-9 rounded-xl bg-stone-100 text-stone-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">monitor_heart</span>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-stone-900">Hasil Analisis</h3>
                            <p class="text-xs text-stone-500">Ringkasan indikator dan posisi Z-score pertumbuhan</p>
                        </div>
                    </div>

                    <div class="rounded-xl bg-stone-50 border border-stone-200 p-4 sm:p-5">
                        <div class="grid grid-cols-[minmax(110px,auto)_1fr] gap-x-3 gap-y-1.5 text-xs sm:text-sm">
                            <div class="text-stone-700">Jenis Kelamin:</div>
                            <div id="resultGender" class="text-stone-900 text-right">-</div>

                            <div class="text-stone-600">Usia:</div>
                            <div id="resultAge" class="text-stone-900 text-right">-</div>

                            <div class="text-stone-600">Berat / Tinggi:</div>
                            <div id="resultMeasure" class="text-stone-900 text-right">-</div>

                            <div class="text-stone-600">Posisi Ukur:</div>
                            <div id="resultPosition" class="text-stone-900 text-right">-</div>
                        </div>

                        <div class="border-t border-stone-200 mt-3 pt-3">
                            <h4 class="text-xs sm:text-sm font-bold text-stone-900 mb-2.5">Indikator WHO (Z-score)</h4>
                            <div class="grid grid-cols-[minmax(90px,auto)_1fr] gap-x-3 gap-y-1.5 text-xs sm:text-sm">
                                <div class="text-stone-700">BB/U</div>
                                <div id="resultBbu" class="font-semibold text-stone-900 text-right">-</div>

                                <div id="resultHeightIndicatorLabel" class="text-stone-700">PB/U</div>
                                <div id="resultPbu" class="font-semibold text-stone-900 text-right">-</div>

                                <div id="resultWeightHeightIndicatorLabel" class="text-stone-700">BB/PB</div>
                                <div id="resultBbpb" class="font-semibold text-stone-900 text-right">-</div>

                                <div class="text-stone-700">LK/U</div>
                                <div id="resultLku" class="font-semibold text-stone-900 text-right">Tidak tersedia / di luar rentang</div>

                                <div class="text-stone-700">LiLA/U</div>
                                <div id="resultLilau" class="font-semibold text-stone-900 text-right">Tidak tersedia / di luar rentang</div>
                            </div>

                            <p id="correctedText" class="text-xs text-stone-500 mt-2.5">Panjang/tinggi terkoreksi: -</p>
                            <p id="calcNote" class="text-xs text-stone-600 mt-2 leading-relaxed">
                                Hasil merupakan skrining pertumbuhan, bukan diagnosis klinis. LiLA/U dan LK/U tidak digunakan sebagai diagnosis stunting.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4 border-t border-stone-200 mt-3 pt-3 text-sm sm:text-[15px]">
                        <span id="summaryIndicatorLabel" class="text-stone-500">Z-Score (PB/U):</span>
                        <span id="summaryIndicatorValue" class="font-bold text-stone-900">-</span>
                    </div>

                    {{-- Visualisasi hanya menggunakan nilai P(B)/U yang dikembalikan API, tidak menghitung ulang. --}}
                    <div id="zScorePanel" class="mt-4 rounded-xl border border-stone-200 bg-white p-4 sm:p-5" aria-live="polite">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h4 class="text-sm font-bold text-stone-900">Posisi Z-score tinggi menurut usia</h4>
                            <span id="zScoreVisualValue" class="rounded-lg bg-stone-100 px-2.5 py-1 text-sm font-bold text-stone-700">Belum dihitung</span>
                        </div>
                        <p class="mt-1 text-xs leading-relaxed text-stone-600">Penanda menunjukkan hasil PB/U atau TB/U pada skala −3 sampai +3 SD. Garis putus-putus menandai batas −2 SD.</p>
                        <div class="mt-5 px-2">
                            <div class="relative h-3 rounded-full bg-stone-200" aria-hidden="true">
                                <div class="absolute inset-y-0 left-0 w-[16.6667%] rounded-l-full bg-rose-200"></div>
                                <div class="absolute -top-1 bottom-[-4px] left-[16.6667%] border-l-2 border-dashed border-rose-500"></div>
                                <span id="zScoreMarker" class="absolute -top-[5px] hidden h-[22px] w-[4px] -translate-x-1/2 rounded-full bg-stone-900 ring-2 ring-white" style="left: 50%"></span>
                            </div>
                            <div class="relative mt-2 h-4 text-[11px] font-semibold tabular-nums text-stone-600">
                                <span class="absolute left-0">−3</span>
                                <span class="absolute left-[16.6667%] -translate-x-1/2">−2</span>
                                <span class="absolute left-1/2 -translate-x-1/2">0</span>
                                <span class="absolute left-[83.3333%] -translate-x-1/2">+2</span>
                                <span class="absolute right-0">+3</span>
                            </div>
                        </div>
                        <p id="zScoreVisualNote" class="mt-3 text-xs leading-relaxed text-stone-600">Isi data dan tekan Hitung Z-score WHO untuk melihat penanda.</p>
                    </div>
                    <div class="mt-4 rounded-xl border border-pink-100 bg-pink-50 p-4">
                        <p class="text-sm font-bold text-stone-900">Tentang standar WHO</p>
                        <p class="mt-1 text-xs leading-relaxed text-stone-700">PB/U dan TB/U dipakai untuk skrining pertumbuhan linier menurut usia. Hasil ini bukan diagnosis medis; diskusikan hasil yang mengkhawatirkan dengan tenaga kesehatan.</p>
                        <a href="https://www.who.int/tools/child-growth-standards" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex items-center gap-1 text-xs font-bold text-pink-700 hover:text-pink-800">Lihat referensi pertumbuhan WHO <span class="material-symbols-outlined text-[16px]" aria-hidden="true">open_in_new</span></a>
                    </div>
                    <div id="statusCard" class="mt-3 rounded-2xl border px-4 py-4 text-center bg-cyan-50 border-cyan-200">
                        <p id="statusCardLabel" class="text-xs sm:text-xs font-bold uppercase tracking-wide text-cyan-700">Indikator Stunting (PB/U)</p>
                        <p id="statusCardValue" class="text-lg sm:text-xl font-extrabold text-cyan-900 mt-1">Belum dihitung</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="resep-mpasi" class="py-16 bg-pink-50/60 scroll-mt-20">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="inline-block bg-pink-100 text-pink-700 text-xs font-bold px-3 py-1 rounded-full mb-2">Menu MPASI</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">Inspirasi MPASI Sehat &amp; Bergizi</h2>
                    <p class="text-sm text-stone-600 mt-2 max-w-xl">Resep terbaru yang dikelola admin StuntGuard Jember.</p>
                </div>
                <a href="{{ route('public.resep.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-pink-700 hover:text-pink-800">Lihat Semua Resep <span class="material-symbols-outlined text-[18px]">arrow_forward</span></a>
            </div>
            @if ($resepTerbaru->isEmpty())
                <div class="bg-white rounded-3xl p-8 text-center border border-pink-100 text-stone-600">
                    <span class="material-symbols-outlined text-4xl text-pink-300">restaurant</span>
                    <p class="font-bold text-stone-800 mt-2">Belum ada resep MPASI.</p>
                    <p class="text-sm mt-1">Resep akan tampil setelah admin menambahkannya.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($resepTerbaru as $resep)
                        @include('landing.partials.recipeCard', ['resep' => $resep])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section id="informasi-kesehatan" class="py-16 bg-white border-y border-pink-100 scroll-mt-20">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="inline-block bg-pink-100 text-pink-700 text-xs font-bold px-3 py-1 rounded-full mb-2">Pojok Edukasi Keluarga</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">Informasi Kesehatan &amp; Tumbuh Kembang</h2>
                    <p class="text-sm text-stone-600 mt-2">Artikel terbaru yang dikelola admin StuntGuard Jember.</p>
                </div>
                <a href="{{ route('public.informasi.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-pink-700 hover:text-pink-800">Baca Semua Artikel <span class="material-symbols-outlined text-[18px]">arrow_forward</span></a>
            </div>
            @if ($artikelTerbaru->isEmpty())
                <div class="bg-pink-50/50 rounded-3xl p-8 text-center border border-pink-100 text-stone-600">
                    <span class="material-symbols-outlined text-4xl text-pink-300">article</span>
                    <p class="font-bold text-stone-800 mt-2">Belum ada artikel kesehatan.</p>
                    <p class="text-sm mt-1">Artikel akan tampil setelah admin menambahkannya.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 {{ $artikelTerbaru->count() === 1 ? 'sm:grid-cols-1' : ($artikelTerbaru->count() === 2 ? 'lg:grid-cols-2' : ($artikelTerbaru->count() === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-4')) }}">
                    @foreach ($artikelTerbaru as $artikel)
                        @include('landing.partials.articleCard', ['artikel' => $artikel, 'featured' => $artikelTerbaru->count() === 1])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-pink-50 border-t border-pink-100">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-bold text-pink-600 uppercase tracking-wider">Sahabat Keluarga Jember</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900 mt-1">Mengapa Memilih StuntGuard?</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white p-6 rounded-3xl border border-pink-100">
                    <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">verified</span>
                    </div>
                    <h3 class="text-base font-bold text-stone-900">Mengacu pada WHO</h3>
                    <p class="text-sm text-stone-700 mt-2 leading-relaxed">Kalkulator menggunakan referensi standar pertumbuhan WHO untuk skrining awal; bukan pengganti pemeriksaan tenaga kesehatan.</p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-pink-100">
                    <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">sync</span>
                    </div>
                    <h3 class="text-base font-bold text-stone-900">Terhubung Posyandu</h3>
                    <p class="text-sm text-stone-700 mt-2 leading-relaxed">Membantu orang tua memahami pentingnya pencatatan pengukuran dan konsultasi rutin di Posyandu.</p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-pink-100">
                    <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">restaurant</span>
                    </div>
                    <h3 class="text-base font-bold text-stone-900">Pangan Lokal Terjangkau</h3>
                    <p class="text-sm text-stone-700 mt-2 leading-relaxed">Temukan inspirasi menu MPASI dengan bahan pangan yang mudah ditemukan di sekitar keluarga.</p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-pink-100">
                    <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">touch_app</span>
                    </div>
                    <h3 class="text-base font-bold text-stone-900">Mudah Digunakan</h3>
                    <p class="text-sm text-stone-700 mt-2 leading-relaxed">Tampilan sederhana yang dirancang agar langsung dipahami oleh orang tua tanpa perlu bingung.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    let selectedGender = 'boy';

    function setGender(gender) {
        selectedGender = gender;
        const btnBoy = document.getElementById('btnBoy');
        const btnGirl = document.getElementById('btnGirl');
        const active = ['bg-pink-600', 'text-white'];
        const inactive = ['text-stone-600', 'hover:text-pink-600'];

        for (const [button, chosen] of [[btnBoy, gender === 'boy'], [btnGirl, gender === 'girl']]) {
            button.classList.remove(...(chosen ? inactive : active));
            button.classList.add(...(chosen ? active : inactive));
            button.setAttribute('aria-pressed', String(chosen));
        }
    }

    function scoreText(item) {
        return item && item.z_score !== null ? `${Number(item.z_score).toFixed(2)} SD` : 'Tidak tersedia / di luar rentang';
    }

    function statusTheme(status) {
        const text = String(status || '').toLowerCase();

        if (text.includes('sangat pendek')) {
            return {
                card: ['bg-rose-50', 'border-rose-200'],
                title: ['text-rose-700'],
                value: ['text-rose-900'],
            };
        }

        if (text.includes('pendek')) {
            return {
                card: ['bg-amber-50', 'border-amber-200'],
                title: ['text-amber-700'],
                value: ['text-amber-900'],
            };
        }

        if (text.includes('normal')) {
            return {
                card: ['bg-emerald-50', 'border-emerald-200'],
                title: ['text-emerald-700'],
                value: ['text-emerald-900'],
            };
        }

        if (text.includes('tinggi')) {
            return {
                card: ['bg-cyan-50', 'border-cyan-200'],
                title: ['text-cyan-700'],
                value: ['text-cyan-900'],
            };
        }

        return {
            card: ['bg-stone-50', 'border-stone-200'],
            title: ['text-stone-600'],
            value: ['text-stone-900'],
        };
    }

    const nutritionForm = document.getElementById('nutriForm');

    nutritionForm?.addEventListener('submit', async (event) => {
        event.preventDefault();

        const errorBox = document.getElementById('guestCalcError');
        const submitButton = nutritionForm.querySelector('[type="submit"]');
        const resultBox = document.getElementById('resultBox');

        errorBox.classList.add('hidden');
        errorBox.textContent = '';

        if (!nutritionForm.reportValidity()) {
            return;
        }

        const payload = {
            jenis_kelamin: selectedGender === 'boy' ? 'L' : 'P',
            usia_bulan: document.getElementById('inputAge').value,
            berat: document.getElementById('inputWeight').value,
            tinggi: document.getElementById('inputHeight').value,
            posisi_badan: document.getElementById('inputPosition').value,
        };

        submitButton.disabled = true;
        submitButton.classList.add('opacity-70', 'cursor-not-allowed');

        try {
            const response = await fetch(@json(route('public.kalkulator.calculate')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();

            if (!response.ok) {
                const errors = data.errors ? Object.values(data.errors).flat().join(' ') : null;
                throw new Error(errors || data.message || 'Perhitungan gagal.');
            }

            const historyNotice = document.getElementById('historyNotice');

            if (historyNotice) {
                historyNotice.textContent = data.riwayat ?? '';
            }
            document.getElementById('resultGender').textContent = data.jenis_kelamin_label;
            document.getElementById('resultAge').textContent = `${data.usia_bulan} Bulan`;
            document.getElementById('resultMeasure').textContent = `${Number(data.berat).toFixed(1)} kg / ${Number(data.tinggi_input).toFixed(1)} cm`;
            document.getElementById('resultPosition').textContent = data.posisi_badan_label;

            document.getElementById('resultHeightIndicatorLabel').textContent = data.indikator_tinggi;
            document.getElementById('resultWeightHeightIndicatorLabel').textContent = data.indikator_proporsi;
            document.getElementById('resultBbu').textContent = scoreText(data.bbu);
            document.getElementById('resultPbu').textContent = scoreText(data.pbu);
            document.getElementById('resultBbpb').textContent = scoreText(data.bbpb);
            document.getElementById('resultLku').textContent = scoreText(data.lku);
            document.getElementById('resultLilau').textContent = scoreText(data.lilau);
            document.getElementById('correctedText').textContent = `Panjang/tinggi terkoreksi: ${Number(data.panjang_tinggi_terkoreksi).toFixed(1)} cm`;
            document.getElementById('calcNote').textContent = data.catatan;
            document.getElementById('summaryIndicatorLabel').textContent = `Z-Score (${data.indikator_tinggi}):`;
            document.getElementById('summaryIndicatorValue').textContent = scoreText(data.pbu);
            document.getElementById('statusCardLabel').textContent = `Indikator Stunting (${data.indikator_tinggi})`;
            document.getElementById('statusCardValue').textContent = data.ringkasan;

            // Grafik ringkas hanya memvisualisasikan data.pbu dari server.
            const visualValue = document.getElementById('zScoreVisualValue');
            const visualMarker = document.getElementById('zScoreMarker');
            const visualNote = document.getElementById('zScoreVisualNote');
            const score = data.pbu?.z_score;
            const zScore = score === null || score === undefined || score === '' ? NaN : Number(score);
            if (Number.isFinite(zScore)) {
                visualValue.textContent = `${zScore.toFixed(2)} SD`;
                visualMarker.style.left = `${((Math.max(-3, Math.min(3, zScore)) + 3) / 6) * 100}%`;
                visualMarker.classList.remove('hidden');
                visualNote.textContent = (zScore < -3 || zScore > 3)
                    ? 'Hasil berada di luar skala ilustrasi (−3 hingga +3 SD); lihat angka tepatnya di atas.'
                    : 'Penanda menggambarkan posisi nilai Z-score pada rentang ilustrasi, bukan diagnosis medis.';
            } else {
                visualValue.textContent = 'Tidak tersedia';
                visualMarker.classList.add('hidden');
                visualNote.textContent = 'Posisi Z-score belum dapat divisualisasikan karena data tidak tersedia atau di luar rentang.';
            }

            const theme = statusTheme(data.ringkasan);
            const statusCard = document.getElementById('statusCard');
            const statusCardLabel = document.getElementById('statusCardLabel');
            const statusCardValue = document.getElementById('statusCardValue');

            statusCard.className = 'mt-3 rounded-2xl border px-4 py-4 text-center';
            statusCard.classList.add(...theme.card);
            statusCardLabel.className = 'text-xs sm:text-xs font-bold uppercase tracking-wide';
            statusCardLabel.classList.add(...theme.title);
            statusCardValue.className = 'text-lg sm:text-xl font-extrabold mt-1';
            statusCardValue.classList.add(...theme.value);

            resultBox.classList.add('ring-2', 'ring-pink-300');
            setTimeout(() => resultBox.classList.remove('ring-2', 'ring-pink-300'), 800);
            resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } catch (error) {
            errorBox.textContent = error.message || 'Gagal terhubung ke server.';
            errorBox.classList.remove('hidden');
        } finally {
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-70', 'cursor-not-allowed');
        }
    });
</script>
@endpush
