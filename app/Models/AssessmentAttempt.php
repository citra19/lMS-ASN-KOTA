<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'asn_id',
        'activity_id',
        'type',
        'started_at',
        'finished_at',
        'total_questions',
        'correct_answers_count',
        'score',
        'is_passed',
        'answers_payload',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'total_questions' => 'integer',
        'correct_answers_count' => 'integer',
        'score' => 'decimal:2',
        'is_passed' => 'boolean',
        'answers_payload' => 'array',
    ];

    public function asn()
    {
        return $this->belongsTo(Asn::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
