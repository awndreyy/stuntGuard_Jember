{{-- resources/views/admin/partial/table-anak.blade.php --}}
{{-- Tabel Data Anak/Balita --}}
<div id="tab-anak" class="hidden">

    {{-- Card Header --}}
    <div class="px-4 py-3 border-b border-slate-100 flex flex-wrap items-center justify-between gap-3 shrink-0">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-pink-50 text-pink-700 flex items-center justify-center">
                <i data-lucide="baby" class="w-4 h-4"></i>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900">Daftar Anak/Balita</h2>
            </div>
        </div>

        <div class="flex items-center gap-2">
            {{-- Filter Jenis Kelamin --}}
            <div class="hidden sm:flex items-center bg-slate-100/80 p-0.5 rounded-lg text-[11px] font-medium text-slate-600">
                <button class="px-2.5 py-1 rounded-md bg-white text-teal-900 shadow-2xs font-semibold">Semua</button>
                <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Laki-laki</button>
                <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Perempuan</button>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
        <table class="w-full text-left border-collapse min-w-[640px]">
            <thead class="sticky top-0 bg-slate-50/90 backdrop-blur-xs border-b border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider z-10">
                <tr>
                    <th class="py-3 px-4 whitespace-nowrap">Nama Balita</th>
                    <th class="py-3 px-4 whitespace-nowrap">NIK Anak</th>
                    <th class="py-3 px-4 whitespace-nowrap">Nama Orang Tua/Wali</th>
                    <th class="py-3 px-4 whitespace-nowrap">Jenis Kelamin</th>
                    <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                {{-- TODO: ganti dengan @foreach($anaks as $anak) saat data tersedia --}}
                <tr>
                    <td colspan="5" class="py-16 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="baby" class="w-10 h-10 text-slate-200"></i>
                            <span class="text-xs font-semibold text-slate-500">Belum ada data anak/balita</span>
                            <span class="text-[11px] text-slate-400">Data akan muncul setelah orang tua mendaftarkan balita</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Card Footer (Pagination) --}}
    <div class="px-4 py-2.5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 shrink-0">
        <span class="text-center sm:text-left">Menampilkan <strong class="font-semibold text-slate-700">0</strong> data anak/balita</span>

        <div class="flex items-center gap-1.5">
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200/80 bg-white text-slate-400 text-xs font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Sebelumnya</span>
            </button>
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 rounded-lg bg-teal-800 text-white font-bold text-xs flex items-center justify-center shadow-xs">1</button>
            </div>
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200/80 bg-white hover:bg-slate-100 text-slate-700 transition-colors text-xs font-medium">
                <span class="hidden sm:inline">Selanjutnya</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

</div>
