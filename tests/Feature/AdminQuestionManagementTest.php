<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminQuestionManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guest_cannot_access_question_management(): void
    {
        $activity = Activity::first();

        $response = $this->get(route('admin.questions.index', $activity->id));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_questions_list_for_activity(): void
    {
        $admin = User::first();
        $activity = Activity::first();

        $response = $this->actingAs($admin)->get(route('admin.questions.index', $activity->id));

        $response->assertStatus(200);
        $response->assertSee('Bank Soal');
        $response->assertSee($activity->title);
    }

    public function test_admin_can_create_a_new_question(): void
    {
        $admin = User::first();
        $activity = Activity::first();

        $response = $this->actingAs($admin)->post(route('admin.questions.store', $activity->id), [
            'type' => 'both',
            'order' => 99,
            'question_text' => 'Berapa nilai integritas tertinggi seorang ASN?',
            'options' => [
                'A' => 'Kejujuran dan Tanggung Jawab',
                'B' => 'Kemalasan',
                'C' => 'Ketidakpedulian',
                'D' => 'Kepentingan Pribadi',
            ],
            'correct_answer' => 'A',
            'explanation' => 'Integritas adalah keselarasan antara perkataan dan perbuatan.',
        ]);

        $response->assertRedirect(route('admin.questions.index', $activity->id));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('questions', [
            'activity_id' => $activity->id,
            'question_text' => 'Berapa nilai integritas tertinggi seorang ASN?',
            'correct_answer' => 'A',
            'type' => 'both',
        ]);
    }

    public function test_admin_can_update_an_existing_question(): void
    {
        $admin = User::first();
        $activity = Activity::first();
        $question = $activity->questions()->first();

        $response = $this->actingAs($admin)->put(route('admin.questions.update', [$activity->id, $question->id]), [
            'type' => 'posttest',
            'order' => $question->order,
            'question_text' => 'Pertanyaan yang diperbarui oleh admin BKPSDM',
            'options' => [
                'A' => 'Opsi 1 Diperbarui',
                'B' => 'Opsi 2 Diperbarui',
            ],
            'correct_answer' => 'B',
            'explanation' => 'Penjelasan baru',
        ]);

        $response->assertRedirect(route('admin.questions.index', $activity->id));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
            'question_text' => 'Pertanyaan yang diperbarui oleh admin BKPSDM',
            'correct_answer' => 'B',
            'type' => 'posttest',
        ]);
    }

    public function test_admin_can_duplicate_a_question(): void
    {
        $admin = User::first();
        $activity = Activity::first();
        $question = $activity->questions()->first();

        $countBefore = $activity->questions()->count();

        $response = $this->actingAs($admin)->post(route('admin.questions.duplicate', [$activity->id, $question->id]));

        $response->assertRedirect(route('admin.questions.index', $activity->id));
        $response->assertSessionHas('success');

        $this->assertEquals($countBefore + 1, $activity->questions()->count());
        $this->assertDatabaseHas('questions', [
            'activity_id' => $activity->id,
            'question_text' => $question->question_text.' (Salinan)',
        ]);
    }

    public function test_admin_can_delete_a_question(): void
    {
        $admin = User::first();
        $activity = Activity::first();
        $question = $activity->questions()->first();

        $response = $this->actingAs($admin)->delete(route('admin.questions.destroy', [$activity->id, $question->id]));

        $response->assertRedirect(route('admin.questions.index', $activity->id));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('questions', [
            'id' => $question->id,
        ]);
    }
}
