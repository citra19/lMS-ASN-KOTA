@extends('layouts.admin')

@section('title', 'Dashboard Eksekutif & Analitik - LMS Rabu Belajar')
@section('page-title', 'Dashboard Ringkasan Kegiatan')

@section('content')
<!-- Header Sambutan & Quick Actions -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                Sistem Aktif & Terintegrasi
            </span>
            <span class="text-xs text-slate-400">• BKPSDM Kota Padang</span>
        </div>
        <h1 class="text-2xl font-black text-slate-900 tracking-tight mt-1.5">Ringkasan Kegiatan & Analitik Eksekutif</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Monitoring real-time keaktifan ASN, partisipasi presensi, evaluasi materi, serta progres kelulusan sertifikasi.</p>
    </div>
    <div class="flex items-center gap-2.5 shrink-0">
        <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs hover:shadow transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <span>+ Tambah Kegiatan Baru</span>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs border border-slate-200 shadow-xs transition-all">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            <span>Portal ASN</span>
        </a>
    </div>
</div>

<!-- 6 Kartu Metrik KPI Eksekutif -->
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
    
    <!-- 1. Total Kegiatan -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs hover:border-blue-300 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Total Kegiatan</span>
            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
        </div>
        <div class="mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ $stats['total_activities'] }}</div>
            <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mt-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>{{ $stats['published_count'] }} terpublikasi</span>
            </div>
        </div>
    </div>

    <!-- 2. ASN Terdaftar -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs hover:border-indigo-300 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Peserta ASN</span>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
        </div>
        <div class="mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ $stats['total_asn'] }}</div>
            <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mt-1">
                <span class="text-indigo-600 font-bold">10+</span>
                <span>OPD Kota Padang</span>
            </div>
        </div>
    </div>

    <!-- 3. Total Presensi -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs hover:border-sky-300 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Total Kehadiran</span>
            <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
            </div>
        </div>
        <div class="mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ $stats['total_attendances'] }}</div>
            <div class="flex items-center gap-1 text-[11px] text-sky-600 font-semibold mt-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                <span>Akumulasi sesi</span>
            </div>
        </div>
    </div>

    <!-- 4. Sertifikat Terbit -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs hover:border-emerald-300 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">E-Sertifikat</span>
            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
            </div>
        </div>
        <div class="mt-3">
            <div class="text-2xl sm:text-3xl font-black text-emerald-600">{{ $stats['total_certificates'] }}</div>
            <div class="text-[11px] text-slate-500 mt-1">
                Telah terbit & terverifikasi
            </div>
        </div>
    </div>

    <!-- 5. Kelulusan Post-Test -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs hover:border-amber-300 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Kelulusan Test</span>
            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            </div>
        </div>
        <div class="mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ $stats['pass_rate'] }}%</div>
            <div class="text-[11px] text-slate-500 mt-1">
                KKM &ge; 70 tercapai
            </div>
        </div>
    </div>

    <!-- 6. Indeks Kepuasan -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs hover:border-rose-300 transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Indeks Kepuasan</span>
            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
        </div>
        <div class="mt-3">
            <div class="flex items-baseline gap-1">
                <span class="text-2xl sm:text-3xl font-black text-slate-900">{{ $stats['avg_rating'] }}</span>
                <span class="text-xs text-slate-400 font-bold">/ 5.0</span>
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                {{ $stats['total_evaluations'] }} ulasan narasumber
            </div>
        </div>
    </div>

</div>

