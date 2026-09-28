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
        <x-admin.header searchPlaceholder="Cari resep MPASI, bahan lokal, usia..." />

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
                            <span class="text-xl font-bold text-stone-900" id="stat-total">18</span>
                            <span class="text-[10px] text-emerald-600 font-semibold flex items-center">+3 baru</span>
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
                            <span class="text-xl font-bold text-stone-900">6</span>
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
                            <span class="text-xl font-bold text-stone-900">7</span>
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
                            <span class="text-xl font-bold text-stone-900">5</span>
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
                        <span class="px-1.5 py-0.2 rounded-md bg-white/20 text-[10px]">18</span>
                    </button>
                    <button onclick="filterCategory('6-8', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        <span>6-8 Bulan</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">6</span>
                    </button>
                    <button onclick="filterCategory('9-11', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <span>9-11 Bulan</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">7</span>
                    </button>
                    <button onclick="filterCategory('12-23', this)" class="category-tab px-3 py-1.5 rounded-xl text-xs font-semibold text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>12-23 Bulan</span>
                        <span class="px-1.5 py-0.2 rounded-md bg-stone-100 text-[10px] text-stone-500">5</span>
                    </button>
                </div>

                <!-- Search & View Mode Switcher -->
                <div class="flex items-center gap-2">
                    <!-- Live Search Field -->
                    <div class="relative flex-1 sm:w-64">
                        <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-stone-400">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        </span>
                        <input type="text" id="recipeSearchInput" oninput="searchRecipes()" placeholder="Cari nama resep / bahan..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-stone-50 border border-stone-200 rounded-xl text-stone-700 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                    </div>

                    <!-- Local Ingredients Filter -->
                    <select id="localIngredientFilter" onchange="filterLocal()" class="px-2.5 py-1.5 text-xs bg-stone-50 border border-stone-200 rounded-xl text-stone-700 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 cursor-pointer">
                        <option value="all">Semua Pangan</option>
                        <option value="lokal">Hanya Kearifan Lokal Jember</option>
                        <option value="tinggi-zat-besi">Tinggi Zat Besi</option>
                        <option value="omega3">Tinggi Omega-3</option>
                    </select>

                    <!-- View Switcher (Grid vs Table) -->
                    <div class="flex items-center bg-stone-100 p-0.5 rounded-xl border border-stone-200/80">
                        <button id="viewGridBtn" onclick="setViewMode('grid')" class="p-1.5 rounded-lg bg-white text-rose-700 shadow-2xs transition-all cursor-pointer" title="Tampilan Kartu">
                            <i data-lucide="layout-grid" class="w-3.5 h-3.5"></i>
                        </button>
                        <button id="viewTableBtn" onclick="setViewMode('table')" class="p-1.5 rounded-lg text-stone-400 hover:text-stone-700 transition-all cursor-pointer" title="Tampilan Tabel">
                            <i data-lucide="table" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- RECIPES CONTAINER (Card View & Table View) -->
            <div id="recipesContainer" class="flex-1 min-h-0">

                <!-- 1. GRID CARD VIEW (Default) -->
                <div id="gridViewWrapper" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                    <!-- Recipe Card 1 -->
                    <div class="recipe-card bg-white rounded-2xl border border-stone-200 shadow-2xs hover:shadow-md transition-all overflow-hidden flex flex-col group" data-category="6-8" data-local="lokal omega3 tinggi-zat-besi" data-name="Bubur Tim Salmon Beras Merah Sayur Bayam Papuma">
                        <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd9aS7XofD1VvIU3ek94235Hwn0WNFiRoI7m5AcZJkBE4Oys41mpW6ixOZN69h5Y3REdbeq-3KfB3KEQab58vjyh-ON5nBj_azOI435sh7EB2NY-KQ2sIIyuSF8O_01QrL1nxe3bpBa2y63Klk9JSsGJ4uEhV3eFQjRhdsOn35rP1ajwn2CB5bIyWZ4i6S1yam6u4_FpVDPlqnkVsi60WFB-EfvkP5i_XqJ26Ac9f_b4k884-F8hL6" alt="Bubur Tim Salmon" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
                            
                            <!-- Badges on Image -->
                            <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5">
                                <span class="bg-blue-600/95 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <i data-lucide="baby" class="w-3 h-3"></i> 6 - 8 Bulan
                                </span>
                                <span class="bg-emerald-600/90 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    Lokal Jember
                                </span>
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dipublikasikan
                            </span>

                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-white">
                                <span class="text-[11px] font-medium text-rose-200 block">Kaya Omega-3 & Zat Besi</span>
                                <h3 class="text-sm font-bold leading-snug drop-shadow-xs line-clamp-1">Bubur Tim Salmon Beras Merah & Bayam Papuma</h3>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 flex-1 flex flex-col justify-between gap-3">
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                Kombinasi beras merah organik dan bayam segar pesisir Papuma Jember dengan salmon kaya DHA untuk optimasi saraf otak anak.
                            </p>

                            <!-- Nutrition & Quick Info Badges -->
                            <div class="grid grid-cols-3 gap-1.5 py-2 border-y border-stone-100 text-center">
                                <div class="bg-rose-50/70 p-1.5 rounded-xl border border-rose-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Energi</span>
                                    <span class="block text-xs font-bold text-rose-700">185 kkal</span>
                                </div>
                                <div class="bg-blue-50/70 p-1.5 rounded-xl border border-blue-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Protein</span>
                                    <span class="block text-xs font-bold text-blue-700">7.5 gr</span>
                                </div>
                                <div class="bg-amber-50/70 p-1.5 rounded-xl border border-amber-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Tekstur</span>
                                    <span class="block text-xs font-bold text-amber-700">Lumat Saring</span>
                                </div>
                            </div>

                            <!-- Meta Info & Actions -->
                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-3 text-[11px] text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-stone-400"></i> 25 mnt
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-stone-400"></i> 2 porsi
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <button onclick="previewRecipe(1)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openRecipeModal('edit', 1)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit Resep">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteRecipe(1, 'Bubur Tim Salmon Beras Merah & Bayam Papuma')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Resep">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 2 -->
                    <div class="recipe-card bg-white rounded-2xl border border-stone-200 shadow-2xs hover:shadow-md transition-all overflow-hidden flex flex-col group" data-category="9-11" data-local="lokal tinggi-zat-besi" data-name="Nasi Tim Ayam Kampung Suwir Labu Kuning Jember">
                        <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBwNKRW8La3Rf1GnktTyvvuFSG2Yy4Hd5qVA-bv6uNLlqXJSAb6kxq4wgV8pjscX-XOWcesGGJ6xH2IDkET3LD1hWwC_emvkSW9gWOodSe442QH5IZVh4q2aal1rAC8ZlB2s9OluZ-BAHTFY0BAYovMP2Kq2U7jLYewn4pUw_TWh6fj1VnfMvMo0kqoKh2wILpUYSePY7oVqhGHCqrEltNvDKdHnUEDWuZfcLULBJAmt_XbRkFJ53Kl" alt="Nasi Tim Ayam Kampung" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
                            
                            <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5">
                                <span class="bg-amber-600/95 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <i data-lucide="soup" class="w-3 h-3"></i> 9 - 11 Bulan
                                </span>
                                <span class="bg-emerald-600/90 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    Lokal Jember
                                </span>
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dipublikasikan
                            </span>

                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-white">
                                <span class="text-[11px] font-medium text-amber-200 block">Kaya Vitamin A & Beta Karoten</span>
                                <h3 class="text-sm font-bold leading-snug drop-shadow-xs line-clamp-1">Nasi Tim Ayam Kampung Suwir Labu Kuning Jember</h3>
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col justify-between gap-3">
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                Daging ayam kampung asli dan manis alami labu lokal Jember, merangsang kemampuan oromotor mengunyah bayi dengan rasa gurih alami.
                            </p>

                            <div class="grid grid-cols-3 gap-1.5 py-2 border-y border-stone-100 text-center">
                                <div class="bg-rose-50/70 p-1.5 rounded-xl border border-rose-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Energi</span>
                                    <span class="block text-xs font-bold text-rose-700">210 kkal</span>
                                </div>
                                <div class="bg-blue-50/70 p-1.5 rounded-xl border border-blue-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Protein</span>
                                    <span class="block text-xs font-bold text-blue-700">8.8 gr</span>
                                </div>
                                <div class="bg-amber-50/70 p-1.5 rounded-xl border border-amber-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Tekstur</span>
                                    <span class="block text-xs font-bold text-amber-700">Cincang Kasar</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-3 text-[11px] text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-stone-400"></i> 30 mnt
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-stone-400"></i> 3 porsi
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <button onclick="previewRecipe(2)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openRecipeModal('edit', 2)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit Resep">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteRecipe(2, 'Nasi Tim Ayam Kampung Suwir Labu Kuning Jember')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Resep">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 3 -->
                    <div class="recipe-card bg-white rounded-2xl border border-stone-200 shadow-2xs hover:shadow-md transition-all overflow-hidden flex flex-col group" data-category="12-23" data-local="lokal omega3 tinggi-zat-besi" data-name="Sup Bola-Bola Ikan Tenggiri Sayur Pelangi Puger">
                        <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                            <img src="https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=600&q=80" alt="Sup Bola Ikan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
                            
                            <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5">
                                <span class="bg-emerald-600/95 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <i data-lucide="sparkles" class="w-3 h-3"></i> 12 - 23 Bulan
                                </span>
                                <span class="bg-emerald-600/90 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    Lokal Puger
                                </span>
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dipublikasikan
                            </span>

                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-white">
                                <span class="text-[11px] font-medium text-emerald-200 block">Kalsium, Protein Hewani & Serat</span>
                                <h3 class="text-sm font-bold leading-snug drop-shadow-xs line-clamp-1">Sup Bola-Bola Ikan Tenggiri Sayur Pelangi Puger</h3>
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col justify-between gap-3">
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                Ikan tenggiri segar dari TPI Puger dibentuk bola kenyal lembut berpadu wortel, jagung manis, dan kuah kaldu rempah bening gurih.
                            </p>

                            <div class="grid grid-cols-3 gap-1.5 py-2 border-y border-stone-100 text-center">
                                <div class="bg-rose-50/70 p-1.5 rounded-xl border border-rose-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Energi</span>
                                    <span class="block text-xs font-bold text-rose-700">245 kkal</span>
                                </div>
                                <div class="bg-blue-50/70 p-1.5 rounded-xl border border-blue-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Protein</span>
                                    <span class="block text-xs font-bold text-blue-700">11.2 gr</span>
                                </div>
                                <div class="bg-amber-50/70 p-1.5 rounded-xl border border-amber-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Tekstur</span>
                                    <span class="block text-xs font-bold text-amber-700">Menu Keluarga</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-3 text-[11px] text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-stone-400"></i> 35 mnt
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-stone-400"></i> 3 porsi
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <button onclick="previewRecipe(3)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openRecipeModal('edit', 3)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit Resep">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteRecipe(3, 'Sup Bola-Bola Ikan Tenggiri Sayur Pelangi Puger')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Resep">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 4 -->
                    <div class="recipe-card bg-white rounded-2xl border border-stone-200 shadow-2xs hover:shadow-md transition-all overflow-hidden flex flex-col group" data-category="6-8" data-local="tinggi-zat-besi" data-name="Purée Hati Sapi Organik & Labu Madu Halus">
                        <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                            <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=600&q=80" alt="Pure Hati Sapi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
                            
                            <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5">
                                <span class="bg-blue-600/95 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <i data-lucide="baby" class="w-3 h-3"></i> 6 - 8 Bulan
                                </span>
                                <span class="bg-rose-600/90 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    Zat Besi Tinggi
                                </span>
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dipublikasikan
                            </span>

                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-white">
                                <span class="text-[11px] font-medium text-rose-200 block">Booster Hb & Cegah Anemia Defisiensi Besi</span>
                                <h3 class="text-sm font-bold leading-snug drop-shadow-xs line-clamp-1">Purée Hati Sapi Organik & Labu Madu Halus</h3>
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col justify-between gap-3">
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                Hati sapi kaya heme iron berpadu kelembutan labu madu kukus, dirancang khusus untuk memenuhi kebutuhan zat besi harian bayi 6 bulan.
                            </p>

                            <div class="grid grid-cols-3 gap-1.5 py-2 border-y border-stone-100 text-center">
                                <div class="bg-rose-50/70 p-1.5 rounded-xl border border-rose-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Energi</span>
                                    <span class="block text-xs font-bold text-rose-700">170 kkal</span>
                                </div>
                                <div class="bg-blue-50/70 p-1.5 rounded-xl border border-blue-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Protein</span>
                                    <span class="block text-xs font-bold text-blue-700">8.2 gr</span>
                                </div>
                                <div class="bg-amber-50/70 p-1.5 rounded-xl border border-amber-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Tekstur</span>
                                    <span class="block text-xs font-bold text-amber-700">Lumat Halus</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-3 text-[11px] text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-stone-400"></i> 20 mnt
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-stone-400"></i> 2 porsi
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <button onclick="previewRecipe(4)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openRecipeModal('edit', 4)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit Resep">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteRecipe(4, 'Purée Hati Sapi Organik & Labu Madu Halus')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Resep">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 5 -->
                    <div class="recipe-card bg-white rounded-2xl border border-stone-200 shadow-2xs hover:shadow-md transition-all overflow-hidden flex flex-col group" data-category="9-11" data-local="lokal omega3" data-name="Nasi Lembek Ikan Kembung Suwir & Tahu Lembut">
                        <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80" alt="Nasi Lembek Ikan Kembung" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
                            
                            <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5">
                                <span class="bg-amber-600/95 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <i data-lucide="soup" class="w-3 h-3"></i> 9 - 11 Bulan
                                </span>
                                <span class="bg-emerald-600/90 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    Ikan Laut Jember
                                </span>
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draf Review
                            </span>

                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-white">
                                <span class="text-[11px] font-medium text-amber-200 block">Omega-3 Lebih Tinggi dari Salmon, Murah & Segar</span>
                                <h3 class="text-sm font-bold leading-snug drop-shadow-xs line-clamp-1">Nasi Lembek Ikan Kembung Suwir & Tahu Lembut</h3>
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col justify-between gap-3">
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                Ikan kembung lokal tinggi protein dan lemak esensial dipadukan dengan kelembutan tahu sutra dan wortel parut cincang.
                            </p>

                            <div class="grid grid-cols-3 gap-1.5 py-2 border-y border-stone-100 text-center">
                                <div class="bg-rose-50/70 p-1.5 rounded-xl border border-rose-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Energi</span>
                                    <span class="block text-xs font-bold text-rose-700">195 kkal</span>
                                </div>
                                <div class="bg-blue-50/70 p-1.5 rounded-xl border border-blue-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Protein</span>
                                    <span class="block text-xs font-bold text-blue-700">9.1 gr</span>
                                </div>
                                <div class="bg-amber-50/70 p-1.5 rounded-xl border border-amber-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Tekstur</span>
                                    <span class="block text-xs font-bold text-amber-700">Nasi Lembek</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-3 text-[11px] text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-stone-400"></i> 25 mnt
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-stone-400"></i> 2 porsi
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <button onclick="previewRecipe(5)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openRecipeModal('edit', 5)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit Resep">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteRecipe(5, 'Nasi Lembek Ikan Kembung Suwir & Tahu Lembut')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Resep">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipe Card 6 -->
                    <div class="recipe-card bg-white rounded-2xl border border-stone-200 shadow-2xs hover:shadow-md transition-all overflow-hidden flex flex-col group" data-category="12-23" data-local="lokal" data-name="Nasi Tim Semur Telur Puyuh & Tempe Kukus Jember">
                        <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                            <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80" alt="Semur Telur Puyuh" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
                            
                            <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5">
                                <span class="bg-emerald-600/95 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                    <i data-lucide="sparkles" class="w-3 h-3"></i> 12 - 23 Bulan
                                </span>
                                <span class="bg-emerald-600/90 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    Tempe Jember
                                </span>
                            </div>

                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-xs text-stone-700 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dipublikasikan
                            </span>

                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-white">
                                <span class="text-[11px] font-medium text-emerald-200 block">Kolesterol Baik, Protein & Zat Besi Tinggi</span>
                                <h3 class="text-sm font-bold leading-snug drop-shadow-xs line-clamp-1">Nasi Tim Semur Telur Puyuh & Tempe Kukus Jember</h3>
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col justify-between gap-3">
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                Paduan telur puyuh gurih alami dan fermentasi tempe kedelai lokal khas Jember dengan rasa manis gurih ramah pencernaan balita.
                            </p>

                            <div class="grid grid-cols-3 gap-1.5 py-2 border-y border-stone-100 text-center">
                                <div class="bg-rose-50/70 p-1.5 rounded-xl border border-rose-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Energi</span>
                                    <span class="block text-xs font-bold text-rose-700">230 kkal</span>
                                </div>
                                <div class="bg-blue-50/70 p-1.5 rounded-xl border border-blue-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Protein</span>
                                    <span class="block text-xs font-bold text-blue-700">10.4 gr</span>
                                </div>
                                <div class="bg-amber-50/70 p-1.5 rounded-xl border border-amber-100/60">
                                    <span class="block text-[10px] text-stone-400 font-medium">Tekstur</span>
                                    <span class="block text-xs font-bold text-amber-700">Menu Keluarga</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-3 text-[11px] text-stone-500">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-stone-400"></i> 30 mnt
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-stone-400"></i> 2 porsi
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <button onclick="previewRecipe(6)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openRecipeModal('edit', 6)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit Resep">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteRecipe(6, 'Nasi Tim Semur Telur Puyuh & Tempe Kukus Jember')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Resep">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 2. TABLE VIEW (Toggleable) -->
                <div id="tableViewWrapper" class="hidden bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
                    <div class="overflow-x-auto min-w-full">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-stone-50 border-b border-stone-200 text-[11px] font-bold text-stone-500 uppercase tracking-wider">
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
                                <!-- Row 1 -->
                                <tr class="table-recipe-row hover:bg-rose-50/30 transition-colors" data-category="6-8" data-name="Bubur Tim Salmon Beras Merah">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd9aS7XofD1VvIU3ek94235Hwn0WNFiRoI7m5AcZJkBE4Oys41mpW6ixOZN69h5Y3REdbeq-3KfB3KEQab58vjyh-ON5nBj_azOI435sh7EB2NY-KQ2sIIyuSF8O_01QrL1nxe3bpBa2y63Klk9JSsGJ4uEhV3eFQjRhdsOn35rP1ajwn2CB5bIyWZ4i6S1yam6u4_FpVDPlqnkVsi60WFB-EfvkP5i_XqJ26Ac9f_b4k884-F8hL6" class="w-10 h-10 rounded-xl object-cover border border-stone-200 shrink-0" alt="Salmon">
                                            <div>
                                                <span class="font-bold text-stone-900 block">Bubur Tim Salmon Beras Merah & Bayam Papuma</span>
                                                <span class="text-[10px] text-stone-400">Pangan Lokal: Bayam Papuma, Beras Merah Jember</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            6 - 8 Bulan
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-medium text-stone-600">Lumat Saring</td>
                                    <td class="py-3 px-3">
                                        <span class="font-bold text-rose-700">185 kkal</span>
                                        <span class="text-stone-400 text-[10px] block">Protein 7.5g</span>
                                    </td>
                                    <td class="py-3 px-3 text-stone-500 text-[11px]">
                                        <span>25 mnt / 2 porsi</span>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Publik
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="inline-flex items-center gap-1">
                                            <button onclick="previewRecipe(1)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Preview"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                            <button onclick="openRecipeModal('edit', 1)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                            <button onclick="deleteRecipe(1, 'Bubur Tim Salmon Beras Merah & Bayam Papuma')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="table-recipe-row hover:bg-rose-50/30 transition-colors" data-category="9-11" data-name="Nasi Tim Ayam Kampung Suwir Labu Kuning">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBwNKRW8La3Rf1GnktTyvvuFSG2Yy4Hd5qVA-bv6uNLlqXJSAb6kxq4wgV8pjscX-XOWcesGGJ6xH2IDkET3LD1hWwC_emvkSW9gWOodSe442QH5IZVh4q2aal1rAC8ZlB2s9OluZ-BAHTFY0BAYovMP2Kq2U7jLYewn4pUw_TWh6fj1VnfMvMo0kqoKh2wILpUYSePY7oVqhGHCqrEltNvDKdHnUEDWuZfcLULBJAmt_XbRkFJ53Kl" class="w-10 h-10 rounded-xl object-cover border border-stone-200 shrink-0" alt="Ayam Kampung">
                                            <div>
                                                <span class="font-bold text-stone-900 block">Nasi Tim Ayam Kampung Suwir Labu Kuning Jember</span>
                                                <span class="text-[10px] text-stone-400">Pangan Lokal: Labu Kuning Jember, Ayam Kampung</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            9 - 11 Bulan
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-medium text-stone-600">Cincang Kasar</td>
                                    <td class="py-3 px-3">
                                        <span class="font-bold text-rose-700">210 kkal</span>
                                        <span class="text-stone-400 text-[10px] block">Protein 8.8g</span>
                                    </td>
                                    <td class="py-3 px-3 text-stone-500 text-[11px]">
                                        <span>30 mnt / 3 porsi</span>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Publik
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="inline-flex items-center gap-1">
                                            <button onclick="previewRecipe(2)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Preview"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                            <button onclick="openRecipeModal('edit', 2)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                            <button onclick="deleteRecipe(2, 'Nasi Tim Ayam Kampung Suwir Labu Kuning Jember')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="table-recipe-row hover:bg-rose-50/30 transition-colors" data-category="12-23" data-name="Sup Bola-Bola Ikan Tenggiri Puger">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <img src="https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=600&q=80" class="w-10 h-10 rounded-xl object-cover border border-stone-200 shrink-0" alt="Ikan Tenggiri">
                                            <div>
                                                <span class="font-bold text-stone-900 block">Sup Bola-Bola Ikan Tenggiri Sayur Pelangi Puger</span>
                                                <span class="text-[10px] text-stone-400">Pangan Lokal: Ikan Tenggiri TPI Puger Jember</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            12 - 23 Bulan
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 font-medium text-stone-600">Menu Keluarga</td>
                                    <td class="py-3 px-3">
                                        <span class="font-bold text-rose-700">245 kkal</span>
                                        <span class="text-stone-400 text-[10px] block">Protein 11.2g</span>
                                    </td>
                                    <td class="py-3 px-3 text-stone-500 text-[11px]">
                                        <span>35 mnt / 3 porsi</span>
                                    </td>
                                    <td class="py-3 px-3">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Publik
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="inline-flex items-center gap-1">
                                            <button onclick="previewRecipe(3)" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Preview"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                            <button onclick="openRecipeModal('edit', 3)" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                            <button onclick="deleteRecipe(3, 'Sup Bola-Bola Ikan Tenggiri Sayur Pelangi Puger')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Empty State Placeholder (hidden by default) -->
                <div id="emptySearchState" class="hidden bg-white rounded-2xl border border-stone-200 p-8 text-center flex-col items-center justify-center">
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

    <!-- ================= MODAL TAMBAH / EDIT RESEP MPASI ================= -->
    <div id="recipeModal" class="fixed inset-0 bg-stone-900/50 backdrop-blur-xs z-50 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div id="recipeModalContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-3xl overflow-hidden my-auto max-h-[92vh] flex flex-col transition-all duration-200">
            
            <!-- Modal Header -->
            <div class="px-5 py-4 bg-stone-50/90 border-b border-stone-100 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                        <i id="modalHeaderIcon" data-lucide="soup" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 id="recipeModalTitle" class="text-sm font-bold text-stone-900">Tambah Resep MPASI Baru</h3>
                        <p class="text-[11px] text-stone-500">Formulir data resep bergizi dan panduan memasak untuk balita</p>
                    </div>
                </div>
                <button type="button" onclick="closeRecipeModal()" class="w-7 h-7 rounded-lg text-stone-400 hover:text-stone-600 hover:bg-stone-200/50 flex items-center justify-center transition-colors cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Modal Form Body (Scrollable) -->
            <form id="recipeForm" onsubmit="handleFormSubmit(event)" class="flex-1 overflow-y-auto p-5 space-y-4 text-xs">
                
                <!-- Section 1: Informasi Dasar -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-stone-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5 border-b border-stone-100 pb-1.5">
                        <i data-lucide="file-text" class="w-3.5 h-3.5 text-rose-700"></i> Informasi Dasar Resep
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Judul Resep -->
                        <div class="sm:col-span-2">
                            <label class="block font-semibold text-stone-700 mb-1">Judul Resep MPASI <span class="text-rose-500">*</span></label>
                            <input type="text" id="formNamaResep" required placeholder="Contoh: Bubur Tim Salmon Beras Merah & Bayam Papuma" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                        </div>

                        <!-- Subjudul / Manfaat Singkat -->
                        <div class="sm:col-span-2">
                            <label class="block font-semibold text-stone-700 mb-1">Subjudul / Manfaat Utama</label>
                            <input type="text" id="formManfaat" placeholder="Contoh: Tinggi Omega-3, Kaya Zat Besi untuk Pertumbuhan Otak" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                        </div>

                        <!-- Kategori Usia -->
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Target Rentang Usia <span class="text-rose-500">*</span></label>
                            <select id="formKategoriUsia" required class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer">
                                <option value="6-8">6 - 8 Bulan (Awal MPASI)</option>
                                <option value="9-11">9 - 11 Bulan (Transisi Mengunyah)</option>
                                <option value="12-23">12 - 23 Bulan (Menu Keluarga)</option>
                            </select>
                        </div>

                        <!-- Tekstur Makanan -->
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Tekstur MPASI <span class="text-rose-500">*</span></label>
                            <select id="formTekstur" required class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer">
                                <option value="Lumat Saring">Lumat Saring / Halus Kental</option>
                                <option value="Cincang Kasar">Cincang Kasar / Nasi Lembek</option>
                                <option value="Potongan Kecil">Potongan Kecil / Menu Keluarga</option>
                            </select>
                        </div>

                        <!-- Waktu Memasak & Porsi -->
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Estimasi Waktu Memasak (Menit)</label>
                            <div class="relative">
                                <input type="number" id="formWaktu" min="5" value="25" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-stone-400 text-[11px]">Menit</span>
                            </div>
                        </div>

                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Hasil Porsi (Mangkuk)</label>
                            <div class="relative">
                                <input type="number" id="formPorsi" min="1" value="2" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-stone-400 text-[11px]">Porsi</span>
                            </div>
                        </div>

                        <!-- Deskripsi Lengkap -->
                        <div class="sm:col-span-2">
                            <label class="block font-semibold text-stone-700 mb-1">Deskripsi & Keunggulan Menu</label>
                            <textarea id="formDeskripsi" rows="2" placeholder="Jelaskan secara ringkas perpaduan rasa, tekstur, dan manfaat menu ini..." class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Nilai Gizi & Kearifan Lokal -->
                <div class="space-y-3 pt-2">
                    <h4 class="text-xs font-bold text-stone-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5 border-b border-stone-100 pb-1.5">
                        <i data-lucide="activity" class="w-3.5 h-3.5 text-rose-700"></i> Nilai Nutrisi & Pangan Lokal
                    </h4>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                        <div>
                            <label class="block font-semibold text-stone-600 mb-1 text-[11px]">Energi (kkal)</label>
                            <input type="number" id="formKalori" value="185" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-600 mb-1 text-[11px]">Protein (gr)</label>
                            <input type="number" step="0.1" id="formProtein" value="7.5" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-600 mb-1 text-[11px]">Lemak (gr)</label>
                            <input type="number" step="0.1" id="formLemak" value="5.2" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-600 mb-1 text-[11px]">Zat Besi (mg)</label>
                            <input type="number" step="0.1" id="formZatBesi" value="2.8" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Pangan Lokal Jember</label>
                            <input type="text" id="formPanganLokal" placeholder="Contoh: Bayam Papuma, Beras Merah Puger, Labu Kuning" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block font-semibold text-stone-700 mb-1">Catatan Alergen</label>
                            <input type="text" id="formAlergen" placeholder="Contoh: Ikan Laut, Telur, Bebas Gluten" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Bahan-Bahan & Langkah Pembuatan -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between border-b border-stone-100 pb-1.5">
                        <h4 class="text-xs font-bold text-stone-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5">
                            <i data-lucide="list" class="w-3.5 h-3.5 text-rose-700"></i> Komposisi Bahan & Takaran
                        </h4>
                        <button type="button" onclick="addIngredientRow()" class="text-[11px] font-semibold text-rose-700 hover:text-rose-800 flex items-center gap-1 cursor-pointer">
                            <i data-lucide="plus" class="w-3 h-3"></i> Tambah Baris Bahan
                        </button>
                    </div>

                    <div id="ingredientsList" class="space-y-2">
                        <!-- Ingredient Row Item -->
                        <div class="flex items-center gap-2 ingredient-row">
                            <input type="text" value="30 gr Beras Merah Organik" placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                            <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                        <div class="flex items-center gap-2 ingredient-row">
                            <input type="text" value="40 gr Fillet Ikan Salmon / Kembung Segar" placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                            <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                        <div class="flex items-center gap-2 ingredient-row">
                            <input type="text" value="1 genggam Daun Bayam Segar Papuma" placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                            <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Langkah-Langkah Pembuatan -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between border-b border-stone-100 pb-1.5">
                        <h4 class="text-xs font-bold text-stone-900 uppercase tracking-wider text-[11px] flex items-center gap-1.5">
                            <i data-lucide="chef-hat" class="w-3.5 h-3.5 text-rose-700"></i> Panduan Langkah Memasak
                        </h4>
                        <button type="button" onclick="addStepRow()" class="text-[11px] font-semibold text-rose-700 hover:text-rose-800 flex items-center gap-1 cursor-pointer">
                            <i data-lucide="plus" class="w-3 h-3"></i> Tambah Langkah
                        </button>
                    </div>

                    <div id="stepsList" class="space-y-2">
                        <div class="flex items-start gap-2 step-row">
                            <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">1</span>
                            <textarea rows="2" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">Cuci bersih beras merah, lalu masak bersama 300ml air hingga menjadi bubur lunak.</textarea>
                            <button type="button" onclick="this.parentElement.remove(); updateStepNumbers()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                        <div class="flex items-start gap-2 step-row">
                            <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">2</span>
                            <textarea rows="2" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">Kukus ikan dan bayam secara terpisah selama 10 menit hingga matang sempurna.</textarea>
                            <button type="button" onclick="this.parentElement.remove(); updateStepNumbers()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                        <div class="flex items-start gap-2 step-row">
                            <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">3</span>
                            <textarea rows="2" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">Campurkan semua bahan lalu saring kawat atau haluskan sesuai target tekstur usia si kecil.</textarea>
                            <button type="button" onclick="this.parentElement.remove(); updateStepNumbers()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Foto & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">URL / Link Foto Resep</label>
                        <input type="url" id="formFoto" placeholder="https://example.com/foto-resep.jpg" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                    </div>
                    <div>
                        <label class="block font-semibold text-stone-700 mb-1">Status Publikasi</label>
                        <select id="formStatus" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer">
                            <option value="published">Langsung Publikasikan</option>
                            <option value="draft">Simpan Sebagai Draf</option>
                        </select>
                    </div>
                </div>

                <!-- Footer Buttons inside Form -->
                <div class="pt-4 border-t border-stone-100 flex items-center justify-end gap-2 shrink-0">
                    <button type="button" onclick="closeRecipeModal()" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold rounded-xl transition-colors cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-rose-700 hover:bg-rose-600 text-white font-semibold rounded-xl shadow-xs transition-colors flex items-center gap-1.5 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span id="submitBtnText">Simpan Resep</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- ================= MODAL DETAIL / PREVIEW RESEP ================= -->
    <div id="previewModal" class="fixed inset-0 bg-stone-900/50 backdrop-blur-xs z-50 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div id="previewModalContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-2xl overflow-hidden my-auto max-h-[92vh] flex flex-col transition-all duration-200">
            
            <!-- Banner Image Preview -->
            <div class="relative h-48 sm:h-56 w-full bg-stone-100 shrink-0">
                <img id="prevImage" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd9aS7XofD1VvIU3ek94235Hwn0WNFiRoI7m5AcZJkBE4Oys41mpW6ixOZN69h5Y3REdbeq-3KfB3KEQab58vjyh-ON5nBj_azOI435sh7EB2NY-KQ2sIIyuSF8O_01QrL1nxe3bpBa2y63Klk9JSsGJ4uEhV3eFQjRhdsOn35rP1ajwn2CB5bIyWZ4i6S1yam6u4_FpVDPlqnkVsi60WFB-EfvkP5i_XqJ26Ac9f_b4k884-F8hL6" alt="Preview" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>
                
                <button type="button" onclick="closePreviewModal()" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/40 text-white hover:bg-black/60 flex items-center justify-center transition-colors cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>

                <div class="absolute bottom-3 left-4 right-4 text-white">
                    <div class="flex items-center gap-2 mb-1">
                        <span id="prevBadgeAge" class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs">6-8 Bulan</span>
                        <span id="prevBadgeLocal" class="bg-emerald-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs">Pangan Lokal Jember</span>
                    </div>
                    <h2 id="prevTitle" class="text-base sm:text-lg font-bold drop-shadow-xs">Bubur Tim Salmon Beras Merah & Bayam Papuma</h2>
                </div>
            </div>

            <!-- Preview Body Content -->
            <div class="p-5 flex-1 overflow-y-auto space-y-4 text-xs text-stone-700">
                
                <!-- Nutrition Grid Cards -->
                <div class="grid grid-cols-4 gap-2 text-center">
                    <div class="bg-rose-50 p-2 rounded-xl border border-rose-100">
                        <span class="text-[10px] text-stone-400 block font-medium">Kalori</span>
                        <span id="prevKalori" class="text-xs font-bold text-rose-700">185 kkal</span>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-xl border border-blue-100">
                        <span class="text-[10px] text-stone-400 block font-medium">Protein</span>
                        <span id="prevProtein" class="text-xs font-bold text-blue-700">7.5 gr</span>
                    </div>
                    <div class="bg-amber-50 p-2 rounded-xl border border-amber-100">
                        <span class="text-[10px] text-stone-400 block font-medium">Lemak</span>
                        <span id="prevLemak" class="text-xs font-bold text-amber-700">5.2 gr</span>
                    </div>
                    <div class="bg-emerald-50 p-2 rounded-xl border border-emerald-100">
                        <span class="text-[10px] text-stone-400 block font-medium">Zat Besi</span>
                        <span id="prevZatBesi" class="text-xs font-bold text-emerald-700">2.8 mg</span>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h4 class="font-bold text-stone-900 mb-1">Deskripsi Menu:</h4>
                    <p id="prevDescription" class="text-stone-600 leading-relaxed">
                        Kombinasi serat halus beras merah organik dan bayam segar dari pesisir selatan Papuma Jember dengan lemak esensial ikan untuk pertumbuhan otak optimal si kecil.
                    </p>
                </div>

                <!-- Ingredients List -->
                <div>
                    <h4 class="font-bold text-stone-900 mb-2 flex items-center gap-1.5">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-600"></i> Bahan-Bahan:
                    </h4>
                    <ul id="prevIngredientsList" class="space-y-1.5 bg-stone-50 p-3 rounded-xl border border-stone-200">
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> 30 gr Beras Merah Organik Jember
                        </li>
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> 40 gr Fillet Ikan Salmon / Kembung Segar
                        </li>
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> 1 genggam Daun Bayam Segar Papuma
                        </li>
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> 1 sdt Minyak Kelapa / Lemak Tambahan
                        </li>
                    </ul>
                </div>

                <!-- Steps List -->
                <div>
                    <h4 class="font-bold text-stone-900 mb-2 flex items-center gap-1.5">
                        <i data-lucide="utensils" class="w-3.5 h-3.5 text-rose-700"></i> Cara Memasak:
                    </h4>
                    <ol id="prevStepsList" class="space-y-2 text-stone-700">
                        <li class="flex items-start gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <span>Cuci beras merah hingga bersih, rebus dalam 300 ml kaldu sampai menjadi bubur lembut.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <span>Kukus fillet ikan dan bayam hingga matang merata tanpa garam/gula berlebih.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <span>Campurkan seluruh bahan ke dalam mangkuk, saring melalui kawat saring halus untuk bayi 6-8 bulan.</span>
                        </li>
                    </ol>
                </div>

            </div>

            <!-- Preview Footer -->
            <div class="px-5 py-3 bg-stone-50 border-t border-stone-100 flex items-center justify-end shrink-0">
                <button type="button" onclick="closePreviewModal()" class="px-4 py-2 bg-stone-800 hover:bg-stone-900 text-white font-semibold rounded-xl text-xs transition-colors cursor-pointer">
                    Tutup Preview
                </button>
            </div>

        </div>
    </div>

    <!-- ================= NOTIFIKASI TOAST ================= -->
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

        // View Mode Switcher (Grid vs Table)
        function setViewMode(mode) {
            const gridWrapper = document.getElementById('gridViewWrapper');
            const tableWrapper = document.getElementById('tableViewWrapper');
            const gridBtn = document.getElementById('viewGridBtn');
            const tableBtn = document.getElementById('viewTableBtn');

            if (mode === 'grid') {
                gridWrapper.classList.remove('hidden');
                tableWrapper.classList.add('hidden');
                gridBtn.className = "p-1.5 rounded-lg bg-white text-rose-700 shadow-2xs transition-all cursor-pointer";
                tableBtn.className = "p-1.5 rounded-lg text-stone-400 hover:text-stone-700 transition-all cursor-pointer";
            } else {
                gridWrapper.classList.add('hidden');
                tableWrapper.classList.remove('hidden');
                tableBtn.className = "p-1.5 rounded-lg bg-white text-rose-700 shadow-2xs transition-all cursor-pointer";
                gridBtn.className = "p-1.5 rounded-lg text-stone-400 hover:text-stone-700 transition-all cursor-pointer";
            }
            if (window.lucide) lucide.createIcons();
        }

        // Filter Category Tabs
        function filterCategory(category, button) {
            // Update active tab buttons
            document.querySelectorAll('.category-tab').forEach(btn => {
                btn.classList.remove('active-tab', 'bg-rose-700', 'text-white');
                btn.classList.add('text-stone-600', 'hover:bg-stone-100');
            });
            button.classList.add('active-tab', 'bg-rose-700', 'text-white');
            button.classList.remove('text-stone-600', 'hover:bg-stone-100');

            applyAllFilters();
        }

        // Filter Local Ingredients
        function filterLocal() {
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
            const localFilter = document.getElementById('localIngredientFilter').value;

            const cards = document.querySelectorAll('.recipe-card');
            const tableRows = document.querySelectorAll('.table-recipe-row');
            let visibleCount = 0;

            // Filter cards
            cards.forEach(card => {
                const cardCat = card.getAttribute('data-category');
                const cardLocal = card.getAttribute('data-local') || '';
                const cardName = (card.getAttribute('data-name') || '').toLowerCase();

                const matchesCat = (selectedCategory === 'all' || cardCat === selectedCategory);
                const matchesLocal = (localFilter === 'all' || cardLocal.includes(localFilter));
                const matchesSearch = (!searchQuery || cardName.includes(searchQuery));

                if (matchesCat && matchesLocal && matchesSearch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Filter table rows
            tableRows.forEach(row => {
                const rowCat = row.getAttribute('data-category');
                const rowName = (row.getAttribute('data-name') || '').toLowerCase();

                const matchesCat = (selectedCategory === 'all' || rowCat === selectedCategory);
                const matchesSearch = (!searchQuery || rowName.includes(searchQuery));

                if (matchesCat && matchesSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Empty state
            const emptyState = document.getElementById('emptySearchState');
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            } else {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            }
        }

        // ================= MODAL HANDLERS =================
        function openRecipeModal(mode = 'create', id = null) {
            const modal = document.getElementById('recipeModal');
            const title = document.getElementById('recipeModalTitle');
            const submitBtnText = document.getElementById('submitBtnText');

            if (mode === 'create') {
                title.innerText = 'Tambah Resep MPASI Baru';
                submitBtnText.innerText = 'Simpan Resep';
                document.getElementById('recipeForm').reset();
            } else {
                title.innerText = 'Edit Resep MPASI';
                submitBtnText.innerText = 'Simpan Perubahan';
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
                showToast('Resep Dihapus', `Resep "${name}" berhasil dihapus dari sistem.`);
            }
        }

        function handleFormSubmit(e) {
            e.preventDefault();
            closeRecipeModal();
            showToast('Berhasil Disimpan', 'Data resep MPASI berhasil disimpan.');
        }

        function addIngredientRow() {
            const list = document.getElementById('ingredientsList');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 ingredient-row';
            row.innerHTML = `
                <input type="text" placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
            `;
            list.appendChild(row);
            if (window.lucide) lucide.createIcons();
        }

        function addStepRow() {
            const list = document.getElementById('stepsList');
            const stepNum = list.children.length + 1;
            const row = document.createElement('div');
            row.className = 'flex items-start gap-2 step-row';
            row.innerHTML = `
                <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">${stepNum}</span>
                <textarea rows="2" placeholder="Tuliskan petunjuk memasak langkah ini..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20"></textarea>
                <button type="button" onclick="this.parentElement.remove(); updateStepNumbers()" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
            `;
            list.appendChild(row);
            if (window.lucide) lucide.createIcons();
        }

        function updateStepNumbers() {
            document.querySelectorAll('.step-num').forEach((el, index) => {
                el.innerText = index + 1;
            });
        }

        function showToast(title, message) {
            const toast = document.getElementById('toastNotification');
            document.getElementById('toastTitle').innerText = title;
            document.getElementById('toastMessage').innerText = message;
            toast.classList.remove('hidden');
            toast.classList.add('flex');

            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 3500);
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
    </script>
</body>
</html>
