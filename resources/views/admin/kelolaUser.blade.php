<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kelola User - StuntGuard Jember' }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
        theme: {
            extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            colors: {
                teal: {
                750: '#0f6157',
                800: '#115e59',
                900: '#134e4a',
                }
            }
            }
        }
        }
    </script>

    <style>
        body {
        font-family: 'Inter', sans-serif;
        -webkit-font-smoothing: antialiased;
        }
        /* Custom subtle scrollbar for tables & sidebars */
        ::-webkit-scrollbar {
        width: 5px;
        height: 5px;
        }
        ::-webkit-scrollbar-track {
        background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper (16:9 Full Viewport Height Container) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

    <!-- Header Component -->
    <x-admin.header searchPlaceholder="Cari data pengguna, nama, NIK..." />

    <!-- Main Content Canvas (16:9 Screen Fit with Zero Vertical Overflow) -->
    <main class="flex-1 overflow-y-auto md:overflow-hidden p-3.5 sm:p-5 flex flex-col gap-3.5 max-w-[1920px] w-full mx-auto">

        <!-- Top Row: Welcome & Status Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shrink-0">
            <div>
                <h1 class="text-lg sm:text-xl font-bold tracking-tight text-slate-900 flex items-center gap-2">
                    Kelola User
                </h1>
            </div>
            {{-- Tombol Tambah (teks berubah sesuai tab aktif) --}}
            <button id="btn-tambah" onclick="tambahData()" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-teal-800 hover:bg-teal-900 text-white text-xs font-semibold rounded-lg transition-colors shadow-sm cursor-pointer w-full sm:w-auto">
                <i id="btn-tambah-icon" data-lucide="plus" class="w-4 h-4"></i>
                <span id="btn-tambah-label">Tambah User Baru</span>
            </button>
        </div>

        {{-- Tab Switcher --}}
        @include('admin.partials.tab-switcher')

        {{-- Table Section --}}
        <section class="flex-1 bg-white rounded-xl border border-slate-200/80 shadow-2xs flex flex-col min-h-0 overflow-hidden">
            @include('admin.partials.table-users')
            @include('admin.partials.table-anak')
        </section>

    <!-- Footer -->
    <footer class="text-center py-1">
        <span class="text-[10px] text-emerald-800 hidden xl:inline text-center">© 2026 StuntGuard Jember</span>
    </footer>

    </main>
</div>

<!-- Modal Tambah User Baru  -->
@include('components.admin.modalTambahUser')

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

        const activeTabCls   = ['text-teal-900', 'font-semibold', 'border-teal-800'];
        const inactiveTabCls = ['text-slate-500', 'font-medium',  'border-transparent'];

        // Tombol Tambah
        const btnTambah      = document.getElementById('btn-tambah');
        const btnTambahLabel = document.getElementById('btn-tambah-label');
        const btnTambahIcon  = document.getElementById('btn-tambah-icon');

        if (tab === 'user') {
            tabUser.classList.remove('hidden');
            tabAnak.classList.add('hidden');
            btnUser.classList.add(...activeTabCls);
            btnUser.classList.remove(...inactiveTabCls);
            btnAnak.classList.add(...inactiveTabCls);
            btnAnak.classList.remove(...activeTabCls);

            // Reset tombol ke mode "Tambah User"
            if (btnTambah)      btnTambah.setAttribute('onclick', 'tambahData()');
            if (btnTambahLabel) btnTambahLabel.textContent = 'Tambah User Baru';
            if (btnTambahIcon)  btnTambahIcon.setAttribute('data-lucide', 'user-plus');
        } else {
            tabAnak.classList.remove('hidden');
            tabUser.classList.add('hidden');
            btnAnak.classList.add(...activeTabCls);
            btnAnak.classList.remove(...inactiveTabCls);
            btnUser.classList.add(...inactiveTabCls);
            btnUser.classList.remove(...activeTabCls);

            // Ubah tombol ke mode "Tambah Anak"
            if (btnTambah)      btnTambah.setAttribute('onclick', 'tambahAnak()');
            if (btnTambahLabel) btnTambahLabel.textContent = 'Tambah Balita Baru';
            if (btnTambahIcon)  btnTambahIcon.setAttribute('data-lucide', 'baby');
        }
        lucide.createIcons();
    }

    // Placeholder fungsi tambah anak (implementasi modal terpisah)
    function tambahAnak() {
        // TODO: buka modal tambah anak
        alert('Modal tambah anak belum tersedia.');
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