<!-- Seksi Grafik Utama (2 Kolom) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    
    <!-- Grafik 1: Tren Presensi vs Sertifikat (7 Kolom) -->
    <div class="lg:col-span-7 bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-xs flex flex-col justify-between">
        <div>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base tracking-tight flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                        Tren Kehadiran & Penerbitan Sertifikat
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">Perbandingan peserta presensi vs peserta yang lulus dan terbit sertifikat per seri</p>
                </div>
                <div class="flex items-center gap-3 text-xs font-semibold">
                    <span class="inline-flex items-center gap-1.5 text-blue-600">
                        <span class="w-2.5 h-2.5 rounded bg-blue-500"></span>
                        Presensi Kehadiran
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-emerald-600">
                        <span class="w-2.5 h-2.5 rounded bg-emerald-500"></span>
                        Sertifikat Terbit
                    </span>
                </div>
            </div>
            <div class="relative w-full h-72 sm:h-80 pt-4">
                <canvas id="attendanceTrendChart"></canvas>
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Rata-rata kelulusan sertifikasi per sesi mencapai <strong>{{ $stats['pass_rate'] }}%</strong></span>
            <a href="{{ route('admin.certificates.index') }}" class="font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                Kelola Sertifikat &rarr;
            </a>
        </div>
    </div>

    <!-- Grafik 2: Partisipasi Peserta per OPD Terbanyak (5 Kolom) -->
    <div class="lg:col-span-5 bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-xs flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base tracking-tight flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                        Partisipasi Peserta per OPD
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">6 OPD dengan peserta teraktif di Kota Padang</p>
                </div>
                <span class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-[11px]">Top 6 OPD</span>
            </div>
            <div class="relative w-full h-72 sm:h-80 pt-4">
                <canvas id="opdDistributionChart"></canvas>
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Total <strong>{{ $stats['total_asn'] }} ASN</strong> aktif berpartisipasi</span>
            <span class="text-[11px] text-slate-400">Update Realtime</span>
        </div>
    </div>

</div>

