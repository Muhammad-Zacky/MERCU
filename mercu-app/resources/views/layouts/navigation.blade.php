<div x-data="{ sidebarOpen: false }">
    {{-- Header Mobile (Hanya Tampil di Layar Kecil) --}}
    <div class="md:hidden fixed top-0 left-0 w-full h-16 bg-[#003459] z-40 flex items-center justify-between px-5 shadow-md">
        <div class="flex items-center gap-3">
            <img src="{{ asset('pelindo.png') }}" alt="Logo Pelindo" class="h-7 w-auto brightness-0 invert">
            <div class="h-4 w-[1px] bg-white/20"></div>
            <span class="font-black text-white text-lg tracking-tight">MERCU</span>
        </div>
        <button @click="sidebarOpen = true" class="text-white p-1.5 focus:outline-none hover:bg-white/10 rounded transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    {{-- Overlay Backdrop untuk Mobile --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="md:hidden fixed inset-0 bg-slate-900/60 z-40 backdrop-blur-sm" x-cloak x-transition.opacity></div>

    {{-- SIDEBAR UTAMA (Dark Corporate V2 - Gradasi Halus) --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 w-64 h-full bg-gradient-to-b from-[#002A4A] to-[#003459] border-r border-[#002240] z-50 flex flex-col transition-transform duration-300 md:translate-x-0 shadow-2xl md:shadow-none">
        
        {{-- Area Logo Sidebar --}}
        <div class="h-20 border-b border-white/5 flex items-center px-6 shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('pelindo.png') }}" class="h-8 w-auto brightness-0 invert opacity-80 group-hover:opacity-100 transition-opacity duration-300" alt="Logo">
                <div class="border-l border-white/20 pl-3">
                    <span class="text-xl font-black text-white block leading-none tracking-tight">MERCU</span>
                    <span class="text-[0.6rem] font-bold text-[#00AEEF] uppercase tracking-widest mt-0.5 block">Sistem Internal</span>
                </div>
            </a>
        </div>

        {{-- Area Navigasi Dinamis Berdasarkan Role --}}
        <nav class="flex-1 overflow-y-auto py-8 px-4 space-y-8 custom-scrollbar">
            
            {{-- MENU KHUSUS MANAJER / ADMIN --}}
            @if(Auth::user()->role === 'admin')
            <div>
                <p class="px-4 text-[10px] font-black text-blue-200/40 uppercase tracking-widest mb-3">Panel Manajerial</p>
                <div class="space-y-1">
                    {{-- Menu Dasbor Utama --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Tinjauan Eksekutif
                    </a>
                    
                    {{-- Menu Tiket Laporan --}}
                    <a href="{{ route('admin.tickets') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('admin.tickets') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.tickets') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Manajemen Tiket
                    </a>

                    {{-- Menu Analitik & Grafik --}}
                    <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('admin.reports') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.reports') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        Statistik & Laporan
                    </a>

                    {{-- Menu Personalia Lapangan --}}
                    <a href="{{ route('admin.staff') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('admin.staff') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('admin.staff') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Direktori Staf
                    </a>
                </div>
            </div>
            @endif

            {{-- MENU KHUSUS TEKNISI / STAF OPERASIONAL --}}
            @if(Auth::user()->role === 'technician')
            <div>
                <p class="px-4 text-[10px] font-black text-blue-200/40 uppercase tracking-widest mb-3">Tugas Operasional</p>
                <div class="space-y-1">
                    {{-- Menu Bursa Tugas --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Bursa Laporan
                    </a>

                    {{-- Menu Sedang Dikerjakan --}}
                    <a href="{{ route('tasks.active') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('tasks.active') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('tasks.active') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Sedang Dikerjakan
                    </a>

                    {{-- Menu Riwayat Selesai --}}
                    <a href="{{ route('tasks.history') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('tasks.history') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('tasks.history') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Kinerja
                    </a>
                </div>
            </div>
            @endif

            {{-- MENU GLOBAL (Semua Role) --}}
            <div>
                <p class="px-4 text-[10px] font-black text-blue-200/40 uppercase tracking-widest mb-3">Preferensi Sistem</p>
                <div class="space-y-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 rounded text-sm transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-white/10 text-white font-bold border-l-2 border-[#00AEEF]' : 'text-blue-100/60 font-medium hover:bg-white/5 hover:text-white border-l-2 border-transparent' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('profile.edit') ? 'text-[#00AEEF]' : 'opacity-70' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Pengaturan Profil
                    </a>
                </div>
            </div>
        </nav>

        {{-- Area Profil Bawah & Logout --}}
        <div class="p-5 border-t border-white/5 bg-[#002A4A]/50">
            <div class="flex items-center gap-3 mb-5 px-1">
                {{-- Cek Foto Profil --}}
                <div class="w-10 h-10 rounded border border-white/10 bg-[#003459] flex items-center justify-center font-black text-white overflow-hidden shrink-0 shadow-inner">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                    @endif
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] text-[#00AEEF] font-black uppercase tracking-widest mt-0.5">
                        {{ Auth::user()->role === 'admin' ? 'Manajer Operasional' : 'Staf Lapangan' }}
                    </p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded text-xs font-bold text-blue-200 bg-white/5 border border-white/10 hover:bg-red-500/20 hover:text-red-400 hover:border-red-500/30 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-[#002A4A]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sesi
                </button>
            </form>
        </div>
    </aside>
</div>

{{-- Tambahan CSS khusus Sidebar Scrollbar Mode Gelap --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
</style>
