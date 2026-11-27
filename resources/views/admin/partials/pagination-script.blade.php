<script>
// Satu paginator untuk seluruh tabel admin (client-side, 6 baris per halaman).
(function () {
    const instances = {};
    const PAGE_SIZE = 6;

    function setup(name, selector, navId, countId, noun) {
        const nav = document.getElementById(navId);
        if (!nav) return;
        const rows = Array.from(document.querySelectorAll(selector));
        const count = document.getElementById(countId);
        let currentPage = 1;

        const makeButton = (label, target, disabled = false, current = false, ariaLabel = label) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = label;
            btn.disabled = disabled;
            btn.setAttribute('aria-label', ariaLabel);
            if (current) btn.setAttribute('aria-current', 'page');
            btn.className = [
                'inline-flex min-w-8 h-8 items-center justify-center rounded-lg border px-2.5',
                'text-xs font-semibold transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-700',
                current ? 'border-rose-700 bg-rose-700 text-white shadow-sm' :
                          'border-stone-200 bg-white text-stone-600 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-800',
                'disabled:pointer-events-none disabled:opacity-40'
            ].join(' ');
            btn.addEventListener('click', () => {
                if (disabled || current) return;
                currentPage = target;
                render();
            });
            return btn;
        };

        function render(reset = false) {
            if (reset) currentPage = 1;
            const matched = rows.filter(row => row.dataset.filterMatch !== 'false');
            const totalPages = Math.max(1, Math.ceil(matched.length / PAGE_SIZE));
            currentPage = Math.max(1, Math.min(currentPage, totalPages));
            rows.forEach(row => { row.hidden = true; row.style.display = 'none'; });
            const start = (currentPage - 1) * PAGE_SIZE;
            matched.slice(start, start + PAGE_SIZE).forEach(row => {
                row.hidden = false;
                row.style.display = '';
            });
            if (count) {
                const first = matched.length ? start + 1 : 0;
                const last = Math.min(start + PAGE_SIZE, matched.length);
                count.textContent = `Menampilkan ${first}–${last} dari ${matched.length} ${noun}`;
            }
            nav.replaceChildren();
            // Tetap tampilkan nomor halaman 1 meskipun data <= 6.
            nav.appendChild(makeButton('‹', currentPage - 1, currentPage === 1, false, 'Halaman sebelumnya'));
            let prev = 0;
            for (let i = 1; i <= totalPages; i++) {
                if (i !== 1 && i !== totalPages && Math.abs(i - currentPage) > 1) continue;
                if (prev && i - prev > 1) {
                    const dots = document.createElement('span');
                    dots.textContent = '…';
                    dots.className = 'px-1 text-stone-400';
                    dots.setAttribute('aria-hidden', 'true');
                    nav.appendChild(dots);
                }
                nav.appendChild(makeButton(String(i), i, false, i === currentPage, `Halaman ${i}`));
                prev = i;
            }
            nav.appendChild(makeButton('›', currentPage + 1, currentPage === totalPages, false, 'Halaman berikutnya'));
        }
        instances[name] = render;
        render();
    }

    window.StuntPagination = { setup, refresh(name) { instances[name]?.(true); } };
    document.addEventListener('DOMContentLoaded', () => {
        setup('users', '.table-user-row', 'paginationUsers', 'userCountDisplay', 'pengguna');
        setup('balita', '.table-balita-row', 'paginationBalita', 'balitaCountDisplay', 'balita');
        setup('informasi', '.pagination-informasi-row', 'paginationInformasi', 'informasiCountDisplay', 'artikel');
        setup('mpasi', '.table-recipe-row', 'paginationMpasi', 'mpasiCountDisplay', 'resep');
    });
})();
</script>
