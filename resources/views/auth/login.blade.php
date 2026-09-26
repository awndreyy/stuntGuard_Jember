<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title>{{ $title ?? 'Login - StuntGuard Jember' }}</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Lucide Icons CDN -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          },
          colors: {
            "primary":                  "#a5304d",
            "primary-container":        "#c54964",
            "primary-fixed":            "#ffd9dd",
            "on-primary":               "#ffffff",
            "on-primary-container":     "#fffbff",
            "on-primary-fixed-variant": "#881938",
            "secondary":                "#236b44",
            "secondary-container":      "#a9f3c1",
            "on-secondary":             "#ffffff",
            "on-secondary-container":   "#2a7149",
            "surface":                  "#fdf9f6",
            "surface-low":              "#f7f3f0",
            "surface-container":        "#f1edea",
            "surface-high":             "#ebe7e5",
            "on-surface":               "#1c1b1a",
            "on-surface-variant":       "#574144",
            "outline-variant":          "#ddbfc2",
          },
          borderRadius: {
            DEFAULT: "1rem",
            xl: "1.5rem",
            "2xl": "2rem",
            full: "9999px",
          },
        }
      }
    }
  </script>

  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      -webkit-font-smoothing: antialiased;
    }
    .btn-primary {
      background: linear-gradient(135deg, #a5304d 0%, #c54964 100%);
      transition: all 0.2s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #881938 0%, #a5304d 100%);
      transform: translateY(-1px);
      box-shadow: 0 8px 20px -4px rgba(165, 48, 77, 0.4);
    }
    .btn-primary:active {
      transform: scale(0.98) translateY(0);
    }
    .input-field:focus {
      border-color: #a5304d;
      box-shadow: 0 0 0 3px rgba(165, 48, 77, 0.12);
    }
  </style>
</head>
<body class="min-h-screen bg-[#fdf9f6] relative flex items-center justify-center p-3 sm:p-6 py-6 sm:py-10 overflow-x-hidden overflow-y-auto">

  <!-- Background pattern -->
  <div class="fixed inset-0 bg-[radial-gradient(#ddbfc2_1px,transparent_1px)] [background-size:22px_22px] opacity-50 pointer-events-none"></div>

  <!-- Aksen blur kiri atas (pink/rose) -->
  <div class="fixed -top-24 -left-24 w-80 h-80 bg-[#ffd9dd]/60 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Aksen blur kanan bawah (secondary green) -->
  <div class="fixed -bottom-24 -right-24 w-80 h-80 bg-[#a9f3c1]/40 rounded-full blur-3xl pointer-events-none"></div>

  <!-- Aksen blur tengah -->
  <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[480px] h-[480px] bg-[#ffd9dd]/20 rounded-full blur-[100px] pointer-events-none"></div>

  <!-- KARTU FORM LOGIN -->
  <div class="w-full max-w-[420px] sm:max-w-md bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-[#a5304d]/10 border border-[#ddbfc2]/50 overflow-hidden relative z-10 my-auto">

    <!-- Header -->
    <div class="px-4 sm:px-8 pt-10 sm:pt-8 pb-6 sm:pb-7 text-center border-b border-[#ddbfc2]/30 bg-gradient-to-b from-[#ffd9dd]/40 to-[#ffd9dd]/10 relative overflow-hidden">
      <!-- Dekoratif internal card -->
      <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-[#a5304d]/5 blur-2xl"></div>
      <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-[#a9f3c1]/20 blur-xl"></div>

      <!-- Tombol Kembali -->
      <a href="{{ url('/dashboardGuest') }}" class="absolute top-3.5 left-3.5 sm:top-4 sm:left-4 z-20 inline-flex items-center gap-1.5 text-xs font-semibold text-[#574144] hover:text-[#a5304d] active:scale-95 bg-white/90 hover:bg-white backdrop-blur-xs px-2.5 py-1.5 rounded-lg border border-[#ddbfc2]/60 shadow-sm transition-all" title="Kembali ke halaman sebelumnya">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Kembali</span>
      </a>

      <!-- Logo Brand -->
      <div class="mx-auto w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white shadow-md shadow-[#a5304d]/15 flex items-center justify-center mb-3 sm:mb-3.5 relative z-10 overflow-hidden border border-[#ddbfc2]/30">
        <img src="{{ asset('images/logoBesar.png') }}" alt="StuntGuard Jember" class="w-full h-full object-contain p-1">
      </div>

      <!-- App Title -->
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#1c1b1a] flex items-center justify-center gap-2 mb-1 relative z-10">
        StuntGuard
        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#ffd9dd] text-[#881938] border border-[#ddbfc2]/40 leading-none">JEMBER</span>
      </h1>
      <p class="text-xs sm:text-sm text-[#574144] font-medium relative z-10">Monitoring Gizi &amp; MPASI Balita</p>
    </div>

    <!-- Form Container -->
    <div class="p-5 sm:p-8">
      <h2 class="text-base sm:text-lg font-bold text-[#1c1b1a] mb-5 sm:mb-6 text-center">Login ke StuntGuard</h2>

      <!-- Notifikasi Alert Status/Pesan Sukses -->
      @if (session('status'))
        <div class="mb-4 p-3 bg-[#a9f3c1]/30 border border-[#a9f3c1] text-[#2a7149] text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-[#236b44] shrink-0"></i>
          <span>{{ session('status') }}</span>
        </div>
      @endif

      @if (session('success'))
        <div class="mb-4 p-3 bg-[#a9f3c1]/30 border border-[#a9f3c1] text-[#2a7149] text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-[#236b44] shrink-0"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if (session('error'))
        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <form action="{{ Route::has('login') ? route('login') : url('/login') }}" method="POST" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Email Input -->
        <div>
          <label for="email" class="block text-xs font-semibold text-[#1c1b1a] mb-1.5">Email Address</label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="mail" class="w-4 h-4 {{ $errors->has('email') ? 'text-rose-500' : 'text-[#574144] group-focus-within:text-[#a5304d]' }} transition-colors"></i>
            </div>
            <input
              type="email"
              id="email"
              name="email"
              value="{{ old('email') }}"
              required
              autofocus
              placeholder="nama@email.com"
              class="input-field w-full pl-10 pr-3.5 py-2.5 text-sm bg-[#f7f3f0] border {{ $errors->has('email') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-[#ddbfc2] focus:border-[#a5304d]' }} rounded-xl text-[#1c1b1a] placeholder-[#574144]/60 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
          </div>
          @error('email')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Password Input -->
        <div>
          <div class="flex items-center justify-between mb-1.5">
            <label for="password" class="block text-xs font-semibold text-[#1c1b1a]">Password</label>
            <a href="{{ Route::has('password.request') ? route('password.request') : '#' }}" class="text-xs font-medium text-[#a5304d] hover:text-[#881938] transition-colors">Lupa Password?</a>
          </div>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="lock" class="w-4 h-4 {{ $errors->has('password') ? 'text-rose-500' : 'text-[#574144] group-focus-within:text-[#a5304d]' }} transition-colors"></i>
            </div>
            <input
              type="password"
              id="password"
              name="password"
              required
              placeholder="minimal 6 karakter"
              class="input-field w-full pl-10 pr-10 py-2.5 text-sm bg-[#f7f3f0] border {{ $errors->has('password') ? 'border-rose-300 ring-1 ring-rose-300 bg-rose-50/30' : 'border-[#ddbfc2] focus:border-[#a5304d]' }} rounded-xl text-[#1c1b1a] placeholder-[#574144]/60 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
            <button
              type="button"
              onclick="togglePassword()"
              class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#574144] hover:text-[#a5304d] focus:outline-none p-1.5 cursor-pointer transition-colors"
              tabindex="-1"
              aria-label="Toggle password visibility"
            >
              <i id="eye-icon" data-lucide="eye" class="w-4 h-4"></i>
            </button>
          </div>
          @error('password')
            <p class="text-[11px] text-rose-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Action Buttons -->
        <div class="pt-2">
          <button
            type="submit"
            class="btn-primary w-full flex items-center justify-center gap-2 text-white font-semibold py-2.5 sm:py-3 px-4 rounded-xl shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#a5304d] cursor-pointer text-sm sm:text-base"
          >
            <span>Masuk ke Dashboard</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </button>
        </div>
      </form>

      <!-- Link ke Halaman Registrasi -->
      <div class="mt-5 sm:mt-6 pt-4 sm:pt-5 border-t border-[#ddbfc2]/30 text-center">
        <p class="text-xs sm:text-sm text-[#574144]">
          Belum punya akun?
          <a href="{{ Route::has('register') ? route('register') : url('/register') }}" class="font-semibold text-[#a5304d] hover:text-[#881938] hover:underline inline-flex items-center gap-1 ml-0.5">
            Daftar di sini
          </a>
        </p>
      </div>
    </div>

    <!-- Footer -->
    <div class="px-4 sm:px-8 py-3.5 bg-[#f1edea]/50 border-t border-[#ddbfc2]/30 text-center">
      <p class="text-[11px] sm:text-xs text-[#574144]">
        &copy; {{ date('Y') }} StuntGuard Jember. Hak Cipta Dilindungi.
      </p>
    </div>
  </div>

  <script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();

    // Toggle Password Visibility
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');

      if (!passwordInput || !eyeIcon) return;

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('data-lucide', 'eye-off');
      } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('data-lucide', 'eye');
      }
      lucide.createIcons();
    }
  </script>
</body>
</html>
