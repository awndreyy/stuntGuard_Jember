@extends('layouts.guest')
@section('title', 'StuntGuard Jember - Pemantauan Tumbuh Kembang & Gizi Balita')

@section('content')
    <section class="sg-hero">
        <div class="sg-container">
            <div class="sg-hero-grid">
                <div>
                    <h1>Langkah kecil hari ini,<br><em>masa depan hebat.</em></h1>
                    <p class="sg-lead">Temani perjalanan si kecil dengan lebih percaya diri. Cek pertumbuhan, temukan inspirasi MPASI, dan pelajari kesehatan keluarga dalam satu tempat.</p>
                    <div class="sg-actions">
                        <a href="#kalkulator-widget" class="sg-primary">Cek Gizi Si Kecil <span aria-hidden="true">↗</span></a>
                        <a href="#resep-mpasi" class="sg-secondary">Jelajahi Resep MPASI</a>
                    </div>
                    <div class="sg-trust"><span>Referensi pertumbuhan WHO</span><span>Resep &amp; edukasi keluarga</span></div>
                </div>
                <div class="sg-hero-art"><svg class="family-art" viewBox="0 0 480 440" role="img" aria-label="Ilustrasi ibu mendampingi anak dengan penuh kasih"><circle cx="364" cy="104" r="40" fill="#f5d9a4"/><path d="M58 327Q15 245 72 222Q91 262 84 323M405 330q63-67 32-109-40 32-32 109" fill="#9da98f"/><path d="M60 355q172-57 360 0v85H60" fill="#cbd6c0"/><path d="M139 403q-22-116 19-180 46-29 97 5 42 67 30 175" fill="#b66072"/><path d="M165 242q-36-64-5-131 23-48 77-24 46 25 33 97l-13 59z" fill="#4e3938"/><ellipse cx="210" cy="155" rx="47" ry="61" fill="#edbea0"/><path d="M159 145q-3-65 54-66 58 9 57 66-40-9-64-43-9 29-47 43" fill="#4e3938"/><path d="M197 179q14 12 28-1" fill="none" stroke="#955f52" stroke-width="3" stroke-linecap="round"/><path d="M187 152h2m36 0h2" stroke="#4e3938" stroke-width="4" stroke-linecap="round"/><path d="M259 405q-16-75 10-124 32-23 65 3 30 49 17 121" fill="#f4d28e"/><ellipse cx="301" cy="250" rx="36" ry="43" fill="#edbea0"/><path d="M266 239q-5-51 37-43 35-7 36 42-19-3-30-19-11 18-43 20" fill="#513d35"/><path d="M289 266q12 10 23-1" fill="none" stroke="#955f52" stroke-width="3" stroke-linecap="round"/><path d="M283 246h1m29 0h1" stroke="#513d35" stroke-width="4" stroke-linecap="round"/><path d="M169 264q-21 74 72 87l47-17" fill="none" stroke="#edbea0" stroke-width="26" stroke-linecap="round"/><path d="M335 303q18 29-13 47" fill="none" stroke="#edbea0" stroke-width="20" stroke-linecap="round"/><path d="M94 112q10-23 21 0 11-23 21 0 2 14-21 29-23-15-21-29" fill="#b66072"/><path d="M354 171h20m-10-10v20" stroke="#fffdf9" stroke-width="4" stroke-linecap="round"/></svg><div class="sg-art-note"><b>Setiap langkah berarti.</b>Temani masa tumbuh si kecil</div><div class="sg-art-caption"><b>Tumbuh bersama, penuh cinta</b>Dari masa kehamilan hingga balita.</div></div>
            </div>
            <div class="sg-stats">
                <div><span class="material-symbols-outlined" aria-hidden="true">child_care</span><p><strong>{{ number_format($jumlahBalita, 0, ',', '.') }}</strong><small>Balita terpantau</small></p></div>
                <div><span class="material-symbols-outlined" aria-hidden="true">restaurant_menu</span><p><strong>{{ number_format($jumlahResep, 0, ',', '.') }}</strong><small>Resep MPASI tersedia</small></p></div>
                <div><span class="material-symbols-outlined" aria-hidden="true">article</span><p><strong>{{ number_format($jumlahArtikel, 0, ',', '.') }}</strong><small>Artikel kesehatan</small></p></div>
            </div>
        </div>
    </section>

    <section id="kalkulator-widget" class="py-16 bg-white border-y border-pink-100 scroll-mt-20">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
            <div class="sg-section-heading text-center max-w-2xl mx-auto mb-10">
                <div class="sg-eyebrow">
                    <span>Kenali Pertumbuhan Si Kecil</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">Kalkulator Cek Gizi Balita</h2>
                <p class="text-sm text-stone-600 mt-2">
                    Masukkan data pengukuran untuk melihat hasil Z-score berdasarkan tabel WHO. Hasil ini merupakan skrining awal, bukan diagnosis medis.
                </p>
            </div>

            <div class="sg-calculator grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start bg-pink-50 p-5 sm:p-8 rounded-3xl border border-pink-200/80">
                <div class="sg-calculator-input lg:col-span-7 bg-white p-6 sm:p-8 rounded-2xl border border-pink-100 flex flex-col">
                    <div>
                        <div class="flex items-center gap-2.5 pb-4 mb-6 border-b border-pink-100">
                            <span class="sg-step w-7 h-7 rounded-full bg-pink-500 text-white text-xs font-bold flex items-center justify-center">1</span>
                            <h3 class="text-base sm:text-lg font-bold text-stone-900">Masukkan Data Ukuran Anak</h3>
                        </div>

                        <form id="nutriForm" class="space-y-5">
                            <div>
                                <label id="gender-label" class="block text-sm font-bold text-stone-700 mb-2">Pilih Jenis Kelamin Anak</label>
                                <div role="group" aria-labelledby="gender-label" class="sg-gender grid grid-cols-2 gap-2.5 bg-pink-50/70 p-1.5 rounded-2xl border border-pink-100">
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
                        <div class="sg-step w-9 h-9 rounded-xl bg-stone-100 text-stone-600 flex items-center justify-center shrink-0">
                            <span>2</span>
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-stone-900">Hasil Analisis</h3>
                            <p class="text-xs text-stone-500">Ringkasan indikator dan posisi Z-score pertumbuhan</p>
                        </div>
                    </div>

                    <div class="sg-result-summary rounded-xl bg-stone-50 border border-stone-200 p-4 sm:p-5">
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
                    <div id="statusCard" class="mt-3 rounded-2xl border px-4 py-4 text-center bg-pink-50 border-pink-200">
                        <p id="statusCardLabel" class="text-xs sm:text-xs font-bold uppercase tracking-wide text-pink-700">Indikator Stunting (PB/U)</p>
                        <p id="statusCardValue" class="text-lg sm:text-xl font-extrabold text-pink-900 mt-1">Belum dihitung</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="resep-mpasi" class="py-16 bg-pink-50/60 scroll-mt-20">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="sg-eyebrow">Inspirasi Menu Si Kecil</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">Resep MPASI Sehat</h2>
                    <p class="text-sm text-stone-600 mt-2 max-w-xl">Ide menu sesuai tahapan usia dan kebutuhan buah hati.</p>
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
                    <span class="sg-eyebrow">Pengetahuan untuk Orang Tua</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">Edukasi Kesehatan Anak</h2>
                    <p class="text-sm text-stone-600 mt-2">Informasi praktis untuk mendukung tumbuh kembang anak.</p>
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

