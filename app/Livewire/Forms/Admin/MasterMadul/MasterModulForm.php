<?php

namespace App\Livewire\Forms\Admin\MasterMadul;

use App\Models\MasterModul;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class MasterModulForm extends Form
{
    // 1. Definisikan properti penampung model untuk melacak ID saat proses update
    public ?MasterModul $master_modul = null;

    // 2. Definisikan field formulir beserta aturan validasinya
    public $add_kode_modul = '';
    public $add_nama_modul = '';
    public $add_semester = '';
    public $add_sks = '';
    public $add_kuota_tindakan = 0;
    public $add_asa1 = false;
    public $add_asa2 = false;
    public $add_asa3 = false;
    public $add_asa4 = false;
    public $add_asa5 = false;
    public $add_asa6 = false;
    public $add_asa7 = false;
    public $add_asa8 = false;

    public $id = '';
    public $edit_kode_modul = '';
    public $edit_nama_modul = '';
    public $edit_semester = '';
    public $edit_sks = '';
    public $edit_kuota_tindakan = 0;
    public $edit_asa1 = false;
    public $edit_asa2 = false;
    public $edit_asa3 = false;
    public $edit_asa4 = false;
    public $edit_asa5 = false;
    public $edit_asa6 = false;
    public $edit_asa7 = false;
    public $edit_asa8 = false;

    public function setData(MasterModul $master_modul)
    {
        $this->master_modul = $master_modul;
        $this->id = $master_modul->id;
        $this->edit_kode_modul = $master_modul->kode_modul;
        $this->edit_nama_modul = $master_modul->nama_modul;
        $this->edit_semester = $master_modul->semester;
        $this->edit_sks = $master_modul->sks;
        $this->edit_kuota_tindakan = $master_modul->kuota_tindakan;
        $this->edit_asa1 = $master_modul->asa1;
        $this->edit_asa2 = $master_modul->asa2;
        $this->edit_asa3 = $master_modul->asa3;
        $this->edit_asa4 = $master_modul->asa4;
        $this->edit_asa5 = $master_modul->asa5;
        $this->edit_asa6 = $master_modul->asa6;
        $this->edit_asa7 = $master_modul->asa7;
    }

    public function validateCreate()
    {
        $id = $this->master_modul ? $this->master_modul->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
        $data = [
            'kode_modul' => $this->add_kode_modul,
            'nama_modul' => $this->add_nama_modul,
            'semester'    => $this->add_semester,
            'sks'     => $this->add_sks,
            'kuota_tindakan'     => $this->add_kuota_tindakan,
            'asa1'     => $this->add_asa1,
            'asa2'     => $this->add_asa2,
            'asa3'     => $this->add_asa3,
            'asa4'     => $this->add_asa4,
            'asa5'     => $this->add_asa5,
            'asa6'     => $this->add_asa6,
            'asa7'     => $this->add_asa7,
        ];
         // 2. Buat instance Validator Laravel standar
        $validator = Validator::make($data, [
            'kode_modul' => 'required|unique:master_modul,kode_modul',
            'nama_modul' => 'required',
            'semester'   => 'required',
            'sks' => 'required',
        ], [
            'kode_modul.required' => 'Kode wajib diisi.',
            'kode_modul.unique' => 'Kode sudah ada, gunakan kode yang lain.',
            'nama_modul.required' => 'Nama modul wajib diisi.',
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
