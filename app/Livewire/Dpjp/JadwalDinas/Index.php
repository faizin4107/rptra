<?php

namespace App\Livewire\Dpjp\JadwalDinas;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $dpjp_id = Auth::guard('dpjp')->user()->id;
        // $jadwals = \App\Models\JadwalResiden::with('user')
        //     ->with('jadwal')
        //     ->where('jadwal.user_id', $user_id)
        //     ->where('user_id', $user_id)
        //     ->get();
        $jadwals = Jadwal::with([
            'dpjp',
        ])
        ->where('dpjp_id', $dpjp_id)
        ->get();
        // dd($jadwals);
        return view('livewire.dpjp.jadwal-dinas.index', compact('jadwals'));
    }
}
