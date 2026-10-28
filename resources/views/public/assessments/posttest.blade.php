@extends('layouts.app')

@section('title', 'Post-Test: ' . $activity->title)

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb & Back -->
        <div class="mb-6">
            <a href="{{ route('activities.show', $activity->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Detail Kegiatan</span>
            </a>
        </div>

        <!-- Top Header Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700 border border-indigo-200 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>Post-Test Evaluasi Pemahaman</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-snug">
                        {{ $activity->title }}
                    </h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-amber-50 px-3.5 py-2.5 rounded-2xl border border-amber-200/70 text-right">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-amber-700">KKM Kelulusan</span>
                        <strong class="text-sm font-black text-amber-900">{{ $activity->passing_grade ?? 70 }} Poin</strong>
                    </div>
                    <div class="bg-slate-50 px-3.5 py-2.5 rounded-2xl border border-slate-200/60 text-right">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Peserta ASN</span>
                        <strong class="block text-xs font-bold text-slate-800">{{ $asn->name }}</strong>
                    </div>
                </div>
            </div>

            <!-- Petunjuk -->
            <div class="mt-5 text-xs text-slate-600 bg-blue-50/70 border border-blue-200/60 p-4 rounded-2xl flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="leading-relaxed">
                    <strong>Syarat Kelulusan:</strong> Anda wajib memperoleh nilai sekurang-kurangnya <strong>{{ $activity->passing_grade ?? 70 }}</strong> untuk memenuhi syarat penerbitan E-Sertifikat Digital Rabu Belajar.
                </div>
            </div>
        </div>

        @if($existingAttempt && $existingAttempt->is_passed)
            <!-- Status LULUS Post-Test -->
            <div class="bg-white rounded-3xl p-8 sm:p-10 text-center shadow-sm border border-emerald-200/80 mb-8">
                <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 ring-8 ring-emerald-50">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                    Lulus KKM
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mb-2">Selamat! Anda Telah Lulus Post-Test</h2>
                <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                    Pemahaman Anda telah memenuhi standar kompetensi kegiatan ini. Silakan lanjutkan pengisian evaluasi narasumber untuk menerbitkan E-Sertifikat.
                </p>

                <div class="inline-flex items-center gap-6 p-6 rounded-2xl bg-slate-50 border border-slate-200/80 mb-8">
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Nilai Akhir</span>
                        <span class="text-4xl font-black text-emerald-600">{{ number_format($existingAttempt->score, 0) }}</span>
                    </div>
                    <div class="h-10 w-px bg-slate-200"></div>
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Batas KKM</span>
                        <span class="text-lg font-bold text-slate-700">{{ $activity->passing_grade ?? 70 }}</span>
                    </div>
                    <div class="h-10 w-px bg-slate-200"></div>
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Jawaban Benar</span>
                        <span class="text-lg font-bold text-slate-800">{{ $existingAttempt->correct_answers_count }} / {{ $existingAttempt->total_questions }}</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('activities.evaluation', $activity->slug) }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-blue-700 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-bold text-sm shadow-md transition-all hover:scale-[1.01] inline-flex items-center gap-2">
                        <span>Isi Evaluasi & Buka Sertifikat</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('activities.show', $activity->slug) }}" class="px-6 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition-all">
                        Kembali ke Detail Kegiatan
                    </a>
                </div>
            </div>
        @else
            @if($existingAttempt && ! $existingAttempt->is_passed)
                <!-- Banner Peringatan Belum Lulus KKM -->
                <div class="bg-rose-50 border border-rose-200 text-rose-900 p-5 rounded-2xl mb-8 flex items-start gap-4">
                    <svg class="w-6 h-6 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>
                        <strong class="block font-bold text-sm">Nilai Percobaan Sebelumnya: {{ number_format($existingAttempt->score, 0) }} (Belum Lulus)</strong>
                        <p class="text-xs text-rose-700 mt-0.5 leading-relaxed">
                            Batas nilai kelulusan minimal (KKM) adalah <strong>{{ $activity->passing_grade ?? 70 }}</strong>. Anda dapat mencoba kembali mengisi lembar ujian di bawah ini.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Lembar Soal Ujian Post-Test -->
            <form action="{{ route('activities.posttest.submit', $activity->slug) }}" method="POST" id="posttest-form">
                @csrf
                <div class="space-y-6 mb-8">
                    @forelse($questions as $index => $q)
                        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80">
                            <div class="flex items-start gap-3.5 mb-5">
                                <span class="w-8 h-8 rounded-xl bg-indigo-100 text-indigo-800 font-black text-sm flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </span>
                                <div class="text-base font-semibold text-slate-900 pt-0.5 leading-relaxed">
                                    {{ $q->question_text }}
                                </div>
                            </div>

                            <!-- Pilihan Jawaban -->
                            <div class="grid grid-cols-1 gap-3 pl-0 sm:pl-11">
                                @if(is_array($q->options))
                                    @foreach($q->options as $key => $opt)
                                        <label class="group flex items-center gap-3.5 p-3.5 rounded-2xl border border-slate-200/80 hover:border-indigo-500 hover:bg-indigo-50/40 cursor-pointer transition-all">
                                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $key }}" required class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                            <span class="w-6 h-6 rounded-lg bg-slate-100 group-hover:bg-indigo-200/60 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0 transition-colors">
                                                {{ $key }}
                                            </span>
                                            <span class="text-sm text-slate-700 group-hover:text-slate-900 font-medium">
                                                {{ $opt }}
                                            </span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
                            <p class="text-slate-500 text-sm">Belum ada butir soal Post-Test yang ditambahkan untuk kegiatan ini.</p>
                        </div>
                    @endforelse
                </div>

                @if($questions->isNotEmpty())
                    <div class="sticky bottom-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-200 flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">
                            KKM Kelulusan: <strong class="text-slate-900">{{ $activity->passing_grade ?? 70 }} Poin</strong> (Total {{ $questions->count() }} Soal)
                        </span>
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim jawaban Post-Test ini?')" class="px-6 py-3 rounded-xl bg-indigo-700 hover:bg-indigo-800 text-white font-bold text-sm shadow-md transition-all hover:scale-[1.01]">
                            Kirim Jawaban Post-Test
                        </button>
                    </div>
                @endif
            </form>
        @endif
    </div>
</div>
@endsection
