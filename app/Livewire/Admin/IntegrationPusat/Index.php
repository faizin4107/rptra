<?php

namespace App\Livewire\Admin\IntegrationPusat;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.integration-pusat.index');
    }
}
