@extends('layouts.guest')

@section('title', 'Resep MPASI - StuntGuard Jember')

@section('content')
    <div class="mx-auto max-w-[1200px] px-4 pb-16 pt-7 sm:px-6 md:px-8 md:pb-20 md:pt-10 lg:px-12">
        
        {{-- Tombol kembali ke beranda --}}
        <a href="{{ route('home') }}"
        class="inline-flex items-center gap-2 rounded-xl border border-pink-200 bg-white px-4 py-2.5 text-sm font-semibold text-pink-700 transition-colors hover:border-pink-300 hover:bg-pink-50">

            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                arrow_back
            </span>

            Kembali ke Beranda
        </a>


        @if ($resep->isEmpty())
            <div class="mt-8 rounded-2xl border border-stone-200 bg-white px-5 py-16 text-center">
                <span class="mx-auto flex size-16 items-center justify-center rounded-2xl bg-pink-50 text-pink-600">
                    <span class="material-symbols-outlined text-4xl" aria-hidden="true">restaurant</span>
                </span>
                <h2 class="mt-5 text-lg font-bold text-stone-900">Belum ada resep MPASI yang tersedia</h2>
                <p class="mx-auto mt-2 max-w-md text-sm text-stone-600">
                    Resep akan ditampilkan di halaman ini setelah ditambahkan oleh admin.
                </p>
                <a href="{{ route('home') }}#resep-mpasi" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-pink-700 hover:text-pink-800">
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_back</span>
                    Kembali ke Beranda
                </a>
            </div>
        @else
            {{-- Filter hanya bekerja pada kartu halaman yang sedang dibuka; query Laravel dan pagination tetap. --}}
            <section aria-label="Cari dan filter resep" class="mt-8 rounded-2xl border border-stone-200 bg-white p-4 sm:p-6">
                <div class="mb-4 flex items-center gap-2">
                    <span class="flex size-9 items-center justify-center rounded-lg bg-pink-50 text-pink-700">
                        <span class="material-symbols-outlined text-xl" aria-hidden="true">tune</span>
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-stone-900">Temukan Resep</h2>
                        <p class="text-xs text-stone-600">Cari berdasarkan nama atau bahan, lalu pilih usia anak.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-12 md:items-end">
                    <div class="md:col-span-6">
                        <label for="recipeSearch" class="mb-1.5 block text-xs font-bold text-stone-700">Cari resep atau bahan</label>
                        <div class="relative">
                            <span class="material-symbols-outlined pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-[21px] text-stone-500" aria-hidden="true">search</span>
                            <input id="recipeSearch" type="search" autocomplete="off"
                                placeholder="Contoh: bubur ayam, wortel..."
                                class="h-12 w-full rounded-xl border border-stone-200 bg-white py-2 pl-11 pr-4 text-sm text-stone-800 outline-none transition-colors placeholder:text-stone-400 focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <label for="recipeAge" class="mb-1.5 block text-xs font-bold text-stone-700">Usia anak</label>
                        <select id="recipeAge" class="h-12 w-full rounded-xl border border-stone-200 bg-white px-3 text-sm text-stone-800 outline-none transition-colors focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                            <option value="all">Semua usia</option>
                            <option value="6-8">6–8 bulan</option>
                            <option value="9-11">9–11 bulan</option>
                            <option value="12-23">12–23 bulan</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <label for="recipeSort" class="mb-1.5 block text-xs font-bold text-stone-700">Urutkan</label>
                        <select id="recipeSort" class="h-12 w-full rounded-xl border border-stone-200 bg-white px-3 text-sm text-stone-800 outline-none transition-colors focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                            <option value="latest">Terbaru</option>
                            <option value="name">Nama A–Z</option>
                            <option value="fastest">Waktu tercepat</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-stone-100 pt-4">
                    <p class="text-xs leading-relaxed text-stone-500">
                        @if ($resep->hasPages())
                            Pencarian, filter, dan pengurutan berlaku untuk {{ $resep->count() }} resep pada halaman ini.
                        @else
                            Pilih filter untuk mempersempit hasil resep yang ditampilkan.
                        @endif
                    </p>
                    <button id="recipeReset" type="button" class="hidden items-center gap-1.5 rounded-lg px-3 py-2 text-xs font-bold text-pink-700 hover:bg-pink-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">
                        <span class="material-symbols-outlined text-[17px]" aria-hidden="true">restart_alt</span>
                        Reset filter
                    </button>
                </div>
            </section>

            <section class="mt-9" aria-labelledby="recipeListTitle">
                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between sm:gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-pink-700">Pilihan untuk si kecil</span>
                        <h2 id="recipeListTitle" class="mt-1 text-xl font-extrabold text-stone-900 sm:text-2xl">Daftar Resep</h2>
                    </div>
                    <p id="recipeResultCount" role="status" aria-live="polite" class="text-sm text-stone-600">
                        Menampilkan {{ $resep->count() }} dari {{ $resep->total() }} resep
                    </p>
                </div>

                <div id="recipeGrid" class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                    @foreach ($resep as $item)
                        <div data-recipe-item
                             data-name="{{ $item->nama_resep }}"
                             data-search="{{ $item->nama_resep }} {{ implode(' ', $item->bahan ?? []) }}"
                             data-age="{{ $item->kategori_usia }}"
                             data-time="{{ $item->waktu_memasak }}"
                             data-order="{{ $loop->index }}"
                             class="min-w-0">
                            @include('landing.partials.recipeCard', ['resep' => $item])
                        </div>
                    @endforeach
                </div>

                <div id="recipeNoResults" class="hidden rounded-2xl border border-dashed border-stone-300 bg-white px-5 py-14 text-center">
                    <span class="mx-auto flex size-14 items-center justify-center rounded-xl bg-stone-100 text-stone-500">
                        <span class="material-symbols-outlined text-3xl" aria-hidden="true">search_off</span>
                    </span>
                    <h3 class="mt-4 text-base font-bold text-stone-900">Resep tidak ditemukan</h3>
                    <p class="mt-2 text-sm text-stone-600">Coba gunakan kata kunci atau kelompok usia lain.</p>
                    <button type="button" id="recipeResetEmpty" class="mt-4 rounded-xl border border-pink-200 bg-pink-50 px-4 py-2 text-sm font-bold text-pink-700 hover:bg-pink-100">
                        Hapus filter
                    </button>
                </div>

                {{-- Pagination bawaan Laravel tetap dipakai, tanpa mengubah controller. --}}
                @if ($resep->hasPages())
                    <nav aria-label="Navigasi halaman resep" class="mt-9 border-t border-stone-200 pt-6">
                        {{ $resep->links() }}
                    </nav>
                @endif
            </section>
        @endif
    </div>
