<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'reporter_nipp' => 'required',
            'reporter_name' => 'required',
            'unit_id' => 'required',
            'location' => 'required',
            'description' => 'required',
            'evidence_photo' => 'nullable|image|max:2048',
        ]);

        // Generate Nomor Tiket Otomatis (DOCK-2026-XXXX)
        $ticketNumber = 'DOCK-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $data = $request->all();
        $data['ticket_number'] = $ticketNumber;
        $data['status'] = 'pending';

        // Proses Upload Foto jika ada
        if ($request->hasFile('evidence_photo')) {
            $data['evidence_photo'] = $request->file('evidence_photo')->store('evidence', 'public');
        }

        Ticket::create($data);

        return back()->with('success', 'Laporan berhasil dikirim! Nomor Tiket Anda: ' . $ticketNumber);
    }
}
