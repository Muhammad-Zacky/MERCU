<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Kode Unik, cth: DOCK-260401-001
            
            // Data Pelapor (Karyawan tanpa login)
            $table->string('reporter_name');
            $table->string('reporter_nipp');
            
            // Relasi Masalah
            $table->foreignId('unit_id')->constrained('units')->restrictOnDelete();
            
            // Detail Masalah
            $table->string('location');
            $table->string('coordinates')->nullable(); // Titik Shareloc (Latitude, Longitude)
            $table->text('description');
            $table->string('evidence_photo')->nullable(); // Foto saat lapor
            
            // Status & Penanganan
            $table->enum('status', ['pending', 'approved', 'in_progress', 'waiting_part', 'completed', 'rejected'])->default('pending');
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete(); // Siapa teknisi yang ngerjain
            
            // Bukti Selesai dari Teknisi
            $table->string('completion_photo')->nullable();
            $table->text('completion_notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
