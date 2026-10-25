<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'StunGuard Jember') }} - Pemantauan Tumbuh Kembang &amp; Gizi Balita</title>

  <!-- Google Fonts & Material Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400..700,0..1&amp;display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 font-sans text-stone-900 min-h-screen flex flex-col">

  {{-- Navbar --}}
  <x-guest.navbar />

  <!-- Main Content Container -->
  <main class="w-full flex-1 pt-20 bg-stone-50">
    <div class="flex flex-col w-full">

      <!-- Top Decorative Ambient Glow -->
      <div class="relative w-full overflow-hidden">
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[760px] h-[360px] bg-gradient-to-b from-primary-fixed/40 via-secondary-container/20 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <!-- 1. HERO SECTION -->
        <section class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 pt-space-lg md:pt-space-xl pb-space-xl">
          <div class="max-w-4xl mx-auto flex flex-col items-center text-center gap-4">

            <!-- Badge -->
            <div class="inline-flex items-center gap-1 bg-rose-100/70 text-rose-900 px-4 py-1.5 rounded-full shadow-sm">
              <span class="material-symbols-outlined text-[18px] text-rose-700" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
              <span class="text-xs font-semibold tracking-wide">Inovasi Posyandu Cerdas Kabupaten Jember</span>
            </div>

            <!-- Headline -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stone-900 leading-tight tracking-tight">
              Pantau Tumbuh Kembang &amp; Gizi Si Kecil dengan <span class="text-rose-700 italic font-bold">Kasih Sayang</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-stone-600 max-w-2xl">
              Aplikasi kesehatan digital terpercaya untuk bunda &amp; ayah di Jember. Hitung status gizi balita berbasis standar WHO dan Kemenkes RI, temukan panduan MPASI bergizi, dan pantau milestone anak dengan mudah.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-4 pt-1">
              <a class="group flex items-center gap-1 bg-rose-700 hover:bg-rose-600 text-white hover:text-white font-semibold px-6 py-3 rounded-full shadow-[0_8px_20px_-4px_rgba(165,48,77,0.35)] transition-all" href="#kalkulator-widget">
                <span class="material-symbols-outlined text-[20px]">calculate</span>
                <span>Hitung Gizi Balita Sekarang</span>
              </a>
              <a class="flex items-center gap-1 bg-white hover:bg-stone-100 text-rose-700 font-semibold px-6 py-3 rounded-full shadow-sm transition-all" href="#resep-mpasi">
                <span class="material-symbols-outlined text-[20px]">menu_book</span>
                <span>Jelajahi Menu MPASI Sehat</span>
              </a>
            </div>

            <!-- Quick Stats Bar -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4 pt-space-md mt-space-xs w-full max-w-3xl">
              <div class="bg-white/80 backdrop-blur-sm p-2 sm:p-4 rounded-2xl shadow-sm flex flex-col items-center">
                <div class="flex items-center gap-1 text-rose-700">
                  <span class="material-symbols-outlined text-[20px]">child_care</span>
                  <span class="text-xl font-bold text-stone-900">{{ number_format($jumlahBalita, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-stone-600 mt-1">Balita Terpantau</p>
              </div>
              <div class="bg-white/80 backdrop-blur-sm p-2 sm:p-4 rounded-2xl shadow-sm flex flex-col items-center">
                <div class="flex items-center gap-1 text-emerald-700">
                  <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
                  <span class="text-xl font-bold text-stone-900">{{ number_format($jumlahResep, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-stone-600 mt-1">Resep MPASI Tersedia</p>
              </div>
              <div class="bg-white/80 backdrop-blur-sm p-2 sm:p-4 rounded-2xl shadow-sm flex flex-col items-center">
                <div class="flex items-center gap-1 text-amber-800">
                  <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">article</span>
                  <span class="text-xl font-bold text-stone-900">{{ number_format($jumlahArtikel, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-stone-600 mt-1">Artikel Kesehatan</p>
              </div>
            </div>

          </div>
        </section>
      </div>

      <!-- 2. FITUR UTAMA & INTERAKTIF KALKULATOR GIZI BALITA -->
      <section class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 py-space-xl w-full" id="kalkulator-widget">
        <div class="bg-rose-100/30 rounded-3xl p-4 md:p-10 shadow-[0_8px_32px_-4px_rgba(178,93,114,0.12)]">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-2 mb-space-lg">
            <div>
              <div class="flex items-center gap-1 text-rose-700 mb-1">
                <span class="material-symbols-outlined text-[24px]">calculate</span>
                <span class="text-sm font-bold">Simulasi Berat Badan Balita</span>
              </div>
              <h2 class="text-2xl sm:text-3xl font-bold text-stone-900">
                Lihat Gambaran Berat Badan Si Kecil
              </h2>
              <p class="text-sm text-stone-600 mt-1">
                Simulasi sederhana untuk edukasi, bukan perhitungan Z-score WHO atau diagnosis status gizi. Untuk penilaian akurat, konsultasikan hasil pengukuran ke tenaga kesehatan.
              </p>
            </div>
            <div class="inline-flex items-center gap-1 bg-white px-4 py-1.5 rounded-full text-emerald-700 text-xs font-bold shadow-sm">
              <span class="material-symbols-outlined text-[16px]">info</span>
              <span>Simulasi Edukasi — Bukan Diagnosis</span>
            </div>
          </div>

          <!-- Quick Interactive Calculator Form -->
          <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="nutriForm" onsubmit="event.preventDefault(); calculateNutri();">
            <!-- Field 1: Gender Toggle -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-stone-600 font-semibold">Jenis Kelamin</label>
              <div class="grid grid-cols-2 gap-1 bg-white p-1 rounded-full shadow-sm h-12 items-center">
                <button class="gender-btn active w-full h-full rounded-full text-xs font-semibold flex items-center justify-center gap-1 bg-rose-700 text-white transition-all" id="btnBoy" onclick="setGender('boy')" type="button">
                  <span class="material-symbols-outlined text-[16px]">male</span> Laki-laki
                </button>
                <button class="gender-btn w-full h-full rounded-full text-xs font-semibold flex items-center justify-center gap-1 text-stone-600 hover:text-rose-700 transition-all" id="btnGirl" onclick="setGender('girl')" type="button">
                  <span class="material-symbols-outlined text-[16px]">female</span> Perempuan
                </button>
              </div>
            </div>

            <!-- Field 2: Age in Months -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-stone-600 font-semibold" for="inputAge">Usia Balita (Bulan)</label>
              <div class="relative">
                <input class="w-full h-12 bg-white rounded-full px-4 text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-rose-700 shadow-sm" id="inputAge" max="60" min="0" placeholder="Contoh: 14" type="number" value="14">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-stone-600">Bulan</span>
              </div>
            </div>

            <!-- Field 3: Weight -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-stone-600 font-semibold" for="inputWeight">Berat Badan (kg)</label>
              <div class="relative">
                <input class="w-full h-12 bg-white rounded-full px-4 text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-rose-700 shadow-sm" id="inputWeight" placeholder="Contoh: 9.8" step="0.1" type="number" value="9.8">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-stone-600">kg</span>
              </div>
            </div>

            <!-- Field 4: Length/Height -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-stone-600 font-semibold" for="inputHeight">Tinggi / Panjang (cm)</label>
              <div class="relative">
                <input class="w-full h-12 bg-white rounded-full px-4 text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-rose-700 shadow-sm" id="inputHeight" placeholder="Contoh: 78" step="0.1" type="number" value="78">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-stone-600">cm</span>
              </div>
            </div>

            <!-- Action Submit Button -->
            <div class="sm:col-span-2 lg:col-span-4 flex justify-end mt-space-xs">
              <button class="w-full sm:w-auto px-10 py-3 rounded-full bg-rose-700 hover:bg-rose-600 text-white hover:text-white text-sm font-bold flex items-center justify-center gap-1 shadow-md transition-all" type="submit">
                <span class="material-symbols-outlined text-[20px]">analytics</span>
                <span>Lihat Simulasi</span>
              </button>
            </div>
          </form>

          <!-- Live Interactive Analysis Result Box -->
          <div class="mt-space-md bg-white rounded-2xl p-4 sm:p-6 shadow-sm" id="resultBox">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
              <div class="flex items-start gap-2">
                <div class="w-12 h-12 rounded-full bg-emerald-200/60 text-emerald-700 flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">task_alt</span>
                </div>
                <div>
                  <div class="flex flex-wrap items-center gap-1">
                    <span class="bg-emerald-200 text-emerald-800 text-xs px-2.5 py-1 rounded-full font-bold" id="badgeStatus">
                      BELUM DIHITUNG
                    </span>
                    <span class="text-stone-600 text-xs font-semibold">
                      Hasil simulasi tidak menggantikan pengukuran WHO
                    </span>
                  </div>
                  <p class="text-sm text-stone-900 mt-1.5" id="descRecommendation">
                    Masukkan ukuran balita dan klik <strong>Lihat Simulasi</strong>. Hasil ini bukan diagnosis medis.
                  </p>
                </div>
              </div>
              <div class="shrink-0 flex items-center gap-1 w-full md:w-auto">
                <a class="w-full md:w-auto text-center px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-200 text-rose-700 text-xs font-bold transition-colors" href="#resep-mpasi">
                  Pilihan MPASI Sesuai Usia
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 3. ARTIKEL TERBARU: bersumber dari database informasis -->
      <section class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 py-space-xl w-full" id="informasi-kesehatan">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-1 mb-space-lg">
          <div>
            <span class="text-sm font-bold text-rose-700 tracking-wide uppercase">Panduan Ayah &amp; Bunda</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 mt-1">Edukasi &amp; Informasi Kesehatan Balita</h2>
            <p class="text-sm text-stone-600 mt-2">Artikel terbaru yang ditambahkan melalui Kelola Informasi.</p>
          </div>
          <a class="text-sm text-rose-700 hover:text-rose-600 font-bold flex items-center gap-1" href="{{ route('public.informasi.index') }}">
            Lihat Semua Artikel <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>

        @if ($artikelTerbaru->isEmpty())
          <div class="bg-white rounded-3xl p-8 text-center border border-stone-200 text-stone-600">
            <span class="material-symbols-outlined text-4xl text-rose-200">article</span>
            <p class="font-semibold text-stone-800 mt-2">Belum ada artikel kesehatan.</p>
            <p class="text-sm mt-1">Artikel akan tampil otomatis setelah admin menambahkannya.</p>
          </div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($artikelTerbaru as $artikel)
              @include('landing.partials.articleCard', ['artikel' => $artikel])
            @endforeach
          </div>
        @endif
      </section>

      <!-- 4. RESEP TERBARU: bersumber dari database mpasis -->
      <section class="bg-stone-100/60 py-space-xl w-full" id="resep-mpasi">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12">
          <div class="text-center max-w-2xl mx-auto mb-space-xl">
            <span class="bg-emerald-200/60 text-emerald-700 text-xs px-3 py-1 rounded-full font-bold">Menu MPASI</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 mt-2">Inspirasi MPASI Sehat &amp; Bergizi Si Kecil</h2>
            <p class="text-sm text-stone-600 mt-2">Resep terbaru dari admin, lengkap dengan bahan, langkah dan informasi gizi.</p>
          </div>

          @if ($resepTerbaru->isEmpty())
            <div class="bg-white rounded-3xl p-8 text-center border border-stone-200 text-stone-600">
              <span class="material-symbols-outlined text-4xl text-emerald-200">restaurant</span>
              <p class="font-semibold text-stone-800 mt-2">Belum ada resep MPASI.</p>
              <p class="text-sm mt-1">Resep akan tampil otomatis setelah admin menambahkannya.</p>
            </div>
          @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              @foreach ($resepTerbaru as $resep)
                @include('landing.partials.recipeCard', ['resep' => $resep])
              @endforeach
            </div>
          @endif

          <div class="mt-8 text-center">
            <a href="{{ route('public.resep.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-rose-700 text-white text-sm font-bold hover:bg-rose-600 transition-colors">
              Lihat Semua Resep <span class="material-symbols-outlined text-[19px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </section>

      <!-- 5. KEUNGGULAN APLIKASI NUTRIBALITA JEMBER -->
      <section class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 py-space-xl w-full">
        <div class="text-center max-w-xl mx-auto mb-space-xl">
          <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Sahabat Tumbuh Kembang</span>
          <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 mt-1">Mengapa Memilih StunGuard Jember?</h2>
          <p class="text-sm text-stone-600 mt-2">
            Fitur pengelolaan resep dan informasi kesehatan untuk membantu orang tua memahami kebutuhan tumbuh kembang balita.
          </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <!-- Feature 1 -->
          <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-rose-100/80 text-rose-700 flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">verified</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Standar WHO &amp; Kemenkes</h3>
            <p class="text-xs text-stone-600 mt-2 leading-relaxed">
              Pengelola dapat melakukan penilaian antropometri melalui kalkulator gizi berbasis data standar WHO yang tersedia di dashboard admin.
            </p>
          </div>
          <!-- Feature 2 -->
          <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-emerald-200/80 text-emerald-700 flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">sync</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Catatan Pengukuran Balita</h3>
            <p class="text-xs text-stone-600 mt-2 leading-relaxed">
              Pencatatan pengukuran balita dan riwayat pertumbuhan dapat dikelola melalui fitur admin.
            </p>
          </div>
          <!-- Feature 3 -->
          <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-orange-100/80 text-amber-800 flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">restaurant</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Kumpulan Resep MPASI</h3>
            <p class="text-xs text-stone-600 mt-2 leading-relaxed">
              Lihat bahan, cara membuat, kategori usia dan informasi nutrisi dari resep yang ditambahkan admin.
            </p>
          </div>
          <!-- Feature 4 -->
          <div class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-rose-100/80 text-rose-700 flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">notifications_active</span>
            </div>
            <h3 class="text-base font-bold text-stone-900">Artikel Kesehatan</h3>
            <p class="text-xs text-stone-600 mt-2 leading-relaxed">
              Baca artikel edukasi kesehatan yang diperbarui oleh pengelola StunGuard.
            </p>
          </div>
        </div>
      </section>

      <!-- Interactive JavaScript for Calculator Logic -->
      <script>
        let selectedGender = 'boy';

        function setGender(gender) {
          selectedGender = gender;
          const btnBoy = document.getElementById('btnBoy');
          const btnGirl = document.getElementById('btnGirl');

          const activeClasses = ['bg-rose-700', 'text-white', 'active'];
          const inactiveClasses = ['text-stone-600', 'hover:text-rose-700'];

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
          const age = Number(document.getElementById('inputAge').value);
          const weight = Number(document.getElementById('inputWeight').value);
          const height = Number(document.getElementById('inputHeight').value);

          if (!Number.isFinite(age) || age < 0 || age > 60 || !Number.isFinite(weight) || weight <= 0 || !Number.isFinite(height) || height <= 0) {
            alert('Mohon isi usia 0–60 bulan, berat badan, dan tinggi/panjang badan dengan angka yang valid.');
            return;
          }

          const badgeStatus = document.getElementById('badgeStatus');
          const descRec = document.getElementById('descRecommendation');

          // Perkiraan edukatif sederhana: BUKAN z-score WHO atau alat diagnosis
          const expectedWeight = 8.5 + (age * 0.22);
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

          badgeStatus.className = `${statusClasses} text-xs px-2.5 py-1 rounded-full font-bold`;
          badgeStatus.innerText = statusText;

          descRec.textContent = `Simulasi berat badan: ${statusText}. ${recommendation}`;

          const box = document.getElementById('resultBox');
          box.classList.add('ring-2', 'ring-rose-700');
          setTimeout(() => box.classList.remove('ring-2', 'ring-rose-700'), 800);
        }
      </script>
    </div>
  </main>

  {{-- Footer --}}
  <x-guest.footer />

</body>
</html>
