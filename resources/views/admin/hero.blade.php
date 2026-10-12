@extends('layouts.admin')

@section('title', 'Hero & Background Jasa - Admin Layout')
@section('page_title', 'Pengaturan Hero & Background Jasa')

@section('content')
<div class="space-y-8">
    
    <form action="{{ route('admin.hero.post') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- SECTION 1: BACKGROUND GAMBAR JASA (Core Feature Requested by User) -->
        <div class="rounded-2xl bg-slate-900/90 border border-blue-900/60 p-6 sm:p-7 shadow-xl shadow-blue-950/40 space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center font-bold text-lg">
                        🖼️
                    </div>
                    <div>
                        <h3 class="font-extrabold text-lg text-white">Background Gambar Jasa Teknologi</h3>
                        <p class="text-xs text-slate-400">Atur gambar workshop/jasa di belakang area Hero dengan overlay navy elegan.</p>
                    </div>
                </div>

                <!-- Enable / Disable Toggle -->
                <label class="flex items-center gap-2.5 cursor-pointer bg-slate-950 px-3.5 py-1.5 rounded-xl border border-slate-800">
                    <input type="checkbox" name="show_hero_bg" value="1" {{ !empty($settings['show_hero_bg']) ? 'checked' : '' }} class="rounded bg-slate-900 border-slate-700 text-blue-600 focus:ring-0">
                    <span class="text-xs font-bold text-slate-200">Aktifkan Background Gambar</span>
                </label>
            </div>

            <!-- Current Background Image Preview -->
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-3">
                    Pilih Preset Gambar Background Jasa:
                </label>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <!-- Preset 1 -->
                    <label class="relative rounded-xl border-2 p-3 cursor-pointer transition block {{ ($settings['hero_bg_image'] ?? '') === 'images/backgrounds/hero-tech-workshop.jpg' ? 'border-blue-500 bg-blue-950/30' : 'border-slate-800 hover:border-slate-700 bg-slate-950' }}">
                        <input type="radio" name="hero_bg_selection" value="images/backgrounds/hero-tech-workshop.jpg" {{ ($settings['hero_bg_image'] ?? '') === 'images/backgrounds/hero-tech-workshop.jpg' ? 'checked' : '' }} class="sr-only">
                        <div class="h-36 rounded-lg overflow-hidden relative mb-2">
                            <img src="{{ asset('images/backgrounds/hero-tech-workshop.jpg') }}" alt="Bengkel PC" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-2.5">
                                <span class="text-xs font-bold text-white">Bengkel PC, Hardware & Coding Liquid Cooling</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs text-slate-300">
                            <span>Suasana Bengkel & Teknisi PC</span>
                            <span class="text-blue-400 font-bold {{ ($settings['hero_bg_image'] ?? '') === 'images/backgrounds/hero-tech-workshop.jpg' ? 'block' : 'hidden' }}">✓ Terpilih</span>
                        </div>
                    </label>

                    <!-- Preset 2 -->
                    <label class="relative rounded-xl border-2 p-3 cursor-pointer transition block {{ ($settings['hero_bg_image'] ?? '') === 'images/backgrounds/hero-phone-repair.jpg' ? 'border-blue-500 bg-blue-950/30' : 'border-slate-800 hover:border-slate-700 bg-slate-950' }}">
                        <input type="radio" name="hero_bg_selection" value="images/backgrounds/hero-phone-repair.jpg" {{ ($settings['hero_bg_image'] ?? '') === 'images/backgrounds/hero-phone-repair.jpg' ? 'checked' : '' }} class="sr-only">
                        <div class="h-36 rounded-lg overflow-hidden relative mb-2">
                            <img src="{{ asset('images/backgrounds/hero-phone-repair.jpg') }}" alt="Servis HP" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-2.5">
                                <span class="text-xs font-bold text-white">Meja Reparasi Handphone & Mikroskop Presisi</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs text-slate-300">
                            <span>Suasana Pengerjaan Servis HP</span>
                            <span class="text-blue-400 font-bold {{ ($settings['hero_bg_image'] ?? '') === 'images/backgrounds/hero-phone-repair.jpg' ? 'block' : 'hidden' }}">✓ Terpilih</span>
                        </div>
                    </label>

                </div>
            </div>

            <!-- Upload Custom Background Image -->
            <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                <label for="hero_bg_file" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                    Atau Unggah Foto Workshop/Jasa Anda Sendiri:
                </label>
                <input type="file" 
                       id="hero_bg_file" 
                       name="hero_bg_file" 
                       accept="image/*"
                       class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer">
                <p class="text-[11px] text-slate-400">Format didukung: JPG, PNG, WEBP (Disarankan rasio landscape 16:9, resolusi min 1280x720px).</p>
            </div>

            <!-- Background Opacity Slider -->
            <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2" x-data="{ opacity: {{ $settings['hero_bg_opacity'] ?? 35 }} }">
                <div class="flex items-center justify-between">
                    <label for="hero_bg_opacity" class="text-xs font-bold text-slate-300 uppercase tracking-wider">
                        Tingkat Opasitas Gambar Background:
                    </label>
                    <span class="text-xs font-mono font-bold text-blue-400" x-text="opacity + '%'"></span>
                </div>
                <input type="range" 
                       id="hero_bg_opacity" 
                       name="hero_bg_opacity" 
                       min="10" 
                       max="80" 
                       step="5"
                       x-model="opacity"
                       class="w-full accent-blue-500 cursor-pointer">
                <p class="text-[11px] text-slate-400">Opasitas 25%-40% disarankan agar teks hero tetap kontras, tajam, dan mudah dibaca.</p>
            </div>

        </div>

        <!-- SECTION 2: TEKS HERO UTAMA -->
        <div class="rounded-2xl bg-slate-900/90 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center font-bold text-lg">
                    ✍️
                </div>
                <div>
                    <h3 class="font-extrabold text-lg text-white">Teks Judul & Headline Hero</h3>
                    <p class="text-xs text-slate-400">Sesuaikan kalimat pembuka website untuk menarik perhatian calon pelanggan.</p>
                </div>
            </div>

            <!-- Badge Pill Text -->
            <div>
                <label for="hero_badge" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Teks Label Badge (Pill di atas judul)
                </label>
                <input type="text" 
                       id="hero_badge" 
                       name="hero_badge" 
                       value="{{ old('hero_badge', $settings['hero_badge'] ?? 'Workshop & Layanan Terpercaya') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm outline-none transition">
            </div>

            <!-- Headline -->
            <div>
                <label for="hero_headline" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Headline Utama (Bisa gunakan kode &lt;span class="text-blue-400"&gt; untuk warna biru)
                </label>
                <input type="text" 
                       id="hero_headline" 
                       name="hero_headline" 
                       value="{{ old('hero_headline', $settings['hero_headline'] ?? 'Solusi Kebutuhan <span class="text-blue-400">IT, Gadget</span> & Audio dalam Satu Tempat.') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm font-semibold outline-none transition">
            </div>

            <!-- Subheadline -->
            <div>
                <label for="hero_subheadline" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Subheadline / Paragraf Deskripsi Singkat
                </label>
                <textarea id="hero_subheadline" 
                          name="hero_subheadline" 
                          rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm outline-none transition">{{ old('hero_subheadline', $settings['hero_subheadline'] ?? 'Melayani servis HP & laptop, rakit PC custom, pembuatan website bisnis, sewa sound system acara, hingga instalasi OS. Konsultasikan kendala Anda langsung dengan teknisi kami via WhatsApp.') }}</textarea>
            </div>

            <!-- CTA Button Text -->
            <div>
                <label for="hero_cta_text" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Teks Tombol Aksi (CTA)
                </label>
                <input type="text" 
                       id="hero_cta_text" 
                       name="hero_cta_text" 
                       value="{{ old('hero_cta_text', $settings['hero_cta_text'] ?? 'Pilih Layanan & Pesan') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm outline-none transition">
            </div>

            <!-- 3 Trust Points -->
            <div class="pt-4 border-t border-slate-800 space-y-3">
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                    3 Poin Kepercayaan (Trust Badges di bawah teks):
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <input type="text" name="hero_trust_1" value="{{ old('hero_trust_1', $settings['hero_trust_1'] ?? 'Konsultasi Bebas Biaya') }}" class="px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white text-xs" placeholder="Poin 1">
                    <input type="text" name="hero_trust_2" value="{{ old('hero_trust_2', $settings['hero_trust_2'] ?? 'Diagnosa Terbuka & Jujur') }}" class="px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white text-xs" placeholder="Poin 2">
                    <input type="text" name="hero_trust_3" value="{{ old('hero_trust_3', $settings['hero_trust_3'] ?? 'Garansi Pengerjaan Nyata') }}" class="px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white text-xs" placeholder="Poin 3">
                </div>
            </div>

        </div>

        <!-- SECTION 3: KARTU KANAN (MEJA KONSULTASI) -->
        <div class="rounded-2xl bg-slate-900/90 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center font-bold text-lg">
                    🪪
                </div>
                <div>
                    <h3 class="font-extrabold text-lg text-white">Kartu Meja Konsultasi (Sisi Kanan Hero)</h3>
                    <p class="text-xs text-slate-400">Atur judul dan 3 poin keunggulan pada kartu meja informasi di sisi kanan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Judul Kartu</label>
                    <input type="text" name="hero_card_title" value="{{ old('hero_card_title', $settings['hero_card_title'] ?? 'Meja Konsultasi BST13') }}" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Subjudul Kartu</label>
                    <input type="text" name="hero_card_subtitle" value="{{ old('hero_card_subtitle', $settings['hero_card_subtitle'] ?? 'Respon Cepat & Pengecekan Ramah') }}" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
                </div>
            </div>

            <!-- 3 Highlights -->
            <div class="space-y-4 pt-2">
                <!-- Highlight 1 -->
                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400 uppercase">Poin Sorotan 1:</span>
                    <input type="text" name="hero_card_point_1_title" value="{{ old('hero_card_point_1_title', $settings['hero_card_point_1_title'] ?? 'Pilih Layanan, Formulir Langsung Terisi') }}" class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs mb-1">
                    <input type="text" name="hero_card_point_1_desc" value="{{ old('hero_card_point_1_desc', $settings['hero_card_point_1_desc'] ?? 'Pijit tombol pada kartu layanan mana pun, form langsung terisi otomatis.') }}" class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">
                </div>

                <!-- Highlight 2 -->
                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400 uppercase">Poin Sorotan 2:</span>
                    <input type="text" name="hero_card_point_2_title" value="{{ old('hero_card_point_2_title', $settings['hero_card_point_2_title'] ?? 'Bisa Ditunggu / Janji Temu') }}" class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs mb-1">
                    <input type="text" name="hero_card_point_2_desc" value="{{ old('hero_card_point_2_desc', $settings['hero_card_point_2_desc'] ?? 'Ganti baterai, LCD, dan install OS dapat ditunggu di workshop.') }}" class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">
                </div>

                <!-- Highlight 3 -->
                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400 uppercase">Poin Sorotan 3:</span>
                    <input type="text" name="hero_card_point_3_title" value="{{ old('hero_card_point_3_title', $settings['hero_card_point_3_title'] ?? 'Tanpa Biaya Sebelum Disepakati') }}" class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs mb-1">
                    <input type="text" name="hero_card_point_3_desc" value="{{ old('hero_card_point_3_desc', $settings['hero_card_point_3_desc'] ?? 'Pemeriksaan unit dan estimasi biaya dikonfirmasi terlebih dahulu.') }}" class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">
                </div>
            </div>

        </div>

        <!-- Sticky Save Button -->
        <div class="sticky bottom-6 z-20 flex items-center justify-between p-4 rounded-2xl bg-slate-900/95 border border-blue-900/60 shadow-2xl backdrop-blur">
            <span class="text-xs text-slate-400 hidden sm:inline">Perubahan akan langsung tayang pada halaman landing page.</span>
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <a href="{{ route('home') }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 transition">
                    Buka Preview
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5">
                    💾 Simpan Perubahan Hero
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
