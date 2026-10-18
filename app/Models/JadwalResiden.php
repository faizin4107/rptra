<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class JadwalResiden extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'jadwal_residen';
    protected $guarded = ['id'];
    protected $fillable = [
        'jadwal_id',
        'residen_id',
        'dpjp_id',
    ];

    public function residen()
    {
        return $this->belongsTo(Residen::class, 'residen_id');
    }

    public function dpjp()
    {
        return $this->belongsTo(Dpjp::class, 'dpjp_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

}
