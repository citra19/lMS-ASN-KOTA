@extends('layouts.admin')

@section('title', 'Pengaturan Website - LMS Rabu Belajar')
@section('page-title', 'Pengaturan Identitas & Kontak Website')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div>
        <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">Pengaturan Identitas Lembaga & Portal</h2>
        <p class="text-xs text-slate-500">Konfigurasi nama website, profil pimpinan penandatangan, alamat kantor BKPSDM, dan kontak bantuan teknis</p>
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

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Bagian 1: Identitas Website (Poin 8.d.1) -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-blue-600"></span>
                    <span>1. Logo dan Identitas Website</span>
                </h3>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Judul Website</label>
                        <input type="text" name="site_title" value="{{ old('site_title', $settings['site_title'] ?? 'LMS Rabu Belajar Kota Padang') }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Slogan / Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Pusat Informasi & Sarana Pembelajaran Daring ASN Kota Padang') }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nama Badan / Perangkat Daerah</label>
                        <input type="text" name="agency_name" value="{{ old('agency_name', $settings['agency_name'] ?? 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Padang') }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Pemerintah Daerah Induk</label>
                        <input type="text" name="parent_agency" value="{{ old('parent_agency', $settings['parent_agency'] ?? 'Pemerintah Kota Padang') }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Pimpinan Penandatangan (Sesuai Surat Proposal BKPSDM Padang) -->
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80 space-y-3">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-800">Pejabat Pimpinan / Penanggung Jawab</div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Pimpinan</label>
                            <input type="text" name="head_officer_name" value="{{ old('head_officer_name', $settings['head_officer_name'] ?? 'TARMIZI ISMAIL, S.Sos., M.Si') }}" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">NIP Pimpinan</label>
                            <input type="text" name="head_officer_nip" value="{{ old('head_officer_nip', $settings['head_officer_nip'] ?? '196803031989021003') }}" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Jabatan & Pangkat</label>
                            <input type="text" name="head_officer_title" value="{{ old('head_officer_title', $settings['head_officer_title'] ?? 'Plt. Kepala BKPSDM (Pembina Utama Muda)') }}" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-xs">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Informasi Kontak (Poin 8.d.2) -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-amber-500"></span>
                    <span>2. Informasi Kontak & Alamat Kantor</span>
                </h3>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Alamat Kantor Lengkap</label>
                    <textarea name="address" rows="2" required class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $settings['address'] ?? 'Jalan Bagindo Aziz Chan By Pass No.1 Aie Pacah Padang, Kode Pos 25176') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nomor Telepon Kantor</label>
                        <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '(0751) 462209') }}" required class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Faksimile</label>
                        <input type="text" name="fax" value="{{ old('fax', $settings['fax'] ?? '(0751) 462205') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Alamat Email Resmi</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'bkd.pdg@gmail.com') }}" required class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tautan Laman Resmi BKPSDM Padang</label>
                    <input type="text" name="website" value="{{ old('website', $settings['website'] ?? 'https://bkd.padang.go.id') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white">
                </div>
            </div>
        </div>

        <!-- Bagian 3: Informasi Umum Rabu Belajar (Poin 8.d.3) -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-4 rounded bg-emerald-600"></span>
                    <span>3. Informasi Umum Rabu Belajar</span>
                </h3>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Ringkasan & Misi Program Rabu Belajar (Tampil di Beranda & Footer)</label>
                <textarea name="about_summary" rows="4" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 leading-relaxed">{{ old('about_summary', $settings['about_summary'] ?? 'Website LMS Rabu Belajar dirancang sebagai pusat informasi dan sarana akses pembelajaran daring bagi Aparatur Sipil Negara (ASN) di lingkungan Pemerintah Kota Padang.') }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-md transition-all">
                Simpan Seluruh Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
