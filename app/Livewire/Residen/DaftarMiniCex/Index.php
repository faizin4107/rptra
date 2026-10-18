<?php

namespace App\Livewire\Residen\DaftarMiniCex;

use Livewire\Component;

class Index extends Component
{

    public $search = '';
    public function render()
    {
        // $residen_id = Auth::guard('residen')->user()->id;
        // // $jadwals = \App\Models\JadwalResiden::with('user')
        // //     ->with('jadwal')
        // //     ->where('jadwal.user_id', $user_id)
        // //     ->where('user_id', $user_id)
        // //     ->get();
        // $jadwals = JadwalResiden::with([
        //     'residen',          // Mengambil data User residen
        //     'dpjp',
        //     'jadwal.residen'       // Mengambil data Jadwal dan User DPJP di dalamnya
        // ])
        // ->where('residen_id', $residen_id)
        // ->get();
        // dd($jadwals);
        $dpjps = \App\Models\Dpjp::all();
        return view('livewire.residen.daftar-mini-cex.index', compact('dpjps'));
    }
}
