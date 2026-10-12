@extends('layouts.admin')

@section('title', 'Katalog Layanan - Admin Layout')
@section('page_title', 'Kelola 9 Katalog Layanan')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-5 rounded-2xl bg-slate-900/90 border border-slate-800">
        <div>
            <h3 class="font-bold text-base text-white">Daftar Layanan & Jasa</h3>
            <p class="text-xs text-slate-400">Setiap perubahan judul, deskripsi, atau fitur poin akan langsung muncul pada kartu layanan di landing page.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition flex items-center gap-2">
            <span>+ Tambah Layanan Baru</span>
        </a>
    </div>

    <!-- Services Grid/List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($services as $service)
            <div class="p-5 rounded-2xl bg-slate-900/80 border {{ $service->is_active ? 'border-slate-800 hover:border-blue-900/80' : 'border-rose-950/60 opacity-60' }} transition flex flex-col justify-between space-y-4">
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wider uppercase bg-blue-950 text-blue-300 border border-blue-800/80">
                            {{ $service->category }}
                        </span>
                        @if($service->badge)
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-800 text-slate-300">
                                {{ $service->badge }}
                            </span>
                        @endif
                    </div>

                    <div>
                        <h4 class="font-bold text-base text-white">{{ $service->title }}</h4>
                        <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $service->description }}</p>
                    </div>

                    @if(!empty($service->features))
                        <div class="pt-2 border-t border-slate-800/80 space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Poin Fitur ({{ count($service->features) }}):</span>
                            <ul class="text-xs text-slate-300 space-y-0.5">
                                @foreach(array_slice($service->features, 0, 3) as $feat)
                                    <li class="flex items-center gap-1.5 truncate">
                                        <span class="text-blue-400 text-[10px]">✓</span>
                                        <span class="truncate">{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="pt-3 border-t border-slate-800 flex items-center justify-between text-xs">
                    <span class="{{ $service->is_active ? 'text-emerald-400' : 'text-rose-400' }} font-semibold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full {{ $service->is_active ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                        {{ $service->is_active ? 'Tayang Aktif' : 'Non-aktif' }}
                    </span>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.services.edit', $service) }}" class="px-3 py-1.5 rounded-lg bg-blue-950/80 hover:bg-blue-900 text-blue-300 border border-blue-900/60 font-semibold transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.services.delete', $service) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-slate-950 hover:bg-rose-950 text-slate-400 hover:text-rose-300 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>
@endsection
