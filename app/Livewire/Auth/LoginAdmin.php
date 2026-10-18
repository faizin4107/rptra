<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
// use App\Models\User;

#[Layout('layouts.guest')] 
class LoginAdmin extends Component
{
    #[Validate('required', message: 'Email wajib diisi.')]
    public $email = '';

    #[Validate('required', message: 'Password wajib diisi.')]
    public $password = '';


    public function login()
    {
        $this->validate();
        // 3. Proses Autentikasi
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'role' => 'admin'])) {
            session()->regenerate();
            // Menggunakan redirect standar Livewire v4 dengan wire:navigate (navigate: true)
            return $this->redirectRoute('admin.dashboard', navigate: true);
        }

        // $userExist = \App\Models\User::where('email', $this->email)->first();

        // if ($userExist && $userExist->status !== 'Aktif') {
        //     if ($userExist->status === 'Pending') {
        //         $this->addError('login_failed', 'Akun Anda belum dikonfirmasi oleh Admin.');
        //     } else {
        //         $this->addError('login_failed', 'Akun Anda telah dinonaktifkan.');
        //     }
        //     return;
        // }
        $this->addError('login_failed', 'Email atau password salah.');

        // ... sisa logika login Anda berikutnya ...
    }

    public function render()
    {
        return view('livewire.auth.login-admin');
    }
}