<section class="sg-mobile" id="aplikasi-mobile" aria-labelledby="mobile-heading">
        <div class="sg-mobile-copy"><p class="sg-eyebrow">STUNTGUARD DI GENGGAMAN</p><h2 id="mobile-heading">Temani tumbuh kembangnya,<br>dari aplikasi mobile.</h2><p>Orang tua dapat mengakses resep MPASI, artikel kesehatan, data anak, dan riwayat pengukuran melalui aplikasi StuntGuard. Pencatatan pengukuran dikelola oleh admin posyandu.</p></div>
        <div class="sg-mobile-icon"><svg viewBox="0 0 180 220" role="img" aria-label="Ilustrasi aplikasi StuntGuard di ponsel"><circle cx="90" cy="112" r="83" fill="#efd7df"/><rect x="43" y="9" width="94" height="192" rx="19" fill="#852641"/><rect x="49" y="16" width="82" height="178" rx="14" fill="#fffaf8"/><rect x="72" y="17" width="36" height="7" rx="3.5" fill="#852641"/><rect x="49" y="39" width="82" height="51" fill="#ac3156"/><path d="M90 76s-17-10-17-20c0-9 12-12 17-3 5-9 17-6 17 3 0 10-17 20-17 20Z" fill="#fffaf8"/><rect x="59" y="103" width="62" height="25" rx="6" fill="#f6e3e7"/><rect x="59" y="138" width="27" height="27" rx="6" fill="#e4e9dd"/><rect x="94" y="138" width="27" height="27" rx="6" fill="#f6e3e7"/><path d="M67 116h17m8 0h21" stroke="#ac3156" stroke-width="3" stroke-linecap="round"/><rect x="77" y="182" width="26" height="3" rx="1.5" fill="#852641"/></svg><span>StuntGuard Mobile</span></div>
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
