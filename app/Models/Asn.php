<?php

namespace App\Models;

use Database\Factories\AsnFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Asn extends Authenticatable
{
    /** @use HasFactory<AsnFactory> */
    use HasFactory, Notifiable;

    protected $table = 'asns';

    protected $fillable = [
        'nip',
        'name',
        'email',
        'opd',
        'position',
        'rank_group',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Relationship to attendances (presensi)
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Relationship to certificates (e-sertifikat)
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
