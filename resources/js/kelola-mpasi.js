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

// MODAL HANDLERS
function openRecipeModal(mode = 'create', id = null) {
    const modal = document.getElementById('recipeModal');
    const title = document.getElementById('recipeModalTitle');
    const submitBtnText = document.getElementById('submitBtnText');
    const form = document.getElementById('recipeForm');
    const formMethod = document.getElementById('formMethod');
    const recipesData = window.recipesData || {};
    const storeUrl = window.mpasiStoreUrl || '/mpasi';

    // Bersihkan error messages dan alert jika ada
    document.querySelectorAll('.modal-error-message').forEach(el => el.remove());
    document.querySelectorAll('.modal-error-input').forEach(el => {
        el.classList.remove('border-rose-500', 'ring-2', 'ring-rose-500/20');
        el.classList.add('border-stone-200');
    });
    const errorAlert = document.getElementById('modalErrorAlert');
    if (errorAlert) errorAlert.remove();

    if (mode === 'create') {
        if (title) title.innerText = 'Tambah Resep MPASI Baru';
        if (submitBtnText) submitBtnText.innerText = 'Simpan Resep';
        if (form) {
            form.action = storeUrl;
            form.reset();
        }
        if (formMethod) formMethod.value = 'POST';
        const editIdInput = document.getElementById('editRecipeId');
        if (editIdInput) editIdInput.value = '';

        // Reset ingredient & step list
        const ingList = document.getElementById('ingredientsList');
        if (ingList) {
            ingList.innerHTML = `
                <div class="space-y-1">
                    <div class="flex items-center gap-2 ingredient-row">
                        <input type="text" name="bahan[]" required placeholder="Contoh: 30 gr Beras Merah Organik" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                    </div>
                </div>
            `;
        }

        const stepsList = document.getElementById('stepsList');
        if (stepsList) {
            stepsList.innerHTML = `
                <div class="space-y-1">
                    <div class="flex items-start gap-2 step-row">
                        <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">1</span>
                        <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah 1..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20"></textarea>
                        <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                    </div>
                </div>
            `;
        }
    } else if (mode === 'edit' && id && recipesData[id]) {
        const recipe = recipesData[id];
        if (title) title.innerText = 'Edit Resep MPASI';
        if (submitBtnText) submitBtnText.innerText = 'Simpan Perubahan';
        const recipeId = recipe.id_resep || recipe.id || id;
        if (form) form.action = `/mpasi/${recipeId}`;
        const methodInput = document.getElementById('formMethod');
        if (methodInput) {
            methodInput.value = 'PUT';
        }
        const editIdInput = document.getElementById('editRecipeId');
        if (editIdInput) editIdInput.value = recipeId;

        const setVal = (elemId, val) => {
            const el = document.getElementById(elemId);
            if (el) el.value = (val !== null && val !== undefined) ? val : '';
        };

        setVal('formNamaResep', recipe.nama_resep);
        setVal('formKategoriUsia', recipe.kategori_usia || '6-8');
        setVal('formWaktu', recipe.waktu_memasak);
        setVal('formPorsi', recipe.porsi);
        setVal('formKalori', recipe.kalori);
        setVal('formKarbohidrat', recipe.karbohidrat);
        setVal('formLemak', recipe.lemak);
        setVal('formProtein', recipe.protein);
        setVal('formZatBesi', recipe.zat_besi);
        setVal('formSeng', recipe.seng);

        const formFoto = document.getElementById('formFoto');
        if (formFoto) {
            if (recipe.gambar && (recipe.gambar.startsWith('http://') || recipe.gambar.startsWith('https://'))) {
                formFoto.value = recipe.gambar;
            } else {
                formFoto.value = '';
            }
        }

        // Bahan
        const ingList = document.getElementById('ingredientsList');
        if (ingList) {
            let bahanArr = Array.isArray(recipe.bahan) ? recipe.bahan : [];
            if (typeof recipe.bahan === 'string') {
                try { bahanArr = JSON.parse(recipe.bahan); } catch(e) { bahanArr = [recipe.bahan]; }
            }
            if (bahanArr.length === 0) bahanArr = [''];

            ingList.innerHTML = bahanArr.map(b => `
                <div class="space-y-1">
                    <div class="flex items-center gap-2 ingredient-row">
                        <input type="text" name="bahan[]" required value="${b}" placeholder="Nama bahan & takaran" class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">
                        <button type="button" onclick="removeIngredientRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                    </div>
                </div>
            `).join('');
        }

        // Langkah langkah
        const stepsList = document.getElementById('stepsList');
        if (stepsList) {
            let langkahArr = Array.isArray(recipe.cara_pembuatan) ? recipe.cara_pembuatan : [];
            if (typeof recipe.cara_pembuatan === 'string') {
                try { langkahArr = JSON.parse(recipe.cara_pembuatan); } catch(e) { langkahArr = [recipe.cara_pembuatan]; }
            }
            if (langkahArr.length === 0) langkahArr = [''];

            stepsList.innerHTML = langkahArr.map((s, idx) => `
                <div class="space-y-1">
                    <div class="flex items-start gap-2 step-row">
                        <span class="w-5 h-5 rounded-full bg-stone-100 text-stone-600 font-bold text-[10px] flex items-center justify-center shrink-0 mt-1 step-num">${idx + 1}</span>
                        <textarea name="cara_pembuatan[]" required rows="2" placeholder="Tuliskan petunjuk memasak langkah ini..." class="flex-1 px-3 py-1.5 bg-stone-50 border border-stone-200 rounded-xl text-stone-800 text-xs focus:outline-none focus:ring-2 focus:ring-rose-700/20">${s}</textarea>
                        <button type="button" onclick="removeStepRow(this)" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg cursor-pointer mt-1"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                    </div>
                </div>
            `).join('');
        }
    }

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    if (window.lucide) lucide.createIcons();
}

