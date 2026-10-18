<?php

namespace App\Livewire\Admin\JadwalDinas;

use Livewire\Component;
use App\Models\Jadwal;
use App\Models\JadwalResiden;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Residen extends Component
{
    use WithPagination, Interactions;
    public $search = '';
    public $id = 0;
    public $dpjp_id = 0;

    public function mount($id = null, $dpjp_id = null)
    {
        // dd($this->id);
        $this->id =$id;
        $this->dpjp_id = $dpjp_id;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->dialog()
            ->question('Apakah Anda Yakin?', 'Data ini akan dihapus secara permanen.')
            ->confirm('Ya, Hapus!', 'delete', [
                'id' => $id,
                'color' => 'red' // Paksa menggunakan warna red agar lebih jelas
            ])
            ->cancel('Batal', 'cancelAction')
            ->send();
    }

    /**
     * Eksekusi Hapus Data Resmi
     */
    public function delete($id)
    {
        $data = \App\Models\JadwalResiden::where('id', $id)->first(); 


        if ($data) {
            $data->delete();
            $this->toast()->success('Berhasil!', 'Data berhasil dihapus.')->send();
            // $this->dialog()->success('Berhasil!', 'Data pengguna telah sukses dihapus.')->send();
        }
    }

    public function cancelAction()
    {
        
    }

    #[On('refresh-tabel')]
    public function refreshTable()
    {
        // Cukup biarkan kosong. 
        // Saat fungsi ini dipanggil oleh event, Livewire otomatis menjalankan ulang render()
    }


    public function render()
    {
        $data = \App\Models\Jadwal::with('residen')->where('id', $this->id)->first();
        // dd($data);
        $dpjp = \App\Models\Dpjp::where('id', $this->dpjp_id)->first();
        $headers = [
            ['index' => 'residen.fullname', 'label' => 'Nama'],
            ['index' => 'residen.id_identitas', 'label' => 'Identitas ID'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];

        $users = \App\Models\JadwalResiden::with('residen')
            ->whereHas('residen', function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->when(!empty($this->search), function($query) {
                $keyword = strtolower($this->search);
                $query->whereRaw('LOWER(day) LIKE ?', ['%' . $keyword . '%']);
            })
            ->where('jadwal_id', $this->id)
            ->latest()
            ->paginate(10);
        // dd($users);
        return view('livewire.admin.jadwal-dinas.residen', compact('users', 'headers', 'data', 'dpjp'));
    }
}
