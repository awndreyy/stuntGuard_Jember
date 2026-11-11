// Filter MPASI: query tetap dijalankan Laravel untuk seluruh database,
// tetapi hasil tabel diperbarui tanpa reload halaman.
let mpasiRequest = null;
let mpasiSearchTimer = null;

async function loadMpasiPage(url, addHistory = true) {
    const target = new URL(url, window.location.href);
    if (target.origin !== window.location.origin) return;

    if (mpasiRequest) mpasiRequest.abort();
    const controller = new AbortController();
    mpasiRequest = controller;
    const container = document.getElementById('recipesContainer');
    if (container) container.setAttribute('aria-busy', 'true');

    try {
        const response = await fetch(target.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
            credentials: 'same-origin',
            signal: controller.signal,
        });
        if (!response.ok) throw new Error('HTTP ' + response.status);
        const doc = new DOMParser().parseFromString(await response.text(), 'text/html');
        const nextTable = doc.getElementById('recipesContainer');
        const nextToolbar = doc.getElementById('mpasiFilterToolbar');
        const currentTable = document.getElementById('recipesContainer');
        const currentToolbar = document.getElementById('mpasiFilterToolbar');
        if (!nextTable || !nextToolbar || !currentTable || !currentToolbar) {
            throw new Error('Markup tabel MPASI tidak ditemukan');
        }

        currentTable.replaceWith(nextTable);
        currentToolbar.replaceWith(nextToolbar);
        const json = nextTable.querySelector('#mpasi-recipes-json');
        if (json) window.recipesData = JSON.parse(json.textContent);
        if (addHistory) window.history.pushState({ mpasi: true }, '', target.toString());
        if (window.lucide) window.lucide.createIcons();
    } catch (error) {
        if (error.name === 'AbortError') return;
        console.error('Filter MPASI gagal:', error);
        // Fallback: tetap bisa menggunakan server-side filter bila AJAX gagal.
        window.location.assign(target.toString());
    } finally {
        if (mpasiRequest === controller) {
            mpasiRequest = null;
            document.getElementById('recipesContainer')?.removeAttribute('aria-busy');
        }
    }
}

function filterCategory(category) {
    const url = new URL(window.location.href);
    if (category === 'all') url.searchParams.delete('kategori_usia');
    else url.searchParams.set('kategori_usia', category);
    url.searchParams.delete('page');
    loadMpasiPage(url);
}

function searchRecipes() {
    clearTimeout(mpasiSearchTimer);
    mpasiSearchTimer = setTimeout(() => {
        const url = new URL(window.location.href);
        const query = document.getElementById('recipeSearchInput')?.value.trim() || '';
        if (query) url.searchParams.set('q', query);
        else url.searchParams.delete('q');
        url.searchParams.delete('page');
        loadMpasiPage(url);
    }, 450);
}

function applyAllFilters() { searchRecipes(); }

