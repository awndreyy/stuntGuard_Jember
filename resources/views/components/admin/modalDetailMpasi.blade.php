<!-- Modal Detail / Preview Resep MPASI -->
<div id="previewModal" class="fixed inset-0 bg-stone-900/50 backdrop-blur-xs z-50 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <div id="previewModalContainer" class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-2xl overflow-hidden my-auto max-h-[92vh] flex flex-col transition-all duration-200">
        
        <!-- Banner Image Preview -->
        <div class="relative h-44 sm:h-52 w-full bg-stone-100 shrink-0 overflow-hidden">
            <img id="prevImage" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd9aS7XofD1VvIU3ek94235Hwn0WNFiRoI7m5AcZJkBE4Oys41mpW6ixOZN69h5Y3REdbeq-3KfB3KEQab58vjyh-ON5nBj_azOI435sh7EB2NY-KQ2sIIyuSF8O_01QrL1nxe3bpBa2y63Klk9JSsGJ4uEhV3eFQjRhdsOn35rP1ajwn2CB5bIyWZ4i6S1yam6u4_FpVDPlqnkVsi60WFB-EfvkP5i_XqJ26Ac9f_b4k884-F8hL6" alt="Preview" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
            
            <button type="button" onclick="closePreviewModal()" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/40 hover:bg-black/60 text-white flex items-center justify-center transition-colors cursor-pointer z-10">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <div class="absolute bottom-3.5 left-4 right-4 text-white">
                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                    <span id="prevBadgeAge" class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs">
                        6 - 8 Bulan
                    </span>
                    <span class="bg-black/40 backdrop-blur-xs text-stone-200 text-[10px] font-medium px-2.5 py-0.5 rounded-full flex items-center gap-1 border border-white/10">
                        <i data-lucide="clock" class="w-3 h-3 text-rose-400"></i>
                        <span id="prevWaktu">25 Menit</span>
                    </span>
                    <span class="bg-black/40 backdrop-blur-xs text-stone-200 text-[10px] font-medium px-2.5 py-0.5 rounded-full flex items-center gap-1 border border-white/10">
                        <i data-lucide="pie-chart" class="w-3 h-3 text-amber-400"></i>
                        <span id="prevPorsi">2 Porsi</span>
                    </span>
                </div>
                <h2 id="prevTitle" class="text-base sm:text-lg font-bold drop-shadow-xs line-clamp-2">
                    Bubur Tim Salmon Beras Merah & Bayam Papuma
                </h2>
            </div>
        </div>

        <!-- Preview Body Content (Scrollable) -->
        <div class="p-5 flex-1 overflow-y-auto space-y-4 text-xs text-stone-700">
            
            <!-- 1. Nilai Nutrisi Grid -->
            <div>
                <h4 class="font-bold text-stone-900 mb-2 flex items-center gap-1.5">
                    <i data-lucide="activity" class="w-3.5 h-3.5 text-rose-700"></i> Nilai Nutrisi (Per Porsi):
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 text-center">
                    <div class="bg-rose-50/80 p-2.5 rounded-xl border border-rose-100">
                        <span class="text-[10px] text-stone-500 block font-medium">Energi</span>
                        <span id="prevKalori" class="text-xs sm:text-sm font-bold text-rose-700">185 kkal</span>
                    </div>
                    <div class="bg-orange-50/80 p-2.5 rounded-xl border border-orange-100">
                        <span class="text-[10px] text-stone-500 block font-medium">Karbohidrat</span>
                        <span id="prevKarbohidrat" class="text-xs sm:text-sm font-bold text-orange-700">25.0 gr</span>
                    </div>
                    <div class="bg-amber-50/80 p-2.5 rounded-xl border border-amber-100">
                        <span class="text-[10px] text-stone-500 block font-medium">Lemak</span>
                        <span id="prevLemak" class="text-xs sm:text-sm font-bold text-amber-700">5.2 gr</span>
                    </div>
                    <div class="bg-blue-50/80 p-2.5 rounded-xl border border-blue-100">
                        <span class="text-[10px] text-stone-500 block font-medium">Protein</span>
                        <span id="prevProtein" class="text-xs sm:text-sm font-bold text-blue-700">7.5 gr</span>
                    </div>
                    <div class="bg-emerald-50/80 p-2.5 rounded-xl border border-emerald-100">
                        <span class="text-[10px] text-stone-500 block font-medium">Zat Besi</span>
                        <span id="prevZatBesi" class="text-xs sm:text-sm font-bold text-emerald-700">2.8 mg</span>
                    </div>
                    <div class="bg-violet-50/80 p-2.5 rounded-xl border border-violet-100">
                        <span class="text-[10px] text-stone-500 block font-medium">Seng</span>
                        <span id="prevSeng" class="text-xs sm:text-sm font-bold text-violet-700">1.5 mg</span>
                    </div>
                </div>
            </div>

            <!-- 2. Bahan yang Dibutuhkan List -->
            <div>
                <h4 class="font-bold text-stone-900 mb-2 flex items-center gap-1.5">
                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-600"></i> Bahan yang Dibutuhkan:
                </h4>
                <div class="bg-stone-50 p-3.5 rounded-xl border border-stone-200">
                    <ul id="prevIngredientsList" class="space-y-2">
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            <span>30 gr Beras Merah Organik</span>
                        </li>
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            <span>40 gr Fillet Ikan Salmon / Kembung Segar</span>
                        </li>
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            <span>1 genggam Daun Bayam Segar</span>
                        </li>
                        <li class="flex items-center gap-2 text-stone-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            <span>1 sdt Minyak Kelapa / Lemak Tambahan</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 3. Cara Pembuatan Steps -->
            <div>
                <h4 class="font-bold text-stone-900 mb-2 flex items-center gap-1.5">
                    <i data-lucide="utensils" class="w-3.5 h-3.5 text-rose-700"></i> Cara Pembuatan:
                </h4>
                <div class="space-y-2.5">
                    <ol id="prevStepsList" class="space-y-2 text-stone-700">
                        <li class="flex items-start gap-2.5 bg-stone-50/50 p-2.5 rounded-xl border border-stone-100">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <span class="leading-relaxed">Cuci beras merah hingga bersih, lalu masak bersama air/kaldu hingga menjadi bubur lembut.</span>
                        </li>
                        <li class="flex items-start gap-2.5 bg-stone-50/50 p-2.5 rounded-xl border border-stone-100">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <span class="leading-relaxed">Kukus fillet ikan dan sayur bayam hingga matang merata.</span>
                        </li>
                        <li class="flex items-start gap-2.5 bg-stone-50/50 p-2.5 rounded-xl border border-stone-100">
                            <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <span class="leading-relaxed">Haluskan dan saring melalui kawat saring halus sesuai tekstur usia bayi, sajikan selagi hangat.</span>
                        </li>
                    </ol>
                </div>
            </div>

        </div>

        <!-- Preview Footer -->
        <div class="px-5 py-3 bg-stone-50 border-t border-stone-100 flex items-center justify-end gap-2 shrink-0">
            <button type="button" onclick="closePreviewModal()" class="px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white font-semibold rounded-xl text-xs transition-colors cursor-pointer">
                Tutup Preview
            </button>
        </div>

    </div>
</div>
