@extends('layouts.admin')

@section('title', 'Manajemen Kegiatan - Admin LMS Rabu Belajar')
@section('page-title', 'Manajemen Kegiatan Rabu Belajar')

@section('content')
<div class="space-y-6">
    <!-- Header with Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Daftar Pengelolaan Kegiatan</h2>
            <p class="text-xs text-slate-500">Tambah, edit informasi, tautan live YouTube, Zoom, materi, absensi, dan sertifikat</p>
        </div>
        <div>
            <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                <span>+ Tambah Kegiatan Baru</span>
            </a>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
        <form action="{{ route('admin.activities.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search -->
            <div class="sm:col-span-5 relative">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari kegiatan, tema, narasumber..." class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Status Sesi Filter -->
            <div class="sm:col-span-3">
                <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status Sesi</option>
                    <option value="upcoming" {{ $status === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="ongoing" {{ $status === 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <!-- Publish Filter -->
            <div class="sm:col-span-2">
                <select name="publish" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Status Publikasi</option>
                    <option value="1" {{ $publish === '1' ? 'selected' : '' }}>Terpublikasi</option>
                    <option value="0" {{ $publish === '0' ? 'selected' : '' }}>Draft (Sembunyi)</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="w-full py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs transition-colors">
                    Filter
                </button>
                @if($search || $status || $publish !== null && $publish !== '')
                    <a href="{{ route('admin.activities.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors" title="Reset">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5">ID</th>
                        <th class="px-5 py-3.5">Judul & Tema Kegiatan</th>
                        <th class="px-5 py-3.5">Narasumber</th>
                        <th class="px-5 py-3.5">Tanggal / Jam</th>
                        <th class="px-5 py-3.5 text-center">Status Sesi</th>
                        <th class="px-5 py-3.5 text-center">Publikasi</th>
                        <th class="px-5 py-3.5 text-right">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($activities as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-slate-400">#{{ $item->id }}</td>
                            <td class="px-5 py-4">
                                <a href="{{ route('activities.show', $item->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-blue-700 transition-colors line-clamp-1">
                                    {{ $item->title }}
                                </a>
                                <div class="text-[11px] text-blue-700 line-clamp-1 mt-0.5">Tema: {{ $item->theme }}</div>
                                
                                <!-- Tautan Indicators -->
                                <div class="flex items-center gap-2 mt-1.5 text-[10px]">
                                    <span class="font-semibold text-slate-400">Tautan & Modul:</span>
                                    <a href="{{ route('admin.questions.index', $item->id) }}" class="px-1.5 py-0.2 rounded font-bold hover:underline {{ ($item->questions_count ?? 0) > 0 ? 'bg-indigo-100 text-indigo-800' : 'bg-amber-100 text-amber-800' }}" title="Klik untuk mengelola Bank Soal">
                                        Soal: {{ $item->questions_count ?? 0 }} Butir
                                    </a>
                                    <span class="px-1.5 py-0.2 rounded {{ $item->youtube_url ? 'bg-rose-100 text-rose-800' : 'bg-slate-100 text-slate-400' }}">YouTube</span>
                                    <span class="px-1.5 py-0.2 rounded {{ $item->zoom_url ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-400' }}">Zoom</span>
                                    <span class="px-1.5 py-0.2 rounded {{ $item->google_form_url ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-400' }}">G-Form</span>
                                    <span class="px-1.5 py-0.2 rounded {{ $item->certificate_url ? 'bg-indigo-100 text-indigo-800' : 'bg-slate-100 text-slate-400' }}">Sertifikat</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">{{ $item->speaker_name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $item->speaker_title ?? '-' }}</div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-700">{{ $item->formatted_date }}</div>
                                <div class="text-slate-400">{{ $item->formatted_time }}</div>
                            </td>
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                @if($item->status === 'ongoing')
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-100 text-rose-800 border border-rose-200">Live</span>
                                @elseif($item->status === 'upcoming')
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-blue-100 text-blue-800 border border-blue-200">Akan Datang</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">Selesai</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.activities.toggle-publish', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 rounded-full text-[11px] font-bold transition-all {{ $item->is_published ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}" title="Ubah status publikasi">
                                        {{ $item->is_published ? 'Publik' : 'Draft' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.questions.index', $item->id) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors text-xs font-bold" title="Kelola Bank Soal Kegiatan">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <span>Soal ({{ $item->questions_count ?? 0 }})</span>
                                    </a>
                                    <a href="{{ route('activities.show', $item->slug) }}" target="_blank" class="p-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100" title="Buka Halaman Peserta">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <a href="{{ route('admin.activities.edit', $item->id) }}" class="p-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100" title="Edit Data & Tautan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.activities.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100" title="Hapus Kegiatan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-slate-500">
                                Tidak ada data kegiatan yang cocok dengan kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection
