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
        <form id="recipeForm" action="{{ old('_method') === 'PUT' && old('edit_id') ? url('/mpasi/' . old('edit_id')) : route('mpasi.store') }}" method="POST" enctype="multipart/form-data" novalidate class="flex-1 overflow-y-auto p-5 space-y-4 text-xs">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">
            <input type="hidden" name="edit_id" id="editRecipeId" value="{{ old('edit_id', '') }}">

            <!-- 1. Nama Resep -->
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Nama Resep <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none {{ $errors->has('nama_resep') ? 'text-rose-400' : 'text-stone-400' }}">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="formNamaResep" name="nama_resep" maxlength="" value="{{ old('nama_resep') }}" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" placeholder="Masukan judul resep" class="w-full pl-9 pr-3 py-2 bg-stone-50 border {{ $errors->has('nama_resep') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                </div>
                @error('nama_resep')
                    <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>   
                    </p>
                @enderror
            </div>

            <!-- 2. Kategori Usia (Dropdown) -->
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Kategori Usia <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none {{ $errors->has('kategori_usia') ? 'text-rose-400' : 'text-stone-400' }}">
                        <i data-lucide="baby" class="w-4 h-4"></i>
                    </span>
                    <select id="formKategoriUsia" name="kategori_usia" required class="w-full pl-9 pr-8 py-2 bg-stone-50 border {{ $errors->has('kategori_usia') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer">
                        <option value="6-8" {{ old('kategori_usia') == '6-8' ? 'selected' : '' }}>6 - 8 Bulan (Tekstur Lumat Saring)</option>
                        <option value="9-11" {{ old('kategori_usia') == '9-11' ? 'selected' : '' }}>9 - 11 Bulan (Tekstur Cincang Kasar/Lembek)</option>
                        <option value="12-23" {{ old('kategori_usia') == '12-23' ? 'selected' : '' }}>12 - 23 Bulan (Menu Keluarga/Padat)</option>
                    </select>
                </div>
                @error('kategori_usia')
                    <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- 3. Waktu Memasak & Porsi -->
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Waktu Memasak & Porsi <span class="text-rose-500">*</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none {{ $errors->has('waktu_memasak') ? 'text-rose-400' : 'text-stone-400' }}">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                            </span>
                            <input type="text" inputmode="numeric" id="formWaktu" name="waktu_memasak" maxlength="3" value="{{ old('waktu_memasak') }}" required placeholder="Waktu memasak" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);" class="w-full pl-9 pr-14 py-2 bg-stone-50 border {{ $errors->has('waktu_memasak') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-stone-400 text-[11px]">Menit</span>
                        </div>
                        @error('waktu_memasak')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none {{ $errors->has('porsi') ? 'text-rose-400' : 'text-stone-400' }}">
                                <i data-lucide="pie-chart" class="w-4 h-4"></i>
                            </span>
                            <input type="text" inputmode="numeric" id="formPorsi" name="porsi" value="{{ old('porsi') }}" maxlength="2" required placeholder="Jumlah porsi" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);" class="w-full pl-9 pr-14 py-2 bg-stone-50 border {{ $errors->has('porsi') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-stone-400 text-[11px]">Porsi</span>
                        </div>
                        @error('porsi')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- 4. Nilai Nutrisi -->
            <div class="space-y-2 pt-1">
                <label class="block font-semibold text-stone-700">Nilai Nutrisi (Opsional)</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Energi (kkal)</span>
                        <input type="text" inputmode="numeric" maxlength="4" id="formKalori" name="kalori" value="{{ old('kalori') }}" placeholder="185" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" class="w-full px-2.5 py-1.5 bg-stone-50 border {{ $errors->has('kalori') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        @error('kalori')
                            <p class="modal-error-message text-[10px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Karbohidrat (gr)</span>
                        <input type="text" inputmode="numeric" maxlength="4" id="formKarbohidrat" name="karbohidrat" value="{{ old('karbohidrat') }}" placeholder="25" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" class="w-full px-2.5 py-1.5 bg-stone-50 border {{ $errors->has('karbohidrat') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        @error('karbohidrat')
                            <p class="modal-error-message text-[10px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Lemak (gr)</span>
                        <input type="text" inputmode="numeric" maxlength="4" id="formLemak" name="lemak" value="{{ old('lemak') }}" placeholder="5" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" class="w-full px-2.5 py-1.5 bg-stone-50 border {{ $errors->has('lemak') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        @error('lemak')
                            <p class="modal-error-message text-[10px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Protein (gr)</span>
                        <input type="text" inputmode="numeric" maxlength="4" id="formProtein" name="protein" value="{{ old('protein') }}" placeholder="7" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" class="w-full px-2.5 py-1.5 bg-stone-50 border {{ $errors->has('protein') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        @error('protein')
                            <p class="modal-error-message text-[10px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Zat Besi (mg)</span>
                        <input type="text" inputmode="numeric" maxlength="4" id="formZatBesi" name="zat_besi" value="{{ old('zat_besi') }}" placeholder="2" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" class="w-full px-2.5 py-1.5 bg-stone-50 border {{ $errors->has('zat_besi') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        @error('zat_besi')
                            <p class="modal-error-message text-[10px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Seng (mg)</span>
                        <input type="text" inputmode="numeric" maxlength="4" id="formSeng" name="seng" value="{{ old('seng') }}" placeholder="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" class="w-full px-2.5 py-1.5 bg-stone-50 border {{ $errors->has('seng') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        @error('seng')
                            <p class="modal-error-message text-[10px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
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

                @error('bahan')
                    <p class="modal-error-message text-[11px] text-rose-600 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror

                @php
                    $oldBahan = old('bahan', ['']);
                    if (!is_array($oldBahan) || empty($oldBahan)) {
                        $oldBahan = [''];
                    }
                @endphp

                <div id="ingredientsList" class="space-y-2">
                    @foreach($oldBahan as $index => $bahanItem)
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 ingredient-row">
                                <input type="text" name="bahan[]" value="{{ $bahanItem }}" required placeholder="Contoh: 30 gr Beras Merah Organik" class="flex-1 px-3 py-1.5 bg-stone-50 border {{ $errors->has('bahan.'.$index) ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                                <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                            </div>
                            @error('bahan.'.$index)
                                <p class="modal-error-message text-[10px] text-rose-600 pl-1 flex items-center gap-1 font-medium">
                                    <i data-lucide="alert-circle" class="w-3 h-3 shrink-0"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    @endforeach
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

                @error('cara_pembuatan')
                    <p class="modal-error-message text-[11px] text-rose-600 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror

                @php
                    $oldLangkah = old('cara_pembuatan', ['']);
                    if (!is_array($oldLangkah) || empty($oldLangkah)) {
                        $oldLangkah = [''];
                    }
                @endphp

                <div id="stepsList" class="space-y-2">
                    @foreach($oldLangkah as $index => $stepItem)
                        <div class="space-y-1">
                            <div class="flex items-start gap-2 step-row">
                                <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">{{ $index + 1 }}</span>
                                <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah {{ $index + 1 }}..." class="flex-1 px-3 py-1.5 bg-stone-50 border {{ $errors->has('cara_pembuatan.'.$index) ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">{{ $stepItem }}</textarea>
                                <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                            </div>
                            @error('cara_pembuatan.'.$index)
                                <p class="modal-error-message text-[10px] text-rose-600 pl-6 flex items-center gap-1 font-medium">
                                    <i data-lucide="alert-circle" class="w-3 h-3 shrink-0"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    @endforeach
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
                        <input type="file" id="formGambarFile" name="gambar" accept="image/*" class="w-full text-xs text-stone-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 bg-stone-50 border {{ $errors->has('gambar') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl cursor-pointer">
                        @error('gambar')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div>
                        <span class="block text-[11px] text-stone-500 mb-1">Atau Link / URL Foto Online</span>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none {{ $errors->has('foto') ? 'text-rose-400' : 'text-stone-400' }}">
                                <i data-lucide="link" class="w-3.5 h-3.5"></i>
                            </span>
                            <input type="url" id="formFoto" name="foto" value="{{ old('foto') }}" placeholder="https://..." class="w-full pl-8 pr-3 py-1.5 bg-stone-50 border {{ $errors->has('foto') ? 'border-rose-500 ring-2 ring-rose-500/20 modal-error-input' : 'border-stone-200' }} rounded-xl text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        </div>
                        @error('foto')
                            <p class="modal-error-message text-[11px] text-rose-600 mt-1.5 flex items-center gap-1 font-medium">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
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
