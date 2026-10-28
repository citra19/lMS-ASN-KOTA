<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Asn;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LmsRabuBelajarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_home_page_displays_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('RABU');
        $response->assertSee('BELAJAR');
        $response->assertSee('BKPSDM KOTA PADANG');
        $response->assertSee('Daftar Agenda Kegiatan Rabu Belajar');
    }

    public function test_schedule_page_displays_successfully(): void
    {
        $response = $this->get(route('schedule'));

        $response->assertStatus(200);
        $response->assertSee('Jadwal Kegiatan Rabu Belajar');
    }

    public function test_activity_detail_page_shows_all_seven_menu_access_features(): void
    {
        $activity = Activity::where('is_published', true)->first();

        $response = $this->get(route('activities.show', $activity->slug));

        $response->assertStatus(200);
        $response->assertSee($activity->title);
        $response->assertSee('Live YouTube');
        $response->assertSee('Zoom Meeting');
        $response->assertSee('Pre-Test');
        $response->assertSee('Virtual Background');
        $response->assertSee('Post-Test');
        $response->assertSee('Bahan Pembelajaran');
        $response->assertSee('E-Sertifikat');
    }

    public function test_admin_login_page_is_accessible(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertSee('Login Admin Pengelola');
    }

    public function test_admin_can_authenticate_and_access_dashboard(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@bkpsdm.padang.go.id',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();

        $dashResponse = $this->get(route('admin.dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Ringkasan Kegiatan');
    }

    public function test_admin_can_create_new_activity(): void
    {
        $admin = User::first();

        $response = $this->actingAs($admin)->post(route('admin.activities.store'), [
            'title' => 'Rabu Belajar Seri #27: Uji Coba Otomasi Pelayanan Publik',
            'theme' => 'Inovasi Digital SPBE Kota Padang',
            'speaker_name' => 'Fajar Pratama, S.Kom., M.Cs.',
            'speaker_title' => 'Ahli SPBE',
            'date' => '2026-11-20',
            'start_time' => '09:00',
            'end_time' => '12:00',
            'description' => 'Sesi pembahasan mengenai penerapan otomasi administrasi perkantoran pemkot.',
            'youtube_url' => 'https://youtube.com/watch?v=sample123',
            'zoom_url' => 'https://zoom.us/j/123456789',
            'zoom_meeting_id' => '123 456 789',
            'zoom_passcode' => 'PAS123',
            'pretest_url' => 'https://forms.gle/pretest123',
            'google_form_url' => 'https://forms.gle/absen123',
            'material_url' => 'https://drive.google.com/sample_drive',
            'certificate_url' => 'https://bkpsdm.padang.go.id/sertifikat/27',
            'status' => 'upcoming',
            'is_published' => 1,
        ]);

        $response->assertRedirect(route('admin.activities.index'));
        $this->assertDatabaseHas('activities', [
            'title' => 'Rabu Belajar Seri #27: Uji Coba Otomasi Pelayanan Publik',
            'speaker_name' => 'Fajar Pratama, S.Kom., M.Cs.',
        ]);
    }

    public function test_admin_can_toggle_publication_status(): void
    {
        $admin = User::first();
        $activity = Activity::first();
        $initialState = $activity->is_published;

        $response = $this->actingAs($admin)->patch(route('admin.activities.toggle-publish', $activity->id));

        $response->assertSessionHas('success');
        $this->assertEquals(! $initialState, $activity->fresh()->is_published);
    }

    public function test_asn_can_login_with_nip_and_password(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login.submit'), [
            'nip' => '198507152010011012',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertTrue(auth('asn')->check());
        $this->assertEquals('198507152010011012', auth('asn')->user()->nip);
    }

    public function test_unregistered_nip_shows_clear_error_and_suggests_sso(): void
    {
        $response = $this->post(route('login.submit'), [
            'nip' => '199999999999999999',
            'password' => 'anypassword',
        ]);

        $response->assertSessionHasErrors(['nip']);
        $this->assertFalse(auth('asn')->check());
    }

    public function test_wrong_password_shows_password_error(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login.submit'), [
            'nip' => '198507152010011012',
            'password' => 'salah123',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertFalse(auth('asn')->check());
    }

    public function test_zoom_gate_redirects_unauthenticated_asn_to_login(): void
    {
        $activity = Activity::first();

        $response = $this->get(route('activities.join.zoom', $activity->slug));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('warning');
    }

    public function test_authenticated_asn_joining_zoom_records_attendance_and_redirects(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);
        $activity = Activity::whereNotNull('zoom_url')->first();

        $response = $this->actingAs($asn, 'asn')->get(route('activities.join.zoom', $activity->slug));

        $response->assertRedirect($activity->zoom_url);
        $this->assertDatabaseHas('attendances', [
            'asn_id' => $asn->id,
            'activity_id' => $activity->id,
            'platform' => 'zoom',
        ]);
    }

    public function test_admin_can_export_attendances_csv(): void
    {
        $admin = User::first();

        $response = $this->actingAs($admin)->get(route('admin.attendances.export'));

        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
    }

    public function test_keycloak_redirect_initiates_sso_flow(): void
    {
        $response = $this->get('http://127.0.0.1:8000/auth/keycloak/redirect');

        $response->assertRedirect();
        $targetUrl = $response->headers->get('Location');

        $this->assertStringContainsString('https://sso.pdg.web.id/realms/pemko-padang-app/protocol/openid-connect/auth', $targetUrl);
        $this->assertStringContainsString('client_id=lms-kota', $targetUrl);
        $this->assertStringContainsString('redirect_uri=http%3A%2F%2F127.0.0.1%3A8000%2Fauth%2Fkeycloak%2Fcallback', $targetUrl);
        $this->assertStringContainsString('response_type=code', $targetUrl);
    }

    public function test_login_url_redirects_directly_to_keycloak_sso(): void
    {
        $response = $this->get('http://127.0.0.1:8000/login');

        $response->assertRedirect();
        $targetUrl = $response->headers->get('Location');

        $this->assertStringContainsString('https://sso.pdg.web.id/realms/pemko-padang-app/protocol/openid-connect/auth', $targetUrl);
        $this->assertStringContainsString('client_id=lms-kota', $targetUrl);
    }

    public function test_all_features_block_unauthenticated_asn(): void
    {
        $activity = Activity::first();
        $features = ['youtube', 'zoom', 'pretest', 'background', 'evaluasi', 'materi', 'sertifikat'];

        foreach ($features as $feature) {
            $response = $this->get(route('activities.access', [$activity->slug, $feature]));
            $response->assertRedirect(route('login'));
            $response->assertSessionHas('warning');
        }
    }

    public function test_authenticated_asn_can_access_evaluation(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);
        $activity = Activity::first();

        $response = $this->actingAs($asn, 'asn')->get(route('activities.access', [$activity->slug, 'evaluasi']));

        $response->assertRedirect(route('activities.evaluation', $activity->slug));
    }

    public function test_asn_can_record_native_presence(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);
        $activity = Activity::first();

        $response = $this->actingAs($asn, 'asn')->get(route('activities.presence', $activity->slug));

        $response->assertRedirect(route('activities.show', $activity->slug));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('attendances', [
            'asn_id' => $asn->id,
            'activity_id' => $activity->id,
        ]);
    }

    public function test_asn_can_submit_pretest_and_see_results(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);
        $activity = Activity::first();
        $question = $activity->pretestQuestions()->first();

        $response = $this->actingAs($asn, 'asn')->post(route('activities.pretest.submit', $activity->slug), [
            'answers' => [
                $question->id => $question->correct_answer,
            ],
        ]);

        $response->assertRedirect(route('activities.pretest', $activity->slug));
        $this->assertDatabaseHas('assessment_attempts', [
            'asn_id' => $asn->id,
            'activity_id' => $activity->id,
            'type' => 'pretest',
        ]);
    }

    public function test_completing_all_four_steps_automatically_issues_certificate(): void
    {
        $asn = Asn::create([
            'nip' => '198507152010011012',
            'name' => 'Budi Setiawan',
            'opd' => 'Diskominfo',
            'position' => 'Pranata Komputer',
            'password' => Hash::make('password123'),
        ]);
        $activity = Activity::first();
        $questions = $activity->posttestQuestions;

        // 1. Presensi
        $this->actingAs($asn, 'asn')->get(route('activities.presence', $activity->slug));

        // 2. Pre-Test
        $this->actingAs($asn, 'asn')->post(route('activities.pretest.submit', $activity->slug), [
            'answers' => [$questions->first()->id => $questions->first()->correct_answer],
        ]);

        // 3. Post-Test (Answer all correctly to score 100)
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = $q->correct_answer;
        }
        $this->actingAs($asn, 'asn')->post(route('activities.posttest.submit', $activity->slug), [
            'answers' => $answers,
        ]);

        // 4. Evaluasi
        $evalResponse = $this->actingAs($asn, 'asn')->post(route('activities.evaluation.submit', $activity->slug), [
            'speaker_rating' => 5,
            'material_rating' => 5,
            'organizer_rating' => 5,
            'feedback_text' => 'Materi sangat aplikatif dan bermanfaat bagi ASN!',
        ]);

        $evalResponse->assertRedirect(route('activities.show', $activity->slug));
        $evalResponse->assertSessionHas('success');

        // Assert Certificate is automatically issued!
        $cert = Certificate::where('asn_id', $asn->id)->where('activity_id', $activity->id)->first();
        $this->assertNotNull($cert);

        // 5. Test viewing the printable certificate
        $certResponse = $this->actingAs($asn, 'asn')->get(route('certificates.show', $cert->id));
        $certResponse->assertStatus(200);
        $certResponse->assertSee('SERTIFIKAT');
        $certResponse->assertSee($cert->certificate_number);
        $certResponse->assertSee(strtoupper($asn->name));

        // 6. Test public QR verification page
        $verifyResponse = $this->get(route('certificates.verify', $cert->certificate_number));
        $verifyResponse->assertStatus(200);
        $verifyResponse->assertSee('Dokumen Resmi Terverifikasi');
        $verifyResponse->assertSee($asn->name);
    }
}
