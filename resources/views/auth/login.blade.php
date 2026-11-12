<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title>{{ $title ?? 'Login - StuntGuard Jember' }}</title>
  <!-- Tailwind -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    body {
      font-family: var(--font-sans);
      -webkit-font-smoothing: antialiased;
    }
    .btn-primary {
      background-color: var(--color-brand);
      transition: background-color 0.2s ease;
    }
    .btn-primary:hover {
      background-color: var(--color-brand-hover);
    }
    .input-field:focus {
      border-color: var(--color-brand);
      box-shadow: 0 0 0 3px rgb(219 39 119 / 0.12);
    }
  </style>
</head>
<body class="min-h-screen bg-brand-canvas relative flex items-center justify-center p-3 sm:p-6 py-6 sm:py-10 overflow-x-hidden overflow-y-auto">


  <!-- KARTU FORM LOGIN -->
  <div class="w-full max-w-[420px] sm:max-w-md bg-white rounded-2xl border border-pink-100 overflow-hidden relative z-10 my-auto">

    <!-- Header -->
    <div class="px-4 sm:px-8 pt-10 sm:pt-8 pb-6 sm:pb-7 text-center border-b border-pink-100 bg-pink-50 relative">

      <!-- Tombol Kembali -->
      <a href="{{ url('/') }}" class="absolute top-3.5 left-3.5 sm:top-4 sm:left-4 z-20 inline-flex items-center gap-1.5 text-xs font-semibold text-stone-600 hover:text-pink-700 active:scale-95 bg-white/90 hover:bg-white backdrop-blur-xs px-2.5 py-1.5 rounded-lg border border-pink-200/60 transition-colors" title="Kembali ke halaman sebelumnya">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Kembali</span>
      </a>

      <!-- Logo Brand -->
      <div class="mx-auto w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white flex items-center justify-center mb-3 sm:mb-3.5 relative z-10 overflow-hidden border border-pink-200/30">
        <img src="{{ asset('images/logo-StuntGuard.png') }}" alt="StuntGuard Jember" class="w-full h-full object-contain">
      </div>

      <!-- App Title -->
      <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-stone-900 flex items-center justify-center gap-2 mb-1 relative z-10">
        StuntGuard
      </h1>
      <p class="text-[11px] font-bold text-pink-600 uppercase tracking-wider relative z-10">Kabupaten Jember</p>
      <p class="text-xs sm:text-sm text-stone-600 mt-1 relative z-10">Monitoring Gizi &amp; MPASI Balita</p>
    </div>

    <!-- Form Container -->
    <div class="p-5 sm:p-8">
      <h2 class="text-base sm:text-lg font-bold text-stone-900 mb-5 sm:mb-6 text-center">Login ke StuntGuard</h2>

      <!-- Notifikasi Alert Status/Pesan Sukses -->
      @if (session('status'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-emerald-700 shrink-0"></i>
          <span>{{ session('status') }}</span>
        </div>
      @endif

      @if (session('success'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-emerald-700 shrink-0"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if (session('error'))
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 text-xs rounded-xl flex items-center gap-2">
          <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <form action="{{ route('login.perform') }}" method="POST" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-xs font-semibold text-stone-900 mb-1.5">Email</label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="mail" class="w-4 h-4 {{ $errors->has('email') ? 'text-red-500' : 'text-stone-600 group-focus-within:text-pink-700' }} transition-colors"></i>
            </div>
            <input
              type="text"
              id="email"
              name="email"
              value="{{ old('email') }}"
              required
              autofocus
              placeholder="nama@gmail.com"
              class="input-field w-full pl-10 pr-3.5 py-2.5 text-sm bg-stone-100 border {{ $errors->has('email') ? 'border-red-300 ring-1 ring-red-300 bg-red-50/30' : 'border-pink-200 focus:border-pink-700' }} rounded-xl text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
          </div>
          @error('email')
            <p class="text-[11px] text-red-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Password Input -->
        <div>
          <div class="flex items-center justify-between mb-1.5">
            <label for="password" class="block text-xs font-semibold text-stone-900">Password</label>
          </div>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
              <i data-lucide="lock" class="w-4 h-4 {{ $errors->has('password') ? 'text-red-500' : 'text-stone-600 group-focus-within:text-pink-700' }} transition-colors"></i>
            </div>
            <input
              type="password"
              id="password"
              name="password"
              required
              placeholder="minimal 6 karakter"
              class="input-field w-full pl-10 pr-10 py-2.5 text-sm bg-stone-100 border {{ $errors->has('password') ? 'border-red-300 ring-1 ring-red-300 bg-red-50/30' : 'border-pink-200 focus:border-pink-700' }} rounded-xl text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white transition-all shadow-sm"
            >
            <button
              type="button"
              onclick="togglePassword()"
              class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-stone-600 hover:text-pink-700 focus:outline-none p-1.5 cursor-pointer transition-colors"
              tabindex="-1"
              aria-label="Toggle password visibility"
            >
              <i id="eye-icon" data-lucide="eye" class="w-4 h-4"></i>
            </button>
          </div>
          @error('password')
            <p class="text-[11px] text-red-600 mt-1 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
              <span>{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Action Buttons -->
        <div class="pt-2">
          <button
            type="submit"
            class="btn-primary w-full flex items-center justify-center gap-2 text-white font-semibold py-2.5 sm:py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-700 cursor-pointer text-sm sm:text-base"
          >
            <span>Masuk ke Dashboard</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </button>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="px-4 sm:px-8 py-3.5 bg-pink-50 border-t border-pink-100 text-center">
      <p class="text-[11px] sm:text-xs text-stone-600">
        &copy; {{ date('Y') }} StuntGuard. Dibuat oleh kelompok 2.
      </p>
    </div>
  </div>

  <script>
    // Inisialisasi setelah modul Vite tersedia.
    document.addEventListener('DOMContentLoaded', () => {
      window.lucide?.createIcons();
    });

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
      window.lucide?.createIcons();
    }
  </script>
</body>
</html>
