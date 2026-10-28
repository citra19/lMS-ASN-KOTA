@extends('layouts.admin')

@section('title', 'Rekap Presensi Kegiatan - Admin LMS')
@section('page-title', 'Rekapitulasi Presensi Rabu Belajar')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Presensi Kehadiran Peserta ASN</h2>
            <p class="text-xs text-slate-500">Rekap log absensi otomatis saat ASN mengakses link Zoom Meeting atau Evaluasi kegiatan</p>
        </div>
        <div>
            <a href="{{ route('admin.attendances.export', ['activity_id' => $activityId]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                <span>Unduh Rekap Presensi (Excel / CSV)</span>
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs">
        <form action="{{ route('admin.attendances.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <div class="sm:col-span-5">
                <select name="activity_id" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white">
                    <option value="">Semua Sesi Kegiatan Rabu Belajar</option>
                    @foreach($activities as $act)
                        <option value="{{ $act->id }}" {{ $activityId == $act->id ? 'selected' : '' }}>
                            {{ $act->formatted_date }} - {{ $act->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-5">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari NIP, nama pegawai, atau OPD..." class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white">
            </div>
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="w-full py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs transition-colors">
                    Filter
                </button>
                @if($activityId || $search)
                    <a href="{{ route('admin.attendances.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors" title="Reset">
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
                        <th class="px-5 py-3.5">Waktu Presensi</th>
                        <th class="px-5 py-3.5">NIP & Nama Pegawai</th>
                        <th class="px-5 py-3.5">Perangkat Daerah (OPD)</th>
                        <th class="px-5 py-3.5">Kegiatan Yang Diikuti</th>
                        <th class="px-5 py-3.5 text-center">Akses Platform</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($attendances as $row)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900">{{ $row->attended_at->format('d M Y') }}</div>
                                <div class="text-[11px] text-slate-400">{{ $row->attended_at->format('H:i:s') }} WIB</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900">{{ $row->asn->name }}</div>
                                <div class="text-[11px] font-mono text-slate-500">NIP. {{ $row->asn->nip }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-medium text-slate-800">{{ $row->asn->opd }}</div>
                                <div class="text-[11px] text-slate-400">{{ $row->asn->position }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-900 max-w-xs truncate">{{ $row->activity->title }}</div>
                                <div class="text-[11px] text-slate-400">Sesi: {{ $row->activity->formatted_date }}</div>
                            </td>
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $row->platform === 'zoom' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }}">
                                    {{ $row->platform }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-slate-500">
                                Belum ada catatan presensi untuk sesi ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection
