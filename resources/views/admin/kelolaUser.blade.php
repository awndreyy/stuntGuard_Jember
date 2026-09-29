<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kelola User - StuntGuard Jember' }}</title>

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
        /* Custom subtle scrollbar for tables & sidebars */
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
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper (16:9 Full Viewport Height Container) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

    <!-- Header Component -->
    <x-admin.header/>

    <!-- Main Content Canvas (16:9 Screen Fit with Zero Vertical Overflow) -->
    <main class="flex-1 overflow-y-auto md:overflow-hidden p-3.5 sm:p-5 flex flex-col gap-3.5 max-w-[1920px] w-full mx-auto">

        <!-- Top Row: Welcome & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shrink-0">
            <div>
                <h1 class="text-lg sm:text-xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                    Kelola User
                </h1>
            </div>
            {{-- Tombol Tambah (teks berubah sesuai tab aktif) --}}
            <button id="btn-tambah" onclick="tambahData()" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white text-xs font-semibold rounded-lg transition-colors shadow-sm cursor-pointer w-full sm:w-auto">
                <i id="btn-tambah-icon" data-lucide="plus" class="w-4 h-4"></i>
                <span id="btn-tambah-label">Tambah User Baru</span>
            </button>
        </div>

        {{-- Alert Notifikasi Sukses / Error --}}
        @if (session('success'))
            <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center justify-between gap-2 shrink-0 shadow-xs">
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-700 shrink-0"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 p-1 cursor-pointer">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        @endif

        @if (session('error') || (isset($errors) && $errors->any()))
            <div class="p-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-center justify-between gap-2 shrink-0 shadow-xs">
                <div class="flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                    <div>
                        <span class="font-semibold block">{{ session('error') ?? 'Gagal menyimpan data!' }}</span>
                        @if (isset($errors) && $errors->any())
                            <span class="text-[11px] text-rose-700 block mt-0.5">{{ $errors->first() }}</span>
                        @endif
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800 p-1 cursor-pointer">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                </button>
            </div>
        @endif

        {{-- Tab Switcher --}}
        @include('admin.partials.tab-switcher')

        {{-- Table Section --}}
        <section class="flex-1 bg-white rounded-2xl border border-stone-200 shadow-sm flex flex-col min-h-0 overflow-hidden">
            @include('admin.partials.table-users')
            @include('admin.partials.table-anak')
        </section>

    <!-- Footer -->
    <footer class="text-center py-1">
        <span class="text-[10px] text-rose-700/80 hidden xl:inline text-center">© 2026 StuntGuard Jember</span>
    </footer>

    </main>
</div>

<!-- Modal Tambah User Baru  -->
@include('components.admin.modalTambahUser')

<!-- Modal Tambah Balita Baru -->
@include('components.admin.modalTambahBalita')

