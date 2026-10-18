<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')] 
class Home extends Component
{
    public function render()
    {
        return view('livewire.guest.home');
    }
}
