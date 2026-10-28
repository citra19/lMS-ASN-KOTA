@extends('layouts.app')

@section('title', 'Evaluasi & Umpan Balik: ' . $activity->title)

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb & Back -->
        <div class="mb-6">
            <a href="{{ route('activities.show', $activity->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Detail Kegiatan</span>
            </a>
        </div>

        @if($existingEvaluation)
            <!-- Status Sudah Mengisi Evaluasi -->
            <div class="bg-white rounded-3xl p-8 sm:p-10 text-center shadow-sm border border-slate-200/80 mb-8">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 mb-2">Evaluasi Telah Terkirim</h2>
                <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                    Terima kasih atas ulasan dan umpan balik yang Anda berikan. Masukan Anda sangat berarti bagi peningkatan kualitas kegiatan Rabu Belajar selanjutnya.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('activities.show', $activity->slug) }}" class="px-6 py-3 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm shadow-sm transition-all">
                        Kembali ke Detail Kegiatan
                    </a>
                    <a href="{{ route('my.certificates') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-sm transition-all">
                        Lihat Sertifikat Saya
                    </a>
                </div>
            </div>
        @else
            <!-- Form Evaluasi & Umpan Balik Mandiri -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 mb-8">
                <div class="pb-6 border-b border-slate-100 mb-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        <span>Formulir Kepuasan & Umpan Balik</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-snug">
                        {{ $activity->title }}
                    </h1>
                    <p class="text-xs text-slate-500 mt-1">
                        Narasumber: <strong>{{ $activity->speaker_name }}</strong>
                    </p>
                </div>

                <form action="{{ route('activities.evaluation.submit', $activity->slug) }}" method="POST" class="space-y-7">
                    @csrf

                    <!-- 1. Rating Narasumber -->
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/70">
                        <label class="block text-sm font-bold text-slate-800 mb-1">
                            1. Penguasaan Materi & Kejelasan Penyampaian Narasumber
                        </label>
                        <p class="text-xs text-slate-500 mb-4">
                            Seberapa jelas dan mudah dipahami materi yang dibawakan oleh {{ $activity->speaker_name }}?
                        </p>
                        <div class="flex items-center gap-3">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="flex-1 text-center cursor-pointer">
                                    <input type="radio" name="speaker_rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }} class="peer sr-only">
                                    <div class="p-3 rounded-xl border border-slate-200 bg-white peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-600 font-bold text-sm transition-all hover:border-amber-400">
                                        {{ $i }} ★
                                    </div>
                                    <span class="block text-[10px] text-slate-400 mt-1">
                                        @if($i == 1) Buruk @elseif($i == 5) Sangat Baik @endif
                                    </span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <!-- 2. Rating Bahan Materi -->
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/70">
                        <label class="block text-sm font-bold text-slate-800 mb-1">
                            2. Kebermanfaatan & Kualitas Bahan Pembelajaran
                        </label>
                        <p class="text-xs text-slate-500 mb-4">
                            Seberapa relevan materi ini untuk menunjang tugas dan fungsi kedinasan Anda?
                        </p>
                        <div class="flex items-center gap-3">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="flex-1 text-center cursor-pointer">
                                    <input type="radio" name="material_rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }} class="peer sr-only">
                                    <div class="p-3 rounded-xl border border-slate-200 bg-white peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-600 font-bold text-sm transition-all hover:border-amber-400">
                                        {{ $i }} ★
                                    </div>
                                    <span class="block text-[10px] text-slate-400 mt-1">
                                        @if($i == 1) Kurang @elseif($i == 5) Sangat Bermanfaat @endif
                                    </span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <!-- 3. Rating Fasilitasi Penyelenggara -->
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/70">
                        <label class="block text-sm font-bold text-slate-800 mb-1">
                            3. Kualitas Fasilitasi & Pelayanan Tim BKPSDM Kota Padang
                        </label>
                        <p class="text-xs text-slate-500 mb-4">
                            Kualitas siaran (Zoom/YouTube), ketepatan waktu, dan kemudahan akses portal.
                        </p>
                        <div class="flex items-center gap-3">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="flex-1 text-center cursor-pointer">
                                    <input type="radio" name="organizer_rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }} class="peer sr-only">
                                    <div class="p-3 rounded-xl border border-slate-200 bg-white peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-600 font-bold text-sm transition-all hover:border-amber-400">
                                        {{ $i }} ★
                                    </div>
                                    <span class="block text-[10px] text-slate-400 mt-1">
                                        @if($i == 1) Kurang @elseif($i == 5) Sangat Puas @endif
                                    </span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <!-- 4. Kritik, Saran, & Topik Berikutnya -->
                    <div>
                        <label for="feedback_text" class="block text-sm font-bold text-slate-800 mb-1">
                            Saran, Masukan, atau Usulan Tema Rabu Belajar Berikutnya (Opsional)
                        </label>
                        <textarea name="feedback_text" id="feedback_text" rows="4" placeholder="Tuliskan masukan Anda untuk peningkatan program Rabu Belajar BKPSDM..." class="w-full rounded-2xl border border-slate-200 p-4 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent"></textarea>
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400">
                            Terhubung ke akun: <strong>{{ $asn->name }}</strong>
                        </span>
                        <button type="submit" class="px-7 py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-bold text-sm shadow-md transition-all hover:scale-[1.01] inline-flex items-center gap-2">
                            <span>Kirim Evaluasi & Selesaikan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
