@extends('layouts.admin')

@section('title', 'Keunggulan & Cara Pesan - Admin Layout')
@section('page_title', 'Kelola Keunggulan Layanan & Alur Kerja')

@section('content')
<div class="max-w-5xl space-y-8">

    <div class="rounded-2xl bg-slate-900 border border-slate-800 p-5 sm:p-6 text-slate-300 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-lg">
        <div>
            <span class="inline-block px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-blue-600/20 text-blue-300 border border-blue-500/30 mb-2">
                Tata Letak Rapi & Standar
            </span>
            <h2 class="text-lg font-bold text-white">Pengaturan Keunggulan & Cara Pesan</h2>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Atur judul, teks pengantar, 4 kartu keunggulan, serta 4 langkah pemesanan agar mudah dipahami oleh calon pelanggan.
            </p>
        </div>
        <a href="{{ route('home') }}#keunggulan" target="_blank" class="shrink-0 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition flex items-center gap-2">
            <span>Lihat di Web</span>
            <span>↗</span>
        </a>
    </div>

    <form action="{{ route('admin.advantages.post') }}" method="POST" class="space-y-8">
        @csrf

        <!-- 1. Header Section -->
        <div class="rounded-2xl bg-slate-900 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-6">
            <div class="pb-4 border-b border-slate-800">
                <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Bagian 1</span>
                <h3 class="font-bold text-base text-white mt-1">Judul & Pengantar Seksi Keunggulan</h3>
                <p class="text-xs text-slate-400">Teks ini tampil di bagian atas seksi "Keunggulan Layanan".</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="advantages_eyebrow" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        Label Atas (Badge Kategori)
                    </label>
                    <input type="text" id="advantages_eyebrow" name="advantages_eyebrow" 
                           value="{{ old('advantages_eyebrow', $settings['advantages_eyebrow'] ?? 'Keunggulan Layanan Kami') }}" 
                           required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label for="advantages_title" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        Judul Utama Seksi
                    </label>
                    <input type="text" id="advantages_title" name="advantages_title" 
                           value="{{ old('advantages_title', $settings['advantages_title'] ?? 'Keunggulan Layanan BST TechSolution') }}" 
                           required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label for="advantages_subtitle" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Deskripsi Ringkas / Subtitle
                </label>
                <textarea id="advantages_subtitle" name="advantages_subtitle" rows="2" required 
                          class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm focus:border-blue-500 focus:outline-none leading-relaxed">{{ old('advantages_subtitle', $settings['advantages_subtitle'] ?? 'Kami berkomitmen memberikan pelayanan yang jujur, transparan, dan tidak merepotkan Anda.') }}</textarea>
            </div>
        </div>

        <!-- 2. 4 Kartu Keunggulan (Grid Standar) -->
        <div class="rounded-2xl bg-slate-900 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-6">
            <div class="pb-4 border-b border-slate-800">
                <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Bagian 2</span>
                <h3 class="font-bold text-base text-white mt-1">4 Kartu Keunggulan Layanan</h3>
                <p class="text-xs text-slate-400">Atur badge, judul, uraian singkat, dan poin bukti untuk masing-masing kartu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card 1 -->
                <div class="rounded-xl bg-slate-950 border border-slate-800 p-5 space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-850">
                        <span class="text-xs font-bold text-blue-400">Kartu 1 (Diagnosa)</span>
                        <input type="text" name="adv_1_badge" value="{{ old('adv_1_badge', $settings['adv_1_badge'] ?? 'Diagnosa Terbuka') }}" required class="px-2.5 py-1 text-xs font-semibold rounded bg-slate-900 text-slate-200 border border-slate-750 text-right">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Judul Kartu 1</label>
                        <input type="text" name="adv_1_title" value="{{ old('adv_1_title', $settings['adv_1_title'] ?? 'Cek & Diagnosa Transparan') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Deskripsi</label>
                        <textarea name="adv_1_desc" rows="3" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs leading-relaxed">{{ old('adv_1_desc', $settings['adv_1_desc'] ?? 'Pengecekan unit dilakukan terbuka di depan pelanggan. Kerusakan dan opsi perbaikan dijelaskan secara jujur sebelum pengerjaan.') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Poin Keunggulan Bawah</label>
                        <input type="text" name="adv_1_point" value="{{ old('adv_1_point', $settings['adv_1_point'] ?? 'Pengecekan langsung di tempat') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-blue-300 text-xs">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-xl bg-slate-950 border border-slate-800 p-5 space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-850">
                        <span class="text-xs font-bold text-amber-400">Kartu 2 (Sparepart)</span>
                        <input type="text" name="adv_2_badge" value="{{ old('adv_2_badge', $settings['adv_2_badge'] ?? 'Sparepart Teruji') }}" required class="px-2.5 py-1 text-xs font-semibold rounded bg-slate-900 text-slate-200 border border-slate-750 text-right">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Judul Kartu 2</label>
                        <input type="text" name="adv_2_title" value="{{ old('adv_2_title', $settings['adv_2_title'] ?? 'Sparepart Teruji & Berkualitas') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Deskripsi</label>
                        <textarea name="adv_2_desc" rows="3" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs leading-relaxed">{{ old('adv_2_desc', $settings['adv_2_desc'] ?? 'Komponen suku cadang dipilih yang teruji kualitasnya untuk memastikan keawetan perangkat Anda setelah diperbaiki.') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Poin Keunggulan Bawah</label>
                        <input type="text" name="adv_2_point" value="{{ old('adv_2_point', $settings['adv_2_point'] ?? 'Segel fisik terjamin') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-amber-300 text-xs">
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="rounded-xl bg-slate-950 border border-slate-800 p-5 space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-850">
                        <span class="text-xs font-bold text-purple-400">Kartu 3 (Komunikasi)</span>
                        <input type="text" name="adv_3_badge" value="{{ old('adv_3_badge', $settings['adv_3_badge'] ?? 'Fast Respon') }}" required class="px-2.5 py-1 text-xs font-semibold rounded bg-slate-900 text-slate-200 border border-slate-750 text-right">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Judul Kartu 3</label>
                        <input type="text" name="adv_3_title" value="{{ old('adv_3_title', $settings['adv_3_title'] ?? 'Langsung Diskusi via WhatsApp') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Deskripsi</label>
                        <textarea name="adv_3_desc" rows="3" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs leading-relaxed">{{ old('adv_3_desc', $settings['adv_3_desc'] ?? 'Tidak perlu ribet registrasi atau antre lama. Cukup klik pesan layanan, konsultasikan langsung dengan teknisi secara ramah.') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Poin Keunggulan Bawah</label>
                        <input type="text" name="adv_3_point" value="{{ old('adv_3_point', $settings['adv_3_point'] ?? 'Konsultasi ramah teknisi') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-purple-300 text-xs">
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="rounded-xl bg-slate-950 border border-slate-800 p-5 space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-850">
                        <span class="text-xs font-bold text-emerald-400">Kartu 4 (Garansi)</span>
                        <input type="text" name="adv_4_badge" value="{{ old('adv_4_badge', $settings['adv_4_badge'] ?? 'Jaminan Servis') }}" required class="px-2.5 py-1 text-xs font-semibold rounded bg-slate-900 text-slate-200 border border-slate-750 text-right">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Judul Kartu 4</label>
                        <input type="text" name="adv_4_title" value="{{ old('adv_4_title', $settings['adv_4_title'] ?? 'Bergaransi Pengerjaan Nyata') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Deskripsi</label>
                        <textarea name="adv_4_desc" rows="3" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs leading-relaxed">{{ old('adv_4_desc', $settings['adv_4_desc'] ?? 'Setiap pengerjaan hardware, instalasi software, maupun pembuatan website dilindungi jaminan garansi servis.') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1 font-semibold">Poin Keunggulan Bawah</label>
                        <input type="text" name="adv_4_point" value="{{ old('adv_4_point', $settings['adv_4_point'] ?? 'Garansi pengerjaan & nota jelas') }}" required class="w-full px-3.5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-emerald-300 text-xs">
                    </div>
                </div>

            </div>
        </div>

        <!-- 3. Alur & Cara Pesan -->
        <div class="rounded-2xl bg-slate-900 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-6">
            <div class="pb-4 border-b border-slate-800">
                <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Bagian 3</span>
                <h3 class="font-bold text-base text-white mt-1">Alur Kerja & Cara Pemesanan</h3>
                <p class="text-xs text-slate-400">4 langkah mudah bagi pelanggan mulai dari memilih layanan sampai selesai.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Label Atas Alur</label>
                    <input type="text" name="workflow_eyebrow" value="{{ old('workflow_eyebrow', $settings['workflow_eyebrow'] ?? 'Proses Mudah') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Judul Seksi Alur</label>
                    <input type="text" name="workflow_title" value="{{ old('workflow_title', $settings['workflow_title'] ?? 'Cara Pesan & Konsultasi') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Subtitle Alur</label>
                <input type="text" name="workflow_subtitle" value="{{ old('workflow_subtitle', $settings['workflow_subtitle'] ?? 'Hanya butuh 4 langkah mudah untuk menyelesaikan kendala gadget atau kebutuhan acara Anda.') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-800">
                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400">Langkah 01</span>
                    <input type="text" name="workflow_1_title" value="{{ old('workflow_1_title', $settings['workflow_1_title'] ?? 'Pilih Layanan di Web') }}" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs font-bold">
                    <textarea name="workflow_1_desc" rows="2" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">{{ old('workflow_1_desc', $settings['workflow_1_desc'] ?? 'Klik tombol Pesan pada kartu layanan untuk mengisi formulir otomatis.') }}</textarea>
                </div>

                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400">Langkah 02</span>
                    <input type="text" name="workflow_2_title" value="{{ old('workflow_2_title', $settings['workflow_2_title'] ?? 'Konsultasi via WhatsApp') }}" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs font-bold">
                    <textarea name="workflow_2_desc" rows="2" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">{{ old('workflow_2_desc', $settings['workflow_2_desc'] ?? 'Diskusikan gejala kerusakan atau kebutuhan acara bersama teknisi.') }}</textarea>
                </div>

                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400">Langkah 03</span>
                    <input type="text" name="workflow_3_title" value="{{ old('workflow_3_title', $settings['workflow_3_title'] ?? 'Pengerjaan & Pengecekan') }}" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs font-bold">
                    <textarea name="workflow_3_desc" rows="2" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">{{ old('workflow_3_desc', $settings['workflow_3_desc'] ?? 'Bawa unit ke workshop, tunggu di tempat atau kirim brief pengerjaan.') }}</textarea>
                </div>

                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                    <span class="text-xs font-bold text-blue-400">Langkah 04</span>
                    <input type="text" name="workflow_4_title" value="{{ old('workflow_4_title', $settings['workflow_4_title'] ?? 'Uji Fungsi & Bergaransi') }}" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-white text-xs font-bold">
                    <textarea name="workflow_4_desc" rows="2" required class="w-full px-3 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 text-xs">{{ old('workflow_4_desc', $settings['workflow_4_desc'] ?? 'Cek bersama hingga puas sebelum pelunasan dan serah terima nota garansi.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="submit" class="px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Simpan Perubahan Keunggulan & Cara Pesan</span>
            </button>
        </div>

    </form>

</div>
@endsection
