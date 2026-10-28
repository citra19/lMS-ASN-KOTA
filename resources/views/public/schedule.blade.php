@extends('layouts.app')

@section('title', 'Jadwal Agenda - LMS Rabu Belajar BKPSDM Kota Padang')

@section('content')
<section class="bg-gradient-to-b from-blue-950 via-slate-900 to-slate-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="px-3 py-1 rounded-full bg-blue-900/60 border border-blue-700/50 text-blue-200 text-xs font-semibold">
                Kalender Pelaksanaan
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mt-3">
                Jadwal Kegiatan Rabu Belajar
            </h1>
            <p class="text-sm sm:text-base text-slate-300 mt-2">
                Jadwal terstruktur seluruh sesi pembelajaran daring mingguan BKPSDM Pemerintah Kota Padang. Catat tanggalnya dan tingkatkan kompetensi Anda.
            </p>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if($activities->count() > 0)
        <div class="space-y-12">
            @foreach($activities as $period => $items)
                <div>
                    <!-- Month Header -->
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">{{ $period }}</h2>
                        <div class="h-px bg-slate-200 flex-grow"></div>
                        <span class="text-xs font-semibold text-slate-500">{{ $items->count() }} Kegiatan</span>
                    </div>

                    <!-- Items Timeline -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($items as $item)
                            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs hover:shadow-lg transition-all hover:border-blue-400 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <span class="text-xs font-bold text-blue-800 bg-blue-50 px-2.5 py-0.5 rounded-lg border border-blue-100">
                                            {{ $item->formatted_date }}
                                        </span>
                                        @if($item->status === 'ongoing')
                                            <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-100 text-rose-800 animate-pulse">Live</span>
                                        @elseif($item->status === 'upcoming')
                                            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-blue-100 text-blue-800">Akan Datang</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">Selesai</span>
                                        @endif
                                    </div>

                                    <h3 class="text-base font-bold text-slate-900 line-clamp-2 mt-2 mb-1">
                                        <a href="{{ route('activities.show', $item->slug) }}" class="hover:text-blue-700 transition-colors">
                                            {{ $item->title }}
                                        </a>
                                    </h3>

                                    <p class="text-xs text-slate-500 line-clamp-2 mb-3">
                                        {{ $item->theme }}
                                    </p>

                                    <div class="text-xs text-slate-600 bg-slate-50 p-2.5 rounded-xl border border-slate-100 space-y-1">
                                        <p><span class="text-slate-400">Pukul:</span> <span class="font-semibold">{{ $item->formatted_time }}</span></p>
                                        <p><span class="text-slate-400">Narasumber:</span> <span class="font-semibold text-slate-800">{{ $item->speaker_name }}</span></p>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        @if($item->youtube_url) <span class="w-2 h-2 rounded-full bg-rose-500" title="YouTube Tersedia"></span> @endif
                                        @if($item->zoom_url) <span class="w-2 h-2 rounded-full bg-blue-500" title="Zoom Tersedia"></span> @endif
                                        @if($item->certificate_url) <span class="w-2 h-2 rounded-full bg-emerald-500" title="Sertifikat Tersedia"></span> @endif
                                    </div>
                                    <a href="{{ route('activities.show', $item->slug) }}" class="text-xs font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                                        <span>Buka Detail</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto">
            <h3 class="text-lg font-bold text-slate-800">Belum ada agenda kegiatan</h3>
            <p class="text-sm text-slate-500 mt-1">Agenda kegiatan baru akan segera diumumkan oleh BKPSDM Kota Padang.</p>
        </div>
    @endif
</div>
@endsection
