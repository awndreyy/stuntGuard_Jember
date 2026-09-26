{{-- resources/views/components/guest/footer.blade.php --}}
{{-- Footer untuk halaman Guest (Landing Page) --}}
<footer class="w-full bg-stone-100 border-t border-rose-200/30 mt-10">
  <div class="max-w-[1200px] mx-auto px-4 md:px-8 lg:px-12 py-10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

      {{-- Kolom 1 & 2: Branding --}}
      <div class="md:col-span-2 flex flex-col gap-2">
        <div class="flex items-center gap-2">
          <span class="text-lg text-rose-700 font-bold">StunGuard Jember</span>
        </div>
        <p class="text-sm text-stone-600 max-w-md">
          Platform pemantauan tumbuh kembang dan gizi balita terpadu untuk orang tua di Kabupaten Jember,
          didedikasikan untuk pencegahan stunting dan generasi sehat Jawa Timur.
        </p>
        <div class="flex items-center gap-1 text-xs text-emerald-700 font-medium">
          <span class="material-symbols-outlined text-[18px]">verified</span>
          <span>Program Pendampingan Posyandu Binaan Dinas Kesehatan Kabupaten Jember</span>
        </div>
      </div>

      {{-- Kolom 3: Quick Links --}}
      <div class="flex flex-col gap-2">
        <span class="text-base text-stone-900 font-semibold">Layanan Terpadu</span>
        <ul class="flex flex-col gap-1 text-sm">
          <li><a class="text-stone-600 hover:text-rose-700 transition-colors" href="#kalkulator-widget">Kalkulator Gizi</a></li>
          <li><a class="text-stone-600 hover:text-rose-700 transition-colors" href="#informasi-kesehatan">Informasi Kesehatan</a></li>
          <li><a class="text-stone-600 hover:text-rose-700 transition-colors" href="#resep-mpasi">MPASI Anak</a></li>
        </ul>
      </div>

      {{-- Kolom 4: Helpline --}}
      <div class="flex flex-col gap-2">
        <span class="text-base text-stone-900 font-semibold">Help line Anak Sehat</span>
        <p class="text-xs text-stone-600">Konsultasi dan tanggap gizi balita darurat Kabupaten Jember:</p>
        <div class="flex flex-col gap-1">
          <div class="flex items-center gap-1 text-rose-700 text-sm font-semibold">
            <span class="material-symbols-outlined text-[20px]">call</span>
            <span>0800-140-JEMBER (Bebas Pulsa)</span>
          </div>
          <div class="flex items-center gap-1 text-stone-600 text-xs">
            <span class="material-symbols-outlined text-[18px]">schedule</span>
            <span>Senin - Sabtu: 08.00 - 16.00 WIB</span>
          </div>
        </div>
      </div>

    </div>

    {{-- Copyright --}}
    <div class="border-t border-rose-200/30 pt-4 flex flex-col sm:flex-row items-center justify-center gap-2">
      <p class="text-xs text-stone-600 text-center">
        &copy; {{ date('Y') }} StunGuard Jember. Seluruh hak cipta dilindungi. Dinas Kesehatan Kabupaten Jember.
      </p>
    </div>
  </div>
</footer>
