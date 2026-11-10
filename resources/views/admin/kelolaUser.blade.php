@extends('layouts.admin')

@section('title', 'Kelola User & Balita')

@section('content')
    <!-- Top Row: Welcome & Status Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shrink-0">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-lg sm:text-xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                    Kelola User
                </h1>
            </div>
            <p class="text-xs text-stone-500 mt-0.5">
                Kelola akun pengguna, hak akses sistem, dan data profil balita terdaftar.
            </p>
        </div>
        {{-- Tombol Tambah (teks berubah sesuai tab aktif) --}}
        <button id="btn-tambah" onclick="tambahData()" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-brand hover:bg-brand-hover text-white text-xs font-semibold rounded-xl transition-all shadow-sm hover:shadow cursor-pointer w-full sm:w-auto">
            <i id="btn-tambah-icon" data-lucide="plus" class="w-4 h-4"></i>
            <span id="btn-tambah-label">Tambah User Baru</span>
        </button>
    </div>

    {{-- Alert Notifikasi Sukses / Error --}}

    @if (session('error') || (isset($errors) && $errors->any()))
        <div class="p-3 bg-pink-50 border border-pink-200 text-pink-800 text-xs rounded-xl flex items-center justify-between gap-2 shrink-0 shadow-xs">
            <div class="flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-pink-600 shrink-0"></i>
                <div>
                    <span class="font-semibold block">{{ session('error') ?? 'Gagal menyimpan data!' }}</span>
                    @if (isset($errors) && $errors->any())
                        <span class="text-[11px] text-pink-700 block mt-0.5">{{ $errors->first() }}</span>
                    @endif
                </div>
            </div>
            <button onclick="this.parentElement.remove()" class="text-pink-600 hover:text-pink-800 p-1 cursor-pointer">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    @endif

    {{-- Tab Switcher --}}
    @include('admin.partials.tab-switcher-balita')

    {{-- Table Section --}}
    <section class="bg-white rounded-2xl border border-stone-200 flex flex-col overflow-hidden">
        @include('admin.partials.table-users')
        @include('admin.partials.table-anak')
    </section>

    <!-- Modal Tambah User Baru  -->
    @include('components.admin.modalTambahUser')

    <!-- Modal Tambah Balita Baru -->
    @include('components.admin.modalTambahBalita')
@endsection

