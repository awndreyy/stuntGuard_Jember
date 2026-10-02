<!-- Modal Tambah / Edit Resep MPASI -->
<div id="recipeModal" class="fixed inset-0 bg-stone-900/50 backdrop-blur-xs z-50 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <div id="recipeModalContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-2xl overflow-hidden my-auto max-h-[92vh] flex flex-col transition-all duration-200">

        <!-- Modal Header -->
        <div class="px-5 py-4 bg-stone-50/90 border-b border-stone-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                    <i id="modalHeaderIcon" data-lucide="soup" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 id="recipeModalTitle" class="text-sm font-bold text-stone-900">Tambah Resep MPASI Baru</h3>
                    <p class="text-[11px] text-stone-500">Formulir data resep dan panduan gizi untuk balita</p>
                </div>
            </div>
            <button type="button" onclick="closeRecipeModal()" class="w-7 h-7 rounded-lg text-stone-400 hover:text-stone-600 hover:bg-stone-200/50 flex items-center justify-center transition-colors cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Modal Form Body (Scrollable) -->
        <form id="recipeForm" action="{{ route('mpasi.store') }}" method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto p-5 space-y-4 text-xs">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <!-- 1. Judul Resep -->
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Judul Resep <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="formNamaResep" name="nama_resep" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" placeholder="Masukan judul resep" class="w-full pl-9 pr-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                </div>
            </div>

            <!-- 2. Kategori Usia (Dropdown) -->
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Kategori Usia <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="baby" class="w-4 h-4"></i>
                    </span>
                    <select id="formKategoriUsia" name="kategori_usia" required class="w-full pl-9 pr-8 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer">
                        <option value="6-8">6 - 8 Bulan (Tekstur Lumat Saring)</option>
                        <option value="9-11">9 - 11 Bulan (Tekstur Cincang Kasar/Lembek)</option>
                        <option value="12-23">12 - 23 Bulan (Menu Keluarga/Padat)</option>
                    </select>
                </div>
            </div>

            <!-- 3. Waktu Memasak & Porsi -->
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Waktu Memasak & Porsi <span class="text-rose-500">*</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                            </span>
                            <input type="number" id="formWaktu" name="waktu_memasak" min="1" required placeholder="Waktu memasak" class="w-full pl-9 pr-14 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-stone-400 text-[11px]">Menit</span>
                        </div>
                    </div>
                    <div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                                <i data-lucide="pie-chart" class="w-4 h-4"></i>
                            </span>
                            <input type="number" id="formPorsi" name="porsi" min="1" required placeholder="Jumlah porsi" class="w-full pl-9 pr-14 py-2 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-stone-400 text-[11px]">Porsi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Nilai Nutrisi -->
            <div class="space-y-2 pt-1">
                <label class="block font-semibold text-stone-700">Nilai Nutrisi (Opsional)</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Energi (kkal)</span>
                        <input type="text" inputmode="numeric" maxlength="3" step="any" id="formKalori" name="kalori" placeholder="185" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Karbohidrat (gr)</span>
                        <input type="text" inputmode="numeric" maxlength="4" step="0.1" id="formKarbohidrat" name="karbohidrat" placeholder="25.0" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Lemak (gr)</span>
                        <input type="text" inputmode="numeric" maxlength="4" step="0.1" id="formLemak" name="lemak" placeholder="5.2" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Protein (gr)</span>
                        <input type="text" inputmode="numeric" maxlength="4" step="0.1" id="formProtein" name="protein" placeholder="7.5" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Zat Besi (mg)</span>
                        <input type="text" inputmode="numeric" maxlength="3" step="0.1" id="formZatBesi" name="zat_besi" placeholder="2.8" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Seng (mg)</span>
                        <input type="text" inputmode="numeric" maxlength="3" step="0.1" id="formSeng" name="seng" placeholder="1.5" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                    </div>
                </div>
            </div>

            <!-- 5. Bahan yang Dibutuhkan -->
            <div class="space-y-2 pt-1">
                <div class="flex items-center justify-between">
                    <label class="block font-semibold text-stone-700">Bahan yang Dibutuhkan <span class="text-rose-500">*</span></label>
                    <button type="button" onclick="addIngredientRow()" class="text-[11px] font-semibold text-rose-700 hover:text-rose-800 flex items-center gap-1 cursor-pointer">
                        <i data-lucide="plus" class="w-3 h-3"></i> Tambah Bahan
                    </button>
                </div>

                <div id="ingredientsList" class="space-y-2">
                    <div class="flex items-center gap-2 ingredient-row">
                        <input type="text" name="bahan[]" required placeholder="Contoh: 30 gr Beras Merah Organik" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                    </div>
                </div>
            </div>

            <!-- 6. Cara Pembuatan -->
            <div class="space-y-2 pt-1">
                <div class="flex items-center justify-between">
                    <label class="block font-semibold text-stone-700">Cara Pembuatan <span class="text-rose-500">*</span></label>
                    <button type="button" onclick="addStepRow()" class="text-[11px] font-semibold text-rose-700 hover:text-rose-800 flex items-center gap-1 cursor-pointer">
                        <i data-lucide="plus" class="w-3 h-3"></i> Tambah Langkah
                    </button>
                </div>

                <div id="stepsList" class="space-y-2">
                    <div class="flex items-start gap-2 step-row">
                        <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">1</span>
                        <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah 1..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20"></textarea>
                        <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                    </div>
                </div>
            </div>

            <!-- 7. Foto Makanan (Upload File atau URL) -->
            <div class="pt-1 space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block font-semibold text-stone-700">Foto Resep</label>
                    <span class="text-[10px] font-medium text-stone-400">Opsional (File atau Link URL)</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Unggah Gambar (JPG/PNG/WebP)</span>
                        <input type="file" id="formGambarFile" name="gambar" accept="image/*" class="w-full text-xs text-stone-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 bg-stone-50 border border-stone-200 rounded-xl cursor-pointer">
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Atau Link / URL Foto Online</span>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-stone-400">
                                <i data-lucide="link" class="w-3.5 h-3.5"></i>
                            </span>
                            <input type="url" id="formFoto" name="foto" placeholder="https://..." class="w-full pl-8 pr-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        </div>
                    </div>
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