function closeRecipeModal() {
    const modal = document.getElementById('recipeModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

function previewRecipe(id) {
    const recipesData = window.recipesData || {};
    const recipe = recipesData[id];
    if (recipe) {
        // Image
        const img = document.getElementById('prevImage');
        if (img) {
            let imageUrl = recipe.gambar;
            if (!imageUrl) {
                img.removeAttribute('src');
            } else if (!imageUrl.startsWith('http://') && !imageUrl.startsWith('https://')) {
                imageUrl = '/' + imageUrl.replace(/^\//, '');
            }
            img.src = imageUrl;
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

// Close on background backdrop click
document.addEventListener('DOMContentLoaded', () => {
    const recipeModal = document.getElementById('recipeModal');
    const recipeModalContainer = document.getElementById('recipeModalContainer');
    if (recipeModal && recipeModalContainer) {
        recipeModal.addEventListener('click', (e) => {
            if (!recipeModalContainer.contains(e.target)) closeRecipeModal();
        });
    }

    const previewModal = document.getElementById('previewModal');
    const previewModalContainer = document.getElementById('previewModalContainer');
    if (previewModal && previewModalContainer) {
        previewModal.addEventListener('click', (e) => {
            if (!previewModalContainer.contains(e.target)) closePreviewModal();
        });
    }

    // Pastikan action form dan _method sinkron saat submit
    const recipeForm = document.getElementById('recipeForm');
    if (recipeForm) {
        recipeForm.addEventListener('submit', function () {
            const methodInput = document.getElementById('formMethod');
            const editIdInput = document.getElementById('editRecipeId');
            if (methodInput && methodInput.value === 'PUT') {
                const editId = editIdInput ? editIdInput.value : '';
                if (editId) {
                    recipeForm.action = `/mpasi/${editId}`;
                } else {
                    methodInput.value = 'POST';
                    recipeForm.action = window.mpasiStoreUrl || '/mpasi';
                }
            } else {
                if (methodInput) methodInput.value = 'POST';
                recipeForm.action = window.mpasiStoreUrl || '/mpasi';
            }
        });
    }
});

// Expose functions to inline handlers (Vite bundles this file as a module)
Object.assign(window, {
    filterCategory,
    searchRecipes,
    applyAllFilters,
    openRecipeModal,
    closeRecipeModal,
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
