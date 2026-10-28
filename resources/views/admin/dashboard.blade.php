@extends('layouts.admin')

@section('title', 'Dashboard Pengelolaan - LMS Rabu Belajar')
@section('page-title', 'Dashboard Ringkasan Kegiatan')

@section('content')
<!-- Ringkasan Statistik 4 Kartu: Rapi, Bersih & Modern -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    
    <!-- Total Kegiatan -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-slate-300 transition-all flex items-center justify-between">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Total Kegiatan</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['total_activities'] }}</h3>
            <p class="text-xs text-slate-400 mt-0.5">Seluruh seri terdaftar</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
        </div>
    </div>

    <!-- Sedang Live / Ongoing -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-rose-200 transition-all flex items-center justify-between">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-wider text-rose-600 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                <span>Sedang Berlangsung</span>
            </p>
            <h3 class="text-3xl font-extrabold text-rose-600 mt-1">{{ $stats['ongoing_count'] }}</h3>
            <p class="text-xs text-slate-400 mt-0.5">Sesi aktif hari ini</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
        </div>
    </div>

    <!-- Akan Datang -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-blue-200 transition-all flex items-center justify-between">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Akan Datang</p>
            <h3 class="text-3xl font-extrabold text-blue-600 mt-1">{{ $stats['upcoming_count'] }}</h3>
            <p class="text-xs text-slate-400 mt-0.5">Agenda terjadwal</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
        </div>
    </div>

    <!-- Status Publikasi -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:border-emerald-200 transition-all flex items-center justify-between">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Terpublikasi</p>
            <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $stats['published_count'] }}</h3>
            <p class="text-xs text-slate-400 mt-0.5">{{ $stats['draft_count'] }} draft disembunyikan</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
    </div>

</div>

<!-- Quick Action & Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
    <div>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
            <span class="w-2 h-5 rounded bg-blue-600"></span>
            <span>Daftar Kegiatan Rabu Belajar</span>
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">Kelola sesi pembelajaran daring, link streaming, materi, dan evaluasi ASN</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <span>+ Tambah Kegiatan Baru</span>
        </a>
    </div>
</div>

<!-- Tabel Kegiatan: Bersih, Rapi & Elegan -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50/80 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200/80">
                <tr>
                    <th class="px-6 py-3.5">Judul & Tema Kegiatan</th>
                    <th class="px-6 py-3.5">Narasumber</th>
                    <th class="px-6 py-3.5">Jadwal Pelaksanaan</th>
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

                                <a href="{{ route('admin.activities.edit', $item->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-amber-50 text-amber-800 hover:bg-amber-100 font-bold transition-colors" title="Ubah Data & Tautan Sesi">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    <span>Edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                            </div>
                            <p class="font-semibold text-slate-700">Belum ada kegiatan yang terdaftar</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Klik tombol "+ Tambah Kegiatan Baru" untuk membuat sesi perdana.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer Tabel -->
    <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-between text-xs">
        <span class="text-slate-500">Menampilkan kegiatan terbaru Rabu Belajar</span>
        <a href="{{ route('admin.activities.index') }}" class="font-bold text-blue-700 hover:text-blue-900 inline-flex items-center gap-1.5 transition-colors">
            <span>Buka Seluruh Manajemen Kegiatan</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </a>
    </div>
</div>
@endsection
