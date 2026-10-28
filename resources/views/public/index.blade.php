@extends('layouts.app')

@section('title', 'Beranda - LMS Rabu Belajar BKPSDM Kota Padang')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-b from-blue-950 via-slate-900 to-slate-950 text-white pt-12 pb-20 md:py-24">
    <!-- Background Decor / Mesh Grid -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#60a5fa_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Headline & Overview -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Agency Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-blue-700/50 text-blue-200 text-xs font-semibold backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA KOTA PADANG</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight sm:leading-none text-white">
                    Pusat Akses Belajar Daring <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-200">
                        Rabu Belajar ASN Padang
                    </span>
                </h1>

                <!-- Subtitle / Proposal Purpose -->
                <p class="text-base sm:text-lg text-slate-300 max-w-2xl font-normal leading-relaxed">
                    Tingkatkan kapasitas dan kompetensi Aparatur Sipil Negara di lingkungan Pemerintah Kota Padang. Satu pintu untuk mengakses siaran YouTube, Zoom, materi, absensi, hingga e-sertifikat.
                </p>

                <!-- Action CTA & Quick Stats -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    @if($featuredActivity)
                        <a href="{{ route('activities.show', $featuredActivity->slug) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/25 transition-all hover:scale-[1.02]">
                            @if($featuredActivity->status === 'ongoing')
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-600"></span>
                                </span>
                                <span>Ikuti Kegiatan Sedang Berlangsung</span>
                            @else
                                <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span>Lihat Kegiatan Terdekat</span>
                            @endif
                        </a>
                    @endif

                    <a href="#daftar-kegiatan" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-slate-800/80 hover:bg-slate-700/80 text-white font-semibold text-sm border border-slate-700 transition-all">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <span>Eksplorasi Semua Kegiatan</span>
                    </a>
                </div>

                <!-- Fast Metric Counters -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-800 text-center sm:text-left">
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-white">{{ $stats['total'] }}</div>
                        <div class="text-xs text-slate-400 mt-0.5">Total Kegiatan</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ $stats['ongoing'] }}</div>
                        <div class="text-xs text-slate-400 mt-0.5">Sedang Live</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-emerald-400">{{ $stats['completed'] }}</div>
                        <div class="text-xs text-slate-400 mt-0.5">Sesi Tuntas</div>
                    </div>
                </div>
            </div>

            <!-- Right Featured Highlight Card -->
            <div class="lg:col-span-5">
                @if($featuredActivity)
                    <div class="relative rounded-2xl bg-gradient-to-b from-slate-800/90 to-slate-900/95 border border-slate-700/80 p-6 shadow-2xl backdrop-blur-xl">
                        <!-- Top Badge -->
                        <div class="flex items-center justify-between gap-2 mb-4">
                            @if($featuredActivity->status === 'ongoing')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/40 animate-pulse">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    SEDANG BERLANGSUNG
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    AGENDA BERIKUTNYA
                                </span>
                            @endif

                            <span class="text-xs text-slate-400 font-medium">
                                {{ $featuredActivity->formatted_date }}
                            </span>
                        </div>

                        <!-- Title & Theme -->
                        <h2 class="text-xl font-bold text-white leading-snug line-clamp-2 hover:text-amber-300 transition-colors">
                            <a href="{{ route('activities.show', $featuredActivity->slug) }}">
                                {{ $featuredActivity->title }}
                            </a>
                        </h2>

                        <p class="text-xs text-amber-400/90 font-medium mt-1 line-clamp-1">
                            Tema: {{ $featuredActivity->theme }}
                        </p>

                        <div class="mt-4 p-3.5 rounded-xl bg-slate-950/50 border border-slate-800 space-y-2">
                            <!-- Speaker -->
                            <div class="flex items-start gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-blue-600/30 text-blue-300 flex items-center justify-center flex-shrink-0 text-xs font-bold border border-blue-500/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <div class="text-xs">
                                    <div class="font-bold text-slate-200">{{ $featuredActivity->speaker_name }}</div>
                                    <div class="text-slate-400 text-[11px]">{{ $featuredActivity->speaker_title ?? 'Narasumber Tamu' }}</div>
                                </div>
                            </div>

                            <!-- Time & Location -->
                            <div class="flex items-center gap-2 text-xs text-slate-300 pt-1 border-t border-slate-800/80">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>{{ $featuredActivity->formatted_time }}</span>
                                <span class="text-slate-600">•</span>
                                <span class="text-slate-300">Zoom & YouTube Live</span>
                            </div>
                        </div>

                        <!-- Direct 7 Links Quick Preview -->
                        <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
                            @if($featuredActivity->youtube_url)
                                <a href="{{ $featuredActivity->youtube_url }}" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-rose-600/20 hover:bg-rose-600/30 text-rose-300 border border-rose-500/30 flex items-center gap-1.5 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-rose-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                    <span>Live YouTube</span>
                                </a>
                            @endif
                            @if($featuredActivity->zoom_url)
                                <a href="{{ route('activities.show', $featuredActivity->slug) }}#zoom-section" class="px-2.5 py-1.5 rounded-lg bg-blue-600/20 hover:bg-blue-600/30 text-blue-300 border border-blue-500/30 flex items-center gap-1.5 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                    <span>Zoom Meeting</span>
                                </a>
                            @endif
                            @if($featuredActivity->pretest_url)
                                <a href="{{ $featuredActivity->pretest_url }}" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-purple-600/20 hover:bg-purple-600/30 text-purple-300 border border-purple-500/30 flex items-center gap-1.5 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    <span>Pre-Test</span>
                                </a>
                            @endif
                            @if($featuredActivity->google_form_url)
                                <a href="{{ $featuredActivity->google_form_url }}" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-300 border border-emerald-500/30 flex items-center gap-1.5 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>Absen & Post-Test</span>
                                </a>
                            @endif
                        </div>

                        <!-- Open Detail Button -->
                        <div class="mt-5 pt-3 border-t border-slate-800">
                            <a href="{{ route('activities.show', $featuredActivity->slug) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-md transition-all">
                                <span>Buka Halaman Akses Lengkap (7 Fitur)</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

