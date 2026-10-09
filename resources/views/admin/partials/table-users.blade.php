{{-- resources/views/admin/partials/table-users.blade.php --}}
{{-- Tabel Data Pengguna --}}
<div id="tab-user" class="flex-1 flex flex-col min-h-0 h-full">

    {{-- Card Header with Filters --}}
    <div class="px-4 py-3 border-b border-stone-100 flex flex-wrap items-center justify-between gap-3 shrink-0 bg-white">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-rose-100/70 text-rose-700 flex items-center justify-center">
                <i data-lucide="users" class="w-4 h-4"></i>
            </div>
            <div>
                <h2 class="text-sm font-bold text-stone-900">Daftar Pengguna</h2>
            </div>
        </div>

        <div class="flex items-center gap-2">
            {{-- Filter Tabs --}}
            <div class="hidden sm:flex items-center bg-stone-100/80 p-0.5 rounded-lg text-[11px] font-medium text-stone-600">
                <button type="button" onclick="filterUserRole('all', this)" class="user-role-tab px-2.5 py-1 rounded-md bg-white text-rose-700 shadow-2xs font-semibold cursor-pointer transition-colors">Semua</button>
                <button type="button" onclick="filterUserRole('Admin', this)" class="user-role-tab px-2.5 py-1 rounded-md text-stone-600 hover:text-stone-900 transition-colors cursor-pointer">Admin</button>
                <button type="button" onclick="filterUserRole('Orang Tua', this)" class="user-role-tab px-2.5 py-1 rounded-md text-stone-600 hover:text-stone-900 transition-colors cursor-pointer">Orang Tua</button>
            </div>
        </div>
    </div>

    {{-- Data Table Container (Scrollable Area) --}}
    <div class="flex-1 overflow-x-auto overflow-y-auto min-h-0">
        <table class="w-full text-left border-collapse min-w-[560px]">
            <thead class="sticky top-0 bg-stone-50 backdrop-blur-xs border-b border-stone-100 text-[10px] font-bold text-stone-500 uppercase tracking-wider z-10">
                <tr>
                    <th class="py-3 px-4 whitespace-nowrap">Informasi Pengguna</th>
                    <th class="py-3 px-4 whitespace-nowrap">Kontak</th>
                    <th class="py-3 px-4 whitespace-nowrap">Role</th>
                    <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100 text-xs" id="tableUserBody">
                @if(isset($users) && count($users) > 0)
                    @foreach($users as $user)
                    <tr class="table-user-row hover:bg-rose-50/40 transition-colors group" data-role="{{ $user->role }}">
                        <td class="py-3 px-4 font-medium text-stone-900 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                {{-- Avatar inisial nama --}}
                                <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-700 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-stone-800">{{ $user->name }}</span>
                                    <span class="block text-[10px] text-stone-400">NIK: {{ $user->nik ?? '-' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="block text-xs text-stone-700">{{ $user->email }}</span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $user->role === 'Administrator' || $user->role === 'Admin' ? 'bg-rose-100/70 text-rose-900' : 'bg-emerald-100 text-emerald-800' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center justify-center gap-1.5">
                                <button type="button" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded transition-colors cursor-pointer" title="Lihat Balita">
                                    <i data-lucide="baby" class="w-4 h-4"> class="w-4 h-4"></i>
                                </button>
                                <button type="button" onclick="editData(@js($user))" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded transition-colors cursor-pointer" title="Edit User">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau menghapus akun {{ $user->name }} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-stone-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors cursor-pointer" title="Hapus User">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr id="emptyUserFilterRow" class="hidden">
                        <td colspan="4" class="py-12 text-center text-stone-400">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="users" class="w-8 h-8 text-stone-300"></i>
                                <span class="text-xs font-semibold text-stone-500">Tidak ada pengguna pada kategori ini</span>
                            </div>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="4" class="py-12 text-center text-stone-400">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="users" class="w-8 h-8 text-stone-300"></i>
                                <span class="text-xs font-semibold text-stone-500">Belum ada data pengguna</span>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Card Footer --}}
    <div class="px-4 py-2.5 bg-stone-50 border-t border-stone-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-stone-500 shrink-0 mt-auto">
        <span id="userCountDisplay" class="text-center sm:text-left">Menampilkan <strong class="font-semibold text-stone-700">{{ count($users) }}</strong> dari <strong class="font-semibold text-stone-700">{{ $totalUsers ?? count($users) }}</strong> pengguna</span>

        <div class="flex items-center gap-1.5">
            {{-- Previous Button --}}
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-400 transition-colors text-xs font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                <span class="hidden sm:inline">Sebelumnya</span>
            </button>

            {{-- Page Numbers --}}
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 rounded-lg bg-rose-700 text-white font-bold text-xs flex items-center justify-center shadow-xs">1</button>
            </div>

            {{-- Next Button --}}
            <button class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-100 text-stone-700 transition-colors text-xs font-medium">
                <span class="hidden sm:inline">Selanjutnya</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>

</div>
