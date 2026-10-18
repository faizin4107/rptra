<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ModulResiden extends Model
{
    //
    
    use HasFactory, Notifiable;
    protected $table = 'modul_residen';
    protected $guarded = ['id'];
    protected $fillable = [
        'master_modul_id',
        'user_id',
        'status',
    ];

    public function user() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'user_id');
    }

    public function master_modul() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(MasterModul::class, 'master_modul_id');
    }
}
