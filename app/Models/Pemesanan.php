<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $guarded = ['id'];
    protected $fillable = [
        'id_reservasi',
        'tempat_kegiatan',
        'nama_penanggung_jawab',
        'tujuan',
        'jumlah_peserta',
        'no_wa',
        'tanggal',
        'waktu',
        'pengguna_id',
        'status',
        'keterangan'
    ];
}
