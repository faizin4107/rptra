<?php

namespace App\Livewire\Dpjp;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Dashboard extends Component
{
    public function render()
    {
        $total_notif = 0;
        $notif_eval = 0;
        return view('livewire.dpjp.dashboard', [
            'total_notif' => 0,
            'notif_eval' => 0
        ]);
    }
}
