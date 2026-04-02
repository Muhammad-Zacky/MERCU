<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Menangani proses autentikasi (Login)
     * Kredensial menggunakan Email dan Password dari Seeder.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form login
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba mencocokkan kredensial ke database
        // 'remember' diambil dari checkbox 'Ingat Saya' pada view login
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            
            // Jika sukses, buat ulang session agar aman dari session fixation
            $request->session()->regenerate();

            // Redirect ke dashboard (Logika pembagian role admin/tech ada di web.php)
            return redirect()->intended('dashboard');
        }

        // 3. Jika gagal, kembalikan ke login dengan pesan error
        throw ValidationException::withMessages([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ]);
    }

    /**
     * Menangani proses Update Foto Profil MERCU
     */
    public function updatePhoto(Request $request)
    {
        // 1. Validasi file (Maksimal 2MB, format gambar)
        $request->validate([
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Cek jika user sudah punya foto sebelumnya, hapus file lamanya
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // 3. Simpan file foto baru ke folder 'profile_photos' di storage/app/public
        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        // 4. Update kolom profile_photo di tabel users
        $user->update([
            'profile_photo' => $path
        ]);

        // 5. Kembali ke halaman profil dengan pesan sukses
        return back()->with('success', 'Foto profil Anda berhasil diperbarui!');
    }

    /**
     * Menangani proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
