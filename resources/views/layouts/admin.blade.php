<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - StuntGuard Jember</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
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
<body class="bg-stone-50 text-stone-800 antialiased h-screen overflow-hidden flex flex-col md:flex-row relative font-sans">

    <!-- Sidebar Component -->
    <x-admin.sidebar />

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden">

        <!-- Header Component -->
        <x-admin.header />

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-3.5 sm:p-5 flex flex-col gap-4 max-w-[1920px] w-full mx-auto">
            @yield('content')

            <!-- Footer -->
            <footer class="text-center py-2 shrink-0">
                <span class="text-[11px] text-stone-400">© 2026 StuntGuard Jember • Modul Edukasi & Resep MPASI Balita</span>
            </footer>
        </main>
    </div>

    <!-- Script Global (Lucide Icon Init & Format Tanggal) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }

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
