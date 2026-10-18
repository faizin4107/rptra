<?php

namespace App\Livewire\Guest;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.guest')] 
class Login extends Component
{
    use Interactions;
    #[Validate('required|email', message: [
        'required' => 'Email wajib diisi.',
        'email' => 'Format email yang dimasukkan tidak valid.'
    ])]
    public $email = '';

    #[Validate('required', message: 'Password wajib diisi.')]
    public $password = '';

    public function login()
    {   
        $this->validate();
        // 3. Proses Autentikasi
        if (Auth::guard('pengguna')->attempt(['email' => $this->email, 'password' =>$this->password])) {
            session()->regenerate();
            // Menggunakan redirect standar Livewire v4 dengan wire:navigate (navigate: true)
            return $this->redirectRoute('home', navigate: true);
        }
        
        $this->addError('login_failed', 'Username atau password salah.');
    }

    public function render()
    {
        return view('livewire.guest.login');
    }
}
