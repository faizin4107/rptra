<?php

namespace App\Livewire\Residen;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.residen.dashboard', [
            'ipk_real' => 10,
            'stase_selesai' => 20,
            'sisa_stase' => 15,
            'total_stase' => 60,
            'persen_stase' => 80,
        
        ]);
    }
}
