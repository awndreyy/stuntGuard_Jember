<header class="fixed top-0 inset-x-0 z-50 bg-white border-b border-pink-100">
  <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 h-20 flex items-center justify-between">
    <a href="{{ url('/') }}" class="flex items-center gap-2.5" aria-label="StuntGuard Jember - Beranda">
      <img src="{{ asset('images/logo-StuntGuard.png') }}" alt="Logo StuntGuard" class="w-12 h-12 object-contain">
      <div>
        <span class="text-lg font-extrabold text-stone-900 tracking-tight block leading-none">StuntGuard</span>
        <span class="text-[11px] font-bold text-pink-600 tracking-wider uppercase">Kabupaten Jember</span>
      </div>
    </a>
    <nav id="desktopNav" class="hidden md:flex items-center gap-7 text-sm font-semibold text-stone-600">
      <a href="{{ route('home') }}#beranda" class="{{ request()->routeIs('home') ? 'text-pink-700 font-bold' : 'hover:text-pink-600 transition-colors' }}">Beranda</a>
      <a href="{{ route('home') }}#kalkulator-widget" class="hover:text-pink-600 transition-colors">Kalkulator Gizi</a>
      <a href="{{ route('home') }}#resep-mpasi" class="{{ request()->routeIs('public.resep.*') ? 'text-pink-700 font-bold' : 'hover:text-pink-600 transition-colors' }}">Resep MPASI</a>
      <a href="{{ route('home') }}#informasi-kesehatan" class="{{ request()->routeIs('public.informasi.*') ? 'text-pink-700 font-bold' : 'hover:text-pink-600 transition-colors' }}" {{ request()->routeIs('public.informasi.*') ? 'aria-current="page"' : '' }}>Edukasi Kesehatan</a>
    </nav>
    <div class="hidden md:flex items-center gap-2.5">
      @guest
        <a href="{{ route('login') }}" class="text-xs sm:text-sm font-bold text-pink-700 border border-pink-200 hover:bg-pink-50 px-4 py-2 rounded-full transition-all">Masuk</a>
        <a href="{{ route('register') }}" class="text-xs sm:text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded-full transition-colors">Daftar</a>
      @else
        <a href="{{ auth()->user()->role === 'Admin' ? route('dashboardAdmin') : route('dashboardUser') }}" class="text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded-full transition-colors">Dashboard</a>
      @endguest
    </div>
    <button id="mobileMenuButton" type="button" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl border border-pink-100 text-pink-700" aria-label="Buka menu" aria-expanded="false">
      <span class="material-symbols-outlined">menu</span>
    </button>
  </div>
  <nav id="mobileNav" class="hidden md:hidden bg-white border-t border-pink-100 px-5 py-4 space-y-3 text-sm font-semibold text-stone-700">
    <a class="block py-1 hover:text-pink-600" href="{{ route('home') }}#beranda">Beranda</a>
    <a class="block py-1 hover:text-pink-600" href="{{ route('home') }}#kalkulator-widget">Kalkulator Gizi</a>
    <a class="block py-1 {{ request()->routeIs('public.resep.*') ? 'text-pink-700 font-bold' : 'hover:text-pink-600' }}" href="{{ route('home') }}#resep-mpasi">Resep MPASI</a>
    <a class="block py-1 {{ request()->routeIs('public.informasi.*') ? 'text-pink-700 font-bold' : 'hover:text-pink-600' }}" href="{{ route('home') }}#informasi-kesehatan">Edukasi Kesehatan</a>
    @guest 
    <div class="flex gap-2 pt-2">
      <a href="{{ route('login') }}" class="border border-pink-200 text-pink-700 px-4 py-2 rounded-full">Masuk</a>
      <a href="{{ route('register') }}" class="bg-pink-600 text-white px-4 py-2 rounded-full">Daftar</a></div> 
    @else <a href="{{ auth()->user()->role === 'Admin' ? route('dashboardAdmin') : route('dashboardUser') }}" class="inline-block bg-pink-600 text-white px-4 py-2 rounded-full">Dashboard</a> @endguest
  </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
const toggle = document.getElementById('mobileMenuButton');
const menu = document.getElementById('mobileNav');
if (!toggle || !menu) return;
const close = () => { menu.classList.add('hidden'); toggle.setAttribute('aria-expanded','false'); toggle.querySelector('.material-symbols-outlined').textContent = 'menu'; };
toggle.addEventListener('click', () => {
  const closed = menu.classList.toggle('hidden');
  toggle.setAttribute('aria-expanded', String(!closed));
  toggle.querySelector('.material-symbols-outlined').textContent = closed ? 'menu' : 'close';
});
menu.querySelectorAll('a').forEach(link => link.addEventListener('click', close));
});
</script>

