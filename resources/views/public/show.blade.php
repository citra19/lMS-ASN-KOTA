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


    <!-- LMS Learning Progress Tracker (Hanya Tampil Jika Login sebagai ASN) -->
    @auth('asn')
        <div class="bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 rounded-3xl p-6 sm:p-7 text-white shadow-lg border border-blue-700/30 relative overflow-hidden">
            <div class="absolute -right-8 -top-8 w-44 h-44 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative">
                <!-- Info Peserta & Progress -->
                <div class="space-y-3 flex-grow">
                    <div class="flex flex-wrap items-center gap-2 text-xs">
                        <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-200 border border-blue-400/30 font-bold uppercase tracking-wider text-[10px]">
                            LMS Rabu Belajar &bull; Portofolio ASN
                        </span>
                        <span class="text-slate-300 font-medium">
                            Peserta: <strong class="text-white">{{ Auth::guard('asn')->user()->name }}</strong> (NIP: {{ Auth::guard('asn')->user()->nip }})
                        </span>
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold text-white tracking-tight flex items-center gap-2">
                            <span>Tahapan Pembelajaran Anda:</span>
                            <span class="text-amber-400">{{ $learningProgress }}% Selesai</span>
                        </h2>
                        <p class="text-xs text-slate-300 mt-0.5">
                            Selesaikan 4 syarat kelulusan di bawah ini untuk menerbitkan E-Sertifikat Pengembangan Kompetensi ({{ $activity->jp_hours ?? 3 }} JP) secara otomatis.
                        </p>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-white/10 rounded-full h-3 p-0.5 overflow-hidden backdrop-blur-sm max-w-2xl">
                        <div class="bg-gradient-to-r from-amber-400 via-emerald-400 to-teal-300 h-2 rounded-full transition-all duration-700 shadow-sm" style="width: {{ max($learningProgress, 5) }}%"></div>
                    </div>
                </div>

                <!-- 4 Milestones Badges Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 shrink-0">
                    <!-- 1. Presensi -->
                    <div class="p-3 rounded-2xl {{ $hasAttended ? 'bg-emerald-500/20 border-emerald-400/30 text-emerald-200' : 'bg-white/5 border-white/10 text-slate-400' }} border text-center">
                        <div class="w-6 h-6 mx-auto mb-1 rounded-full {{ $hasAttended ? 'bg-emerald-500 text-slate-950' : 'bg-white/10 text-slate-400' }} flex items-center justify-center text-xs font-black">
                            {!! $hasAttended ? '✓' : '1' !!}
                        </div>
                        <span class="block text-[11px] font-bold">Presensi</span>
                        <span class="text-[9px] uppercase tracking-wider font-semibold opacity-80">{{ $hasAttended ? 'Selesai' : 'Belum' }}</span>
                    </div>

                    <!-- 2. Pre-Test -->
                    <div class="p-3 rounded-2xl {{ $pretestAttempt ? 'bg-emerald-500/20 border-emerald-400/30 text-emerald-200' : 'bg-white/5 border-white/10 text-slate-400' }} border text-center">
                        <div class="w-6 h-6 mx-auto mb-1 rounded-full {{ $pretestAttempt ? 'bg-emerald-500 text-slate-950' : 'bg-white/10 text-slate-400' }} flex items-center justify-center text-xs font-black">
                            {!! $pretestAttempt ? '✓' : '2' !!}
                        </div>
                        <span class="block text-[11px] font-bold">Pre-Test</span>
                        <span class="text-[9px] uppercase tracking-wider font-semibold opacity-80">{{ $pretestAttempt ? number_format($pretestAttempt->score, 0).' Poin' : 'Belum' }}</span>
                    </div>

                    <!-- 3. Post-Test -->
                    <div class="p-3 rounded-2xl {{ $posttestAttempt && $posttestAttempt->is_passed ? 'bg-emerald-500/20 border-emerald-400/30 text-emerald-200' : 'bg-white/5 border-white/10 text-slate-400' }} border text-center">
                        <div class="w-6 h-6 mx-auto mb-1 rounded-full {{ $posttestAttempt && $posttestAttempt->is_passed ? 'bg-emerald-50 text-slate-950' : 'bg-white/10 text-slate-400' }} flex items-center justify-center text-xs font-black">
                            {!! $posttestAttempt && $posttestAttempt->is_passed ? '✓' : '3' !!}
                        </div>
                        <span class="block text-[11px] font-bold">Post-Test</span>
                        <span class="text-[9px] uppercase tracking-wider font-semibold opacity-80">{{ $posttestAttempt && $posttestAttempt->is_passed ? 'Lulus' : 'KKM '.$activity->passing_grade }}</span>
                    </div>

                    <!-- 4. Evaluasi -->
                    <div class="p-3 rounded-2xl {{ $hasEvaluated ? 'bg-emerald-500/20 border-emerald-400/30 text-emerald-200' : 'bg-white/5 border-white/10 text-slate-400' }} border text-center">
                        <div class="w-6 h-6 mx-auto mb-1 rounded-full {{ $hasEvaluated ? 'bg-emerald-500 text-slate-950' : 'bg-white/10 text-slate-400' }} flex items-center justify-center text-xs font-black">
                            {!! $hasEvaluated ? '✓' : '4' !!}
                        </div>
                        <span class="block text-[11px] font-bold">Evaluasi</span>
                        <span class="text-[9px] uppercase tracking-wider font-semibold opacity-80">{{ $hasEvaluated ? 'Selesai' : 'Belum' }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <!-- Modul Pembelajaran LMS Rabu Belajar -->
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-2 h-5 rounded bg-blue-600"></span>
                    <span>Modul & Tahapan Pembelajaran LMS</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Ikuti tahapan pembelajaran dan selesaikan asesmen secara mandiri di sistem.</p>
            </div>
            <span class="text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200/60 px-3 py-1 rounded-full hidden sm:inline-block">
                Sistem Terpadu BKPSDM
            </span>
        </div>

        <!-- Grid Modul Pembelajaran Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- 1. Kelas Webinar Zoom Meeting -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-blue-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-50 text-blue-700">Tatap Muka</span>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900">1. Kelas Zoom Meeting</h3>
                    <p class="text-xs text-slate-500 mt-1">Tatap muka interaktif daring langsung bersama narasumber.</p>

                    <div class="mt-3 py-1.5 px-2.5 bg-slate-50 rounded-xl text-[11px] font-mono text-slate-600 border border-slate-100 flex justify-between">
                        <span>ID: <strong>{{ $activity->zoom_meeting_id ?? '883 4920 1928' }}</strong></span>
                        <span>Pass: <strong>{{ $activity->zoom_passcode ?? 'RABU2026' }}</strong></span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    @if($activity->zoom_url)
                        <a href="{{ route('activities.access', [$activity->slug, 'zoom']) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs transition-all">
                            <span>Masuk Ruang Zoom</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    @else
                        <button disabled class="w-full py-2 px-3 rounded-xl bg-slate-100 text-slate-400 font-medium text-xs cursor-not-allowed">
                            Tautan Zoom Belum Diset
                        </button>
                    @endif
                </div>
            </div>

            <!-- 2. Live Streaming YouTube -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-rose-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-rose-50 text-rose-700">Live & Arsip</span>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900">2. Live YouTube</h3>
                    <p class="text-xs text-slate-500 mt-1">Siaran langsung & tayangan ulang resmi kanal BKPSDM Padang.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    @if($activity->youtube_url)
                        <a href="{{ route('activities.access', [$activity->slug, 'youtube']) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-xs transition-all">
                            <span>Tonton Live YouTube</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    @else
                        <button disabled class="w-full py-2 px-3 rounded-xl bg-slate-100 text-slate-400 font-medium text-xs cursor-not-allowed">
                            Siaran Belum Tersedia
                        </button>
                    @endif
                </div>
            </div>

            <!-- 3. Bahan / Modul Pembelajaran -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-sky-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-sky-50 text-sky-700">Materi Ajar</span>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900">3. Bahan Pembelajaran</h3>
                    <p class="text-xs text-slate-500 mt-1">Slide paparan narasumber & bahan bacaan kompetensi.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    @if($activity->material_url || $activity->material_file)
                        <a href="{{ route('activities.access', [$activity->slug, 'materi']) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs shadow-xs transition-all">
                            <span>Akses Modul Materi</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    @else
                        <button disabled class="w-full py-2 px-3 rounded-xl bg-slate-100 text-slate-400 font-medium text-xs cursor-not-allowed">
                            Materi Sedang Disiapkan
                        </button>
                    @endif
                </div>
            </div>

            <!-- 4. Virtual Background -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-amber-300 hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-amber-50 text-amber-800">Media</span>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900">4. Virtual Background</h3>
                    <p class="text-xs text-slate-500 mt-1">Latar belakang resmi ruang Zoom kegiatan Rabu Belajar.</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    <a href="{{ route('activities.access', [$activity->slug, 'background']) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-xs transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        <span>Unduh Background</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Section: 4 Syarat Kelulusan & Asesmen Mandiri LMS -->
        <div class="pt-2">
            <div class="mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Asesmen & Syarat Penerbitan E-Sertifikat</span>
                <h3 class="text-base font-extrabold text-slate-900">4 Tahapan Kelulusan Peserta</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- 1. Presensi Mandiri Kehadiran -->
                <div class="bg-white rounded-2xl p-5 border-2 {{ $hasAttended ? 'border-emerald-300 bg-emerald-50/10' : 'border-slate-200' }} shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-7 h-7 rounded-lg font-black text-xs flex items-center justify-center {{ $hasAttended ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                                {!! $hasAttended ? '✓' : '1' !!}
                            </span>
                            @if($hasAttended)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Tercatat</span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">Wajib</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">1. Presensi Kehadiran</h4>
                        <p class="text-xs text-slate-500 mt-1">Konfirmasi kehadiran mandiri untuk validasi keikutsertaan sesi.</p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100">
                        @if($hasAttended)
                            <button disabled class="w-full py-2 px-3 rounded-xl bg-emerald-50 text-emerald-700 font-bold text-xs border border-emerald-200 flex items-center justify-center gap-1.5 cursor-default">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span>Kehadiran Terverifikasi</span>
                            </button>
                        @else
                            <a href="{{ route('activities.presence', $activity->slug) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition-all">
                                <span>Catat Presensi Sekarang</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- 2. Pre-Test Mandiri -->
                <div class="bg-white rounded-2xl p-5 border-2 {{ $pretestAttempt ? 'border-emerald-300 bg-emerald-50/10' : 'border-slate-200' }} shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-7 h-7 rounded-lg font-black text-xs flex items-center justify-center {{ $pretestAttempt ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                                {!! $pretestAttempt ? '✓' : '2' !!}
                            </span>
                            @if($pretestAttempt)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Skor: {{ number_format($pretestAttempt->score, 0) }}</span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-purple-100 text-purple-700">Diagnostik</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">2. Pre-Test Mandiri</h4>
                        <p class="text-xs text-slate-500 mt-1">Ukur pemahaman awal materi sebelum sesi pemaparan dimulai.</p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100">
                        <a href="{{ route('activities.pretest', $activity->slug) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl {{ $pretestAttempt ? 'bg-purple-50 text-purple-700 hover:bg-purple-100 border border-purple-200' : 'bg-purple-600 hover:bg-purple-700 text-white shadow-xs' }} font-bold text-xs transition-all">
                            <span>{{ $pretestAttempt ? 'Lihat Lembar Hasil' : 'Mulai Pre-Test' }}</span>
                        </a>
                    </div>
                </div>

                <!-- 3. Post-Test Mandiri (Evaluasi Kelulusan KKM) -->
                @php
                    $isPassed = $posttestAttempt && $posttestAttempt->is_passed;
                @endphp
                <div class="bg-white rounded-2xl p-5 border-2 {{ $isPassed ? 'border-emerald-300 bg-emerald-50/10' : ($posttestAttempt ? 'border-rose-300 bg-rose-50/10' : 'border-slate-200') }} shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-7 h-7 rounded-lg font-black text-xs flex items-center justify-center {{ $isPassed ? 'bg-emerald-600 text-white' : ($posttestAttempt ? 'bg-rose-600 text-white' : 'bg-slate-100 text-slate-700') }}">
                                {!! $isPassed ? '✓' : '3' !!}
                            </span>
                            @if($isPassed)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Lulus ({{ number_format($posttestAttempt->score, 0) }})</span>
                            @elseif($posttestAttempt)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-100 text-rose-800">Skor: {{ number_format($posttestAttempt->score, 0) }}</span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700">KKM {{ $activity->passing_grade ?? 70 }}</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">3. Post-Test Kelulusan</h4>
                        <p class="text-xs text-slate-500 mt-1">Ujian evaluasi penyerapan materi dengan standar KKM.</p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100">
                        <a href="{{ route('activities.posttest', $activity->slug) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl {{ $isPassed ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-xs' }} font-bold text-xs transition-all">
                            <span>{{ $isPassed ? 'Hasil Kelulusan' : ($posttestAttempt ? 'Ulangi Post-Test' : 'Mulai Post-Test') }}</span>
                        </a>
                    </div>
                </div>

                <!-- 4. Formulir Evaluasi & Umpan Balik Sesi -->
                <div class="bg-white rounded-2xl p-5 border-2 {{ $hasEvaluated ? 'border-emerald-300 bg-emerald-50/10' : 'border-slate-200' }} shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-7 h-7 rounded-lg font-black text-xs flex items-center justify-center {{ $hasEvaluated ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                                {!! $hasEvaluated ? '✓' : '4' !!}
                            </span>
                            @if($hasEvaluated)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Selesai</span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">Wajib</span>
                            @endif
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">4. Evaluasi Sesi</h4>
                        <p class="text-xs text-slate-500 mt-1">Kuesioner kepuasan pelayanan narasumber & panitia BKPSDM.</p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100">
                        <a href="{{ route('activities.evaluation', $activity->slug) }}" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl {{ $hasEvaluated ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-slate-900 hover:bg-slate-800 text-white shadow-xs' }} font-bold text-xs transition-all">
                            <span>{{ $hasEvaluated ? 'Lihat Evaluasi' : 'Isi Kuesioner' }}</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Showcase: E-Sertifikat Digital Portofolio ASN -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border-2 {{ $myCertificate ? 'border-emerald-300 shadow-md ring-4 ring-emerald-50' : 'border-slate-200/90 shadow-sm' }} transition-all">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl {{ $myCertificate ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-50 text-blue-600' }} flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.723 1.745 3.42 3.42 0 01-2.812 2.812 3.42 3.42 0 00-1.745.723 3.42 3.42 0 01-3.976 0 3.42 3.42 0 00-1.745-.723 3.42 3.42 0 01-2.812-2.812 3.42 3.42 0 00-.723-1.745 3.42 3.42 0 010-3.976 3.42 3.42 0 00.723-1.745 3.42 3.42 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" /></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-extrabold text-slate-900">E-Sertifikat Pengembangan Kompetensi ({{ $activity->jp_hours ?? 3 }} JP)</h3>
                            @if($myCertificate)
                                <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Terbit Resmi</span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">Terkunci</span>
                            @endif
                        </div>
                        
                        @if($myCertificate)
                            <p class="text-xs text-slate-600 mt-1">
                                Selamat! E-Sertifikat digital Anda telah terdaftar resmi dengan nomor: <strong class="font-mono text-blue-700">{{ $myCertificate->certificate_number }}</strong>. Telah terverifikasi otomatis oleh BKPSDM Padang.
                            </p>
                        @else
                            <p class="text-xs text-slate-500 mt-1">
                                E-Sertifikat otomatis terbuka dan diterbitkan oleh sistem begitu Anda menuntaskan seluruh 4 tahapan di atas.
                            </p>
                        @endif
                    </div>
                </div>

                <div class="shrink-0">
                    @if($myCertificate)
                        <a href="{{ route('certificates.show', $myCertificate->id) }}" target="_blank" class="inline-flex items-center justify-center gap-2 py-3 px-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-extrabold text-xs shadow-md shadow-emerald-500/20 transition-all hover:scale-[1.02]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            <span>Lihat & Cetak E-Sertifikat Digital</span>
                        </a>
                    @else
                        <button disabled class="inline-flex items-center justify-center gap-2 py-3 px-6 rounded-2xl bg-slate-100 text-slate-400 font-bold text-xs cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>E-Sertifikat Terkunci</span>
                        </button>
                    @endif
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
