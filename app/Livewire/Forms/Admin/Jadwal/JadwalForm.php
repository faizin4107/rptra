<?php

namespace App\Livewire\Forms\Admin\Jadwal;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class JadwalForm extends Form
{
    // 1. Definisikan properti penampung model untuk melacak ID saat proses update
    public ?Jadwal $jadwal = null;

    // 2. Definisikan field formulir beserta aturan validasinya
    public $add_dpjp_id = '';
    public $add_day = '';
    public $add_start_time = '';
    public $add_end_time = '';

    public $id = '';
    public $edit_dpjp_id = '';
    public $edit_day = '';
    public $starttime = '';
    public $endtime = '';

    public $users = [];

    public function setData(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
        $this->id = $jadwal->id;
        $this->edit_dpjp_id = $jadwal->dpjp_id;
        $this->edit_day = $jadwal->day;
        $this->starttime = $jadwal->start_time;
        $this->endtime = $jadwal->end_time;
    }

    public function validateCreate()
    {
        $jadwalId = $this->jadwal ? $this->jadwal->id : 'NULL';

        // 1. Satukan data dari properti Form Object ke dalam array
        $data = [
            'dpjp_id' => $this->add_dpjp_id,
            'day' => $this->add_day,
            'start_time'    => $this->add_start_time,
            'end_time'     => $this->add_end_time,
        ];
         // 2. Buat instance Validator Laravel standar
        $validator = Validator::make($data, [
            'dpjp_id' => 'required',
            'day' => 'required',
            'start_time'   => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'user_id.required' => 'Nama lengkap wajib diisi.',
            'day.required' => 'Hari wajib diisi.',
            'start_time.required'     => 'Jam mulai wajib diisi.',
            'start_time.date_format'     => 'Format jam mulai tidak valid.',
            'end_time.required'   => 'Jam selesai wajib diisi.',
            'end_time.date_format'     => 'Format jam selesai tidak valid.',
            'end_time.after'     => 'Jam mulai tidak boleh lebih dari jam selesai.',
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
