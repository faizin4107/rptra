<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class AuditLogs extends Model
{
    //
    
    use HasFactory, Notifiable;
    protected $table = 'audit_logs';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'activity',
        'status_simrs',
        'ip_address',
        'residen_id',
        'dpjp_id',
    ];
    
    public function user() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'user_id');
        //  return $this->morphTo();
    }

    public function residen() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(Residen::class, 'residen_id');
        //  return $this->morphTo();
    }

    public function dpjp() {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(Dpjp::class, 'dpjp_id');
        //  return $this->morphTo();
    }
}
