<?php

// namespace App\Livewire\Admin\Users;
namespace App\Livewire\Forms\Admin\Users;

use App\Models\Dpjp;
use App\Models\Pengguna;
use App\Models\Residen;
use Livewire\Form;
// use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserForm extends Form
{
    // 1. Definisikan properti penampung model untuk melacak ID saat proses update
    public ?User $user = null;
    public ?Pengguna $pengguna = null;

    // 2. Definisikan field formulir beserta aturan validasinya
    public $add_admin_name = '';
    public $add_admin_email = '';
    public $add_admin_role = '';
    public $add_admin_password = ''; 

    public $edit_admin_name = '';
    public $edit_admin_email = '';
    public $edit_admin_role = '';
    public $edit_admin_password = ''; 

    public $add_pengguna_nama_lengkap = '';
    public $add_pengguna_email = '';
    public $add_pengguna_role = '';
    public $add_pengguna_password = ''; 
    public $add_pengguna_nik = ''; 
    public $add_pengguna_telp = ''; 
    public $add_pengguna_instansi = ''; 

    public $edit_pengguna_nama_lengkap = '';
    public $edit_pengguna_email = '';
    public $edit_pengguna_role = '';
    public $edit_pengguna_password = ''; 
    public $edit_pengguna_nik = ''; 
    public $edit_pengguna_telp = ''; 
    public $edit_pengguna_instansi = ''; 


    public function setUserAdmin(User $user)
    {
        $this->user = $user;
        $this->edit_admin_name = $user->name;
        $this->edit_admin_email = $user->email;
        $this->edit_admin_role = $user->role;
        $this->edit_admin_password = ''; 
    }

    public function setUserPengguna(Pengguna $pengguna)
    {
        $this->pengguna = $pengguna;
        $this->edit_pengguna_nama_lengkap = $pengguna->nama_lengkap;
        $this->edit_pengguna_email = $pengguna->email;
        $this->edit_pengguna_role = $pengguna->role;
        $this->edit_pengguna_password = '';
        $this->edit_pengguna_nik = $pengguna->nik; 
        $this->edit_pengguna_telp = $pengguna->telp;
        $this->edit_pengguna_instansi = $pengguna->instansi;
    }


    public function validateCreate($role)
    {
        if($role === 'admin'){
            $userId = $this->user ? $this->user->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
            $data = [
                'name' => $this->add_admin_name,
                'email'    => $this->add_admin_email,
                'password' => $this->add_admin_password,
            ];
            // 2. Buat instance Validator Laravel standar
            $validator = Validator::make($data, [
                'name' => 'required|min:3',
                'email'    => 'required|email|unique:users,email,' . $userId,
                'password' => 'required|min:8',
            ], [
                'name.required' => 'Nama wajib diisi.',
                'name.min' => 'Minimal nama 3 karakter.',
                'email.unique'      => 'Alamat email sudah terdaftar.',
                'password.required' => 'Kata sandi wajib diisi.',
                'password.min' => 'Kata sandi minimal 8 karakter.',
            ]);
            if ($validator->fails()) {
                
                // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
                // $allErrors = $validator->errors()->all();

                // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
                throw ValidationException::withMessages($validator->errors()->toArray());
                // throw ValidationException::withMessages($validator->errors()->toArray());
            }
        }else if($role === 'pengguna'){
            $userId = $this->pengguna ? $this->pengguna->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
            $data = [
                'nama_lengkap' => $this->add_pengguna_nama_lengkap,
                'nik' => $this->add_pengguna_nik,
                'email'    => $this->add_pengguna_email,
                'password' => $this->add_pengguna_password,
                'telp'   => $this->add_pengguna_telp,
                'instansi'   => $this->add_pengguna_instansi,
            ];
            // 2. Buat instance Validator Laravel standar
            $validator = Validator::make($data, [
                'nama_lengkap' => 'required|min:3',
                'email'    => 'required|email|unique:residens,email,' . $userId,
                'password' => $this->user ? 'nullable|min:8' : 'required|min:8',
                'nik'   => 'required|min:8',
                'telp'   => 'required|min:8',
                'instansi'   => 'required',
            ], [
                'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
                'email.unique'      => 'Alamat email sudah terdaftar.',
                'password.required' => 'Kata sandi wajib diisi.',
                'nik.required'   => 'NIK wajib diisi.',
                'nik.min'   => 'Minimal NIK 16 angka.',
                'telp.required'   => 'No telepon wajib diisi',
                'instansi.required'   => 'Instansi wajib diisi',
            ]);
            if ($validator->fails()) {
                
                // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
                $allErrors = $validator->errors()->all();

                // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
                throw ValidationException::withMessages($validator->errors()->toArray());
                // throw ValidationException::withMessages($validator->errors()->toArray());
            }
        }
    }
}
