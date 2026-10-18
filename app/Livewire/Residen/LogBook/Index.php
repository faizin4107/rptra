<?php

namespace App\Livewire\Residen\LogBook;

use App\Livewire\Forms\Residen\LogBook\LogBookForm;
use App\Models\KrsResiden;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 

class Index extends Component
{
    use WithPagination, Interactions;
    public $search = '';
    // public $modul_id = '';
    public ?LogBookForm $form = null;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new LogBookForm($this, 'form');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refresh-tabel')]
    public function refreshTable()
    {
        // Cukup biarkan kosong. 
        // Saat fungsi ini dipanggil oleh event, Livewire otomatis menjalankan ulang render()
    }

    // public function store()
    // {
    //     try {
    //         $this->form->validateCreate();
    //         // dd(Auth::user()->id);
    //         KrsResiden::create([
    //             'master_krs_id' => $this->form->master_krs_id,
    //             'user_id' => Auth::user()->id,
    //             'status' => 'Pending'
    //         ]);
    //         $this->form->reset();
    //         $this->dispatch('refresh-tabel');
    //         $this->toast()->success('Berhasil!', "Berhasil mengirim ke admin untuk dikonfirmasi.") ->send();
    //     } catch (ValidationException $e) {
            
    //         // Ambil kumpulan pesan error dari exception
    //         $errors = $e->validator->errors()->all();

    //         // Looping dan tembakkan masing-masing error sebagai Toast dari TallStackUi
    //         foreach ($errors as $error) {
    //             $this->toast()->error('Validasi Gagal!', $error)->send();
    //         }
    //          // Teruskan kembali error bag internal agar form input ikut berwarna merah
    //         throw $e;
    //     }
    // }



    public function render()
    {
        // $headers = [
        //     ['index' => 'modul', 'label' => 'Modul'],
        //     ['index' => 'semester_sks', 'label' => 'SKS'],
        //     ['index' => 'status',     'label' => 'Status'],
        // ];
        $residen_id = Auth::guard('residen')->user()->id;
        // $moduls = KrsResiden::with([
        //     'user',          // Mengambil data User residen
        //     'master_krs'       // Mengambil data Jadwal dan User DPJP di dalamnya
        // ])
        // ->where('user_id', $user_id)
        // ->latest()->paginate(10);
        // // dd($moduls);
        // $master_krs = \App\Models\MasterKrs::all();
        $stase = KrsResiden::with([
            'residen',          // Mengambil data User residen
            'master_krs'       // Mengambil data Jadwal dan User DPJP di dalamnya
        ])
        ->where('status', 'Disetujui')
        ->where('residen_id', $residen_id)
        ->get();
        // $stase = \App\Models\KrsResiden::where('status', '=', 'Disetujui')->get();
        // $cek_stase = false;
        return view('livewire.residen.log-book.index', compact('stase'));
    }

}
