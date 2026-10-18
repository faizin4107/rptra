<?php

namespace App\Livewire\Forms\Residen\Krs;

// use App\Models\ModulResiden;
// use Livewire\Attributes\Validate;

use Illuminate\Support\Facades\Auth;
use Livewire\Form;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class KrsForm extends Form
{
    // public ?ModulResiden $krs = null;

    public $master_krs_id = '';

    public function validateCreate()
    {
        $id = Auth::guard('residen')->user()->id;

        // 1. Satukan data dari properti Form Object ke dalam array
        $data = [
            'master_krs_id' => $this->master_krs_id,
        ];
         // 2. Buat instance Validator Laravel standar
        $validator = Validator::make($data, [
            // 'username' => 'required|min:4|unique:users,username,' . $userId,
            'master_krs_id' => 'required|unique:krs_residen,master_krs_id,' . $id,
        ], [
            'master_krs_id.required' => 'Modul wajib dipilih.',
            'master_krs_id.unique' => 'Modul sudah ada, pilih modul yang lain.',
        ]);
        // 3. Tangkap kondisi menggunakan fails()
        if ($validator->fails()) {
            
            // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
            // $allErrors = $validator->errors()->all();

            // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
            throw ValidationException::withMessages($validator->errors()->toArray());
            // throw ValidationException::withMessages($validator->errors()->toArray());
        }
    }
}
