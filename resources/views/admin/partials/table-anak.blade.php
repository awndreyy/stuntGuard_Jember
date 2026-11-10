{{-- Tabel Data Anak/Balita --}}
<div id="tab-anak" class="flex flex-col hidden">

    {{-- Card Header --}}
    <div class="px-4 py-3 border-b border-stone-100 flex flex-wrap items-center justify-between gap-3 shrink-0 bg-white">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-pink-100/70 text-pink-700 flex items-center justify-center">
                <i data-lucide="baby" class="w-4 h-4"></i>
            </div>
            <div>
                <h2 class="text-sm font-bold text-stone-900">Daftar Anak/Balita</h2>
            </div>
        </div>

        <div class="flex items-center gap-2">
            {{-- Filter Jenis Kelamin --}}
            <div class="hidden sm:flex items-center bg-stone-100/80 p-0.5 rounded-lg text-[11px] font-medium text-stone-600">
                <button type="button" onclick="filterBalitaGender('all', this)" class="balita-gender-tab px-2.5 py-1 rounded-md cursor-pointer transition-colors {{ request('gender', 'all') === 'all' ? 'bg-white text-pink-700 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">Semua</button>
                <button type="button" onclick="filterBalitaGender('Laki-laki', this)" class="balita-gender-tab px-2.5 py-1 rounded-md cursor-pointer transition-colors {{ request('gender', 'all') === 'Laki-laki' ? 'bg-white text-pink-700 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">Laki-laki</button>
                <button type="button" onclick="filterBalitaGender('Perempuan', this)" class="balita-gender-tab px-2.5 py-1 rounded-md cursor-pointer transition-colors {{ request('gender', 'all') === 'Perempuan' ? 'bg-white text-pink-700 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">Perempuan</button>
            </div>
        </div>
    </div>

    {{-- Data Table Container (Scrollable Area) --}}
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[640px]">
            <thead class="bg-stone-50 backdrop-blur-xs border-b border-stone-100 text-[10px] font-bold text-stone-500 uppercase tracking-wider z-10">
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
                    <tr class="table-balita-row hover:bg-pink-50/40 transition-colors group" data-gender="{{ $anak->jenis_kelamin }}">
                        <td class="py-3 px-4 font-medium text-stone-900 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-pink-100 text-pink-700 font-bold text-xs flex items-center justify-center shrink-0">
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
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $anak->jenis_kelamin === 'Laki-laki' ? 'bg-blue-50 text-blue-700 border border-blue-200/60' : 'bg-pink-50 text-pink-700 border border-pink-200/60' }}">
                                {{ $anak->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center justify-center gap-1.5">
                                <a href="{{ route('balita.riwayat', $anak) }}" class="inline-flex p-1.5 text-stone-400 hover:text-pink-700 hover:bg-pink-50 rounded transition-colors cursor-pointer" title="Lihat Riwayat" aria-label="Lihat riwayat pengukuran {{ $anak->nama_balita }}">
                                    <i data-lucide="history" class="w-4 h-4"></i>
                                </a>
                                <button type="button" onclick="editBalita(@js($anak))" class="p-1.5 text-stone-400 hover:text-pink-700 hover:bg-pink-50 rounded transition-colors cursor-pointer" title="Edit">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('balita.destroy', $anak->id_balita) }}" method="POST" class="inline-block" data-confirm="delete" data-confirm-name="{{ $anak->nama_balita }}" data-confirm-kind="data balita">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-stone-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors cursor-pointer" title="Hapus">
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

    @include('admin.partials.pagination', ['paginator' => $balita, 'label' => 'balita'])
</div>
