<?php

namespace App\Livewire\Admin;

use App\Models\Pemesanan;
use App\Models\Pengguna;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Dashboard extends Component
{
    // public function changePage()
    // {
    //     // Memicu event bernama 'updatePage' dan mengirimkan datanya
    //     $this->dispatch('updatePage', page: 'home');
    // }
    public function mount()
    {
        // Tembakkan nama halaman ke sidebar
        $this->dispatch('updatePage', page: 'home');
    }

    public function render()
    {
        $total_pengguna = Pengguna::count();
        $total_pemesanan_pending = Pemesanan::where('status', 'pending')->count();
        $total_pemesanan_booking = Pemesanan::where('status', 'booking')->count();
        $total_pemesanan_selesai = Pemesanan::where('status', 'selesai')->count();
        $total_pemesanan = Pemesanan::count();
        return view('livewire.admin.dashboard', [
            'total_pengguna' => $total_pengguna,
            'total_pemesanan_pending' => $total_pemesanan_pending,
            'total_pemesanan_booking' => $total_pemesanan_booking,
            'total_pemesanan_selesai' => $total_pemesanan_selesai,
            'total_pemesanan' => $total_pemesanan,
            'page' => 'home',
        ]);
    }
}
