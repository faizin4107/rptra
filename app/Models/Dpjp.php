<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dpjp extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'username',
        'password',
        'id_identitas',
        'role',
        'status',
        'photo',
        'semester',
        'nilai_akhir',
        'ket_nilai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function audit() {
        return $this->hasMany(AuditLogs::class);
    }

    public function jadwal() {
        return $this->hasMany(Jadwal::class);
    }

    public function jadwalResiden()
    {
        return $this->hasMany(JadwalResiden::class, 'user_id');
    }

    public function sudahAbsen($day, $start, $end)
    {
        return $this->hasMany(Absensi::class, 'user_id')
                    ->where('day', $day)
                    ->where('start_time', $start)
                    ->where('end_time', $end)
                    ->where('tipe', 'masuk') // Sesuai permintaan: tipe absen masuk
                    ->exists(); // Mengembalikan true jika data ada
    }
}
