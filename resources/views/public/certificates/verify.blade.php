@extends('layouts.app')

@section('title', 'Verifikasi Keaslian Sertifikat - BKPSDM Kota Padang')

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($certificate)
            <!-- Status Sertifikat Terverifikasi Asli -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-emerald-200 text-center">
                <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 ring-8 ring-emerald-50">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>

                <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                    Dokumen Resmi Terverifikasi
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mb-2">
                    E-Sertifikat Asli & Terdaftar
                </h1>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-8">
                    Data sertifikat di bawah ini tercatat resmi pada pangkalan data Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM) Pemerintah Kota Padang.
                </p>

                <!-- Tabel Detail Verifikasi -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200/80 text-left space-y-3.5 text-xs mb-8">
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">Nomor Registrasi:</span>
                        <strong class="font-mono text-blue-700 text-sm">{{ $certificate->certificate_number }}</strong>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">Nama Penerima:</span>
                        <strong class="text-slate-900 text-sm uppercase">{{ $certificate->asn->name }}</strong>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">NIP:</span>
                        <span class="font-mono text-slate-800 font-bold">{{ $certificate->asn->nip }}</span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">Instansi / OPD:</span>
                        <span class="text-slate-800 font-semibold">{{ $certificate->asn->opd }}</span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">Kegiatan Pembelajaran:</span>
                        <strong class="text-slate-900 text-right max-w-sm">{{ $certificate->activity->title }}</strong>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">Beban Jam Pelajaran (JP):</span>
                        <span class="font-bold text-amber-700">{{ $certificate->activity->jp_hours ?? 3 }} JP</span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 border-b border-slate-200/60 gap-1">
                        <span class="text-slate-500">Tanggal Terbit:</span>
                        <span class="text-slate-800">{{ $certificate->issued_at ? $certificate->issued_at->format('d F Y') : '-' }}</span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-between py-1.5 gap-1">
                        <span class="text-slate-500">Penandatangan Resmi:</span>
                        <span class="text-slate-800 font-semibold text-right">{{ $signer['name'] }} ({{ $signer['title'] }})</span>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm transition-all">
                        Kembali ke Beranda LMS
                    </a>
                </div>
            </div>
        @else
            <!-- Status Tidak Ditemukan -->
            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-rose-200 text-center">
                <div class="w-20 h-20 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto mb-4 ring-8 ring-rose-50">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 mb-2">Sertifikat Tidak Ditemukan</h1>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-6">
                    Nomor registrasi <strong class="font-mono text-slate-800">{{ $number }}</strong> tidak terdaftar dalam pangkalan data resmi BKPSDM Kota Padang. Pastikan URL verifikasi sudah benar.
                </p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 rounded-xl bg-slate-900 text-white font-bold text-xs">
                    Kembali ke Beranda
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
