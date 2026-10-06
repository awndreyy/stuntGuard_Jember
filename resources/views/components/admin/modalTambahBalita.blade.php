<!-- Modal Tambah / Edit Data Balita Baru -->
<div id="balitaModal" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <!-- Container Modal Box -->
    <div id="modalBalitaContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-lg overflow-hidden transition-all duration-200 flex flex-col max-h-[90vh]">

        <!-- Modal Header -->
        <div class="px-5 py-4 bg-stone-50/80 border-b border-stone-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center">
                    <i data-lucide="baby" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 id="modalBalitaTitle" class="text-sm font-bold text-stone-900">Tambah Data Balita Baru</h3>
                    <p class="text-[11px] text-stone-500">Lengkapi data informasi anak/balita untuk pemantauan tumbuh kembang</p>
                </div>
            </div>
            <!-- Tombol Tutup Modal -->
            <button type="button" onclick="closeBalitaModal()" class="w-7 h-7 rounded-lg text-stone-400 hover:text-stone-600 hover:bg-stone-200/50 flex items-center justify-center transition-colors cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Modal Form Body -->
        <form id="balitaFormElement" action="{{ old('_method') === 'PUT' && old('balita_id') ? route('balita.update', old('balita_id')) : route('balita.store') }}" method="POST" class="p-5 space-y-3.5 overflow-y-auto">
            @csrf
            <input type="hidden" name="_method" id="formBalitaMethodInput" value="{{ old('_method', 'POST') }}">
            <input type="hidden" name="balita_id" id="inputBalitaId" value="{{ old('balita_id') }}">

            <!-- 1. Orang Tua / Wali (Searchable Select Dropdown) -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Orang Tua / Wali <span class="text-rose-500">*</span>
                </label>
                <div class="relative" id="parentSelectWrapper">
                    <input type="hidden" name="user_id" id="inputBalitaUserId" required value="">

                    <!-- Trigger Button Dropdown -->
                    <button
                        type="button"
                        id="parentSelectTrigger"
                        onclick="toggleParentDropdown()"
                        class="w-full flex items-center justify-between px-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all cursor-pointer text-left"
                    >
                        <div class="flex items-center gap-2 truncate">
                            <i data-lucide="users" class="w-4 h-4 text-stone-400 shrink-0"></i>
                            <span id="selectedParentText" class="text-stone-400 truncate">Pilih Orang Tua / Wali</span>
                        </div>
                        <i data-lucide="chevron-down" id="parentSelectChevron" class="w-4 h-4 text-stone-400 transition-transform duration-200 shrink-0"></i>
                    </button>

                    <!-- Dropdown Content (Searchable List) -->
                    <div
                        id="parentDropdownMenu"
                        class="absolute left-0 right-0 top-full mt-1.5 bg-white border border-stone-200 rounded-xl shadow-xl z-30 hidden overflow-hidden transition-all"
                    >
                        <!-- Search Field in Dropdown -->
                        <div class="p-2 border-b border-stone-100 bg-stone-50/50">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-stone-400">
                                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                                </span>
                                <input
                                    type="text"
                                    id="parentSearchInput"
                                    oninput="filterParents(this.value)"
                                    placeholder="Cari nama atau NIK orang tua..."
                                    class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-1 focus:ring-rose-700 focus:border-rose-700"
                                >
                            </div>
                        </div>

                        <!-- Options List -->
                        <div id="parentOptionsList" class="max-h-48 overflow-y-auto divide-y divide-stone-50 py-1">
                            @if(isset($users) && count($users) > 0)
                                @foreach($users as $parent)
                                    <button
                                        type="button"
                                        onclick="selectParent('{{ $parent->id }}', '{{ addslashes($parent->name) }}', '{{ $parent->nik ?? '-' }}')"
                                        class="parent-option w-full text-left px-3 py-2 hover:bg-rose-50/70 transition-colors flex items-center justify-between gap-2 cursor-pointer"
                                        data-name="{{ strtolower($parent->name) }}"
                                        data-nik="{{ strtolower($parent->nik ?? '') }}"
                                    >
                                        <div class="min-w-0">
                                            <p class="text-xs font-semibold text-stone-800 truncate">{{ $parent->name }}</p>
                                            <p class="text-[10px] text-stone-400">NIK: {{ $parent->nik ?? 'Belum ada NIK' }} • {{ $parent->role ?? 'User' }}</p>
                                        </div>
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-stone-100 text-stone-600 shrink-0 font-medium">
                                            Pilih
                                        </span>
                                    </button>
                                @endforeach
                            @else
                                <div class="px-3 py-4 text-center text-xs text-stone-400">
                                    Belum ada data orang tua
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Nama Lengkap Balita -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">
                    Nama Lengkap Balita <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="baby" class="w-4 h-4"></i>
                    </span>
                    <input
                        type="text"
                        id="inputNamaBalita"
                        name="nama_balita"
                        maxlength="30"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s'.]/g, '')"
                        required
                        placeholder="Masukkan nama lengkap balita"
                        class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"
                    >
                </div>
            </div>

            <!-- 3. NIK Anak -->
            <div>
                <div class="flex flex-wrap items-center justify-between gap-1 mb-1">
                    <label class="block text-xs font-semibold text-stone-700">
                        NIK Anak <span class="text-stone-400 font-normal">(Opsional)</span>
                    </label>
                    <span id="nikBalitaCounter" class="text-[10px] font-medium text-stone-400">0/16 Digit</span>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="credit-card" class="w-4 h-4"></i>
                    </span>
                    <input
                        type="text"
                        id="inputNikBalita"
                        name="nik"
                        maxlength="16"
                        inputmode="numeric"
                        placeholder="3509xxxxxxxxxxxx (16 Digit)"
                        class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all tracking-wide"
                    >
                </div>
                <p id="nikBalitaHelp" class="text-[10px] text-stone-400 mt-1">Isi 16 digit jika anak sudah memiliki KIA/NIK</p>
            </div>

            <!-- 4. Grid 2 Kolom: Tanggal Lahir & Jenis Kelamin -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-xs font-semibold text-stone-700 mb-1">
                        Tanggal Lahir <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                        </span>
                        <input
                            type="date"
                            id="inputTanggalLahir"
                            name="tanggal_lahir"
                            required
                            max="{{ date('Y-m-d') }}"
                            class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"
                        >
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-xs font-semibold text-stone-700 mb-1">
                        Jenis Kelamin <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select
                            id="selectJenisKelamin"
                            name="jenis_kelamin"
                            required
                            class="w-full px-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all"
                        >
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal Footer Actions -->
            <div class="pt-3 border-t border-stone-100 flex items-center justify-end gap-2 shrink-0">
                <button type="button" onclick="closeBalitaModal()" class="px-3.5 py-2 text-xs font-semibold text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white text-xs font-semibold rounded-lg transition-colors shadow-xs cursor-pointer">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span id="submitBalitaBtnText">Simpan Data Balita</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const storeBalitaUrl = '{{ route('balita.store') }}';

    function openBalitaModal() {
        const modal = document.getElementById('balitaModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            lucide.createIcons();
        }
    }

    function closeBalitaModal() {
        const modal = document.getElementById('balitaModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            closeParentDropdown();
        }
    }

    // Toggle Dropdown Orang Tua
    function toggleParentDropdown() {
        const menu = document.getElementById('parentDropdownMenu');
        const chevron = document.getElementById('parentSelectChevron');
        const isHidden = menu.classList.contains('hidden');

        if (isHidden) {
            menu.classList.remove('hidden');
            if (chevron) chevron.classList.add('rotate-180');
            const searchInput = document.getElementById('parentSearchInput');
            if (searchInput) {
                searchInput.value = '';
                filterParents('');
                setTimeout(() => searchInput.focus(), 50);
            }
        } else {
            closeParentDropdown();
        }
    }

    function closeParentDropdown() {
        const menu = document.getElementById('parentDropdownMenu');
        const chevron = document.getElementById('parentSelectChevron');
        if (menu) menu.classList.add('hidden');
        if (chevron) chevron.classList.remove('rotate-180');
    }

    // Pilih Orang Tua dari dropdown
    function selectParent(id, name, nik) {
        const inputUserId = document.getElementById('inputBalitaUserId');
        const selectedText = document.getElementById('selectedParentText');

        if (inputUserId) inputUserId.value = id;
        if (selectedText) {
            selectedText.textContent = `${name} (${nik !== '-' ? nik : 'Tanpa NIK'})`;
            selectedText.classList.remove('text-stone-400');
            selectedText.classList.add('text-stone-800', 'font-medium');
        }

        closeParentDropdown();
    }

    // Filter daftar orang tua berdasarkan pencarian
    function filterParents(query) {
        const q = query.toLowerCase().trim();
        const options = document.querySelectorAll('.parent-option');

        options.forEach(option => {
            const name = option.getAttribute('data-name') || '';
            const nik = option.getAttribute('data-nik') || '';
            if (name.includes(q) || nik.includes(q)) {
                option.classList.remove('hidden');
            } else {
                option.classList.add('hidden');
            }
        });
    }

    // Live validation & counter NIK Balita
    function updateNikBalitaCounter() {
        const nikInput = document.getElementById('inputNikBalita');
        const nikCounter = document.getElementById('nikBalitaCounter');
        const nikHelp = document.getElementById('nikBalitaHelp');

        if (!nikInput || !nikCounter || !nikHelp) return;

        // Filter hanya angka
        nikInput.value = nikInput.value.replace(/[^0-9]/g, '');
        const length = nikInput.value.length;

        nikCounter.textContent = `${length}/16 Digit`;

        if (length === 16) {
            nikCounter.className = 'text-[10px] font-semibold text-emerald-700';
            nikHelp.textContent = '✓ Format NIK valid (16 digit)';
            nikHelp.className = 'text-[10px] text-emerald-700 mt-1';
        } else if (length > 0) {
            nikCounter.className = 'text-[10px] font-medium text-amber-600';
            nikHelp.textContent = `Kurang ${16 - length} digit lagi`;
            nikHelp.className = 'text-[10px] text-amber-600 mt-1';
        } else {
            nikCounter.className = 'text-[10px] font-medium text-stone-400';
            nikHelp.textContent = 'Isi 16 digit jika anak sudah memiliki KIA/NIK';
            nikHelp.className = 'text-[10px] text-stone-400 mt-1';
        }
    }

    // Event Listener Klik di luar dropdown/modal
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('balitaModal');
        const container = document.getElementById('modalBalitaContainer');
        const parentWrapper = document.getElementById('parentSelectWrapper');
        const nikBalita = document.getElementById('inputNikBalita');
        const balitaForm = document.getElementById('balitaFormElement');

        // Tutup modal jika klik backdrop luar
        if (modal && container) {
            modal.addEventListener('click', function(e) {
                if (!container.contains(e.target)) {
                    closeBalitaModal();
                }
            });
        }

        // Tutup dropdown orang tua jika klik di luar wrapper
        document.addEventListener('click', function(e) {
            if (parentWrapper && !parentWrapper.contains(e.target)) {
                closeParentDropdown();
            }
        });

        // NIK input listener
        if (nikBalita) {
            nikBalita.addEventListener('input', updateNikBalitaCounter);
        }

        // Validasi Submit Form Balita
        if (balitaForm) {
            balitaForm.addEventListener('submit', function(e) {
                const userId = document.getElementById('inputBalitaUserId').value;
                if (!userId) {
                    e.preventDefault();
                    alert('Silakan pilih orang tua / wali terlebih dahulu!');
                    toggleParentDropdown();
                    return false;
                }

                if (nikBalita && nikBalita.value.length > 0 && nikBalita.value.length !== 16) {
                    e.preventDefault();
                    alert('NIK Anak harus tepat 16 digit angka (atau kosongkan jika belum memiliki NIK)!');
                    nikBalita.focus();
                    return false;
                }
            });
        }
    });

    // Reset Form Tambah Balita
    function tambahAnak() {
        const form = document.getElementById('balitaFormElement');
        const methodInput = document.getElementById('formBalitaMethodInput');
        const balitaIdInput = document.getElementById('inputBalitaId');
        const modalTitle = document.getElementById('modalBalitaTitle');
        const submitBtnText = document.getElementById('submitBalitaBtnText');
        const selectedText = document.getElementById('selectedParentText');

        if (form) {
            form.action = storeBalitaUrl;
            form.reset();
        }
        if (methodInput) methodInput.value = 'POST';
        if (balitaIdInput) balitaIdInput.value = '';
        if (modalTitle) modalTitle.innerText = 'Tambah Data Balita Baru';
        if (submitBtnText) submitBtnText.innerText = 'Simpan Data Balita';

        document.getElementById('inputBalitaUserId').value = '';
        if (selectedText) {
            selectedText.textContent = 'Pilih Orang Tua / Wali';
            selectedText.className = 'text-stone-400 truncate';
        }

        document.getElementById('inputNamaBalita').value = '';
        document.getElementById('inputNikBalita').value = '';
        document.getElementById('inputTanggalLahir').value = '';
        document.getElementById('selectJenisKelamin').value = '';

        updateNikBalitaCounter();
        openBalitaModal();
    }

    // Edit Data Balita
    function editBalita(balita) {
        const form = document.getElementById('balitaFormElement');
        const methodInput = document.getElementById('formBalitaMethodInput');
        const balitaIdInput = document.getElementById('inputBalitaId');
        const modalTitle = document.getElementById('modalBalitaTitle');
        const submitBtnText = document.getElementById('submitBalitaBtnText');
        const selectedText = document.getElementById('selectedParentText');

        const balitaId = balita.id_balita || balita.id;

        if (form) {
            form.action = `/balita/${balitaId}`;
        }
        if (methodInput) methodInput.value = 'PUT';
        if (balitaIdInput) balitaIdInput.value = balitaId;
        if (modalTitle) modalTitle.innerText = 'Edit Data Balita';
        if (submitBtnText) submitBtnText.innerText = 'Update Data Balita';

        document.getElementById('inputBalitaUserId').value = balita.user_id || '';
        if (selectedText) {
            const parentName = (balita.orang_tua && balita.orang_tua.name) ? balita.orang_tua.name : 'Orang Tua Terpilih';
            selectedText.textContent = parentName;
            selectedText.className = 'text-stone-800 font-medium truncate';
        }

        document.getElementById('inputNamaBalita').value = balita.nama_balita || '';
        document.getElementById('inputNikBalita').value = balita.nik || '';
        document.getElementById('inputTanggalLahir').value = balita.tanggal_lahir || '';
        document.getElementById('selectJenisKelamin').value = balita.jenis_kelamin || '';

        updateNikBalitaCounter();
        openBalitaModal();
    }

    document.addEventListener('DOMContentLoaded', function() {
        @php
            $isBalitaError = $errors->has('nama_balita') || $errors->has('tanggal_lahir') || $errors->has('jenis_kelamin') || old('nama_balita') !== null;
        @endphp

        @if ($isBalitaError)
            switchTab('anak');
            openBalitaModal();
        @endif
    });
</script>
