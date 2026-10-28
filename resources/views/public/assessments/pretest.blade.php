@extends('layouts.app')

@section('title', 'Pre-Test: ' . $activity->title)

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
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sky-50 text-sky-700 border border-sky-200 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.5L19 7.5V19a2 2 0 01-2 2z"/></svg>
                        <span>Pre-Test Diagnostik Awal</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-snug">
                        {{ $activity->title }}
                    </h1>
                </div>
                <div class="bg-slate-50 px-4 py-3 rounded-2xl border border-slate-200/60 shrink-0 text-left sm:text-right">
                    <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Peserta ASN</span>
                    <strong class="block text-xs font-bold text-slate-800">{{ $asn->name }}</strong>
                    <span class="block text-[10px] font-mono text-slate-500">NIP. {{ $asn->nip }}</span>
                </div>
            </div>

            <!-- Petunjuk -->
            <div class="mt-5 text-xs text-slate-600 bg-amber-50/70 border border-amber-200/60 p-4 rounded-2xl flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="leading-relaxed">
                    <strong>Petunjuk Pre-Test:</strong> Uji diagnostik awal bertujuan mengukur pemahaman awal sebelum mengikuti pemaparan narasumber. Pilihlah jawaban yang paling tepat. Hasil Pre-Test tidak menggugurkan kepesertaan Anda.
                </div>
            </div>
        </div>

        @if($existingAttempt)
            <!-- Hasil Pre-Test (Jika Sudah Selesai) -->
            <div class="bg-white rounded-3xl p-8 text-center shadow-sm border border-slate-200/80">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 mb-1">Pre-Test Selesai Dikerjakan!</h2>
                <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                    Terima kasih telah berpartisipasi dalam asesmen diagnostik awal kegiatan Rabu Belajar.
                </p>

                <div class="inline-flex items-center gap-6 p-6 rounded-2xl bg-slate-50 border border-slate-200/80 mb-8">
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Skor Diagnostik</span>
                        <span class="text-4xl font-black text-blue-700">{{ number_format($existingAttempt->score, 0) }}</span>
                    </div>
                    <div class="h-10 w-px bg-slate-200"></div>
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Benar / Total</span>
                        <span class="text-lg font-bold text-slate-800">{{ $existingAttempt->correct_answers_count }} / {{ $existingAttempt->total_questions }} Soal</span>
                    </div>
                    <div class="h-10 w-px bg-slate-200"></div>
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400">Tanggal Selesai</span>
                        <span class="text-xs font-semibold text-slate-700">{{ $existingAttempt->finished_at ? $existingAttempt->finished_at->format('d M Y, H:i') : '-' }} WIB</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('activities.show', $activity->slug) }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-sm transition-all">
                        Kembali ke Halaman Kegiatan
                    </a>
                    @if($activity->zoom_url)
                        <a href="{{ route('activities.access', [$activity->slug, 'zoom']) }}" class="px-6 py-3 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm shadow-sm transition-all inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span>Gabung Zoom Meeting</span>
                        </a>
                    @endif
                </div>
            </div>
        @else
            <!-- Lembar Soal Ujian Pre-Test -->
            <form action="{{ route('activities.pretest.submit', $activity->slug) }}" method="POST" id="pretest-form">
                @csrf
                <div class="space-y-6 mb-8">
                    @forelse($questions as $index => $q)
                        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80">
                            <div class="flex items-start gap-3.5 mb-5">
                                <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-800 font-black text-sm flex items-center justify-center shrink-0">
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
                                        <label class="group flex items-center gap-3.5 p-3.5 rounded-2xl border border-slate-200/80 hover:border-blue-500 hover:bg-blue-50/40 cursor-pointer transition-all">
                                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $key }}" required class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-slate-300">
                                            <span class="w-6 h-6 rounded-lg bg-slate-100 group-hover:bg-blue-200/60 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0 transition-colors">
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
                            <p class="text-slate-500 text-sm">Belum ada butir soal Pre-Test yang ditambahkan untuk kegiatan ini.</p>
                        </div>
                    @endforelse
                </div>

                @if($questions->isNotEmpty())
                    <div class="sticky bottom-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-200 flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">
                            Total: <strong>{{ $questions->count() }} Soal</strong> Pilihan Ganda
                        </span>
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim jawaban Pre-Test ini?')" class="px-6 py-3 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm shadow-md transition-all hover:scale-[1.01]">
                            Kirim Jawaban Pre-Test
                        </button>
                    </div>
                @endif
            </form>
        @endif
    </div>
</div>
@endsection
