<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cari user yang sedang login di guard mana pun
        $user = null;
        
        // Daftar guard yang ingin dicek
        $guards = ['web']; 

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                break;
            }
        }

        // 2. Validasi user dan role-nya
        if (!$user || $user->role !== $role) {
            abort(403, 'Aksi Ditolak. Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}