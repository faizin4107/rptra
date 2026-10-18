<?php

namespace App\Livewire\Admin\Krs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use WithPagination, Interactions; // Gunakan fitur pagination & sweetalert
    public $search = '';

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
   
    public function render()
    {
        $headers = [
            ['index' => 'kode_mk', 'label' => 'Kode'],
            ['index' => 'nama_mk', 'label' => 'Mata Kuliah'],
            ['index' => 'semester',     'label' => 'Semester'],
            ['index' => 'sks',     'label' => 'SKS'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        $krs = \App\Models\MasterKrs
            ::where(function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(kode_mk) LIKE ?', ['%' . $keyword . '%'])
                    ->orWhereRaw('LOWER(nama_mk) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->latest()
            ->paginate(10);
        return view('livewire.admin.krs.index', compact('krs', 'headers'));
    }
}
