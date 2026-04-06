<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Memproses penyimpanan laporan tiket baru dari pengguna (Masyarakat/Staf Umum).
     */
    public function store(Request $request)
    {
        // Validasi Input secara ketat
        $request->validate([
            'reporter_nipp'      => 'required|string|max:50',
            'reporter_name'      => 'required|string|max:255',
            'unit_id'            => 'required|exists:units,id',
            'location'           => 'required|string|max:255',
            'coordinates'        => 'nullable|string|max:255',
            'description'        => 'required|string',
            'evidence_photo'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'evidence_photo_cam' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate Nomor Tiket Otomatis (Format: MERCU-YYYYMMDD-XXXX)
        $ticketNumber = 'MERCU-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        // Persiapkan Data untuk disimpan
        $data = $request->except(['evidence_photo', 'evidence_photo_cam']);
        $data['ticket_number'] = $ticketNumber;
        $data['status']        = 'pending';

        // Logika Pemrosesan Upload Foto (Kamera vs Galeri)
        if ($request->hasFile('evidence_photo_cam')) {
            $data['evidence_photo'] = $request->file('evidence_photo_cam')->store('evidence_photos', 'public');
        } elseif ($request->hasFile('evidence_photo')) {
            $data['evidence_photo'] = $request->file('evidence_photo')->store('evidence_photos', 'public');
        }

        // Simpan ke Database
        Ticket::create($data);

        return back()->with('success', 'Dokumen laporan berhasil diregistrasi! Nomor Tiket Anda: ' . $ticketNumber);
    }

    /**
     * Memproses pengambilan tugas operasional oleh Teknisi/Staf SDM.
     */
    public function takeTask(Request $request)
    {
        // Validasi ID Tiket
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id'
        ]);

        // Cari tiket berdasarkan ID
        $ticket = Ticket::findOrFail($request->ticket_id);

        // Keamanan: Pastikan tiket masih berstatus pending
        if ($ticket->status !== 'pending') {
            return back()->with('error', 'Mohon maaf, tiket ini telah diambil alih oleh personel lain.');
        }

        // Update database: Ubah status & tautkan ID teknisi yang mengambil
        $ticket->update([
            'status'        => 'in_progress', 
            'technician_id' => Auth::id(),
        ]);

        return back()->with('success', 'Tugas berhasil Anda ambil. Silakan segera menuju lokasi penanganan.');
    }

    /**
     * Menampilkan halaman "Sedang Dikerjakan" untuk Teknisi.
     */
    public function activeTasks()
    {
        // Tarik data tiket yang sedang dikerjakan oleh teknisi yang login
        $tickets = Ticket::where('technician_id', Auth::id())
                    ->where('status', 'in_progress')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('dashboard.tech-active', compact('tickets'));
    }

    /**
     * Menampilkan halaman "Riwayat Kinerja" untuk Teknisi (Tugas Selesai).
     */
    public function historyTasks()
    {
        // Tarik data tiket yang sudah diselesaikan oleh teknisi yang login
        $tickets = Ticket::where('technician_id', Auth::id())
                    ->where('status', 'completed')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('dashboard.tech-history', compact('tickets'));
    }

    /**
     * Memproses penyelesaian tugas oleh Teknisi.
     */
    public function completeTask(Request $request)
    {
        // Validasi ID Tiket
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id'
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // Keamanan berlapis: Pastikan tiket ini memang milik teknisi yang login dan statusnya in_progress
        if ($ticket->technician_id !== Auth::id() || $ticket->status !== 'in_progress') {
            return back()->with('error', 'Aksi ditolak. Tiket ini tidak valid atau bukan wewenang Anda.');
        }

        // Update status menjadi selesai
        $ticket->update([
            'status' => 'completed'
        ]);

        // Lempar kembali ke halaman riwayat dengan pesan sukses
        return redirect()->route('tasks.history')->with('success', 'Kerja bagus! Laporan berhasil diselesaikan dan masuk ke Riwayat Kinerja Anda.');
    }
}
