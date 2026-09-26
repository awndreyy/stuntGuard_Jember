<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title>{{ $title ?? 'Registrasi Akun - StuntGuard Jember' }}</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Lucide Icons CDN -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      -webkit-font-smoothing: antialiased;
    }
    .btn-primary {
      background: linear-gradient(135deg, #be123c 0%, #e11d48 100%);
      transition: all 0.2s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #9f1239 0%, #be123c 100%);
      transform: translateY(-1px);
      box-shadow: 0 8px 20px -4px rgba(190, 18, 60, 0.4);
    }
    .btn-primary:active {
      transform: scale(0.98) translateY(0);
    }
    .input-field:focus {
      border-color: #be123c;
      box-shadow: 0 0 0 3px rgba(190, 18, 60, 0.12);
    }
  </style>
</head>
<body class="min-h-screen bg-stone-50 relative flex items-center justify-center p-3 sm:p-6 py-6 sm:py-10 overflow-x-hidden overflow-y-auto">

  <!-- Background pattern -->
  <div class="fixed inset-0 bg-[radial-gradient(theme(colors.rose.200)_1px,transparent_1px)] [background-size:22px_22px] opacity-50 pointer-events-none"></div>

  <!-- Aksen blur kiri atas (rose) -->
  <div class="fixed -top-24 -left-24 w-80 h-80 bg-rose-100/60 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Aksen blur kanan bawah (emerald) -->
  <div class="fixed -bottom-24 -right-24 w-80 h-80 bg-emerald-200/40 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Aksen blur tengah -->
  <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-rose-100/20 rounded-full blur-[100px] pointer-events-none"></div>

  <!-- KARTU FORM REGISTRASI -->
  <div class="w-full max-w-[460px] sm:max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-rose-700/10 border border-rose-200/50 overflow-hidden relative z-10 my-auto">

    <!-- Header -->
    <div class="px-4 sm:px-8 pt-10 sm:pt-8 pb-6 sm:pb-7 text-center border-b border-rose-200/30 bg-gradient-to-b from-rose-100/40 to-rose-100/10 relative overflow-hidden">
      <!-- Dekoratif internal card -->
      <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-rose-700/5 blur-2xl"></div>
      <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-emerald-200/20 blur-xl"></div>

      <!-- Tombol Kembali / Login -->
      <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="absolute top-3.5 left-3.5 sm:top-4 sm:left-4 z-20 inline-flex items-center gap-1.5 text-xs font-semibold text-stone-600 hover:text-rose-700 active:scale-95 bg-white/90 hover:bg-white backdrop-blur-xs px-2.5 py-1.5 rounded-lg border border-rose-200/60 shadow-sm transition-all" title="Kembali ke halaman login">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Kembali</span>
      </a>

      <!-- Logo Brand -->
      <div class="mx-auto w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white shadow-md shadow-rose-700/15 flex items-center justify-center mb-3 sm:mb-3.5 relative z-10 overflow-hidden border border-rose-200/30">
        <img src="{{ asset('images/logoBesar.png') }}" alt="StuntGuard Jember" class="w-full h-full object-contain p-1">
      </div>

      <!-- Title & Badge -->
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-stone-900 flex items-center justify-center gap-2 mb-1 relative z-10">
        StuntGuard
        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-rose-100 text-rose-900 border border-rose-200/40 leading-none">JEMBER</span>
      </h1>
      <p class="text-xs sm:text-sm text-stone-600 font-medium relative z-10">Monitoring Gizi &amp; MPASI Balita</p>
    </div>

    <!-- Form Registrasi -->
    <div class="p-5 sm:p-8">
      <div class="mb-4 sm:mb-5 text-center">
        <h2 class="text-base sm:text-lg font-bold text-stone-900">Registrasi Akun</h2>
        <p class="text-xs text-stone-600 mt-0.5">Lengkapi data diri Anda di bawah ini</p>
      </div>

      <!-- Notifikasi Alert Status/Error -->
      @if (session('success'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-emerald-700 shrink-0"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if (session('error'))
        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <form action="{{ Route::has('register.store') ? route('register.store') : (Route::has('register') ? route('register') : route('users.store')) }}" method="POST" id="registerForm" class="space-y-3.5 sm:space-y-4">
        @csrf
        <input type="hidden" name="role" value="Orang Tua">

        <!-- Input Nama Lengkap -->
        <div>
          <label for="nama" class="block text-xs font-semibold text-stone-900 mb-1 sm:mb-1.5">
            Nama Lengkap <span class="text-rose-500">*</span>
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="user" class="w-4 h-4 {{ ($errors->has('name') || $errors->has('nama')) ? 'text-rose-500' : 'text-stone-600 group-focus-within:text-rose-700' }} transition-colors"></i>
            </div>
            <input
              type="text"
              id="nama"
              name="name"
              value="{{ old('name', old('nama')) }}"
              required
              maxlength="30"
              oninput="this.value = this.value.replace(/[^a-zA-Z\s'.]/g, '')" 
              pattern="^[a-zA-Z\s'.]+$"
              title="Nama hanya boleh berisi huruf, spasi, titik, atau tanda petik"
              placeholder="Masukkan nama lengkap sesuai KTP"
              class="input-field w-full pl-10 pr-3.5 py-2.5 text-sm bg-stone-100 border {{ ($errors->has('name') || $errors->has('nama')) ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-rose-200 focus:border-rose-700' }} rounded-xl text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
          </div>
          @error('name')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
          @error('nama')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Input NIK -->
        <div>
          <div class="flex flex-wrap items-center justify-between gap-1 mb-1 sm:mb-1.5">
            <label for="nik" class="block text-xs font-semibold text-stone-900">
              Nomor Induk Kependudukan (NIK) <span class="text-rose-500">*</span>
            </label>
            <span id="nikCounter" class="text-[11px] font-medium text-stone-400">0/16 Digit</span>
          </div>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="credit-card" class="w-4 h-4 {{ $errors->has('nik') ? 'text-rose-500' : 'text-stone-600 group-focus-within:text-rose-700' }} transition-colors"></i>
            </div>
            <input
              type="text"
              id="nik"
              name="nik"
              value="{{ old('nik') }}"
              required
              maxlength="16"
              inputmode="numeric"
              pattern="[0-9]{16}"
              placeholder="3509xxxxxxxxxxxx (16 Digit)"
              class="input-field w-full pl-10 pr-3.5 py-2.5 text-sm bg-stone-100 border {{ $errors->has('nik') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-rose-200 focus:border-rose-700' }} rounded-xl text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white transition-all shadow-sm tracking-wide"
            >
          </div>
          <p id="nikHelp" class="text-[11px] text-stone-400 mt-1">Harus berupa 16 digit angka sesuai KTP</p>
          @error('nik')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Input Email -->
        <div>
          <label for="email" class="block text-xs font-semibold text-stone-900 mb-1 sm:mb-1.5">
            Email Address <span class="text-rose-500">*</span>
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="mail" class="w-4 h-4 {{ $errors->has('email') ? 'text-rose-500' : 'text-stone-600 group-focus-within:text-rose-700' }} transition-colors"></i>
            </div>
            <input
              type="email"
              id="email"
              name="email"
              value="{{ old('email') }}"
              required
              placeholder="contoh@gmail.com"
              class="input-field w-full pl-10 pr-3.5 py-2.5 text-sm bg-stone-100 border {{ $errors->has('email') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-rose-200 focus:border-rose-700' }} rounded-xl text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
          </div>
          @error('email')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Input Password -->
        <div>
          <label for="password" class="block text-xs font-semibold text-stone-900 mb-1 sm:mb-1.5">
            Password <span class="text-rose-500">*</span>
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="lock" class="w-4 h-4 {{ $errors->has('password') ? 'text-rose-500' : 'text-stone-600 group-focus-within:text-rose-700' }} transition-colors"></i>
            </div>
            <input
              type="password"
              id="password"
              name="password"
              required
              minlength="6"
              placeholder="Minimal 6 karakter"
              class="input-field w-full pl-10 pr-10 py-2.5 text-sm bg-stone-100 border {{ $errors->has('password') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-rose-200 focus:border-rose-700' }} rounded-xl text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
            <button
              type="button"
              onclick="togglePasswordVisibility('password', 'eyeIconPassword')"
              class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-stone-600 hover:text-rose-700 focus:outline-none p-1.5 cursor-pointer transition-colors"
              tabindex="-1"
              aria-label="Toggle password visibility"
            >
              <i id="eyeIconPassword" data-lucide="eye" class="w-4 h-4"></i>
            </button>
          </div>
          <p class="text-[11px] text-stone-400 mt-1">Gunakan minimal 6 karakter</p>
          @error('password')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Ketentuan & Persetujuan -->
        <div class="flex items-start gap-2.5 pt-1">
          <input
            type="checkbox"
            id="terms"
            name="terms"
            required
            class="mt-0.5 h-4 w-4 rounded border-rose-200 text-rose-700 focus:ring-rose-700/30 accent-rose-700 cursor-pointer shrink-0"
          >
          <label for="terms" class="text-xs text-stone-600 select-none cursor-pointer leading-relaxed">
            Saya menyetujui bahwa data yang saya masukkan adalah benar untuk keperluan sistem monitoring <span class="font-medium text-rose-700">StuntGuard</span>.
          </label>
        </div>
        @error('terms')
          <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
            <span>{{ $message }}</span>
          </p>
        @enderror

        <!-- Action Buttons -->
        <div class="pt-2 sm:pt-3">
          <button
            type="submit"
            class="btn-primary w-full flex items-center justify-center gap-2 text-white font-semibold py-2.5 sm:py-3 px-4 rounded-xl shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-700 transition-all cursor-pointer text-sm sm:text-base"
          >
            <span>Daftar Sekarang</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </button>
        </div>
      </form>

      <!-- Link ke Halaman Login -->
      <div class="mt-4 sm:mt-5 pt-3 sm:pt-4 border-t border-rose-200/30 text-center">
        <p class="text-xs sm:text-sm text-stone-600">
          Sudah memiliki akun?
          <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="font-semibold text-rose-700 hover:text-rose-900 hover:underline inline-flex items-center gap-1 ml-0.5">
            Masuk di sini
          </a>
        </p>
      </div>
    </div>

    <!-- Footer -->
    <div class="px-4 sm:px-8 py-3.5 bg-stone-200/50 border-t border-rose-200/30 text-center">
      <p class="text-[11px] sm:text-xs text-stone-600">
        &copy; {{ date('Y') }} StuntGuard Jember. Hak Cipta Dilindungi.
      </p>
    </div>
  </div>

  <script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();

    // Toggle Password Visibility
    function togglePasswordVisibility(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);

      if (!input || !icon) return;

      if (input.type === 'password') {
        input.type = 'text';
        icon.setAttribute('data-lucide', 'eye-off');
      } else {
        input.type = 'password';
        icon.setAttribute('data-lucide', 'eye');
      }
      lucide.createIcons();
    }

    // NIK Input Handler: Hanya angka & counter digit
    const nikInput = document.getElementById('nik');
    const nikCounter = document.getElementById('nikCounter');
    const nikHelp = document.getElementById('nikHelp');

    function updateNikCounter() {
      // Hapus karakter selain angka
      nikInput.value = nikInput.value.replace(/[^0-9]/g, '');

      const length = nikInput.value.length;
      nikCounter.textContent = `${length}/16 Digit`;

      if (length === 16) {
        nikCounter.className = 'text-[11px] font-semibold text-emerald-700';
        nikHelp.textContent = '✓ Format NIK valid (16 digit)';
        nikHelp.className = 'text-[11px] text-emerald-700 mt-1';
      } else if (length > 0) {
        nikCounter.className = 'text-[11px] font-medium text-amber-600';
        nikHelp.textContent = `Kurang ${16 - length} digit lagi`;
        nikHelp.className = 'text-[11px] text-amber-600 mt-1';
      } else {
        nikCounter.className = 'text-[11px] font-medium text-stone-400';
        nikHelp.textContent = 'Harus berupa 16 digit angka sesuai KTP';
        nikHelp.className = 'text-[11px] text-stone-400 mt-1';
      }
    }

    nikInput.addEventListener('input', updateNikCounter);

    // Inisialisasi counter saat reload (jika old value ada)
    if (nikInput.value.length > 0) {
      updateNikCounter();
    }

    // Form Submit Validation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      if (nikInput.value.length !== 16) {
        e.preventDefault();
        alert('NIK harus berjumlah tepat 16 digit angka!');
        nikInput.focus();
        return false;
      }
    });
  </script>
</body>
</html>
