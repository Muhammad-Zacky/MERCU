<x-app-layout>
    {{-- CSS Khusus Transisi, Scrollbar, dan Modal --}}
    <style>
        .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 100ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        .table-scroll::-webkit-scrollbar { height: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        body.modal-open { overflow: hidden; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in-up">
            <div class="border-l-4 border-[#003459] pl-4">
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight leading-none mb-1.5">
                    Manajemen Tiket
                </h2>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Pusat Kendali Laporan Fasilitas</p>
            </div>
            
            <div class="flex gap-2 shrink-0">
                <button class="px-4 py-2.5 bg-white border border-slate-300 text-slate-700 text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Saring Data
                </button>
            </div>
        </div>
    </x-slot>

    {{-- Wrapper Alpine.js untuk Modal Detail Tiket --}}
    <div x-data="{ modalOpen: false, selectedTicket: null }" class="py-8 space-y-6 max-w-7xl mx-auto relative">
        
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-bold border border-emerald-200 shadow-sm flex items-center gap-3 animate-fade-in-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- AREA TABEL DATA TIKET --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-up delay-100">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Daftar Seluruh Laporan</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Tinjau, pantau, dan kelola semua tiket yang masuk ke sistem.</p>
                </div>
                
                <div class="relative w-full sm:w-72 shrink-0">
                    <input type="text" placeholder="Cari ID Tiket, Nama, atau NIPP..." class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none transition-colors shadow-sm">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <div class="overflow-x-auto table-scroll">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                        <tr class="bg-white border-b border-slate-200">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest w-32">Tiket & Tgl</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Identitas Pelapor</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Kategori & Deskripsi</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest text-center">Teknisi Bertugas</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        @forelse($tickets as $ticket)
                        <tr class="hover:bg-slate-50 transition-colors group {{ $ticket->status === 'completed' ? 'bg-slate-50/50' : '' }}">
                            
                            {{-- ID & Tanggal --}}
                            <td class="px-6 py-4">
                                <div class="font-mono text-xs font-bold text-[#003459] bg-blue-50 border border-blue-100 px-2 py-1 rounded inline-block mb-1">
                                    {{ $ticket->ticket_number }}
                                </div>
                                <div class="text-[10px] text-slate-500 font-semibold flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $ticket->created_at->format('d M Y') }}
                                </div>
                            </td>

                            {{-- Pelapor --}}
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ $ticket->reporter_name }}</p>
                                <p class="text-[10px] text-slate-500 font-mono mt-0.5 tracking-wider">NIPP: {{ $ticket->reporter_nipp }}</p>
                            </td>

                            {{-- Kategori & Deskripsi --}}
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 mb-0.5">{{ $ticket->unit->name ?? 'Fasilitas Umum' }}</p>
                                <p class="text-xs text-slate-500 truncate max-w-[250px]" title="{{ $ticket->description }}">
                                    {{ $ticket->description }}
                                </p>
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-6 py-4 text-center">
                                @if($ticket->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded text-[10px] font-black uppercase tracking-widest shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                @elseif($ticket->status === 'in_progress')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded text-[10px] font-black uppercase tracking-widest shadow-sm">
                                        <svg class="w-3 h-3 text-blue-500 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Proses
                                    </span>
                                @elseif($ticket->status === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded text-[10px] font-black uppercase tracking-widest shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            {{-- Teknisi --}}
                            <td class="px-6 py-4 text-center">
                                @if($ticket->technician)
                                    <div class="inline-flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-[8px] font-black text-slate-500 shrink-0">
                                            {{ substr($ticket->technician->name, 0, 2) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-700 whitespace-nowrap">{{ explode(' ', $ticket->technician->name)[0] }}</span>
                                    </div>
                                @else
                                    <span class="text-xs font-medium text-slate-400 italic">Belum diambil</span>
                                @endif
                            </td>

                            {{-- Aksi (Detail & Hapus) --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity">
                                    {{-- Tombol Detail memicu Alpine.js --}}
                                    <button type="button" 
                                        @click="
                                            selectedTicket = {
                                                id: '{{ $ticket->id }}',
                                                number: '{{ $ticket->ticket_number }}',
                                                reporter: '{{ addslashes($ticket->reporter_name) }}',
                                                nipp: '{{ addslashes($ticket->reporter_nipp) }}',
                                                unit: '{{ $ticket->unit->name ?? 'Umum' }}',
                                                location: '{{ addslashes($ticket->location) }}',
                                                coordinates: '{{ $ticket->coordinates ?? '-' }}',
                                                description: '{{ addslashes(preg_replace('/\r|\n/', ' ', $ticket->description)) }}',
                                                status: '{{ $ticket->status }}',
                                                tech: '{{ $ticket->technician->name ?? 'Belum ada' }}',
                                                created: '{{ $ticket->created_at->format('d M Y, H:i') }}',
                                                photo: '{{ $ticket->evidence_photo ? asset('storage/' . $ticket->evidence_photo) : null }}'
                                            };
                                            modalOpen = true;
                                            document.body.classList.add('modal-open');
                                        "
                                        class="p-1.5 bg-white border border-slate-200 text-slate-500 hover:text-[#00AEEF] hover:border-[#00AEEF] rounded shadow-sm transition-colors" title="Lihat Detail Rinci">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    
                                    {{-- Tombol Hapus --}}
                                    <button class="p-1.5 bg-white border border-slate-200 text-slate-500 hover:text-red-500 hover:border-red-500 rounded shadow-sm transition-colors" title="Hapus Permanen">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 font-medium">
                                <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-100">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </div>
                                Tidak ada data tiket laporan di dalam sistem.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500 font-medium">
                <span>Menampilkan total {{ $tickets->count() }} laporan tiket.</span>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- MODAL POP-UP DETAIL TIKET UNTUK ADMIN      --}}
        {{-- ========================================== --}}
        <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 overflow-y-auto" style="display: none;" x-cloak>
            <div x-show="modalOpen" @click="modalOpen = false; document.body.classList.remove('modal-open');" x-transition.opacity class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
            
            <div x-show="modalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-8 sm:scale-95"
                 class="relative bg-white w-full max-w-3xl rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh] border border-slate-200">
                
                {{-- Header Modal --}}
                <div class="bg-[#003459] px-6 py-4 flex justify-between items-center shrink-0">
                    <div>
                        <h3 class="text-lg font-black text-white flex items-center gap-2">
                            Rincian Data Tiket
                        </h3>
                        <p class="text-[10px] text-cyan-300 font-mono font-bold mt-0.5 tracking-wider" x-text="selectedTicket?.number"></p>
                    </div>
                    <button @click="modalOpen = false; document.body.classList.remove('modal-open');" type="button" class="text-white/60 hover:text-white hover:bg-white/10 p-1.5 rounded transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Body Modal --}}
                <div class="overflow-y-auto p-6 md:p-8 flex-1 bg-slate-50">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <div class="lg:col-span-2 space-y-5">
                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Terkini</p>
                                    <div class="text-sm font-bold" 
                                         :class="{
                                            'text-amber-600': selectedTicket?.status === 'pending',
                                            'text-[#00AEEF]': selectedTicket?.status === 'in_progress',
                                            'text-emerald-600': selectedTicket?.status === 'completed'
                                         }"
                                         x-text="selectedTicket?.status === 'pending' ? 'MENUNGGU TINDAKAN' : (selectedTicket?.status === 'in_progress' ? 'SEDANG DIPROSES' : 'TELAH DISELESAIKAN')">
                                    </div>
                                </div>
                                <div class="w-px h-8 bg-slate-200 hidden sm:block"></div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Masuk</p>
                                    <p class="text-sm font-bold text-slate-700" x-text="selectedTicket?.created"></p>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 border-b border-slate-100 pb-2">Identitas Pelapor & Lokasi</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-slate-500 mb-0.5">Nama & NIPP</p>
                                        <p class="font-bold text-slate-800 text-sm" x-text="selectedTicket?.reporter"></p>
                                        <p class="font-mono text-xs text-slate-500" x-text="selectedTicket?.nipp"></p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 mb-0.5">Kategori Unit</p>
                                        <p class="font-bold text-slate-800 text-sm" x-text="selectedTicket?.unit"></p>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <p class="text-xs text-slate-500 mb-0.5">Lokasi Kendala</p>
                                        <p class="font-medium text-slate-700 text-sm bg-slate-50 p-2 rounded border border-slate-100" x-text="selectedTicket?.location"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Uraian Kerusakan</p>
                                <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap" x-text="selectedTicket?.description"></div>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div class="bg-[#00AEEF]/10 p-4 rounded-xl border border-[#00AEEF]/20 shadow-sm">
                                <p class="text-[10px] font-black text-[#003459] uppercase tracking-widest mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Penugasan Teknisi
                                </p>
                                <p class="text-sm font-bold text-[#003459] bg-white px-3 py-2 rounded shadow-sm border border-[#00AEEF]/30" x-text="selectedTicket?.tech"></p>
                            </div>

                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col h-full">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Dokumentasi Bukti</p>
                                <div class="flex-1 flex flex-col min-h-[150px]">
                                    <template x-if="selectedTicket?.photo">
                                        <a :href="selectedTicket.photo" target="_blank" title="Klik untuk perbesar" class="block w-full h-full border border-slate-200 rounded-lg overflow-hidden bg-slate-100 relative group cursor-zoom-in">
                                            <img :src="selectedTicket.photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        </a>
                                    </template>
                                    <template x-if="!selectedTicket?.photo">
                                        <div class="w-full h-full flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-lg bg-slate-50 p-4 text-center">
                                            <svg class="w-8 h-8 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tidak Ada Foto</p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="bg-white border-t border-slate-200 px-6 py-4 flex justify-end shrink-0">
                    <button @click="modalOpen = false; document.body.classList.remove('modal-open');" type="button" class="px-6 py-2.5 bg-slate-100 border border-slate-200 text-slate-700 font-bold text-xs uppercase tracking-widest rounded shadow-sm hover:bg-slate-200 transition-colors">
                        Tutup Rincian
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
