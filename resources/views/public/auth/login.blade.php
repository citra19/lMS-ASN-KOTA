@extends('layouts.app')

@section('title', 'Login SSO Peserta ASN - LMS Rabu Belajar BKPSDM Kota Padang')

@section('content')
<section class="py-16 sm:py-20 bg-slate-100 flex-grow flex items-center">
    <div class="max-w-md w-full mx-auto px-4 sm:px-6">
        
        <div class="text-center mb-8">
            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold uppercase tracking-wider border border-blue-200">
                Single Sign-On (SSO) ASN
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-3">
                Login Peserta Rabu Belajar
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                Satu akun untuk seluruh layanan pembelajaran daring ASN Pemerintah Kota Padang (Zoom, Siaran, Pre-Test, Bahan, Evaluasi & E-Sertifikat).
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-xl space-y-6">
            @if(session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('warning'))
                <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-medium flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1.5">
                    <div class="font-bold flex items-center gap-2 text-rose-900">
                        <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Gagal Masuk:</span>
                    </div>
                    @foreach($errors->all() as $error)
                        <p class="text-rose-700 leading-relaxed">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- PRIMARY METHOD: Keycloak SSO Pemko Padang Button -->
            <div class="bg-blue-50/50 rounded-2xl p-4 border border-blue-100">
                <span class="block text-[11px] font-extrabold uppercase tracking-wider text-blue-800 mb-2">Jalur Resmi Utama (Rekomendasi):</span>
                <a href="{{ route('keycloak.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 py-3.5 px-5 rounded-2xl bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-800 hover:from-blue-800 hover:to-indigo-900 text-white font-bold text-sm shadow-lg shadow-blue-500/25 transition-all hover:scale-[1.01] border border-blue-600/30">
                    <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    <span>Masuk dengan SSO ASN Pemko Padang</span>
                </a>
                <p class="text-[11px] text-center text-slate-500 mt-2">
                    Menggunakan NIP & Sandi akun resmi Pemko Padang (terhubung ke <code>{{ parse_url(config('services.keycloak.base_url', 'https://sso.pdg.web.id'), PHP_URL_HOST) }}</code>). Tidak perlu daftar baru.
                </p>
            </div>


            <!-- Divider -->
            <div class="relative flex items-center justify-center">
                <div class="border-t border-slate-200 w-full"></div>
                <span class="bg-white px-3 text-[11px] text-slate-400 uppercase font-semibold">atau login database lokal</span>
            </div>

            <!-- SECONDARY METHOD: NIP & Password Login -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nip" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nomor Induk Pegawai (NIP)</label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required maxlength="18" placeholder="Contoh: 198507152010011012" class="w-full px-4 py-2.5 bg-slate-50 border {{ $errors->has('nip') ? 'border-rose-400 bg-rose-50/50' : 'border-slate-300' }} rounded-xl text-sm font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    @error('nip')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Kata Sandi</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 bg-slate-50 border {{ $errors->has('password') ? 'border-rose-400 bg-rose-50/50' : 'border-slate-300' }} rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    @error('password')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                        <span>Ingat di peramban ini</span>
                    </label>
                </div>

                <div class="pt-1">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs transition-colors">
                        Masuk dengan NIP & Sandi
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-slate-100 text-center space-y-2">
                <p class="text-xs text-slate-500">Belum terdaftar di database lokal LMS?</p>
                <a href="{{ route('register') }}" class="inline-block text-xs font-bold text-blue-700 hover:text-blue-900 hover:underline">
                    Daftar / Aktivasi Data ASN Baru &rarr;
                </a>
            </div>

            <div class="pt-3 border-t border-slate-100 text-center">
                <span class="text-xs text-slate-500">Pengelola / Panitia BKPSDM?</span>
                <a href="{{ route('admin.login') }}" class="inline-block text-xs font-bold text-indigo-700 hover:text-indigo-900 hover:underline ml-1">
                    Masuk ke Portal Admin &rarr;
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
