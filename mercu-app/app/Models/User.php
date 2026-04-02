<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'nipp', 'email', 'password', 'role', 'profile_photo', 'unit_id', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relasi: Teknisi ini milik divisi mana
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Relasi: Tiket apa saja yang sedang/sudah dikerjakan teknisi ini
    public function handledTickets()
    {
        return $this->hasMany(Ticket::class, 'technician_id');
    }
}
