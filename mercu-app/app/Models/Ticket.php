<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_number', 'reporter_name', 'reporter_nipp', 'unit_id', 
        'location', 'coordinates', 'description', 'evidence_photo', 
        'status', 'technician_id', 'completion_photo', 'completion_notes'
    ];

    // Laporan ini untuk divisi mana
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Siapa teknisi yang menangani laporan ini
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
