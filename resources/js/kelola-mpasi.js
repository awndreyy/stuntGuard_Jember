// Filter Category Tabs
function filterCategory(category, button) {
    document.querySelectorAll('.category-tab').forEach(btn => {
        btn.classList.remove('active-tab', 'bg-rose-700', 'text-white');
        btn.classList.add('text-stone-600', 'hover:bg-stone-100');
    });
    button.classList.add('active-tab', 'bg-rose-700', 'text-white');
    button.classList.remove('text-stone-600', 'hover:bg-stone-100');

    applyAllFilters();
}

// Search Recipe by Keyword
function searchRecipes() {
    applyAllFilters();
}

function applyAllFilters() {
    const activeTab = document.querySelector('.category-tab.active-tab');
    let selectedCategory = 'all';
    if (activeTab) {
        const text = activeTab.innerText.toLowerCase();
        if (text.includes('6-8')) selectedCategory = '6-8';
        else if (text.includes('9-11')) selectedCategory = '9-11';
        else if (text.includes('12-23')) selectedCategory = '12-23';
    }

    const searchInput = document.getElementById('recipeSearchInput');
    const searchQuery = searchInput ? searchInput.value.toLowerCase().trim() : '';
    const tableRows = document.querySelectorAll('.table-recipe-row');
    let visibleCount = 0;

    // Filter table rows
    tableRows.forEach(row => {
        const rowCat = row.getAttribute('data-category');
        const rowName = (row.getAttribute('data-name') || '').toLowerCase();

        const matchesCat = (selectedCategory === 'all' || rowCat === selectedCategory);
        const matchesSearch = (!searchQuery || rowName.includes(searchQuery));

        if (matchesCat && matchesSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Empty state
    const emptyState = document.getElementById('emptySearchState');
    const tableWrapper = document.getElementById('tableViewWrapper');
    if (tableRows.length > 0) {
        if (visibleCount === 0) {
            if (emptyState) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            }
            if (tableWrapper) tableWrapper.classList.add('hidden');
        } else {
            if (emptyState) {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            }
            if (tableWrapper) tableWrapper.classList.remove('hidden');
        }
    }
}

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

        // Bahan
        const ingList = document.getElementById('prevIngredientsList');
        if (ingList) {
            let bahanArr = Array.isArray(recipe.bahan) ? recipe.bahan : [];
            if (typeof recipe.bahan === 'string') {
                try { bahanArr = JSON.parse(recipe.bahan); } catch(e) { bahanArr = [recipe.bahan]; }
            }

            ingList.innerHTML = bahanArr.map(b => `
                <li class="flex items-center gap-2 text-stone-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                    <span>${b}</span>
                </li>
            `).join('');
        }

        // Langkah
        const stepsList = document.getElementById('prevStepsList');
        if (stepsList) {
            let langkahArr = Array.isArray(recipe.cara_pembuatan) ? recipe.cara_pembuatan : [];
            if (typeof recipe.cara_pembuatan === 'string') {
                try { langkahArr = JSON.parse(recipe.cara_pembuatan); } catch(e) { langkahArr = [recipe.cara_pembuatan]; }
            }

            stepsList.innerHTML = langkahArr.map((s, idx) => `
                <li class="flex items-start gap-2.5 bg-stone-50/50 p-2.5 rounded-xl border border-stone-100">
                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">${idx + 1}</span>
                    <span class="leading-relaxed">${s}</span>
                </li>
            `).join('');
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
    if (confirm(`Apakah Anda yakin ingin menghapus resep "${name}"?`)) {
        const form = document.getElementById('globalDeleteForm');
        if (form) {
            form.action = `/mpasi/${id}`;
            form.submit();
        }
    }
}

function addIngredientRow() {
    const list = document.getElementById('ingredientsList');
    if (!list) return;
    const row = document.createElement('div');
    row.className = 'space-y-1';
    row.innerHTML = `
        <div class="flex items-center gap-2 ingredient-row">
            <input type="text" name="bahan[]" required placeholder="Contoh: 30 gr Beras Merah Organik" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
            <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
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
            <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah ini..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20"></textarea>
            <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
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

function showToast(title, message, type = 'success') {
    const toast = document.getElementById('toastNotification');
    const iconContainer = document.getElementById('toastIcon');
    const toastTitle = document.getElementById('toastTitle');
    const toastMessage = document.getElementById('toastMessage');

    if (toastTitle) toastTitle.innerText = title;
    if (toastMessage) toastMessage.innerText = message;

    if (iconContainer) {
        if (type === 'error') {
            iconContainer.className = 'w-6 h-6 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center';
            iconContainer.innerHTML = '<i data-lucide="alert-circle" class="w-4 h-4"></i>';
        } else {
            iconContainer.className = 'w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center';
            iconContainer.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i>';
        }
    }

    if (toast) {
        toast.classList.remove('hidden');
        toast.classList.add('flex');
    }
    if (window.lucide) lucide.createIcons();

    setTimeout(() => {
        if (toast) {
            toast.classList.add('hidden');
            toast.classList.remove('flex');
        }
    }, 4000);
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