<script>
    const storeUrl = '{{ route('users.store') }}';

    function openUserModal() {
        const modal = document.getElementById('userModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
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
        const modalTitle = document.getElementById('modalTitle');
        const submitBtnText = document.getElementById('submitBtnText');
        const passwordInput = document.getElementById('inputPassword');
        const passwordHint = document.getElementById('passwordHint');
        const passwordStar = document.getElementById('passwordRequiredStar');

        if (form) {
            form.action = storeUrl;
            form.reset();
        }
        if (methodInput) methodInput.value = 'POST';
        if (modalTitle) modalTitle.innerText = 'Tambah User Baru';
        if (submitBtnText) submitBtnText.innerText = 'Simpan User';

        if (passwordInput) passwordInput.required = true;
        if (passwordHint) passwordHint.classList.add('hidden');
        if (passwordStar) passwordStar.classList.remove('hidden');

        document.getElementById('inputName').value = '';
        document.getElementById('inputNik').value = '';
        document.getElementById('inputEmail').value = '';
        document.getElementById('selectRole').value = '';
        document.getElementById('inputPassword').value = '';

        if (typeof updateModalNikCounter === 'function') updateModalNikCounter();

        openUserModal();
    }

    // Fungsi saat ikon "Pensil" di tabel ditekan
    function editData(user) {
        const form = document.getElementById('userFormElement');
        const methodInput = document.getElementById('formMethodInput');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtnText = document.getElementById('submitBtnText');
        const passwordInput = document.getElementById('inputPassword');
        const passwordHint = document.getElementById('passwordHint');
        const passwordStar = document.getElementById('passwordRequiredStar');

        if (form) {
            form.action = `/users/${user.id}`;
        }
        if (methodInput) methodInput.value = 'PUT';
        if (modalTitle) modalTitle.innerText = 'Edit Data User';
        if (submitBtnText) submitBtnText.innerText = 'Update User';

        // Isi form data
        document.getElementById('inputName').value = user.name || '';
        document.getElementById('inputNik').value = user.nik || '';
        document.getElementById('inputEmail').value = user.email || '';
        document.getElementById('selectRole').value = user.role || '';
        document.getElementById('inputPassword').value = '';

        if (typeof updateModalNikCounter === 'function') updateModalNikCounter();

        if (passwordInput) passwordInput.required = false;
        if (passwordHint) passwordHint.classList.remove('hidden');
        if (passwordStar) passwordStar.classList.add('hidden');

        openUserModal();
    }

    // Tab Switcher
    function switchTab(tab) {
        const tabUser = document.getElementById('tab-user');
        const tabAnak = document.getElementById('tab-anak');
        const btnUser = document.getElementById('tab-btn-user');
        const btnAnak = document.getElementById('tab-btn-anak');

        const activeTabCls   = ['text-rose-700', 'font-semibold', 'border-rose-700'];
        const inactiveTabCls = ['text-stone-500', 'font-medium',  'border-transparent'];

        // Tombol Tambah
        const btnTambah      = document.getElementById('btn-tambah');
        const btnTambahLabel = document.getElementById('btn-tambah-label');
        const btnTambahIcon  = document.getElementById('btn-tambah-icon');

        if (tab === 'user') {
            tabUser.classList.remove('hidden');
            tabUser.classList.add('flex');
            tabAnak.classList.add('hidden');
            tabAnak.classList.remove('flex');
            btnUser.classList.add(...activeTabCls);
            btnUser.classList.remove(...inactiveTabCls);
            btnAnak.classList.add(...inactiveTabCls);
            btnAnak.classList.remove(...activeTabCls);

            // Reset tombol ke mode "Tambah User"
            if (btnTambah)      btnTambah.setAttribute('onclick', 'tambahData()');
            if (btnTambahLabel) btnTambahLabel.textContent = 'Tambah User Baru';
            if (btnTambahIcon)  btnTambahIcon.setAttribute('data-lucide', 'plus');
        } else {
            tabAnak.classList.remove('hidden');
            tabAnak.classList.add('flex');
            tabUser.classList.add('hidden');
            tabUser.classList.remove('flex');
            btnAnak.classList.add(...activeTabCls);
            btnAnak.classList.remove(...inactiveTabCls);
            btnUser.classList.add(...inactiveTabCls);
            btnUser.classList.remove(...activeTabCls);

            // Ubah tombol ke mode "Tambah Anak"
            if (btnTambah)      btnTambah.setAttribute('onclick', 'tambahAnak()');
            if (btnTambahLabel) btnTambahLabel.textContent = 'Tambah Balita Baru';
            if (btnTambahIcon)  btnTambahIcon.setAttribute('data-lucide', 'baby');
        }
        if (window.lucide) lucide.createIcons();
    }

    // Filter User berdasarkan Role
    function filterUserRole(role, button) {
        document.querySelectorAll('.user-role-tab').forEach(btn => {
            btn.classList.remove('bg-white', 'text-rose-700', 'shadow-2xs', 'font-semibold');
            btn.classList.add('text-stone-600', 'hover:text-stone-900');
        });
        button.classList.add('bg-white', 'text-rose-700', 'shadow-2xs', 'font-semibold');
        button.classList.remove('text-stone-600', 'hover:text-stone-900');

        const rows = document.querySelectorAll('.table-user-row');
        let visibleCount = 0;
        const totalCount = rows.length;

        rows.forEach(row => {
            const userRole = (row.getAttribute('data-role') || '').trim().toLowerCase();
            const targetRole = role.toLowerCase();
            
            let matches = false;
            if (targetRole === 'all') {
                matches = true;
            } else if (targetRole === 'admin') {
                matches = userRole === 'admin' || userRole === 'administrator';
            } else if (targetRole === 'orang tua' || targetRole === 'orangtua') {
                matches = userRole === 'orang tua' || userRole === 'orangtua';
            } else {
                matches = userRole === targetRole;
            }

            if (matches) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Toggle Empty Filter Row
        const emptyRow = document.getElementById('emptyUserFilterRow');
        if (emptyRow) {
            if (visibleCount === 0 && totalCount > 0) {
                emptyRow.classList.remove('hidden');
            } else {
                emptyRow.classList.add('hidden');
            }
        }

        // Update count display
        const countDisplay = document.getElementById('userCountDisplay');
        if (countDisplay) {
            countDisplay.innerHTML = `Menampilkan <strong class="font-semibold text-stone-700">${visibleCount}</strong> dari <strong class="font-semibold text-stone-700">${totalCount}</strong> pengguna`;
        }

        if (window.lucide) lucide.createIcons();
    }

    // Filter Balita berdasarkan Jenis Kelamin
    function filterBalitaGender(gender, button) {
        document.querySelectorAll('.balita-gender-tab').forEach(btn => {
            btn.classList.remove('bg-white', 'text-rose-700', 'shadow-2xs', 'font-semibold');
            btn.classList.add('text-stone-600', 'hover:text-stone-900');
        });
        button.classList.add('bg-white', 'text-rose-700', 'shadow-2xs', 'font-semibold');
        button.classList.remove('text-stone-600', 'hover:text-stone-900');

        const rows = document.querySelectorAll('.table-balita-row');
        let visibleCount = 0;
        const totalCount = rows.length;

        rows.forEach(row => {
            const rowGender = (row.getAttribute('data-gender') || '').trim().toLowerCase();
            const targetGender = gender.toLowerCase();

            let matches = false;
            if (targetGender === 'all') {
                matches = true;
            } else {
                matches = rowGender === targetGender;
            }

            if (matches) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Toggle Empty Filter Row
        const emptyRow = document.getElementById('emptyBalitaFilterRow');
        if (emptyRow) {
            if (visibleCount === 0 && totalCount > 0) {
                emptyRow.classList.remove('hidden');
            } else {
                emptyRow.classList.add('hidden');
            }
        }

        // Update count display
        const countDisplay = document.getElementById('balitaCountDisplay');
        if (countDisplay) {
            countDisplay.innerHTML = `Menampilkan <strong class="font-semibold text-stone-700">${visibleCount}</strong> data anak/balita`;
        }

        if (window.lucide) lucide.createIcons();
    }

    // Initialize Lucide Icons
    lucide.createIcons();

    // Toggle Mobile Sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const isClosed = sidebar.classList.contains('-translate-x-full');
        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }

    // format tanggal
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
    const today = new Date().toLocaleDateString('id-ID', dateOptions);
    const dateElement = document.getElementById('current-date');
    if (dateElement) {
        dateElement.innerText = today;
    }
</script>

</body>
</html>
