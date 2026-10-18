<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class KrsResiden extends Model
{
    //
    
    use HasFactory, Notifiable;
    protected $table = 'krs_residen';
    protected $guarded = ['id'];
    protected $fillable = [
        'master_krs_id',
        'residen_id',
        'status',
    ];

    public function residen() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(Residen::class, 'residen_id');
    }

    public function master_krs() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(MasterKrs::class, 'master_krs_id');
    }
}
