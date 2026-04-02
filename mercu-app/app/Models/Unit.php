<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    // Relasi: Satu unit punya banyak teknisi
    public function technicians()
    {
        return $this->hasMany(User::class)->where('role', 'technician');
    }

    // Relasi: Satu unit punya banyak laporan
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
