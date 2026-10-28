@props(['size' => 'md', 'light' => false])

@php
    $dimensions = match($size) {
        'sm' => ['icon' => 'w-8 h-8', 'text' => 'text-base', 'sub' => 'text-xs'],
        'lg' => ['icon' => 'w-14 h-14', 'text' => 'text-2xl', 'sub' => 'text-sm'],
        default => ['icon' => 'w-10 h-10', 'text' => 'text-xl', 'sub' => 'text-xs'],
    };
    $textColor = $light ? 'text-white' : 'text-slate-900';
    $subColor = $light ? 'text-amber-300' : 'text-amber-700';
    $metaColor = $light ? 'text-slate-300' : 'text-slate-500';
@endphp

<div class="flex items-center gap-3">
    <!-- Emblem Padang / Rabu Belajar -->
    <div class="relative flex-shrink-0 {{ $dimensions['icon'] }} rounded-xl bg-gradient-to-br from-blue-700 via-indigo-800 to-slate-900 p-2 shadow-md flex items-center justify-center border border-amber-400/30">
        <svg class="w-full h-full text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <!-- Book / Knowledge with Star & Rumah Gadang gonjong arch -->
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
            <path d="M6 6h10"></path>
            <path d="M6 10h10"></path>
            <polygon points="12 1 13.5 4 17 4.5 14.5 7 15 10.5 12 9 9 10.5 9.5 7 7 4.5 10.5 4" fill="currentColor" stroke="none" transform="scale(0.5) translate(12, 1)"></polygon>
        </svg>
        <span class="absolute -bottom-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500 border border-white"></span>
        </span>
    </div>

    <!-- Text Titles -->
    <div class="leading-tight">
        <div class="flex items-center gap-1.5">
            <span class="font-extrabold tracking-tight {{ $dimensions['text'] }} {{ $textColor }}">
                RABU <span class="text-amber-600 dark:text-amber-400">BELAJAR</span>
            </span>
            <span class="px-1.5 py-0.5 text-[10px] font-bold tracking-wider rounded bg-blue-100 text-blue-800 uppercase border border-blue-200">
                LMS ASN
            </span>
        </div>
        <div class="font-semibold {{ $dimensions['sub'] }} {{ $subColor }}">
            BKPSDM KOTA PADANG
        </div>
    </div>
</div>
