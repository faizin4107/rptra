<?php

namespace App\Livewire\Dpjp\JadwalDinasResiden;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
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

    


    public function render()
    {
        $data = \App\Models\Jadwal::with('residen')->where('id', $this->id)->first();
        // dd($data);
        $dpjp = \App\Models\Dpjp::where('id', $this->dpjp_id)->first();
        $headers = [
            ['index' => 'residen.fullname', 'label' => 'Nama'],
            ['index' => 'residen.id_identitas', 'label' => 'Identitas ID'],
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
        return view('livewire.dpjp.jadwal-dinas-residen.index', compact('users', 'headers', 'data', 'dpjp'));
    }

}