function previewRecipe(id) {
    const recipesData = window.recipesData || {};
    const recipe = recipesData[id];
    if (recipe) {
        // Preview gambar lokal
        const img = document.getElementById('prevImage');

        if (img) {
            const imagePath = recipe.gambar;

            if (imagePath) {
                img.src = '/' + imagePath.replace(/^\/+/, '');
                img.classList.remove('hidden');
            } else {
                img.removeAttribute('src');
                img.classList.add('hidden');
            }
        }

        // Badges & Title
        const badgeAge = document.getElementById('prevBadgeAge');
        let ageLabel = recipe.kategori_usia + ' Bulan';
        let badgeColor = 'bg-blue-600';
        if (recipe.kategori_usia === '6-8') { ageLabel = '6 - 8 Bulan'; badgeColor = 'bg-blue-600'; }
        else if (recipe.kategori_usia === '9-11') { ageLabel = '9 - 11 Bulan'; badgeColor = 'bg-amber-600'; }
        else if (recipe.kategori_usia === '12-23') { ageLabel = '12 - 23 Bulan'; badgeColor = 'bg-emerald-600'; }

        if (badgeAge) {
            badgeAge.innerText = ageLabel;
            badgeAge.className = `${badgeColor} text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs`;
        }

        const prevTitle = document.getElementById('prevTitle');
        if (prevTitle) prevTitle.innerText = recipe.nama_resep;

        const prevWaktu = document.getElementById('prevWaktu');
        if (prevWaktu) prevWaktu.innerText = `${recipe.waktu_memasak} Menit`;

        const prevPorsi = document.getElementById('prevPorsi');
        if (prevPorsi) prevPorsi.innerText = `${recipe.porsi} Porsi`;

        // Nutrisi
        const prevKalori = document.getElementById('prevKalori');
        if (prevKalori) prevKalori.innerText = `${recipe.kalori} kkal`;

        const prevKarbohidrat = document.getElementById('prevKarbohidrat');
        if (prevKarbohidrat) prevKarbohidrat.innerText = `${recipe.karbohidrat} gr`;

        const prevLemak = document.getElementById('prevLemak');
        if (prevLemak) prevLemak.innerText = `${recipe.lemak} gr`;

        const prevProtein = document.getElementById('prevProtein');
        if (prevProtein) prevProtein.innerText = `${recipe.protein} gr`;

        const prevZatBesi = document.getElementById('prevZatBesi');
        if (prevZatBesi) prevZatBesi.innerText = `${recipe.zat_besi} mg`;

        const prevSeng = document.getElementById('prevSeng');
        if (prevSeng) prevSeng.innerText = `${recipe.seng} mg`;

        
        // Bahan - render aman tanpa innerHTML
        const ingList = document.getElementById('prevIngredientsList');

        if (ingList) {
            let bahanArr = Array.isArray(recipe.bahan)
                ? recipe.bahan
                : [];

            if (typeof recipe.bahan === 'string') {
                try {
                    bahanArr = JSON.parse(recipe.bahan);
                } catch (e) {
                    bahanArr = [recipe.bahan];
                }
            }

            ingList.replaceChildren();

            if (!Array.isArray(bahanArr)) {
                bahanArr = [bahanArr];
            }

            bahanArr.forEach(bahan => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-2 text-stone-700';

                const bullet = document.createElement('span');
                bullet.className =
                    'w-1.5 h-1.5 rounded-full bg-pink-500 shrink-0';

                const text = document.createElement('span');
                text.textContent = String(bahan ?? '');

                li.append(bullet, text);
                ingList.appendChild(li);
            });
        }

        
        // Langkah pembuatan - render aman
        const stepsList = document.getElementById('prevStepsList');

        if (stepsList) {
            let langkahArr = Array.isArray(recipe.cara_pembuatan)
                ? recipe.cara_pembuatan
                : [];

            if (typeof recipe.cara_pembuatan === 'string') {
                try {
                    langkahArr = JSON.parse(recipe.cara_pembuatan);
                } catch (e) {
                    langkahArr = [recipe.cara_pembuatan];
                }
            }

            stepsList.replaceChildren();

            if (!Array.isArray(langkahArr)) {
                langkahArr = [langkahArr];
            }

            langkahArr.forEach((langkah, index) => {
                const li = document.createElement('li');
                li.className =
                    'flex items-start gap-2.5 bg-stone-50/50 p-2.5 rounded-xl border border-stone-100';

                const number = document.createElement('span');
                number.className =
                    'w-5 h-5 rounded-full bg-pink-100 text-pink-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5';
                number.textContent = String(index + 1);

                const text = document.createElement('span');
                text.className = 'leading-relaxed';
                text.textContent = String(langkah ?? '');

                li.append(number, text);
                stepsList.appendChild(li);
            });
        }

    }

    const modal = document.getElementById('previewModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    if (window.lucide) lucide.createIcons();
}

