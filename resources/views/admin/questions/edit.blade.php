@extends('layouts.admin')

@section('title', 'Edit Soal #' . $question->order . ' - ' . $activity->title)
@section('page-title', 'Edit Butir Soal #' . $question->order)

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 font-medium">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-700 transition-colors">Dashboard</a>
        <span>/</span>
        <a href="{{ route('admin.activities.index') }}" class="hover:text-blue-700 transition-colors">Kelola Kegiatan</a>
        <span>/</span>
        <a href="{{ route('admin.questions.index', $activity->id) }}" class="hover:text-blue-700 transition-colors">Bank Soal</a>
        <span>/</span>
        <span class="text-slate-800 font-bold">Edit Soal #{{ $question->order }}</span>
    </nav>

    <!-- Header Box -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-[11px] font-bold border border-blue-200/60 mb-1.5">
                <span>Kegiatan: {{ Str::limit($activity->title, 45) }}</span>
            </div>
            <h1 class="text-xl font-black text-slate-900 tracking-tight">Edit Butir Soal Nomor #{{ $question->order }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui pertanyaan, opsi jawaban, atau kunci jawaban untuk butir soal ini.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.questions.index', $activity->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors shrink-0">
                &larr; Kembali
            </a>
        </div>
    </div>

    <!-- Error Validation Alert -->
    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs font-semibold space-y-1">
            <strong class="font-extrabold flex items-center gap-1.5 text-rose-700">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Terjadi kesalahan pada input:
            </strong>
            <ul class="list-disc list-inside pl-1 space-y-0.5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.questions.update', [$activity->id, $question->id]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Pengaturan Tipe & Nomor Urut -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <span class="w-2 h-4 rounded bg-blue-600"></span>
                <h2 class="text-sm font-extrabold text-slate-900">1. Klasifikasi & Urutan Soal</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Tipe Soal -->
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Muncul Pada Ujian <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                        <label class="relative flex flex-col p-3.5 rounded-2xl border cursor-pointer transition-all hover:bg-slate-50 {{ old('type', $question->type) === 'both' ? 'border-emerald-500 bg-emerald-50/40 ring-2 ring-emerald-400/20' : 'border-slate-200' }}">
                            <input type="radio" name="type" value="both" {{ old('type', $question->type) === 'both' ? 'checked' : '' }} class="sr-only">
                            <span class="text-xs font-extrabold text-emerald-800">Pre & Post Test</span>
                            <span class="text-[10px] text-slate-500 mt-0.5">Disarankan (keduanya)</span>
                        </label>

                        <label class="relative flex flex-col p-3.5 rounded-2xl border cursor-pointer transition-all hover:bg-slate-50 {{ old('type', $question->type) === 'pretest' ? 'border-sky-500 bg-sky-50/40 ring-2 ring-sky-400/20' : 'border-slate-200' }}">
                            <input type="radio" name="type" value="pretest" {{ old('type', $question->type) === 'pretest' ? 'checked' : '' }} class="sr-only">
                            <span class="text-xs font-extrabold text-sky-800">Khusus Pre-Test</span>
                            <span class="text-[10px] text-slate-500 mt-0.5">Diagnostik awal</span>
                        </label>

                        <label class="relative flex flex-col p-3.5 rounded-2xl border cursor-pointer transition-all hover:bg-slate-50 {{ old('type', $question->type) === 'posttest' ? 'border-purple-500 bg-purple-50/40 ring-2 ring-purple-400/20' : 'border-slate-200' }}">
                            <input type="radio" name="type" value="posttest" {{ old('type', $question->type) === 'posttest' ? 'checked' : '' }} class="sr-only">
                            <span class="text-xs font-extrabold text-purple-800">Khusus Post-Test</span>
                            <span class="text-[10px] text-slate-500 mt-0.5">Evaluasi kelulusan</span>
                        </label>
                    </div>
                </div>

                <!-- Nomor Urut -->
                <div class="space-y-2">
                    <label for="order" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nomor Urut Soal <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" id="order" name="order" value="{{ old('order', $question->order) }}" min="1" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="block text-[11px] text-slate-400">Diurutkan mulai dari angka 1 ke atas.</span>
                </div>
            </div>
        </div>

        <!-- 2. Isi Teks Pertanyaan -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <span class="w-2 h-4 rounded bg-indigo-600"></span>
                <h2 class="text-sm font-extrabold text-slate-900">2. Teks Pertanyaan / Soal</h2>
            </div>

            <div>
                <label for="question_text" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Tuliskan Pertanyaan <span class="text-rose-500">*</span>
                </label>
                <textarea id="question_text" name="question_text" rows="4" required placeholder="Tuliskan pertanyaan..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 leading-relaxed">{{ old('question_text', $question->question_text) }}</textarea>
            </div>
        </div>

        <!-- 3. Pilihan Ganda & Kunci Jawaban -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-emerald-600"></span>
                    <h2 class="text-sm font-extrabold text-slate-900">3. Pilihan Ganda & Kunci Jawaban Benar</h2>
                </div>
                <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                    Pilih Radio Kunci untuk Jawaban yang Benar
                </span>
            </div>

            <div class="space-y-3.5 pt-1">
                @php
                    $letters = ['A', 'B', 'C', 'D', 'E'];
                    $selectedCorrect = old('correct_answer', $question->correct_answer);
                    $existingOptions = is_array($question->options) ? $question->options : [];
                @endphp

                @foreach($letters as $letter)
                    @php
                        $isRequired = in_array($letter, ['A', 'B']);
                        $optValue = old("options.{$letter}", $existingOptions[$letter] ?? '');
                    @endphp
                    <div class="p-3.5 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white transition-all flex items-start gap-3.5 focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:border-blue-500">
                        
                        <!-- Radio Button Kunci Jawaban -->
                        <div class="pt-2 flex flex-col items-center">
                            <label class="cursor-pointer group flex flex-col items-center gap-1" title="Tandai {{ $letter }} sebagai kunci jawaban">
                                <input type="radio" name="correct_answer" value="{{ $letter }}" {{ strtoupper((string)$selectedCorrect) === $letter ? 'checked' : '' }} required class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 border-slate-300">
                                <span class="text-[10px] font-extrabold text-slate-400 group-hover:text-emerald-700 uppercase">Kunci</span>
                            </label>
                        </div>

                        <!-- Badge Huruf -->
                        <div class="w-8 h-8 rounded-xl bg-slate-900 text-white font-black text-xs flex items-center justify-center shrink-0 mt-1 shadow-xs">
                            {{ $letter }}
                        </div>

                        <!-- Input Teks Opsi -->
                        <div class="flex-grow">
                            <input type="text" name="options[{{ $letter }}]" value="{{ $optValue }}" placeholder="Teks pilihan jawaban {{ $letter }}{{ $isRequired ? ' (Wajib)' : ' (Opsional)' }}" {{ $isRequired ? 'required' : '' }} class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none focus:border-blue-500 font-medium">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 4. Penjelasan / Pembahasan (Opsional) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <span class="w-2 h-4 rounded bg-amber-500"></span>
                <h2 class="text-sm font-extrabold text-slate-900">4. Pembahasan / Penjelasan Jawaban (Opsional)</h2>
            </div>

            <div>
                <label for="explanation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Alasan / Landasan Jawaban
                </label>
                <textarea id="explanation" name="explanation" rows="3" placeholder="Tuliskan alasan atau dasar regulasi mengapa jawaban tersebut benar..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 leading-relaxed">{{ old('explanation', $question->explanation) }}</textarea>
                <span class="block text-[11px] text-slate-400 mt-1">Muncul sebagai bahan evaluasi jika diperlukan bagi peserta.</span>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="flex items-center justify-between gap-3 pt-2">
            <button type="button" onclick="if(confirm('Apakah Anda yakin ingin menghapus butir soal ini?')) { document.getElementById('delete-question-form').submit(); }" class="px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition-colors">
                Hapus Soal Ini
            </button>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.questions.index', $activity->id) }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs font-extrabold shadow-md shadow-blue-500/20 transition-all hover:scale-[1.02]">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>

    <form id="delete-question-form" action="{{ route('admin.questions.destroy', [$activity->id, $question->id]) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection
