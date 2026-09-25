<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title>{{ $title ?? 'Registrasi Akun - StuntGuard Jember' }}</title>
  
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
  </style>
</head>
<body class="min-h-screen bg-slate-50 relative flex items-center justify-center p-3 sm:p-6 py-6 sm:py-10 overflow-x-hidden overflow-y-auto">

  <!-- Pola Titik/Grid Halus -->
  <div class="fixed inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:20px_20px] sm:[background-size:24px_24px] opacity-60 pointer-events-none"></div>

  <!-- Aksen Lingkaran Blur (Teal di Kiri Atas) -->
  <div class="fixed -top-20 -left-20 sm:-top-32 sm:-left-32 w-72 h-72 sm:w-96 sm:h-96 bg-teal-300/35 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Aksen Lingkaran Blur (Emerald di Kanan Bawah) -->
  <div class="fixed -bottom-20 -right-20 sm:-bottom-32 sm:-right-32 w-72 h-72 sm:w-96 sm:h-96 bg-emerald-300/30 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Aksen Lingkaran Blur Lembut di Tengah Belakang Form -->
  <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 sm:w-[550px] h-80 sm:h-[550px] bg-teal-100/40 rounded-full blur-[80px] sm:blur-[100px] pointer-events-none"></div>

  <!-- KARTU FORM REGISTRASI -->
  <div class="w-full max-w-[460px] sm:max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 overflow-hidden relative z-10 my-auto">
    
    <!-- Header -->
    <div class="px-4 sm:px-8 pt-10 sm:pt-8 pb-6 sm:pb-7 text-center border-b border-slate-100 bg-gradient-to-b from-teal-50/70 to-teal-50/30 relative overflow-hidden">
      <!-- Dekoratif internal card -->
      <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-teal-800/5 blur-2xl"></div>
      <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-emerald-500/5 blur-xl"></div>

      <!-- Tombol Kembali / Login -->
      <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="absolute top-3.5 left-3.5 sm:top-4 sm:left-4 z-20 inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-teal-900 active:scale-95 bg-white/90 hover:bg-white backdrop-blur-xs px-2.5 py-1.5 rounded-lg border border-slate-200/80 shadow-xs transition-all" title="Kembali ke halaman login">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Kembali</span>
      </a>
      
      <!-- Brand Icon -->
      <div class="mx-auto w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-teal-800 text-white flex items-center justify-center shadow-md shadow-teal-900/20 mb-3 sm:mb-3.5 relative z-10">
        <i data-lucide="user-plus" class="w-6 h-6 sm:w-7 sm:h-7 stroke-[2.2]"></i>
      </div>

      <!-- Title & Badge -->
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 flex items-center justify-center gap-2 mb-1 relative z-10">
        StuntGuard
        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-teal-100 text-teal-800 border border-teal-200/60 leading-none">JEMBER</span>
      </h1>
      <p class="text-xs sm:text-sm text-slate-500 font-medium relative z-10">Monitoring Gizi & MPASI Balita</p>
    </div>

    <!-- Form Registrasi -->
    <div class="p-5 sm:p-8">
      <div class="mb-4 sm:mb-5 text-center">
        <h2 class="text-base sm:text-lg font-bold text-slate-800">Registrasi Akun</h2>
        <p class="text-xs text-slate-500 mt-0.5">Lengkapi data diri Anda di bawah ini</p>
      </div>

      <!-- Notifikasi Alert Status/Error -->
      @if (session('success'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
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
          <label for="nama" class="block text-xs font-semibold text-slate-700 mb-1 sm:mb-1.5">
            Nama Lengkap <span class="text-rose-500">*</span>
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="user" class="w-4 h-4 {{ ($errors->has('name') || $errors->has('nama')) ? 'text-rose-500' : 'text-slate-400 group-focus-within:text-teal-800' }} transition-colors"></i>
            </div>
            <input 
              type="text" 
              id="nama" 
              name="name" 
              value="{{ old('name', old('nama')) }}"
              required 
              maxlength="30"
              placeholder="Masukkan nama lengkap sesuai KTP" 
              class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-slate-50/70 border {{ ($errors->has('name') || $errors->has('nama')) ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-slate-200 focus:border-teal-800 focus:ring-teal-800/20' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:bg-white transition-all shadow-xs"
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
            <label for="nik" class="block text-xs font-semibold text-slate-700">
              Nomor Induk Kependudukan (NIK) <span class="text-rose-500">*</span>
            </label>
            <span id="nikCounter" class="text-[11px] font-medium text-slate-400">0/16 Digit</span>
          </div>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="credit-card" class="w-4 h-4 {{ $errors->has('nik') ? 'text-rose-500' : 'text-slate-400 group-focus-within:text-teal-800' }} transition-colors"></i>
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
              class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-slate-50/70 border {{ $errors->has('nik') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-slate-200 focus:border-teal-800 focus:ring-teal-800/20' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:bg-white transition-all shadow-xs tracking-wide"
            >
          </div>
          <p id="nikHelp" class="text-[11px] text-slate-400 mt-1">Harus berupa 16 digit angka sesuai KTP</p>
          @error('nik')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Input Email -->
        <div>
          <label for="email" class="block text-xs font-semibold text-slate-700 mb-1 sm:mb-1.5">
            Email Address <span class="text-rose-500">*</span>
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="mail" class="w-4 h-4 {{ $errors->has('email') ? 'text-rose-500' : 'text-slate-400 group-focus-within:text-teal-800' }} transition-colors"></i>
            </div>
            <input 
              type="email" 
              id="email" 
              name="email" 
              value="{{ old('email') }}"
              required 
              placeholder="contoh@gmail.com" 
              class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-slate-50/70 border {{ $errors->has('email') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-slate-200 focus:border-teal-800 focus:ring-teal-800/20' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:bg-white transition-all shadow-xs"
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
          <label for="password" class="block text-xs font-semibold text-slate-700 mb-1 sm:mb-1.5">
            Password <span class="text-rose-500">*</span>
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="lock" class="w-4 h-4 {{ $errors->has('password') ? 'text-rose-500' : 'text-slate-400 group-focus-within:text-teal-800' }} transition-colors"></i>
            </div>
            <input 
              type="password" 
              id="password" 
              name="password" 
              required 
              minlength="6"
              placeholder="Minimal 6 karakter" 
              class="w-full pl-10 pr-10 py-2.5 text-sm bg-slate-50/70 border {{ $errors->has('password') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-slate-200 focus:border-teal-800 focus:ring-teal-800/20' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:bg-white transition-all shadow-xs"
            >
            <button 
              type="button" 
              onclick="togglePasswordVisibility('password', 'eyeIconPassword')" 
              class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none p-1.5 cursor-pointer"
              tabindex="-1"
              aria-label="Toggle password visibility"
            >
              <i id="eyeIconPassword" data-lucide="eye" class="w-4 h-4"></i>
            </button>
          </div>
          <p class="text-[11px] text-slate-400 mt-1">Gunakan minimal 6 karakter</p>
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
            class="mt-0.5 h-4 w-4 rounded border-slate-300 text-teal-800 focus:ring-teal-800/30 accent-teal-800 cursor-pointer shrink-0"
          >
          <label for="terms" class="text-xs text-slate-600 select-none cursor-pointer leading-relaxed">
            Saya menyetujui bahwa data yang saya masukkan adalah benar untuk keperluan sistem monitoring <span class="font-medium text-teal-800">StuntGuard</span>.
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
            class="w-full flex items-center justify-center gap-2 bg-teal-800 hover:bg-teal-900 active:scale-[0.98] text-white font-semibold py-2.5 sm:py-3 px-4 rounded-xl shadow-md shadow-teal-900/15 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-800 transition-all cursor-pointer text-sm sm:text-base"
          >
            <span>Daftar Sekarang</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </button>
        </div>
      </form>

      <!-- Link ke Halaman Login -->
      <div class="mt-4 sm:mt-5 pt-3 sm:pt-4 border-t border-slate-100 text-center">
        <p class="text-xs sm:text-sm text-slate-600">
          Sudah memiliki akun? 
          <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="font-semibold text-teal-800 hover:text-teal-950 hover:underline inline-flex items-center gap-1 ml-0.5">
            Masuk di sini
          </a>
        </p>
      </div>

    </div>
    
    <!-- Footer -->
    <div class="px-4 sm:px-8 py-3.5 bg-slate-50/80 border-t border-slate-100 text-center">
      <p class="text-[11px] sm:text-xs text-slate-500">
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
        nikCounter.className = 'text-[11px] font-semibold text-emerald-600';
        nikHelp.textContent = '✓ Format NIK valid (16 digit)';
        nikHelp.className = 'text-[11px] text-emerald-600 mt-1';
      } else if (length > 0) {
        nikCounter.className = 'text-[11px] font-medium text-amber-600';
        nikHelp.textContent = `Kurang ${16 - length} digit lagi`;
        nikHelp.className = 'text-[11px] text-amber-600 mt-1';
      } else {
        nikCounter.className = 'text-[11px] font-medium text-slate-400';
        nikHelp.textContent = 'Harus berupa 16 digit angka sesuai KTP';
        nikHelp.className = 'text-[11px] text-slate-400 mt-1';
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
