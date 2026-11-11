{{-- resources/views/admin/partials/table-users.blade.php --}}
{{-- Tabel Data Pengguna --}}
<div id="tab-user" class="flex flex-col gap-3">
    <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white">

    {{-- Card Header with Filters --}}
    <div class="px-4 py-3 border-b border-stone-100 flex flex-wrap items-center justify-between gap-3 shrink-0 bg-white">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-pink-100/70 text-pink-700 flex items-center justify-center">
                <i data-lucide="users" class="w-4 h-4"></i>
            </div>
            <div>
                <h2 class="text-sm font-bold text-stone-900">Daftar Pengguna</h2>
            </div>
        </div>

        <div class="flex items-center gap-2">
            {{-- Filter Tabs --}}
            <div class="hidden sm:flex items-center bg-stone-100/80 p-0.5 rounded-lg text-[11px] font-medium text-stone-600">
                <button type="button" onclick="filterUserRole('all', this)" class="user-role-tab px-2.5 py-1 rounded-md cursor-pointer transition-colors {{ request('role', 'all') === 'all' ? 'bg-white text-pink-700 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">Semua</button>
                <button type="button" onclick="filterUserRole('Admin', this)" class="user-role-tab px-2.5 py-1 rounded-md cursor-pointer transition-colors {{ request('role', 'all') === 'Admin' ? 'bg-white text-pink-700 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">Admin</button>
                <button type="button" onclick="filterUserRole('Orang Tua', this)" class="user-role-tab px-2.5 py-1 rounded-md cursor-pointer transition-colors {{ request('role', 'all') === 'Orang Tua' ? 'bg-white text-pink-700 shadow-2xs font-semibold' : 'text-stone-600 hover:text-stone-900' }}">Orang Tua</button>
            </div>
        </div>
    </div>

    {{-- Data Table Container (Scrollable Area) --}}
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[560px]">
            <thead class="bg-stone-50 backdrop-blur-xs border-b border-stone-100 text-[10px] font-bold text-stone-500 uppercase tracking-wider z-10">
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
                    <tr class="table-user-row hover:bg-pink-50/40 transition-colors group" data-role="{{ $user->role }}">
                        <td class="py-3 px-4 font-medium text-stone-900 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                {{-- Avatar inisial nama --}}
                                <div class="w-8 h-8 rounded-full bg-pink-100 text-pink-700 font-bold text-xs flex items-center justify-center shrink-0">
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
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $user->role === 'Administrator' || $user->role === 'Admin' ? 'bg-pink-100/70 text-pink-900' : 'bg-emerald-100 text-emerald-800' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center justify-center gap-1.5">
                                @if($user->role === 'Orang Tua')
                                    <a href="{{ route('detailBalita', $user) }}" class="p-1.5 text-stone-400 hover:text-pink-700 hover:bg-pink-50 rounded transition-colors" title="Lihat balita milik {{ $user->name }}" aria-label="Lihat balita milik {{ $user->name }}">
                                        <i data-lucide="baby" class="w-4 h-4"></i>
                                    </a>
                                @else
                                    <span class="p-1.5 text-stone-300 cursor-not-allowed" title="Akun Admin tidak memiliki daftar balita" aria-label="Tidak tersedia">
                                        <i data-lucide="baby" class="w-4 h-4"></i>
                                    </span>
                                @endif
                                <button type="button" onclick="editData(@js($user))" class="p-1.5 text-stone-400 hover:text-pink-700 hover:bg-pink-50 rounded transition-colors cursor-pointer" title="Edit User">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" data-confirm="delete" data-confirm-name="{{ $user->name }}" data-confirm-kind="akun">
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
    </div>

    @include('admin.partials.pagination', ['paginator' => $users, 'label' => 'pengguna'])
</div>
