<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'asn_id',
        'activity_id',
        'certificate_number',
        'file_path',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'date',
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