<!-- Filter & Search Section -->
<section id="daftar-kegiatan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-200/80 p-5 md:p-6">
        <form action="{{ route('home') }}#daftar-kegiatan" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            
            <!-- Search Query Input -->
            <div class="md:col-span-6 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul kegiatan, tema, atau narasumber..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>

            <!-- Status Filter -->
            <div class="md:col-span-4">
                <select name="status" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="">Semua Status Kegiatan</option>
                    <option value="ongoing" {{ $statusFilter === 'ongoing' ? 'selected' : '' }}>🔴 Sedang Berlangsung (Live)</option>
                    <option value="upcoming" {{ $statusFilter === 'upcoming' ? 'selected' : '' }}>📅 Akan Datang (Upcoming)</option>
                    <option value="completed" {{ $statusFilter === 'completed' ? 'selected' : '' }}>✅ Telah Selesai (Arsip)</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-semibold text-sm shadow-md transition-all flex items-center justify-center gap-2">
                    <span>Filter</span>
                </button>
                @if($search || $statusFilter)
                    <a href="{{ route('home') }}#daftar-kegiatan" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors" title="Reset Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Activity Grid Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Agenda Kegiatan Rabu Belajar</h2>
            <p class="text-sm text-slate-600 mt-1">Pilih sesi pembelajaran daring untuk mengakses tautan Zoom, YouTube, pre-test, dan sertifikat</p>
        </div>
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            Menampilkan {{ $activities->total() }} kegiatan
        </div>
    </div>

    @if($activities->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($activities as $item)
                <div class="group flex flex-col bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden hover:-translate-y-1">
                    
                    <!-- Card Top Accent Header -->
                    <div class="h-2 bg-gradient-to-r {{ $item->status === 'ongoing' ? 'from-rose-500 to-amber-500' : ($item->status === 'upcoming' ? 'from-blue-600 to-indigo-600' : 'from-slate-400 to-slate-500') }}"></div>

                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Date & Status Badge -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                {{ $item->formatted_date }}
                            </span>

                            @if($item->status === 'ongoing')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping"></span>
                                    Live
                                </span>
                            @elseif($item->status === 'upcoming')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                    Akan Datang
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    Selesai
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors line-clamp-2 leading-snug mb-2">
                            <a href="{{ route('activities.show', $item->slug) }}">
                                {{ $item->title }}
                            </a>
                        </h3>

                        <!-- Theme Tag -->
                        <div class="text-xs font-medium text-blue-800 bg-blue-50/70 rounded-lg p-2.5 mb-4 border border-blue-100/60 line-clamp-2">
                            <span class="font-bold text-blue-900">Tema:</span> {{ $item->theme }}
                        </div>

                        <!-- Speaker Info -->
                        <div class="flex items-center gap-3 pt-2 mb-4 border-t border-slate-100">
                            <div class="w-9 h-9 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div class="text-xs min-w-0">
                                <p class="font-bold text-slate-900 truncate">{{ $item->speaker_name }}</p>
                                <p class="text-slate-500 truncate text-[11px]">{{ $item->speaker_title ?? 'Narasumber' }}</p>
                            </div>
                        </div>

                        <!-- Feature Badges Available -->
                        <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-1.5" title="Ketersediaan Tautan">
                                @if($item->youtube_url)
                                    <span class="p-1 rounded bg-rose-50 text-rose-600 border border-rose-200" title="YouTube Siaran"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg></span>
                                @endif
                                @if($item->zoom_url)
                                    <span class="p-1 rounded bg-blue-50 text-blue-600 border border-blue-200" title="Zoom Meeting"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg></span>
                                @endif
                                @if($item->pretest_url)
                                    <span class="p-1 rounded bg-purple-50 text-purple-600 border border-purple-200" title="Pre-Test"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg></span>
                                @endif
                                @if($item->certificate_url)
                                    <span class="p-1 rounded bg-emerald-50 text-emerald-600 border border-emerald-200" title="E-Sertifikat Tersedia"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg></span>
                                @endif
                            </div>

                            <a href="{{ route('activities.show', $item->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-700 hover:text-blue-900 group-hover:translate-x-1 transition-all">
                                <span>Akses Kegiatan</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $activities->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Tidak ada kegiatan ditemukan</h3>
            <p class="text-sm text-slate-500 mt-1">Coba sesuaikan kata kunci pencarian atau reset filter status Anda.</p>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl bg-blue-700 text-white text-sm font-semibold hover:bg-blue-800 transition-colors">
                    Lihat Semua Kegiatan
                </a>
            </div>
        </div>
    @endif
</section>

<!-- SOP / Alur Penggunaan Website Peserta ASN (Mengacu Halaman 3 Poin 6 Proposal) -->
<section id="sop-alur" class="bg-gradient-to-b from-slate-100 to-slate-200/80 py-16 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold uppercase tracking-wider border border-blue-200">
                Standar Operasional Prosedur (SOP)
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-3">
                Alur Mengikuti Kegiatan Rabu Belajar
            </h2>
            <p class="text-sm text-slate-600 mt-2">
                Tahapan resmi bagi seluruh Aparatur Sipil Negara (ASN) Pemerintah Kota Padang dalam mengikuti pembelajaran daring
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    01
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Buka Website LMS</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Peserta ASN membuka website resmi LMS Rabu Belajar BKPSDM Kota Padang melalui PC, laptop, atau smartphone.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    02
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Pilih Kegiatan & Jadwal</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Pilih sesi kegiatan Rabu Belajar yang sesuai dengan tema kompetensi yang ingin ditingkatkan dan jadwal pelaksanaan.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-purple-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    03
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Kerjakan Pre-Test</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Klik tautan Pre-Test untuk mengukur pemahaman awal materi sebelum sesi pemaparan narasumber dimulai.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-blue-700 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    04
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Ikuti Zoom / YouTube</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Login NIP/SSO untuk link Zoom dan pasang Virtual Background resmi, atau simak siaran langsung lewat kanal YouTube resmi.
                </p>
            </div>

            <!-- Step 5 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    05
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Unduh Bahan Belajar</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Akses materi presentasi modul narasumber, slide paparan, dan regulasi pendukung untuk dipelajari mandiri.
                </p>
            </div>

            <!-- Step 6 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-amber-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    06
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Satu Form Terpadu</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Mengisi 1 (satu) Google Form gabungan di akhir acara yang memuat identitas ASN, post-test, absensi kehadiran, dan evaluasi.
                </p>
            </div>

            <!-- Step 7 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 relative">
                <div class="w-10 h-10 rounded-xl bg-teal-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    07
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Akses E-Sertifikat</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Setelah diverifikasi panitia BKPSDM, buka tautan sertifikat digital kegiatan yang tercatat resmi pada portofolio Anda.
                </p>
            </div>

            <!-- Step 8 -->
            <div class="bg-gradient-to-br from-blue-900 to-indigo-950 text-white rounded-2xl p-6 shadow-md border border-blue-800 relative">
                <div class="w-10 h-10 rounded-xl bg-amber-400 text-slate-950 font-extrabold flex items-center justify-center text-sm shadow-md mb-4">
                    ★
                </div>
                <h3 class="text-base font-bold text-white mb-2">Kompetensi Meningkat</h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Mewujudkan ASN Pemerintah Kota Padang yang profesional, kompeten, dan siap melayani masyarakat secara prima.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Callout Banner -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="rounded-3xl bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 p-8 sm:p-12 text-white relative overflow-hidden shadow-2xl border border-blue-800/60">
        <div class="relative z-10 max-w-2xl space-y-4">
            <span class="px-3 py-1 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/40 text-xs font-bold uppercase tracking-wider">
                Kerjasama & Koordinasi
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Dukungan Teknis Pembelajaran Daring ASN
            </h2>
            <p class="text-sm text-slate-300 leading-relaxed">
                Platform ini dikembangkan dan dikelola oleh BKPSDM Kota Padang berkoordinasi dengan Dinas Komunikasi dan Informatika (Diskominfo) Kota Padang sebagai sarana terintegrasi dalam kerangka Sistem Pemerintahan Berbasis Elektronik (SPBE).
            </p>
            <div class="pt-2 flex flex-wrap gap-4">
                <a href="{{ route('schedule') }}" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-md transition-all">
                    Lihat Kalender Rabu Belajar
                </a>
                <a href="#kontak" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/20 transition-all">
                    Hubungi Layanan Pengaduan
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
