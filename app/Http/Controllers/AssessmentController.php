<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AssessmentAttempt;
use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    /**
     * Helper: Ensure ASN is authenticated
     */
    protected function getAuthenticatedAsn()
    {
        return Auth::guard('asn')->user();
    }

    /**
     * 1-Click Native Presensi / Absensi Kehadiran
     */
    public function recordPresence(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            session()->put('url.intended', route('activities.presence', $activity->slug));

            return redirect()->route('login')
                ->with('warning', 'Silakan masuk dengan akun SSO ASN untuk melakukan presensi.');
        }

        // Record attendance
        Attendance::updateOrCreate(
            [
                'asn_id' => $asn->id,
                'activity_id' => $activity->id,
            ],
            [
                'platform' => 'general',
                'attended_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]
        );

        $this->checkAndIssueCertificate($asn, $activity);

        return redirect()->route('activities.show', $activity->slug)
            ->with('success', 'Presensi kehadiran Anda untuk kegiatan "'.$activity->title.'" berhasil dicatat!');
    }

    /**
     * Show Native Pre-Test Page
     */
    public function showPretest(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            session()->put('url.intended', route('activities.pretest', $activity->slug));

            return redirect()->route('login')
                ->with('warning', 'Silakan masuk dengan akun SSO ASN untuk mengikuti Pre-Test.');
        }

        // Check if already attempted
        $existingAttempt = AssessmentAttempt::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->where('type', 'pretest')
            ->first();

        $questions = $activity->pretestQuestions;

        return view('public.assessments.pretest', compact('activity', 'existingAttempt', 'questions', 'asn'));
    }

    /**
     * Submit Native Pre-Test
     */
    public function submitPretest(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            return redirect()->route('login');
        }

        $existing = AssessmentAttempt::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->where('type', 'pretest')
            ->first();

        if ($existing) {
            return redirect()->route('activities.pretest', $activity->slug)
                ->with('info', 'Anda sudah menyelesaikan Pre-Test kegiatan ini.');
        }

        $questions = $activity->pretestQuestions;
        $totalQuestions = $questions->count();
        $submittedAnswers = $request->input('answers', []);
        $correctCount = 0;

        foreach ($questions as $question) {
            $userAns = $submittedAnswers[$question->id] ?? null;
            if ($userAns && strtoupper(trim($userAns)) === strtoupper(trim($question->correct_answer))) {
                $correctCount++;
            }
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 100.00;

        AssessmentAttempt::create([
            'asn_id' => $asn->id,
            'activity_id' => $activity->id,
            'type' => 'pretest',
            'started_at' => now()->subMinutes(5),
            'finished_at' => now(),
            'total_questions' => $totalQuestions,
            'correct_answers_count' => $correctCount,
            'score' => $score,
            'is_passed' => true, // Pre-test is diagnostic, always marked complete
            'answers_payload' => $submittedAnswers,
        ]);

        $this->checkAndIssueCertificate($asn, $activity);

        return redirect()->route('activities.pretest', $activity->slug)
            ->with('success', 'Pre-Test berhasil dikirim! Nilai diagnostik awal Anda: '.$score);
    }

    /**
     * Show Native Post-Test Page
     */
    public function showPosttest(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            session()->put('url.intended', route('activities.posttest', $activity->slug));

            return redirect()->route('login')
                ->with('warning', 'Silakan masuk dengan akun SSO ASN untuk mengikuti Post-Test.');
        }

        $existingAttempt = AssessmentAttempt::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->where('type', 'posttest')
            ->latest()
            ->first();

        $questions = $activity->posttestQuestions;

        return view('public.assessments.posttest', compact('activity', 'existingAttempt', 'questions', 'asn'));
    }

    /**
     * Submit Native Post-Test
     */
    public function submitPosttest(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            return redirect()->route('login');
        }

        $questions = $activity->posttestQuestions;
        $totalQuestions = $questions->count();
        $submittedAnswers = $request->input('answers', []);
        $correctCount = 0;

        foreach ($questions as $question) {
            $userAns = $submittedAnswers[$question->id] ?? null;
            if ($userAns && strtoupper(trim($userAns)) === strtoupper(trim($question->correct_answer))) {
                $correctCount++;
            }
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 100.00;
        $passingGrade = $activity->passing_grade ?: 70;
        $isPassed = $score >= $passingGrade;

        AssessmentAttempt::create([
            'asn_id' => $asn->id,
            'activity_id' => $activity->id,
            'type' => 'posttest',
            'started_at' => now()->subMinutes(10),
            'finished_at' => now(),
            'total_questions' => $totalQuestions,
            'correct_answers_count' => $correctCount,
            'score' => $score,
            'is_passed' => $isPassed,
            'answers_payload' => $submittedAnswers,
        ]);

        $this->checkAndIssueCertificate($asn, $activity);

        $msg = $isPassed
            ? "Selamat! Anda LULUS Post-Test dengan nilai {$score} (KKM: {$passingGrade})."
            : "Nilai Post-Test Anda: {$score}. Belum mencapai batas kelulusan (KKM: {$passingGrade}). Silakan pelajari materi dan coba lagi.";

        $statusType = $isPassed ? 'success' : 'warning';

        return redirect()->route('activities.posttest', $activity->slug)
            ->with($statusType, $msg);
    }

    /**
     * Show Native Evaluation / Feedback Page
     */
    public function showEvaluation(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            session()->put('url.intended', route('activities.evaluation', $activity->slug));

            return redirect()->route('login')
                ->with('warning', 'Silakan masuk dengan akun SSO ASN untuk mengisi formulir evaluasi.');
        }

        $existingEvaluation = Evaluation::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->first();

        return view('public.assessments.evaluation', compact('activity', 'existingEvaluation', 'asn'));
    }

    /**
     * Submit Native Evaluation
     */
    public function submitEvaluation(Request $request, string $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $asn = $this->getAuthenticatedAsn();

        if (! $asn) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'speaker_rating' => ['required', 'integer', 'between:1,5'],
            'material_rating' => ['required', 'integer', 'between:1,5'],
            'organizer_rating' => ['required', 'integer', 'between:1,5'],
            'feedback_text' => ['nullable', 'string', 'max:2000'],
        ]);

        Evaluation::updateOrCreate(
            [
                'asn_id' => $asn->id,
                'activity_id' => $activity->id,
            ],
            [
                'speaker_rating' => $validated['speaker_rating'],
                'material_rating' => $validated['material_rating'],
                'organizer_rating' => $validated['organizer_rating'],
                'feedback_text' => $validated['feedback_text'] ?? null,
                'submitted_at' => now(),
            ]
        );

        $certificate = $this->checkAndIssueCertificate($asn, $activity);

        $redirect = redirect()->route('activities.show', $activity->slug);

        if ($certificate) {
            return $redirect->with('success', 'Terima kasih atas evaluasi Anda! E-Sertifikat Anda telah berhasil terbit dan siap diunduh.');
        }

        return $redirect->with('success', 'Formulir evaluasi & umpan balik kegiatan berhasil disimpan. Terima kasih atas partisipasi Anda!');
    }

    /**
     * Certificate Unlock Engine:
     * Issues Certificate automatically if all 4 conditions are met:
     * 1. Presensi / Attendance recorded
     * 2. Pre-Test completed
     * 3. Post-Test passed (score >= passing_grade)
     * 4. Evaluation submitted
     */
    protected function checkAndIssueCertificate(mixed $asn, Activity $activity): ?Certificate
    {
        if (! $asn) {
            return null;
        }

        // 1. Attendance check
        $hasAttendance = Attendance::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->exists();

        // 2. Pre-test check
        $hasPretest = AssessmentAttempt::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->where('type', 'pretest')
            ->exists();

        // 3. Post-test passed check
        $hasPassedPosttest = AssessmentAttempt::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->where('type', 'posttest')
            ->where('is_passed', true)
            ->exists();

        // 4. Evaluation check
        $hasEvaluation = Evaluation::where('asn_id', $asn->id)
            ->where('activity_id', $activity->id)
            ->exists();

        // If not all 4 are complete, return null
        if (! ($hasAttendance && $hasPretest && $hasPassedPosttest && $hasEvaluation)) {
            return null;
        }

        // Generate unique certificate number
        $year = now()->format('Y');
        $activityCode = str_pad((string) $activity->id, 3, '0', STR_PAD_LEFT);
        $asnCode = str_pad((string) $asn->id, 5, '0', STR_PAD_LEFT);
        $certNumber = "BKPSDM-RB/{$year}/{$activityCode}/{$asnCode}";

        return Certificate::updateOrCreate(
            [
                'asn_id' => $asn->id,
                'activity_id' => $activity->id,
            ],
            [
                'certificate_number' => $certNumber,
                'issued_at' => now(),
            ]
        );
    }
}
