@extends('layouts.admin')

@section('title', 'Data Peserta ASN - Admin LMS')
@section('page-title', 'Data Peserta ASN Kota Padang')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Database Pegawai ASN Terdaftar</h2>
            <p class="text-xs text-slate-500">Daftar ASN Pemerintah Kota Padang yang telah mengaktivasi akun di portal LMS Rabu Belajar</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs">
        <form action="{{ route('admin.participants.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <div class="sm:col-span-6">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari NIP, nama pegawai, jabatan..." class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="sm:col-span-4">
                <select name="opd" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white">
                    <option value="">Semua OPD / Instansi</option>
                    @foreach($opdList as $unit)
                        <option value="{{ $unit }}" {{ $opd === $unit ? 'selected' : '' }}>{{ $unit }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="w-full py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs transition-colors">
                    Filter
                </button>
                @if($search || $opd)
                    <a href="{{ route('admin.participants.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors" title="Reset">
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
                        <th class="px-5 py-3.5">NIP</th>
                        <th class="px-5 py-3.5">Nama Pegawai & Pangkat</th>
                        <th class="px-5 py-3.5">Perangkat Daerah (OPD)</th>
                        <th class="px-5 py-3.5">Jabatan</th>
                        <th class="px-5 py-3.5 text-center">Presensi</th>
                        <th class="px-5 py-3.5 text-center">Sertifikat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($participants as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-slate-800">{{ $item->nip }}</td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900">{{ $item->name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $item->rank_group ?? '-' }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-lg bg-blue-50 text-blue-800 font-medium text-[11px] border border-blue-100">
                                    {{ $item->opd }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-700">{{ $item->position }}</td>
                            <td class="px-5 py-4 text-center">
                                <span class="font-extrabold text-blue-700">{{ $item->attendances_count }} kali</span>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <span class="font-extrabold text-emerald-700">{{ $item->certificates_count }} diraih</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-slate-500">
                                Belum ada peserta ASN yang cocok dengan filter pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200">
            {{ $participants->links() }}
        </div>
    </div>
</div>
@endsection
