<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Fasilitas (Hanya yang diurus oleh SDM)
        $cat1 = Unit::create([
            'name' => 'Fasilitas Kerja & ATK',
            'slug' => 'fasilitas-atk',
            'description' => 'Meja, kursi, lemari, dan kebutuhan alat tulis kantor.'
        ]);

        $cat2 = Unit::create([
            'name' => 'Pemeliharaan Gedung (RT)',
            'slug' => 'maintenance-rt',
            'description' => 'AC, Lampu, Air, dan kebersihan area kerja.'
        ]);

        $cat3 = Unit::create([
            'name' => 'Layanan Kepegawaian',
            'slug' => 'layanan-sdm',
            'description' => 'Urusan ID Card, Seragam, dan administrasi personil.'
        ]);

        // 2. Akun Internal SDM (Hanya staf SDM yang punya akses)
        
        // MANAGER / ADMIN (Full Access untuk pantau rekap)
        User::create([
            'name' => 'Manager SDM & Umum',
            'nipp' => '10001',
            'email' => 'manager.sdm@pelindo.co.id',
            'password' => Hash::make('mercu2026'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // STAF OPERASIONAL SDM (Yang bertugas eksekusi/panggil tukang luar)
        User::create([
            'name' => 'Zacky (Staf Umum SDM)',
            'nipp' => '10002',
            'email' => 'zacky.sdm@pelindo.co.id',
            'password' => Hash::make('mercu2026'),
            'role' => 'technician', 
            'unit_id' => $cat2->id,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Staf Administrasi SDM',
            'nipp' => '10003',
            'email' => 'admin.sdm@pelindo.co.id',
            'password' => Hash::make('mercu2026'),
            'role' => 'technician',
            'unit_id' => $cat3->id,
            'is_active' => true,
        ]);
    }
}
