<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Absensi extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'absensi';
    protected $guarded = ['id'];
    protected $fillable = [
        'latitude',
        'longitude',
        'address',
        'type_absen',
        'jadwal_residen_id',
        'residen_id',
        'dpjp_id',
    ];

    public function jadwalResiden()
    {
        return $this->belongsTo(JadwalResiden::class, 'jadwal_residen_id', 'id');
    }

    // public function jadwalResiden()
    // {
    //     return $this->belongsTo(JadwalResiden::class, 'jadwal_residen_id', 'id');
    // }
}
