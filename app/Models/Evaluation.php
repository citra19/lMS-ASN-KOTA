<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'asn_id',
        'activity_id',
        'speaker_rating',
        'material_rating',
        'organizer_rating',
        'feedback_text',
        'submitted_at',
    ];

    protected $casts = [
        'speaker_rating' => 'integer',
        'material_rating' => 'integer',
        'organizer_rating' => 'integer',
        'submitted_at' => 'datetime',
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
