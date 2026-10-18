<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class MasterModul extends Model
{
    //
    
    use HasFactory, Notifiable;
    protected $table = 'master_modul';
    protected $guarded = ['id'];
    protected $fillable = [
        'kode_modul',
        'nama_modul',
        'semester',
        'sks',
        'kuota_tindakan',
        'asa1',
        'asa2',
        'asa3',
        'asa4',
        'asa5',
        'asa6',
        'asa7',
    ];
}
