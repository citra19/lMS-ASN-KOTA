<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Asn;
use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Evaluation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of issued certificates
     */
    public function index(Request $request)
    {
        $activityId = $request->query('activity_id');
        $search = $request->query('q');

        $query = Certificate::with(['asn', 'activity']);

        if ($activityId) {
            $query->where('activity_id', $activityId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('certificate_number', 'like', "%{$search}%")
                    ->orWhereHas('asn', function ($sub) use ($search) {
                        $sub->where('nip', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    });
            });
        }

        $certificates = $query->orderBy('issued_at', 'desc')->paginate(15)->withQueryString();
        $activities = Activity::orderBy('date', 'desc')->get();
        $asns = Asn::orderBy('name', 'asc')->get();

        return view('admin.certificates.index', compact('certificates', 'activities', 'asns', 'activityId', 'search'));
    }

    /**
     * Issue a single certificate manually (for emergency / manual override)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asn_id' => ['required', 'exists:asns,id'],
            'activity_id' => ['required', 'exists:activities,id'],
            'certificate_number' => ['required', 'string', 'max:100', 'unique:certificates,certificate_number'],
            'issued_at' => ['required', 'date'],
        ]);

        Certificate::create($validated);

        return back()->with('success', 'E-Sertifikat berhasil diterbitkan secara manual.');
    }

    /**
     * Issue certificates in batch for all qualified participants who completed all stages
     */
    public function batchIssue(Request $request)
    {
        $request->validate([
            'activity_id' => ['required', 'exists:activities,id'],
        ]);

        $activity = Activity::findOrFail($request->activity_id);

        // Find all ASNs who have completed: Attendance, Pre-Test, Passed Post-Test, and Evaluation
        $qualifiedAsns = Asn::whereHas('attendances', fn ($q) => $q->where('activity_id', $activity->id))
            ->whereHas('assessmentAttempts', fn ($q) => $q->where('activity_id', $activity->id)->where('type', 'pretest'))
            ->whereHas('assessmentAttempts', fn ($q) => $q->where('activity_id', $activity->id)->where('type', 'posttest')->where('is_passed', true))
            ->whereHas('evaluations', fn ($q) => $q->where('activity_id', $activity->id))
            ->whereDoesntHave('certificates', fn ($q) => $q->where('activity_id', $activity->id))
            ->get();

        if ($qualifiedAsns->isEmpty()) {
            return back()->with('info', "Semua peserta yang telah lulus pada kegiatan '{$activity->title}' sudah memiliki sertifikat, atau belum ada peserta baru yang memenuhi seluruh syarat kelulusan.");
        }

        $issuedCount = 0;
        foreach ($qualifiedAsns as $asn) {
            $count = Certificate::where('activity_id', $activity->id)->count() + 1;
            $certNumber = sprintf('BKPSDM-RB/%s/%03d/%05d', now()->format('Y'), $activity->id, $count);

            Certificate::create([
                'asn_id' => $asn->id,
                'activity_id' => $activity->id,
                'certificate_number' => $certNumber,
                'issued_at' => now(),
            ]);

            $issuedCount++;
        }

        return back()->with('success', "Berhasil menerbitkan {$issuedCount} E-Sertifikat secara massal untuk seluruh peserta yang lulus pada kegiatan '{$activity->title}'.");
    }

    /**
     * Remove the certificate
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return back()->with('success', 'E-Sertifikat berhasil dihapus.');
    }

    /**
     * Update certificate template and settings for an activity directly
     */
    public function updateTemplate(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => ['required', 'exists:activities,id'],
            'jp_hours' => ['required', 'integer', 'min:1', 'max:50'],
            'passing_grade' => ['required', 'integer', 'min:10', 'max:100'],
            'certificate_bg' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'remove_certificate_bg' => ['nullable', 'boolean'],
        ]);

        $activity = Activity::findOrFail($validated['activity_id']);

        if ($request->boolean('remove_certificate_bg')) {
            if ($activity->certificate_bg && Storage::disk('public')->exists($activity->certificate_bg)) {
                Storage::disk('public')->delete($activity->certificate_bg);
            }
            $activity->certificate_bg = null;
        } elseif ($request->hasFile('certificate_bg')) {
            if ($activity->certificate_bg && Storage::disk('public')->exists($activity->certificate_bg)) {
                Storage::disk('public')->delete($activity->certificate_bg);
            }
            $activity->certificate_bg = $request->file('certificate_bg')->store('certificate_bgs', 'public');
        }

        $activity->jp_hours = $validated['jp_hours'];
        $activity->passing_grade = $validated['passing_grade'];
        $activity->save();

        return back()->with('success', "Pengaturan template E-Sertifikat untuk kegiatan '{$activity->title}' berhasil disimpan.");
    }

    /**
     * Preview certificate template for a specific activity
     */
    public function previewTemplate(int $activityId)
    {
        $activity = Activity::findOrFail($activityId);

        $certificate = new Certificate([
            'certificate_number' => 'BKPSDM-RB/'.now()->format('Y').'/'.sprintf('%03d', $activity->id).'/00001',
            'issued_at' => now(),
        ]);
        $certificate->id = 0;
        $certificate->setRelation('activity', $activity);

        $dummyAsn = new Asn([
            'name' => 'Dr. H. AHMAD FAUZI, S.STP., M.Si',
            'nip' => '198205142001121002',
            'opd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',
            'rank_group' => 'Pembina (IV/a)',
            'position' => 'Kepala Bidang Pengembangan Karir',
        ]);
        $certificate->setRelation('asn', $dummyAsn);

        $signer = [
            'name' => Setting::get('head_officer_name', 'TARMIZI ISMAIL, S.Sos., M.Si'),
            'nip' => Setting::get('head_officer_nip', '196803031989021003'),
            'title' => Setting::get('head_officer_title', 'Plt. Kepala BKPSDM Kota Padang'),
            'agency' => Setting::get('agency_name', 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Padang'),
        ];

        $verifyUrl = route('certificates.verify', $certificate->certificate_number);
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=160x160&data='.urlencode($verifyUrl);

        return view('public.certificates.show', compact('certificate', 'signer', 'verifyUrl', 'qrCodeUrl'));
    }
}
