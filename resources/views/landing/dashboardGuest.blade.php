@extends('layouts.guest')
@section('title', 'StuntGuard Jember - Pemantauan Tumbuh Kembang & Gizi Balita')
@section('content')

    <section class="relative overflow-hidden pt-10 pb-16 md:pt-16 md:pb-20">
      <!-- Dekorasi Cahaya Pink Lembut -->
      <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[750px] h-[380px] bg-gradient-to-b from-pink-200/60 via-rose-100/40 to-transparent rounded-full blur-3xl pointer-events-none -z-10"></div>

      <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
        <div class="max-w-3xl mx-auto flex flex-col items-center text-center">

          <!-- Badge Atas -->
          <div class="inline-flex items-center gap-2 bg-white border border-pink-200 text-pink-700 px-4 py-1.5 rounded-full shadow-sm mb-5">
            <span class="material-symbols-outlined text-[18px] text-pink-500">auto_awesome</span>
            <span class="text-xs font-bold">Inovasi Posyandu Cerdas Kabupaten Jember</span>
          </div>

          <!-- Judul Utama -->
          <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-stone-900 leading-[1.2] tracking-tight">
            Pantau Tumbuh Kembang & Gizi Si Kecil dengan
            <span class="bg-gradient-to-r from-pink-500 to-rose-600 bg-clip-text text-transparent">Kasih Sayang</span>
          </h1>

          <!-- Sub-judul ramah orang tua -->
          <p class="text-sm sm:text-base lg:text-lg text-stone-600 max-w-2xl mt-4 leading-relaxed">
            Aplikasi kesehatan digital yang mudah digunakan untuk Ayah & Bunda di Jember. Lihat simulasi edukasi tumbuh kembang & temukan inspirasi resep MPASI lokal dalam hitungan detik.
          </p>

          <!-- Tombol Aksi Utama -->
          <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 mt-8 w-full sm:w-auto">
            <a href="#kalkulator-widget" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-pink-500 to-rose-600 hover:from-pink-600 hover:to-rose-700 text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-pink-500/25 transition-all hover:-translate-y-0.5">
              <span class="material-symbols-outlined text-[20px]">calculate</span>
              <span>Cek Gizi Anak Sekarang</span>
            </a>
            <a href="#resep-mpasi" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-white hover:bg-pink-50 text-pink-700 border border-pink-200 font-bold px-7 py-3.5 rounded-full shadow-sm transition-all">
              <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
              <span>Lihat Resep MPASI</span>
            </a>
          </div>

          <!-- Bar Statistik Singkat -->
          <div class="grid grid-cols-3 gap-3 sm:gap-6 mt-12 w-full max-w-2xl bg-white/95 p-4 sm:p-6 rounded-3xl border border-pink-100 shadow-sm">
            <div class="flex flex-col items-center text-center border-r border-pink-100 pr-2">
              <div class="flex items-center gap-1.5 text-pink-500">
                <span class="material-symbols-outlined text-[22px] hidden sm:inline">child_care</span>
                <span class="text-lg sm:text-2xl font-extrabold text-stone-900">{{ number_format($jumlahBalita, 0, ",", ".") }}</span>
              </div>
              <p class="text-[11px] sm:text-xs font-medium text-stone-500 mt-0.5">Balita Terpantau</p>
            </div>
            <div class="flex flex-col items-center text-center border-r border-pink-100 pr-2">
              <div class="flex items-center gap-1.5 text-pink-500">
                <span class="material-symbols-outlined text-[22px] hidden sm:inline">restaurant_menu</span>
                <span class="text-lg sm:text-2xl font-extrabold text-stone-900">{{ number_format($jumlahResep, 0, ",", ".") }}</span>
              </div>
              <p class="text-[11px] sm:text-xs font-medium text-stone-500 mt-0.5">Resep MPASI Tersedia</p>
            </div>
            <div class="flex flex-col items-center text-center">
              <div class="flex items-center gap-1.5 text-pink-500">
                <span class="material-symbols-outlined text-[22px] hidden sm:inline">favorite</span>
                <span class="text-lg sm:text-2xl font-extrabold text-stone-900">{{ number_format($jumlahArtikel, 0, ",", ".") }}</span>
              </div>
              <p class="text-[11px] sm:text-xs font-medium text-stone-500 mt-0.5">Artikel Kesehatan</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="kalkulator-widget" class="py-16 bg-white border-y border-pink-100 scroll-mt-20">
      <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">

        <!-- Judul Bagian Kalkulator -->
        <div class="text-center max-w-2xl mx-auto mb-10">
          <div class="inline-flex items-center gap-1.5 bg-pink-100 text-pink-700 px-3.5 py-1 rounded-full text-xs font-bold mb-3">
            <span class="material-symbols-outlined text-[16px]">verified</span>
            <span>Simulasi edukasi sederhana</span>
          </div>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900">
            Kalkulator Cek Gizi Balita
          </h2>
          <p class="text-sm text-stone-600 mt-2">
            Masukkan data anak untuk melihat simulasi sederhana. Ini bukan perhitungan Z-score WHO dan bukan diagnosis status gizi.
          </p>
        </div>

        <!-- Grid 2 Kolom Kalkulator -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch bg-gradient-to-br from-pink-50 via-rose-50/70 to-pink-100/50 p-5 sm:p-8 rounded-3xl border border-pink-200/80 shadow-sm">

          <!-- KOLOM KIRI: Form Input (Langkah 1) -->
          <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-2xl border border-pink-100 shadow-sm flex flex-col justify-between">
            <div>
              <div class="flex items-center gap-2.5 pb-4 mb-6 border-b border-pink-100">
                <span class="w-7 h-7 rounded-full bg-pink-500 text-white text-xs font-bold flex items-center justify-center">1</span>
                <h3 class="text-base sm:text-lg font-bold text-stone-900">Masukkan Data Ukuran Anak</h3>
              </div>

              <form id="nutriForm" onsubmit="event.preventDefault(); calculateNutri();" class="space-y-5">
                <!-- Pilih Jenis Kelamin -->
                <div>
                  <label class="block text-xs font-bold text-stone-700 mb-2">Pilih Jenis Kelamin Anak</label>
                  <div class="grid grid-cols-2 gap-2.5 bg-pink-50/70 p-1.5 rounded-2xl border border-pink-100">
                    <button id="btnBoy" type="button" onclick="setGender('boy')" class="py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center gap-1.5 bg-pink-500 text-white shadow-sm transition-all cursor-pointer">
                      <span class="material-symbols-outlined text-[18px]">male</span>
                      <span>Laki-laki</span>
                    </button>
                    <button id="btnGirl" type="button" onclick="setGender('girl')" class="py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center gap-1.5 text-stone-600 hover:text-pink-600 transition-all cursor-pointer">
                      <span class="material-symbols-outlined text-[18px]">female</span>
                      <span>Perempuan</span>
                    </button>
                  </div>
                </div>

                <!-- Input Usia, Berat, Tinggi -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <!-- Usia -->
                  <div>
                    <label for="inputAge" class="block text-xs font-bold text-stone-700 mb-1.5">Usia Saat Ini</label>
                    <div class="relative">
                      <input id="inputAge" type="number" min="0" max="60" placeholder="0–60" required
                        class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 pr-14 text-base font-bold text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                      <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-stone-400">Bulan</span>
                    </div>
                  </div>

                  <!-- Berat Badan -->
                  <div>
                    <label for="inputWeight" class="block text-xs font-bold text-stone-700 mb-1.5">Berat Badan</label>
                    <div class="relative">
                      <input id="inputWeight" type="number" step="0.1" min="1" max="40" placeholder="Berat" required
                        class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 pr-12 text-base font-bold text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                      <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-stone-400">kg</span>
                    </div>
                  </div>

                  <!-- Tinggi Badan -->
                  <div>
                    <label for="inputHeight" class="block text-xs font-bold text-stone-700 mb-1.5">Tinggi Badan</label>
                    <div class="relative">
                      <input id="inputHeight" type="number" step="0.1" min="30" max="130" placeholder="Panjang / tinggi" required
                        class="w-full h-12 bg-stone-50 border border-stone-200 rounded-xl px-4 pr-12 text-base font-bold text-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all">
                      <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-stone-400">cm</span>
                    </div>
                  </div>
                </div>

                <!-- Tombol Hitung -->
                <div class="pt-2">
                  <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-pink-500 to-rose-600 hover:from-pink-600 hover:to-rose-700 text-white text-sm font-bold flex items-center justify-center gap-2 shadow-md shadow-pink-500/20 transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">analytics</span>
                    <span>Hitung & Lihat Hasil Gizi</span>
                  </button>
                </div>
              </form>
            </div>

            <p class="text-[11px] text-stone-400 mt-4 flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">info</span>
              <span>Untuk anak di bawah 24 bulan, tinggi badan diukur secara terlentang.</span>
            </p>
          </div>

          <!-- KOLOM KANAN: Hasil Analisis (Langkah 2) -->
          <div id="resultBox" class="lg:col-span-5 bg-white p-6 sm:p-8 rounded-2xl border-2 border-pink-200 shadow-sm flex flex-col justify-between transition-all duration-300">
            <div>
              <div class="flex items-center justify-between pb-4 mb-5 border-b border-pink-100">
                <div class="flex items-center gap-2.5">
                  <span class="w-7 h-7 rounded-full bg-pink-100 text-pink-600 text-xs font-bold flex items-center justify-center">2</span>
                  <h3 class="text-base sm:text-lg font-bold text-stone-900">Hasil Simulasi Edukasi</h3>
                </div>
                <span class="text-[11px] font-semibold bg-pink-50 text-pink-600 px-2.5 py-0.5 rounded-full">Instan</span>
              </div>

              <!-- Box Status Warna Dinamis -->
              <div id="statusBanner" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-3.5 mb-5">
                <div id="statusIconBox" class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                  <span id="statusIcon" class="material-symbols-outlined text-[28px]">check_circle</span>
                </div>
                <div>
                  <span class="text-[11px] font-bold uppercase tracking-wider text-stone-500 block">Ringkasan Simulasi</span>
                  <span id="badgeStatus" class="text-base sm:text-lg font-extrabold text-emerald-800">
                    BELUM DIHITUNG
                  </span>
                </div>
              </div>

              <!-- Ringkasan Kalori & Saran -->
              <div class="space-y-3 text-xs sm:text-sm">
                <div class="flex items-center justify-between py-2.5 px-3.5 rounded-xl bg-pink-50/70 border border-pink-100">
                  <span class="text-stone-600 font-medium">Catatan:</span>
                  <span id="caloryText" class="font-bold text-pink-600">Bukan diagnosis</span>
                </div>

                <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-100">
                  <span class="font-bold text-stone-800 block mb-1">Saran & Rekomendasi:</span>
                  <p id="descRecommendation" class="text-xs text-stone-600 leading-relaxed">
                    Masukkan data lalu klik tombol simulasi. Hasil ini bukan diagnosis medis.
                  </p>
                </div>
              </div>
            </div>

            <!-- Link ke MPASI -->
            <div class="mt-6 pt-4 border-t border-pink-100 flex items-center justify-between gap-2">
              <span class="text-xs text-stone-500">Ingin lihat menu yang cocok?</span>
              <a href="#resep-mpasi" class="inline-flex items-center gap-1 text-xs font-bold text-pink-600 hover:text-pink-700">
                <span>Rekomendasi MPASI</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- Resep MPASI dinamis dari database -->
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
            <p class="font-bold text-stone-800 mt-2">Belum ada resep MPASI.</p><p class="text-sm mt-1">Resep akan tampil setelah admin menambahkannya.</p>
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

    <!-- Artikel kesehatan dinamis dari database -->
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
            <p class="font-bold text-stone-800 mt-2">Belum ada artikel kesehatan.</p><p class="text-sm mt-1">Artikel akan tampil setelah admin menambahkannya.</p>
          </div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($artikelTerbaru as $artikel)
              @include('landing.partials.articleCard', ['artikel' => $artikel])
            @endforeach
          </div>
        @endif
      </div>
    </section>
    <!-- 5. KEUNGGULAN APLIKASI -->
    <section class="py-16 bg-gradient-to-b from-pink-50/50 to-white border-t border-pink-100">
      <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
        <div class="text-center max-w-xl mx-auto mb-12">
          <span class="text-xs font-bold text-pink-600 uppercase tracking-wider">Sahabat Keluarga Jember</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-stone-900 mt-1">Mengapa Memilih StuntGuard?</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
          <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-[26px]">verified</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Standar Resmi</h3>
            <p class="text-xs text-stone-600 mt-1.5 leading-relaxed">
              Menyediakan edukasi tumbuh kembang. Kalkulator publik ini hanya simulasi dan tidak menghasilkan Z-score WHO.
            </p>
          </div>

          <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-[26px]">sync</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Terhubung Posyandu</h3>
            <p class="text-xs text-stone-600 mt-1.5 leading-relaxed">
              Membantu orang tua memahami pentingnya pencatatan pengukuran dan konsultasi rutin di Posyandu.
            </p>
          </div>

          <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-[26px]">restaurant</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Pangan Lokal Terjangkau</h3>
            <p class="text-xs text-stone-600 mt-1.5 leading-relaxed">
              Temukan inspirasi menu MPASI dengan bahan pangan yang mudah ditemukan di sekitar keluarga.
            </p>
          </div>

          <div class="bg-white p-6 rounded-3xl border border-pink-100 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-[26px]">touch_app</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Mudah Digunakan</h3>
            <p class="text-xs text-stone-600 mt-1.5 leading-relaxed">
              Tampilan sederhana yang dirancang agar langsung dipahami oleh orang tua tanpa perlu bingung.
            </p>
          </div>
        </div>
      </div>
    </section>

  
