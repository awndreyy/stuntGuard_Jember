<!-- Modal Tambah / Edit User Baru -->
<div id="userModal" class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <!-- Menutup saat background diklik -->
    <div id="modalContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-lg overflow-hidden transition-all duration-200">

        <!-- Modal Header -->
        <div class="px-5 py-4 bg-stone-50/80 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 id="modalTitle" class="text-sm font-bold text-stone-900">Tambah User Baru</h3>
                    <p class="text-[11px] text-stone-500">Isi data akun pengguna untuk mendaftarkan akun baru</p>
                </div>
            </div>
            <!-- Tombol Tutup Modal -->
            <button type="button" onclick="closeUserModal()" class="w-7 h-7 rounded-lg text-stone-400 hover:text-stone-600 hover:bg-stone-200/50 flex items-center justify-center transition-colors cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Modal Form Body -->
        <form id="userFormElement" action="{{ route('users.store') }}" method="POST" class="p-5 space-y-3.5">
            @csrf
            <input type="hidden" name="_method" id="formMethodInput" value="POST">

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="inputName" name="name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required placeholder="Masukkan nama lengkap" class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                </div>
            </div>

            <!-- NIK -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">NIK (16 Digit) <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="id-card" class="w-4 h-4"></i>
                    </span>
                    <input type="number" id="inputNik" name="nik" maxlength="16" required placeholder="3509xxxxxxxxxxxx" class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-semibold text-stone-700 mb-1">Email <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </span>
                    <input type="email" id="inputEmail" name="email" required placeholder="contoh@email.com" class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Grid 2 Kolom: Peran & Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-stone-700 mb-1">Peran / Role <span class="text-rose-500">*</span></label>
                    <select id="selectRole" name="role" required class="w-full px-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                        <option value="" disabled selected>Pilih Peran</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Administrator">Administrator</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-700 mb-1">Password <span id="passwordRequiredStar" class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-stone-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" id="inputPassword" name="password" required placeholder="minimal 6 karakter" class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
                    </div>
                    <p id="passwordHint" class="text-[10px] text-stone-400 mt-1 hidden">Kosongkan jika tidak ingin mengganti password.</p>
                </div>
            </div>

            <!-- Modal Footer Actions -->
            <div class="pt-3 border-t border-stone-100 flex items-center justify-end gap-2">
                <button type="button" onclick="closeUserModal()" class="px-3.5 py-2 text-xs font-semibold text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white text-xs font-semibold rounded-lg transition-colors shadow-xs cursor-pointer">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span id="submitBtnText">Simpan User</span>
                </button>
            </div>
        </form>
    </div>
</div>
