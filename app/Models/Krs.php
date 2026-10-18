<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Krs extends Model
{
    //
    
    use HasFactory, Notifiable;
    protected $table = 'krs';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'modul_id',
        'semester_ambil',
        'status_krs',
        'tgl_isi',
    ];
}
