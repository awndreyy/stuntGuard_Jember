{{-- resources/views/admin/partial/table-users.blade.php --}}
{{-- Tabel Data Pengguna --}}
<div id="tab-user">

    {{-- Card Header with Filters --}}
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
            {{-- Filter Tabs --}}
            <div class="hidden sm:flex items-center bg-slate-100/80 p-0.5 rounded-lg text-[11px] font-medium text-slate-600">
                <button class="px-2.5 py-1 rounded-md bg-white text-teal-900 shadow-2xs font-semibold">Semua</button>
                <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Admin</button>
                <button class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Orangtua</button>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
        <table class="w-full text-left border-collapse min-w-[560px]">
            <thead class="sticky top-0 bg-slate-50/90 backdrop-blur-xs border-b border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider z-10">
                <tr>
                    <th class="py-3 px-4 whitespace-nowrap">Informasi Pengguna</th>
                    <th class="py-3 px-4 whitespace-nowrap">Kontak</th>
                    <th class="py-3 px-4 whitespace-nowrap">Role / Peran</th>
                    <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @foreach($users as $user)
                <tr class="hover:bg-teal-50/40 transition-colors group">
                    <td class="py-3 px-4 font-medium text-slate-900 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            {{-- Lingkaran inisial nama --}}
                            <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-800 font-bold text-xs flex items-center justify-center shrink-0">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-slate-800">{{ $user->name }}</span>
                                <span class="block text-[10px] text-slate-400">NIK: {{ $user->nik ?? '-' }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 whitespace-nowrap">
                        <span class="block text-xs text-slate-700">{{ $user->email }}</span>
                    </td>
                    <td class="py-3 px-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/60">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center whitespace-nowrap">
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

    {{-- Card Footer (Pagination) --}}
    <div class="px-4 py-2.5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 shrink-0">
        <span class="text-center sm:text-left">Menampilkan <strong class="font-semibold text-slate-700">1-{{ count($users) }}</strong> dari <strong class="font-semibold text-slate-700">{{ $totalUsers ?? count($users) }}</strong> pengguna</span>

        <div class="flex items-center gap-1.5">
            {{-- Previous Button --}}
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200/80 bg-white hover:bg-slate-50 text-slate-400 transition-colors text-xs font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Sebelumnya</span>
            </button>

            {{-- Page Numbers --}}
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 rounded-lg bg-teal-800 text-white font-bold text-xs flex items-center justify-center shadow-xs">1</button>
            </div>

            {{-- Next Button --}}
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200/80 bg-white hover:bg-slate-100 text-slate-700 transition-colors text-xs font-medium">
                <span class="hidden sm:inline">Selanjutnya</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

</div>
