<?php

namespace App\Livewire\Auth;

use App\Mail\SendOtpPasswordReset;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
// use App\Mail\SendOtpPasswordReset;
// use App\Mail\SendOtpReset;
use App\Models\Dpjp;
use App\Models\Residen;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.guest')] 
class PasswordResetOtp extends Component
{
    use Interactions;
    public $step = 1;
    public $userType = ''; // Untuk menyimpan apakah dia 'residen' atau 'dpjp'

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|digits:6')]
    public $otp = '';

    #[Validate('required|min:8|confirmed')]
    public $password = '';
    public $password_confirmation = '';

    public function sendOtp()
    {
        $this->validateOnly('email');

        // 1. Cari user di kedua tabel
        $user = Residen::where('email', $this->email)->first();
        $this->userType = 'residen';

        if (!$user) {
            $user = Dpjp::where('email', $this->email)->first();
            $this->userType = 'dpjp';
        }

        if (!$user) {
            $this->addError('email', 'Email tidak terdaftar di sistem kami.');
            return;
        }

        // 2. Generate & Simpan OTP
        $code = rand(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            [
                'token' => Hash::make($code),
                'created_at' => now()
            ]
        );

        // 3. Kirim Email
        Mail::to($this->email)->send(new SendOtpPasswordReset($code));

        $this->step = 2;
    }

    public function resetPassword()
    {
        // 1. Jalankan validasi
        // Jika validasi gagal di sini, Livewire akan berhenti dan kembali ke view
        // Pastikan di view ada @error('otp') dsb untuk melihat pesan errornya
        $this->validate();

        // 2. Ambil data token dari database
        $record = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->first();

        // Debugging: Jika record tidak ada
        if (!$record) {
            $this->addError('otp', 'Email tidak ditemukan di tabel reset token.');
            return;
        }

        // 3. Verifikasi OTP (Hash::check membandingkan input user dengan hash di DB)
        if (!Hash::check($this->otp, $record->token)) {
            $this->addError('otp', 'Kode OTP yang Anda masukkan salah.');
            return;
        }

        // 4. Cek Kadaluwarsa (Contoh: 15 menit)
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            $this->addError('otp', 'Kode OTP sudah kadaluwarsa. Silakan minta kode baru.');
            return;
        }

        // 5. Tentukan Model & Cari User
        // Pastikan variabel $this->userType masih ada nilainya!
        // Jika userType hilang saat pindah step, kita cari ulang manual:
        if (!$this->userType) {
            if (Residen::where('email', $this->email)->exists()) {
                $this->userType = 'residen';
            } elseif (Dpjp::where('email', $this->email)->exists()) {
                $this->userType = 'dpjp';
            }
        }

        $model = ($this->userType === 'residen') ? Residen::class : Dpjp::class;
        $user = $model::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'User tidak ditemukan di tabel ' . $this->userType);
            return;
        }

        // 6. Update Password
        $user->update([
            'password' => Hash::make($this->password)
        ]);

        // 7. Hapus Token agar tidak bisa dipakai lagi
        DB::table('password_reset_tokens')->where('email', $this->email)->delete();

        // 8. Redirect dengan pesan sukses
        // session()->flash('status', 'Password berhasil diubah.');
        $this->dialog()
        ->success(
            title: 'Berhasil!',
            description: 'Password berhasil diubah.'
        )
        ->send();
        return redirect()->to('/'); 
    }

    public function render()
    {
        return view('livewire.auth.password-reset-otp');
    }

}
