<?php

namespace App\Livewire\Guest;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        // 2. Logout dari guard 'residen' (Tabel Residen)
        if (Auth::guard('pengguna')->check()) {
            $role = 'pengguna';
            Auth::guard('pengguna')->logout();
        }

        // 3. Bersihkan session secara total
        session()->invalidate();

        // 4. Buat ulang token CSRF
        session()->regenerateToken();
        
        return redirect()->route('home');
    }

    public function render()
    {
        return <<<'HTML'
            <a href="#" wire:click="logout" wire:navigate class="text-sm font-medium text-red-500 hover:text-red-700 spring-transition flex items-center gap-1">
                <i class="ph ph-sign-out"></i> <span class="hidden sm:inline">Keluar</span>
            </a>
        HTML;
    }
}
