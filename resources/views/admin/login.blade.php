<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Layout - BST TechSolution</title>
    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b1329] text-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Subtle background glow -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Header Brand -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group mb-4">
                <img src="{{ asset('images/logo-circle.png') }}" alt="BST Logo" class="h-14 w-14 object-contain rounded-full shadow-lg shadow-blue-900/50 hover:scale-105 transition">
                <div class="text-left">
                    <span class="font-extrabold text-2xl text-white block leading-tight">
                        BST <span class="text-blue-400">TechSolution</span>
                    </span>
                    <span class="text-xs text-slate-400">Panel Khusus Admin Layout</span>
                </div>
            </a>
            <p class="text-sm text-slate-400">Masuk untuk mengatur teks, background gambar, dan katalog layanan.</p>
        </div>

        <!-- Login Card -->
        <div class="rounded-2xl bg-slate-900/90 border border-blue-900/60 p-7 sm:p-8 shadow-2xl shadow-blue-950/80">
            
            @if(session('error'))
                <div class="p-3.5 rounded-xl bg-rose-950/80 border border-rose-800 text-rose-200 text-xs mb-5">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-950/80 border border-emerald-800 text-emerald-200 text-xs mb-5">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        Email Admin
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', 'admin@bst13.com') }}" 
                           required 
                           class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-white placeholder-slate-500 text-sm outline-none transition"
                           placeholder="admin@bst13.com">
                    @error('email')
                        <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                        Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           value="admin123"
                           required 
                           class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-white placeholder-slate-500 text-sm outline-none transition"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-300">
                        <input type="checkbox" name="remember" checked class="rounded bg-slate-950 border-slate-800 text-blue-600 focus:ring-0">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl font-bold text-sm text-white bg-blue-600 hover:bg-blue-500 shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5">
                    Masuk ke Panel Layout
                </button>
            </form>

            <!-- Quick Credential Helper Note -->
            <div class="mt-6 pt-5 border-t border-slate-800/80 text-center">
                <p class="text-xs text-slate-400">
                    Akses Default Admin: <br>
                    <code class="text-blue-300 bg-blue-950/80 px-2 py-0.5 rounded text-[11px] font-mono">admin@bst13.com</code> / 
                    <code class="text-blue-300 bg-blue-950/80 px-2 py-0.5 rounded text-[11px] font-mono">admin123</code>
                </p>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
                ← Kembali ke Halaman Utama Website
            </a>
        </div>
    </div>

</body>
</html>
