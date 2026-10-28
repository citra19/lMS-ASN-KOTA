<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sertifikat - {{ $certificate->certificate_number }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print {
                display: none !important;
            }
            .certificate-container {
                box-shadow: none !important;
                border: none !important;
                width: 297mm !important;
                height: 210mm !important;
                page-break-after: avoid !important;
                page-break-inside: avoid !important;
            }
        }
        .font-cinzel {
            font-family: 'Cinzel', serif;
        }
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
        .font-sans {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-800 font-sans text-slate-800 antialiased p-4 sm:p-8 flex flex-col items-center min-h-screen">

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="no-print max-w-[297mm] w-full mb-6 flex flex-wrap items-center justify-between gap-4 bg-slate-900/90 backdrop-blur-md p-4 rounded-2xl border border-slate-700 text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('my.certificates') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-xs font-bold text-slate-200 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali</span>
            </a>
            <div class="text-xs">
                <span class="text-slate-400">Nomor Registrasi:</span>
                <strong class="font-mono text-amber-400 ml-1">{{ $certificate->certificate_number }}</strong>
            </div>
        </div>
        
        <div class="flex items-center gap-2.5">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white text-xs font-bold shadow-md transition-all hover:scale-[1.02]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- Official Certificate Canvas (A4 Landscape: 297mm x 210mm) -->
    @if($certificate->activity->certificate_bg)
    <div class="certificate-container relative bg-white w-full max-w-[297mm] h-[210mm] shadow-2xl overflow-hidden flex flex-col justify-between p-10 sm:p-14 select-none" style="background-image: url('{{ asset('storage/' . $certificate->activity->certificate_bg) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    @else
    <div class="certificate-container relative bg-white w-full max-w-[297mm] h-[210mm] shadow-2xl overflow-hidden flex flex-col justify-between p-10 sm:p-14 select-none border-[12px] border-slate-900" style="background-image: radial-gradient(#f8fafc 1px, transparent 1px); background-size: 24px 24px;">

        <!-- Outer Double Ornamental Gold Border -->
        <div class="absolute inset-2 border-2 border-amber-600/60 pointer-events-none"></div>
        <div class="absolute inset-3 border border-amber-500/30 pointer-events-none"></div>

        <!-- Corner Ornaments -->
        <div class="absolute top-4 left-4 w-12 h-12 border-t-4 border-l-4 border-amber-600"></div>
        <div class="absolute top-4 right-4 w-12 h-12 border-t-4 border-r-4 border-amber-600"></div>
        <div class="absolute bottom-4 left-4 w-12 h-12 border-b-4 border-l-4 border-amber-600"></div>
        <div class="absolute bottom-4 right-4 w-12 h-12 border-b-4 border-r-4 border-amber-600"></div>

        <!-- Watermark Background Emblem -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.035]">
            <svg class="w-[500px] h-[500px]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L1 21h22L12 2zm0 3.5L18.5 19H5.5L12 5.5z"/>
            </svg>
        </div>
    @endif

        <!-- Certificate Header (Official Kop) -->
        <div class="relative text-center space-y-1">
            <div class="flex items-center justify-center gap-3 mb-1">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-800 to-slate-900 p-1.5 flex items-center justify-center shadow-md">
                    <svg class="w-full h-full text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                        <path d="M6 6h10"></path>
                        <polygon points="12 1 13.5 4 17 4.5 14.5 7 15 10.5 12 9 9 10.5 9.5 7 7 4.5 10.5 4" fill="currentColor" stroke="none" transform="scale(0.5) translate(12, 1)"></polygon>
                    </svg>
                </div>
                <div class="text-left leading-none">
                    <div class="text-[11px] font-bold tracking-widest text-slate-800 uppercase">PEMERINTAH KOTA PADANG</div>
                    <div class="text-[13px] font-black tracking-tight text-blue-900 uppercase">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</div>
                </div>
            </div>
            
            <div class="w-48 h-0.5 bg-gradient-to-r from-transparent via-amber-600 to-transparent mx-auto my-2"></div>

            <h1 class="text-4xl font-extrabold tracking-widest text-slate-900 font-cinzel pt-2">
                SERTIFIKAT
            </h1>
            <p class="text-xs font-mono font-bold tracking-wider text-slate-600 uppercase">
                Nomor: <span class="text-slate-900 font-black">{{ $certificate->certificate_number }}</span>
            </p>
        </div>

        <!-- Certificate Body -->
        <div class="relative text-center space-y-3 my-auto">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">
                Diberikan kepada:
            </p>

            <!-- ASN Recipient Name -->
            <div class="py-1">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-950 font-playfair tracking-wide underline decoration-amber-500/60 decoration-2 underline-offset-8">
                    {{ strtoupper($certificate->asn->name) }}
                </h2>
                <div class="flex items-center justify-center gap-3 text-xs text-slate-600 font-medium mt-2">
                    <span class="font-mono">NIP. {{ $certificate->asn->nip }}</span>
                    <span>•</span>
                    <span>{{ $certificate->asn->rank_group ?? 'Pegawai ASN' }}</span>
                    <span>•</span>
                    <strong class="text-slate-800">{{ $certificate->asn->opd }}</strong>
                </div>
            </div>

            <!-- Role & Activity Details -->
            <div class="max-w-2xl mx-auto space-y-1.5 pt-2">
                <p class="text-xs text-slate-600 leading-relaxed">
                    Atas partisipasi dan kelulusan kompetensinya sebagai <strong class="text-slate-900 uppercase tracking-wider font-extrabold">PESERTA</strong> dalam kegiatan pembelajaran:
                </p>
                <h3 class="text-lg font-bold text-slate-900 font-sans tracking-tight">
                    "{{ $certificate->activity->title }}"
                </h3>
                <p class="text-[11px] text-slate-500 font-medium">
                    Dilaksanakan pada {{ $certificate->activity->formatted_date }} melalui platform daring resmi BKPSDM Kota Padang, dengan beban setara <strong>{{ $certificate->activity->jp_hours ?? 3 }} Jam Pelajaran (JP)</strong>.
                </p>
            </div>
        </div>

        <!-- Certificate Footer (TTE & QR Code Verification) -->
        <div class="relative flex items-end justify-between pt-4 border-t border-slate-200/60">
            <!-- Left: QR Code Verification -->
            <div class="flex items-center gap-3 text-left">
                <div class="p-1 bg-white border border-slate-200 rounded-lg shadow-xs shrink-0">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code Verifikasi" class="w-20 h-20">
                </div>
                <div class="space-y-0.5 text-[10px] text-slate-500 max-w-[210px] leading-tight">
                    <strong class="block text-slate-800 font-bold">Verifikasi Dokumen Elektronik</strong>
                    <span>Pindai QR Code untuk memeriksa keabsahan sertifikat pada database resmi Pemerintah Kota Padang.</span>
                    <div class="font-mono text-[9px] text-blue-700 truncate pt-0.5">{{ $verifyUrl }}</div>
                </div>
            </div>

            <!-- Right: Electronic Signature (TTE) -->
            <div class="text-center min-w-[240px] space-y-1">
                <div class="text-[11px] text-slate-600">
                    Padang, {{ $certificate->issued_at ? $certificate->issued_at->format('d F Y') : now()->format('d F Y') }}
                </div>
                <div class="text-xs font-bold text-slate-800">
                    {{ $signer['title'] }}
                </div>

                <!-- TTE Badge Digital Stamp -->
                <div class="my-2 py-1 px-3 rounded-lg bg-emerald-50/80 border border-emerald-300 text-emerald-800 inline-flex items-center gap-1.5 text-[10px] font-bold">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Ditandatangani Secara Elektronik (BSrE)</span>
                </div>

                <div class="text-xs font-black text-slate-900 font-sans tracking-tight pt-1">
                    {{ $signer['name'] }}
                </div>
                <div class="text-[10px] font-mono text-slate-500">
                    NIP. {{ $signer['nip'] }}
                </div>
            </div>
        </div>

    </div>

</body>
</html>
