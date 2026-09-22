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
    <!-- alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
<body x-data="userForm()" class="bg-slate-50 text-slate-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-30 hidden md:hidden transition-opacity"></div>

    <!-- Left Sidebar (Fixed / Sticky 16:9 Widescreen Sidebar) -->
    <aside id="sidebar" class="fixed md:sticky top-0 h-screen w-64 bg-white border-r border-slate-200 z-40 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 shrink-0 shadow-xs">
        <div class="flex flex-col h-full">

            <!-- Top Brand Logo Area -->
            <div class="h-16 px-5 border-b border-slate-100 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-teal-800 text-white flex items-center justify-center shadow-sm shadow-teal-900/20">
                    <i data-lucide="shield-check" class="w-5 h-5 stroke-[2.2]"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                    <span class="font-bold text-base tracking-tight text-teal-800">StuntGuard</span>
                    <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-teal-50 text-teal-700 border border-teal-200/60">JEMBER</span>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium leading-none mt-0.5">Monitoring Gizi & MPASI</p>
                </div>
                </div>
                <!-- Close button for mobile -->
                <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-5">

                <!-- Group 1: MAIN -->
                <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Main</span>
                    <nav class="mt-1.5 space-y-1">
                        <a href="{{ url('/') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                            <span class="text-xs font-semibold">Dashboard Overview</span>
                        </a>
                    </nav>
                </div>

                <!-- Group 2: MANAJEMEN KONTEN -->
                <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Manajemen Konten</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kelola Informasi -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                    <i data-lucide="book-open" class="w-4 h-4 mt-0.5 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                    <div class="flex-1">
                        <span class="block text-xs font-semibold">Kelola Informasi</span>
                        <span class="block text-[10px] text-slate-400 font-normal leading-tight mt-0.5">Edukasi & Trimester</span>
                    </div>
                    </a>
                    <!-- Kelola MPASI -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                    <i data-lucide="utensils-crossed" class="w-4 h-4 mt-0.5 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                    <div class="flex-1">
                        <span class="block text-xs font-semibold">Kelola MPASI</span>
                        <span class="block text-[10px] text-slate-400 font-normal leading-tight mt-0.5">Resep 6-23 Bulan</span>
                    </div>
                    </a>
                </nav>
            </div>

            <!-- Group 3: PENGATURAN SISTEM -->
            <div>
                <span class="px-2.5 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Pengaturan Sistem</span>
                <nav class="mt-1.5 space-y-1">
                    <!-- Kalkulator Gizi -->
                    <a href="#" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl text-slate-600 hover:text-teal-800 hover:bg-slate-50 transition-colors">
                    <i data-lucide="calculator" class="w-4 h-4 mt-0.5 text-slate-400 group-hover:text-teal-800 transition-colors"></i>
                    <div class="flex-1">
                        <span class="block text-xs font-semibold">Kalkulator Gizi</span>
                        <span class="block text-[10px] text-slate-400 font-normal leading-tight mt-0.5">Parameter WHO</span>
                    </div>
                    </a>
                    <!-- Kelola User (Active) -->
                    <a href="{{ url('/kelolaUser') }}" class="group flex items-start gap-2.5 px-3 py-2 rounded-xl bg-teal-800 text-white shadow-sm shadow-teal-900/15 transition-all">
                    <i data-lucide="users" class="w-4 h-4 mt-0.5 text-teal-100"></i>
                    <div class="flex-1">
                        <span class="block text-xs font-semibold">Kelola User</span>
                        <span class="block text-[10px] text-teal-200 font-normal leading-tight mt-0.5">Pengguna & Akses</span>
                    </div>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Footer Info Box inside Sidebar -->
        <div class="p-3 border-t border-slate-100 shrink-0">
            <div class="bg-teal-50/80 border border-teal-100 rounded-xl p-2.5 flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-lg bg-teal-800/10 text-teal-800 flex items-center justify-center shrink-0">
                <i data-lucide="activity" class="w-3.5 h-3.5"></i>
            </div>
            <div class="min-w-0">
                <div class="flex items-center gap-1.5">
                <span class="text-[11px] font-semibold text-teal-900">Wilayah Jember</span>
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                <p class="text-[10px] text-teal-700/80 truncate">Sinkron Posyandu Aktif</p>
            </div>
            </div>
        </div>
    </div>
    </aside>

    <!-- Main Content Wrapper (16:9 Full Viewport Height Container) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

    <!-- Header (Compact 56px Widescreen Header) -->
    <header class="h-14 bg-white border-b border-slate-200 sticky top-0 z-20 px-4 sm:px-6 flex items-center justify-between gap-4 shrink-0">

      <!-- Left: Mobile Toggle + Title + Search -->
      <div class="flex items-center gap-3 flex-1 max-w-2xl">
        <button onclick="toggleSidebar()" class="md:hidden p-1.5 rounded-lg text-slate-500 hover:text-teal-800 hover:bg-slate-100 focus:outline-none">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <!-- Search Input -->
        <div class="relative w-full max-w-md">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
            <i data-lucide="search" class="w-4 h-4"></i>
          </span>
          <input type="text" placeholder="Cari data pengguna, nama, NIK..." class="w-full pl-9 pr-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all">
        </div>
      </div>

      <!-- Right Header Actions -->
      <div class="flex items-center gap-3 shrink-0">
        <!-- Date Badge -->
        <span class="hidden xl:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100/80 border border-slate-200/60 text-[11px] font-medium text-slate-600">
          <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
          <span id="current-date">Jumat, 18 Sep 2026</span>
        </span>

        <!-- Admin Profile -->
        <div class="flex items-center gap-2 pl-1">
          <div class="relative">
            <div class="w-8 h-8 rounded-full bg-teal-800 text-white font-semibold text-xs flex items-center justify-center ring-2 ring-teal-800/20">
              {{ $userInitials ?? 'AD' }}
            </div>
            <span class="absolute bottom-0 right-0 w-2 h-2 bg-emerald-500 border-2 border-white rounded-full"></span>
          </div>
          <div class="hidden sm:block text-left">
            <p class="text-xs font-bold text-slate-800 leading-none">{{ $userName ?? 'Admin Dinkes' }}</p>
            <p class="text-[10px] text-slate-400 font-medium leading-none mt-0.5">{{ $userRole ?? 'Kab. Jember' }}</p>
          </div>
        </div>
      </div>
    </header>

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
        <button @click="tambahData()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-800 hover:bg-teal-900 text-white text-xs font-semibold rounded-lg transition-colors shadow-sm">
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
                                {{-- Edit --}}
                                <button @click="editData({{ $user }})" class="p-1.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded transition-colors" title="Edit User">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                {{-- Hapus --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau menghapus akun {{ $user->name }} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus User">
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
@include('components.modalTambahUser')

<script>
    // Form untuk user
    function userForm() {
        return {
            showModal: false,
            isEdit: false,
            formAction: '{{ route('users.store') }}', // URL bawaan untuk tambah data
            formMethod: 'POST',
            formData: {
                name: '', nik: '', email: '', role: ''
            },
            // Fungsi saat tombol "Tambah User Baru" ditekan
            tambahData() {
                this.isEdit = false;
                this.formAction = '{{ route('users.store') }}';
                this.formMethod = 'POST';
                this.formData = { name: '', nik: '', email: '', role: '' };
                this.showModal = true;
            },
            // Fungsi saat ikon "Pensil" di tabel ditekan
            editData(user) {
                this.isEdit = true;
                this.formAction = `/users/${user.id}`; // Arahkan URL ke spesifik ID user
                this.formMethod = 'PUT'; // Metode wajib Laravel untuk Update
                this.formData = {
                    name: user.name,
                    nik: user.nik,
                    email: user.email,
                    role: user.role
                };
                this.showModal = true;
            }
        };
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
