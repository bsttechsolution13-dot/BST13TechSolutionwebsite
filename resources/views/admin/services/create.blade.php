@extends('layouts.admin')

@section('title', 'Tambah Layanan Baru - Admin Layout')
@section('page_title', 'Tambah Layanan Baru')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services') }}" class="text-xs text-slate-400 hover:text-white font-semibold transition">
            ← Kembali ke Daftar Layanan
        </a>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" class="rounded-2xl bg-slate-900/90 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-6">
        @csrf

        <div class="pb-4 border-b border-slate-800">
            <h3 class="font-bold text-base text-white">Form Penambahan Layanan Baru</h3>
            <p class="text-xs text-slate-400">Layanan yang ditambahkan akan otomatis muncul di filter kategori dan formulir konsultasi WA.</p>
        </div>

        <!-- Title -->
        <div>
            <label for="title" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Nama Layanan</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Servis Keyboard Laptop" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">
        </div>

        <!-- Category & Badge -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="category" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Kategori</label>
                <select id="category" name="category" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="badge" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Badge Singkat</label>
                <input type="text" id="badge" name="badge" value="{{ old('badge') }}" placeholder="Contoh: Garansi 3 Bulan" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Deskripsi Layanan</label>
            <textarea id="description" name="description" rows="3" required placeholder="Jelaskan jenis perbaikan, estimasi pengerjaan, dan kelebihannya..." class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">{{ old('description') }}</textarea>
        </div>

        <!-- Features (one per line) -->
        <div>
            <label for="features" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                Poin Fitur / Fasilitas (Satu baris per poin)
            </label>
            <textarea id="features" name="features" rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm font-mono leading-relaxed" placeholder="Pengecekan Gratis&#10;Sparepart Bergaransi&#10;Bisa Ditunggu">{{ old('features') }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
            <a href="{{ route('admin.services') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-white bg-slate-800">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition">
                + Tambahkan Layanan
            </button>
        </div>

    </form>

</div>
@endsection
