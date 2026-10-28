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

    <!-- Sidebar Navigation: Clean, Modern & Professional White Theme -->
    <aside class="w-64 bg-white text-slate-700 flex-shrink-0 hidden md:flex md:flex-col border-r border-slate-200 sticky top-0 h-screen z-30 select-none shadow-xs">
        
        <!-- Brand Header: Sleek & Clean White -->
        <div class="h-20 px-5 flex items-center justify-between border-b border-slate-100 bg-white shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-700 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20 shrink-0 text-white">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                        <path d="M6 6h10"></path>
                        <polygon points="12 1 13.5 4 17 4.5 14.5 7 15 10.5 12 9 9 10.5 9.5 7 7 4.5 10.5 4" fill="currentColor" stroke="none" transform="scale(0.5) translate(12, 1)"></polygon>
                    </svg>
                </div>
                <div class="leading-none">
                    <div class="text-[13px] font-extrabold text-slate-900 tracking-tight">RABU BELAJAR</div>
                    <div class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase pt-1">BKPSDM Padang</div>
                </div>
            </div>
            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-blue-50 text-blue-700 border border-blue-200/80 tracking-wider">
                ADMIN
            </span>
        </div>

        <!-- Navigation Links: Clean & Elegant -->
        <nav class="flex-grow p-4 space-y-1 overflow-y-auto">
            
            <!-- Section: Menu Utama -->
            <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-3 pt-2 pb-1.5">
                Menu Utama
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                <span>Dashboard</span>
                @if(request()->routeIs('admin.dashboard'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>

            <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.activities.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.activities.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span>Kelola Kegiatan</span>
                @if(request()->routeIs('admin.activities.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>

            <!-- Section: Peserta & Kehadiran -->
            <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-3 pt-5 pb-1.5">
                Peserta & Pembelajaran
            </div>

            <a href="{{ route('admin.participants.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.participants.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.participants.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <span>Data Peserta ASN</span>
                @if(request()->routeIs('admin.participants.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>

            <a href="{{ route('admin.attendances.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.attendances.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.attendances.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                <span>Rekap Presensi</span>
                @if(request()->routeIs('admin.attendances.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>

            <a href="{{ route('admin.certificates.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.certificates.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.certificates.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.723 1.745 3.42 3.42 0 01-2.812 2.812 3.42 3.42 0 00-1.745.723 3.42 3.42 0 01-3.976 0 3.42 3.42 0 00-1.745-.723 3.42 3.42 0 01-2.812-2.812 3.42 3.42 0 00-.723-1.745 3.42 3.42 0 010-3.976 3.42 3.42 0 00.723-1.745 3.42 3.42 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" /></svg>
                <span>Kelola E-Sertifikat</span>
                @if(request()->routeIs('admin.certificates.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>

            <!-- Section: Konfigurasi & Tautan -->
            <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-3 pt-5 pb-1.5">
                Konfigurasi
            </div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200/80 shadow-xs' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.settings.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span>Pengaturan Website</span>
                @if(request()->routeIs('admin.settings.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-blue-700 hover:bg-slate-50 transition-all duration-200 group">
                <svg class="w-4 h-4 shrink-0 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                <span>Buka Website Publik</span>
                <span class="ml-auto text-slate-400 group-hover:text-blue-600 text-[10px]">&nearr;</span>
            </a>
        </nav>

        <!-- Admin Profile & Compact Logout Card: Executive White Style -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/60 shrink-0">
            <div class="p-3 rounded-2xl bg-white border border-slate-200/80 flex items-center justify-between gap-3 shadow-xs">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-700 to-indigo-600 text-white flex items-center justify-center font-bold text-xs shadow-xs shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0 leading-tight">
                        <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-400 truncate pt-0.5 font-medium">BKPSDM Kota Padang</p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-200 transition-all" title="Keluar (Logout)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    </button>
                </form>
            </div>
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