<!-- Seksi Spotlight Kegiatan Aktif, Distribusi Channel & Feed Terkini (3 Kolom) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    
    <!-- Sesi Live Hari Ini (Spotlight Card) - 5 Kolom -->
    <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 text-white rounded-2xl p-6 shadow-sm relative overflow-hidden flex flex-col justify-between">
        <!-- Background Accent Graphic -->
        <div class="absolute -right-10 -bottom-10 w-48 h-48 rounded-full bg-blue-500/10 blur-2xl pointer-events-none"></div>

        <div>
            <div class="flex items-center justify-between">
                @if($ongoingActivity)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                        SEDANG BERLANGSUNG HARI INI
                    </span>
                @elseif($todayCompletedActivity)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        SESI HARI INI TELAH SELESAI
                    </span>
                @elseif($upcomingActivity)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/20 text-blue-300 border border-blue-500/30">
                        <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        SESI BERIKUTNYA
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-500/20 text-slate-300 border border-slate-500/30">
                        AGENDA PEMBELAJARAN
                    </span>
                @endif
                <span class="text-xs text-slate-400">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>

            @if($ongoingActivity)
                <div class="mt-4">
                    <h4 class="text-lg font-bold text-white leading-snug">{{ $ongoingActivity->title }}</h4>
                    @if($ongoingActivity->theme)
                        <p class="text-xs text-blue-300 mt-1 line-clamp-1">Tema: {{ $ongoingActivity->theme }}</p>
                    @endif
                </div>

                <!-- Detail Narasumber & Waktu -->
                <div class="mt-4 p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600/30 text-blue-300 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-400/20">
                        {{ strtoupper(substr($ongoingActivity->speaker_name ?? 'N', 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-white truncate">{{ $ongoingActivity->speaker_name }}</div>
                        <div class="text-[11px] text-slate-300 truncate">{{ $ongoingActivity->speaker_title ?? 'Narasumber' }}</div>
                        <div class="text-[10px] text-blue-300 mt-0.5">Waktu: {{ $ongoingActivity->formatted_time }} WIB</div>
                    </div>
                </div>

                <!-- Action Button Links -->
                <div class="grid grid-cols-2 gap-2 mt-4">
                    @if($ongoingActivity->zoom_url)
                        <a href="{{ $ongoingActivity->zoom_url }}" target="_blank" class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            <span>Buka Zoom</span>
                        </a>
                    @endif
                    @if($ongoingActivity->youtube_url)
                        <a href="{{ $ongoingActivity->youtube_url }}" target="_blank" class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold transition-all shadow-xs">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            <span>Live YouTube</span>
                        </a>
                    @endif
                </div>
            @elseif($todayCompletedActivity)
                <div class="mt-4">
                    <h4 class="text-lg font-bold text-white leading-snug">{{ $todayCompletedActivity->title }}</h4>
                    @if($todayCompletedActivity->theme)
                        <p class="text-xs text-slate-300 mt-1 line-clamp-1">Tema: {{ $todayCompletedActivity->theme }}</p>
                    @endif
                </div>

                <!-- Detail Narasumber & Waktu Selesai -->
                <div class="mt-4 p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-full bg-emerald-600/30 text-emerald-300 flex items-center justify-center font-bold text-sm shrink-0 border border-emerald-400/20">
                            {{ strtoupper(substr($todayCompletedActivity->speaker_name ?? 'N', 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs font-bold text-white truncate">{{ $todayCompletedActivity->speaker_name }}</div>
                            <div class="text-[11px] text-slate-300 truncate">{{ $todayCompletedActivity->speaker_title ?? 'Narasumber' }}</div>
                            <div class="text-[10px] text-emerald-400 mt-0.5">Pelaksanaan: {{ $todayCompletedActivity->formatted_time }} (Tuntas)</div>
                        </div>
                    </div>
                    <div class="text-right shrink-0">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Selesai</span>
                    </div>
                </div>

                <!-- Quick Action Post-Session -->
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <a href="{{ route('admin.certificates.index', ['activity_id' => $todayCompletedActivity->id]) }}" class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        <span>Kelola Sertifikat</span>
                    </a>
                    <a href="{{ route('activities.show', $todayCompletedActivity->slug) }}" target="_blank" class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold border border-white/10 transition-all shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <span>Portal Halaman</span>
                    </a>
                </div>
            @elseif($upcomingActivity)
                <div class="mt-4">
                    <h4 class="text-lg font-bold text-white leading-snug">{{ $upcomingActivity->title }}</h4>
                    @if($upcomingActivity->theme)
                        <p class="text-xs text-blue-300 mt-1 line-clamp-1">Tema: {{ $upcomingActivity->theme }}</p>
                    @endif
                </div>

                <div class="mt-4 p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600/30 text-blue-300 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-400/20">
                        {{ strtoupper(substr($upcomingActivity->speaker_name ?? 'N', 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-white truncate">{{ $upcomingActivity->speaker_name }}</div>
                        <div class="text-[11px] text-slate-300 truncate">{{ $upcomingActivity->formatted_date }}</div>
                        <div class="text-[10px] text-blue-300 mt-0.5">Pukul: {{ $upcomingActivity->formatted_time }} WIB</div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('activities.show', $upcomingActivity->slug) }}" target="_blank" class="w-full flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-xs">
                        <span>Pratinjau Informasi Agenda</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @else
                <div class="mt-6 text-center py-6">
                    <div class="w-12 h-12 rounded-full bg-white/10 text-slate-300 mx-auto flex items-center justify-center mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h4 class="font-bold text-white text-base">Tidak Ada Sesi Terjadwal</h4>
                    <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">Sesi Rabu Belajar berikutnya terjadwal setiap hari Rabu pukul 09:00 WIB.</p>
                </div>
            @endif
        </div>

        <div class="mt-5 pt-4 border-t border-white/10 flex items-center justify-between text-xs">
            <span class="text-slate-400">Jadwal Rutin: <strong class="text-blue-300">Setiap Rabu 09:00 WIB</strong></span>
            @if($ongoingActivity)
                <a href="{{ route('activities.show', $ongoingActivity->slug) }}" target="_blank" class="text-blue-300 hover:text-white font-bold inline-flex items-center gap-1">
                    Halaman Peserta &rarr;
                </a>
            @elseif($todayCompletedActivity)
                <a href="{{ route('activities.show', $todayCompletedActivity->slug) }}" target="_blank" class="text-emerald-300 hover:text-white font-bold inline-flex items-center gap-1">
                    Arsip Sesi &rarr;
                </a>
            @endif
        </div>
    </div>

    <!-- Grafik Donut: Rasio Platform Streaming & Kelulusan (3 Kolom) -->
    <div class="lg:col-span-3 bg-white rounded-2xl p-5 border border-slate-200/90 shadow-xs flex flex-col justify-between">
        <div>
            <div class="pb-3 border-b border-slate-100">
                <h3 class="font-extrabold text-slate-900 text-sm tracking-tight">Kanal Akses Pembelajaran</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Zoom Meeting vs YouTube Streaming</p>
            </div>
            
            <div class="relative w-full h-44 sm:h-48 pt-2 flex items-center justify-center">
                <canvas id="platformDonutChart"></canvas>
            </div>

            <div class="grid grid-cols-2 gap-2 mt-2 pt-2 border-t border-slate-100 text-center">
                <div class="p-2 rounded-xl bg-blue-50/70 border border-blue-100">
                    <span class="text-[10px] font-bold text-blue-600 uppercase">Zoom</span>
                    <div class="text-sm font-extrabold text-blue-900 mt-0.5">{{ $chartPlatform['zoom'] }}</div>
                </div>
                <div class="p-2 rounded-xl bg-rose-50/70 border border-rose-100">
                    <span class="text-[10px] font-bold text-rose-600 uppercase">YouTube</span>
                    <div class="text-sm font-extrabold text-rose-900 mt-0.5">{{ $chartPlatform['youtube'] }}</div>
                </div>
            </div>
        </div>

        <div class="mt-3 text-[11px] text-slate-500 text-center">
            Pilihan fleksibel streaming ASN Kota Padang
        </div>
    </div>

    <!-- Feed Aktivitas Realtime ASN (4 Kolom) -->
    <div class="lg:col-span-4 bg-white rounded-2xl p-5 border border-slate-200/90 shadow-xs flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-sm tracking-tight flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Aktivitas ASN Terkini
                    </h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Presensi & penerbitan sertifikat live</p>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Live Log</span>
            </div>

            <!-- Feed Items -->
            <div class="space-y-3 mt-3">
                @forelse($recentFeed as $feed)
                    <div class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 transition-colors">
                        @if($feed['type'] === 'certificate')
                            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                        @else
                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" /></svg>
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-1">
                                <span class="font-bold text-xs text-slate-800 truncate">{{ $feed['asn_name'] }}</span>
                                <span class="text-[10px] text-slate-400 whitespace-nowrap">{{ $feed['time'] }}</span>
                            </div>
                            <div class="text-[11px] text-slate-500 truncate">{{ $feed['opd'] }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1 truncate">
                                @if($feed['type'] === 'certificate')
                                    <span class="text-emerald-700 font-semibold">Sertifikat #{{ Str::limit($feed['cert_number'] ?? 'OK', 14) }}</span>
                                @else
                                    <span class="text-blue-700 font-semibold">Hadir via {{ ucfirst($feed['platform']) }}</span>
                                @endif
                                <span>• {{ Str::limit($feed['activity_title'], 20) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-xs text-slate-400">
                        Belum ada aktivitas tercatat hari ini.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-3 pt-3 border-t border-slate-100 text-center">
            <a href="{{ route('admin.certificates.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                Buka Riwayat Kelulusan Lengkap &rarr;
            </a>
        </div>
    </div>

</div>

<!-- Seksi Tabel Kegiatan: Bersih, Rapi & Lengkap -->
<div class="mb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
            <span class="w-2 h-5 rounded bg-blue-600"></span>
            <span>Daftar Kegiatan Rabu Belajar</span>
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">Kelola sesi pembelajaran, tautan narasumber, materi tayang, dan penerbitan sertifikat</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <span>Tambah Kegiatan</span>
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50/80 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200/80">
                <tr>
                    <th class="px-6 py-3.5">Judul & Tema Kegiatan</th>
                    <th class="px-6 py-3.5">Narasumber</th>
                    <th class="px-6 py-3.5">Jadwal Pelaksanaan</th>
                    <th class="px-6 py-3.5 text-center">Kehadiran & Sertifikat</th>
                    <th class="px-6 py-3.5 text-center">Status Sesi</th>
                    <th class="px-6 py-3.5 text-center">Publikasi</th>
                    <th class="px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentActivities as $item)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <!-- Judul & Tema -->
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 text-sm max-w-sm sm:max-w-md leading-snug">{{ $item->title }}</div>
                            @if($item->theme)
                                <div class="text-[11px] text-blue-700 font-medium mt-1 line-clamp-1">Tema: {{ $item->theme }}</div>
                            @endif
                        </td>

                        <!-- Narasumber -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-slate-800">{{ $item->speaker_name }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5 max-w-[200px] truncate">{{ $item->speaker_title ?? '-' }}</div>
                        </td>

                        <!-- Jadwal -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-slate-800">{{ $item->formatted_date }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $item->formatted_time }} WIB</div>
                        </td>

                        <!-- Stat Kehadiran & Sertifikat -->
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-2">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[11px] font-bold" title="Total Kehadiran Presensi">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    {{ $item->attendances_count }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-bold" title="Total E-Sertifikat Terbit">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $item->certificates_count }}
                                </span>
                            </div>
                        </td>

                        <!-- Status Sesi -->
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($item->status === 'ongoing')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                    <span>Berlangsung</span>
                                </span>
                            @elseif($item->status === 'upcoming')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    <span>Akan Datang</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span>Selesai</span>
                                </span>
                            @endif
                        </td>

                        <!-- Status Publikasi Toggle -->
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <form action="{{ route('admin.activities.toggle-publish', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold transition-all {{ $item->is_published ? 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100 border border-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 border border-slate-200' }}" title="Klik untuk mengubah status publikasi di website">
                                    @if($item->is_published)
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        <span>Terpublikasi</span>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                                        <span>Draft</span>
                                    @endif
                                </button>
                            </form>
                        </td>

                        <!-- Aksi Tombol -->
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <a href="{{ route('activities.show', $item->slug) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 font-bold transition-colors" title="Buka Pratinjau Halaman">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <span>Lihat</span>
                                </a>
                                <a href="{{ route('admin.certificates.index', ['activity_id' => $item->id]) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-bold transition-colors" title="Kelola Sertifikat Sesi Ini">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    <span>Sertifikat</span>
                                </a>
                                <a href="{{ route('admin.activities.edit', $item->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 font-bold transition-colors" title="Edit Data Sesi">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    <span>Edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                            Belum ada kegiatan yang dibuat. Klik tombol di atas untuk menambah kegiatan pertama.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js CDN & Inisialisasi Script Grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Styling Global Font & Colors
    Chart.defaults.font.family = "ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif";
    Chart.defaults.color = '#64748b';

    // 1. Chart Tren Kehadiran & Sertifikat
    const trendCtx = document.getElementById('attendanceTrendChart');
    if (trendCtx) {
        new Chart(trendCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($chartTrend['labels']) !!},
                datasets: [
                    {
                        label: 'Kehadiran Presensi',
                        data: {!! json_encode($chartTrend['attendances']) !!},
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.08)',
                        borderWidth: 2.5,
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: '#2563eb',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4.5,
                        pointHoverRadius: 6.5,
                    },
                    {
                        label: 'Sertifikat Diterbitkan',
                        data: {!! json_encode($chartTrend['certificates']) !!},
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.08)',
                        borderWidth: 2.5,
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4.5,
                        pointHoverRadius: 6.5,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        padding: 10,
                        cornerRadius: 8,
                        boxPadding: 4,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': ' + context.parsed.y + ' ASN';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '600'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                        },
                        ticks: {
                            precision: 0,
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    }

    // 2. Chart Distribusi Peserta per OPD (Horizontal Bar)
    const opdCtx = document.getElementById('opdDistributionChart');
    if (opdCtx) {
        new Chart(opdCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartOpd['labels']) !!},
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: {!! json_encode($chartOpd['counts']) !!},
                    backgroundColor: [
                        '#4f46e5',
                        '#6366f1',
                        '#3b82f6',
                        '#0ea5e9',
                        '#06b6d4',
                        '#14b8a6',
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.65,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.x + ' Pegawai Terdaftar';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            precision: 0,
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        }
                    }
                }
            }
        });
    }

    // 3. Chart Platform Streaming Donut
    const platformCtx = document.getElementById('platformDonutChart');
    if (platformCtx) {
        new Chart(platformCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Zoom Meeting', 'YouTube Live'],
                datasets: [{
                    data: [{{ $chartPlatform['zoom'] }}, {{ $chartPlatform['youtube'] }}],
                    backgroundColor: ['#2563eb', '#f43f5e'],
                    hoverBackgroundColor: ['#1d4ed8', '#e11d48'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        padding: 8,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.parsed + ' Kehadiran';
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