@push('scripts')
<script>
    const storeUrl = '{{ route('users.store') }}';

    function openUserModal() {
        const modal = document.getElementById('userModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            if (window.lucide) lucide.createIcons();
        }
    }

    function closeUserModal() {
        const modal = document.getElementById('userModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Menutup modal jika klik di luar box container
    document.addEventListener('DOMContentLoaded', function() {
        const userModal = document.getElementById('userModal');
        const modalContainer = document.getElementById('modalContainer');
        if (userModal && modalContainer) {
            userModal.addEventListener('click', function(e) {
                if (!modalContainer.contains(e.target)) {
                    closeUserModal();
                }
            });
        }
    });

    // Fungsi saat tombol "Tambah User Baru" ditekan
    function tambahData() {
        const form = document.getElementById('userFormElement');
        const methodInput = document.getElementById('formMethodInput');
        const userIdInput = document.getElementById('userIdInput');
        const modalTitle = document.getElementById('modalTitle');
        const modalSubtitle = document.getElementById('modalSubtitle');
        const submitBtnText = document.getElementById('submitBtnText');
        const passwordInput = document.getElementById('inputPassword');
        const passwordHint = document.getElementById('passwordHint');
        const passwordStar = document.getElementById('passwordRequiredStar');

        if (form) {
            form.action = storeUrl;
            form.reset();
        }
        if (methodInput) methodInput.value = 'POST';
        if (userIdInput) userIdInput.value = '';
        if (modalTitle) modalTitle.innerText = 'Tambah User Baru';
        if (modalSubtitle) modalSubtitle.innerText = 'Isi data akun pengguna untuk mendaftarkan akun baru';
        if (submitBtnText) submitBtnText.innerText = 'Simpan User';

        if (passwordInput) passwordInput.required = true;
        if (passwordHint) passwordHint.classList.add('hidden');
        if (passwordStar) passwordStar.classList.remove('hidden');

        const nameInput = document.getElementById('inputName');
        const nikInput = document.getElementById('inputNik');
        const emailInput = document.getElementById('inputEmail');
        const roleInput = document.getElementById('selectRole');

        if (nameInput) nameInput.value = '';
        if (nikInput) nikInput.value = '';
        if (emailInput) emailInput.value = '';
        if (roleInput) roleInput.value = '';
        if (passwordInput) passwordInput.value = '';

        if (typeof updateModalNikCounter === 'function') updateModalNikCounter();

        openUserModal();
    }

    // Fungsi saat ikon "Pensil" di tabel ditekan
    function editData(user) {
        const form = document.getElementById('userFormElement');
        const methodInput = document.getElementById('formMethodInput');
        const userIdInput = document.getElementById('userIdInput');
        const modalTitle = document.getElementById('modalTitle');
        const modalSubtitle = document.getElementById('modalSubtitle');
        const submitBtnText = document.getElementById('submitBtnText');
        const passwordInput = document.getElementById('inputPassword');
        const passwordHint = document.getElementById('passwordHint');
        const passwordStar = document.getElementById('passwordRequiredStar');

        if (form) {
            form.action = `/users/${user.id}`;
        }
        if (methodInput) methodInput.value = 'PUT';
        if (userIdInput) userIdInput.value = user.id;
        if (modalTitle) modalTitle.innerText = 'Edit Data User';
        if (modalSubtitle) modalSubtitle.innerText = 'Perbarui data akun pengguna yang sudah terdaftar';
        if (submitBtnText) submitBtnText.innerText = 'Update User';

        // Isi form data
        const nameInput = document.getElementById('inputName');
        const nikInput = document.getElementById('inputNik');
        const emailInput = document.getElementById('inputEmail');
        const roleInput = document.getElementById('selectRole');

        if (nameInput) nameInput.value = user.name || '';
        if (nikInput) nikInput.value = user.nik || '';
        if (emailInput) emailInput.value = user.email || '';
        if (roleInput) roleInput.value = user.role || '';
        if (passwordInput) passwordInput.value = '';

        if (typeof updateModalNikCounter === 'function') updateModalNikCounter();

        if (passwordInput) passwordInput.required = false;
        if (passwordHint) passwordHint.classList.remove('hidden');
        if (passwordStar) passwordStar.classList.add('hidden');

        openUserModal();
    }

    // Tab Switcher
    function switchTab(tab) {
        const currentUrl = new URL(window.location.href);
        if (currentUrl.searchParams.get('tab') !== tab) {
            currentUrl.searchParams.set('tab', tab);
            history.replaceState(null, '', currentUrl.toString());
        }
        const tabUser = document.getElementById('tab-user');
        const tabAnak = document.getElementById('tab-anak');
        const btnUser = document.getElementById('tab-btn-user');
        const btnAnak = document.getElementById('tab-btn-anak');

        const activeTabCls   = ['text-pink-700', 'font-semibold', 'border-pink-700'];
        const inactiveTabCls = ['text-stone-500', 'font-medium',  'border-transparent'];

        // Tombol Tambah
        const btnTambah      = document.getElementById('btn-tambah');
        const btnTambahLabel = document.getElementById('btn-tambah-label');
        const btnTambahIcon  = document.getElementById('btn-tambah-icon');

        if (tab === 'user') {
            if (tabUser) {
                tabUser.classList.remove('hidden');
                tabUser.classList.add('flex');
            }
            if (tabAnak) {
                tabAnak.classList.add('hidden');
                tabAnak.classList.remove('flex');
            }
            if (btnUser) {
                btnUser.classList.add(...activeTabCls);
                btnUser.classList.remove(...inactiveTabCls);
            }
            if (btnAnak) {
                btnAnak.classList.add(...inactiveTabCls);
                btnAnak.classList.remove(...activeTabCls);
            }

            // Reset tombol ke mode "Tambah User"
            if (btnTambah)      btnTambah.setAttribute('onclick', 'tambahData()');
            if (btnTambahLabel) btnTambahLabel.textContent = 'Tambah User Baru';
            if (btnTambahIcon)  btnTambahIcon.setAttribute('data-lucide', 'plus');
        } else {
            if (tabAnak) {
                tabAnak.classList.remove('hidden');
                tabAnak.classList.add('flex');
            }
            if (tabUser) {
                tabUser.classList.add('hidden');
                tabUser.classList.remove('flex');
            }
            if (btnAnak) {
                btnAnak.classList.add(...activeTabCls);
                btnAnak.classList.remove(...inactiveTabCls);
            }
            if (btnUser) {
                btnUser.classList.add(...inactiveTabCls);
                btnUser.classList.remove(...activeTabCls);
            }

            // Ubah tombol ke mode "Tambah Anak"
            if (btnTambah)      btnTambah.setAttribute('onclick', 'tambahAnak()');
            if (btnTambahLabel) btnTambahLabel.textContent = 'Tambah Balita Baru';
            if (btnTambahIcon)  btnTambahIcon.setAttribute('data-lucide', 'baby');
        }
        if (window.lucide) lucide.createIcons();
    }

    // Pulihkan tab setelah halaman selesai dimuat (di luar switchTab).
    document.addEventListener('DOMContentLoaded', function () {
        const params = new URLSearchParams(window.location.search);
        switchTab(params.get('tab') === 'anak' ? 'anak' : 'user');
    });

    // Filter data melalui Laravel agar mencakup SELURUH database, bukan 6 baris di halaman aktif.
    function applyTableFilter(key, value, tab) {
        const url = new URL(window.location.href);
        url.searchParams.set('tab', tab);
        if (value === 'all') url.searchParams.delete(key);
        else url.searchParams.set(key, value);
        url.searchParams.delete(tab === 'anak' ? 'balita_page' : 'users_page');
        window.location.assign(url.toString());
    }

    function filterUserRole(role, button) {
        applyTableFilter('role', role, 'user');
    }

    function filterBalitaGender(gender, button) {
        applyTableFilter('gender', gender, 'anak');
    }
</script>
@endpush
