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

  <!-- Tailwind CSS CDN & Clean Custom Theme -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          },
          colors: {
            "primary": "#a5304d",
            "primary-container": "#c54964",
            "primary-fixed": "#ffd9dd",
            "on-primary": "#ffffff",
            "on-primary-container": "#fffbff",
            "on-primary-fixed-variant": "#881938",
            "secondary": "#236b44",
            "secondary-container": "#a9f3c1",
            "on-secondary": "#ffffff",
            "on-secondary-container": "#2a7149",
            "tertiary": "#8b4c11",
            "tertiary-fixed": "#ffdcc4",
            "on-tertiary-fixed-variant": "#6f3800",
            "surface": "#fdf9f6",
            "surface-container-lowest": "#ffffff",
            "surface-container-low": "#f7f3f0",
            "surface-container": "#f1edea",
            "surface-container-high": "#ebe7e5",
            "on-surface": "#1c1b1a",
            "on-surface-variant": "#574144",
            "outline-variant": "#ddbfc2",
          },
          borderRadius: {
            DEFAULT: "1rem",
            lg: "2rem",
            xl: "3rem",
            full: "9999px",
          },
          spacing: {
            "gutter": "1rem",
            "space-xs": "0.25rem",
            "space-sm": "0.5rem",
            "space-md": "1rem",
            "space-lg": "1.5rem",
            "space-xl": "2.5rem",
            "margin": "1rem",
            "margin-tablet": "2rem",
            "margin-desktop": "3rem",
          }
        }
      }
    };
  </script>
</head>

