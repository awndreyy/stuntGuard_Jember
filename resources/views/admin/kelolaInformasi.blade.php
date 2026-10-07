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
            @if ($errors->any())
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
                <button @click="openModal = true" type="button" class="px-5 py-2.5 bg-rose-700 hover:bg-rose-800 text-white text-xs font-semibold rounded-xl flex items-center gap-2 transition-all shadow-sm cursor-pointer">
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
                                    <a href="{{ route('kelolaInformasi.edit', $item->id) }}" class="p-2 text-slate-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors" title="Edit informasi">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('kelolaInformasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus informasi ini?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus informasi">
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

    <!-- MODAL POPUP FORM TAMBAH INFORMASI -->
    <div x-show="openModal" x-cloak class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div @click.away="openModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all">

            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 text-sm">Tambah Informasi & Edukasi Baru</h3>
                <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form action="{{ route('kelolaInformasi.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Artikel / Informasi</label>
                    <input type="text" name="title" required placeholder="Contoh: Pentingnya Asupan Asam Folat" class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori</label>
                    <select name="category" required class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Trimester 1">Trimester 1</option>
                        <option value="Trimester 2">Trimester 2</option>
                        <option value="Trimester 3">Trimester 3</option>
                        <option value="Edukasi Gizi">Edukasi Gizi</option>
                        <option value="Pencegahan Stunting">Pencegahan Stunting</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Ringkasan Singkat</label>
                    <textarea name="summary" rows="3" required placeholder="Tuliskan ringkasan singkat edukasi di sini..." class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Isi Informasi</label>
                    <textarea name="content" rows="5" placeholder="Tuliskan isi lengkap artikel edukasi disini..." class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-rose-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-rose-700">
                </div>

                <label class="inline-flex items-center gap-2 text-xs text-slate-600">
                    <input type="checkbox" name="is_published" value="1" class="rounded border-slate-300 text-rose-700 focus:ring-rose-500">
                    Publikasikan segera
                </label>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-rose-700 hover:bg-rose-800 text-white rounded-xl text-xs font-semibold">Simpan Informasi</button>
                </div>
            </form>
        </div>
    </div>

    @if($editInformation)
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-bold text-slate-800 text-sm">Edit Informasi</h3>
                    <a href="{{ route('kelolaInformasi') }}" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                </div>

                <form action="{{ route('kelolaInformasi.update', $editInformation->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Artikel / Informasi</label>
                        <input type="text" name="title" value="{{ old('title', $editInformation->title) }}" required class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori</label>
                        <select name="category" required class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500">
                            @php $selectedCategory = old('category', $editInformation->category); @endphp
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Trimester 1" {{ $selectedCategory == 'Trimester 1' ? 'selected' : '' }}>Trimester 1</option>
                            <option value="Trimester 2" {{ $selectedCategory == 'Trimester 2' ? 'selected' : '' }}>Trimester 2</option>
                            <option value="Trimester 3" {{ $selectedCategory == 'Trimester 3' ? 'selected' : '' }}>Trimester 3</option>
                            <option value="Edukasi Gizi" {{ $selectedCategory == 'Edukasi Gizi' ? 'selected' : '' }}>Edukasi Gizi</option>
                            <option value="Pencegahan Stunting" {{ $selectedCategory == 'Pencegahan Stunting' ? 'selected' : '' }}>Pencegahan Stunting</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Ringkasan Singkat</label>
                        <textarea name="summary" rows="3" required class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500">{{ old('summary', $editInformation->summary) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Isi Informasi</label>
                        <textarea name="content" rows="5" class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-500">{{ old('content', $editInformation->content) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Thumbnail Baru (opsional)</label>
                        <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-rose-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-rose-700">
                    </div>

                    <label class="inline-flex items-center gap-2 text-xs text-slate-600">
                        <input type="checkbox" name="is_published" value="1" {{ $editInformation->is_published ? 'checked' : '' }} class="rounded border-slate-300 text-rose-700 focus:ring-rose-500">
                        Publikasikan segera
                    </label>

                    <div class="pt-2 flex items-center justify-end gap-2">
                        <a href="{{ route('kelolaInformasi') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-medium">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-rose-700 hover:bg-rose-800 text-white rounded-xl text-xs font-semibold">Perbarui Informasi</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        lucide.createIcons();
    </script>
</body>
</html>