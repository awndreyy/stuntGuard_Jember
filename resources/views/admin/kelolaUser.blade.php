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
            <p class="text-xs text-slate-500 mt-0.5">
                Manajemen data pengguna aplikasi, kader posyandu, dan masyarakat.
            </p>
            </div>
            {{-- Tombol Tambah User --}}
            <button onclick="tambahData()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-800 hover:bg-teal-900 text-white text-xs font-semibold rounded-lg transition-colors shadow-sm cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah User Baru</span>
            </button>
        </div>

      <!-- User Management Table Section -->
        <section class="flex-1 bg-white rounded-xl border border-slate-200/80 shadow-2xs flex flex-col min-h-0 overflow-hidden">

        <!-- Card Header with Filters -->
        <div class="px-4 py-3 border-b border-slate-100 flex flex-wrap items-center justify-between gap-3 shrink-0">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-800 flex items-center justify-center">
                <i data-lucide="users" class="w-4 h-4"></i>
                </div>
                <div>
                <h2 class="text-sm font-bold text-slate-900">Daftar Pengguna</h2>
                </div>
            </div>

            <div class="flex items-center gap-2">
            <!-- Filter Tabs -->
                <div class="hidden sm:flex items-center bg-slate-100/80 p-0.5 rounded-lg text-[11px] font-medium text-slate-600">
                    <button class="px-2.5 py-1 rounded-md bg-white text-teal-900 shadow-2xs font-semibold">Semua</button>
                    <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Admin</button>
                    <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Orangtua</button>
                </div>
            </div>
        </div>

        <!-- Data Table Container -->
        <div class="flex-1 overflow-y-auto min-h-0">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 bg-slate-50/90 backdrop-blur-xs border-b border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider z-10">
                    <tr>
                        <th class="py-3 px-4">Informasi Pengguna</th>
                        <th class="py-3 px-4">Kontak</th>
                        <th class="py-3 px-4">Role / Peran</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    <!-- Looping data $users dari controller -->
                    @foreach($users as $user)
                    <tr class="hover:bg-teal-50/40 transition-colors group">
                        <td class="py-3 px-4 font-medium text-slate-900">
                            <div class="flex items-center gap-3">
                                <!-- Lingkaran inisial nama -->
                                <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-800 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <!-- Nama dan NIK asli -->
                                    <span class="block text-xs font-semibold text-slate-800">{{ $user->name }}</span>
                                    <span class="block text-[10px] text-slate-400">NIK: {{ $user->nik ?? '-' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <!-- Email asli -->
                            <span class="block text-xs text-slate-700">{{ $user->email }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <!-- Role asli (Masyarakat/Kader/Admin) -->
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/60">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <!-- Tombol Aksi -->
                            <div class="inline-flex items-center justify-center gap-1.5">
                                <button type="button" onclick="editData(@js($user))" class="p-1.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded transition-colors cursor-pointer" title="Edit User">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau menghapus akun {{ $user->name }} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors cursor-pointer" title="Hapus User">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Card Footer (Pagination) -->
        <div class="px-4 py-2.5 bg-slate-50 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500 shrink-0">
            <span>Menampilkan <strong class="font-semibold text-slate-700">1-4</strong> dari <strong class="font-semibold text-slate-700">{{ $totalUsers ?? '2,450' }}</strong> pengguna</span>

            <div class="flex items-center gap-1.5">
            <!-- Previous Button -->
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200/80 bg-white hover:bg-slate-50 text-slate-400 transition-colors text-xs font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Sebelumnya</span>
            </button>

            <!-- Page Numbers -->
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 rounded-lg bg-teal-800 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                1
                </button>
                <button class="w-8 h-8 rounded-lg text-slate-600 hover:bg-slate-200/60 font-medium text-xs flex items-center justify-center transition-colors">
                2
                </button>
                <button class="w-8 h-8 rounded-lg text-slate-600 hover:bg-slate-200/60 font-medium text-xs flex items-center justify-center transition-colors">
                3
                </button>
                <span class="w-6 h-8 text-slate-400 text-xs flex items-center justify-center font-semibold tracking-wider">
                ...
                </span>
                <button class="w-8 h-8 rounded-lg text-slate-600 hover:bg-slate-200/60 font-medium text-xs flex items-center justify-center transition-colors">
                409
                </button>
            </div>

            <!-- Next Button -->
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200/80 bg-white hover:bg-slate-100 text-slate-700 transition-colors text-xs font-medium">
                <span class="hidden sm:inline">Selanjutnya</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

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
