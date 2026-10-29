@extends('layouts.admin')

@section('title', 'Bank Soal - ' . $activity->title)
@section('page-title', 'Bank Soal & Asesmen Kegiatan')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-700 transition-colors">Dashboard</a>
        <span>/</span>
        <a href="{{ route('admin.activities.index') }}" class="hover:text-blue-700 transition-colors">Kelola Kegiatan</a>
        <span>/</span>
        <span class="text-slate-800 font-bold">Bank Soal</span>
    </nav>

    <!-- Header & Kegiatan Banner -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-44 h-44 bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-transparent rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-200/60">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Sesi Kegiatan #{{ $activity->id }}</span>
                    <span class="w-1 h-1 rounded-full bg-blue-400"></span>
                    <span>KKM: {{ $activity->passing_grade ?? 70 }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-snug">
                    {{ $activity->title }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 max-w-3xl">
                    Tema: <span class="text-slate-700 font-semibold">{{ $activity->theme }}</span> &bull; Narasumber: <span class="text-slate-700 font-semibold">{{ $activity->speaker_name }}</span>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <a href="{{ route('admin.questions.create', $activity->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs font-extrabold shadow-md shadow-blue-500/20 transition-all hover:scale-[1.02]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Butir Soal</span>
                </a>

                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <a href="{{ route('activities.pretest', $activity->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors" title="Pratinjau tampilan Pre-Test peserta">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>Cek Pre-Test</span>
                    </a>
                </div>

                <a href="{{ route('admin.activities.edit', $activity->id) }}" class="inline-flex items-center gap-1.5 px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Edit Kegiatan</span>
                </a>
            </div>
        </div>

        <!-- Info Card Banner -->
        <div class="mt-6 pt-5 border-t border-slate-100 grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Bank Soal</span>
                <span class="text-2xl font-black text-slate-800">{{ $stats['total'] }}</span>
                <span class="text-[11px] text-slate-400 font-medium"> Butir</span>
            </div>
            <div class="p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-100">
                <span class="block text-[11px] font-bold uppercase tracking-wider text-emerald-600">Pre & Post Test</span>
                <span class="text-2xl font-black text-emerald-700">{{ $stats['both'] }}</span>
                <span class="text-[11px] text-emerald-600 font-medium"> Soal Gabungan</span>
            </div>
            <div class="p-3.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                <span class="block text-[11px] font-bold uppercase tracking-wider text-sky-600">Khusus Pre-Test</span>
                <span class="text-2xl font-black text-sky-700">{{ $stats['pretest'] }}</span>
                <span class="text-[11px] text-sky-600 font-medium"> Soal Diagnostik</span>
            </div>
            <div class="p-3.5 rounded-2xl bg-purple-50/60 border border-purple-100">
                <span class="block text-[11px] font-bold uppercase tracking-wider text-purple-600">Khusus Post-Test</span>
                <span class="text-2xl font-black text-purple-700">{{ $stats['posttest'] }}</span>
                <span class="text-[11px] text-purple-600 font-medium"> Soal Kelulusan</span>
            </div>
        </div>
    </div>

    <!-- Alert Success Notification -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between text-xs font-bold animate-fadeIn">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
        </div>
    @endif

    <!-- Filter Tab Bar -->
    <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-3 rounded-2xl border border-slate-200/80 shadow-xs">
        <div class="flex items-center gap-1.5 overflow-x-auto text-xs font-bold">
            <a href="{{ route('admin.questions.index', $activity->id) }}" class="px-3.5 py-2 rounded-xl transition-colors {{ empty($typeFilter) ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                Semua Soal ({{ $stats['total'] }})
            </a>
            <a href="{{ route('admin.questions.index', [$activity->id, 'type' => 'both']) }}" class="px-3.5 py-2 rounded-xl transition-colors {{ $typeFilter === 'both' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                Keduanya / Both ({{ $stats['both'] }})
            </a>
            <a href="{{ route('admin.questions.index', [$activity->id, 'type' => 'pretest']) }}" class="px-3.5 py-2 rounded-xl transition-colors {{ $typeFilter === 'pretest' ? 'bg-sky-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                Pre-Test Saja ({{ $stats['pretest'] }})
            </a>
            <a href="{{ route('admin.questions.index', [$activity->id, 'type' => 'posttest']) }}" class="px-3.5 py-2 rounded-xl transition-colors {{ $typeFilter === 'posttest' ? 'bg-purple-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                Post-Test Saja ({{ $stats['posttest'] }})
            </a>
        </div>
        <div class="text-[11px] text-slate-400 font-medium px-2">
            Nilai otomatis dihitung 0 - 100 berdasarkan total butir yang tampil
        </div>
    </div>

    <!-- Questions Cards List -->
    <div class="space-y-4">
        @forelse($questions as $index => $item)
            <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs hover:border-blue-300 transition-all group">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-4 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 rounded-2xl bg-slate-900 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-xs">
                            {{ $item->order ?: ($index + 1) }}
                        </span>
                        <div>
                            <div class="flex items-center gap-2">
                                @if($item->type === 'both')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Pre-Test & Post-Test
                                    </span>
                                @elseif($item->type === 'pretest')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-sky-100 text-sky-800 border border-sky-200">
                                        Khusus Pre-Test
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-purple-100 text-purple-800 border border-purple-200">
                                        Khusus Post-Test
                                    </span>
                                @endif
                                <span class="text-[11px] text-slate-400 font-mono">ID #{{ $item->id }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-1.5 self-end sm:self-center">
                        <form action="{{ route('admin.questions.duplicate', [$activity->id, $item->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition-colors" title="Duplikasi Soal Ini">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </form>

                        <a href="{{ route('admin.questions.edit', [$activity->id, $item->id]) }}" class="p-2 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 transition-colors" title="Edit Soal">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>

                        <form action="{{ route('admin.questions.destroy', [$activity->id, $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus butir soal nomor {{ $item->order }} ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 transition-colors" title="Hapus Soal">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Isi Pertanyaan -->
                <div class="text-sm sm:text-base font-bold text-slate-900 leading-relaxed mb-5">
                    {{ $item->question_text }}
                </div>

                <!-- Grid Opsi Jawaban -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 mb-4">
                    @if(is_array($item->options))
                        @foreach($item->options as $key => $optionValue)
                            @php
                                $isCorrect = strtoupper(trim((string)$key)) === strtoupper(trim((string)$item->correct_answer));
                            @endphp
                            <div class="flex items-center gap-3 p-3 rounded-2xl border transition-colors {{ $isCorrect ? 'bg-emerald-50/70 border-emerald-300 ring-2 ring-emerald-400/20' : 'bg-slate-50/60 border-slate-200/80' }}">
                                <span class="w-7 h-7 rounded-xl font-black text-xs flex items-center justify-center shrink-0 {{ $isCorrect ? 'bg-emerald-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700' }}">
                                    {{ $key }}
                                </span>
                                <span class="text-xs sm:text-sm {{ $isCorrect ? 'font-bold text-emerald-950' : 'font-medium text-slate-700' }} flex-grow">
                                    {{ $optionValue }}
                                </span>
                                @if($isCorrect)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-emerald-200/80 text-emerald-900 text-[10px] font-extrabold uppercase shrink-0">
                                        <svg class="w-3 h-3 text-emerald-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        <span>Kunci</span>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Penjelasan / Pembahasan (Jika Ada) -->
                @if($item->explanation)
                    <div class="p-3.5 rounded-2xl bg-amber-50/60 border border-amber-200/80 text-xs text-amber-900 flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <strong class="font-extrabold">Pembahasan / Penjelasan:</strong>
                            <p class="mt-0.5 text-amber-800 leading-relaxed">{{ $item->explanation }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-xs">
                <div class="w-16 h-16 rounded-3xl bg-blue-50 text-blue-600 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-800 mb-1">Belum Ada Soal di Kegiatan Ini</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-6">
                    Buat butir soal pilihan ganda (A, B, C, D) untuk digunakan sebagai lembar Pre-Test dan Post-Test kelulusan peserta ASN.
                </p>
                <a href="{{ route('admin.questions.create', $activity->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-xs font-extrabold shadow-sm transition-all hover:scale-[1.02]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Soal Pertama Sekarang</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