@endsection
@push('scripts')
<!-- Interactive JavaScript for Calculator Logic -->
      <script>
        let selectedGender = 'boy';

        function setGender(gender) {
          selectedGender = gender;
          const btnBoy = document.getElementById('btnBoy');
          const btnGirl = document.getElementById('btnGirl');

          const activeClasses = ['bg-pink-500', 'text-white', 'shadow-sm'];
          const inactiveClasses = ['text-stone-600', 'hover:text-pink-600'];

          if (gender === 'boy') {
            btnBoy.classList.add(...activeClasses);
            btnBoy.classList.remove(...inactiveClasses);
            btnGirl.classList.remove(...activeClasses);
            btnGirl.classList.add(...inactiveClasses);
          } else {
            btnGirl.classList.add(...activeClasses);
            btnGirl.classList.remove(...inactiveClasses);
            btnBoy.classList.remove(...activeClasses);
            btnBoy.classList.add(...inactiveClasses);
          }
        }

        function calculateNutri() {
          const ageInput = document.getElementById('inputAge').value;
          const age = Number(ageInput);
          const weight = Number(document.getElementById('inputWeight').value);
          const height = Number(document.getElementById('inputHeight').value);

          if (ageInput.trim() === '' || !Number.isFinite(age) || age < 0 || age > 60 || !Number.isFinite(weight) || weight <= 0 || !Number.isFinite(height) || height <= 0) {
            alert('Mohon isi usia 0–60 bulan, berat badan, dan tinggi/panjang badan dengan angka yang valid.');
            return;
          }

          const badgeStatus = document.getElementById('badgeStatus');
          const descRec = document.getElementById('descRecommendation');

          // Perkiraan edukatif sederhana: BUKAN z-score WHO atau alat diagnosis
          const expectedWeight = (selectedGender === 'boy' ? 8.5 : 8.2) + (age * 0.22);
          const diff = weight - expectedWeight;

          let statusText = "DI SEKITAR PERKIRAAN";
          let statusClasses = "bg-emerald-200 text-emerald-800";
          let recommendation = "Perkiraan kasar, bukan penilaian status gizi atau Z-score WHO. Lakukan penilaian pertumbuhan dengan tenaga kesehatan.";

          if (diff < -1.8) {
            statusText = "DI BAWAH PERKIRAAN";
            statusClasses = "bg-orange-100 text-amber-900";
            recommendation = "Silakan diskusikan pengukuran dan pola pertumbuhan anak dengan tenaga kesehatan. Hasil ini bukan diagnosis.";
          } else if (diff > 2.5) {
            statusText = "DI ATAS PERKIRAAN";
            statusClasses = "bg-rose-100 text-rose-900";
            recommendation = "Silakan diskusikan pengukuran dan pola pertumbuhan anak dengan tenaga kesehatan. Hasil ini bukan diagnosis.";
          }

          badgeStatus.className = `${statusClasses} text-base sm:text-lg font-extrabold`; 
          badgeStatus.innerText = statusText;

          descRec.textContent = `Simulasi berat badan: ${statusText}. ${recommendation}`;
           document.getElementById('caloryText').textContent = 'Bukan diagnosis';

          const box = document.getElementById('resultBox');
          box.classList.add('ring-2', 'ring-pink-500');
          setTimeout(() => box.classList.remove('ring-2', 'ring-pink-500'), 800);
        }
      </script>

  
@endpush
