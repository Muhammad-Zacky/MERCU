<x-app-layout>
    {{-- CSS Animasi Transisi Halus --}}
    <style>
        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; opacity: 0; }
        @keyframes fadeInUp { 
            from { opacity: 0; transform: translateY(15px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        /* Mencegah scroll pada background saat modal terbuka */
        body.modal-open { overflow: hidden; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 animate-fade-in-up">
            <div class="border-l-4 border-emerald-500 pl-4">
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight leading-none mb-1.5">
                    Riwayat Kinerja
                </h2>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Rekapitulasi Tugas Selesai</p>
            </div>
        </div>
    </x-slot>

    {{-- Wrapper utama dengan Alpine.js untuk Modal --}}
    <div x-data="{ modalOpen: false, selectedTicket: null }" class="py-8 space-y-5 max-w-5xl mx-auto relative">
        
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-bold border border-emerald-200 shadow-sm flex items-center gap-3 animate-fade-in-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @forelse($tickets as $ticket)
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-start justify-between gap-6 transition-all animate-fade-in-up border-l-4 border-l-emerald-500 opacity-80 hover:opacity-100 hover:shadow-md group">
                
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs font-mono font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                            {{ $ticket->ticket_number }}
                        </span>
                        <span class="flex items-center gap-1.5 text-[10px] font-bold text-emerald-700 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Tuntas
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-black text-slate-700 mb-2 line-clamp-2 group-hover:text-emerald-700 transition-colors">
                        {{ $ticket->description }}
                    </h3>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6 text-xs font-medium text-slate-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $ticket->location }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Diselesaikan {{ $ticket->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
                
                <div class="shrink-0 flex items-center border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0 md:pl-6 w-full md:w-auto">
                    {{-- Tombol Lihat Detail (Memicu Modal) --}}
                    <button type="button" 
                            @click="
                                selectedTicket = {
                                    number: '{{ $ticket->ticket_number }}',
                                    reporter: '{{ addslashes($ticket->reporter_name) }}',
                                    nipp: '{{ addslashes($ticket->reporter_nipp) }}',
                                    unit: '{{ $ticket->unit->name ?? 'Umum' }}',
                                    location: '{{ addslashes($ticket->location) }}',
                                    coordinates: '{{ $ticket->coordinates ?? '-' }}',
                                    description: '{{ addslashes(preg_replace('/\r|\n/', ' ', $ticket->description)) }}',
                                    reported_at: '{{ $ticket->created_at->format('d M Y, H:i') }}',
                                    completed_at: '{{ $ticket->updated_at->format('d M Y, H:i') }}',
                                    photo: '{{ $ticket->evidence_photo ? asset('storage/' . $ticket->evidence_photo) : null }}'
                                };
                                modalOpen = true;
                                document.body.classList.add('modal-open');
                            "
                            class="w-full md:w-32 px-4 py-2 bg-white border border-slate-300 text-slate-700 font-bold text-xs uppercase tracking-widest rounded hover:bg-slate-50 transition-colors shadow-sm">
                        Arsip Detail
                    </button>
                </div>
            </div>
        @empty
            <div class="py-24 text-center bg-white rounded-xl border border-slate-200 shadow-sm animate-fade-in-up">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-slate-600 font-black text-lg mb-1">Riwayat Kosong</h3>
                <p class="text-slate-400 text-sm font-medium">Belum ada tugas yang Anda selesaikan.</p>
            </div>
        @endforelse

        {{-- ========================================== --}}
        {{-- MODAL POP-UP ARSIP DETAIL (Clean Corporate) --}}
        {{-- ========================================== --}}
        <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" style="display: none;">
            
            {{-- Backdrop Gelap --}}
            <div x-show="modalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="modalOpen = false; document.body.classList.remove('modal-open');" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            
            {{-- Kontainer Modal --}}
            <div x-show="modalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 class="relative bg-white w-full max-w-2xl rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh] border border-slate-200">
                
                {{-- Header Modal --}}
                <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex justify-between items-center shrink-0">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Arsip Laporan Tuntas
                        </h3>
                        <p class="text-[10px] text-slate-500 font-mono font-bold mt-0.5" x-text="selectedTicket?.number"></p>
                    </div>
                    <button @click="modalOpen = false; document.body.classList.remove('modal-open');" type="button" class="text-slate-400 bg-white border border-slate-200 hover:bg-slate-100 hover:text-slate-700 p-1.5 rounded transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Body Modal (Bisa di-scroll) --}}
                <div class="overflow-y-auto p-6 flex-1 bg-white">
                    <div class="space-y-6">
                        
                        {{-- Info Waktu (Reported vs Completed) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-4 rounded border border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Waktu Masuk</p>
                                <p class="text-sm font-bold text-slate-700" x-text="selectedTicket?.reported_at"></p>
                            </div>
                            <div class="bg-emerald-50 p-4 rounded border border-emerald-100">
                                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Waktu Tuntas</p>
                                <p class="text-sm font-bold text-emerald-800" x-text="selectedTicket?.completed_at"></p>
                            </div>
                        </div>

                        {{-- Info Pelapor & Lokasi --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pelapor</p>
                                <p class="text-sm font-bold text-slate-800" x-text="selectedTicket?.reporter"></p>
                                <p class="text-xs text-slate-500 font-mono mt-0.5" x-text="'NIPP: ' + selectedTicket?.nipp"></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Lokasi Kejadian</p>
                                <p class="text-sm font-medium text-slate-700 bg-white border border-slate-200 p-2.5 rounded" x-text="selectedTicket?.location"></p>
                            </div>
                        </div>
                        
                        {{-- Koordinat (Hanya tampil jika ada) --}}
                        <template x-if="selectedTicket?.coordinates && selectedTicket?.coordinates !== '-'">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Koordinat GPS</p>
                                <p class="text-xs font-mono text-slate-600 bg-slate-50 border border-slate-200 p-2 rounded inline-block" x-text="selectedTicket?.coordinates"></p>
                            </div>
                        </template>

                        {{-- Deskripsi Masalah --}}
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Uraian Kendala Diselesaikan</p>
                            <div class="text-sm text-slate-700 bg-slate-50 border border-slate-200 p-4 rounded leading-relaxed whitespace-pre-wrap" x-text="selectedTicket?.description"></div>
                        </div>

                        {{-- Bukti Foto Awal --}}
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Dokumentasi Bukti Awal</p>
                            <template x-if="selectedTicket?.photo">
                                <div class="border border-slate-200 rounded p-2 bg-slate-50">
                                    <img :src="selectedTicket.photo" class="w-full max-h-64 object-contain rounded bg-white">
                                </div>
                            </template>
                            <template x-if="!selectedTicket?.photo">
                                <div class="border border-dashed border-slate-300 rounded p-8 bg-slate-50 text-center">
                                    <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-xs font-semibold text-slate-500">Tidak ada lampiran foto dari pelapor</p>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="bg-slate-50 border-t border-slate-200 px-6 py-4 flex justify-end shrink-0">
                    <button @click="modalOpen = false; document.body.classList.remove('modal-open');" type="button" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 font-bold text-xs uppercase tracking-widest rounded hover:bg-slate-100 transition-colors shadow-sm">
                        Tutup Arsip
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
