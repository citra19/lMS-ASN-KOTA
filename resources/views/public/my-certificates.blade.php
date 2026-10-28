@extends('layouts.app')

@section('title', 'Portofolio & Sertifikat Saya - LMS Rabu Belajar')

@section('content')
<section class="bg-gradient-to-b from-blue-950 via-slate-900 to-slate-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <span class="px-3 py-1 rounded-full bg-blue-900/60 border border-blue-700/50 text-blue-200 text-xs font-semibold">
                    Portofolio Pembelajaran ASN
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                    {{ $asn->name }}
                </h1>
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-300">
                    <span class="font-mono bg-white/10 px-2.5 py-0.5 rounded">NIP. {{ $asn->nip }}</span>
                    <span>•</span>
                    <span>{{ $asn->position }}</span>
                    <span>•</span>
                    <span class="text-amber-300">{{ $asn->opd }}</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-slate-800/80 border border-slate-700/80 rounded-2xl p-4 text-center min-w-[130px]">
                    <div class="text-2xl font-extrabold text-amber-400">{{ $certificates->count() }}</div>
                    <div class="text-xs text-slate-400 mt-0.5">Sertifikat Diraih</div>
                </div>
                <div class="bg-slate-800/80 border border-slate-700/80 rounded-2xl p-4 text-center min-w-[130px]">
                    <div class="text-2xl font-extrabold text-emerald-400">{{ $attendances->count() }}</div>
                    <div class="text-xs text-slate-400 mt-0.5">Sesi Dihadiri</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Daftar E-Sertifikat -->
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Daftar E-Sertifikat Resmi</h2>
                    <p class="text-xs text-slate-500">Sertifikat diterbitkan secara digital oleh BKPSDM Kota Padang setelah verifikasi kehadiran</p>
                </div>
            </div>

            @if($certificates->count() > 0)
                <div class="space-y-4">
                    @foreach($certificates as $cert)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:shadow-md transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Sertifikat Terbit
                                </span>
                                <h3 class="text-base font-bold text-slate-900">
                                    {{ $cert->activity->title }}
                                </h3>
                                <p class="text-xs text-slate-500 font-mono">
                                    No. Registrasi: <span class="text-slate-800 font-bold">{{ $cert->certificate_number }}</span>
                                </p>
                                <p class="text-xs text-slate-400">
                                    Tanggal Terbit: {{ $cert->issued_at ? $cert->issued_at->format('d M Y') : '-' }}
                                </p>
                            </div>

                            <div class="flex-shrink-0">
                                <a href="{{ route('certificates.show', $cert->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs shadow-md transition-all hover:scale-[1.02]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    <span>Lihat & Cetak PDF</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-10 border border-slate-200 text-center">
                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800">Belum Ada E-Sertifikat</h3>
                    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                        Ikuti kegiatan Rabu Belajar hingga tuntas dan isi formulir evaluasi untuk mendapatkan sertifikat pengembangan kompetensi.
                    </p>
                    <a href="{{ route('home') }}#daftar-kegiatan" class="inline-block mt-4 text-xs font-bold text-blue-700 hover:underline">
                        Lihat Agenda Kegiatan Sekarang &rarr;
                    </a>
                </div>
            @endif
        </div>

        <!-- Right: Riwayat Presensi -->
        <div class="lg:col-span-4 space-y-4">
            <h2 class="text-base font-extrabold text-slate-900 tracking-tight">Riwayat Kehadiran Sesi</h2>
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-xs space-y-3">
                @forelse($attendances as $att)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs space-y-1">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-slate-700">{{ $att->attended_at->format('d M Y, H:i') }} WIB</span>
                            <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-800 font-bold uppercase text-[9px]">{{ $att->platform }}</span>
                        </div>
                        <p class="font-semibold text-slate-900 line-clamp-1">{{ $att->activity->title }}</p>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-4">Belum ada riwayat presensi tercatat.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
