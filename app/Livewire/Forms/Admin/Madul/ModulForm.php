<?php

namespace App\Livewire\Forms\Admin\Modul;

use App\Models\MasterModul;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class MasterKrsForm extends Form
{
    // 1. Definisikan properti penampung model untuk melacak ID saat proses update
    public ?MasterKrs $master_krs = null;

    // 2. Definisikan field formulir beserta aturan validasinya
    public $add_kode_mk = '';
    public $add_nama_mk = '';
    public $add_semester = '';
    public $add_sks = '';

    public $id = '';
    public $edit_kode_mk = '';
    public $edit_nama_mk = '';
    public $edit_semester = '';
    public $edit_sks = '';

    public function setData(MasterKrs $master_krs)
    {
        $this->master_krs = $master_krs;
        $this->id = $master_krs->id;
        $this->edit_kode_mk = $master_krs->kode_mk;
        $this->edit_nama_mk = $master_krs->nama_mk;
        $this->edit_semester = $master_krs->semester;
        $this->edit_sks = $master_krs->sks;
    }

    public function validateCreate()
    {
        $masterKrsId = $this->master_krs ? $this->master_krs->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
        $data = [
            'kode_mk' => $this->add_kode_mk,
            'nama_mk' => $this->add_nama_mk,
            'semester'    => $this->add_semester,
            'sks'     => $this->add_sks,
        ];
         // 2. Buat instance Validator Laravel standar
        $validator = Validator::make($data, [
            'kode_mk' => 'required|unique:users,username',
            'nama_mk' => 'required',
            'semester'   => 'required',
            'sks' => 'required',
        ], [
            'kode_mk.required' => 'Kode wajib diisi.',
            'kode_mk.unique' => 'Kode sudah ada, gunakan kode yang lain.',
            'nama_mk.required' => 'Mata kuliah wajib diisi.',
            'semester.required'     => 'Semester wajib diisi.',
            'sks.required'   => 'SKS wajib diisi.',
        ]);
        // 3. Tangkap kondisi menggunakan fails()
        if ($validator->fails()) {
            
            // Ambil semua pesan error dalam bentuk array untuk dilempar ke Toast nanti
            $allErrors = $validator->errors()->all();

            // Lempar ke Livewire menggunakan ValidationException agar input form otomatis merah
            throw ValidationException::withMessages($validator->errors()->toArray());
            // throw ValidationException::withMessages($validator->errors()->toArray());
        }
    }
}
