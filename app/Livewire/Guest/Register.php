<?php

namespace App\Livewire\Guest;

use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.guest')] 
class Register extends Component
{
    use Interactions;
    #[Validate('required', message: [
        'required' => 'Nama wajib diisi.',
    ])]
    public $nama_lengkap = '';

    #[Validate('required', message: [
        'required' => 'Email wajib diisi.',
        'email' => 'Format email yang dimasukkan tidak valid.'
    ])]
    public $email = '';

    #[Validate('required|min:16', message: [
        'required' => 'NIK wajib diisi.',
        'min' => 'Panjang NIK harus 16.'
    ])]
    public $nik = '';

    #[Validate('required', message: 'No Telepon / Whastapp wajib diisi.')]
    public $telp = '';

    #[Validate('required', message: 'Instansi wajib diisi.')]
    public $instansi = '';

    #[Validate('required|min:8', message: [
        'required' => 'Password wajib diisi.',
        'min' => 'Password minimal 8 karakter.'
    ])]
    public $password = '';

    public function register()
    {
        $this->validate();

        Pengguna::create([
            'nama_lengkap' => $this->nama_lengkap,
            'nik' => $this->nik,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'pengguna', // Otomatis mendaftar sebagai siswa
            'telp' => $this->telp,
            'instansi' => $this->instansi,
        ]);
        $this->dialog()
        ->success(
            title: 'Berhasil!',
            description: 'Registrasi berhasil, silahkan login untuk melakukan reservasi.'
        )
        ->send();
        return $this->redirectRoute('login', navigate: true);
        // 1. Jalankan Validasi
        
    }

    public function render()
    {
        return view('livewire.guest.register');
    }
}
