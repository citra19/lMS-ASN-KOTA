<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AssessmentAttempt;
use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display landing page with highlighted and upcoming activities
     */
    public function index(Request $request)
    {
        Activity::autoSyncStatuses();

        $search = $request->query('q');
        $statusFilter = $request->query('status');

        $query = Activity::published()->search($search);

        if ($statusFilter && in_array($statusFilter, ['upcoming', 'ongoing', 'completed'])) {
            $query->where('status', $statusFilter);
        }

        // Hero Highlighted Activity: ongoing first, or earliest upcoming
        $featuredActivity = Activity::published()
            ->whereIn('status', ['ongoing', 'upcoming'])
            ->orderByRaw("CASE WHEN status = 'ongoing' THEN 1 ELSE 2 END")
            ->orderBy('date', 'asc')
            ->first();

        // All activities for listing
        $activities = $query->orderBy('date', 'desc')->paginate(9)->withQueryString();

        // Statistics for info counter
        $stats = [
            'total' => Activity::published()->count(),
            'ongoing' => Activity::published()->where('status', 'ongoing')->count(),
            'upcoming' => Activity::published()->where('status', 'upcoming')->count(),
            'completed' => Activity::published()->where('status', 'completed')->count(),
        ];

        return view('public.index', compact('featuredActivity', 'activities', 'stats', 'search', 'statusFilter'));
    }

    /**
     * Display detailed activity page with all 7 access buttons
     */
    public function show(string $slug)
    {
        $activity = Activity::published()->where('slug', $slug)->firstOrFail();

        // Increment view counter quietly
        $activity->increment('views_count');

        // Check if currently logged in ASN has progress in this activity
        $hasAttended = false;
        $pretestAttempt = null;
        $posttestAttempt = null;
        $hasEvaluated = false;
        $myCertificate = null;

        if (Auth::guard('asn')->check()) {
            $asnId = Auth::guard('asn')->id();
            $hasAttended = Attendance::where('asn_id', $asnId)
                ->where('activity_id', $activity->id)
                ->exists();

            $pretestAttempt = AssessmentAttempt::where('asn_id', $asnId)
                ->where('activity_id', $activity->id)
                ->where('type', 'pretest')
                ->first();

            $posttestAttempt = AssessmentAttempt::where('asn_id', $asnId)
                ->where('activity_id', $activity->id)
                ->where('type', 'posttest')
                ->latest()
                ->first();

            $hasEvaluated = Evaluation::where('asn_id', $asnId)
                ->where('activity_id', $activity->id)
                ->exists();

            $myCertificate = Certificate::where('asn_id', $asnId)
                ->where('activity_id', $activity->id)
                ->first();
        }

        // Calculate LMS Learning Journey Progress (4 Core Milestones)
        $completedSteps = 0;
        if ($hasAttended) {
            $completedSteps++;
        }
        if ($pretestAttempt) {
            $completedSteps++;
        }
        if ($posttestAttempt && $posttestAttempt->is_passed) {
            $completedSteps++;
        }
        if ($hasEvaluated) {
            $completedSteps++;
        }
        $learningProgress = (int) round(($completedSteps / 4) * 100);

        // Other activities for recommendations
        $otherActivities = Activity::published()
            ->where('id', '!=', $activity->id)
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        return view('public.show', compact(
            'activity',
            'otherActivities',
            'hasAttended',
            'pretestAttempt',
            'posttestAttempt',
            'hasEvaluated',
            'myCertificate',
            'learningProgress',
            'completedSteps'
        ));
    }

    /**
     * Dedicated Schedule Page (Jadwal Kegiatan)
     */
    public function schedule(Request $request)
    {
        $month = $request->query('month');
        $query = Activity::published();

        if ($month) {
            $query->whereMonth('date', $month);
        }

        $activities = $query->orderBy('date', 'asc')->get()->groupBy(function ($item) {
            return $item->date->format('F Y');
        });

        return view('public.schedule', compact('activities', 'month'));
    }

    /**
     * Unified Gate: All 7 Activity Features Require ASN Login
     * Types: youtube, zoom, pretest, background, evaluasi, materi, sertifikat
     */
    public function access(Request $request, string $slug, string $type)
    {
        $activity = Activity::published()->where('slug', $slug)->firstOrFail();

        $labels = [
            'youtube' => 'Siaran Live YouTube',
            'zoom' => 'Webinar Zoom Meeting',
            'materi' => 'Bahan & Modul Pembelajaran',
            'presensi' => 'Presensi Kehadiran Pembelajaran',
            'pretest' => 'Pre-Test Diagnostik Mandiri',
            'posttest' => 'Post-Test Evaluasi Kelulusan',
            'evaluasi' => 'Formulir Evaluasi & Umpan Balik Sesi',
            'sertifikat' => 'E-Sertifikat Pengembangan Kompetensi',
            'background' => 'Virtual Background Kegiatan',
        ];

        $featureLabel = $labels[$type] ?? 'Layanan Pembelajaran';

        // 1. Check Authentication: Must be logged in as ASN
        if (! Auth::guard('asn')->check()) {
            session()->put('url.intended', route('activities.access', [$activity->slug, $type]));

            return redirect()->route('login')
                ->with('warning', "Untuk mengakses {$featureLabel}, Anda wajib masuk terlebih dahulu menggunakan Akun SSO ASN Pemko Padang.");
        }

        $asn = Auth::guard('asn')->user();

        // 2. Handle Feature Specific Actions
        switch ($type) {
            case 'zoom':
                // Record Zoom attendance log
                Attendance::updateOrCreate(
                    [
                        'asn_id' => $asn->id,
                        'activity_id' => $activity->id,
                    ],
                    [
                        'platform' => 'zoom',
                        'attended_at' => now(),
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                    ]
                );

                if (! $activity->zoom_url) {
                    return back()->with('error', 'Tautan Zoom Meeting belum diset oleh panitia.');
                }

                return redirect()->away($activity->zoom_url);

            case 'evaluasi':
                // Redirect to native in-system evaluation form
                return redirect()->route('activities.evaluation', $activity->slug);

            case 'posttest':
                // Redirect to native in-system post-test
                return redirect()->route('activities.posttest', $activity->slug);

            case 'presensi':
                // 1-Click native presence
                return redirect()->route('activities.presence', $activity->slug);

            case 'youtube':
                if (! $activity->youtube_url) {
                    return back()->with('error', 'Tautan siaran YouTube belum tersedia.');
                }

                return redirect()->away($activity->youtube_url);

            case 'pretest':
                // Redirect to native in-system pre-test
                return redirect()->route('activities.pretest', $activity->slug);

            case 'background':
                if ($activity->virtual_background && Storage::disk('public')->exists($activity->virtual_background)) {
                    return response()->download(storage_path('app/public/'.$activity->virtual_background));
                }

                // Default standard SVG background download
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1080" viewBox="0 0 1920 1080"><rect fill="#0f172a" width="1920" height="1080"/><text x="50%" y="45%" dominant-baseline="middle" text-anchor="middle" fill="#f59e0b" font-size="54" font-family="sans-serif" font-weight="bold">RABU BELAJAR BKPSDM KOTA PADANG</text><text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-size="36" font-family="sans-serif">'.htmlspecialchars($activity->title).'</text></svg>';

                return response($svg, 200, [
                    'Content-Type' => 'image/svg+xml',
                    'Content-Disposition' => 'attachment; filename="Virtual-Background-'.$activity->slug.'.svg"',
                ]);

            case 'materi':
                if ($activity->material_url) {
                    return redirect()->away($activity->material_url);
                }

                if ($activity->material_file && Storage::disk('public')->exists($activity->material_file)) {
                    return response()->download(storage_path('app/public/'.$activity->material_file));
                }

                return back()->with('error', 'Bahan pembelajaran sedang dipersiapkan oleh narasumber/panitia.');

            case 'sertifikat':
                // Check if certificate was issued in certificates table
                $cert = Certificate::where('asn_id', $asn->id)->where('activity_id', $activity->id)->first();
                if ($cert) {
                    return redirect()->route('certificates.show', $cert->id);
                }

                if ($activity->certificate_url) {
                    return redirect()->away($activity->certificate_url);
                }

                return redirect()->route('activities.show', $activity->slug)
                    ->with('warning', 'E-Sertifikat belum dapat diakses. Lengkapi 4 tahapan kelulusan LMS: Presensi, Pre-Test, Lulus Post-Test (KKM '.$activity->passing_grade.'), dan Pengisian Evaluasi.');

            default:
                return back()->with('error', 'Layanan tidak dikenali.');
        }
    }

    /**
     * Legacy direct zoom route redirecting to access gate
     */
    public function joinZoom(Request $request, string $slug)
    {
        return $this->access($request, $slug, 'zoom');
    }

    /**
     * Legacy direct evaluation route redirecting to access gate
     */
    public function joinEvaluation(Request $request, string $slug)
    {
        return $this->access($request, $slug, 'evaluasi');
    }

    /**
     * Legacy download background
     */
    public function downloadBackground(string $slug)
    {
        return $this->access(request(), $slug, 'background');
    }

    /**
     * My Certificates page for authenticated ASN
     */
    public function myCertificates()
    {
        if (! Auth::guard('asn')->check()) {
            session()->put('url.intended', route('my.certificates'));

            return redirect()->route('login')
                ->with('info', 'Silakan masuk dengan Akun SSO ASN Anda untuk melihat daftar e-sertifikat yang telah Anda peroleh.');
        }

        $asn = Auth::guard('asn')->user();
        $certificates = Certificate::with('activity')
            ->where('asn_id', $asn->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $attendances = Attendance::with('activity')
            ->where('asn_id', $asn->id)
            ->orderBy('attended_at', 'desc')
            ->get();

        return view('public.my-certificates', compact('asn', 'certificates', 'attendances'));
    }
}
