<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LMS Rabu Belajar - BKPSDM Kota Padang')</title>
    <meta name="description" content="Pusat informasi dan akses satu pintu kegiatan Rabu Belajar bagi ASN Pemerintah Kota Padang. Akses siaran YouTube, Zoom Meeting, materi, absensi, dan e-sertifikat.">
    <meta name="keywords" content="Rabu Belajar, LMS ASN, BKPSDM Padang, Pemkot Padang, Pembelajaran Daring ASN">
    <meta name="author" content="BKPSDM Kota Padang & Diskominfo Kota Padang">

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
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
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-amber-500 selection:text-white flex flex-col min-h-screen">

    <!-- Top Government Notification Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-blue-900/40">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="font-medium text-slate-200">Portal Resmi Pembelajaran Daring ASN Kota Padang</span>
                <span class="hidden md:inline text-slate-500">|</span>
                <span class="hidden md:inline text-slate-400">BKPSDM Kota Padang</span>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <span class="text-slate-300"><span class="text-amber-400 font-medium">Bantuan Teknis:</span> {{ $appSettings['phone'] ?? '(0751) 462209' }}</span>
                <span class="text-slate-600">•</span>
                <a href="{{ route('admin.login') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1 font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Akses Admin
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="transition-transform hover:scale-[1.01]">
                    <x-logo size="md" />
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('schedule') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('schedule') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-blue-700 hover:bg-slate-50' }}">
                        Jadwal Kegiatan
                    </a>
                    <a href="{{ route('home') }}#sop-alur" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-slate-50 transition-colors">
                        Panduan ASN
                    </a>
                    <a href="{{ route('home') }}#kontak" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-slate-50 transition-colors">
                        Kontak & Info
                    </a>
                </nav>

                <!-- Action Button & ASN Profile -->
                <div class="hidden sm:flex items-center gap-3">
                    @if(Auth::guard('asn')->check())
                        <a href="{{ route('my.certificates') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-800 text-xs font-bold border border-blue-200 transition-colors">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.723 1.745 3.42 3.42 0 01-2.812 2.812 3.42 3.42 0 00-1.745.723 3.42 3.42 0 01-3.976 0 3.42 3.42 0 00-1.745-.723 3.42 3.42 0 01-2.812-2.812 3.42 3.42 0 00-.723-1.745 3.42 3.42 0 010-3.976 3.42 3.42 0 00.723-1.745 3.42 3.42 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" /></svg>
                            <span>Sertifikat Saya</span>
                        </a>

                        <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                            <div class="text-right leading-tight">
                                <div class="text-xs font-bold text-slate-800 truncate max-w-[140px]">{{ Auth::guard('asn')->user()->name }}</div>
                                <div class="text-[10px] font-mono text-slate-400">{{ Auth::guard('asn')->user()->nip }}</div>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Keluar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-700 to-indigo-800 text-white text-xs font-bold shadow-md shadow-blue-500/20 hover:from-blue-800 hover:to-indigo-900 transition-all hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            <span>Login ASN / Absensi</span>
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Toggle Button -->
                <div class="flex items-center lg:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="p-2 rounded-lg text-slate-600 hover:text-blue-700 hover:bg-slate-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-5 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-50' }}">
                Beranda
            </a>
            <a href="{{ route('schedule') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('schedule') ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-slate-50' }}">
                Jadwal Kegiatan
            </a>
            <a href="{{ route('home') }}#sop-alur" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-50">
                Panduan ASN
            </a>
            <a href="{{ route('home') }}#kontak" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-50">
                Kontak & Info
            </a>
            @if(Auth::guard('asn')->check())
                <a href="{{ route('my.certificates') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-blue-700 hover:bg-blue-50">
                    Sertifikat Saya
                </a>
            @else
                <div class="pt-2 border-t border-slate-100">
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-700 to-indigo-800 text-white text-sm font-bold shadow-sm hover:from-blue-800 hover:to-indigo-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                        <span>Login ASN / Absensi (SSO)</span>
                    </a>
                </div>
            @endif
            <a href="{{ route('admin.login') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-amber-700 hover:bg-amber-50">
                Login Admin BKPSDM
            </a>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('warning') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-amber-600 hover:text-amber-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="kontak" class="bg-slate-900 text-slate-300 border-t border-slate-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: Identity -->
                <div class="space-y-4 lg:col-span-1">
                    <x-logo size="md" :light="true" />
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ $appSettings['about_summary'] ?? 'Pusat informasi dan sarana akses pembelajaran daring bagi Aparatur Sipil Negara di lingkungan Pemerintah Kota Padang.' }}
                    </p>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-950/70 border border-blue-800/50 text-xs text-blue-300">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Sertifikasi TTD Elektronik BSrE - BSSN</span>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-white">Menu Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('schedule') }}" class="hover:text-amber-400 transition-colors">Jadwal Rabu Belajar</a></li>
                        <li><a href="{{ route('home') }}#sop-alur" class="hover:text-amber-400 transition-colors">SOP & Alur Peserta ASN</a></li>
                        <li><a href="{{ route('admin.login') }}" class="hover:text-amber-400 transition-colors">Portal Pengelola (Admin BKPSDM)</a></li>
                        <li><a href="https://padang.go.id" target="_blank" rel="noopener" class="hover:text-amber-400 transition-colors">Portal Pemkot Padang</a></li>
                    </ul>
                </div>

                <!-- Col 3: Contact Details (From Proposal) -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-white">Alamat Kantor BKPSDM</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ $appSettings['agency_name'] ?? 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia' }}<br>
                        {{ $appSettings['address'] ?? 'Jalan Bagindo Aziz Chan By Pass No.1 Aie Pacah Padang, Kode Pos 25176' }}
                    </p>
                    <div class="text-sm text-slate-400 space-y-1">
                        <p><span class="text-slate-500">Telepon:</span> {{ $appSettings['phone'] ?? '(0751) 462209' }}</p>
                        <p><span class="text-slate-500">Faksimile:</span> {{ $appSettings['fax'] ?? '(0751) 462205' }}</p>
                        <p><span class="text-slate-500">Pos-el:</span> <a href="mailto:{{ $appSettings['email'] ?? 'bkd.pdg@gmail.com' }}" class="text-blue-400 hover:underline">{{ $appSettings['email'] ?? 'bkd.pdg@gmail.com' }}</a></p>
                        <p><span class="text-slate-500">Laman Resmi:</span> <a href="{{ $appSettings['website'] ?? 'https://bkd.padang.go.id' }}" target="_blank" class="text-blue-400 hover:underline">{{ $appSettings['website'] ?? 'bkd.padang.go.id' }}</a></p>
                    </div>
                </div>

                <!-- Col 4: Leadership Info (From Letter) -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-white">Penanggung Jawab</h3>
                    <div class="bg-slate-800/80 border border-slate-700/60 p-4 rounded-xl space-y-2">
                        <div class="text-xs font-semibold uppercase tracking-wider text-amber-400">
                            {{ $appSettings['head_officer_title'] ?? 'Plt. Kepala BKPSDM Kota Padang' }}
                        </div>
                        <div class="text-sm font-bold text-white">
                            {{ $appSettings['head_officer_name'] ?? 'TARMIZI ISMAIL, S.Sos., M.Si' }}
                        </div>
                        <div class="text-xs text-slate-400">
                            NIP. {{ $appSettings['head_officer_nip'] ?? '196803031989021003' }}
                        </div>
                    </div>
                    <div class="text-xs text-slate-500">
                        Didukung dan difasilitasi oleh <strong>Dinas Komunikasi dan Informatika (Diskominfo) Kota Padang</strong>.
                    </div>
                </div>
            </div>

            <!-- Bottom Legal Bar -->
            <div class="border-t border-slate-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} BKPSDM Kota Padang. Seluruh hak cipta dilindungi undang-undang.</p>
                <p>Website LMS Rabu Belajar — Pusat Pembelajaran Daring ASN BerAKHLAK</p>
            </div>
        </div>
    </footer>

</body>
</html>
