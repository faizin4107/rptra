<?php

namespace App\Livewire\Forms\General\Profile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;
use TallStackUi\Traits\Interactions;

class ProfileForm extends Form
{
    use Interactions;
    // 1. Definisikan properti penampung model untuk melacak ID saat proses update
    // public ?Jadwal $jadwal = null;

    // 2. Definisikan field formulir beserta aturan validasinya
    public $old_password = '';
    public $new_password = '';
    public $new_password_confirmation  = '';

    public function validateCreate()
    {
        // $jadwalId = $this->jadwal ? $this->jadwal->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
        $data = [
            'old_password' => $this->old_password,
            'new_password' => $this->new_password,
            'password_confirmation'    => $this->new_password_confirmation ,
        ];
         // 2. Buat instance Validator Laravel standar
        // $validator = Validator::make($data, [
        //     'old_password' => 'required',
        //     'new_password' => 'required|min:8|confirmed',
        //     // 'password_confirmation '   => 'required',
        // ], [
        //     'old_password.required' => 'Password lama wajib diisi.',
        //     'new_password.required' => 'Password baru wajib diisi.',
        //     'new_password.min'      => 'Password baru minimal 8 karakter.',
        //     'new_password.confirmed'     => 'Password tidak sama dengan konfirmasi password.',
        //     // 'password_confirmation .required'     => 'Konfirmasi password wajib diisi.',
        // ]);
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.confirmed' => 'Password tidak sama dengan konfirmasi password.',
        ]);
        // 3. Tangkap kondisi menggunakan fails()
        // if ($validator->fails()) {
            
        //     // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
        //     // $allErrors = $validator->errors()->all();

        //     // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
        //     throw ValidationException::withMessages($validator->errors()->toArray());
        //     // throw ValidationException::withMessages($validator->errors()->toArray());
        // }
    }
}
