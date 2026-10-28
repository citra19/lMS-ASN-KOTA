@extends('layouts.app')

@section('title', $activity->title . ' - LMS Rabu Belajar BKPSDM Kota Padang')

@section('content')
<!-- Header Kegiatan: Bersih, Modern & Proporsional -->
<section class="bg-gradient-to-br from-slate-900 via-slate-900 to-blue-950 text-white border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        
        <!-- Breadcrumb Ringkas -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-5">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('schedule') }}" class="hover:text-amber-400 transition-colors">Jadwal</a>
            <span>/</span>
            <span class="text-slate-300 font-medium truncate max-w-xs sm:max-w-md">{{ $activity->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
            <!-- Informasi Utama -->
            <div class="lg:col-span-8 space-y-3.5">
                <!-- Badges Waktu & Status -->
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    @if($activity->status === 'ongoing')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30 animate-pulse">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            SEDANG BERLANGSUNG
                        </span>
                    @elseif($activity->status === 'upcoming')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-bold bg-blue-500/20 text-blue-300 border border-blue-500/30">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            AKAN DATANG
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-bold bg-slate-500/20 text-slate-300 border border-slate-500/30">
                            TELAH SELESAI
                        </span>
                    @endif

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-medium bg-white/10 text-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ $activity->formatted_date }}
                    </span>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-medium bg-white/10 text-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $activity->formatted_time }}
                    </span>
                </div>

                <!-- Judul Kegiatan -->
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-white tracking-tight leading-snug">
                    {{ $activity->title }}
                </h1>

                <!-- Tema Kegiatan Ringkas -->
                @if($activity->theme)
                    <p class="text-xs sm:text-sm text-slate-300 flex items-start gap-2">
                        <span class="text-amber-400 font-bold shrink-0">Tema:</span>
                        <span>{{ $activity->theme }}</span>
                    </p>
                @endif
            </div>

            <!-- Kartu Narasumber Minimalis -->
            <div class="lg:col-span-4 bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5 backdrop-blur-sm">
                <div class="text-[11px] font-bold uppercase tracking-wider text-amber-400 mb-2.5 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    <span>Narasumber</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 text-white font-extrabold flex items-center justify-center text-sm shadow-md shrink-0">
                        {{ strtoupper(substr($activity->speaker_name ?? 'N', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-sm font-bold text-white truncate">{{ $activity->speaker_name }}</div>
                        <div class="text-xs text-slate-300 truncate">{{ $activity->speaker_title ?? 'Pakar / Widyaiswara' }}</div>
                    </div>
                </div>
                <div class="mt-3 pt-2.5 border-t border-white/10 text-[11px] text-slate-400 flex justify-between items-center">
                    <span>Penyelenggara:</span>
                    <span class="text-slate-200 font-semibold">BKPSDM Kota Padang</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Hub: Simple, Lega & Mudah Dipahami -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    <!-- Pemberitahuan Login Hanya Tampil Jika Belum Login -->
    @guest('asn')
        <div class="bg-amber-50/90 border border-amber-200 rounded-2xl px-5 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs shadow-xs">
            <div class="flex items-center gap-3 text-amber-950">
                <span class="w-8 h-8 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </span>
                <div>
                    <strong class="text-slate-900 block text-sm">Autentikasi SSO Diperlukan</strong>
                    <span class="text-slate-600">Seluruh 7 menu kegiatan pembelajaran dilindungi sistem SSO ASN Kota Padang.</span>
                </div>
            </div>
            <a href="{{ route('keycloak.redirect') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-sm transition-all shrink-0">
                <span>Masuk Akun SSO ASN</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </a>
        </div>
    @endguest


    <!-- 7 Akses Layanan Pembelajaran (Tampilan Kartu Cerdas: Rapi & Mudah Dipahami) -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-2 h-5 rounded bg-blue-600"></span>
                    <span>Layanan Pembelajaran Rabu Belajar</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Pilih layanan pembelajaran sesuai tahapan kegiatan di bawah ini</p>
            </div>
            <span class="text-xs font-semibold text-slate-400 bg-slate-100 px-3 py-1 rounded-full hidden sm:inline-block">
                7 Menu Terintegrasi
            </span>
        </div>

        <!-- Grid 7 Kartu Layanan Terpadu -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            
            <!-- 1. Live YouTube -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-rose-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-700">Live Streaming</span>
                    </div>

                    <h3 class="text-base font-bold text-slate-900">1. Live YouTube</h3>
                    <p class="text-xs text-slate-500 mt-1">Siaran langsung & tayangan ulang resmi kanal YouTube BKPSDM Kota Padang.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    @if($activity->youtube_url)
                        <a href="{{ route('activities.access', [$activity->slug, 'youtube']) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-xs transition-all">
                            <span>Tonton Live YouTube</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    @else
                        <button disabled class="w-full py-2.5 px-4 rounded-xl bg-slate-100 text-slate-400 font-medium text-xs cursor-not-allowed">
                            Siaran Belum Tersedia
                        </button>
                    @endif
                </div>
            </div>

            <!-- 2. Zoom Meeting & Presensi -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-blue-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        </div>
                        @if($hasAttended)
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span>Presensi Tercatat</span>
                            </span>
                        @else
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700">Tatap Muka Daring</span>
                        @endif
                    </div>

                    <h3 class="text-base font-bold text-slate-900">2. Zoom & Presensi</h3>
                    <p class="text-xs text-slate-500 mt-1">Tatap muka interaktif dengan narasumber & catat presensi kehadiran Anda.</p>

                    <div class="mt-3 py-2 px-3 bg-slate-50 rounded-xl text-xs flex justify-between font-mono text-slate-600 border border-slate-100">
                        <span>ID: <strong>{{ $activity->zoom_meeting_id ?? '883 4920 1928' }}</strong></span>
                        <span>Pass: <strong>{{ $activity->zoom_passcode ?? 'RABU2026' }}</strong></span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2">
                    @if($activity->zoom_url)
                        <a href="{{ route('activities.access', [$activity->slug, 'zoom']) }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs transition-all">
                            <span>Masuk Zoom</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    @endif
                    @if(! $hasAttended)
                        <a href="{{ route('activities.presence', $activity->slug) }}" class="inline-flex items-center justify-center py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all" title="Catat Presensi Mandiri">
                            <span>Presensi</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- 3. Pre-Test Mandiri (Native In-System CBT) -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-purple-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        </div>
                        @if($pretestAttempt)
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span>Skor: {{ number_format($pretestAttempt->score, 0) }}</span>
                            </span>
                        @else
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-purple-50 text-purple-700">Tahap Awal</span>
                        @endif
                    </div>

                    <h3 class="text-base font-bold text-slate-900">3. Pre-Test Mandiri</h3>
                    <p class="text-xs text-slate-500 mt-1">Uji diagnostik pemahaman awal langsung di sistem tanpa keluar portal.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    <a href="{{ route('activities.pretest', $activity->slug) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl {{ $pretestAttempt ? 'bg-purple-50 text-purple-700 hover:bg-purple-100 border border-purple-200' : 'bg-purple-600 hover:bg-purple-700 text-white shadow-xs' }} font-bold text-xs transition-all">
                        <span>{{ $pretestAttempt ? 'Lihat Hasil Pre-Test' : 'Mulai Pre-Test Mandiri' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- 4. Virtual Background -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-amber-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-800">Latar Zoom</span>
                    </div>

                    <h3 class="text-base font-bold text-slate-900">4. Virtual Background</h3>
                    <p class="text-xs text-slate-500 mt-1">Unduh latar belakang resmi bertema kegiatan untuk ruang Zoom.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    <a href="{{ route('activities.access', [$activity->slug, 'background']) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-xs transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        <span>Unduh Background</span>
                    </a>
                </div>
            </div>

            <!-- 5. Post-Test Mandiri (Native In-System CBT) -->
            <div class="bg-white rounded-2xl p-5 border-2 {{ $posttestAttempt && $posttestAttempt->is_passed ? 'border-emerald-300' : 'border-indigo-200' }} shadow-xs hover:border-indigo-400 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        @if($posttestAttempt && $posttestAttempt->is_passed)
                            <span class="text-[11px] font-extrabold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span>Lulus ({{ number_format($posttestAttempt->score, 0) }})</span>
                            </span>
                        @else
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700">KKM {{ $activity->passing_grade ?? 70 }} Poin</span>
                        @endif
                    </div>

                    <h3 class="text-base font-bold text-slate-900">5. Post-Test Mandiri</h3>
                    <p class="text-xs text-slate-500 mt-1">Ujian evaluasi kompetensi akhir sesi dengan penilaian & KKM otomatis.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    <a href="{{ route('activities.posttest', $activity->slug) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl {{ $posttestAttempt && $posttestAttempt->is_passed ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-xs' }} font-bold text-xs transition-all">
                        <span>{{ $posttestAttempt && $posttestAttempt->is_passed ? 'Lihat Hasil Post-Test' : 'Mulai Post-Test Mandiri' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- 6. Bahan Pembelajaran -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-sky-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-sky-50 text-sky-700">Materi Sesi</span>
                    </div>

                    <h3 class="text-base font-bold text-slate-900">6. Bahan Pembelajaran</h3>
                    <p class="text-xs text-slate-500 mt-1">Slide presentasi, modul rujukan, dan berkas narasumber.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    @if($activity->material_url || $activity->material_file)
                        <a href="{{ route('activities.access', [$activity->slug, 'materi']) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-xs transition-all">
                            <span>Akses Bahan Pembelajaran</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    @else
                        <button disabled class="w-full py-2.5 px-4 rounded-xl bg-slate-100 text-slate-400 font-medium text-xs cursor-not-allowed">
                            Materi Sedang Disiapkan
                        </button>
                    @endif
                </div>
            </div>

            <!-- 7. Evaluasi & E-Sertifikat Digital (Full Row Card) -->
            <div class="bg-white rounded-2xl p-5 border-2 border-slate-200/90 shadow-sm hover:border-blue-400 hover:shadow-md transition-all flex flex-col justify-between group md:col-span-2 lg:col-span-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl {{ $myCertificate ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600' }} flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.723 1.745 3.42 3.42 0 01-2.812 2.812 3.42 3.42 0 00-1.745.723 3.42 3.42 0 01-3.976 0 3.42 3.42 0 00-1.745-.723 3.42 3.42 0 01-2.812-2.812 3.42 3.42 0 00-.723-1.745 3.42 3.42 0 010-3.976 3.42 3.42 0 00.723-1.745 3.42 3.42 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" /></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-bold text-slate-900">7. Evaluasi & E-Sertifikat Digital Otomatis</h3>
                                @if($myCertificate)
                                    <span class="text-[11px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Sertifikat Terbit!</span>
                                @else
                                    <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Terbit Otomatis</span>
                                @endif
                            </div>
                            
                            @if($myCertificate)
                                <p class="text-xs text-slate-600 mt-1">
                                    Nomor Sertifikat: <strong class="font-mono text-blue-700">{{ $myCertificate->certificate_number }}</strong>. Telah terverifikasi resmi oleh BKPSDM Padang.
                                </p>
                            @else
                                <div class="flex flex-wrap items-center gap-2 mt-2 text-[11px] font-medium text-slate-500">
                                    <span class="inline-flex items-center gap-1 {{ $hasAttended ? 'text-emerald-700 font-bold' : '' }}">
                                        <svg class="w-3.5 h-3.5 {{ $hasAttended ? 'text-emerald-600' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        1. Presensi
                                    </span>
                                    <span>•</span>
                                    <span class="inline-flex items-center gap-1 {{ $pretestAttempt ? 'text-emerald-700 font-bold' : '' }}">
                                        <svg class="w-3.5 h-3.5 {{ $pretestAttempt ? 'text-emerald-600' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        2. Pre-Test
                                    </span>
                                    <span>•</span>
                                    <span class="inline-flex items-center gap-1 {{ $posttestAttempt && $posttestAttempt->is_passed ? 'text-emerald-700 font-bold' : '' }}">
                                        <svg class="w-3.5 h-3.5 {{ $posttestAttempt && $posttestAttempt->is_passed ? 'text-emerald-600' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        3. Post-Test
                                    </span>
                                    <span>•</span>
                                    <span class="inline-flex items-center gap-1 {{ $hasEvaluated ? 'text-emerald-700 font-bold' : '' }}">
                                        <svg class="w-3.5 h-3.5 {{ $hasEvaluated ? 'text-emerald-600' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        4. Evaluasi
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        @if($myCertificate)
                            <a href="{{ route('my.certificates') }}" class="inline-flex items-center justify-center gap-2 py-2.5 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span>Unduh E-Sertifikat</span>
                            </a>
                        @else
                            <a href="{{ route('activities.evaluation', $activity->slug) }}" class="inline-flex items-center justify-center gap-2 py-2.5 px-5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-xs transition-all">
                                <span>{{ $hasEvaluated ? 'Lihat Evaluasi' : 'Isi Evaluasi Sesi' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Deskripsi & Info Penunjang (Dua Kolom Bersih) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Kolom Kiri: Deskripsi & Tata Tertib -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <h3 class="text-base font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Ulasan & Deskripsi Kegiatan</span>
            </h3>
            
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                {{ $activity->description }}
            </p>

            <div class="pt-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Panduan Peserta:</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Format nama di Zoom: <code>NIP_Nama_OPD</code></span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Isi Pre-test sebelum materi dimulai</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Form absensi dibuka menjelang akhir sesi</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Sertifikat terbit bagi yang mengisi evaluasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Bantuan & Navigasi -->
        <div class="lg:col-span-4 space-y-4">
            <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 space-y-2.5">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <span>Pusat Bantuan Peserta</span>
                </h4>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Mengalami kendala tautan atau presensi? Hubungi panitia BKPSDM Kota Padang:
                </p>
                <div class="text-xs font-medium text-slate-700 space-y-1 pt-1">
                    <p class="flex items-center gap-2">
                        <span class="text-slate-400">Telepon:</span>
                        <span class="font-bold">(0751) 462209</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-slate-400">Email:</span>
                        <span>bkd.pdg@gmail.com</span>
                    </p>
                </div>
            </div>

            <a href="{{ route('home') }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-semibold text-xs shadow-xs transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                <span>Kembali ke Jadwal Belajar</span>
            </a>
        </div>
    </div>

    <!-- Rekomendasi Kegiatan Lainnya -->
    @if($otherActivities->count() > 0)
        <div class="pt-4">
            <h3 class="text-base font-bold text-slate-900 mb-3">Agenda Rabu Belajar Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($otherActivities as $other)
                    <a href="{{ route('activities.show', $other->slug) }}" class="block bg-white p-4 rounded-2xl border border-slate-200/80 hover:border-blue-400 hover:shadow-xs transition-all group">
                        <div class="text-[11px] text-slate-400 font-medium">{{ $other->formatted_date }}</div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors line-clamp-2 mt-1 mb-2">
                            {{ $other->title }}
                        </h4>
                        <p class="text-[11px] text-slate-500 truncate">Narasumber: {{ $other->speaker_name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
