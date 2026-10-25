{{-- resources/views/components/guest/footer.blade.php --}}
{{-- Footer untuk halaman Guest (Landing Page) --}}
<footer class="w-full bg-white border-t border-pink-100">
  <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 py-10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

      {{-- Kolom 1 & 2: Branding --}}
      <div class="md:col-span-2 flex flex-col gap-2">
        <div class="flex items-center gap-2">
          <span class="text-lg text-pink-700 font-bold">StuntGuard Jember</span>
        </div>
        <p class="text-sm text-stone-600 max-w-md">
          Platform pemantauan tumbuh kembang dan gizi balita terpadu untuk orang tua di Kabupaten Jember,
          didedikasikan untuk pencegahan stunting dan generasi sehat Jawa Timur.
        </p>
        <div class="flex items-center gap-1 text-xs text-pink-600 font-medium">
          <span class="material-symbols-outlined text-[18px]">verified</span>
          <span>Informasi pertumbuhan balita dan resep MPASI</span>
        </div>
      </div>

      {{-- Kolom 3: Quick Links --}}
      <div class="flex flex-col gap-2">
        <span class="text-base text-stone-900 font-semibold">Layanan Terpadu</span>
        <ul class="flex flex-col gap-1 text-sm">
          <li><a class="text-stone-600 hover:text-pink-700 transition-colors" href="{{ route('home') }}#kalkulator-widget">Kalkulator Gizi</a></li>
          <li><a class="text-stone-600 hover:text-pink-700 transition-colors" href="{{ route('home') }}#informasi-kesehatan">Informasi Kesehatan</a></li>
          <li><a class="text-stone-600 hover:text-pink-700 transition-colors" href="{{ route('home') }}#resep-mpasi">MPASI Anak</a></li>
        </ul>
      </div>

      {{-- Kolom 4: Helpline --}}
      <div class="flex flex-col gap-2">
        <span class="text-base text-stone-900 font-semibold">Butuh Bantuan Kesehatan?</span>
        <p class="text-xs text-stone-600">Hubungi puskesmas atau tenaga kesehatan terdekat untuk konsultasi dan pemeriksaan balita.</p>
        <div class="flex flex-col gap-1">
          <div class="flex items-center gap-1 text-pink-700 text-sm font-semibold">
            <span class="material-symbols-outlined text-[20px]">call</span>
            <span>Puskesmas terdekat</span>
          </div>
          <div class="flex items-center gap-1 text-stone-600 text-xs">
            <span class="material-symbols-outlined text-[18px]">schedule</span>
            <span>Ikuti jam layanan fasilitas kesehatan setempat</span>
          </div>
        </div>
      </div>

    </div>

    {{-- Copyright --}}
    <div class="border-t border-pink-200/30 pt-4 flex flex-col sm:flex-row items-center justify-center gap-2">
      <p class="text-xs text-stone-600 text-center">
        &copy; {{ date('Y') }} StuntGuard Jember. Seluruh hak cipta dilindungi.
      </p>
    </div>
  </div>
</footer>
