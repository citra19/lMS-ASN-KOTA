<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'type',
        'question_text',
        'options',
        'correct_answer',
        'explanation',
        'order',
    ];

    protected $casts = [
        'options' => 'array',
        'order' => 'integer',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
