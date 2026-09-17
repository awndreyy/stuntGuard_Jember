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

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">NIK</label>
                            <input type="number" x-model="form.nik" placeholder="Masukan NIK" class="w-full px-4 py-3 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/70 text-slate-900 font-semibold focus:bg-white focus:ring-2 focus:ring-teal-500/30 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Umur  <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center">
                                <input type="number" x-model="form.age" placeholder="Contoh: 16 (dalam bulan)" class="w-full pl-4 pr-11 py-3 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/70 text-slate-900 font-semibold focus:bg-white focus:ring-2 focus:ring-teal-500/30 outline-none transition-all">
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
                </div>
            </section>

            <!-- FORM CARD 2: Hasil Pengukuran Baru -->
            <section class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6">

                <!-- Measurement Grid -->
                <div class="space-y-4">
                    <!-- Row 1: BB & TB -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Berat Badan -->
                        <div class="p-4 rounded-2xl bg-[#EEF2FF]/70 border border-slate-200/60 space-y-2">
                            <div class="flex justify-between items-center text-xs font-bold">
                                <span class="text-slate-700">Berat Badan (BB) <span class="text-red-500">*</span></span>
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
                            </div>
                            <div class="bg-white rounded-xl p-3 flex justify-between items-center border border-slate-200/80">
                                <input type="text" x-model="form.height" class="w-full text-xl sm:text-xl font-bold text-slate-900 bg-transparent outline-none">
                                <span class="text-slate-500 font-semibold text-base ml-2">cm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Action Button -->
            <div class="flex justify-end pt-2">
                <button @click="simpanData()" class="flex items-center space-x-2.5 px-7 py-4 rounded-2xl bg-[#004D47] hover:bg-[#003833] text-white font-bold text-base shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    <span>Simpan Data</span>
                </button>
            </div>
        </main>
    </div>

    <!-- Script Alpine.js Application Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('nutriVisualApp', () => ({
                // 1. Objek form yang disisakan HANYA yang dikirim ke database
                form: {
                    name: '',
                    nik: '',
                    age: '',
                    gender: '',
                    weight: '',
                    height: '',
                },

                initIcons() {
                    this.$nextTick(() => {
                        if (window.lucide) {
                            lucide.createIcons();
                        }
                    });
                },

                simpanData() {
                    // Validasi ringan di frontend agar umur tidak kosong
                    if(!this.form.name || !this.form.nik || !this.form.age || !this.form.weight || !this.form.height || !this.form.gender) {
                        alert("Semua Form Wajib Diisi!");
                        return;
                    }

                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('/simpan-pengukuran', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify(this.form)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.status === 'success') {
                            alert('Sip! Data balita berhasil masuk ke Database.');

                            // 2. Kosongkan semua form setelah berhasil
                            this.form.name = '';
                            this.form.nik = '';
                            this.form.age = '';
                            this.form.gender = '';
                            this.form.weight = '';
                            this.form.height = '';
                        } else {
                            console.error("Error:", data);
                            alert("Gagal menyimpan. Cek kembali isian form Anda.");
                        }
                    })
                    .catch(error => {
                        console.error('Error Server:', error);
                        alert('Gagal terhubung ke database.');
                    });
                }
            }));
        });
    </script>
    </body>
</html>
