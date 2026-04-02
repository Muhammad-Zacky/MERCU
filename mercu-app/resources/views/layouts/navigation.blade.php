<div x-data="{ sidebarOpen: false }">
    <div class="md:hidden fixed top-0 left-0 w-full h-16 bg-white border-b border-slate-200 z-40 flex items-center justify-between px-4 shadow-sm">
        <div class="flex items-center gap-2">
            <img src="{{ asset('pelindo.png') }}" alt="Logo" class="h-8 w-auto">
            <span class="font-bold text-slate-900 text-lg border-l-2 border-slate-200 pl-3">DOCK</span>
        </div>
        <button @click="sidebarOpen = true" class="text-slate-600 p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
    </div>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="md:hidden fixed inset-0 bg-slate-900/60 z-40 backdrop-blur-sm" x-cloak x-transition.opacity></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 w-64 h-full bg-white border-r border-slate-200 z-50 flex flex-col transition-transform duration-300 md:translate-x-0 shadow-sm">
        <div class="h-20 border-b border-slate-100 flex items-center justify-between px-6 shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('pelindo.png') }}" class="h-10 w-auto">
                <div>
                    <span class="text-lg font-extrabold text-slate-900 block leading-none">DOCK</span>
                    <span class="text-[0.55rem] font-bold text-[#00AEEF] uppercase">Operasional</span>
                </div>
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
            <p class="px-3 text-[0.65rem] font-bold text-slate-400 uppercase mb-3">Menu Utama</p>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-[#00AEEF] text-white shadow-md' : 'text-slate-600 hover:bg-[#E5F7FF] hover:text-[#0054A6]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dasbor Area
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('profile.edit') ? 'bg-[#00AEEF] text-white' : 'text-slate-600 hover:bg-[#E5F7FF]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Pengaturan
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100 bg-slate-50/80">
            <div class="flex items-center gap-3 px-2 mb-4">
                <div class="w-10 h-10 rounded-full border bg-white flex items-center justify-center font-bold text-[#00AEEF]">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                    <span class="text-[#00AEEF] text-[0.6rem] font-bold uppercase">{{ Auth::user()->role ?? 'Internal' }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-2.5 rounded-lg text-sm font-bold text-red-600 bg-white border border-red-100 hover:bg-red-50 transition-all shadow-sm">
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>
</div>
