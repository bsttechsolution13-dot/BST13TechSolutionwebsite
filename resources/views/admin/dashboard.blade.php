@extends('layouts.admin')

@section('title', 'Dashboard Overview - Admin Layout')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    
    <!-- Welcome Banner -->
    <div class="rounded-2xl bg-gradient-to-r from-blue-900/60 via-slate-900 to-slate-900 border border-blue-800/50 p-6 sm:p-7 relative overflow-hidden">
        <div class="relative z-10 max-w-2xl space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-300 border border-blue-500/30">
                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                Role: Admin Layout Aktif
            </span>
            <h2 class="text-2xl font-extrabold text-white">
                Kelola Tampilan & Konten Website dengan Mudah
            </h2>
            <p class="text-sm text-slate-300 leading-relaxed">
                Anda dapat mengubah teks hero, background gambar jasa teknologi, mengelola 9 katalog layanan, dan mengatur nomor kontak WhatsApp langsung dari panel ini tanpa menyentuh kode.
            </p>
        </div>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('admin.hero') }}" class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition">
                🖼️ Ganti Background & Teks Hero
            </a>
            <a href="{{ route('admin.services') }}" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs border border-slate-700 transition">
                🛠️ Kelola 9 Layanan
            </a>
            <a href="{{ route('home') }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-blue-950/80 hover:bg-blue-900 text-blue-300 font-bold text-xs border border-blue-800/60 transition">
                ↗️ Buka Landing Page
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Stat 1 -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex items-center justify-between text-slate-400">
                <span class="text-xs font-medium uppercase tracking-wider">Total Layanan</span>
                <span class="p-2 rounded-lg bg-blue-600/10 text-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-white">{{ $totalServices }}</div>
            <p class="text-xs text-emerald-400 font-medium">✓ {{ $activeServices }} Layanan Tayang</p>
        </div>

        <!-- Stat 2 -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex items-center justify-between text-slate-400">
                <span class="text-xs font-medium uppercase tracking-wider">Background Hero</span>
                <span class="p-2 rounded-lg bg-purple-600/10 text-purple-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
            </div>
            <div class="text-lg font-bold text-white truncate">
                {{ !empty($settings['show_hero_bg']) ? 'Aktif (Gambar Jasa)' : 'Warna Solid' }}
            </div>
            <p class="text-xs text-blue-300">Opasitas: {{ $settings['hero_bg_opacity'] ?? 35 }}%</p>
        </div>

        <!-- Stat 3 -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex items-center justify-between text-slate-400">
                <span class="text-xs font-medium uppercase tracking-wider">WhatsApp Terhubung</span>
                <span class="p-2 rounded-lg bg-emerald-600/10 text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </span>
            </div>
            <div class="text-sm font-mono font-bold text-white truncate">
                {{ $settings['business_whatsapp_display'] ?? '+62 858-6177-3230' }}
            </div>
            <p class="text-xs text-slate-400">Penerima Chat Otomatis</p>
        </div>

        <!-- Stat 4 -->
        <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex items-center justify-between text-slate-400">
                <span class="text-xs font-medium uppercase tracking-wider">Brand Name</span>
                <span class="p-2 rounded-lg bg-blue-600/10 text-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </span>
            </div>
            <div class="text-lg font-bold text-white truncate">
                {{ $settings['business_name'] ?? 'BST TechSolution' }}
            </div>
            <p class="text-xs text-blue-300">Logo Bulat Terpasang</p>
        </div>
    </div>

    <!-- Hero Live Mini-Preview Card -->
    <div class="rounded-2xl bg-slate-900/90 border border-slate-800 overflow-hidden">
        <div class="p-5 border-b border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                <h3 class="font-bold text-sm text-white">Pratinjau Hero Section Saat Ini</h3>
            </div>
            <a href="{{ route('admin.hero') }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold">
                Ubah Konten Hero →
            </a>
        </div>
        
        <div class="p-6 relative bg-[#0b1329] overflow-hidden min-h-[220px] flex items-center">
            <!-- Background Image Preview -->
            @if(!empty($settings['show_hero_bg']) && !empty($settings['hero_bg_image']))
                <div class="absolute inset-0 pointer-events-none">
                    <img src="{{ asset($settings['hero_bg_image']) }}" alt="Bg Preview" class="w-full h-full object-cover" style="opacity: {{ ($settings['hero_bg_opacity'] ?? 35) / 100 }};">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0b1329] via-[#0b1329]/90 to-[#0b1329]/75"></div>
                </div>
            @endif

            <div class="relative z-10 max-w-xl space-y-3">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-950/80 text-blue-300 border border-blue-800/80 inline-block">
                    {{ $settings['hero_badge'] ?? 'Workshop & Layanan Terpercaya' }}
                </span>
                <h4 class="text-xl sm:text-2xl font-bold text-white leading-tight">
                    {!! $settings['hero_headline'] ?? 'Solusi Kebutuhan IT, Gadget & Audio' !!}
                </h4>
                <p class="text-xs text-slate-300 line-clamp-2">
                    {{ $settings['hero_subheadline'] ?? 'Deskripsi singkat layanan workshop.' }}
                </p>
                <div class="pt-2">
                    <span class="px-4 py-2 rounded-lg bg-blue-600 text-white font-bold text-xs inline-block">
                        {{ $settings['hero_cta_text'] ?? 'Pilih Layanan & Pesan' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Shortcuts -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <a href="{{ route('admin.hero') }}" class="p-6 rounded-2xl bg-slate-900 border border-slate-800 hover:border-blue-700/80 transition group">
            <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition">
                🖼️
            </div>
            <h4 class="font-bold text-base text-white group-hover:text-blue-300 transition">Hero & Background Jasa</h4>
            <p class="text-xs text-slate-400 mt-1">Ganti background gambar workshop, atur transparansi, ubah headline, dan 3 poin kepercayaan.</p>
        </a>

        <a href="{{ route('admin.services') }}" class="p-6 rounded-2xl bg-slate-900 border border-slate-800 hover:border-blue-700/80 transition group">
            <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition">
                🛠️
            </div>
            <h4 class="font-bold text-base text-white group-hover:text-blue-300 transition">Katalog 9 Layanan</h4>
            <p class="text-xs text-slate-400 mt-1">Edit detail perbaikan HP, laptop, rakit PC, sound system, website, dan install ulang OS.</p>
        </a>

        <a href="{{ route('admin.business') }}" class="p-6 rounded-2xl bg-slate-900 border border-slate-800 hover:border-blue-700/80 transition group">
            <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center font-bold mb-4 group-hover:scale-110 transition">
                📞
            </div>
            <h4 class="font-bold text-base text-white group-hover:text-blue-300 transition">Kontak & Workshop</h4>
            <p class="text-xs text-slate-400 mt-1">Ubah nomor WhatsApp admin teknisi, jam operasional, alamat workshop, dan teks footer.</p>
        </a>

    </div>

</div>
@endsection
