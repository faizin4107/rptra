<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class AbsensiDpjp extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'absensi_dpjp';
    protected $guarded = ['id'];
    protected $fillable = [
        'latitude',
        'longitude',
        'address',
        'type_absen',
        'jadwal_id',
        'dpjp_id',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

//     public function jadwal()
// {
//     return $this->belongsTo(Jadwal::class, 'jadwal_id');
// }

    // public function jadwalResiden()
    // {
    //     return $this->belongsTo(JadwalResiden::class, 'jadwal_residen_id', 'id');
    // }
}
