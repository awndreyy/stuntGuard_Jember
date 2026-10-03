{{-- resources/views/admin/partials/table-mpasi.blade.php --}}
{{-- RECIPES TABLE CONTAINER --}}
<div id="recipesContainer" class="flex-1 min-h-0 flex flex-col">
    <div id="tableViewWrapper" class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden flex flex-col flex-1">
        <div class="overflow-x-auto min-w-full flex-1">
            <table class="w-full text-left border-collapse">
                <thead class="bg-stone-50 border-b border-stone-200 text-[11px] font-bold text-stone-500 uppercase tracking-wider sticky top-0 z-10">
                    <tr>
                        <th class="py-3 px-4">Nama Resep MPASI</th>
                        <th class="py-3 px-3">Kategori Usia</th>
                        <th class="py-3 px-3">Tekstur</th>
                        <th class="py-3 px-3">Energi & Protein</th>
                        <th class="py-3 px-3">Waktu / Porsi</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs text-stone-700" id="tableBody">
                    @forelse($mpasis as $recipe)
                        @php
                            $kategoriLabel = match($recipe->kategori_usia) {
                                '6-8' => '6 - 8 Bulan',
                                '9-11' => '9 - 11 Bulan',
                                '12-23' => '12 - 23 Bulan',
                                default => $recipe->kategori_usia . ' Bulan'
                            };
                            $tekstur = match($recipe->kategori_usia) {
                                '6-8' => 'Lumat Saring',
                                '9-11' => 'Cincang Kasar',
                                '12-23' => 'Menu Keluarga',
                                default => '-'
                            };
                            $badgeClass = match($recipe->kategori_usia) {
                                '6-8' => 'bg-blue-50 text-blue-700 border-blue-200',
                                '9-11' => 'bg-amber-50 text-amber-700 border-amber-200',
                                '12-23' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                default => 'bg-stone-50 text-stone-700 border-stone-200'
                            };
                            $imageUrl = $recipe->gambar ? (str_starts_with($recipe->gambar, 'http') ? $recipe->gambar : asset($recipe->gambar)) : null;
                        @endphp
                        <tr class="table-recipe-row hover:bg-rose-50/30 transition-colors" data-category="{{ $recipe->kategori_usia }}" data-name="{{ strtolower($recipe->nama_resep) }}">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    @if ($imageUrl)
                                        <img src="{{ $imageUrl }}" class="w-10 h-10 rounded-xl object-cover border border-stone-200 shrink-0" alt="{{ $recipe->nama_resep }}">
                                    @endif
                                    <div>
                                        <span class="font-bold text-stone-900 block">{{ $recipe->nama_resep }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeClass }}">
                                    {{ $kategoriLabel }}
                                </span>
                            </td>   
                            <td class="py-3 px-3 font-medium text-stone-600">{{ $tekstur }}</td>
                            <td class="py-3 px-3">
                                <span class="font-bold text-rose-700">{{ $recipe->kalori }} kkal</span>
                                <span class="text-stone-400 text-[10px] block">Protein {{ $recipe->protein }}g</span>
                            </td>
                            <td class="py-3 px-3 text-stone-500 text-[11px]">
                                <span>{{ $recipe->waktu_memasak }} mnt / {{ $recipe->porsi }} porsi</span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <div class="inline-flex items-center gap-1">
                                    <button onclick="previewRecipe({{ $recipe->id_resep }})" class="p-1.5 text-stone-400 hover:text-stone-700 hover:bg-stone-100 rounded-lg transition-colors cursor-pointer" title="Preview"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                    <button onclick="openRecipeModal('edit', {{ $recipe->id_resep }})" class="p-1.5 text-stone-400 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                    <button onclick="deleteRecipe({{ $recipe->id_resep }}, '{{ addslashes($recipe->nama_resep) }}')" class="p-1.5 text-stone-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400 text-xs">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-400 flex items-center justify-center mb-3">
                                        <i data-lucide="utensils" class="w-6 h-6"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-stone-800">Belum ada resep MPASI</h4>
                                    <p class="text-xs text-stone-500 mt-1 max-w-sm">Klik tombol "Tambah Resep Baru" di atas untuk menambahkan resep MPASI pertama.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Empty State Search Placeholder -->
    <div id="emptySearchState" class="hidden bg-white rounded-2xl border border-stone-200 p-8 text-center flex-col items-center justify-center my-auto">
        <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-400 flex items-center justify-center mb-3">
            <i data-lucide="utensils" class="w-6 h-6"></i>
        </div>
        <h4 class="text-sm font-bold text-stone-800">Tidak ada resep yang cocok</h4>
        <p class="text-xs text-stone-500 mt-1 max-w-sm">Coba kata kunci lain atau ubah filter kategori usia di atas.</p>
    </div>
</div>