<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="StuntGuard Jember: edukasi tumbuh kembang anak, informasi kesehatan, dan resep MPASI.">
    <title>@yield('title', 'StuntGuard Jember - Pemantauan Gizi Balita')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400..700,0..1&amp;display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      body { font-family: 'Plus Jakarta Sans', sans-serif; }
      .material-symbols-outlined { font-family: 'Material Symbols Outlined'; font-variation-settings: 'FILL' 1, 'wght' 500; user-select: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FFFBFC] text-stone-800 min-h-screen flex flex-col antialiased selection:bg-pink-200 selection:text-pink-900">
    <x-guest.navbar />
    <main class="w-full flex-1 pt-20" id="beranda">
      @yield('content')
    </main>
    <x-guest.footer />
    @stack('scripts')
</body>
</html>
