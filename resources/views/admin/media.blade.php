@extends('layouts.admin')

@section('title', 'Galeri Media & Background - Admin Layout')
@section('page_title', 'Galeri Media & Background Jasa')

@section('content')
<div class="space-y-8">

    <!-- Overview Card -->
    <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-2">
        <h3 class="font-bold text-base text-white">Koleksi Background Jasa Teknologi</h3>
        <p class="text-xs text-slate-400">
            Berikut adalah gambar-gambar suasana workshop servis & reparasi teknologi yang dapat Anda pasang sebagai latar belakang di area Hero website.
        </p>
    </div>

    <!-- Backgrounds Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($presetBackgrounds as $path => $meta)
            <div class="rounded-2xl bg-slate-900/90 border border-slate-800 overflow-hidden shadow-xl space-y-4 p-5 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="h-56 rounded-xl overflow-hidden relative border border-slate-800">
                        <img src="{{ asset($path) }}" alt="{{ $meta['title'] }}" class="w-full h-full object-cover">
                        @if(($settings['hero_bg_image'] ?? '') === $path)
                            <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-blue-600 text-white font-bold text-xs shadow-md shadow-blue-900/50 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                Background Aktif
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-base text-white">{{ $meta['title'] }}</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">{{ $meta['description'] }}</p>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-800 flex items-center justify-between">
                    <code class="text-[11px] font-mono text-slate-400 truncate max-w-[200px]">{{ $path }}</code>
                    
                    @if(($settings['hero_bg_image'] ?? '') === $path)
                        <span class="px-3.5 py-1.5 rounded-lg bg-emerald-950/80 text-emerald-300 border border-emerald-800 font-bold text-xs">
                            ✓ Sedang Dipakai
                        </span>
                    @else
                        <form action="{{ route('admin.hero.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hero_bg_selection" value="{{ $path }}">
                            <input type="hidden" name="show_hero_bg" value="1">
                            <input type="hidden" name="hero_bg_opacity" value="{{ $settings['hero_bg_opacity'] ?? 35 }}">
                            <input type="hidden" name="hero_headline" value="{{ $settings['hero_headline'] ?? '' }}">
                            <input type="hidden" name="hero_subheadline" value="{{ $settings['hero_subheadline'] ?? '' }}">
                            <input type="hidden" name="hero_badge" value="{{ $settings['hero_badge'] ?? '' }}">
                            <input type="hidden" name="hero_cta_text" value="{{ $settings['hero_cta_text'] ?? 'Pilih Layanan & Pesan' }}">
                            <input type="hidden" name="hero_card_title" value="{{ $settings['hero_card_title'] ?? 'Meja Konsultasi BST13' }}">
                            <input type="hidden" name="hero_card_subtitle" value="{{ $settings['hero_card_subtitle'] ?? 'Respon Cepat & Pengecekan Ramah' }}">
                            <input type="hidden" name="hero_card_point_1_title" value="{{ $settings['hero_card_point_1_title'] ?? '' }}">
                            <input type="hidden" name="hero_card_point_1_desc" value="{{ $settings['hero_card_point_1_desc'] ?? '' }}">
                            <input type="hidden" name="hero_card_point_2_title" value="{{ $settings['hero_card_point_2_title'] ?? '' }}">
                            <input type="hidden" name="hero_card_point_2_desc" value="{{ $settings['hero_card_point_2_desc'] ?? '' }}">
                            <input type="hidden" name="hero_card_point_3_title" value="{{ $settings['hero_card_point_3_title'] ?? '' }}">
                            <input type="hidden" name="hero_card_point_3_desc" value="{{ $settings['hero_card_point_3_desc'] ?? '' }}">
                            
                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs transition">
                                Pakai Background Ini
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Active Logos Preview Card -->
    <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-4">
        <h3 class="font-bold text-base text-white">Logo & Ikon Aktif</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 flex items-center gap-4">
                <img src="{{ asset('images/logo-circle.png') }}" alt="Logo Bulat" class="h-16 w-16 object-contain rounded-full shadow-md">
                <div>
                    <h5 class="font-bold text-sm text-white">Logo Bulat (Header & Favicon)</h5>
                    <p class="text-xs text-slate-400">Dipakai pada tab browser dan samping teks BST TechSolution.</p>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Penuh" class="h-12 w-auto object-contain">
                <div>
                    <h5 class="font-bold text-sm text-white">Logo Transparan Master</h5>
                    <p class="text-xs text-slate-400">Grafis asli dengan teks reparasi teknologi.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