<body class="bg-surface font-sans text-on-surface min-h-screen flex flex-col">

  <!-- Header / Navigation Bar -->
  <header class="fixed top-0 left-0 right-0 z-50 bg-surface/90 backdrop-blur-md shadow-[0_4px_16px_-2px_rgba(178,93,114,0.06)]">
    <div class="h-20 max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop flex items-center justify-between gap-space-md">
      <a href="{{ url('/') }}" class="flex items-center shrink-0">
        <img src="https://lh3.googleusercontent.com/aida/AEtjO1XPHFzwLy83mKwY1knBQP8C6SyzTyQodNBzmd8ofAHqwm3TLlOfT0T46vYsJ_UNTmKElz41qrcj3_hTqZzmNfDaBaLsW3jsgM2Np6yw47kButeCcOMhlP_UuHFWMIIdl85kRx_9DCgvCoRhFlrDgwMjhEjYnEcrDlm07Vvo7Y8T36iU83Xw8SBqimS7EAdpWiZS4TbD50DEVrMFxcldsqzr8nTqgtQc5nxKleimSJriQ2ev4F7YwZeNQOo" alt="StunGuard Jember" class="h-10 w-auto object-contain">
      </a>
      <nav class="hidden md:flex items-center gap-space-md">
        <a href="#kalkulator-widget" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors">Kalkulator Gizi</a>
        <a href="#informasi-kesehatan" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors">Informasi Kesehatan</a>
        <a href="#resep-mpasi" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors">MPASI Anak</a>
      </nav>
      <div class="flex items-center gap-space-sm">
        @if (Route::has('login'))
          @auth
            <a href="{{ url('/dashboardUser') }}" class="text-sm font-semibold text-primary border border-primary hover:bg-primary-fixed/30 px-space-md py-2 rounded-full transition-all flex items-center justify-center">Dashboard</a>
          @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-primary border border-primary hover:bg-primary-fixed/30 px-space-md py-2 rounded-full transition-all flex items-center justify-center">Masuk</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="text-sm bg-primary text-on-primary hover:bg-primary-container font-semibold px-space-md py-2 rounded-full shadow-[0_4px_16px_-2px_rgba(178,93,114,0.15)] transition-all flex items-center justify-center">Daftar</a>
            @endif
          @endauth
        @else
          <a href="#login" class="text-sm font-semibold text-primary border border-primary hover:bg-primary-fixed/30 px-space-md py-2 rounded-full transition-all flex items-center justify-center">Masuk</a>
          <a href="#register" class="text-sm bg-primary text-on-primary hover:bg-primary-container font-semibold px-space-md py-2 rounded-full shadow-[0_4px_16px_-2px_rgba(178,93,114,0.15)] transition-all flex items-center justify-center">Daftar</a>
        @endif
      </div>
    </div>
  </header>

  <!-- Main Content Container -->
  <main class="w-full flex-1 pt-20 bg-surface">
    <div class="flex flex-col w-full">

      <!-- Top Decorative Ambient Glow -->
      <div class="relative w-full overflow-hidden">
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[760px] h-[360px] bg-gradient-to-b from-primary-fixed/40 via-secondary-container/20 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <!-- 1. HERO SECTION -->
        <section class="max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop pt-space-lg md:pt-space-xl pb-space-xl">
          <div class="max-w-4xl mx-auto flex flex-col items-center text-center gap-space-md">
            
            <!-- Badge -->
            <div class="inline-flex items-center gap-space-xs bg-primary-fixed/70 text-on-primary-fixed-variant px-space-md py-1.5 rounded-full shadow-sm">
              <span class="material-symbols-outlined text-[18px] text-primary" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
              <span class="text-xs font-semibold tracking-wide">Inovasi Posyandu Cerdas Kabupaten Jember</span>
            </div>

            <!-- Headline -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-on-surface leading-tight tracking-tight">
              Pantau Tumbuh Kembang &amp; Gizi Si Kecil dengan <span class="text-primary italic font-extrabold">Kasih Sayang</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-on-surface-variant max-w-2xl">
              Aplikasi kesehatan digital terpercaya untuk bunda &amp; ayah di Jember. Hitung status gizi balita berbasis standar WHO dan Kemenkes RI, temukan panduan MPASI bergizi, dan pantau milestone anak dengan mudah.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-space-sm sm:gap-space-md pt-space-xs">
              <a class="group flex items-center gap-space-xs bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container font-semibold px-space-lg py-3 rounded-full shadow-[0_8px_20px_-4px_rgba(165,48,77,0.35)] transition-all" href="#kalkulator-widget">
                <span class="material-symbols-outlined text-[20px]">calculate</span>
                <span>Hitung Gizi Balita Sekarang</span>
              </a>
              <a class="flex items-center gap-space-xs bg-surface-container-lowest hover:bg-surface-container-low text-primary font-semibold px-space-lg py-3 rounded-full shadow-sm transition-all" href="#resep-mpasi">
                <span class="material-symbols-outlined text-[20px]">menu_book</span>
                <span>Jelajahi Menu MPASI Sehat</span>
              </a>
            </div>

            <!-- Quick Stats Bar -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-sm sm:gap-space-md pt-space-md mt-space-xs w-full max-w-3xl">
              <div class="bg-surface-container-lowest/80 backdrop-blur-sm p-space-sm sm:p-space-md rounded-2xl shadow-sm flex flex-col items-center">
                <div class="flex items-center gap-1 text-primary">
                  <span class="material-symbols-outlined text-[20px]">child_care</span>
                  <span class="text-xl font-bold text-on-surface">12.4k+</span>
                </div>
                <p class="text-xs text-on-surface-variant mt-1">Balita Terpantau</p>
              </div>
              <div class="bg-surface-container-lowest/80 backdrop-blur-sm p-space-sm sm:p-space-md rounded-2xl shadow-sm flex flex-col items-center">
                <div class="flex items-center gap-1 text-secondary">
                  <span class="material-symbols-outlined text-[20px]">location_on</span>
                  <span class="text-xl font-bold text-on-surface">248</span>
                </div>
                <p class="text-xs text-on-surface-variant mt-1">Posyandu di Jember</p>
              </div>
              <div class="bg-surface-container-lowest/80 backdrop-blur-sm p-space-sm sm:p-space-md rounded-2xl shadow-sm flex flex-col items-center">
                <div class="flex items-center gap-1 text-tertiary">
                  <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">favorite</span>
                  <span class="text-xl font-bold text-on-surface">99.2%</span>
                </div>
                <p class="text-xs text-on-surface-variant mt-1">Orang Tua Terbantu</p>
              </div>
            </div>

          </div>
        </section>
      </div>

      <!-- 2. FITUR UTAMA & INTERAKTIF KALKULATOR GIZI BALITA -->
      <section class="max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop py-space-xl w-full" id="kalkulator-widget">
        <div class="bg-primary-fixed/30 rounded-3xl p-space-md md:p-space-xl shadow-[0_8px_32px_-4px_rgba(178,93,114,0.12)]">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-sm mb-space-lg">
            <div>
              <div class="flex items-center gap-space-xs text-primary mb-1">
                <span class="material-symbols-outlined text-[24px]">calculate</span>
                <span class="text-sm font-bold">Kalkulator Gizi Cepat (WHO / Kemenkes RI)</span>
              </div>
              <h2 class="text-2xl sm:text-3xl font-bold text-on-surface">
                Cek Status Berat &amp; Tinggi Badan Si Kecil
              </h2>
              <p class="text-sm text-on-surface-variant mt-1">
                Dapatkan evaluasi Z-score antropometri akurat dalam 1 menit sesuai pedoman Posyandu.
              </p>
            </div>
            <div class="inline-flex items-center gap-space-xs bg-surface-container-lowest px-space-md py-1.5 rounded-full text-secondary text-xs font-bold shadow-sm">
              <span class="material-symbols-outlined text-[16px]">verified_user</span>
              <span>Standar Antropometri Kemenkes RI</span>
            </div>
          </div>

          <!-- Quick Interactive Calculator Form -->
          <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md" id="nutriForm" onsubmit="event.preventDefault(); calculateNutri();">
            <!-- Field 1: Gender Toggle -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-on-surface-variant font-semibold">Jenis Kelamin</label>
              <div class="grid grid-cols-2 gap-1 bg-surface-container-lowest p-1 rounded-full shadow-sm h-12 items-center">
                <button class="gender-btn active w-full h-full rounded-full text-xs font-semibold flex items-center justify-center gap-1 bg-primary text-on-primary transition-all" id="btnBoy" onclick="setGender('boy')" type="button">
                  <span class="material-symbols-outlined text-[16px]">male</span> Laki-laki
                </button>
                <button class="gender-btn w-full h-full rounded-full text-xs font-semibold flex items-center justify-center gap-1 text-on-surface-variant hover:text-primary transition-all" id="btnGirl" onclick="setGender('girl')" type="button">
                  <span class="material-symbols-outlined text-[16px]">female</span> Perempuan
                </button>
              </div>
            </div>

            <!-- Field 2: Age in Months -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-on-surface-variant font-semibold" for="inputAge">Usia Balita (Bulan)</label>
              <div class="relative">
                <input class="w-full h-12 bg-surface-container-lowest rounded-full px-space-md text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="inputAge" max="60" min="0" placeholder="Contoh: 14" type="number" value="14">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant">Bulan</span>
              </div>
            </div>

            <!-- Field 3: Weight -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-on-surface-variant font-semibold" for="inputWeight">Berat Badan (kg)</label>
              <div class="relative">
                <input class="w-full h-12 bg-surface-container-lowest rounded-full px-space-md text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="inputWeight" placeholder="Contoh: 9.8" step="0.1" type="number" value="9.8">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant">kg</span>
              </div>
            </div>

            <!-- Field 4: Length/Height -->
            <div class="flex flex-col gap-1.5">
              <label class="text-xs text-on-surface-variant font-semibold" for="inputHeight">Tinggi / Panjang (cm)</label>
              <div class="relative">
                <input class="w-full h-12 bg-surface-container-lowest rounded-full px-space-md text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="inputHeight" placeholder="Contoh: 78" step="0.1" type="number" value="78">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant">cm</span>
              </div>
            </div>

            <!-- Action Submit Button -->
            <div class="sm:col-span-2 lg:col-span-4 flex justify-end mt-space-xs">
              <button class="w-full sm:w-auto px-space-xl py-3 rounded-full bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container text-sm font-bold flex items-center justify-center gap-space-xs shadow-md transition-all" type="submit">
                <span class="material-symbols-outlined text-[20px]">analytics</span>
                <span>Lihat Hasil Analisis Gizi</span>
              </button>
            </div>
          </form>

          <!-- Live Interactive Analysis Result Box -->
          <div class="mt-space-md bg-surface-container-lowest rounded-2xl p-space-md sm:p-space-lg shadow-sm" id="resultBox">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-space-md">
              <div class="flex items-start gap-space-sm">
                <div class="w-12 h-12 rounded-full bg-secondary-container/60 text-secondary flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">task_alt</span>
                </div>
                <div>
                  <div class="flex flex-wrap items-center gap-space-xs">
                    <span class="bg-secondary-container text-on-secondary-container text-xs px-2.5 py-1 rounded-full font-bold" id="badgeStatus">
                      GIZI BAIK &amp; NORMAL
                    </span>
                    <span class="text-on-surface-variant text-xs font-semibold">
                      (Z-score: -0.2 SD • Sesuai Rentang Ideal)
                    </span>
                  </div>
                  <p class="text-sm text-on-surface mt-1.5" id="descRecommendation">
                    <strong>Status Gizi Terkini:</strong> Normal &amp; Sesuai Usia • <strong>Kebutuhan Kalori Harian:</strong> ~950 kkal • <strong>Rekomendasi:</strong> Lanjutkan variasi protein hewani lokal Jember (ikan wader puger, telur ayam kampung, tempe kedelai lokal).
                  </p>
                </div>
              </div>
              <div class="shrink-0 flex items-center gap-space-xs w-full md:w-auto">
                <a class="w-full md:w-auto text-center px-space-md py-2 rounded-full bg-surface-container-high hover:bg-surface-container text-primary text-xs font-bold transition-colors" href="#resep-mpasi">
                  Pilihan MPASI Sesuai Usia
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 3. MODUL INFORMASI KESEHATAN (EDUKASI & PERTUMBUHAN) -->
      <section class="max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop py-space-xl w-full" id="informasi-kesehatan">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-space-xs mb-space-lg">
          <div>
            <span class="text-sm font-bold text-primary tracking-wide uppercase">Panduan Ayah &amp; Bunda</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-on-surface mt-1">
              Edukasi &amp; Informasi Kesehatan Balita
            </h2>
          </div>
          <a class="text-sm text-primary hover:text-primary-container font-bold flex items-center gap-1" href="#informasi-kesehatan">
            Lihat Semua Artikel <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
          
          <!-- Card 1: Stunting HPK -->
          <article class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="relative h-44 w-full overflow-hidden">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbuiMuZsSaw7WsfciVsmka4CAFAN9MoZ8VRKihmQCAc5-p8UQq7U88iNzZkR1VHZJBbQ6iXBbI4E29OTP46FdUFDCTG59LEiZkufAIYYVtwwjBtobXmvu36QleGAD8lt893ba7JcAhPOxyBFOWdycfhlDerXyh0BerbU8g5f_ClW36EmDg0L64KDNbJmLIXfntCgwDbPMSYM1j12TyxjXW_5NR3uovHdLs7EplpmBUWRTmSfHD--MB" alt="Panduan 1000 HPK">
              <span class="absolute top-3 left-3 bg-primary-fixed text-on-primary-fixed-variant text-xs px-2.5 py-1 rounded-full font-bold shadow-sm">
                Tips Posyandu
              </span>
            </div>
            <div class="p-space-md flex flex-col flex-1 justify-between gap-space-sm">
              <div>
                <div class="flex items-center gap-1 text-xs text-on-surface-variant mb-1">
                  <span class="material-symbols-outlined text-[14px]">schedule</span>
                  <span>4 Menit Baca</span>
                </div>
                <h3 class="text-base font-bold text-on-surface group-hover:text-primary transition-colors leading-snug">
                  Cegah Stunting Sejak Dini: Panduan 1000 Hari Pertama Kehidupan (HPK) di Jember
                </h3>
                <p class="text-xs text-on-surface-variant mt-2 line-clamp-2">
                  Kunci optimalisasi masa emas balita lewat nutrisi mikronutrien, sanitasi bersih, dan pemantauan posyandu teratur.
                </p>
              </div>
              <span class="text-xs text-primary font-semibold flex items-center gap-1 pt-space-xs">
                Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
              </span>
            </div>
          </article>

          <!-- Card 2: Imunisasi Dasar 2025 -->
          <article class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="relative h-44 w-full overflow-hidden">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEfxA7j8Y0qOHpgR8dHRcIZ1SlxcO0QDHp6K78R0VXTkOQdJyzPKAJESqIn7DUqz8DJeQovqDWo2eCymnX1rYL5FT9rFFOTqS4SZgTfhuwNWo2XskR_4DvQRrWJOFZyFLZ65JEEjOwxpxL7kzoWOAgNbmVmlKPhZf3GFTiMIdHLzJoOAvaFlmEy0BRJUxk7qRub9fofdEiu4FQY23UP6o53fJz8nh_XzeoWTMvYS4g-wcmLWXwXjU9" alt="Jadwal Imunisasi Dasar Balita">
              <span class="absolute top-3 left-3 bg-secondary-container text-on-secondary-container text-xs px-2.5 py-1 rounded-full font-bold shadow-sm">
                Imunisasi
              </span>
            </div>
            <div class="p-space-md flex flex-col flex-1 justify-between gap-space-sm">
              <div>
                <div class="flex items-center gap-1 text-xs text-on-surface-variant mb-1">
                  <span class="material-symbols-outlined text-[14px]">schedule</span>
                  <span>5 Menit Baca</span>
                </div>
                <h3 class="text-base font-bold text-on-surface group-hover:text-primary transition-colors leading-snug">
                  Jadwal Imunisasi Dasar Lengkap Balita 2025 Sesuai IDAI &amp; Puskesmas
                </h3>
                <p class="text-xs text-on-surface-variant mt-2 line-clamp-2">
                  Daftar vaksin wajib balita mulai dari Hepatitis B, BCG, Polio tetes, hingga PCV dan Rotavirus di fasilitas kesehatan.
                </p>
              </div>
              <span class="text-xs text-primary font-semibold flex items-center gap-1 pt-space-xs">
                Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
              </span>
            </div>
          </article>

          <!-- Card 3: Red Flags Motorik -->
          <article class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="relative h-44 w-full overflow-hidden">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2_UzYS7-r6RkTBYU9mHe3-HYipBcRVYiKzfOJqMjT6eXJNDQi1UWX030s5dbCQK54LUvtm3yhQgNUq-Z3PedMueQApcIX7Z0Dee7D_0G4BDE6FTqmFXm4fd4VvytimhH0XlVYt486tNbQGh8ioa0GFdOkZbBPsLM7aYhhMGdugYermpNhxY1rIO9UsKb-R_-qjrDc3kwA6Wf7gssuKh2wTbqjHsr700vSC7EFAuXyTfbIuDEM1xP9" alt="Red Flags Motorik Anak">
              <span class="absolute top-3 left-3 bg-tertiary-fixed text-on-tertiary-fixed-variant text-xs px-2.5 py-1 rounded-full font-bold shadow-sm">
                Milestone
              </span>
            </div>
            <div class="p-space-md flex flex-col flex-1 justify-between gap-space-sm">
              <div>
                <div class="flex items-center gap-1 text-xs text-on-surface-variant mb-1">
                  <span class="material-symbols-outlined text-[14px]">schedule</span>
                  <span>3 Menit Baca</span>
                </div>
                <h3 class="text-base font-bold text-on-surface group-hover:text-primary transition-colors leading-snug">
                  Mengenal Tanda Red Flags Perkembangan Motorik Anak Usia 1-3 Tahun
                </h3>
                <p class="text-xs text-on-surface-variant mt-2 line-clamp-2">
                  Ketahui kapan orang tua perlu segera berkonsultasi ke dokter spesialis anak mengenai keterlambatan jalan dan bicara.
                </p>
              </div>
              <span class="text-xs text-primary font-semibold flex items-center gap-1 pt-space-xs">
                Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
              </span>
            </div>
          </article>

          <!-- Card 4: Mengatasi GTM -->
          <article class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="relative h-44 w-full overflow-hidden">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuADQtQknczphk_wVvx0S7N4nvbYCq7uaybu67xhIH5r5YrH5_gmy5U8FNFwP5ragaKOJ_4z7iG-kXT513XnbyjAxDuaOau7WQNckS46bm78JHz3_9s9PDjqtVqYRR_FG9X2WQHRE_5mNGOirfJb6pO64S875EdQRdzhJVwsBrJ-xQi3vpDzV__YX8kTSyvGjj1Q7qOZ3-X1N-guoGW3mWD-6DX2F2y5eD_uhkAp-335SbZL7wXeeSPf" alt="Mengatasi Balita GTM">
              <span class="absolute top-3 left-3 bg-primary-fixed text-on-primary-fixed-variant text-xs px-2.5 py-1 rounded-full font-bold shadow-sm">
                Pola Makan
              </span>
            </div>
            <div class="p-space-md flex flex-col flex-1 justify-between gap-space-sm">
              <div>
                <div class="flex items-center gap-1 text-xs text-on-surface-variant mb-1">
                  <span class="material-symbols-outlined text-[14px]">schedule</span>
                  <span>4 Menit Baca</span>
                </div>
                <h3 class="text-base font-bold text-on-surface group-hover:text-primary transition-colors leading-snug">
                  Tips Mengatasi Balita Gerakan Tutup Mulut (GTM) dengan Positif
                </h3>
                <p class="text-xs text-on-surface-variant mt-2 line-clamp-2">
                  Strategi feeding rules tanpa paksaan, menciptakan suasana makan ceria, serta kreasi tekstur makanan menarik.
                </p>
              </div>
              <span class="text-xs text-primary font-semibold flex items-center gap-1 pt-space-xs">
                Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">chevron_right</span>
              </span>
            </div>
          </article>
        </div>
      </section>

      <!-- 4. MODUL MENU & RESEP MPASI ANAK (Kearifan Pangan Lokal Jember) -->
      <section class="bg-surface-container-low/60 py-space-xl w-full" id="resep-mpasi">
        <div class="max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop">
          <div class="text-center max-w-2xl mx-auto mb-space-xl">
            <span class="bg-secondary-container/60 text-secondary text-xs px-3 py-1 rounded-full font-bold">
              Kekayaan Pangan Lokal Jember
            </span>
            <h2 class="text-2xl sm:text-3xl font-bold text-on-surface mt-2">
              Inspirasi MPASI Sehat &amp; Bergizi Si Kecil
            </h2>
            <p class="text-sm text-on-surface-variant mt-2">
              Menu lezat padat gizi rekomendasi dokter anak dan ahli gizi, memanfaatkan kekayaan bahan pangan lokal Jember yang segar, terjangkau, dan kaya nutrisi.
            </p>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg">
            <!-- Recipe 1 -->
            <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
              <div class="relative h-52 w-full">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd9aS7XofD1VvIU3ek94235Hwn0WNFiRoI7m5AcZJkBE4Oys41mpW6ixOZN69h5Y3REdbeq-3KfB3KEQab58vjyh-ON5nBj_azOI435sh7EB2NY-KQ2sIIyuSF8O_01QrL1nxe3bpBa2y63Klk9JSsGJ4uEhV3eFQjRhdsOn35rP1ajwn2CB5bIyWZ4i6S1yam6u4_FpVDPlqnkVsi60WFB-EfvkP5i_XqJ26Ac9f_b4k884-F8hL6" alt="Bubur Tim Salmon Beras Merah">
                <span class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm text-primary text-xs px-3 py-1 rounded-full font-bold shadow-sm">
                  6 - 8 Bulan (Tekstur Halus)
                </span>
              </div>
              <div class="p-space-md sm:p-space-lg flex flex-col flex-1 justify-between gap-space-md">
                <div>
                  <div class="flex items-center gap-space-xs text-xs text-secondary font-bold mb-1">
                    <span class="material-symbols-outlined text-[16px]">eco</span>
                    <span>Tinggi Omega-3 &amp; Zat Besi</span>
                  </div>
                  <h3 class="text-base font-bold text-on-surface">
                    Bubur Tim Salmon Beras Merah &amp; Sayur Bayam Papuma
                  </h3>
                  <p class="text-xs text-on-surface-variant mt-2">
                    Kombinasi serat halus beras merah organik dan bayam segar dari pesisir selatan Jember dengan lemak esensial ikan untuk pertumbuhan otak optimal.
                  </p>
                </div>
                <div>
                  <!-- Nutrition Pill Badges -->
                  <div class="flex flex-wrap gap-1.5 py-space-xs">
                    <span class="bg-primary-fixed/60 text-on-primary-fixed-variant text-xs px-2.5 py-0.5 rounded-full">
                      185 kkal / porsi
                    </span>
                    <span class="bg-surface-container text-on-surface-variant text-xs px-2.5 py-0.5 rounded-full flex items-center gap-1">
                      <span class="material-symbols-outlined text-[14px]">timer</span> 25 Menit
                    </span>
                    <span class="bg-secondary-container/50 text-secondary text-xs px-2.5 py-0.5 rounded-full">
                      Bebas Santan
                    </span>
                  </div>
                  <div class="flex items-center justify-between pt-space-sm mt-space-xs border-t border-outline-variant/30">
                    <span class="text-xs text-on-surface-variant">Alergen: Ikan Laut</span>
                    <button class="text-primary text-xs font-bold hover:underline flex items-center gap-0.5" type="button">
                      Buka Resep <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Recipe 2 -->
            <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
              <div class="relative h-52 w-full">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBwNKRW8La3Rf1GnktTyvvuFSG2Yy4Hd5qVA-bv6uNLlqXJSAb6kxq4wgV8pjscX-XOWcesGGJ6xH2IDkET3LD1hWwC_emvkSW9gWOodSe442QH5IZVh4q2aal1rAC8ZlB2s9OluZ-BAHTFY0BAYovMP2Kq2U7jLYewn4pUw_TWh6fj1VnfMvMo0kqoKh2wILpUYSePY7oVqhGHCqrEltNvDKdHnUEDWuZfcLULBJAmt_XbRkFJ53Kl" alt="Nasi Tim Ayam Kampung Labu Kuning">
                <span class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm text-secondary text-xs px-3 py-1 rounded-full font-bold shadow-sm">
                  9 - 11 Bulan (Cincang Lembut)
                </span>
              </div>
              <div class="p-space-md sm:p-space-lg flex flex-col flex-1 justify-between gap-space-md">
                <div>
                  <div class="flex items-center gap-space-xs text-xs text-tertiary font-bold mb-1">
                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                    <span>Kaya Vitamin A &amp; Beta Karoten</span>
                  </div>
                  <h3 class="text-base font-bold text-on-surface">
                    Nasi Tim Ayam Kampung Suwir Labu Kuning Jember
                  </h3>
                  <p class="text-xs text-on-surface-variant mt-2">
                    Daging ayam kampung gurih berpadu manis alaminya labu kuning lokal Jember, merangsang kemampuan mengunyah si kecil dengan rasa lezat alami.
                  </p>
                </div>
                <div>
                  <div class="flex flex-wrap gap-1.5 py-space-xs">
                    <span class="bg-primary-fixed/60 text-on-primary-fixed-variant text-xs px-2.5 py-0.5 rounded-full">
                      210 kkal / porsi
                    </span>
                    <span class="bg-surface-container text-on-surface-variant text-xs px-2.5 py-0.5 rounded-full flex items-center gap-1">
                      <span class="material-symbols-outlined text-[14px]">timer</span> 30 Menit
                    </span>
                    <span class="bg-secondary-container/50 text-secondary text-xs px-2.5 py-0.5 rounded-full">
                      Tekstur Naik Bertahap
                    </span>
                  </div>
                  <div class="flex items-center justify-between pt-space-sm mt-space-xs border-t border-outline-variant/30">
                    <span class="text-xs text-on-surface-variant">Alergen: Unggas</span>
                    <button class="text-primary text-xs font-bold hover:underline flex items-center gap-0.5" type="button">
                      Buka Resep <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Recipe 3 -->
            <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
              <div class="relative h-52 w-full">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIRWE90gP_38jz7wt19T_Ifvy6VsyQfeoeWj-A6TOPCUqxqTOEqqRXv7o8ju2Qn8-9vcgfuLErLzMVQ_CrVDWKGenAuZwxzvq1qqSsLiebBcxwYRpOX4Gcj9sLVfntztlj_03G2Av2iIECGp1muaf1aZyVWY795a_hWut3Pi94pgMynLrq9zTp_X1vFM7hphcVayPflzFZQZUxtZfxn2buekphW_IaR_iGgF3TKl0o_fB9hDc0QtSm" alt="Nugget Tempe Ikan Kembung Kukus">
                <span class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm text-tertiary text-xs px-3 py-1 rounded-full font-bold shadow-sm">
                  12+ Bulan (Finger Food)
                </span>
              </div>
              <div class="p-space-md sm:p-space-lg flex flex-col flex-1 justify-between gap-space-md">
                <div>
                  <div class="flex items-center gap-space-xs text-xs text-primary font-bold mb-1">
                    <span class="material-symbols-outlined text-[16px]">shield</span>
                    <span>Protein Ganda Anti-Stunting</span>
                  </div>
                  <h3 class="text-base font-bold text-on-surface">
                    Nugget Tempe Ikan Kembung Kukus Home-made
                  </h3>
                  <p class="text-xs text-on-surface-variant mt-2">
                    Inovasi camilan sehat padat nutrisi dari tempe kedelai lokal dan ikan kembung segar kaya kalsium untuk memperkuat tulang dan gigi balita aktif.
                  </p>
                </div>
                <div>
                  <div class="flex flex-wrap gap-1.5 py-space-xs">
                    <span class="bg-primary-fixed/60 text-on-primary-fixed-variant text-xs px-2.5 py-0.5 rounded-full">
                      195 kkal (3 pcs)
                    </span>
                    <span class="bg-surface-container text-on-surface-variant text-xs px-2.5 py-0.5 rounded-full flex items-center gap-1">
                      <span class="material-symbols-outlined text-[14px]">timer</span> 35 Menit
                    </span>
                    <span class="bg-secondary-container/50 text-secondary text-xs px-2.5 py-0.5 rounded-full">
                      Bebas Pengawet
                    </span>
                  </div>
                  <div class="flex items-center justify-between pt-space-sm mt-space-xs border-t border-outline-variant/30">
                    <span class="text-xs text-on-surface-variant">Alergen: Kedelai, Ikan</span>
                    <button class="text-primary text-xs font-bold hover:underline flex items-center gap-0.5" type="button">
                      Buka Resep <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- 5. KEUNGGULAN APLIKASI NUTRIBALITA JEMBER -->
      <section class="max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop py-space-xl w-full">
        <div class="text-center max-w-xl mx-auto mb-space-xl">
          <span class="text-xs font-bold text-secondary uppercase tracking-wider">Sahabat Tumbuh Kembang</span>
          <h2 class="text-2xl sm:text-3xl font-bold text-on-surface mt-1">Mengapa Memilih StunGuard Jember?</h2>
          <p class="text-sm text-on-surface-variant mt-2">
            Dibangun bersama tenaga medis dan kader posyandu untuk memberikan ketenangan hati orang tua di era digital.
          </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
          <!-- Feature 1 -->
          <div class="bg-surface-container-lowest p-space-lg rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/80 text-primary flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">verified</span>
            </div>
            <h3 class="text-base font-bold text-on-surface">Standar WHO &amp; Kemenkes</h3>
            <p class="text-xs text-on-surface-variant mt-2 leading-relaxed">
              Algoritma kurva pertumbuhan akurat sesuai standar antropometri nasional untuk deteksi dini risiko malnutrisi atau stunting.
            </p>
          </div>
          <!-- Feature 2 -->
          <div class="bg-surface-container-lowest p-space-lg rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-secondary-container/80 text-secondary flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">sync</span>
            </div>
            <h3 class="text-base font-bold text-on-surface">Integrasi Posyandu Lokal</h3>
            <p class="text-xs text-on-surface-variant mt-2 leading-relaxed">
              Sinkronisasi catatan KMS digital langsung dengan kader Posyandu di 31 kecamatan se-Kabupaten Jember.
            </p>
          </div>
          <!-- Feature 3 -->
          <div class="bg-surface-container-lowest p-space-lg rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed/80 text-tertiary flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">restaurant</span>
            </div>
            <h3 class="text-base font-bold text-on-surface">Resep Teruji Ahli Gizi</h3>
            <p class="text-xs text-on-surface-variant mt-2 leading-relaxed">
              Variasi menu harian seimbang menggunakan bahan pangan segar dan terjangkau khas daerah Jember.
            </p>
          </div>
          <!-- Feature 4 -->
          <div class="bg-surface-container-lowest p-space-lg rounded-3xl shadow-sm hover:shadow-md transition-shadow flex flex-col items-start">
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/80 text-primary flex items-center justify-center mb-space-sm">
              <span class="material-symbols-outlined text-[26px]">notifications_active</span>
            </div>
            <h3 class="text-base font-bold text-on-surface">Pengingat Jadwal Rutin</h3>
            <p class="text-xs text-on-surface-variant mt-2 leading-relaxed">
              Notifikasi pengingat penimbangan bulanan, jadwal imunisasi anak, dan vitamin A kapsul langsung ke WhatsApp bunda.
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

          const activeClasses = ['bg-primary', 'text-on-primary', 'active'];
          const inactiveClasses = ['text-on-surface-variant', 'hover:text-primary'];

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
          const age = parseFloat(document.getElementById('inputAge').value) || 12;
          const weight = parseFloat(document.getElementById('inputWeight').value) || 9.5;
          const height = parseFloat(document.getElementById('inputHeight').value) || 75;

          const badgeStatus = document.getElementById('badgeStatus');
          const descRec = document.getElementById('descRecommendation');

          // WHO approximation benchmark for demonstration
          const expectedWeight = 8.5 + (age * 0.22);
          const diff = weight - expectedWeight;

          let statusText = "GIZI BAIK & NORMAL";
          let statusClasses = "bg-secondary-container text-on-secondary-container";
          let calories = Math.round(750 + (age * 18));
          let recommendation = "Lanjutkan pola makan gizi seimbang dengan variasi protein hewani lokal Jember (ikan kembung Puger, telur ayam, tempe).";

          if (diff < -1.8) {
            statusText = "PERLU PERHATIAN (BERAT KURANG)";
            statusClasses = "bg-tertiary-fixed text-on-tertiary-fixed-variant";
            recommendation = "Perlu dorongan asupan kalori dan lemak sehat tambahan. Konsultasikan dengan bidan Posyandu atau puskesmas setempat.";
          } else if (diff > 2.5) {
            statusText = "BERAT BADAN LEBIH";
            statusClasses = "bg-primary-fixed text-on-primary-fixed-variant";
            recommendation = "Kurangi camilan tinggi gula kemasan, perbanyak aktivitas eksplorasi gerak fisik dan serat sayuran lokal.";
          }

          badgeStatus.className = `${statusClasses} text-xs px-2.5 py-1 rounded-full font-bold`;
          badgeStatus.innerText = statusText;

          descRec.innerHTML = `<strong>Status Gizi Terkini:</strong> ${statusText} • <strong>Kebutuhan Kalori Harian:</strong> ~${calories} kkal • <strong>Rekomendasi:</strong> ${recommendation}`;

          const box = document.getElementById('resultBox');
          box.classList.add('ring-2', 'ring-primary');
          setTimeout(() => box.classList.remove('ring-2', 'ring-primary'), 800);
        }
      </script>
    </div>
  </main>

  <!-- Footer -->
  <footer class="w-full bg-surface-container-low border-t border-outline-variant/30 mt-space-xl">
    <div class="max-w-[1200px] mx-auto px-margin md:px-margin-tablet lg:px-margin-desktop py-space-xl">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-space-lg mb-space-xl">
        
        <!-- Column 1 & 2: Branding -->
        <div class="md:col-span-2 flex flex-col gap-space-sm">
          <div class="flex items-center gap-space-sm">
            <span class="text-lg text-primary font-bold">StunGuard Jember</span>
          </div>
          <p class="text-sm text-on-surface-variant max-w-md">
            Platform pemantauan tumbuh kembang dan gizi balita terpadu untuk orang tua di Kabupaten Jember, didedikasikan untuk pencegahan stunting dan generasi sehat Jawa Timur.
          </p>
          <div class="flex items-center gap-space-xs text-xs text-secondary font-medium">
            <span class="material-symbols-outlined text-[18px]">verified</span>
            <span>Program Pendampingan Posyandu Binaan Dinas Kesehatan Kabupaten Jember</span>
          </div>
        </div>

        <!-- Column 3: Quick Links -->
        <div class="flex flex-col gap-space-sm">
          <span class="text-base text-on-surface font-semibold">Layanan Terpadu</span>
          <ul class="flex flex-col gap-space-xs text-sm">
            <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="#kalkulator-widget">Kalkulator Gizi</a></li>
            <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="#informasi-kesehatan">Informasi Kesehatan</a></li>
            <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="#resep-mpasi">MPASI Anak</a></li>
          </ul>
        </div>

        <!-- Column 4: Contact / Helpline -->
        <div class="flex flex-col gap-space-sm">
          <span class="text-base text-on-surface font-semibold">Help line Anak Sehat</span>
          <p class="text-xs text-on-surface-variant">Konsultasi dan tanggap gizi balita darurat Kabupaten Jember:</p>
          <div class="flex flex-col gap-space-xs">
            <div class="flex items-center gap-space-xs text-primary text-sm font-semibold">
              <span class="material-symbols-outlined text-[20px]">call</span>
              <span>0800-140-JEMBER (Bebas Pulsa)</span>
            </div>
            <div class="flex items-center gap-space-xs text-on-surface-variant text-xs">
              <span class="material-symbols-outlined text-[18px]">schedule</span>
              <span>Senin - Sabtu: 08.00 - 16.00 WIB</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="border-t border-outline-variant/30 pt-space-md flex flex-col sm:flex-row items-center justify-center gap-space-sm">
        <p class="text-xs text-on-surface-variant text-center">
          &copy; {{ date('Y') }} StunGuard Jember. Seluruh hak cipta dilindungi. Dinas Kesehatan Kabupaten Jember.
        </p>
      </div>
    </div>
  </footer>

</body>
</html>
