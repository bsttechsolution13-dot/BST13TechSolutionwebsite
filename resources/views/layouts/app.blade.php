<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'BST13 TechSolutions - Solusi Kebutuhan IT, Gadget, & Audio Terpercaya')</title>
    <meta name="description" content="@yield('meta_description', 'BST13 TechSolutions melayani reparasi handphone, laptop & PC, rakit komputer custom, pembuatan website, sewa sound system, hingga install ulang OS. Konsultasi via WhatsApp +62 858-6177-3230.')">
    <meta name="keywords" content="BST13 TechSolutions, reparasi laptop, reparasi handphone, rakit pc gaming, sewa sound system, pembuatan website, install ulang windows, jual beli hp">
    <meta name="author" content="BST13 TechSolutions">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'BST13 TechSolutions - Solusi Kebutuhan IT, Gadget, & Audio')">
    <meta property="og:description" content="Layanan servis HP & Laptop, Rakit PC, Website, Sewa Sound, dan OS. Konsultasi via WhatsApp +62 858-6177-3230.">

    <!-- Favicon (Circular Emblem) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon-192x192.png') }}?v=2">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-circle.png') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-192x192.png') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN for immediate preview + fallback) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0e1015;
            color: #d4d4d8;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #12141a;
        }
        ::-webkit-scrollbar-thumb {
            background: #272a34;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #3f4454;
        }

        /* Scroll Reveal Animations (True Bidirectional: Scroll Down & Scroll Up) */
        .reveal-on-scroll {
            opacity: 0;
            will-change: opacity, transform;
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1), 
                        border-color 0.25s ease, 
                        box-shadow 0.25s ease;
        }

        /* 1. Scrolling Down (Entering from bottom -> slides up) */
        .reveal-on-scroll:not(.from-top) {
            transform: translateY(32px);
        }
        .reveal-on-scroll.reveal-scale:not(.from-top) {
            transform: translateY(24px) scale(0.96);
        }
        .reveal-on-scroll.reveal-left:not(.from-top) {
            transform: translate(-30px, 20px);
        }
        .reveal-on-scroll.reveal-right:not(.from-top) {
            transform: translate(30px, 20px);
        }

        /* 2. Scrolling Up (Entering from top -> slides down) */
        .reveal-on-scroll.from-top {
            transform: translateY(-32px);
        }
        .reveal-on-scroll.reveal-scale.from-top {
            transform: translateY(-24px) scale(0.96);
        }
        .reveal-on-scroll.reveal-left.from-top {
            transform: translate(-30px, -20px);
        }
        .reveal-on-scroll.reveal-right.from-top {
            transform: translate(30px, -20px);
        }

        /* 3. Revealed in Viewport */
        .reveal-on-scroll.is-revealed {
            opacity: 1 !important;
            transform: translate3d(0, 0, 0) scale(1) !important;
        }

        /* Micro-interactions & Card Hover (Matte Drop Shadow & Subtle Border Highlight) */
        .card-interactive {
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), 
                        border-color 0.25s ease, 
                        box-shadow 0.25s ease;
        }
        .card-interactive.is-revealed:hover {
            transform: translate3d(0, -4px, 0) scale(1) !important;
            border-color: rgba(59, 130, 246, 0.5) !important;
            box-shadow: 0 16px 28px -6px rgba(0, 0, 0, 0.55), 0 6px 12px -4px rgba(0, 0, 0, 0.35) !important;
        }

        /* Respect Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            .reveal-on-scroll {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
            #page-loader {
                display: none !important;
            }
        }

        #page-loader {
            transition: opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1), transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#0e1015] text-zinc-300 antialiased min-h-screen flex flex-col selection:bg-blue-600 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- Deep Charcoal Matte Loading Screen -->
    <div id="page-loader" class="fixed inset-0 z-[100] bg-[#0b0d11]/98 backdrop-blur-sm flex flex-col items-center justify-center">
        <div class="relative flex flex-col items-center text-center px-4 max-w-sm">
            <!-- Clean Logo Emblem -->
            <div class="relative flex items-center justify-center mb-5">
                <div class="relative w-20 h-20 rounded-full bg-[#161820] border border-zinc-800 p-2 shadow-xl shadow-black/60 flex items-center justify-center">
                    <img src="{{ asset('images/logo-circle.png') }}" alt="BST TechSolution" class="w-full h-full object-contain rounded-full">
                </div>
            </div>

            <!-- Brand Typography -->
            <h2 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                BST <span class="text-blue-500">TechSolution</span>
            </h2>
            <p class="text-xs text-zinc-400 font-medium mt-1">IT, Gadget & Audio Service</p>

            <!-- Clean Minimal Progress Bar -->
            <div class="mt-6 w-44 sm:w-52 h-1.5 bg-[#1a1e28] rounded-full overflow-hidden border border-zinc-800">
                <div id="loader-progress-bar" class="h-full bg-blue-500 rounded-full w-0 transition-all duration-300 ease-out"></div>
            </div>

            <!-- Micro status text -->
            <p id="loader-status" class="text-[11px] text-zinc-500 mt-2.5 font-medium tracking-wide">Menyiapkan layanan...</p>
        </div>
    </div>

    <!-- Admin Layout Topbar if Logged In -->
    @auth
        @if(auth()->user()->isAdminLayout())
            <div class="bg-blue-600 text-white text-xs px-4 py-2 sticky top-0 z-[60] flex items-center justify-between border-b border-blue-500 shadow-md">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                    <span class="font-bold tracking-wide">MODE ADMIN LAYOUT:</span>
                    <span class="text-blue-100 hidden sm:inline">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-2.5 py-1 rounded-md bg-blue-800 hover:bg-blue-900 text-white font-semibold transition">
                        ⚙️ Kelola Layout
                    </a>
                    <a href="{{ route('admin.hero') }}" class="px-2.5 py-1 rounded-md bg-blue-800 hover:bg-blue-900 text-white font-semibold transition">
                        🖼️ Ganti Background & Teks
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-200 hover:text-white px-1.5 py-1 text-xs font-medium">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @endauth

    <!-- Top Info Bar (Deep Charcoal Matte Bar) -->
    <div class="bg-[#08090d] border-b border-zinc-800/80 text-xs py-2 px-4 text-zinc-400">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 text-zinc-300 font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Workshop Buka: Senin - Sabtu 09.00 - 21.00 WIB
                </span>
                <span class="hidden md:inline text-zinc-600">•</span>
                <span class="hidden md:inline text-zinc-400">Garansi Pengerjaan & Konsultasi Terbuka</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-zinc-400">
                    Workshop & Layanan Cepat: <strong class="text-white">{{ $businessInfo['whatsapp_display'] ?? '+62 858-6177-3230' }}</strong>
                </span>
            </div>
        </div>
    </div>

    <!-- Navigation Header (Deep Charcoal Matte Nav) -->
    <header class="sticky top-0 z-50 bg-[#0e1015]/90 backdrop-blur-md border-b border-zinc-800/80 shadow-md shadow-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group py-1">
                    <img src="{{ asset('images/logo-circle.png') }}" alt="BST TechSolution" class="h-10 sm:h-12 w-10 sm:w-12 object-contain rounded-full shadow-md shadow-black/50 hover:opacity-95 transition">
                    <div class="flex flex-col">
                        <span class="font-bold text-lg sm:text-xl text-white tracking-tight leading-tight group-hover:text-blue-400 transition">
                            BST <span class="text-blue-500">TechSolution</span>
                        </span>
                        <span class="text-[10px] sm:text-[11px] font-semibold text-zinc-400 leading-tight">IT, Gadget & Audio Service</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center space-x-1 text-sm font-medium text-zinc-300">
                    <a href="{{ route('home') }}#hero" class="px-3.5 py-2 rounded-lg hover:text-white hover:bg-zinc-800/60 transition">Beranda</a>
                    <a href="{{ route('home') }}#layanan" class="px-3.5 py-2 rounded-lg hover:text-white hover:bg-zinc-800/60 transition">Layanan</a>
                    <a href="{{ route('home') }}#keunggulan" class="px-3.5 py-2 rounded-lg hover:text-white hover:bg-zinc-800/60 transition">Keunggulan</a>
                    <a href="{{ route('home') }}#alur" class="px-3.5 py-2 rounded-lg hover:text-white hover:bg-zinc-800/60 transition">Cara Pesan</a>
                    <a href="{{ route('home') }}#testimoni" class="px-3.5 py-2 rounded-lg hover:text-white hover:bg-zinc-800/60 transition">Testimoni</a>
                    <a href="{{ route('home') }}#konsultasi" class="px-3.5 py-2 rounded-lg hover:text-white hover:bg-zinc-800/60 transition">Formulir Pesan</a>
                </nav>

                <!-- Clean Hubungi Kami Button in Navbar -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('home') }}#konsultasi" 
                       class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-blue-600 hover:bg-blue-500 shadow-sm transition hover:-translate-y-0.5">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex lg:hidden items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            type="button" 
                            class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition"
                            aria-label="Menu">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-cloak x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-cloak 
             x-show="mobileMenuOpen" 
             class="lg:hidden border-b border-zinc-800 bg-[#13161e] px-4 pt-2 pb-5 space-y-1 shadow-xl">
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#hero" class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800/70 hover:text-white">Beranda</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#layanan" class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800/70 hover:text-white">Katalog Layanan</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#keunggulan" class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800/70 hover:text-white">Keunggulan</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#alur" class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800/70 hover:text-white">Cara Pesan</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#testimoni" class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800/70 hover:text-white">Testimoni</a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#konsultasi" class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:bg-zinc-800/70 hover:text-white">Formulir Pesan</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp Button (Clean & Familiar WhatsApp Green) -->
    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/{{ $businessInfo['whatsapp'] ?? '6285861773230' }}?text=Halo%20BST13%20TechSolutions,%20saya%20butuh%20bantuan." 
           target="_blank" 
           title="Chat via WhatsApp (+62 858-6177-3230)"
           class="group flex items-center gap-2.5 px-4 py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold rounded-full shadow-lg shadow-emerald-600/30 transition hover:-translate-y-0.5">
            <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.199.534 1.286.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.087-.179.182-.077.357.101.174.45 0.742.966 1.201.664.591 1.224.774 1.398.86.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.203.043.072.043.419-.101.824z"/>
            </svg>
            <span class="text-xs font-semibold">Bantuan WA</span>
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-[#08090d] border-t border-zinc-800 text-zinc-400 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-8">
                
                <!-- Col 1: Brand & Logo (4 cols) -->
                <div class="lg:col-span-4 space-y-4 pr-0 lg:pr-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                        <img src="{{ asset('images/logo-circle.png') }}" alt="BST TechSolution" class="h-12 w-12 object-contain rounded-full shadow-md shadow-black/50 hover:opacity-95 transition">
                        <div>
                            <h3 class="font-bold text-lg text-white">BST <span class="text-blue-500">TechSolution</span></h3>
                            <p class="text-xs text-zinc-400 font-medium">Solusi IT, Gadget, & Audio Terpercaya</p>
                        </div>
                    </a>
                    <p class="text-sm leading-relaxed text-zinc-400">
                        Pusat layanan reparasi HP & laptop, rakit PC custom, pembuatan website bisnis, sewa sound system acara, hingga instalasi OS. Bergaransi dan dikerjakan langsung oleh teknisi berpengalaman.
                    </p>
                </div>

                <!-- Col 2: Services (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <h4 class="text-xs font-bold text-white tracking-wider uppercase flex items-center gap-2">
                        <span class="w-1.5 h-3.5 rounded bg-blue-500"></span>
                        Layanan Kami
                    </h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Pembuatan Website</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Reparasi Handphone</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Reparasi Laptop</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Reparasi Komputer PC</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Rakit Komputer Custom</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Sewa Sound Paket Event</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Jual Beli Handphone</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-zinc-400 hover:text-white transition flex items-center gap-1.5"><span class="text-blue-500 text-xs">›</span> Install Ulang Laptop & PC</a></li>
                    </ul>
                </div>

                <!-- Col 3: Workshop & Jam Buka (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <h4 class="text-xs font-bold text-white tracking-wider uppercase flex items-center gap-2">
                        <span class="w-1.5 h-3.5 rounded bg-blue-500"></span>
                        Workshop & Buka
                    </h4>
                    <div class="space-y-3 text-sm text-zinc-400">
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-zinc-300 leading-snug">{{ $businessInfo['address'] ?? 'Workshop BST13 Tech' }}</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <p class="text-white font-medium">Jam Operasional:</p>
                                <p class="text-zinc-300 leading-snug">{{ $businessInfo['operating_hours'] ?? 'Senin - Sabtu: 09.00 - 21.00 WIB' }}</p>
                            </div>
                        </div>
                        <p class="text-zinc-500 text-xs leading-relaxed pt-1 border-t border-zinc-800">
                            *Konsultasi via WhatsApp tetap aktif di luar jam kerja jika teknisi online.
                        </p>
                    </div>
                </div>

                <!-- Col 4: Kontak WhatsApp Card (2 cols) -->
                <div class="lg:col-span-2 space-y-4">
                    <h4 class="text-xs font-bold text-white tracking-wider uppercase flex items-center gap-2">
                        <span class="w-1.5 h-3.5 rounded bg-emerald-500"></span>
                        Hubungi Kami
                    </h4>
                    
                    <div class="rounded-xl p-3.5 bg-[#12151c] border border-zinc-800 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span class="text-xs font-semibold text-zinc-300">Teknisi Online</span>
                        </div>
                        <a href="https://wa.me/{{ $businessInfo['whatsapp'] ?? '6285861773230' }}?text=Halo%20BST13%20TechSolutions" 
                           target="_blank" 
                           class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-xs shadow-md transition hover:-translate-y-0.5 w-full">
                            <svg class="w-4 h-4 fill-white shrink-0" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.199.534 1.286.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.087-.179.182-.077.357.101.174.45 0.742.966 1.201.664.591 1.224.774 1.398.86.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.203.043.072.043.419-.101.824z"/></svg>
                            <span>Chat WA</span>
                        </a>
                        <p class="text-[11px] font-mono text-zinc-400 text-center tracking-tight">
                            {{ $businessInfo['whatsapp_display'] ?? '+62 858-6177-3230' }}
                        </p>
                    </div>
                </div>

            </div>

            <div class="mt-12 pt-6 border-t border-zinc-800 text-xs text-zinc-500 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p>&copy; {{ date('Y') }} <span class="text-white font-medium">{{ $businessInfo['name'] ?? 'BST TechSolution' }}</span>. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4">
                    <p class="text-zinc-500">Solusi Kebutuhan IT, Gadget, & Audio Terpercaya</p>
                    <span class="text-zinc-700">•</span>
                    <a href="{{ route('admin.login') }}" class="text-zinc-500 hover:text-zinc-300 transition text-[11px] flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>Admin Layout</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    
    <!-- Smooth Bidirectional Scroll Reveal Controller (Aktif Saat Bergulir ke Bawah Maupun ke Atas) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            if (!revealElements.length) return;

            if (!('IntersectionObserver' in window)) {
                revealElements.forEach(el => el.classList.add('is-revealed'));
                return;
            }

            // Realtime Scroll Direction Tracker
            let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
            let scrollDirection = 'down';

            window.addEventListener('scroll', () => {
                const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
                if (Math.abs(currentScrollY - lastScrollY) > 3) {
                    scrollDirection = currentScrollY > lastScrollY ? 'down' : 'up';
                    lastScrollY = currentScrollY;
                }

                // Jika pengguna kembali ke paling atas, pastikan hero tetap menyala sempurna
                if (currentScrollY <= 20) {
                    document.querySelectorAll('#hero .reveal-on-scroll').forEach(el => {
                        el.classList.remove('from-top');
                        el.classList.add('is-revealed');
                    });
                }
            }, { passive: true });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const el = entry.target;
                    clearTimeout(el._revealTimeout);

                    if (entry.isIntersecting) {
                        const rect = entry.boundingClientRect;
                        const scrollY = window.pageYOffset || document.documentElement.scrollTop;

                        // Tentukan arah masuk: jika scroll ke atas atau elemen muncul dari atas layar
                        const isFromTop = (scrollDirection === 'up' || rect.top < window.innerHeight * 0.35) && scrollY > 60;

                        if (isFromTop) {
                            el.classList.add('from-top');
                        } else {
                            el.classList.remove('from-top');
                        }

                        // Animasi masuk dengan stagger delay yang responsif
                        const rawDelay = parseInt(el.getAttribute('data-delay') || '0', 10);
                        const delay = Math.min(rawDelay, 250);

                        if (delay > 0) {
                            el._revealTimeout = setTimeout(() => {
                                el.classList.add('is-revealed');
                            }, delay);
                        } else {
                            requestAnimationFrame(() => {
                                el.classList.add('is-revealed');
                            });
                        }
                    } else {
                        // Elemen keluar sepenuhnya dari layar, reset agar memicu animasi kembali saat masuk
                        const rect = entry.boundingClientRect;

                        // Jika keluar lewat atas layar (user bergulir ke bawah)
                        if (rect.bottom <= 10) {
                            el.classList.remove('is-revealed');
                            el.classList.add('from-top');
                        }
                        // Jika keluar lewat bawah layar (user bergulir ke atas)
                        else if (rect.top >= window.innerHeight - 30) {
                            el.classList.remove('is-revealed');
                            el.classList.remove('from-top');
                        }
                    }
                });
            }, {
                // threshold 0: fires sesaat setelah 1px masuk dan sesaat setelah 0px keluar
                threshold: 0,
                rootMargin: '0px 0px -20px 0px'
            });

            revealElements.forEach(el => observer.observe(el));
        });
    </script>

    <!-- Entrance & Loading Screen Controller (Durasi 2 Detik) -->
    <script>
        (function() {
            const loader = document.getElementById('page-loader');
            const bar = document.getElementById('loader-progress-bar');
            const status = document.getElementById('loader-status');
            if (!loader || !bar) return;

            const startTime = performance.now();
            const totalDuration = 2000; // Tepat 2 detik sesuai permintaan user

            function updateLoader(currentTime) {
                const elapsed = currentTime - startTime;
                const ratio = Math.min(elapsed / totalDuration, 1);

                // Easing curve (easeOutCubic) agar bar berjalan mulus dan mantap
                const easeOut = 1 - Math.pow(1 - ratio, 3);
                const percent = Math.min(Math.round(easeOut * 100), 100);

                bar.style.width = percent + '%';

                if (status) {
                    if (ratio < 0.45) {
                        status.textContent = 'Menyiapkan layanan BST...';
                    } else if (ratio < 0.85) {
                        status.textContent = 'Memuat sistem & katalog...';
                    } else {
                        status.textContent = 'Selamat datang di BST TechSolution!';
                    }
                }

                if (ratio < 1) {
                    requestAnimationFrame(updateLoader);
                } else {
                    // Tepat 2 detik tercapai, lakukan transisi fade-out halus
                    setTimeout(() => {
                        loader.style.opacity = '0';
                        loader.style.transform = 'scale(1.02)';
                        loader.style.pointerEvents = 'none';

                        setTimeout(() => {
                            loader.style.display = 'none';
                            // Pemicu animasi kemunculan Hero setelah loading screen memudar
                            document.querySelectorAll('#hero .reveal-on-scroll').forEach(el => {
                                el.classList.add('is-revealed');
                            });
                        }, 500);
                    }, 120);
                }
            }

            requestAnimationFrame(updateLoader);
        })();
    </script>
</body>
</html>
