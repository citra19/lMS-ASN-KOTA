<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - LMS Rabu Belajar')</title>

    <!-- Google Fonts -->
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
<body class="bg-slate-100 text-slate-800 antialiased flex min-h-screen">

    <!-- Sidebar Navigation: Sticky Pinned to Viewport -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex md:flex-col border-r border-slate-800 sticky top-0 h-screen z-30">
        <!-- Brand Header -->
        <div class="h-20 px-6 flex items-center border-b border-slate-800 bg-slate-950/40 shrink-0">
            <x-logo size="sm" :light="true" />
        </div>


        <!-- Navigation Links -->
        <nav class="flex-grow p-4 space-y-1.5 overflow-y-auto">
            <div class="text-[11px] font-bold uppercase tracking-wider text-slate-500 px-3 py-2">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.activities.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                <span>Kelola Kegiatan</span>
            </a>

            <div class="text-[11px] font-bold uppercase tracking-wider text-slate-500 px-3 pt-4 pb-1">Peserta & Presensi</div>

            <a href="{{ route('admin.participants.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.participants.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <span>Data Peserta ASN</span>
            </a>

            <a href="{{ route('admin.attendances.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.attendances.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                <span>Rekap Presensi Sesi</span>
            </a>

            <a href="{{ route('admin.certificates.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.certificates.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.723 1.745 3.42 3.42 0 01-2.812 2.812 3.42 3.42 0 00-1.745.723 3.42 3.42 0 01-3.976 0 3.42 3.42 0 00-1.745-.723 3.42 3.42 0 01-2.812-2.812 3.42 3.42 0 00-.723-1.745 3.42 3.42 0 010-3.976 3.42 3.42 0 00.723-1.745 3.42 3.42 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" /></svg>
                <span>Kelola E-Sertifikat</span>
            </a>

            <div class="text-[11px] font-bold uppercase tracking-wider text-slate-500 px-3 pt-6 pb-2">Konfigurasi</div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span>Pengaturan Website</span>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-slate-800 text-slate-300 hover:text-white">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                <span>Buka Website Publik</span>
            </a>
        </nav>

        <!-- Admin Profile & Logout -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/30 shrink-0">
            <div class="flex items-center gap-3 mb-3">

                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                    {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-[11px] text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@bkpsdm.padang.go.id' }}</p>
                </div>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-lg bg-rose-600/20 hover:bg-rose-600/30 text-rose-300 border border-rose-500/30 text-xs font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 sm:px-8 flex items-center justify-between shadow-xs sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-bold text-slate-900">@yield('page-title', 'Dashboard Admin')</h1>
            </div>

            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Sistem Aktif
                </span>
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 hover:text-blue-900 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 transition-colors">
                    <span>Lihat Web</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
            </div>
        </header>

        <!-- Alerts -->
        @if(session('success'))
            <div class="px-6 sm:px-8 pt-6">
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="px-6 sm:px-8 pt-6">
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Content Area -->
        <main class="p-6 sm:p-8 flex-grow">
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="bg-white border-t border-slate-200 px-6 sm:px-8 py-4 text-xs text-slate-500 flex justify-between items-center">
            <span>&copy; {{ date('Y') }} BKPSDM Kota Padang - Panel Pengelolaan Website LMS</span>
            <span>v1.0.0 (Production Ready)</span>
        </footer>
    </div>

</body>
</html>
