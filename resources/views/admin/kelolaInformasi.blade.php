<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Informasi - StuntGuard Jember</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js (Untuk Modal Pop-up) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 h-screen overflow-hidden flex" x-data="{ openModal: false }">

    <!-- Sidebar Admin -->
    <x-admin.sidebar />

    <!-- Main Wrapper -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-y-auto">

        <!-- Main Body -->
        <main class="p-8 space-y-6 flex-1">

            @php
                $editInformation = $editInformation ?? null;
            @endphp

            <!-- Alert Sukses -->
            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
            </div>
            @endif

            <!-- Alert Error Validation -->
            @if (isset($errors) && $errors->any())
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs space-y-1">
                <p class="font-bold">Gagal menyimpan data:</p>
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Kelola Informasi & Edukasi</h1>
                    <p class="text-xs text-slate-500 mt-1">Artikel kesehatan, panduan trimester, dan materi pencegahan stunting</p>
                </div>
                <!-- Tombol Tambah yang Membuka Modal -->
                <button onclick="tambahInformasi()" type="button" class="px-5 py-2.5 bg-rose-700 hover:bg-rose-800 text-white text-xs font-semibold rounded-xl flex items-center gap-2 transition-all shadow-sm cursor-pointer">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Tambah Informasi Baru</span>
                </button>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <tr>
                            <th class="p-4 pl-6">Judul Artikel</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Ringkasan</th>
                            <th class="p-4">Tanggal Buat</th>
                            <th class="p-4 text-center pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($informations ?? [] as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="p-4 pl-6 font-semibold text-slate-800 max-w-xs truncate">
                                {{ $item->title ?? $item->judul ?? '-' }}
                            </td>
                            <td class="p-4 text-slate-600">
                                <span class="px-2.5 py-1 bg-rose-50 text-rose-700 rounded-lg text-[11px] font-medium">
                                    {{ $item->category ?? $item->kategori ?? 'Edukasi' }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-500 max-w-xs truncate">
                                {{ $item->summary ?? $item->ringkasan ?? '-' }}
                            </td>
                            <td class="p-4 text-slate-400 text-[11px]">
                                {{ isset($item->created_at) ? $item->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="p-4 pr-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" onclick="editInformasi({{ json_encode($item) }})" class="p-2 text-slate-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit informasi">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <form action="{{ route('kelolaInformasi.destroy', $item->id_informasi ?? $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus informasi ini?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus informasi">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 text-xs">
                                Belum ada data informasi. Klik tombol <b>"Tambah Informasi Baru"</b> untuk menambahkan data.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah / Edit Informasi -->
    <x-admin.modalTambahInformasi :editInformation="$editInformation ?? null" />

    <script>
        lucide.createIcons();
    </script>
</body>
</html>