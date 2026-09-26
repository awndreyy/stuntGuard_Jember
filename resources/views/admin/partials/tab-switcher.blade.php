{{-- resources/views/admin/partials/tab-switcher.blade.php --}}
{{-- Tab Switcher: Data Pengguna | Data Anak/Balita --}}
<div class="flex gap-0 border-b border-stone-200 shrink-0" role="tablist">
    <button
        id="tab-btn-user"
        role="tab"
        aria-selected="true"
        onclick="switchTab('user')"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-rose-700 border-b-2 border-rose-700 -mb-px transition-colors cursor-pointer"
    >
        <i data-lucide="users" class="w-3.5 h-3.5"></i>
        Data Pengguna
    </button>
    <button
        id="tab-btn-anak"
        role="tab"
        aria-selected="false"
        onclick="switchTab('anak')"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-xs font-medium text-stone-500 border-b-2 border-transparent -mb-px hover:text-stone-700 transition-colors cursor-pointer"
    >
        <i data-lucide="baby" class="w-3.5 h-3.5"></i>
        Data Anak/Balita
    </button>
</div>
