@props([
    'totalResep' => 0,
    'total68' => 0,
    'total911' => 0,
    'total1223' => 0,
])

<!-- Stats Metric Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 shrink-0">
    <!-- Card 1: Total Resep -->
    <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-stone-400 block uppercase tracking-wider">Total Resep</span>
            <div class="flex items-baseline gap-1.5 mt-0.5">
                <span class="text-xl font-bold text-stone-900" id="stat-total">{{ $totalResep }}</span>
                <span class="text-[10px] text-emerald-600 font-semibold flex items-center">menu aktif</span>
            </div>
        </div>
        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center shrink-0">
            <i data-lucide="utensils-crossed" class="w-5 h-5"></i>
        </div>
    </div>

    <!-- Card 2: 6-8 Bulan -->
    <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-blue-600 block uppercase tracking-wider">6 - 8 Bulan</span>
            <div class="flex items-baseline gap-1.5 mt-0.5">
                <span class="text-xl font-bold text-stone-900">{{ $total68 }}</span>
                <span class="text-[10px] text-stone-400">Tekstur Lumat Saring</span>
            </div>
        </div>
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
            <i data-lucide="baby" class="w-5 h-5"></i>
        </div>
    </div>

    <!-- Card 3: 9-11 Bulan -->
    <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-amber-600 block uppercase tracking-wider">9 - 11 Bulan</span>
            <div class="flex items-baseline gap-1.5 mt-0.5">
                <span class="text-xl font-bold text-stone-900">{{ $total911 }}</span>
                <span class="text-[10px] text-stone-400">Cincang Kasar/Lembek</span>
            </div>
        </div>
        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
            <i data-lucide="soup" class="w-5 h-5"></i>
        </div>
    </div>

    <!-- Card 4: 12-23 Bulan -->
    <div class="bg-white p-3.5 rounded-2xl border border-stone-200 shadow-2xs flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-emerald-600 block uppercase tracking-wider">12 - 23 Bulan</span>
            <div class="flex items-baseline gap-1.5 mt-0.5">
                <span class="text-xl font-bold text-stone-900">{{ $total1223 }}</span>
                <span class="text-[10px] text-stone-400">Menu Keluarga/Padat</span>
            </div>
        </div>
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <i data-lucide="sparkles" class="w-5 h-5"></i>
        </div>
    </div>
</div>
