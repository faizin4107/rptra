<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        // 1. Proses logout user dari Auth guard
        // Auth::logout();

        // // 2. Bersihkan dan hapus seluruh data session saat ini
        // session()->invalidate();

        // // 3. Buat ulang token CSRF baru agar session lama tidak bisa dibajak
        // session()->regenerateToken();

        // // 4. Redirect kembali ke halaman login utama
        $role = '';
        // return redirect()->route('login');
        if (Auth::guard('web')->check()) {
            $role = 'admin';
            Auth::guard('web')->logout();
        }

        // 2. Logout dari guard 'residen' (Tabel Residen)
        if (Auth::guard('pengguna')->check()) {
            $role = 'pengguna';
            Auth::guard('pengguna')->logout();
        }

        // 3. Bersihkan session secara total
        session()->invalidate();

        // 4. Buat ulang token CSRF
        session()->regenerateToken();
        if ($role == 'admin') {
            return redirect()->route('login.admin');
        }

        // 5. Redirect ke halaman login
        return redirect()->route('login');
    }

    public function render()
    {
        // Komponen ini tidak perlu merender HTML, cukup tombol pemicu saja
        return <<<'HTML'
            <button wire:click="logout" class="text-xs font-black uppercase tracking-wider px-4 py-2 border-2 border-slate-200 rounded-xl text-slate-700 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-100 transition-all cursor-pointer">
                Keluar
            </button>
        HTML;
        // <livewire:auth.logout />
    }
}
