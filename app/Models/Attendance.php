<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'asn_id',
        'activity_id',
        'platform',
        'attended_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
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
