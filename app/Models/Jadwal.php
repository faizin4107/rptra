<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Jadwal extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'jadwal';
    protected $guarded = ['id'];
    protected $fillable = [
        'dpjp_id',
        'day',
        'start_time',
        'end_time',
        'keterangan',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dpjp() {
        return $this->belongsTo(Dpjp::class, 'dpjp_id');
    }

    public function residen() {
        return $this->belongsTo(Residen::class, 'residen_id');
    }
    
    public function jadwalResiden()
    {
        // Parameter kedua harus 'jadwal_id' (kolom yang ada di tabel jadwal_residen)
        return $this->hasMany(JadwalResiden::class, 'jadwal_id', 'id');
    }

    // public function jadwalResiden()
    // {
    //     return $this->hasMany(JadwalResiden::class, 'jadwal_residen_id');
    // }

    // public function absensi()
    // {
    //     // Relasi ke tabel absensi
    //     return $this->hasMany(Absensi::class, 'user_id', 'user_id'); 
    // }
    public function absensi()
    {
        // Biasanya absensi lebih aman dihubungkan via residen_id atau jadwal_residen_id
        // Tapi jika ingin tetap menggunakan user_id, pastikan kolomnya ada
        return $this->hasMany(Absensi::class, 'residen_id', 'residen_id'); 
    }

    public function absensi_dpjp()
    {
        // Biasanya absensi lebih aman dihubungkan via residen_id atau jadwal_residen_id
        // Tapi jika ingin tetap menggunakan user_id, pastikan kolomnya ada
        return $this->hasMany(AbsensiDpjp::class, 'dpjp_id', 'dpjp_id'); 
    }
}
