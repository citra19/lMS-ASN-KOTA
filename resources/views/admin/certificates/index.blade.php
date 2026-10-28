@extends('layouts.admin')

@section('title', 'Kelola E-Sertifikat - Admin LMS')
@section('page-title', 'Kelola Penerbitan E-Sertifikat')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">E-Sertifikat Digital ASN</h2>
            <p class="text-xs text-slate-500">Penerbitan dan validasi nomor registrasi sertifikat kegiatan Rabu Belajar</p>
        </div>
    </div>

    <!-- Issue Certificate Card (Form Tambah Cepat) -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
        <div class="border-b border-slate-100 pb-3">
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2 h-4 rounded bg-emerald-600"></span>
                <span>Terbitkan Sertifikat untuk Peserta</span>
            </h3>
        </div>

        <form action="{{ route('admin.certificates.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
            @csrf

            <div class="sm:col-span-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pilih Peserta ASN</label>
                <select name="asn_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Nama Pegawai ASN --</option>
                    @foreach($asns as $asn)
                        <option value="{{ $asn->id }}">{{ $asn->name }} ({{ $asn->nip }}) - {{ $asn->opd }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pilih Sesi Kegiatan</label>
                <select name="activity_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Sesi Kegiatan --</option>
                    @foreach($activities as $act)
                        <option value="{{ $act->id }}">{{ $act->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nomor Registrasi Sertifikat</label>
                <input type="text" name="certificate_number" value="800/CERT-RB/{{ date('Ymd') }}/{{ rand(100,999) }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs font-mono focus:bg-white">
            </div>

            <input type="hidden" name="issued_at" value="{{ date('Y-m-d') }}">

            <div class="sm:col-span-2">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-md transition-all">
                    + Terbitkan
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-4 bg-slate-50/50 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-3">
            <span class="text-xs font-bold text-slate-700">Daftar Sertifikat Yang Telah Diterbitkan ({{ $certificates->total() }})</span>
            
            <form action="{{ route('admin.certificates.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari NIP, nama, atau no. sertifikat..." class="px-3 py-1.5 bg-white border border-slate-300 rounded-xl text-xs w-64">
                <button type="submit" class="px-3 py-1.5 bg-slate-800 text-white font-semibold text-xs rounded-xl">Cari</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5">Nomor Registrasi</th>
                        <th class="px-5 py-3.5">Penerima (ASN)</th>
                        <th class="px-5 py-3.5">Perangkat Daerah (OPD)</th>
                        <th class="px-5 py-3.5">Kegiatan</th>
                        <th class="px-5 py-3.5">Tanggal Terbit</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($certificates as $cert)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-blue-700">{{ $cert->certificate_number }}</td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900">{{ $cert->asn->name }}</div>
                                <div class="text-[11px] font-mono text-slate-400">NIP. {{ $cert->asn->nip }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-700">{{ $cert->asn->opd }}</td>
                            <td class="px-5 py-4 font-medium text-slate-800 max-w-xs truncate">{{ $cert->activity->title }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-slate-500">{{ $cert->issued_at ? $cert->issued_at->format('d M Y') : '-' }}</td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-[11px]">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-slate-500">
                                Belum ada sertifikat yang diterbitkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200">
            {{ $certificates->links() }}
        </div>
    </div>
</div>
@endsection
