@props(['editInformation' => null])

<!-- Modal Tambah / Edit Informasi & Edukasi -->
<div id="informasiModal" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <!-- Container Modal Box -->
    <div id="informasiModalContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-xl overflow-hidden transition-all duration-200 flex flex-col max-h-[92vh]">

        <!-- Modal Header -->
        <div class="px-5 py-4 bg-stone-50/80 border-b border-stone-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                    <i id="modalInformasiIcon" data-lucide="{{ old('_method') === 'PUT' ? 'file-edit' : 'book-open' }}" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 id="modalInformasiTitle" class="text-sm font-bold text-stone-900">
                        {{ old('_method') === 'PUT' ? 'Edit Data Informasi' : 'Tambah Informasi & Edukasi Baru' }}
                    </h3>
                    <p id="modalInformasiSubtitle" class="text-[11px] text-stone-500">
                        {{ old('_method') === 'PUT' ? 'Perbarui konten artikel atau materi edukasi kesehatan' : 'Lengkapi formulir untuk menambahkan artikel edukasi kesehatan balita' }}
                    </p>
                </div>
            </div>
            <!-- Tombol Tutup Modal -->
            <button type="button" onclick="closeInformasiModal()" class="w-7 h-7 rounded-lg text-stone-400 hover:text-stone-600 hover:bg-stone-200/50 flex items-center justify-center transition-colors cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Modal Form Body -->
        <form id="informasiFormElement" action="{{ old('_method') === 'PUT' && old('informasi_id') ? route('kelolaInformasi.update', old('informasi_id')) : route('kelolaInformasi.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-3.5 overflow-y-auto">
            @csrf
            <input type="hidden" name="_method" id="formInformasiMethod" value="{{ old('_method', 'POST') }}">
            <input type="hidden" name="informasi_id" id="inputInformasiId" value="{{ old('informasi_id') }}">

            <!-- 1. Judul Artikel / Informasi -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Judul Artikel / Informasi <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                    </span>
                    <input 
                        type="text" 
                        id="inputInformasiTitle" 
                        name="judul" 
                        maxlength="50"
                        value="{{ old('judul', old('title')) }}" 
                        required 
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                        placeholder="Contoh: Pentingnya Asupan Asam Folat" 
                        class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border {{ (isset($errors) && ($errors->has('judul') || $errors->has('title'))) ? 'border-rose-400 ring-1 ring-rose-400' : 'border-stone-200' }} rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"
                    >
                </div>
                @error('judul')
                    <p class="text-[10px] text-rose-600 mt-1 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
                @error('title')
                    <p class="text-[10px] text-rose-600 mt-1 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- 2. Kategori -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Kategori <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="tag" class="w-4 h-4"></i>
                    </span>
                    <select 
                        id="selectInformasiCategory" 
                        name="category" 
                        required 
                        class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border {{ (isset($errors) && $errors->has('category')) ? 'border-rose-400 ring-1 ring-rose-400' : 'border-stone-200' }} rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer"
                    >
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        <option value="Trimester 1" {{ old('category') === 'Trimester 1' ? 'selected' : '' }}>Trimester 1</option>
                        <option value="Trimester 2" {{ old('category') === 'Trimester 2' ? 'selected' : '' }}>Trimester 2</option>
                        <option value="Trimester 3" {{ old('category') === 'Trimester 3' ? 'selected' : '' }}>Trimester 3</option>
                        <option value="Edukasi Gizi" {{ old('category') === 'Edukasi Gizi' ? 'selected' : '' }}>Edukasi Gizi</option>
                        <option value="Pencegahan Stunting" {{ old('category') === 'Pencegahan Stunting' ? 'selected' : '' }}>Pencegahan Stunting</option>
                    </select>
                </div>
                @error('category')
                    <p class="text-[10px] text-rose-600 mt-1 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- 3. Ringkasan Singkat -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Ringkasan Singkat <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    id="inputInformasiSummary" 
                    name="summary" 
                    rows="3" 
                    required 
                    placeholder="Tuliskan ringkasan singkat edukasi di sini..." 
                    class="w-full px-3 py-2 text-xs bg-stone-50 border {{ (isset($errors) && $errors->has('summary')) ? 'border-rose-400 ring-1 ring-rose-400' : 'border-stone-200' }} rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"
                >{{ old('summary') }}</textarea>
                @error('summary')
                    <p class="text-[10px] text-rose-600 mt-1 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- 4. Isi Lengkap Informasi -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Isi Lengkap Informasi <span class="text-stone-400 font-normal">(Opsional)</span>
                </label>
                <textarea 
                    id="inputInformasiContent" 
                    name="content" 
                    rows="5" 
                    placeholder="Tuliskan isi lengkap artikel edukasi di sini..." 
                    class="w-full px-3 py-2 text-xs bg-stone-50 border {{ (isset($errors) && $errors->has('content')) ? 'border-rose-400 ring-1 ring-rose-400' : 'border-stone-200' }} rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-[10px] text-rose-600 mt-1 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- 5. Thumbnail Gambar -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Thumbnail Gambar <span class="text-stone-400 font-normal">(Opsional)</span>
                </label>
                
                <!-- Preview Thumbnail Saat Ini / Baru -->
                <div id="thumbnailPreviewContainer" class="hidden mb-2 items-center gap-3 p-2 bg-stone-50 border border-stone-200 rounded-lg">
                    <img id="thumbnailPreviewImg" src="" alt="Preview Thumbnail" class="w-12 h-12 object-cover rounded-lg border border-stone-200 shadow-xs">
                    <div class="text-[11px] text-stone-500 min-w-0">
                        <p id="thumbnailPreviewText" class="font-medium text-stone-700">Thumbnail saat ini</p>
                        <p class="text-[10px] text-stone-400">Pilih file baru di bawah untuk mengganti</p>
                    </div>
                </div>

                <div class="relative">
                    <input 
                        type="file" 
                        id="inputInformasiThumbnail" 
                        name="thumbnail" 
                        accept="image/*" 
                        onchange="previewInformasiThumbnail(event)" 
                        class="w-full text-xs text-stone-500 file:mr-3 file:rounded-lg file:border-0 file:bg-rose-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-rose-700 hover:file:bg-rose-100 transition-all cursor-pointer"
                    >
                </div>
                @error('thumbnail')
                    <p class="text-[10px] text-rose-600 mt-1 flex items-center gap-1 font-medium">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                        <span>{{ $message }}</span>
                    </p>
                @else
                    <p class="text-[10px] text-stone-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 3MB)</p>
                @enderror
            </div>

            <!-- Modal Footer Actions -->
            <div class="pt-3 border-t border-stone-100 flex items-center justify-end gap-2">
                <button 
                    type="button" 
                    onclick="closeInformasiModal()" 
                    class="px-3.5 py-2 text-xs font-semibold text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-700 hover:bg-rose-800 text-white text-xs font-semibold rounded-lg transition-colors shadow-xs cursor-pointer"
                >
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span id="submitInformasiBtnText">{{ old('_method') === 'PUT' ? 'Perbarui Informasi' : 'Simpan Informasi' }}</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const storeInformasiUrl = "{{ route('kelolaInformasi.store') }}";

    function openInformasiModal() {
        const modal = document.getElementById('informasiModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeInformasiModal() {
        const modal = document.getElementById('informasiModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function tambahInformasi() {
        const form = document.getElementById('informasiFormElement');
        const methodInput = document.getElementById('formInformasiMethod');
        const idInput = document.getElementById('inputInformasiId');
        const modalTitle = document.getElementById('modalInformasiTitle');
        const modalSubtitle = document.getElementById('modalInformasiSubtitle');
        const submitBtnText = document.getElementById('submitInformasiBtnText');
        const previewContainer = document.getElementById('thumbnailPreviewContainer');

        if (form) {
            form.action = storeInformasiUrl;
            form.reset();
        }
        if (methodInput) methodInput.value = 'POST';
        if (idInput) idInput.value = '';
        if (modalTitle) modalTitle.innerText = 'Tambah Informasi & Edukasi Baru';
        if (modalSubtitle) modalSubtitle.innerText = 'Lengkapi formulir untuk menambahkan artikel edukasi kesehatan balita';
        if (submitBtnText) submitBtnText.innerText = 'Simpan Informasi';
        if (previewContainer) previewContainer.classList.add('hidden');

        document.getElementById('inputInformasiTitle').value = '';
        document.getElementById('selectInformasiCategory').value = '';
        document.getElementById('inputInformasiSummary').value = '';
        document.getElementById('inputInformasiContent').value = '';
        document.getElementById('inputInformasiThumbnail').value = '';

        openInformasiModal();
    }

    function editInformasi(item) {
        const form = document.getElementById('informasiFormElement');
        const methodInput = document.getElementById('formInformasiMethod');
        const idInput = document.getElementById('inputInformasiId');
        const modalTitle = document.getElementById('modalInformasiTitle');
        const modalSubtitle = document.getElementById('modalInformasiSubtitle');
        const submitBtnText = document.getElementById('submitInformasiBtnText');
        const previewContainer = document.getElementById('thumbnailPreviewContainer');
        const previewImg = document.getElementById('thumbnailPreviewImg');
        const previewText = document.getElementById('thumbnailPreviewText');

        const id = item.id_informasi || item.id;

        if (form) {
            form.action = `/kelolaInformasi/${id}`;
        }
        if (methodInput) methodInput.value = 'PUT';
        if (idInput) idInput.value = id;
        if (modalTitle) modalTitle.innerText = 'Edit Informasi & Edukasi';
        if (modalSubtitle) modalSubtitle.innerText = 'Perbarui konten artikel atau materi edukasi kesehatan';
        if (submitBtnText) submitBtnText.innerText = 'Perbarui Informasi';

        document.getElementById('inputInformasiTitle').value = item.judul || item.title || '';
        document.getElementById('selectInformasiCategory').value = item.category || item.kategori || '';
        document.getElementById('inputInformasiSummary').value = item.summary || item.ringkasan || '';
        document.getElementById('inputInformasiContent').value = item.content || item.isi || '';
        document.getElementById('inputInformasiThumbnail').value = '';

        if (item.thumbnail) {
            if (previewContainer) {
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            }
            if (previewImg) previewImg.src = item.thumbnail.startsWith('/') ? item.thumbnail : '/' + item.thumbnail;
            if (previewText) previewText.innerText = 'Thumbnail saat ini';
        } else {
            if (previewContainer) previewContainer.classList.add('hidden');
        }

        openInformasiModal();
    }

    function previewInformasiThumbnail(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('thumbnailPreviewContainer');
        const previewImg = document.getElementById('thumbnailPreviewImg');
        const previewText = document.getElementById('thumbnailPreviewText');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewImg) previewImg.src = e.target.result;
                if (previewText) previewText.innerText = 'Pratinjau gambar baru';
                if (previewContainer) {
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('flex');
                }
            };
            reader.readAsDataURL(file);
        }
    }

    // Menutup modal saat backdrop diklik
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('informasiModal');
        const container = document.getElementById('informasiModalContainer');

        if (modal && container) {
            modal.addEventListener('click', function(e) {
                if (!container.contains(e.target)) {
                    closeInformasiModal();
                }
            });
        }

        @php
            $isInformasiError = isset($errors) && ($errors->has('judul') || $errors->has('title') || $errors->has('category') || $errors->has('summary') || $errors->has('content') || $errors->has('thumbnail'));
        @endphp

        @if ($isInformasiError)
            openInformasiModal();
        @elseif (isset($editInformation))
            editInformasi(@json($editInformation));
        @endif
    });
</script>
