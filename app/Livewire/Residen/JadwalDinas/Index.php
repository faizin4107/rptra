<?php

namespace App\Livewire\Residen\JadwalDinas;

use App\Models\JadwalResiden;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
    public $search = '';
    public function render()
    {
        $residen_id = Auth::guard('residen')->user()->id;
        // $jadwals = \App\Models\JadwalResiden::with('user')
        //     ->with('jadwal')
        //     ->where('jadwal.user_id', $user_id)
        //     ->where('user_id', $user_id)
        //     ->get();
        $jadwals = JadwalResiden::with([
            'residen',          // Mengambil data User residen
            'dpjp',
            'jadwal.residen'       // Mengambil data Jadwal dan User DPJP di dalamnya
        ])
        ->where('residen_id', $residen_id)
        ->get();
        // dd($jadwals);
        return view('livewire.residen.jadwal-dinas.index', compact('jadwals'));
    }
}
