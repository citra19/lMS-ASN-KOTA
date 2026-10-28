@extends('layouts.admin')

@section('title', 'Tambah Kegiatan Baru - LMS Rabu Belajar')
@section('page-title', 'Tambah Kegiatan Rabu Belajar')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Formulir Tambah Kegiatan Baru</h2>
            <p class="text-xs text-slate-500">Isi lengkap rincian kegiatan dan seluruh tautan pembelajaran daring sesuai format</p>
        </div>
        <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            <span>Kembali</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
            <div class="font-bold">Mohon perbaiki kesalahan input berikut:</div>
            <ul class="list-disc pl-4 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Bagian 1: Informasi Dasar Kegiatan -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-blue-600"></span>
                    <span>1. Informasi Utama Kegiatan</span>
                </h3>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Judul Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Rabu Belajar Seri #26: Strategi Manajemen Talenta ASN" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tema Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="text" name="theme" value="{{ old('theme') }}" required placeholder="Contoh: Implementasi Merit Sistem dalam Pengembangan Karir ASN BerAKHLAK" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Narasumber <span class="text-rose-500">*</span></label>
                        <input type="text" name="speaker_name" value="{{ old('speaker_name') }}" required placeholder="Nama lengkap beserta gelar" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Jabatan / Asal Instansi Narasumber</label>
                        <input type="text" name="speaker_title" value="{{ old('speaker_title') }}" placeholder="Contoh: Widyaiswara Ahli Utama LAN RI" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tanggal Pelaksanaan <span class="text-rose-500">*</span></label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Waktu Mulai <span class="text-rose-500">*</span></label>
                        <input type="time" name="start_time" value="{{ old('start_time', '09:00') }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Waktu Selesai</label>
                        <input type="time" name="end_time" value="{{ old('end_time', '12:00') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Deskripsi Singkat Kegiatan</label>
                    <textarea name="description" rows="3" placeholder="Ringkasan poin pembelajaran, urgensi materi, dan sasaran peserta..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Seluruh Tautan Pembelajaran (Proposal Poin 8.c) -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-rose-600"></span>
                    <span>2. Pengelolaan Tautan dan File Akses Kegiatan</span>
                </h3>
                <p class="text-xs text-slate-400 mt-0.5">Tautan ini otomatis dihubungkan ke tombol-tombol akses pada halaman peserta</p>
            </div>

            <div class="space-y-4">
                <!-- YouTube -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Link Live YouTube</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="https://youtube.com/watch?v=..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Zoom Section -->
                <div class="p-4 bg-blue-50/60 rounded-xl border border-blue-100 space-y-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-blue-950 mb-1">Link Zoom Meeting</label>
                        <input type="url" name="zoom_url" value="{{ old('zoom_url') }}" placeholder="https://zoom.us/j/..." class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">Zoom Meeting ID</label>
                            <input type="text" name="zoom_meeting_id" value="{{ old('zoom_meeting_id') }}" placeholder="883 4920 1928" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">Zoom Passcode</label>
                            <input type="text" name="zoom_passcode" value="{{ old('zoom_passcode') }}" placeholder="RABU2026" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">
                        </div>
                    </div>
                </div>

                <!-- Pre-Test -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Link Pre-Test</label>
                    <input type="url" name="pretest_url" value="{{ old('pretest_url') }}" placeholder="https://forms.gle/..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Google Form Gabungan -->
                <div class="p-4 bg-emerald-50/60 rounded-xl border border-emerald-100">
                    <label class="block text-xs font-bold uppercase tracking-wider text-emerald-950 mb-1">Link Google Form Gabungan (Post-Test, Absensi, & Evaluasi)</label>
                    <p class="text-xs text-emerald-800 mb-2">Sesuai proposal, 1 tombol ke 1 formulir yang memuat identitas peserta, post-test, absensi, dan evaluasi.</p>
                    <input type="url" name="google_form_url" value="{{ old('google_form_url') }}" placeholder="https://forms.gle/..." class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Bahan Pembelajaran -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Link Bahan Belajar (Google Drive / URL)</label>
                        <input type="url" name="material_url" value="{{ old('material_url') }}" placeholder="https://drive.google.com/..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Atau Unggah File Bahan (PDF, PPT, ZIP)</label>
                        <input type="file" name="material_file" accept=".pdf,.ppt,.pptx,.zip,.rar,.doc,.docx" class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <!-- Virtual Background Upload -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Unggah Gambar Virtual Background (JPG, PNG)</label>
                    <input type="file" name="virtual_background" accept="image/*" class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100">
                </div>

                <!-- Sertifikat -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Link Sertifikat Digital</label>
                    <input type="url" name="certificate_url" value="{{ old('certificate_url') }}" placeholder="https://bkpsdm.padang.go.id/sertifikat/..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-[11px] text-slate-400 mt-1">Dapat dikosongkan terlebih dahulu dan diisi setelah kegiatan selesai serta sertifikat diterbitkan panitia.</p>
                </div>
            </div>
        </div>

        <!-- Bagian 3: Status Sesi & Publikasi -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-emerald-600"></span>
                    <span>3. Status Pelaksanaan & Publikasi</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Status Sesi Kegiatan <span class="text-rose-500">*</span></label>
                    <select name="status" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="upcoming" {{ old('status') === 'upcoming' ? 'selected' : '' }}>📅 Akan Datang (Upcoming)</option>
                        <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>🔴 Sedang Berlangsung (Live)</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>✅ Telah Selesai (Completed / Arsip)</option>
                    </select>
                </div>

                <div class="pt-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', '1') == '1' ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                        <div>
                            <span class="text-sm font-bold text-slate-800">Publikasikan Kegiatan</span>
                            <p class="text-xs text-slate-500">Jika dicentang, kegiatan akan langsung tampil di halaman peserta website</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end gap-3 pt-4">
            <a href="{{ route('admin.activities.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-md transition-all">
                Simpan & Publikasikan Kegiatan
            </button>
        </div>
    </form>
</div>
@endsection
