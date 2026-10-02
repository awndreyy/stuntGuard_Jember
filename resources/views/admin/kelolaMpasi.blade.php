<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Resep MPASI - StuntGuard Jember</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        /* Custom subtle scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #f5f5f4;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6d3d1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a29e;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper (16:9 Full Viewport Height Container) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

        <!-- Header Component -->
        <x-admin.header/>

        <!-- Main Content Canvas -->
        <main class="flex-1 overflow-y-auto p-3.5 sm:p-5 flex flex-col gap-4 max-w-[1920px] w-full mx-auto">

            <!-- Top Header & Action Row -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 shrink-0">
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-lg sm:text-xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                            Kelola Resep MPASI
                        </h1>
                        <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                            Pangan Lokal Jember
                        </span>
                    </div>
                    <p class="text-xs text-stone-500 mt-0.5">
                        Kelola direktori menu dan resep Makanan Pendamping ASI bergizi untuk balita usia 6–23 bulan.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="openRecipeModal('create')" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white text-xs font-semibold rounded-xl transition-all shadow-sm hover:shadow cursor-pointer w-full sm:w-auto">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        <span>Tambah Resep Baru</span>
                    </button>
                </div>
            </div>

            <!-- Stats Metric Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 shrink-0">
                <!-- Card 1: Total Resep -->
                <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <span class="text-[11px] font-semibold text-stone-400 block uppercase tracking-wider">Total Resep</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5">
                            <span class="text-xl font-bold text-stone-900" id="stat-total">{{ $totalResep }}</span>
                            <span class="text-[10px] text-emerald-600 font-semibold flex items-center">menu aktif</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center shrink-0">
                        <i data-lucide="utensils-crossed" class="w-5 h-5"></i>
                    </div>
                </div>

                <!-- Card 2: 6-8 Bulan -->
                <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <span class="text-[11px] font-semibold text-blue-600 block uppercase tracking-wider">6 - 8 Bulan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5">
                            <span class="text-xl font-bold text-stone-900">{{ $total68 }}</span>
                            <span class="text-[10px] text-stone-400">Tekstur Lumat Saring</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <i data-lucide="baby" class="w-5 h-5"></i>
                    </div>
                </div>

                <!-- Card 3: 9-11 Bulan -->
                <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <span class="text-[11px] font-semibold text-amber-600 block uppercase tracking-wider">9 - 11 Bulan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5">
                            <span class="text-xl font-bold text-stone-900">{{ $total911 }}</span>
                            <span class="text-[10px] text-stone-400">Cincang Kasar/Lembek</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <i data-lucide="soup" class="w-5 h-5"></i>
                    </div>
                </div>

                <!-- Card 4: 12-23 Bulan -->
                <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <span class="text-[11px] font-semibold text-emerald-600 block uppercase tracking-wider">12 - 23 Bulan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5">
                            <span class="text-xl font-bold text-stone-900">{{ $total1223 }}</span>
                            <span class="text-[10px] text-stone-400">Menu Keluarga/Padat</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                    </div>
                </div>
            </div>

            <!-- Filter & Navigation Toolbar -->
            <div class="bg-white p-3 rounded-2xl border border-stone-200 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-3 shrink-0">
                <!-- Usia Tabs Filter -->
                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
                    <button onclick="filterCategory('all', this)" class="category-tab active-tab px-3 py-1.5 rounded-xl text-xs font-semibold bg-rose-700 text-white shadow-xs transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span>Semua Usia</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-white/20 text-[10px]">{{ $totalResep }}</span>
                    </button>
                    <button onclick="filterCategory('6-8', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        <span>6-8 Bulan</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total68 }}</span>
                    </button>
                    <button onclick="filterCategory('9-11', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <span>9-11 Bulan</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total911 }}</span>
                    </button>
                    <button onclick="filterCategory('12-23', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>12-23 Bulan</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">{{ $total1223 }}</span>
                    </button>
                </div>

                <!-- Search Field -->
                <div class="flex items-center gap-2">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-stone-400">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        </span>
                        <input type="text" id="recipeSearchInput" oninput="searchRecipes()" placeholder="Cari nama resep / bahan..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-stone-50 border border-stone-200 rounded-xl text-stone-700 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                    </div>
                </div>
            </div>

            <!-- RECIPES TABLE CONTAINER -->
            <div id="recipesContainer" class="flex-1 min-h-0 flex flex-col">
                <div id="tableViewWrapper" class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden flex flex-col flex-1">
                    <div class="overflow-x-auto min-w-full flex-1">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-stone-50 border-b border-stone-200 text-[11px] font-bold text-stone-500 uppercase tracking-wider sticky top-0 z-10">
                                <tr>
                                    <th class="py-3 px-4">Nama Resep MPASI</th>
                                    <th class="py-3 px-3">Kategori Usia</th>
                                    <th class="py-3 px-3">Tekstur</th>
                                    <th class="py-3 px-3">Energi & Protein</th>
                                    <th class="py-3 px-3">Waktu / Porsi</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 text-xs text-stone-700" id="tableBody">
                                @forelse($mpasis as $recipe)
                                    @php
                                        $kategoriLabel = match($recipe->kategori_usia) {
                                            '6-8' => '6 - 8 Bulan',
                                            '9-11' => '9 - 11 Bulan',
                                            '12-23' => '12 - 23 Bulan',
                                            default => $recipe->kategori_usia . ' Bulan'
                                        };
                                        $tekstur = match($recipe->kategori_usia) {
                                            '6-8' => 'Lumat Saring',
                                            '9-11' => 'Cincang Kasar',
                                            '12-23' => 'Menu Keluarga',
                                            default => '-'
                                        };
                                        $badgeClass = match($recipe->kategori_usia) {
                                            '6-8' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            '9-11' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            '12-23' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            default => 'bg-stone-50 text-stone-700 border-stone-200'
                                        };
                                        $imageUrl = $recipe->gambar ? (str_starts_with($recipe->gambar, 'http') ? $recipe->gambar : asset($recipe->gambar)) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
                                    @endphp
                                    <tr class="table-recipe-row hover:bg-rose-50/30 transition-colors" data-category="{{ $recipe->kategori_usia }}" data-name="{{ strtolower($recipe->nama_resep) }}">
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $imageUrl }}" class="w-10 h-10 rounded-xl object-cover border border-stone-200 shrink-0" alt="{{ $recipe->nama_resep }}">
                                                <div>
                                                    <span class="font-bold text-stone-900 block">{{ $recipe->nama_resep }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeClass }}">
                                                {{ $kategoriLabel }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-3 font-medium text-stone-600">{{ $tekstur }}</td>
                                        <td class="py-3 px-3">
                                            <span class="font-bold text-rose-700">{{ $recipe->kalori }} kkal</span>
                                            <span class="text-stone-400 text-[10px] block">Protein {{ $recipe->protein }}g</span>
                                        </td>
                                        <td class="py-3 px-3 text-stone-500 text-[11px]">
                                            <span>{{ $recipe->waktu_memasak }} mnt / {{ $recipe->porsi }} porsi</span>
                                        </td>
                                        <td class="py-3 px-3">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Publik
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <div class="inline-flex items-center gap-1">
                                                <button onclick="previewRecipe({{ $recipe->id_resep }})" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Preview"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                                <button onclick="openRecipeModal('edit', {{ $recipe->id_resep }})" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                                <button onclick="deleteRecipe({{ $recipe->id_resep }}, '{{ addslashes($recipe->nama_resep) }}')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-12 text-center text-stone-400 text-xs">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-400 flex items-center justify-center mb-3">
                                                    <i data-lucide="utensils" class="w-6 h-6"></i>
                                                </div>
                                                <h4 class="text-sm font-bold text-stone-800">Belum ada resep MPASI</h4>
                                                <p class="text-xs text-stone-500 mt-1 max-w-sm">Klik tombol "Tambah Resep Baru" di atas untuk menambahkan resep MPASI pertama.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Empty State Search Placeholder -->
                <div id="emptySearchState" class="hidden bg-white rounded-2xl border border-stone-200 p-8 text-center flex-col items-center justify-center my-auto">
                    <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-400 flex items-center justify-center mb-3">
                        <i data-lucide="utensils" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-sm font-bold text-stone-800">Tidak ada resep yang cocok</h4>
                    <p class="text-xs text-stone-500 mt-1 max-w-sm">Coba kata kunci lain atau ubah filter kategori usia di atas.</p>
                </div>

            </div>

            <!-- Footer Note -->
            <footer class="text-center py-2 shrink-0">
                <span class="text-[11px] text-stone-400">© 2026 StuntGuard Jember • Modul Edukasi & Resep MPASI Balita</span>
            </footer>

        </main>
    </div>

    <!-- Hidden Global Delete Form -->
    <form id="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal Tambah / Edit Resep MPASI -->
    @include('components.admin.modalTambahMpasi')

    <!-- Modal Detail / Preview Resep MPASI -->
    @include('components.admin.modalDetailMpasi')

    <!-- NOTIFIKASI TOAST -->
    <div id="toastNotification" class="fixed bottom-5 right-5 bg-stone-900 text-white px-4 py-3 rounded-2xl shadow-xl z-50 hidden items-center gap-3 transition-all duration-300">
        <div id="toastIcon" class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
            <i data-lucide="check" class="w-4 h-4"></i>
        </div>
        <div>
            <p id="toastTitle" class="text-xs font-bold">Berhasil</p>
            <p id="toastMessage" class="text-[11px] text-stone-300">Data resep MPASI berhasil diperbarui.</p>
        </div>
    </div>

    <!-- Script Logic for Interactivity & Modals -->
    <script>
        // Store recipes data from database
        const recipesData = @json($mpasis->keyBy('id_resep'));

        // Init Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });

        // Toggle Sidebar for Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
            if (overlay) {
                overlay.classList.toggle('hidden');
            }
        }

        // Filter Category Tabs
        function filterCategory(category, button) {
            document.querySelectorAll('.category-tab').forEach(btn => {
                btn.classList.remove('active-tab', 'bg-rose-700', 'text-white');
                btn.classList.add('text-stone-600', 'hover:bg-stone-100');
            });
            button.classList.add('active-tab', 'bg-rose-700', 'text-white');
            button.classList.remove('text-stone-600', 'hover:bg-stone-100');

            applyAllFilters();
        }

        // Search Recipe by Keyword
        function searchRecipes() {
            applyAllFilters();
        }

        function applyAllFilters() {
            const activeTab = document.querySelector('.category-tab.active-tab');
            let selectedCategory = 'all';
            if (activeTab) {
                const text = activeTab.innerText.toLowerCase();
                if (text.includes('6-8')) selectedCategory = '6-8';
                else if (text.includes('9-11')) selectedCategory = '9-11';
                else if (text.includes('12-23')) selectedCategory = '12-23';
            }

            const searchQuery = document.getElementById('recipeSearchInput').value.toLowerCase().trim();
            const tableRows = document.querySelectorAll('.table-recipe-row');
            let visibleCount = 0;

            // Filter table rows
            tableRows.forEach(row => {
                const rowCat = row.getAttribute('data-category');
                const rowName = (row.getAttribute('data-name') || '').toLowerCase();

                const matchesCat = (selectedCategory === 'all' || rowCat === selectedCategory);
                const matchesSearch = (!searchQuery || rowName.includes(searchQuery));

                if (matchesCat && matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Empty state
            const emptyState = document.getElementById('emptySearchState');
            const tableWrapper = document.getElementById('tableViewWrapper');
            if (tableRows.length > 0) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                    emptyState.classList.add('flex');
                    if (tableWrapper) tableWrapper.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    emptyState.classList.remove('flex');
                    if (tableWrapper) tableWrapper.classList.remove('hidden');
                }
            }
        }

        // ================= MODAL HANDLERS =================
        function openRecipeModal(mode = 'create', id = null) {
            const modal = document.getElementById('recipeModal');
            const title = document.getElementById('recipeModalTitle');
            const submitBtnText = document.getElementById('submitBtnText');
            const form = document.getElementById('recipeForm');
            const formMethod = document.getElementById('formMethod');

            if (mode === 'create') {
                title.innerText = 'Tambah Resep MPASI Baru';
                submitBtnText.innerText = 'Simpan Resep';
                form.action = "{{ route('mpasi.store') }}";
                formMethod.value = "POST";
                form.reset();

                // Reset ingredient & step list
                const ingList = document.getElementById('ingredientsList');
                if (ingList) {
                    ingList.innerHTML = `
                        <div class="flex items-center gap-2 ingredient-row">
                            <input type="text" name="bahan[]" required placeholder="Contoh: 30 gr Beras Merah Organik" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                            <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    `;
                }

                const stepsList = document.getElementById('stepsList');
                if (stepsList) {
                    stepsList.innerHTML = `
                        <div class="flex items-start gap-2 step-row">
                            <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">1</span>
                            <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah 1..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20"></textarea>
                            <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    `;
                }
            } else if (mode === 'edit' && id && recipesData[id]) {
                const recipe = recipesData[id];
                title.innerText = 'Edit Resep MPASI';
                submitBtnText.innerText = 'Simpan Perubahan';
                form.action = `/mpasi/${id}`;
                formMethod.value = "PUT";

                document.getElementById('formNamaResep').value = recipe.nama_resep || '';
                document.getElementById('formKategoriUsia').value = recipe.kategori_usia || '6-8';
                document.getElementById('formWaktu').value = recipe.waktu_memasak || '';
                document.getElementById('formPorsi').value = recipe.porsi || '';
                document.getElementById('formKalori').value = recipe.kalori || '';
                document.getElementById('formKarbohidrat').value = recipe.karbohidrat || '';
                document.getElementById('formLemak').value = recipe.lemak || '';
                document.getElementById('formProtein').value = recipe.protein || '';
                document.getElementById('formZatBesi').value = recipe.zat_besi || '';
                document.getElementById('formSeng').value = recipe.seng || '';

                if (recipe.gambar && (recipe.gambar.startsWith('http://') || recipe.gambar.startsWith('https://'))) {
                    document.getElementById('formFoto').value = recipe.gambar;
                } else {
                    document.getElementById('formFoto').value = '';
                }

                // Ingredients
                const ingList = document.getElementById('ingredientsList');
                if (ingList) {
                    let bahanArr = Array.isArray(recipe.bahan) ? recipe.bahan : [];
                    if (typeof recipe.bahan === 'string') {
                        try { bahanArr = JSON.parse(recipe.bahan); } catch(e) { bahanArr = [recipe.bahan]; }
                    }
                    if (bahanArr.length === 0) bahanArr = [''];

                    ingList.innerHTML = bahanArr.map(b => `
                        <div class="flex items-center gap-2 ingredient-row">
                            <input type="text" name="bahan[]" required value="${b}" placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                            <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    `).join('');
                }

                // Steps
                const stepsList = document.getElementById('stepsList');
                if (stepsList) {
                    let langkahArr = Array.isArray(recipe.cara_pembuatan) ? recipe.cara_pembuatan : [];
                    if (typeof recipe.cara_pembuatan === 'string') {
                        try { langkahArr = JSON.parse(recipe.cara_pembuatan); } catch(e) { langkahArr = [recipe.cara_pembuatan]; }
                    }
                    if (langkahArr.length === 0) langkahArr = [''];

                    stepsList.innerHTML = langkahArr.map((s, idx) => `
                        <div class="flex items-start gap-2 step-row">
                            <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">${idx + 1}</span>
                            <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah ini..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">${s}</textarea>
                            <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    `).join('');
                }
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            if (window.lucide) lucide.createIcons();
        }

        function closeRecipeModal() {
            const modal = document.getElementById('recipeModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function previewRecipe(id) {
            const recipe = recipesData[id];
            if (recipe) {
                // Image
                const img = document.getElementById('prevImage');
                if (img) {
                    let imageUrl = recipe.gambar;
                    if (!imageUrl) {
                        imageUrl = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
                    } else if (!imageUrl.startsWith('http://') && !imageUrl.startsWith('https://')) {
                        imageUrl = '/' + imageUrl.replace(/^\//, '');
                    }
                    img.src = imageUrl;
                }

                // Badges & Title
                const badgeAge = document.getElementById('prevBadgeAge');
                let ageLabel = recipe.kategori_usia + ' Bulan';
                let badgeColor = 'bg-blue-600';
                if (recipe.kategori_usia === '6-8') { ageLabel = '6 - 8 Bulan'; badgeColor = 'bg-blue-600'; }
                else if (recipe.kategori_usia === '9-11') { ageLabel = '9 - 11 Bulan'; badgeColor = 'bg-amber-600'; }
                else if (recipe.kategori_usia === '12-23') { ageLabel = '12 - 23 Bulan'; badgeColor = 'bg-emerald-600'; }

                if (badgeAge) {
                    badgeAge.innerText = ageLabel;
                    badgeAge.className = `${badgeColor} text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs`;
                }

                const prevTitle = document.getElementById('prevTitle');
                if (prevTitle) prevTitle.innerText = recipe.nama_resep;

                const prevWaktu = document.getElementById('prevWaktu');
                if (prevWaktu) prevWaktu.innerText = `${recipe.waktu_memasak} Menit`;

                const prevPorsi = document.getElementById('prevPorsi');
                if (prevPorsi) prevPorsi.innerText = `${recipe.porsi} Porsi`;

                // Nutrisi
                const prevKalori = document.getElementById('prevKalori');
                if (prevKalori) prevKalori.innerText = `${recipe.kalori} kkal`;

                const prevKarbohidrat = document.getElementById('prevKarbohidrat');
                if (prevKarbohidrat) prevKarbohidrat.innerText = `${recipe.karbohidrat} gr`;

                const prevLemak = document.getElementById('prevLemak');
                if (prevLemak) prevLemak.innerText = `${recipe.lemak} gr`;

                const prevProtein = document.getElementById('prevProtein');
                if (prevProtein) prevProtein.innerText = `${recipe.protein} gr`;

                const prevZatBesi = document.getElementById('prevZatBesi');
                if (prevZatBesi) prevZatBesi.innerText = `${recipe.zat_besi} mg`;

                const prevSeng = document.getElementById('prevSeng');
                if (prevSeng) prevSeng.innerText = `${recipe.seng} mg`;

                // Bahan
                const ingList = document.getElementById('prevIngredientsList');
                if (ingList) {
                    let bahanArr = Array.isArray(recipe.bahan) ? recipe.bahan : [];
                    if (typeof recipe.bahan === 'string') {
                        try { bahanArr = JSON.parse(recipe.bahan); } catch(e) { bahanArr = [recipe.bahan]; }
                    }

                    ingList.innerHTML = bahanArr.map(b => `
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            <span>${b}</span>
                        </li>
                    `).join('');
                }

                // Langkah
                const stepsList = document.getElementById('prevStepsList');
                if (stepsList) {
                    let langkahArr = Array.isArray(recipe.cara_pembuatan) ? recipe.cara_pembuatan : [];
                    if (typeof recipe.cara_pembuatan === 'string') {
                        try { langkahArr = JSON.parse(recipe.cara_pembuatan); } catch(e) { langkahArr = [recipe.cara_pembuatan]; }
                    }

                    stepsList.innerHTML = langkahArr.map((s, idx) => `
                        <li class="flex items-start gap-2.5 bg-stone-50/50 p-2.5 rounded-xl border border-stone-100">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">${idx + 1}</span>
                            <span class="leading-relaxed">${s}</span>
                        </li>
                    `).join('');
                }
            }

            const modal = document.getElementById('previewModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            if (window.lucide) lucide.createIcons();
        }

        function closePreviewModal() {
            const modal = document.getElementById('previewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function deleteRecipe(id, name) {
            if (confirm(`Apakah Anda yakin ingin menghapus resep "${name}"?`)) {
                const form = document.getElementById('globalDeleteForm');
                form.action = `/mpasi/${id}`;
                form.submit();
            }
        }

        function addIngredientRow() {
            const list = document.getElementById('ingredientsList');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 ingredient-row';
            row.innerHTML = `
                <input type="text" name="bahan[]" required placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
            `;
            list.appendChild(row);
            if (window.lucide) lucide.createIcons();
        }

        function removeIngredientRow(btn) {
            const list = document.getElementById('ingredientsList');
            if (list.children.length > 1) {
                btn.closest('.ingredient-row').remove();
            } else {
                alert('Minimal harus ada 1 bahan.');
            }
        }

        function addStepRow() {
            const list = document.getElementById('stepsList');
            const stepNum = list.children.length + 1;
            const row = document.createElement('div');
            row.className = 'flex items-start gap-2 step-row';
            row.innerHTML = `
                <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">${stepNum}</span>
                <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah ini..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20"></textarea>
                <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
            `;
            list.appendChild(row);
            updateStepNumbers();
            if (window.lucide) lucide.createIcons();
        }

        function removeStepRow(btn) {
            const list = document.getElementById('stepsList');
            if (list.children.length > 1) {
                btn.closest('.step-row').remove();
                updateStepNumbers();
            } else {
                alert('Minimal harus ada 1 langkah pembuatan.');
            }
        }

        function updateStepNumbers() {
            document.querySelectorAll('.step-num').forEach((el, index) => {
                el.innerText = index + 1;
            });
        }

        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toastNotification');
            const iconContainer = document.getElementById('toastIcon');

            document.getElementById('toastTitle').innerText = title;
            document.getElementById('toastMessage').innerText = message;

            if (type === 'error') {
                iconContainer.className = 'w-6 h-6 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center';
                iconContainer.innerHTML = '<i data-lucide="alert-circle" class="w-4 h-4"></i>';
            } else {
                iconContainer.className = 'w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center';
                iconContainer.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i>';
            }

            toast.classList.remove('hidden');
            toast.classList.add('flex');
            if (window.lucide) lucide.createIcons();

            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 4000);
        }

        // Close on background backdrop click
        document.addEventListener('DOMContentLoaded', () => {
            const recipeModal = document.getElementById('recipeModal');
            const recipeModalContainer = document.getElementById('recipeModalContainer');
            if (recipeModal && recipeModalContainer) {
                recipeModal.addEventListener('click', (e) => {
                    if (!recipeModalContainer.contains(e.target)) closeRecipeModal();
                });
            }

            const previewModal = document.getElementById('previewModal');
            const previewModalContainer = document.getElementById('previewModalContainer');
            if (previewModal && previewModalContainer) {
                previewModal.addEventListener('click', (e) => {
                    if (!previewModalContainer.contains(e.target)) closePreviewModal();
                });
            }
        });

        // format tanggal
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
        const today = new Date().toLocaleDateString('id-ID', dateOptions);
        const dateElement = document.getElementById('current-date');
        if (dateElement) {
            dateElement.innerText = today;
        }
    </script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast('Berhasil', "{{ session('success') }}", 'success');
            });
        </script>
    @endif

    @if(isset($errors) && $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast('Gagal Menyimpan', "{{ $errors->first() }}", 'error');
            });
        </script>
    @endif
</body>
</html>
