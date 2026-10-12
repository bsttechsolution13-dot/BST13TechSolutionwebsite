@extends('layouts.admin')

@section('title', 'Edit Layanan - Admin Layout')
@section('page_title', 'Edit Layanan: ' . $service->title)

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services') }}" class="text-xs text-slate-400 hover:text-white font-semibold transition">
            ← Kembali ke Daftar Layanan
        </a>
    </div>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="rounded-2xl bg-slate-900/90 border border-slate-800 p-6 sm:p-7 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
            <div>
                <h3 class="font-bold text-base text-white">Form Pengeditan Layanan</h3>
                <p class="text-xs text-slate-400">Slug: <code class="text-blue-300 font-mono">{{ $service->slug }}</code></p>
            </div>
            
            <label class="flex items-center gap-2 cursor-pointer bg-slate-950 px-3.5 py-1.5 rounded-xl border border-slate-800">
                <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="rounded bg-slate-900 border-slate-700 text-blue-600 focus:ring-0">
                <span class="text-xs font-bold text-slate-200">Status Tayang</span>
            </label>
        </div>

        <!-- Title -->
        <div>
            <label for="title" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Nama Layanan</label>
            <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">
        </div>

        <!-- Category & Badge -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="category" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Kategori</label>
                <select id="category" name="category" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $service->category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="badge" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Badge Singkat</label>
                <input type="text" id="badge" name="badge" value="{{ old('badge', $service->badge) }}" placeholder="Contoh: Android & iPhone" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Deskripsi Layanan</label>
            <textarea id="description" name="description" rows="3" required class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm">{{ old('description', $service->description) }}</textarea>
        </div>

        <!-- Features (one per line) -->
        <div>
            <label for="features" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                Poin Fitur / Fasilitas (Satu baris per poin)
            </label>
            <textarea id="features" name="features" rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 text-white text-sm font-mono leading-relaxed" placeholder="Poin 1&#10;Poin 2&#10;Poin 3">{{ old('features', implode("\n", $service->features ?? [])) }}</textarea>
            <p class="text-[11px] text-slate-400 mt-1">Setiap baris baru akan otomatis menjadi centang keunggulan pada kartu layanan.</p>
        </div>

        <!-- Sort Order -->
        <div>
            <label for="sort_order" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Urutan Tampil (Angka)</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-32 px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm">
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
            <a href="{{ route('admin.services') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-white bg-slate-800">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition">
                Simpan Perubahan Layanan
            </button>
        </div>

    </form>

</div>
@endsection
