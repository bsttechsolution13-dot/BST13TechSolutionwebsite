@extends('layouts.admin')

@section('title', 'Kontak & Workshop - Admin Layout')
@section('page_title', 'Informasi Bisnis, Kontak & Workshop')

@section('content')
<div class="max-w-3xl space-y-6">

    <form action="{{ route('admin.business.post') }}" method="POST" class="rounded-2xl bg-slate-900/90 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-6">
        @csrf

        <div class="pb-4 border-b border-slate-800">
            <h3 class="font-bold text-base text-white">Pengaturan Identitas & Kontak WhatsApp</h3>
            <p class="text-xs text-slate-400">Semua nomor WhatsApp dan alamat workshop di navbar, tombol chat, dan footer akan otomatis tersinkronisasi.</p>
        </div>

        <!-- Business Name & Tagline -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="business_name" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Nama Brand Bisnis</label>
                <input type="text" id="business_name" name="business_name" value="{{ old('business_name', $settings['business_name'] ?? 'BST TechSolution') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
            </div>

            <div>
                <label for="business_tagline" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Tagline Bisnis</label>
                <input type="text" id="business_tagline" name="business_tagline" value="{{ old('business_tagline', $settings['business_tagline'] ?? 'Solusi Kebutuhan IT, Gadget, & Audio Terpercaya') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="business_description" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Deskripsi Singkat Toko / Workshop</label>
            <textarea id="business_description" name="business_description" rows="3" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">{{ old('business_description', $settings['business_description'] ?? 'Pusat layanan teknologi dan audio terpercaya...') }}</textarea>
        </div>

        <!-- WhatsApp Numbers -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-800">
            <div>
                <label for="business_whatsapp" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Nomor WhatsApp Teknis (Format Angka 62...)
                </label>
                <input type="text" id="business_whatsapp" name="business_whatsapp" value="{{ old('business_whatsapp', $settings['business_whatsapp'] ?? '6285861773230') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white font-mono text-sm" placeholder="6285861773230">
                <p class="text-[11px] text-slate-400 mt-1">Digunakan untuk direct link <code class="text-blue-300 font-mono">wa.me/62...</code></p>
            </div>

            <div>
                <label for="business_whatsapp_display" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Nomor WhatsApp Tampilan (Format Cantik)
                </label>
                <input type="text" id="business_whatsapp_display" name="business_whatsapp_display" value="{{ old('business_whatsapp_display', $settings['business_whatsapp_display'] ?? '+62 858-6177-3230') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white font-mono text-sm" placeholder="+62 858-6177-3230">
                <p class="text-[11px] text-slate-400 mt-1">Ditampilkan pada navbar, footer, dan kartu meja konsultasi.</p>
            </div>
        </div>

        <!-- Address & Hours -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-800">
            <div>
                <label for="business_address" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Lokasi / Keterangan Workshop</label>
                <input type="text" id="business_address" name="business_address" value="{{ old('business_address', $settings['business_address'] ?? 'Workshop BST13 Tech - Layanan Cepat & Janji Temu') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
            </div>

            <div>
                <label for="business_operating_hours" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Jam Buka / Operasional</label>
                <input type="text" id="business_operating_hours" name="business_operating_hours" value="{{ old('business_operating_hours', $settings['business_operating_hours'] ?? 'Senin - Sabtu: 09.00 - 21.00 WIB (Fast Respon via WA)') }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-800 flex items-center justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition">
                Simpan Informasi Kontak
            </button>
        </div>

    </form>

</div>
@endsection
