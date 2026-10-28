@extends('layouts.app')

@section('title', 'Aktivasi Data ASN - LMS Rabu Belajar BKPSDM Kota Padang')

@section('content')
<section class="py-16 sm:py-20 bg-slate-100 flex-grow flex items-center">
    <div class="max-w-xl w-full mx-auto px-4 sm:px-6">
        
        <div class="text-center mb-8">
            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold uppercase tracking-wider border border-blue-200">
                Pendaftaran Mandiri Pegawai
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-3">
                Aktivasi Akun Peserta ASN
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                Lengkapi identitas kepegawaian Anda di lingkungan Pemerintah Kota Padang untuk kemudahan absensi dan integrasi sertifikat kegiatan.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-xl space-y-6">
            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
                    <div class="font-bold">Mohon perbaiki isian formulir:</div>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nip" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">NIP (18 Digit) <span class="text-rose-500">*</span></label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required maxlength="18" placeholder="1995..." class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Ahmad Fadli, S.STP" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="opd" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Perangkat Daerah / OPD <span class="text-rose-500">*</span></label>
                        <input type="text" id="opd" name="opd" value="{{ old('opd') }}" required placeholder="Contoh: Diskominfo / Bappeda / BKPSDM" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="position" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Jabatan <span class="text-rose-500">*</span></label>
                        <input type="text" id="position" name="position" value="{{ old('position') }}" required placeholder="Contoh: Analis Kebijakan Ahli Muda" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="rank_group" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pangkat / Golongan</label>
                        <input type="text" id="rank_group" name="rank_group" value="{{ old('rank_group') }}" placeholder="Contoh: Penata / III/c" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Dinas / Pribadi</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@padang.go.id" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Kata Sandi <span class="text-rose-500">*</span></label>
                        <input type="password" id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Ulangi Kata Sandi <span class="text-rose-500">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" placeholder="Ulangi kata sandi" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-blue-700 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 text-white font-bold text-sm shadow-md shadow-blue-500/20 transition-all hover:scale-[1.01]">
                        Daftar & Masuk ke Sistem
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-slate-100 text-center">
                <span class="text-xs text-slate-500">Sudah memiliki akun terdaftar?</span>
                <a href="{{ route('login') }}" class="text-xs font-bold text-blue-700 hover:text-blue-900 ml-1">
                    Masuk di sini
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
