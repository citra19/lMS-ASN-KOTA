<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengelola Website - LMS Rabu Belajar BKPSDM Kota Padang</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 min-h-screen flex items-center justify-center p-4 selection:bg-amber-500 selection:text-white">

    <div class="w-full max-w-md">
        <!-- Brand Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md mb-4 shadow-xl">
                <x-logo size="lg" :light="true" />
            </div>
            <h1 class="text-xl font-extrabold text-white">Login Admin Pengelola</h1>
            <p class="text-xs text-slate-400 mt-1">Sistem Manajemen Konten LMS Rabu Belajar BKPSDM Kota Padang</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-slate-200/80">
            @if(session('info'))
                <div class="mb-5 p-3.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs font-medium flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium flex items-center gap-2">
                    <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Alamat Email Pengelola</label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@bkpsdm.padang.go.id') }}" required autofocus class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all font-medium text-slate-800" placeholder="nama@bkpsdm.padang.go.id">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" id="password" name="password" value="admin123" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-300 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all font-medium text-slate-800" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-blue-700 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-bold text-sm shadow-lg shadow-blue-500/25 transition-all hover:scale-[1.01]">
                        Masuk ke Panel Pengelolaan
                    </button>
                </div>
            </form>

            <!-- Quick Demo Credentials Box -->
            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                <div class="text-[11px] font-semibold text-slate-500 mb-1">Kredensial Default BKPSDM:</div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 text-[11px] font-mono text-slate-700">
                    <span>admin@bkpsdm.padang.go.id</span> | <span>admin123</span>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white transition-colors inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                <span>Kembali ke Halaman Peserta ASN</span>
            </a>
        </div>
    </div>

</body>
</html>
