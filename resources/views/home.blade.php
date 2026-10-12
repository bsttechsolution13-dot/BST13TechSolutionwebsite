@extends('layouts.app')

@section('title', 'BST13 TechSolutions - Solusi Kebutuhan IT, Gadget, & Audio Terpercaya')

@section('content')
<div x-data="{ activeCategory: 'Semua' }">
    <!-- Hero Section -->
    <section id="hero" class="relative pt-12 pb-20 lg:pt-16 lg:pb-28 border-b border-zinc-800/80 bg-[#0e1015] overflow-hidden">
        
        <!-- Dynamic Workshop / Tech Background Image with Matte Charcoal Overlay -->
        @if(!empty($settings['show_hero_bg']) && !empty($settings['hero_bg_image']))
            <div class="absolute inset-0 z-0 pointer-events-none">
                <img src="{{ asset($settings['hero_bg_image']) }}" 
                     alt="Tech Workshop Background" 
                     class="w-full h-full object-cover object-center transition duration-700"
                     style="opacity: {{ ($settings['hero_bg_opacity'] ?? 15) / 100 }};">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0e1015] via-[#0e1015]/95 to-[#0e1015]/85"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0e1015] via-transparent to-[#0e1015]/90"></div>
            </div>
        @endif

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Hero Left -->
                <div class="lg:col-span-7 space-y-7 text-center lg:text-left reveal-on-scroll">
                    
                    <!-- Pill Badge -->
                    @if(!empty($settings['hero_badge']))
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#181b24] border border-zinc-800 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <span class="text-xs font-semibold text-zinc-300">
                                {{ $settings['hero_badge'] }}
                            </span>
                        </div>
                    @endif

                    <!-- Headline -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                        {!! $settings['hero_headline'] ?? 'Solusi Kebutuhan <span class="text-blue-500">IT, Gadget</span> & Audio dalam Satu Tempat.' !!}
                    </h1>

                    <!-- Subheadline -->
                    <p class="text-base sm:text-lg text-zinc-400 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                        {{ $settings['hero_subheadline'] ?? 'Melayani servis HP & laptop, rakit PC custom, pembuatan website bisnis, sewa sound system acara, hingga instalasi OS. Konsultasikan kendala Anda langsung dengan teknisi kami via WhatsApp.' }}
                    </p>

                    <!-- Trust Points -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs sm:text-sm text-zinc-300">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="font-medium">{{ $settings['hero_trust_1'] ?? 'Konsultasi Bebas Biaya' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="font-medium">{{ $settings['hero_trust_2'] ?? 'Diagnosa Terbuka & Jujur' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="font-medium">{{ $settings['hero_trust_3'] ?? 'Garansi Pengerjaan Nyata' }}</span>
                        </div>
                    </div>

                    <!-- Clean Single Action CTA (No Clutter, No Redundant Number) -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#layanan" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-xl font-bold text-sm text-white bg-blue-600 hover:bg-blue-500 shadow-md shadow-blue-900/30 transition hover:-translate-y-0.5">
                            <span>{{ $settings['hero_cta_text'] ?? 'Pilih Layanan & Pesan' }}</span>
                            <svg class="w-4 h-4 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>

                </div>

                <!-- Hero Right: Real Workshop Contact Card -->
                <div class="lg:col-span-5 reveal-on-scroll reveal-scale" data-delay="150">
                    <div class="rounded-2xl bg-[#141720] border border-zinc-800 p-6 sm:p-7 shadow-2xl shadow-black/60">
                        
                        <div class="flex items-center justify-between pb-5 border-b border-zinc-800">
                            <div>
                                <h3 class="font-bold text-white text-base">{{ $settings['hero_card_title'] ?? 'Meja Konsultasi BST13' }}</h3>
                                <p class="text-xs text-zinc-400">{{ $settings['hero_card_subtitle'] ?? 'Respon Cepat & Pengecekan Ramah' }}</p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-950/70 text-emerald-400 border border-emerald-800/60">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                Teknisi Aktif
                            </span>
                        </div>

                        <!-- Highlights List -->
                        <div class="py-5 space-y-3.5">
                            <div class="p-3.5 rounded-xl bg-[#1a1e28] border border-zinc-800/80 flex items-start gap-3 hover:bg-[#202534] transition">
                                <div class="w-8 h-8 rounded-lg bg-[#242b3b] text-blue-400 flex items-center justify-center shrink-0 mt-0.5 border border-blue-900/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-white">{{ $settings['hero_card_point_1_title'] ?? 'Pilih Layanan, Formulir Langsung Terisi' }}</p>
                                    <p class="text-xs text-zinc-400 mt-0.5">{{ $settings['hero_card_point_1_desc'] ?? 'Pijit tombol pada kartu layanan mana pun, form langsung terisi otomatis.' }}</p>
                                </div>
                            </div>

                            <div class="p-3.5 rounded-xl bg-[#1a1e28] border border-zinc-800/80 flex items-start gap-3 hover:bg-[#202534] transition">
                                <div class="w-8 h-8 rounded-lg bg-[#242b3b] text-blue-400 flex items-center justify-center shrink-0 mt-0.5 border border-blue-900/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-white">{{ $settings['hero_card_point_2_title'] ?? 'Bisa Ditunggu / Janji Temu' }}</p>
                                    <p class="text-xs text-zinc-400 mt-0.5">{{ $settings['hero_card_point_2_desc'] ?? 'Ganti baterai, LCD, dan install OS dapat ditunggu di workshop.' }}</p>
                                </div>
                            </div>

                            <div class="p-3.5 rounded-xl bg-[#1a1e28] border border-zinc-800/80 flex items-start gap-3 hover:bg-[#202534] transition">
                                <div class="w-8 h-8 rounded-lg bg-[#242b3b] text-blue-400 flex items-center justify-center shrink-0 mt-0.5 border border-blue-900/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-white">{{ $settings['hero_card_point_3_title'] ?? 'Tanpa Biaya Sebelum Disepakati' }}</p>
                                    <p class="text-xs text-zinc-400 mt-0.5">{{ $settings['hero_card_point_3_desc'] ?? 'Pemeriksaan unit dan estimasi biaya dikonfirmasi terlebih dahulu.' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="pt-4 border-t border-zinc-800">
                            <a href="#konsultasi" 
                               onclick="selectService('Tanya Lainnya / Konsultasi Bebas')"
                               class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm text-zinc-300 bg-[#1a1e28] border border-zinc-800 hover:bg-[#222836] hover:text-white transition">
                                <span>Konsultasi Pertanyaan Bebas</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Services Catalog (Clicking Card Button Redirects Customer to Fill Form) -->
    <section id="layanan" class="py-20 bg-[#12141a] border-t border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3 reveal-on-scroll">
                <span class="inline-block text-xs font-bold uppercase tracking-wider text-blue-400 px-3.5 py-1 rounded-full bg-blue-950/60 border border-blue-900/40">
                    Katalog Lengkap
                </span>
                <h2 class="text-3xl font-extrabold text-white tracking-tight">
                    9 Layanan Unggulan <span class="text-blue-500">{{ $businessInfo['name'] }}</span>
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base">
                    Pilih layanan di bawah ini. Tombol <strong class="text-zinc-200">"Pesan via WhatsApp"</strong> akan langsung mengarahkan Anda ke formulir pemesanan dengan layanan yang sudah terisi otomatis.
                </p>
            </div>

            <!-- Category Filter Tabs -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-2 reveal-on-scroll" data-delay="100">
                @foreach($categories as $category)
                    <button type="button" 
                            @click="activeCategory = '{{ $category }}'"
                            :class="activeCategory === '{{ $category }}' ? 'bg-blue-600 text-white font-bold shadow-sm' : 'bg-[#181b24] text-zinc-400 hover:text-white hover:bg-[#202534] border border-zinc-800 font-medium'"
                            class="px-4 py-2 rounded-xl text-xs sm:text-sm transition">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <!-- Service Cards Grid -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div x-show="activeCategory === 'Semua' || activeCategory === '{{ $service['category'] }}'"
                         x-transition
                         data-delay="{{ ($loop->index % 3) * 100 }}"
                         class="reveal-on-scroll card-interactive flex flex-col justify-between rounded-2xl bg-[#151821] border border-zinc-800 p-6 hover:border-zinc-700 shadow-xl shadow-black/25 transition group">
                        
                        <div>
                            <!-- Header of Card -->
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-[#1f2432] border border-zinc-800 text-blue-400 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                                    @if($service['icon'] === 'globe-alt')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                    @elseif($service['icon'] === 'device-phone-mobile')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    @elseif($service['icon'] === 'computer-desktop')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @elseif($service['icon'] === 'cpu-chip')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                    @elseif($service['icon'] === 'wrench-screwdriver')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                                    @elseif($service['icon'] === 'speaker-wave')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
                                    @elseif($service['icon'] === 'arrows-right-left')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    @endif
                                </div>

                                <div class="text-right">
                                    <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-[#1e2330] text-zinc-300 border border-zinc-800">
                                        {{ $service['badge'] ?? 'Layanan' }}
                                    </span>
                                    <span class="block text-[11px] text-zinc-500 mt-1">
                                        {{ $service['category'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Title & Description -->
                            <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition">
                                {{ $service['title'] }}
                            </h3>
                            <p class="mt-2 text-sm text-zinc-400 leading-relaxed">
                                {{ $service['short_description'] }}
                            </p>

                            <!-- Features List -->
                            @if(!empty($service['features']))
                                <ul class="mt-4 pt-4 border-t border-zinc-800/80 space-y-1.5">
                                    @foreach($service['features'] as $feature)
                                        <li class="flex items-center gap-2 text-xs text-zinc-400">
                                            <span class="text-blue-400 font-bold">✓</span>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- Tombol Card yang MENGARAHKAN Langsung ke Isi Formulir Chat WhatsApp -->
                        <div class="mt-6 pt-4 border-t border-zinc-800/80">
                            <a href="#konsultasi" 
                               onclick="selectService('{{ addslashes($service['title']) }}')"
                               class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm text-white bg-blue-600 hover:bg-blue-500 shadow-md shadow-blue-900/30 transition hover:-translate-y-0.5 cursor-pointer">
                                <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.199.534 1.286.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.087-.179.182-.077.357.101.174.45 0.742.966 1.201.664.591 1.224.774 1.398.86.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.203.043.072.043.419-.101.824z"/></svg>
                                <span>Pesan via WhatsApp</span>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Keunggulan Layanan Kami (Deep Charcoal Matte Standar Profesional) -->
    <section id="keunggulan" class="py-20 bg-[#0e1015] border-t border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-3 reveal-on-scroll">
                <span class="inline-block text-xs font-semibold uppercase tracking-wider text-blue-400 px-3.5 py-1 rounded-full bg-blue-950/60 border border-blue-900/40">
                    {{ $settings['advantages_eyebrow'] ?? 'Keunggulan Layanan Kami' }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    {{ $settings['advantages_title'] ?? 'Keunggulan Layanan BST TechSolution' }}
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                    {{ $settings['advantages_subtitle'] ?? 'Kami berkomitmen memberikan pelayanan yang jujur, transparan, dan tidak merepotkan Anda.' }}
                </p>
            </div>

            <!-- 4 Kartu Keunggulan Standar & Rapi -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($advantages as $i => $adv)
                    <div data-delay="{{ $i * 100 }}" class="reveal-on-scroll card-interactive rounded-2xl bg-[#151821] border border-zinc-800 p-6 flex flex-col justify-between shadow-xl shadow-black/20 hover:border-zinc-700 transition">
                        
                        <div>
                            <!-- Clean Icon -->
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 border
                                @if($i === 0) bg-blue-950/60 text-blue-400 border-blue-900/40
                                @elseif($i === 1) bg-amber-950/60 text-amber-400 border-amber-900/40
                                @elseif($i === 2) bg-purple-950/60 text-purple-400 border-purple-900/40
                                @else bg-emerald-950/60 text-emerald-400 border-emerald-900/40
                                @endif">
                                @if($i === 0)
                                    <!-- Search / Diagnosa -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                @elseif($i === 1)
                                    <!-- Shield / Sparepart -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                @elseif($i === 2)
                                    <!-- WhatsApp / Chat -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                @else
                                    <!-- Warranty / Badge -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"/></svg>
                                @endif
                            </div>

                            <span class="inline-block px-2.5 py-0.5 rounded text-[11px] font-semibold text-zinc-300 bg-[#1e2330] border border-zinc-800 mb-2">
                                {{ $adv['badge'] }}
                            </span>

                            <h3 class="font-bold text-white text-base mb-2">
                                {{ $adv['title'] }}
                            </h3>

                            <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                                {{ $adv['description'] }}
                            </p>
                        </div>

                        <!-- Clean point at bottom -->
                        <div class="mt-6 pt-4 border-t border-zinc-800/80 flex items-center gap-2 text-xs text-zinc-400">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>{{ $adv['point'] }}</span>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Alur Kerja / Cara Pesan (Deep Charcoal Matte) -->
    <section id="alur" class="py-20 bg-[#12141a] border-t border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto space-y-3 reveal-on-scroll">
                <span class="inline-block text-xs font-semibold uppercase tracking-wider text-blue-400 px-3.5 py-1 rounded-full bg-blue-950/60 border border-blue-900/40">
                    {{ $settings['workflow_eyebrow'] ?? 'Proses Mudah' }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    {{ $settings['workflow_title'] ?? 'Cara Pesan & Konsultasi' }}
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                    {{ $settings['workflow_subtitle'] ?? 'Hanya butuh 4 langkah mudah untuk menyelesaikan kendala gadget atau kebutuhan acara Anda.' }}
                </p>
            </div>

            <!-- 4 Langkah Standar & Bersih -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($workflowSteps as $step)
                    <div data-delay="{{ $loop->index * 100 }}" class="reveal-on-scroll card-interactive rounded-2xl bg-[#151821] border border-zinc-800 p-6 flex flex-col justify-between shadow-xl shadow-black/20 hover:border-zinc-700 transition">
                        <div>
                            <span class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center mb-4 shadow-sm shadow-blue-900/40">
                                {{ $step['step'] }}
                            </span>
                            <h3 class="font-bold text-white text-base mb-2">
                                {{ $step['title'] }}
                            </h3>
                            <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                                {{ $step['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Testimoni Pelanggan -->
    <section id="testimoni" class="py-20 bg-[#0e1015] border-t border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 reveal-on-scroll">
                <span class="inline-block text-xs font-bold uppercase tracking-wider text-blue-400 px-3.5 py-1 rounded-full bg-blue-950/60 border border-blue-900/40">
                    Pengalaman Pelanggan
                </span>
                <h2 class="text-3xl font-extrabold text-white tracking-tight">
                    Apa Kata Mereka?
                </h2>
                <p class="text-zinc-400 text-sm sm:text-base">
                    Ulasan nyata dari pelanggan yang sudah menggunakan layanan BST13 TechSolutions.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($testimonials as $testi)
                    <div data-delay="{{ $loop->index * 100 }}" class="reveal-on-scroll card-interactive rounded-2xl bg-[#151821] border border-zinc-800 p-6 flex flex-col justify-between shadow-xl shadow-black/20 hover:border-zinc-700 transition">
                        <div>
                            <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                                ★★★★★
                            </div>
                            <p class="text-xs sm:text-sm text-zinc-300 italic leading-relaxed">
                                "{{ $testi['comment'] }}"
                            </p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-zinc-800/80">
                            <p class="text-sm font-bold text-white">{{ $testi['name'] }}</p>
                            <p class="text-xs text-zinc-400">{{ $testi['role'] }}</p>
                            <span class="inline-block mt-1 text-[11px] text-blue-400 font-medium">
                                Layanan: {{ $testi['service'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Form Chat WhatsApp Otomatis (Tujuan Diarahkan Saat Pijit Tombol Pesan) -->
    <section id="konsultasi" class="py-20 bg-[#12141a] border-t border-zinc-800/80 scroll-mt-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="form-card" class="rounded-2xl bg-[#151821] border border-zinc-800 p-6 sm:p-10 shadow-2xl shadow-black/60 transition-all duration-300 reveal-on-scroll reveal-scale">
                
                <div class="text-center max-w-xl mx-auto space-y-2 mb-8">
                    <span class="inline-block text-xs font-bold uppercase tracking-wider text-blue-400 px-3.5 py-1 rounded-full bg-blue-950/60 border border-blue-900/40">
                        Kontak Cepat
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                        Formulir Pemesanan WhatsApp
                    </h2>
                    <p class="text-xs sm:text-sm text-zinc-400">
                        Lengkapi nama dan rincian kebutuhan Anda. Saat tombol ditekan, website akan langsung membuka WhatsApp teknisi (<strong class="text-white">+62 858-6177-3230</strong>) dengan draf pesan otomatis.
                    </p>
                </div>

                <!-- Notifikasi Dinamis Saat Layanan Dipilih dari Kartu -->
                <div id="service-notice" class="hidden mb-6 p-4 rounded-xl bg-blue-950/70 border border-blue-800/70 items-center justify-between text-xs text-blue-200 shadow-sm transition-all">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span>
                        <span id="service-notice-text" class="font-semibold text-blue-100"></span>
                    </div>
                    <button type="button" onclick="document.getElementById('service-notice').classList.add('hidden')" class="text-blue-300 hover:text-white font-bold ml-2 text-sm px-1.5 py-0.5 rounded">✕</button>
                </div>

                <form action="{{ route('consult') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">Nama Lengkap *</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   required 
                                   placeholder="Contoh: Andi Wijaya"
                                   class="w-full px-4 py-3 rounded-xl bg-[#0c0e14] border border-zinc-800 text-white placeholder-zinc-500 text-sm focus:bg-[#10121a] focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 shadow-inner transition">
                        </div>
                        <div>
                            <label for="phone" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">No. WhatsApp / HP</label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone" 
                                   placeholder="Contoh: 0812xxxxxxxx"
                                   class="w-full px-4 py-3 rounded-xl bg-[#0c0e14] border border-zinc-800 text-white placeholder-zinc-500 text-sm focus:bg-[#10121a] focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 shadow-inner transition">
                        </div>
                    </div>

                    <div>
                        <label for="service" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">Layanan yang Ingin Dipesan *</label>
                        <select name="service" 
                                id="service" 
                                required
                                class="w-full px-4 py-3 rounded-xl bg-[#0c0e14] border border-zinc-800 text-white text-sm focus:bg-[#10121a] focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 shadow-inner transition">
                            <option value="" disabled selected class="text-zinc-500">-- Pilih Layanan --</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc['title'] }}" class="bg-[#12141a] text-white">
                                    {{ $svc['title'] }} ({{ $svc['category'] }})
                                </option>
                            @endforeach
                            <option value="Tanya Lainnya / Konsultasi Bebas" class="bg-[#12141a] text-white">Tanya Lainnya / Konsultasi Bebas</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">Ceritakan Kerusakan / Kebutuhan</label>
                        <textarea name="message" 
                                  id="message" 
                                  rows="3" 
                                  placeholder="Tuliskan kendala perangkat, tipe HP/laptop, spesifikasi PC yang diinginkan, atau tanggal acara untuk sound system..."
                                  class="w-full px-4 py-3 rounded-xl bg-[#0c0e14] border border-zinc-800 text-white placeholder-zinc-500 text-sm focus:bg-[#10121a] focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 shadow-inner transition"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full py-3.5 px-6 rounded-xl font-bold text-white text-sm bg-blue-600 hover:bg-blue-500 shadow-md shadow-blue-900/30 transition flex items-center justify-center gap-2 hover:-translate-y-0.5">
                        <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.199.534 1.286.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.087-.179.182-.077.357.101.174.45 0.742.966 1.201.664.591 1.224.774 1.398.86.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.203.043.072.043.419-.101.824z"/></svg>
                        <span>Kirim Pesan Otomatis ke WhatsApp</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Banner Ajakan Konsultasi -->
    <section class="py-14 bg-[#0e1015] border-t border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-blue-950 via-[#131b2e] to-indigo-950 border border-blue-900/50 p-8 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-black/50 reveal-on-scroll reveal-scale">
                <div>
                    <h2 class="text-2xl font-bold text-white">Butuh bantuan cepat atau ingin konsultasi sekarang?</h2>
                    <p class="text-blue-200 text-sm mt-1">Nomor WhatsApp teknisi kami aktif melayani: <strong class="text-white">+62 858-6177-3230</strong></p>
                </div>
                <a href="#konsultasi" 
                   onclick="selectService('Tanya Lainnya / Konsultasi Bebas')"
                   class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-500 shadow-md shadow-blue-900/40 transition shrink-0 hover:-translate-y-0.5">
                    <span>Isi Formulir Pemesanan</span>
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Script Mandiri: Garansi Berfungsi Mulus & Teruji -->
<script>
    function selectService(serviceName) {
        // 1. Pilih opsi di dropdown formulir secara instan
        const select = document.getElementById('service');
        if (select) {
            let matched = false;
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].value.trim() === serviceName.trim()) {
                    select.selectedIndex = i;
                    matched = true;
                    break;
                }
            }
            if (!matched) {
                select.value = serviceName;
            }
            select.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // 2. Munculkan kotak notifikasi bahwa layanan sudah terpilih
        const notice = document.getElementById('service-notice');
        const noticeText = document.getElementById('service-notice-text');
        if (notice && noticeText) {
            noticeText.textContent = 'Layanan "' + serviceName + '" telah dipilih! Silakan lengkapi formulir di bawah ini:';
            notice.classList.remove('hidden');
            notice.classList.add('flex');
        }

        // 3. Gulir halaman langsung ke formulir WhatsApp
        const target = document.getElementById('konsultasi');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // 4. Fokuskan kursor ke input nama agar langsung bisa diketik
        setTimeout(function() {
            const formCard = document.getElementById('form-card');
            if (formCard) {
                formCard.classList.add('ring-2', 'ring-blue-500');
                setTimeout(function() {
                    formCard.classList.remove('ring-2', 'ring-blue-500');
                }, 2200);
            }
            const nameInput = document.getElementById('name');
            if (nameInput) {
                nameInput.focus();
            }
        }, 400);
    }
</script>
@endsection
