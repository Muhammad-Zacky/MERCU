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

        // Mengikuti format Role di Database kamu: 'admin_sdm'
        if ($user->role === 'admin_sdm' || $user->role === 'admin') {
            // MENGAMBIL DATA STATISTIK REAL-TIME UNTUK MANAJER
            $totalTickets = \App\Models\Ticket::count();
            $pendingTickets = \App\Models\Ticket::where('status', 'pending')->count();
            $completedTickets = \App\Models\Ticket::where('status', 'completed')->count();
            $activeTechs = \App\Models\User::whereIn('role', ['technician', 'teknisi'])->count();

            // MENGAMBIL LOG AKTIVITAS TERBARU (5 Tiket terakhir)
            $recentTickets = \App\Models\Ticket::with('technician') 
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

            return view('dashboard.admin', compact(
                'totalTickets', 
                'pendingTickets', 
                'completedTickets', 
                'activeTechs', 
                'recentTickets'
            ));
        }

        // Mengikuti format Role di Database kamu: 'teknisi'
        if ($user->role === 'technician' || $user->role === 'teknisi') {
            // MENU 1: BURSA LAPORAN
            $tickets = \App\Models\Ticket::where('status', 'pending')
                        ->orderBy('created_at', 'desc')
                        ->get();

            return view('dashboard.tech', compact('tickets'));
        }

        // Jika Pegawai Biasa
        if ($user->role === 'pegawai') {
            return redirect()->route('home')->with('success', 'Anda telah masuk sebagai pegawai.');
        }

        // Antisipasi jika role tidak terdaftar
        Auth::logout();
        return redirect()->route('login')->withErrors(['role' => 'Otoritas akses tidak dikenali oleh sistem.']);
    })->name('dashboard');

    /**
     * --- MANAJEMEN TUGAS / TIKET (KHUSUS TEKNISI) ---
     */
    // Proses Mengambil & Menyelesaikan Tugas
    Route::post('/tickets/take', [TicketController::class, 'takeTask'])->name('tickets.take');
    Route::post('/tickets/complete', [TicketController::class, 'completeTask'])->name('tickets.complete');

    // MENU 2 & 3: Halaman Sedang Dikerjakan dan Riwayat
    Route::get('/tasks/active', [TicketController::class, 'activeTasks'])->name('tasks.active');
    Route::get('/tasks/history', [TicketController::class, 'historyTasks'])->name('tasks.history');


    /**
     * --- MANAJEMEN ADMIN / MANAJERIAL (KHUSUS ADMIN) ---
     */
    // PERBAIKAN: Mengirimkan variabel $tickets ke view admin-tickets
    Route::get('/admin/tickets', function() {
        // Ambil semua tiket beserta teknisi dan unitnya untuk ditampilkan di tabel
        $tickets = \App\Models\Ticket::with(['unit', 'technician'])->orderBy('created_at', 'desc')->get();
        
        return view('dashboard.admin-tickets', compact('tickets'));
    })->name('admin.tickets');

    Route::get('/admin/reports', function() {
        return view('dashboard.admin-reports');
    })->name('admin.reports');

    Route::get('/admin/staff', function() {
        return view('dashboard.admin-staff');
    })->name('admin.staff');


    /**
     * --- RUTE PROFIL & PENGATURAN AKUN ---
     */
    Route::get('/profile', function() {
        return view('profile.edit'); 
    })->name('profile.edit');

    // Proses update foto profil pegawai
    Route::post('/profile/update-photo', [LoginController::class, 'updatePhoto'])->name('profile.update-photo');

});
