<?php

use App\Livewire\Utils\Captcha;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Users\UserAdmin;
use App\Livewire\Admin\Users\UserPengguna;
use App\Livewire\Auth\LoginAdmin;
use App\Livewire\Auth\PasswordResetOtp;
use App\Livewire\Guest\Home;
use App\Livewire\Guest\Register;
use App\Livewire\Guest\Login;
use App\Livewire\Guest\Reservation;
use App\Livewire\Guest\Fasilitas;
use App\Livewire\Guest\ReservationResult;
use App\Models\Pemesanan;
use App\Livewire\Admin\Reservation\Index as ReservationIndex;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get("/login-admin", LoginAdmin::class)->name('login.admin');
Route::get("/", Home::class)->name('home');
Route::get("/register", Register::class)->name('register');
Route::get("/login", Login::class)->name('login');
Route::get("/reservation", Reservation::class)->name('reservation');
Route::get("/fasilitas", Fasilitas::class)->name('fasilitas');
Route::get("/reservation-result/{id}", ReservationResult::class)->name('reservation.result');
Route::get('/forgot-password', PasswordResetOtp::class)->name('password.request');
Route::get('/download-tiket/{id}', function ($id) {
    // 1. Cari data di database
    $pemesanan = Pemesanan::findOrFail($id);

    // 2. Load ke view PDF yang kita buat tadi
    $pdf = Pdf::loadView('pdf.tiket-reservasi', ['pemesanan' => $pemesanan]);

    // 3. (Opsional) Ubah ukuran kertas ke A5 agar lebih mirip tiket
    $pdf->setPaper('a5', 'landscape');

    // 4. Perintahkan browser untuk mengunduh (download)
    // Gunakan id_reservasi sebagai nama file
    return $pdf->download('Tiket_Reservasi_' . $pemesanan->id_reservasi . '.pdf');

})->name('download.tiket');
Route::middleware(['auth:web', 'role:admin'])->group(function () {
    
    // Group Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/users/admin', UserAdmin::class)->name('users.admin');
        Route::get('/users/pengguna', UserPengguna::class)->name('users.pengguna');
        Route::get('/reservation-index/{status?}', ReservationIndex::class)->name('reservation.index');
    });


});
