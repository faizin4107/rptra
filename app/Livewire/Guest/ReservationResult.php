<?php

namespace App\Livewire\Guest;

use App\Models\Pemesanan;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')] 
class ReservationResult extends Component
{
    public $pemesanan;

    // Parameter dari URL akan otomatis masuk ke method mount
    public function mount($id) 
    {
        // Cari data berdasarkan ID yang dilempar dari rute sebelumnya
        $this->pemesanan = Pemesanan::findOrFail($id);
    }
    
    public function render()
    {
        return view('livewire.guest.reservation-result');
    }
}
