<x-app-layout>
    {{-- CSS Khusus Dashboard Manajer (Clean & Minimalist) --}}
    <style>
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Custom Scrollbar Halus */
        .table-scroll::-webkit-scrollbar { height: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in-up">
            <div>
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight leading-none mb-1.5">
                    Tinjauan Eksekutif
                </h2>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Sistem Laporan & Pemeliharaan Fasilitas</p>
            </div>
            
            {{-- Indikator Status Minimalis --}}
            <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-lg border border-slate-200 shadow-sm shrink-0">
                <div class="flex items-center justify-center">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-700 tracking-tight">Sistem Optimal</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-6 max-w-7xl mx-auto">
        
        {{-- BAGIAN 1: STATISTIK UTAMA (Real-Time Cards) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-fade-in-up delay-100">
            
            {{-- Card Total Laporan --}}
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Tiket Masuk</p>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <p class="text-4xl font-black text-slate-800 tracking-tight leading-none mb-2">
                        {{ number_format($totalTickets) }}
                    </p>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        <span class="text-[10px] font-bold text-emerald-600">Seluruh Waktu</span>
                    </div>
                </div>
            </div>

            {{-- Card Pending --}}
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Menunggu Tindakan</p>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-4xl font-black text-slate-800 tracking-tight leading-none mb-2">
                        {{ number_format($pendingTickets) }}
                    </p>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span class="text-[10px] font-bold text-slate-500">Tiket memerlukan atensi</span>
                    </div>
                </div>
            </div>

            {{-- Card Selesai --}}
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Diselesaikan</p>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-4xl font-black text-slate-800 tracking-tight leading-none mb-2">
                        {{ number_format($completedTickets) }}
                    </p>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden">
                        {{-- Logika Progress Bar Sederhana --}}
                        @php
                            $percentage = $totalTickets > 0 ? ($completedTickets / $totalTickets) * 100 : 0;
                        @endphp
                        <div class="bg-[#003459] h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Card Personel Aktif --}}
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Personel Lapangan</p>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-4xl font-black text-slate-800 tracking-tight leading-none mb-2">
                        {{ number_format($activeTechs) }}
                    </p>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#00AEEF]"></span>
                        <span class="text-[10px] font-bold text-slate-500">Teknisi operasional terdaftar</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: TABEL LOG AKTIVITAS (Data Real-Time) --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-up delay-200">
            
            {{-- Header Tabel --}}
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Log Laporan Terbaru</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Daftar laporan 5 terakhir yang masuk ke dalam sistem MERCU.</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Saring
                    </button>
                    <button class="px-4 py-2 bg-[#003459] text-white text-xs font-bold rounded hover:bg-slate-800 transition-colors shadow-sm">
                        Unduh Data Lengkap
                    </button>
                </div>
            </div>

            {{-- Area Tabel --}}
            <div class="overflow-x-auto table-scroll">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest w-32">ID Tiket</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Identitas Pelapor</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Klasifikasi & Deskripsi Singkat</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Dilaporkan</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Status Terkini</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        @forelse($recentTickets as $ticket)
                            <tr class="hover:bg-slate-50 transition-colors {{ $ticket->status === 'completed' ? 'opacity-75' : '' }}">
                                <td class="px-6 py-4 font-mono text-xs text-slate-600">
                                    {{ $ticket->ticket_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800">{{ $ticket->reporter_name }}</p>
                                    <p class="text-[10px] text-slate-500 font-mono mt-0.5">NIPP: {{ $ticket->reporter_nipp }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-700 mb-0.5">{{ $ticket->unit->name ?? 'Fasilitas Umum' }}</p>
                                    <p class="text-xs text-slate-500 truncate max-w-xs" title="{{ $ticket->description }}">
                                        {{ $ticket->description }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-xs font-semibold text-slate-600">{{ $ticket->created_at->diffForHumans() }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col items-start gap-1">
                                        @if($ticket->status === 'pending')
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                                <span class="text-xs font-bold text-slate-700">Belum Didisposisi</span>
                                            </div>
                                        @elseif($ticket->status === 'in_progress')
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 rounded-full bg-[#00AEEF]"></span>
                                                <span class="text-xs font-bold text-slate-700">Sedang Dikerjakan</span>
                                            </div>
                                            @if($ticket->technician)
                                                <span class="text-[9px] font-bold text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded border border-blue-100">
                                                    Oleh: {{ $ticket->technician->name }}
                                                </span>
                                            @endif
                                        @elseif($ticket->status === 'completed')
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                                                <span class="text-xs font-bold text-slate-500">Selesai</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-8 h-8 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    <p class="text-sm font-bold">Belum ada data laporan yang diregistrasikan.</p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            
            {{-- Footer Tabel --}}
            <div class="bg-white px-6 py-4 border-t border-slate-100 flex justify-end">
                <a href="#" class="text-xs font-bold text-[#003459] hover:underline">Lihat Semua Riwayat Laporan &rarr;</a>
            </div>
        </div>
    </div>
</x-app-layout>
