<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')] 
class Fasilitas extends Component
{
    public function render()
    {
        return view('livewire.guest.fasilitas');
    }
}
