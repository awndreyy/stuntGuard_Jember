<!-- Modal Tambah User Baru -->
<div x-show="showModal" x-cloak class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <!--  menutup saat background diklik -->
    <div @click.away="showModal = false" class="bg-white rounded-2xl border border-slate-200 shadow-2xl w-full max-w-lg overflow-hidden transition-all duration-200">

        <!-- Modal Header -->
        <div class="px-5 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-teal-100/80 text-teal-800 flex items-center justify-center">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900" x-text="isEdit ? 'Edit Data User' : 'Tambah User Baru'"></h3>
                    <p class="text-[11px] text-slate-500">Isi data akun pengguna untuk mendaftarkan akun baru</p>
                </div>
            </div>
            <!-- Ubah onclick menjadi @click -->
            <button type="button" @click="showModal = false" class="w-7 h-7 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-200/50 flex items-center justify-center transition-colors cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Modal Form Body -->
        <!-- Hapus onsubmit="handleAddUser(event)", biarkan Laravel menangani POST formnya -->
        <form :action="formAction" method="POST" class="p-5 space-y-3.5">
            @csrf
            <input type="hidden" name="_method" :value="formMethod">

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </span>
                    <input type="text" name="name" x-model="formData.name" x-on:input="formData.name = $event.target.value.replace(/[^a-zA-Z\s]/g, '')" required placeholder="Masukkan nama lengkap" class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all">
                    {{-- <input type="text" name="name" x-model= "formData.name" required placeholder="Masukkan nama lengkap" class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all"> --}}
                </div>
            </div>

            <!-- NIK -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">NIK (16 Digit) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="id-card" class="w-4 h-4"></i>
                    </span>
                    <!-- Pastikan namenya 'nik' -->
                    <input type="number" name="nik" maxlength="16" x-model= "formData.nik" required placeholder="3509xxxxxxxxxxxx" class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Email <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </span>
                    <input type="email" name="email" x-model= "formData.email" required placeholder="contoh@email.com" class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Grid 2 Kolom: Peran & Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Peran / Role <span class="text-red-500">*</span></label>
                    <select name="role" x-model= "formData.role" required class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all">
                        <option value="" disabled selected>Pilih Peran</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Administrator">Administrator</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password" :required="!isEdit" placeholder="minimal 6 karakter" class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-800/20 focus:border-teal-800 focus:bg-white transition-all">
                    </div>
                    <p x-show="isEdit" class="text-[10px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti password.</p>
                </div>
            </div>

            <!-- Modal Footer Actions -->
            <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                <!-- Ubah onclick menjadi @click -->
                <button type="button" @click="showModal = false" class="px-3.5 py-2 text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-800 hover:bg-teal-900 text-white text-xs font-semibold rounded-lg transition-colors shadow-xs cursor-pointer">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span x-text="isEdit ? 'Update User' : 'Simpan User'"></span>
                </button>
            </div>
        </form>
    </div>
</div>