@endsection

@if (! $resep->isEmpty())
    @push('scripts')
        <script>
            (() => {
                const grid = document.getElementById('recipeGrid');
                const search = document.getElementById('recipeSearch');
                const age = document.getElementById('recipeAge');
                const sort = document.getElementById('recipeSort');
                const resetButton = document.getElementById('recipeReset');
                const resetEmpty = document.getElementById('recipeResetEmpty');
                const emptyState = document.getElementById('recipeNoResults');
                const resultCount = document.getElementById('recipeResultCount');

                if (!grid || !search || !age || !sort || !resetButton || !emptyState || !resultCount) return;

                const cards = Array.from(grid.querySelectorAll('[data-recipe-item]'));
                const normalize = (value) => String(value || '').toLocaleLowerCase('id-ID').trim();
                const collator = new Intl.Collator('id-ID', { sensitivity: 'base' });

                const update = () => {
                    const query = normalize(search.value);
                    const selectedAge = age.value;
                    const selectedSort = sort.value;

                    const ordered = [...cards].sort((a, b) => {
                        if (selectedSort === 'name') {
                            return collator.compare(a.dataset.name, b.dataset.name) ||
                                Number(a.dataset.order) - Number(b.dataset.order);
                        }
                        if (selectedSort === 'fastest') {
                            return Number(a.dataset.time) - Number(b.dataset.time) ||
                                Number(a.dataset.order) - Number(b.dataset.order);
                        }
                        return Number(a.dataset.order) - Number(b.dataset.order);
                    });

                    let visible = 0;
                    ordered.forEach((card) => {
                        const words = normalize(card.dataset.search).split(/[\s,.;:/()\-]+/).filter(Boolean);
                        const matchesQuery = !query || query.split(/\s+/).every((term) => words.some((word) => word.startsWith(term)));
                        const matchesAge = selectedAge === 'all' || card.dataset.age === selectedAge;
                        const matches = matchesQuery && matchesAge;
                        card.classList.toggle('hidden', !matches);
                        if (matches) visible++;
                        grid.appendChild(card);
                    });

                    const hasFilter = query !== '' || selectedAge !== 'all' || selectedSort !== 'latest';
                    resetButton.classList.toggle('hidden', !hasFilter);
                    resetButton.classList.toggle('inline-flex', hasFilter);
                    emptyState.classList.toggle('hidden', visible !== 0);
                    grid.classList.toggle('hidden', visible === 0);
                    resultCount.textContent = `${visible} dari ${cards.length} resep pada halaman ini`;
                };

                const reset = () => {
                    search.value = '';
                    age.value = 'all';
                    sort.value = 'latest';
                    update();
                    search.focus();
                };

                search.addEventListener('input', update);
                age.addEventListener('change', update);
                sort.addEventListener('change', update);
                resetButton.addEventListener('click', reset);
                if (resetEmpty) resetEmpty.addEventListener('click', reset);
            })();
        </script>
    @endpush
@endif
