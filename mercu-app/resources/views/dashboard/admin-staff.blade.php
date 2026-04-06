<x-app-layout>
    {{-- CSS Transisi & Scrollbar Halus --}}
    <style>
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        .table-scroll::-webkit-scrollbar { height: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in-up">
            <div class="border-l-4 border-emerald-500 pl-4">
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight leading-none mb-1.5">Direktori Staf</h2>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Manajemen Pengguna & Personel Lapangan</p>
            </div>
            <button class="px-4 py-2.5 bg-emerald-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-emerald-700 transition-colors shadow-sm flex items-center gap-2 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Personel
            </button>
        </div>
    </x-slot>

    <div class="py-8 space-y-6 max-w-7xl mx-auto">
        
        {{-- INJEKSI DATA LANGSUNG DARI DATABASE --}}
        @php
            $users = \App\Models\User::orderBy('created_at', 'desc')->get();
            $totalUsers = $users->count();
            $totalAdmin = $users->where('role', 'admin_sdm')->count();
            $totalTeknisi = $users->where('role', 'teknisi')->count();
            $totalPegawai = $users->where('role', 'pegawai')->count();
        @endphp

        {{-- BAGIAN 1: STATISTIK PERSONEL --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-in-up delay-100">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center text-slate-500 border border-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800">{{ $totalUsers }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Akun</p>
                </div>
            </div>
            
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-[#003459]/10 rounded-lg flex items-center justify-center text-[#003459] border border-[#003459]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800">{{ $totalAdmin }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Manajemen (Admin)</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600 border border-emerald-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800">{{ $totalTeknisi }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tim Lapangan</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600 border border-amber-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800">{{ $totalPegawai }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Staf Umum</p>
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: TABEL DIREKTORI --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-up delay-200">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Daftar Pengguna Terdaftar</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Kelola akses, otorisasi, dan validasi data akun personalia.</p>
                </div>
                <div class="relative w-full sm:w-64 shrink-0">
                    <input type="text" placeholder="Cari nama atau email..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:bg-white focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none transition-colors">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <div class="overflow-x-auto table-scroll">
                <table class="w-full text-left border-collapse min-w-[900px]">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Profil Pegawai</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Kontak Akses</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Otoritas (Role)</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest text-center">Status Verifikasi</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            
                            {{-- Kolom Profil --}}
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full border border-slate-200 bg-white overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-400">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($user->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800">{{ $user->name }}</p>
                                        <p class="text-[10px] text-slate-500 font-mono">ID: {{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Email --}}
                            <td class="px-6 py-3">
                                <p class="font-semibold text-slate-700">{{ $user->email }}</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">Dibuat: {{ $user->created_at->format('d M Y') }}</p>
                            </td>

                            {{-- Kolom Role --}}
                            <td class="px-6 py-3">
                                @if($user->role === 'admin_sdm')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded text-[10px] font-black uppercase tracking-widest">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        Manajer (Admin)
                                    </span>
                                @elseif($user->role === 'teknisi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded text-[10px] font-black uppercase tracking-widest">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                        Teknisi
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded text-[10px] font-black uppercase tracking-widest">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Pegawai Umum
                                    </span>
                                @endif
                            </td>

                            {{-- Kolom Status Verifikasi --}}
                            <td class="px-6 py-3 text-center">
                                @if($user->is_verified)
                                    <div class="inline-flex flex-col items-center">
                                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full shadow-sm"></span>
                                        <span class="text-[9px] text-emerald-600 font-bold mt-1">Tervalidasi</span>
                                    </div>
                                @else
                                    <div class="inline-flex flex-col items-center">
                                        <span class="w-2.5 h-2.5 bg-amber-400 rounded-full shadow-sm animate-pulse"></span>
                                        <span class="text-[9px] text-amber-600 font-bold mt-1">Menunggu</span>
                                    </div>
                                @endif
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-1.5 bg-white border border-slate-200 text-slate-500 hover:text-[#00AEEF] hover:border-[#00AEEF] rounded shadow-sm transition-colors" title="Edit Pengguna">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="p-1.5 bg-white border border-slate-200 text-slate-500 hover:text-red-500 hover:border-red-500 rounded shadow-sm transition-colors" title="Hapus/Nonaktifkan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">
                                Tidak ada data staf yang ditemukan di dalam sistem.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Tampilan Bawah --}}
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500 font-medium">
                <span>Total keseluruhan: {{ $totalUsers }} personel.</span>
            </div>
        </div>

    </div>
</x-app-layout>
