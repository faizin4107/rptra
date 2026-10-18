<?php

// namespace App\Livewire\Admin\Users;
namespace App\Livewire\Forms\Auth;

use App\Models\Dpjp;
use App\Models\Residen;
use Livewire\Form;
// use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterForm extends Form
{
    // 1. Definisikan properti penampung model untuk melacak ID saat proses update
    public ?User $user = null;
    public ?Residen $residen = null;
    public ?Dpjp $dpjp = null;

    // 2. Definisikan field formulir beserta aturan validasinya
    public $fullname = '';
    public $username = '';
    public $email = '';
    public $role = '';
    public $password = ''; // Opsional untuk proses edit
    // public $add_status = ''; // Opsional untuk proses edit
    public $id_identitas = ''; // Opsional untuk proses edit

    public function setData($role)
    {
        $this->role = $role;
    }

    public function validateCreate($role)
    {
        // dd($role);
        if($role === 'residen'){
            // $userId = $this->residen ? $this->residen->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
            $data = [
                'fullname' => $this->fullname,
                'username' => $this->username,
                'email'    => $this->email,
                'role'     => $this->role,
                'password' => $this->password,
                'id_identitas'   => $this->id_identitas,
            ];
            // 2. Buat instance Validator Laravel standar
            $validator = Validator::make($data, [
                'fullname' => 'required|min:3',
                'username' => 'required|min:4|unique:residens,username',
                'email'    => 'required|email|unique:residens,email',
                'role'     => 'required|in:residen,dpjp',
                'password' => 'required|min:8',
                'id_identitas'   => 'required|min:4|unique:residens,id_identitas',
            ], [
                'fullname.required' => 'Nama lengkap wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.unique'   => 'Username sudah digunakan akun lain.',
                'email.required' => 'Alamat email wajib diisi.',
                'email.unique'      => 'Alamat email sudah terdaftar.',
                'password.required' => 'Kata sandi wajib diisi.',
                'role.required'     => 'Pilih peran akun (role).',
                'id_identitas.required'   => 'Identitas ID wajib diisi',
            ]);
            if ($validator->fails()) {
                
                // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
                $allErrors = $validator->errors()->all();

                // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
                throw ValidationException::withMessages($validator->errors()->toArray());
                // throw ValidationException::withMessages($validator->errors()->toArray());
            }
        }else if($role === 'dpjp'){
            // $userId = $this->dpjp ? $this->dpjp->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
            $data = [
                'fullname' => $this->fullname,
                'username' => $this->username,
                'email'    => $this->email,
                'role'     => $this->role,
                'password' => $this->password,
                'id_identitas'   => $this->id_identitas,
            ];
            // 2. Buat instance Validator Laravel standar
            $validator = Validator::make($data, [
                'fullname' => 'required|min:3',
                'username' => 'required|min:4|unique:dpjps,username',
                'email'    => 'required|email|unique:dpjps,email',
                'role'     => 'required|in:residen,dpjp',
                'password' => 'required|min:8',
                'id_identitas'   => 'required|min:4|unique:dpjps,id_identitas',
            ], [
                'fullname.required' => 'Nama lengkap wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.unique'   => 'Username sudah digunakan akun lain.',
                'email.required' => 'Alamat email wajib diisi.',
                'email.unique'      => 'Alamat email sudah terdaftar.',
                'password.required' => 'Kata sandi wajib diisi.',
                'role.required'     => 'Pilih peran akun (role).',
                'id_identitas.required'   => 'Identitas ID wajib diisi',
            ]);
            if ($validator->fails()) {
                
                // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
                $allErrors = $validator->errors()->all();

                // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
                throw ValidationException::withMessages($validator->errors()->toArray());
                // throw ValidationException::withMessages($validator->errors()->toArray());
            }
        }
        
        // 3. Tangkap kondisi menggunakan fails()
        
    }

    /**
     * Logika Aturan Validasi Dinamis untuk Aksi Create & Update
     */
    // public function rules()
    // {
    //     // Deteksi apakah ini proses update (jika $this->user memiliki data) atau create baru
    //     $userId = $this->user ? $this->user->id : 'NULL';

    //     return [
    //         'fullname' => 'required|min:3',
    //         'username' => 'required|min:4|unique:users,username,' . $userId,
    //         'email'    => 'required|email|unique:users,email,' . $userId,
    //         'role'     => 'required|in:residen,dpjp,admin,siswa',
    //         'password' => $this->user ? 'nullable|min:8' : 'required|min:8', // Update = opsional, Create = wajib
    //     ];
    // }

    // /**
    //  * Pesan Kesalahan Validasi Kustom
    //  */
    // public function messages()
    // {
    //     return [
    //         'fullname.required' => 'Nama lengkap wajib diisi.',
    //         'username.unique'   => 'Username sudah digunakan oleh akun lain.',
    //         'email.unique'      => 'Alamat email sudah terdaftar.',
    //         'password.required' => 'Kata sandi wajib diisi.',
    //         'password.min'      => 'Kata sandi minimal harus 8 karakter.',
    //         'role.required'     => 'Pilih peran akun (role) yang valid.',
    //     ];
    // }
}
