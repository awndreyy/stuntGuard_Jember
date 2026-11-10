<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - StuntGuard Jember</title>

    <!-- CSS & JavaScript melalui Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            font-family: var(--font-sans);
            -webkit-font-smoothing: antialiased;
        }
        /* Custom subtle scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #f5f5f4;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6d3d1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a29e;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-brand-canvas text-stone-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

        <!-- Header Component -->
        <x-admin.header />

        <!-- Main Content Area -->
        <main class="flex-1 min-h-0 overflow-y-auto p-3.5 sm:p-5 flex flex-col gap-4 max-w-[1920px] w-full mx-auto">
            @yield('content')

            <!-- Footer -->
            <footer class="mt-auto pt-4 pb-2 text-center shrink-0">
                <span class="text-[11px] text-stone-400">
                    © 2026 StuntGuard Jember • Dibuat oleh Kelompok 2
                </span>
            </footer>
        </main>
    </div>

    {{-- Toast sukses global, digunakan seluruh halaman admin. --}}
    <div id="adminToast" role="status" aria-live="polite" aria-atomic="true"
    class="pointer-events-none fixed left-1/2 top-5 z-[100] flex w-[calc(100%-2rem)] max-w-sm -translate-x-1/2 -translate-y-3 items-center gap-3 rounded-2xl border border-green-200 bg-white px-4 py-3 text-stone-800 opacity-0 shadow-xl transition-all duration-300">
        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-green-100 text-green-700">
            <i data-lucide="check-circle-2" class="h-5 w-5"></i>
        </span>
        <div class="min-w-0">
            <p id="adminToastTitle" class="text-sm font-bold">Berhasil</p>
            <p id="adminToastMessage" class="break-words text-xs text-stone-600"></p>
        </div>
        <button type="button" id="adminToastClose" class="pointer-events-auto ml-auto rounded-lg p-1 text-stone-400 transition hover:bg-stone-100 hover:text-stone-700" aria-label="Tutup notifikasi">
            <i data-lucide="x" class="h-4 w-4"></i>
        </button>
    </div>

    <x-admin.confirmation-modal />

    <!-- Script Global (Lucide Icon Init & Format Tanggal) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.lucide?.createIcons();

            const toast = document.getElementById('adminToast');
            let toastTimer;
            window.showToast = (title, message) => {
                if (!toast) return;
                document.getElementById('adminToastTitle').textContent = title;
                document.getElementById('adminToastMessage').textContent = message;
                clearTimeout(toastTimer);
                toast.classList.remove('pointer-events-none', 'opacity-0', '-translate-y-3');
                toast.classList.add('opacity-100', 'translate-y-0');
                toastTimer = setTimeout(() => {
                    toast.classList.add('pointer-events-none', 'opacity-0', '-translate-y-3');
                    toast.classList.remove('opacity-100', 'translate-y-0');
                }, 4000);
            };
            document.getElementById('adminToastClose')?.addEventListener('click', () => {
                clearTimeout(toastTimer);
                toast.classList.add('pointer-events-none', 'opacity-0', '-translate-y-3');
                toast.classList.remove('opacity-100', 'translate-y-0');
            });
            @if(session('success'))
                window.showToast('Berhasil', @json(session('success')));
            @endif

            const dateOptions = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', dateOptions);
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                dateElement.innerText = today;
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
