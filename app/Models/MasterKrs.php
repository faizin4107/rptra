<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class MasterKrs extends Model
{
    //
    
    use HasFactory, Notifiable;
    protected $table = 'master_krs';
    protected $guarded = ['id'];
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'semester',
        'sks',
    ];
}
