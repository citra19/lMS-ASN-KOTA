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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('theme');
            $table->string('speaker_name');
            $table->string('speaker_title')->nullable();
            $table->date('date');
            $table->time('start_time')->default('09:00:00');
            $table->time('end_time')->nullable()->default('12:00:00');
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('zoom_url')->nullable();
            $table->string('zoom_meeting_id')->nullable();
            $table->string('zoom_passcode')->nullable();
            $table->string('pretest_url')->nullable();
            $table->string('virtual_background')->nullable();
            $table->string('google_form_url')->nullable();
            $table->string('material_url')->nullable();
            $table->string('material_file')->nullable();
            $table->string('certificate_url')->nullable();
            $table->boolean('is_published')->default(true);
            $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
