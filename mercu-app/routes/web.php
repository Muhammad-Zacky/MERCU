<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes - MERCU (SDM Internal Pelindo Teluk Bayur)
|--------------------------------------------------------------------------
*/

/**
 * --- RUTE PUBLIK ---
 */
Route::get('/', function () {
    return view('pages.welcome'); 
})->name('home');

// Simpan laporan dari modal landing page (Umum)
Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');


/**
 * --- RUTE OTENTIKASI ---
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dialihkan karena pendaftaran hanya via Seeder/Admin
Route::get('/register', function () {
    return redirect()->route('login');
})->name('register');


/**
 * --- RUTE INTERNAL MERCU (Wajib Login) ---
 */
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Berbasis Role (Admin/Technician)
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.admin');
        }

        if ($user->role === 'technician') {
            return view('dashboard.tech');
        }

        Auth::logout();
        return redirect()->route('login')->withErrors(['role' => 'Peran tidak dikenali.']);
    })->name('dashboard');

    /**
     * Rute Profil & Pengaturan Akun
     */
    Route::get('/profile', function() {
        return view('profile.edit'); 
    })->name('profile.edit');

    // PROSES UPDATE FOTO PROFIL
    Route::post('/profile/update-photo', [LoginController::class, 'updatePhoto'])->name('profile.update-photo');

});
