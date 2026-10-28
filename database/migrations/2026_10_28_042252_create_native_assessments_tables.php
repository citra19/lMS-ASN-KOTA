<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add assessment control columns to activities table
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedInteger('passing_grade')->default(70)->after('status');
            $table->unsignedInteger('exam_duration_minutes')->default(15)->after('passing_grade');
            $table->boolean('pretest_enabled')->default(true)->after('exam_duration_minutes');
            $table->boolean('posttest_enabled')->default(true)->after('pretest_enabled');
        });

        // 2. Questions table (Bank Soal)
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnDelete();
            $table->enum('type', ['pretest', 'posttest', 'both'])->default('both');
            $table->text('question_text');
            $table->json('options'); // Key-value map: {"A": "...", "B": "...", "C": "...", "D": "..."}
            $table->string('correct_answer', 10); // e.g. "A", "B"
            $table->text('explanation')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->index(['activity_id', 'type']);
        });

        // 3. Assessment attempts table (Hasil Ujian ASN)
        Schema::create('assessment_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asn_id')->constrained('asns')->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnDelete();
            $table->enum('type', ['pretest', 'posttest']);
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->unsignedInteger('total_questions')->default(0);
            $table->unsignedInteger('correct_answers_count')->default(0);
            $table->decimal('score', 5, 2)->default(0.00);
            $table->boolean('is_passed')->default(false);
            $table->json('answers_payload')->nullable(); // Saved ASN answers map
            $table->timestamps();

            $table->index(['asn_id', 'activity_id', 'type']);
        });

        // 4. Evaluations table (Evaluasi & Kepuasan Layanan)
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asn_id')->constrained('asns')->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnDelete();
            $table->unsignedTinyInteger('speaker_rating')->default(5); // 1-5 stars
            $table->unsignedTinyInteger('material_rating')->default(5); // 1-5 stars
            $table->unsignedTinyInteger('organizer_rating')->default(5); // 1-5 stars
            $table->text('feedback_text')->nullable();
            $table->timestamp('submitted_at');
            $table->timestamps();

            $table->unique(['asn_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
        Schema::dropIfExists('assessment_attempts');
        Schema::dropIfExists('questions');

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn([
                'passing_grade',
                'exam_duration_minutes',
                'pretest_enabled',
                'posttest_enabled',
            ]);
        });
    }
};
