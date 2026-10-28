@extends('layouts.admin')

@section('title', 'Kelola E-Sertifikat - Admin LMS')
@section('page-title', 'Kelola Penerbitan E-Sertifikat')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">E-Sertifikat Digital ASN</h2>
            <p class="text-xs text-slate-500">Pusat monitoring, otomatisasi penerbitan, dan pengaturan template E-Sertifikat Rabu Belajar</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Pengaturan Penandatangan (TTE)</span>
            </a>
        </div>
    </div>

    <!-- Alert / Banner: Sistem Penerbitan Otomatis Aktif -->
    <div class="p-5 rounded-2xl bg-gradient-to-r from-emerald-500/10 via-teal-500/5 to-transparent border border-emerald-500/20 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div class="flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div class="space-y-0.5">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-extrabold text-slate-900">Sistem Penerbitan Otomatis Aktif</span>
                    <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">24/7 Otomatis</span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    <strong>Admin TIDAK PERLU memilih peserta satu per satu!</strong> E-Sertifikat otomatis diterbitkan oleh sistem dan langsung muncul di akun peserta begitu mereka menyelesaikan 4 syarat: <strong>Presensi</strong>, <strong>Pre-Test</strong>, <strong>Post-Test (Lulus KKM)</strong>, dan <strong>Evaluasi</strong>.
                </p>
            </div>
        </div>
    </div>

    <!-- Dua Kartu Utama: 1. Kelola Desain/Template & 2. Penerbitan Massal -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Kartu 1: Dimana Mengelola Template Sertifikat -->
        <div class="lg:col-span-5 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <span class="w-2 h-4 rounded bg-amber-500"></span>
                    <h3 class="text-sm font-bold text-slate-900">Pengelolaan Template & Desain Sertifikat</h3>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Template E-Sertifikat baku Pemko Padang (A4 Landscape, Kop resmi, QR Code keaslian, dan cap TTE) sudah terpasang otomatis. Anda dapat menyesuaikannya melalui:
                </p>
                <div class="space-y-2.5 pt-1">
                    <a href="{{ route('admin.activities.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-amber-50/60 border border-slate-200/80 transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs">
                                🎨
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 group-hover:text-amber-900">Background Kustom per Kegiatan</div>
                                <div class="text-[11px] text-slate-400">Edit Kegiatan &rarr; Bagian 3: Pengaturan E-Sertifikat</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-blue-50/60 border border-slate-200/80 transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center font-bold text-xs">
                                ✍️
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-800 group-hover:text-blue-900">Pejabat Penandatangan & TTE</div>
                                <div class="text-[11px] text-slate-400">Pengaturan Website &rarr; Nama, NIP & Jabatan Pimpinan</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="pt-2 text-[11px] text-slate-400 italic">
                Format nomor sertifikat dibuat otomatis sistem (contoh: <code class="text-blue-600 font-mono font-bold">BKPSDM-RB/2026/001/00025</code>).
            </div>
        </div>

        <!-- Kartu 2: Penerbitan Massal Sekaligus (Batch Generate) -->
        <div class="lg:col-span-7 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <span class="w-2 h-4 rounded bg-blue-600"></span>
                    <h3 class="text-sm font-bold text-slate-900">Penerbitan Massal Otomatis (Batch Sync)</h3>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Ingin menerbitkan sertifikat untuk seluruh ASN yang telah memenuhi kriteria kelulusan pada suatu sesi kegiatan sekaligus? Pilih kegiatan dan klik tombol di bawah:
                </p>

                <form action="{{ route('admin.certificates.batch-issue') }}" method="POST" class="space-y-3 pt-1">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pilih Sesi Kegiatan Rabu Belajar</label>
                        <select name="activity_id" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Sesi Kegiatan --</option>
                            @foreach($activities as $act)
                                <option value="{{ $act->id }}">{{ $act->title }} ({{ $act->formatted_date }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <span class="text-[11px] text-slate-400">Hanya menerbitkan untuk peserta yang belum punya sertifikat</span>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>Terbitkan Massal Otomatis</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Opsi Manual Override (Accordion Collapsible) -->
            <details class="pt-3 border-t border-slate-100 group">
                <summary class="text-xs font-bold text-slate-600 hover:text-slate-900 cursor-pointer flex items-center justify-between list-none">
                    <span class="flex items-center gap-1.5">
                        <span class="text-amber-500">⚠️</span>
                        <span>Opsi Cadangan: Terbitkan Manual Satu Peserta (Kasus Khusus / Override)</span>
                    </span>
                    <span class="text-xs text-slate-400 group-open:rotate-180 transition-transform">▼</span>
                </summary>
                <form action="{{ route('admin.certificates.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end pt-3">
                    @csrf
                    <div class="sm:col-span-5">
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Pilih Peserta ASN</label>
                        <select name="asn_id" required class="w-full px-2.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-xs">
                            <option value="">-- Pilih Peserta --</option>
                            @foreach($asns as $asn)
                                <option value="{{ $asn->id }}">{{ $asn->name }} ({{ $asn->nip }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Kegiatan</label>
                        <select name="activity_id" required class="w-full px-2.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-xs">
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach($activities as $act)
                                <option value="{{ $act->id }}">{{ $act->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="certificate_number" value="800/CERT-RB/{{ date('Ymd') }}/{{ rand(100,999) }}">
                    <input type="hidden" name="issued_at" value="{{ date('Y-m-d') }}">
                    <div class="sm:col-span-3">
                        <button type="submit" class="w-full py-2 px-3 rounded-lg bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs">
                            + Terbitkan Manual
                        </button>
                    </div>
                </form>
            </details>
        </div>

    </div>

    <!-- Table of Issued Certificates -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-4 bg-slate-50/50 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-3">
            <div>
                <span class="text-xs font-bold text-slate-800">Daftar E-Sertifikat Yang Telah Diterbitkan</span>
                <span class="ml-2 px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 text-[11px] font-bold font-mono">{{ $certificates->total() }} Sertifikat</span>
            </div>
            
            <form action="{{ route('admin.certificates.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari NIP, nama, atau no. sertifikat..." class="px-3.5 py-2 bg-white border border-slate-300 rounded-xl text-xs w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2 bg-slate-900 hover:bg-black text-white font-semibold text-xs rounded-xl transition-colors">Cari</button>
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
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-blue-700">
                                {{ $cert->certificate_number }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-900">{{ $cert->asn->name }}</div>
                                <div class="text-[11px] font-mono text-slate-400">NIP. {{ $cert->asn->nip }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-700">{{ $cert->asn->opd }}</td>
                            <td class="px-5 py-4 font-medium text-slate-800 max-w-xs truncate">{{ $cert->activity->title }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-slate-500">{{ $cert->issued_at ? $cert->issued_at->format('d M Y') : '-' }}</td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('certificates.show', $cert->id) }}" target="_blank" class="inline-flex items-center gap-1 text-blue-700 hover:text-blue-900 font-bold text-xs bg-blue-50 px-2.5 py-1 rounded-lg hover:bg-blue-100 transition-colors">
                                        <span>👁️ Lihat Sertifikat</span>
                                    </a>
                                    <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-xs">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-slate-500">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-2 text-lg">
                                    📜
                                </div>
                                <div class="font-bold text-slate-700">Belum Ada E-Sertifikat yang Diterbitkan</div>
                                <div class="text-xs text-slate-400 mt-0.5">Sertifikat akan otomatis muncul di sini begitu peserta menyelesaikan post-test & evaluasi, atau Anda dapat menggunakan tombol "Terbitkan Massal Otomatis" di atas.</div>
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

