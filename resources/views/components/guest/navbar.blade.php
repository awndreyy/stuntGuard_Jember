{{-- resources/views/components/guest/navbar.blade.php --}}
{{-- Navbar / Header untuk halaman Guest (Landing Page) --}}
<header class="fixed top-0 left-0 right-0 z-50 bg-stone-50/90 backdrop-blur-md shadow-[0_4px_16px_-2px_rgba(178,93,114,0.06)]">
  <div class="h-20 max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 flex items-center justify-between gap-4">

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="flex items-center shrink-0">
      <img src="{{ asset('images/logoBesar.png') }}" alt="StunGuard Jember" class="h-10 w-auto object-contain">
    </a>

    {{-- Nav Links (Desktop) --}}
    <nav class="hidden md:flex items-center gap-4">
      <a href="#kalkulator-widget"   class="text-sm font-medium text-stone-600 hover:text-rose-700 transition-colors">Kalkulator Gizi</a>
      <a href="#informasi-kesehatan" class="text-sm font-medium text-stone-600 hover:text-rose-700 transition-colors">Informasi Kesehatan</a>
      <a href="#resep-mpasi"         class="text-sm font-medium text-stone-600 hover:text-rose-700 transition-colors">MPASI Anak</a>
    </nav>

    {{-- CTA Buttons --}}
    <div class="flex items-center gap-2">
      @if (Route::has('login'))
        @auth
          <a href="{{ url('/dashboardUser') }}"
             class="text-sm font-semibold text-rose-700 border border-rose-700 hover:bg-rose-100/30 px-4 py-2 rounded-full transition-all flex items-center justify-center">
            Dashboard
          </a>
        @else
          <a href="{{ route('login') }}"
             class="text-sm font-semibold text-rose-700 border border-rose-700 hover:bg-rose-100/30 px-4 py-2 rounded-full transition-all flex items-center justify-center">
            Masuk
          </a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="text-sm bg-rose-700 text-white hover:bg-rose-600 font-semibold px-4 py-2 rounded-full shadow-[0_4px_16px_-2px_rgba(178,93,114,0.15)] transition-all flex items-center justify-center">
              Daftar
            </a>
          @endif
        @endauth
      @else
        <a href="#login"    class="text-sm font-semibold text-rose-700 border border-rose-700 hover:bg-rose-100/30 px-4 py-2 rounded-full transition-all flex items-center justify-center">Masuk</a>
        <a href="#register" class="text-sm bg-rose-700 text-white hover:bg-rose-600 font-semibold px-4 py-2 rounded-full shadow-[0_4px_16px_-2px_rgba(178,93,114,0.15)] transition-all flex items-center justify-center">Daftar</a>
      @endif
    </div>

    {{-- Hamburger (Mobile) --}}
    <button id="mobile-menu-btn"
            class="md:hidden p-2 rounded-2xl text-stone-600 hover:text-rose-700 hover:bg-rose-50 transition-colors"
            aria-label="Buka menu">
      <span class="material-symbols-outlined text-[24px]">menu</span>
    </button>
  </div>

  {{-- Mobile Dropdown Menu --}}
  <div id="mobile-menu" class="hidden md:hidden bg-stone-50 border-t border-rose-200/30 px-4 pb-4 flex flex-col gap-2">
    <a href="#kalkulator-widget"   class="text-sm font-medium text-stone-600 hover:text-rose-700 py-2 transition-colors">Kalkulator Gizi</a>
    <a href="#informasi-kesehatan" class="text-sm font-medium text-stone-600 hover:text-rose-700 py-2 transition-colors">Informasi Kesehatan</a>
    <a href="#resep-mpasi"         class="text-sm font-medium text-stone-600 hover:text-rose-700 py-2 transition-colors">MPASI Anak</a>
  </div>
</header>

<script>
  document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu?.classList.toggle('hidden');
  });
</script>
