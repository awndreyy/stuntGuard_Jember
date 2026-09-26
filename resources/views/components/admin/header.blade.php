@props([
    'searchPlaceholder' => 'Cari data pengguna, nama, NIK...'
])

<!-- Header (Compact 56px Widescreen Header) -->
<header class="h-14 bg-white border-b border-stone-200 sticky top-0 z-20 px-4 sm:px-6 flex items-center justify-between gap-4 shrink-0">

    <!-- Left: Mobile Toggle + Title + Search -->
    <div class="flex items-center gap-3 flex-1 max-w-2xl">
        <button onclick="toggleSidebar()" class="md:hidden p-1.5 rounded-lg text-stone-500 hover:text-rose-700 hover:bg-stone-100 focus:outline-none">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <!-- Search Input -->
        <div class="relative w-full max-w-md">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" placeholder="{{ $searchPlaceholder }}" class="w-full pl-9 pr-3 py-1.5 text-xs bg-stone-50 border border-stone-200 rounded-lg text-stone-700 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-700/20 focus:border-rose-700 focus:bg-white transition-all">
        </div>
    </div>

    <!-- Right Header Actions -->
    <div class="flex items-center gap-3 shrink-0">
        <!-- Date Badge -->
        <span class="hidden xl:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-stone-100/80 border border-stone-200/60 text-[11px] font-medium text-stone-600">
            <i data-lucide="calendar" class="w-3.5 h-3.5 text-stone-400"></i>
            <span id="current-date"></span>
        </span>

        <!-- Admin Profile -->
        <div class="flex items-center gap-2 pl-1">
            <div class="relative">
                <div class="w-8 h-8 rounded-full bg-rose-700 text-white font-semibold text-xs flex items-center justify-center ring-2 ring-rose-700/20">
                    {{ $userInitials ?? 'AD' }}
                </div>
                <span class="absolute bottom-0 right-0 w-2 h-2 bg-emerald-500 border-2 border-white rounded-full"></span>
            </div>
            <div class="hidden sm:block text-left">
                <p class="text-xs font-bold text-stone-800 leading-none">{{ $userName ?? 'Admin Dinkes' }}</p>
                <p class="text-[10px] text-stone-400 font-medium leading-none mt-0.5">{{ $userRole ?? 'Kab. Jember' }}</p>
            </div>
        </div>
    </div>
</header>
