<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /** @use HasFactory<ActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'theme',
        'speaker_name',
        'speaker_title',
        'date',
        'start_time',
        'end_time',
        'description',
        'banner_image',
        'youtube_url',
        'zoom_url',
        'zoom_meeting_id',
        'zoom_passcode',
        'pretest_url',
        'virtual_background',
        'google_form_url',
        'material_url',
        'material_file',
        'certificate_url',
        'is_published',
        'status',
        'passing_grade',
        'exam_duration_minutes',
        'pretest_enabled',
        'posttest_enabled',
        'jp_hours',
        'certificate_bg',
        'views_count',
    ];

    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
        'passing_grade' => 'integer',
        'exam_duration_minutes' => 'integer',
        'pretest_enabled' => 'boolean',
        'posttest_enabled' => 'boolean',
        'jp_hours' => 'integer',
        'views_count' => 'integer',
    ];

    /**
     * Scope for published activities
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope for searching
     */
    public function scopeSearch($query, ?string $term)
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('theme', 'like', "%{$term}%")
                ->orWhere('speaker_name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    /**
     * Get Indonesian day and date string (e.g. Rabu, 28 Oktober 2026)
     */
    public function getFormattedDateAttribute(): string
    {
        if (! $this->date) {
            return '-';
        }

        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $dayName = $days[$this->date->format('l')] ?? $this->date->format('l');
        $monthName = $months[(int) $this->date->format('n')] ?? $this->date->format('F');

        return "{$dayName}, {$this->date->format('d')} {$monthName} {$this->date->format('Y')}";
    }

    /**
     * Get formatted time range (e.g. 09:00 - 12:00 WIB)
     */
    public function getFormattedTimeAttribute(): string
    {
        $start = $this->start_time ? substr((string) $this->start_time, 0, 5) : '09:00';
        $end = $this->end_time ? substr((string) $this->end_time, 0, 5) : '12:00';

        return "{$start} - {$end} WIB";
    }

    /**
     * Human readable status badge label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'ongoing' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            default => 'Akan Datang',
        };
    }

    /**
     * Otomatis sinkronisasi status kegiatan berdasarkan jadwal dan waktu sekarang (WIB)
     */
    public static function autoSyncStatuses(): void
    {
        $activities = self::all();
        $now = now();

        foreach ($activities as $activity) {
            if (! $activity->date) {
                continue;
            }

            $dateStr = $activity->date->format('Y-m-d');
            $startTime = $activity->start_time ? substr((string) $activity->start_time, 0, 8) : '09:00:00';
            $endTime = $activity->end_time ? substr((string) $activity->end_time, 0, 8) : '12:00:00';

            $startDateTime = Carbon::parse("{$dateStr} {$startTime}", config('app.timezone'));
            $endDateTime = Carbon::parse("{$dateStr} {$endTime}", config('app.timezone'));

            $newStatus = match (true) {
                $now->greaterThan($endDateTime) => 'completed',
                $now->between($startDateTime, $endDateTime) => 'ongoing',
                default => 'upcoming',
            };

            if ($activity->status !== $newStatus) {
                $activity->updateQuietly(['status' => $newStatus]);
            }
        }
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function pretestQuestions()
    {
        return $this->hasMany(Question::class)->whereIn('type', ['pretest', 'both'])->orderBy('order');
    }

    public function posttestQuestions()
    {
        return $this->hasMany(Question::class)->whereIn('type', ['posttest', 'both'])->orderBy('order');
    }

    public function assessmentAttempts()
    {
        return $this->hasMany(AssessmentAttempt::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