function closePreviewModal() {
    const modal = document.getElementById('previewModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

function deleteRecipe(id, name) {
    const form = document.getElementById('globalDeleteForm');
    if (!form) return;

    form.action = `/mpasi/${encodeURIComponent(id)}`;
    form.dataset.confirmName = name;
    form.requestSubmit();
}

function addIngredientRow() {
    const list = document.getElementById('ingredientsList');
    if (!list) return;
    const row = document.createElement('div');
    row.className = 'space-y-1';
    row.innerHTML = `
        <div class="flex items-center gap-2 ingredient-row">
            <input type="text" name="bahan[]" required placeholder="Contoh: 30 gr Beras Merah Organik" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-pink-700/20">
            <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-pink-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
        </div>
    `;
    list.appendChild(row);
    if (window.lucide) lucide.createIcons();
}

function removeIngredientRow(btn) {
    const list = document.getElementById('ingredientsList');
    if (!list) return;
    const rowWrapper = btn.closest('.ingredient-row').parentElement;
    if (list.children.length > 1) {
        if (rowWrapper && rowWrapper.parentElement === list) {
            rowWrapper.remove();
        } else {
            btn.closest('.ingredient-row').remove();
        }
    } else {
        alert('Minimal harus ada 1 bahan.');
    }
}

function addStepRow() {
    const list = document.getElementById('stepsList');
    if (!list) return;
    const stepNum = list.querySelectorAll('.step-row').length + 1;
    const row = document.createElement('div');
    row.className = 'space-y-1';
    row.innerHTML = `
        <div class="flex items-start gap-2 step-row">
            <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">${stepNum}</span>
            <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah ini..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-pink-700/20"></textarea>
            <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-pink-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
        </div>
    `;
    list.appendChild(row);
    updateStepNumbers();
    if (window.lucide) lucide.createIcons();
}

function removeStepRow(btn) {
    const list = document.getElementById('stepsList');
    if (!list) return;
    const rowWrapper = btn.closest('.step-row').parentElement;
    if (list.querySelectorAll('.step-row').length > 1) {
        if (rowWrapper && rowWrapper.parentElement === list) {
            rowWrapper.remove();
        } else {
            btn.closest('.step-row').remove();
        }
        updateStepNumbers();
    } else {
        alert('Minimal harus ada 1 langkah pembuatan.');
    }
}

function updateStepNumbers() {
    document.querySelectorAll('.step-num').forEach((el, index) => {
        el.innerText = index + 1;
    });
}

// Modal preview tetap dipakai pada halaman daftar.
document.addEventListener('DOMContentLoaded', () => {
    const previewModal = document.getElementById('previewModal');
    const previewModalContainer = document.getElementById('previewModalContainer');
    if (previewModal && previewModalContainer) {
        previewModal.addEventListener('click', (event) => {
            if (!previewModalContainer.contains(event.target)) closePreviewModal();
        });
    }
});

// Event delegation: tetap aktif setelah toolbar/tabel diganti melalui AJAX.
document.addEventListener('click', event => {
    const anchor = event.target.closest('#mpasiFilterToolbar .category-tab, #mpasiFilterToolbar a[href], #recipesContainer nav a[href]');
    if (!anchor || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) return;
    if (!anchor.href || new URL(anchor.href).origin !== window.location.origin) return;
    event.preventDefault();
    clearTimeout(mpasiSearchTimer);
    loadMpasiPage(anchor.href);
});

document.addEventListener('input', event => {
    if (event.target.id === 'recipeSearchInput') searchRecipes();
});

document.addEventListener('submit', event => {
    if (event.target.id !== 'mpasiSearchForm') return;
    event.preventDefault();
    clearTimeout(mpasiSearchTimer);
    const url = new URL(event.target.action);
    const data = new FormData(event.target);
    const q = String(data.get('q') || '').trim();
    const age = data.get('kategori_usia');
    if (q) url.searchParams.set('q', q);
    if (age) url.searchParams.set('kategori_usia', String(age));
    loadMpasiPage(url);
});

window.addEventListener('popstate', () => loadMpasiPage(window.location.href, false));

// Expose functions to inline handlers (Vite bundles this file as a module)
Object.assign(window, {
    filterCategory,
    searchRecipes,
    applyAllFilters,
    previewRecipe,
    closePreviewModal,
    deleteRecipe,
    addIngredientRow,
    removeIngredientRow,
    addStepRow,
    removeStepRow,
    updateStepNumbers,
    showToast,
});
