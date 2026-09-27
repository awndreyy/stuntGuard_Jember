{{-- resources/views/components/user/navbar.blade.php --}}
{{-- Navbar / Header untuk halaman User (Dashboard User) --}}
@php
  $userName = Auth::user()->name ?? 'Bunda Siti Rahma';
  $words = explode(' ', trim($userName));
  $initials = '';
  foreach ($words as $w) {
    if (!empty($w)) {
      $initials .= strtoupper(substr($w, 0, 1));
    }
  }
  $initials = substr($initials, 0, 2);
@endphp

<header class="fixed top-0 left-0 right-0 z-50 bg-stone-50/90 backdrop-blur-md shadow-[0_4px_16px_-2px_rgba(178,93,114,0.06)]">
  <div class="h-20 max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 flex items-center justify-between gap-4">

    {{-- Logo --}}
    <a href="{{ route('dashboardUser') }}" class="flex items-center shrink-0">
      <img src="{{ asset('images/logoBesar.png') }}" alt="StunGuard Jember" class="h-10 w-auto object-contain">
    </a>

    {{-- Nav Links (Desktop) --}}
    <nav class="hidden md:flex items-center gap-6">
      <a href="#kalkulator-widget" class="text-sm font-medium text-stone-600 hover:text-rose-700 transition-colors">Kalkulator Gizi</a>
      <a href="#informasi-kesehatan" class="text-sm font-medium text-stone-600 hover:text-rose-700 transition-colors">Informasi Kesehatan</a>
      <a href="#resep-mpasi" class="text-sm font-medium text-stone-600 hover:text-rose-700 transition-colors">MPASI Anak</a>
    </nav>

    {{-- User Profile & Dropdown --}}
    <div class="relative flex items-center gap-3">
      <div class="flex items-center gap-2 cursor-pointer p-1.5 rounded-full hover:bg-rose-50 transition-colors" id="user-menu-btn">
        <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-700 font-bold flex items-center justify-center text-sm border border-rose-200 shadow-sm shrink-0">
          {{ $initials ?: 'US' }}
        </div>
        <div class="hidden sm:flex flex-col text-left">
          <span class="text-sm font-bold text-stone-900 leading-tight">{{ $userName }}</span>
          <span class="text-xs text-stone-500">{{ Auth::user()->role ?? 'Orang Tua' }}</span>
        </div>
        <span class="material-symbols-outlined text-[20px] text-stone-500 hidden sm:inline-block transition-transform duration-200" id="user-chevron">keyboard_arrow_down</span>
      </div>

      <!-- User Dropdown Menu -->
      <div id="user-dropdown" class="hidden absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-lg border border-rose-100 py-2 z-50">
        <div class="px-4 py-2 border-b border-stone-100 sm:hidden">
          <p class="text-sm font-bold text-stone-900">{{ $userName }}</p>
          <p class="text-xs text-stone-500">{{ Auth::user()->email ?? '' }}</p>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="w-full">
          @csrf
          <button type="submit" class="w-full text-left px-4 py-2 text-sm text-stone-700 hover:bg-rose-50 hover:text-rose-700 flex items-center gap-2 transition-colors">
            <span class="material-symbols-outlined text-[18px]">logout</span>
            <span>Keluar</span>
          </button>
        </form>
      </div>

      {{-- Hamburger (Mobile) --}}
      <button id="mobile-menu-btn"
              class="md:hidden p-2 rounded-2xl text-stone-600 hover:text-rose-700 hover:bg-rose-50 transition-colors"
              aria-label="Buka menu">
        <span class="material-symbols-outlined text-[24px]">menu</span>
      </button>
    </div>
  </div>

  {{-- Mobile Dropdown Menu --}}
  <div id="mobile-menu" class="hidden md:hidden bg-stone-50 border-t border-rose-200/30 px-4 pb-4 flex flex-col gap-2">
    <a href="#kalkulator-widget" class="text-sm font-medium text-stone-600 hover:text-rose-700 py-2 transition-colors">Kalkulator Gizi</a>
    <a href="#informasi-kesehatan" class="text-sm font-medium text-stone-600 hover:text-rose-700 py-2 transition-colors">Informasi Kesehatan</a>
    <a href="#resep-mpasi" class="text-sm font-medium text-stone-600 hover:text-rose-700 py-2 transition-colors">MPASI Anak</a>
  </div>
</header>

<script>
  // Toggle User Dropdown
  const userBtn = document.getElementById('user-menu-btn');
  const userDropdown = document.getElementById('user-dropdown');
  const userChevron = document.getElementById('user-chevron');

  userBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    userDropdown?.classList.toggle('hidden');
    userChevron?.classList.toggle('rotate-180');
  });

  document.addEventListener('click', (e) => {
    if (!userDropdown?.contains(e.target) && !userBtn?.contains(e.target)) {
      userDropdown?.classList.add('hidden');
      userChevron?.classList.remove('rotate-180');
    }
  });

  // Mobile Menu Toggle
  document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu?.classList.toggle('hidden');
  });
</script>
