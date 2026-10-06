{{-- Tabel Data Anak/Balita --}}
<div id="tab-anak" class="flex-1 flex flex-col min-h-0 h-full hidden">

    {{-- Card Header --}}
    <div class="px-4 py-3 border-b border-stone-100 flex flex-wrap items-center justify-between gap-3 shrink-0 bg-white">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-rose-100/70 text-rose-700 flex items-center justify-center">
                <i data-lucide="baby" class="w-4 h-4"></i>
            </div>
            <div>
                <h2 class="text-sm font-bold text-stone-900">Daftar Anak/Balita</h2>
            </div>
        </div>

        <div class="flex items-center gap-2">
            {{-- Filter Jenis Kelamin --}}
            <div class="hidden sm:flex items-center bg-stone-100/80 p-0.5 rounded-lg text-[11px] font-medium text-stone-600">
                <button type="button" onclick="filterBalitaGender('all', this)" class="balita-gender-tab px-2.5 py-1 rounded-md bg-white text-rose-700 shadow-2xs font-semibold cursor-pointer transition-colors">Semua</button>
                <button type="button" onclick="filterBalitaGender('Laki-laki', this)" class="balita-gender-tab px-2.5 py-1 rounded-md text-stone-600 hover:text-stone-900 transition-colors cursor-pointer">Laki-laki</button>
                <button type="button" onclick="filterBalitaGender('Perempuan', this)" class="balita-gender-tab px-2.5 py-1 rounded-md text-stone-600 hover:text-stone-900 transition-colors cursor-pointer">Perempuan</button>
            </div>
        </div>
    </div>

    {{-- Data Table Container (Scrollable Area) --}}
    <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
        <table class="w-full text-left border-collapse min-w-[640px]">
            <thead class="sticky top-0 bg-stone-50 backdrop-blur-xs border-b border-stone-100 text-[10px] font-bold text-stone-500 uppercase tracking-wider z-10">
                <tr>
                    <th class="py-3 px-4 whitespace-nowrap">Nama Balita</th>
                    <th class="py-3 px-4 whitespace-nowrap">NIK Anak</th>
                    <th class="py-3 px-4 whitespace-nowrap">Nama Orang Tua/Wali</th>
                    <th class="py-3 px-4 whitespace-nowrap">Jenis Kelamin</th>
                    <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100 text-xs" id="tableBalitaBody">
                @if(isset($balita) && count($balita) > 0)
                    @foreach($balita as $anak)
                    <tr class="table-balita-row hover:bg-rose-50/40 transition-colors group" data-gender="{{ $anak->jenis_kelamin }}">
                        <td class="py-3 px-4 font-medium text-stone-900 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-700 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($anak->nama_balita, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-stone-800">{{ $anak->nama_balita }}</span>
                                    <span class="block text-[10px] text-stone-400">Lahir: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="block text-xs text-stone-700">{{ $anak->nik ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="block text-xs font-medium text-stone-800">{{ $anak->orangTua->name ?? 'Tidak ada data' }}</span>
                            <span class="block text-[10px] text-stone-400">NIK: {{ $anak->orangTua->nik ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $anak->jenis_kelamin === 'Laki-laki' ? 'bg-blue-50 text-blue-700 border border-blue-200/60' : 'bg-rose-50 text-rose-700 border border-rose-200/60' }}">
                                {{ $anak->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center justify-center gap-1.5">
                                <button type="button" onclick="editBalita(@js($anak))" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded transition-colors cursor-pointer" title="Edit Balita">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('balita.destroy', $anak->id_balita) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau menghapus data balita {{ $anak->nama_balita }} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-stone-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors cursor-pointer" title="Hapus Balita">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr id="emptyBalitaFilterRow" class="hidden">
                        <td colspan="5" class="py-12 text-center text-stone-400">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="baby" class="w-8 h-8 text-stone-300"></i>
                                <span class="text-xs font-semibold text-stone-500">Tidak ada data balita dengan filter ini</span>
                            </div>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="5" class="py-16 text-center text-stone-400">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="baby" class="w-10 h-10 text-stone-300"></i>
                                <span class="text-xs font-semibold text-stone-500">Belum ada data anak/balita</span>
                                <span class="text-[11px] text-stone-400">Tekan tombol "Tambah Balita Baru" untuk mendaftarkan data anak</span>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Card Footer --}}
    <div class="px-4 py-2.5 bg-stone-50 border-t border-stone-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-stone-500 shrink-0 mt-auto">
        <span id="balitaCountDisplay" class="text-center sm:text-left">Menampilkan <strong class="font-semibold text-stone-700">{{ isset($balita) ? count($balita) : 0 }}</strong> data anak/balita</span>

        <div class="flex items-center gap-1.5">
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-stone-200 bg-white text-stone-400 text-xs font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Sebelumnya</span>
            </button>
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 rounded-lg bg-rose-700 text-white font-bold text-xs flex items-center justify-center shadow-xs">1</button>
            </div>
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-100 text-stone-700 transition-colors text-xs font-medium">
                <span class="hidden sm:inline">Selanjutnya</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

</div>
