<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StuntGuard - Kalkulator Gizi & Deteksi Tumbuh Kembang Balita</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,400..600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js untuk State Management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased text-[#0F172A] bg-[#F4F7FC]">

    <!-- Alpine Data Container -->
    <div x-data="nutriVisualApp()" x-init="initIcons()" class="min-h-screen flex flex-col pb-12">

        <!-- NAVBAR -->
        <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 py-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#00685f] to-[#0D9488] flex items-center justify-center text-white shadow-md">
                            <i data-lucide="heart-pulse" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="flex items-center space-x-1.5">
                                <span class="text-xl font-bold tracking-tight text-[#00685f]">Stunt</span>
                                <span class="text-xl font-bold tracking-tight text-slate-800">Guard</span>
                            </div>
                            <p class="text-[11px] font-medium text-slate-500 tracking-normal -mt-1">
                                Sistem Pemantauan Gizi Visual
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            <!-- Child Tabs -->
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <template x-for="(child, index) in childrenList" :key="child.id">
                    <button @click="selectChild(child.id)"
                            :class="activeChildId === child.id ? 'bg-[#004d47] text-white shadow-sm' : 'bg-slate-200/70 text-slate-700 hover:bg-slate-300/80'"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all">
                        <span class="w-2 h-2 rounded-full" :class="activeChildId === child.id ? 'bg-teal-300' : 'bg-slate-400'"></span>
                        <span x-text="'Anak ' + (index + 1) + ': ' + child.name + ' (' + calculateAgeText(child.dob) + ')'"></span>
                    </button>
                </template>
                <!-- tombol tambah anak baru -->
                {{-- <button @click="modals.addChild = true" class="flex items-center space-x-1.5 px-4 py-2.5 rounded-full text-xs sm:text-sm font-semibold bg-[#EBF5F4] text-[#00685f] hover:bg-teal-100/80 transition-colors">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>Tambah Profil Bayi Baru</span>
                </button> --}}
            </div>

            <!-- FORM CARD 1: Data Identitas Balita -->
            <section class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                <!-- Card Header -->
                <div class="flex items-center justify-between pb-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-[#5EEAD4] text-[#004D47] font-extrabold flex items-center justify-center text-base shadow-sm">1</div>
                        <h2 class="text-xl font-bold text-slate-900">Data Identitas Balita</h2>
                    </div>
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#E6F4F1] text-[#00685F] tracking-wide" x-text="'ID Balita: ' + form.id_balita"></span>
                </div>

                <!-- Input Fields -->
                <div class="space-y-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap Balita <span class="text-red-500">*</span></label>
                        <div class="relative flex items-center">
                            <div class="absolute left-3.5 text-slate-400">
                                <i data-lucide="vcard" class="w-5 h-5"></i>
                            </div>
                            <input type="text" x-model="form.name" placeholder="Masukan Nama Anak" class="w-full pl-11 pr-4 py-3 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/70 text-slate-900 font-semibold focus:bg-white focus:ring-2 focus:ring-teal-500/30 outline-none transition-all">
                        </div>
                    </div>

                    <!-- NIK & Tanggal Lahir -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">NIK / Nomor Buku KIA (Opsional)</label>
                            <input type="text" x-model="form.nik" placeholder="Masukan NIK" class="w-full px-4 py-3 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/70 text-slate-900 font-semibold focus:bg-white focus:ring-2 focus:ring-teal-500/30 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center">
                                <input type="date" x-model="form.dob_display" class="w-full pl-4 pr-11 py-3 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/70 text-slate-900 font-semibold focus:bg-white focus:ring-2 focus:ring-teal-500/30 outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Laki-laki -->
                            <label :class="form.gender === 'Laki-laki' ? 'bg-[#E6F4F1] border-teal-500/60 ring-1 ring-teal-500/40 text-slate-900' : 'bg-[#EEF2FF]/70 border-slate-200/70 text-slate-600 hover:bg-slate-100'"
                                class="flex items-center justify-between p-3.5 rounded-2xl border text-sm cursor-pointer transition-all">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="Laki-laki" x-model="form.gender" class="w-4 h-4 text-[#00685F] focus:ring-[#00685F]">
                                    <div class="flex items-center space-x-2 font-bold text-slate-800">
                                        <i data-lucide="mars" class="w-4 h-4 text-[#00685F]"></i>
                                        <span>Laki-Laki</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Perempuan -->
                            <label :class="form.gender === 'Perempuan' ? 'bg-[#E6F4F1] border-teal-500/60 ring-1 ring-teal-500/40 text-slate-900' : 'bg-[#EEF2FF]/70 border-slate-200/70 text-slate-600 hover:bg-slate-100'"
                                class="flex items-center justify-between p-3.5 rounded-2xl border text-sm cursor-pointer transition-all">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="Perempuan" x-model="form.gender" class="w-4 h-4 text-[#00685F] focus:ring-[#00685F]">
                                    <div class="flex items-center space-x-2 font-bold text-slate-800">
                                        <i data-lucide="venus" class="w-4 h-4 text-pink-600"></i>
                                        <span>Perempuan</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Usia Terhitung Banner -->
                    <div class="mt-4 p-4 rounded-2xl bg-[#EEF2FF] border border-blue-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                                <i data-lucide="scale" class="w-4 h-4"></i>
                            </div>
                            <div class="text-sm font-semibold text-slate-800">
                                <span>Usia Terhitung: </span>
                                <span class="font-bold text-[#00685F]" x-text="form.age_text">16 Bulan 4 Hari</span>
                            </div>
                        </div>
                        <span class="px-3.5 py-1.5 bg-white text-slate-700 font-bold text-xs rounded-xl shadow-xs border border-slate-200/60 self-start sm:self-auto" x-text="form.category">
                            Kategori: 0 – 24 Bulan (MPASI & Golden Age)
                        </span>
                    </div>
                </div>
            </section>

            <!-- FORM CARD 2: Hasil Pengukuran Baru -->
            <section class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                <!-- Card Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-[#93C5FD] text-blue-950 font-extrabold flex items-center justify-center text-base shadow-sm">2</div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Hasil Pengukuran Baru</h2>
                            <p class="text-xs font-medium text-slate-500">Catatan fisik terkini untuk pembaruan kurva KMS</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-[#EEF2FF] text-blue-800 text-xs font-semibold self-start sm:self-auto">
                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                        <span x-text="'Hari ini, ' + form.measurement_date">Hari ini, 18 Mei 2025</span>
                    </div>
                </div>

                <!-- Measurement Grid -->
                <div class="space-y-4">
                    <!-- Row 1: BB & TB -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Berat Badan -->
                        <div class="p-4 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/60 space-y-2">
                            <div class="flex justify-between items-center text-xs font-bold">
                                <span class="text-slate-700">Berat Badan (BB) <span class="text-red-500">*</span></span>
                                <span class="text-emerald-600 font-semibold flex items-center space-x-1">
                                    <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                                    <span x-text="form.weight_diff">+0.4 kg vs bln lalu</span>
                                </span>
                            </div>
                            <div class="bg-white rounded-xl p-3 flex justify-between items-center border border-slate-200/80">
                                <input type="text" x-model="form.weight" class="w-full text-xl sm:text-xl font-bold text-slate-900 bg-transparent outline-none">
                                <span class="text-slate-500 font-semibold text-base ml-2">kg</span>
                            </div>
                            <p class="text-[11px] font-medium text-slate-500" x-text="'Bulan lalu (15 bln): ' + form.weight_prev + ' kg'"></p>
                        </div>

                        <!-- Panjang / Tinggi Badan -->
                        <div class="p-4 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/60 space-y-2">
                            <div class="flex justify-between items-center text-xs font-bold">
                                <span class="text-slate-700">Panjang / Tinggi Badan <span class="text-red-500">*</span></span>
                                <span class="text-blue-600 font-semibold flex items-center space-x-1">
                                    <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                                    <span x-text="form.height_diff">+1.5 cm vs bln lalu</span>
                                </span>
                            </div>
                            <div class="bg-white rounded-xl p-3 flex justify-between items-center border border-slate-200/80">
                                <input type="text" x-model="form.height" class="w-full text-xl sm:text-xl font-bold text-slate-900 bg-transparent outline-none">
                                <span class="text-slate-500 font-semibold text-base ml-2">cm</span>
                            </div>
                            <!-- Radio Terlentang / Berdiri -->
                            <div class="flex items-center space-x-4 pt-1 text-xs font-semibold text-slate-700">
                                <label class="flex items-center space-x-1.5 cursor-pointer">
                                    <input type="radio" name="position" value="Terlentang" x-model="form.position" class="w-3.5 h-3.5 text-[#00685F]">
                                    <span>Terlentang (&lt;24 bln)</span>
                                </label>
                                <label class="flex items-center space-x-1.5 cursor-pointer">
                                    <input type="radio" name="position" value="Berdiri" x-model="form.position" class="w-3.5 h-3.5 text-[#00685F]">
                                    <span>Berdiri (&ge;24 bln)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Lingkar Kepala & LiLA -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Lingkar Kepala -->
                        <div class="p-4 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/60 space-y-2">
                            <label class="block text-xs font-bold text-slate-700">Lingkar Kepala (Oksipito-frontal)</label>
                            <div class="bg-white rounded-xl p-3 flex justify-between items-center border border-slate-200/80">
                                <input type="text" x-model="form.head_circ" class="w-full text-xl font-bold text-slate-900 bg-transparent outline-none">
                                <span class="text-slate-500 font-semibold text-sm ml-2">cm</span>
                            </div>
                            <p class="text-[11px] font-bold text-emerald-600" x-text="form.head_circ_status">Normal (Rentang aman: 45.0 – 48.0 cm)</p>
                        </div>

                        <!-- LiLA -->
                        <div class="p-4 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/60 space-y-2">
                            <label class="block text-xs font-bold text-slate-700">Lingkar Lengan Atas (LiLA)</label>
                            <div class="bg-white rounded-xl p-3 flex justify-between items-center border border-slate-200/80">
                                <input type="text" x-model="form.lila" class="w-full text-xl font-bold text-slate-900 bg-transparent outline-none">
                                <span class="text-slate-500 font-semibold text-sm ml-2">cm</span>
                            </div>
                            <p class="text-[11px] font-bold text-emerald-600 flex items-center space-x-1" x-text="'● ' + form.lila_status">● Pita Hijau (&gt;12.5 cm – Gizi Cukup)</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Action Button -->
            <div class="flex justify-end pt-2">
                <button @click="calculateZScore()" class="flex items-center space-x-2.5 px-7 py-4 rounded-2xl bg-[#004D47] hover:bg-[#003833] text-white font-bold text-base shadow-lg hover:shadow-xl">
                    <i data-lucide="calculator" class="w-5 h-5 text-teal-300"></i>
                    <span>Hitung & Lihat Hasil Skrining</span>
                </button>
            </div>
        </main>

        <!-- Modal Skrining -->
        <div x-show="modals.screening" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="modals.screening = false" class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl p-6 sm:p-8 space-y-5">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center space-x-2">
                        <i data-lucide="activity" class="w-6 h-6 text-[#00685F]"></i>
                        <span>Hasil Evaluasi Antropometri</span>
                    </h3>
                    <button @click="modals.screening = false" class="text-slate-400 hover:text-slate-600">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <div class="p-5 bg-[#F8FAFC] rounded-2xl border border-slate-200/80 space-y-3 text-sm text-slate-700">
                    <div class="grid grid-cols-2 gap-2 pb-2 border-b border-slate-200/60">
                        <p><span class="font-semibold text-slate-500">ID Balita:</span> <span class="font-bold text-slate-900" x-text="form.id_balita"></span></p>
                        <p><span class="font-semibold text-slate-500">Nama Balita:</span> <span class="font-bold text-slate-900" x-text="form.name"></span></p>
                        <p><span class="font-semibold text-slate-500">NIK:</span> <span class="font-bold text-slate-900" x-text="form.nik"></span></p>
                        <p><span class="font-semibold text-slate-500">Tgl Lahir:</span> <span class="font-bold text-slate-900" x-text="form.dob_display"></span></p>
                        <p><span class="font-semibold text-slate-500">Jenis Kelamin:</span> <span class="font-bold text-slate-900" x-text="form.gender"></span></p>
                        <p><span class="font-semibold text-slate-500">Usia:</span> <span class="font-bold text-slate-900" x-text="form.age_text"></span></p>
                    </div>
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <p><span class="font-semibold text-slate-500">Berat Badan:</span> <span class="font-bold text-slate-900" x-text="form.weight + ' kg'"></span></p>
                        <p><span class="font-semibold text-slate-500">Tinggi Badan:</span> <span class="font-bold text-slate-900" x-text="form.height + ' cm (' + form.position + ')'"></span></p>
                        <p><span class="font-semibold text-slate-500">Lingkar Kepala:</span> <span class="font-bold text-slate-900" x-text="form.head_circ + ' cm'"></span></p>
                        <p><span class="font-semibold text-slate-500">LiLA:</span> <span class="font-bold text-slate-900" x-text="form.lila + ' cm'"></span></p>
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button @click="modals.screening = false" class="px-6 py-2.5 bg-[#004D47] text-white rounded-xl font-bold transition-colors hover:bg-[#003833]">Tutup</button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Profil Bayi -->
        {{-- <div x-show="modals.addChild" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="modals.addChild = false" class="bg-white rounded-3xl max-w-md w-full shadow-2xl p-6 sm:p-7 space-y-5">
                <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900">Tambah Profil Balita Baru</h3>
                    <button @click="modals.addChild = false" class="text-slate-400 hover:text-slate-600">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <form @submit.prevent="addNewChild()">
                    <div class="space-y-4 text-left">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap Balita <span class="text-red-500">*</span></label>
                            <input type="text" x-model="newChild.name" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-teal-500/30 font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" x-model="newChild.dob" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-teal-500/30 font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-3">
                                <label :class="newChild.gender === 'Laki-laki' ? 'border-teal-500 bg-[#E6F4F1] text-[#00685F] font-bold' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-medium'"
                                    class="flex items-center justify-center space-x-2 p-2.5 rounded-xl border text-sm cursor-pointer transition-all">
                                    <input type="radio" name="newGender" value="Laki-laki" x-model="newChild.gender" class="sr-only">
                                    <i data-lucide="mars" class="w-4 h-4"></i>
                                    <span>Laki-Laki</span>
                                </label>
                                <label :class="newChild.gender === 'Perempuan' ? 'border-teal-500 bg-[#E6F4F1] text-[#00685F] font-bold' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-medium'"
                                    class="flex items-center justify-center space-x-2 p-2.5 rounded-xl border text-sm cursor-pointer transition-all">
                                    <input type="radio" name="newGender" value="Perempuan" x-model="newChild.gender" class="sr-only">
                                    <i data-lucide="venus" class="w-4 h-4"></i>
                                    <span>Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="modals.addChild = false" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-200">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-[#004D47] text-white rounded-xl font-bold text-sm hover:bg-[#003833]">Simpan Profil</button>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>

    <!-- Script Alpine.js Application Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nutriVisualApp', () => ({
                childrenList: [
                    {
                        name: 'ahay',
                        fullName: 'Aha hay',
                        nik: '3174091201240003',
                        dob: '2024-01-12',
                        dob_display: '12/01/2024',
                        gender: 'Laki-laki',
                        age_text: '16 Bulan 4 Hari',
                        category: 'Kategori: 0 – 24 Bulan (MPASI & Golden Age)',
                        weight: '10,20',
                        weight_prev: '9.80',
                        weight_diff: '+0.4 kg vs bln lalu',
                        height: '80,2',
                        height_diff: '+1.5 cm vs bln lalu',
                        position: 'Terlentang',
                        head_circ: '46,5',
                        head_circ_status: 'Normal (Rentang aman: 45.0 – 48.0 cm)',
                        lila: '15,2',
                        lila_status: 'Pita Hijau (>12.5 cm – Gizi Cukup)',
                        measurement_date: '18 Mei 2025'
                    }
                ],
                activeChildId: 'child-1',
                form: {
                    id_balita: 'NV-2024-0891',
                    name: '',
                    nik: '',
                    dob: '',
                    dob_display: '',
                    gender: '',
                    age_text: '199 Bulan',
                    category: 'Kategori: 0 – 24 Bulan (MPASI & Golden Age)',
                    weight: '',
                    weight_prev: '9.80',
                    weight_diff: '+0.4 kg vs bln lalu',
                    height: '',
                    height_diff: '+1.5 cm vs bln lalu',
                    position: '',
                    head_circ: '',
                    head_circ_status: 'Normal (Rentang aman: 45.0 – 48.0 cm)',
                    lila: '',
                    lila_status: 'Pita Hijau (>12.5 cm – Gizi Cukup)',
                    measurement_date: ''
                },
                newChild: {
                    name: '',
                    dob: '',
                    gender: 'Laki-laki'
                },
                modals: {
                    screening: false,
                    addChild: false,
                    faskes: false
                },

                initIcons() {
                    this.$nextTick(() => {
                        if (window.lucide) {
                            lucide.createIcons();
                        }
                    });
                },

                calculateAgeText(dobString) {
                    return '16 Bulan';
                },

                selectChild(id) {
                    this.activeChildId = id;
                    const child = this.childrenList.find(c => c.id === id);
                    if (child) {
                        this.form = { ...child, name: child.fullName || child.name };
                    }
                    this.initIcons();
                },

                addNewChild() {
                    if (!this.newChild.name) return;
                    const count = this.childrenList.length + 1;
                    const newId = 'child-' + count;
                    const childObj = {
                        id: newId,
                        id_balita: 'NV-2024-089' + count,
                        name: this.newChild.name,
                        fullName: this.newChild.name,
                        nik: '317409' + Math.floor(1000000000 + Math.random() * 9000000000),
                        dob: this.newChild.dob || '2024-01-01',
                        dob_display: this.newChild.dob ? this.newChild.dob.split('-').reverse().join('/') : '01/01/2024',
                        gender: this.newChild.gender || 'Laki-laki',
                        age_text: '12 Bulan',
                        category: 'Kategori: 0 – 24 Bulan (MPASI & Golden Age)',
                        weight: '9,50',
                        weight_prev: '9.10',
                        weight_diff: '+0.4 kg vs bln lalu',
                        height: '76,0',
                        height_diff: '+1.0 cm vs bln lalu',
                        position: 'Terlentang',
                        head_circ: '45,0',
                        head_circ_status: 'Normal (Rentang aman: 44.0 – 47.0 cm)',
                        lila: '14,5',
                        lila_status: 'Pita Hijau (>12.5 cm – Gizi Cukup)',
                        measurement_date: '18 Mei 2025'
                    };
                    this.childrenList.push(childObj);
                    this.selectChild(newId);
                    this.newChild = { name: '', dob: '', gender: 'Laki-laki' };
                    this.modals.addChild = false;
                },

                calculateZScore() {
                    this.modals.screening = true;
                    this.initIcons();
                }
            }));
        });
    </script>
</body>
</html>
