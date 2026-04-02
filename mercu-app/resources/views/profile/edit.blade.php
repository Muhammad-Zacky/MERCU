<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-[#003459] tracking-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola informasi profil MERCU Anda</p>
    </x-slot>

    <div class="py-12 space-y-8">
        
        {{-- BAGIAN 1: UPDATE FOTO PROFIL --}}
        <div class="p-8 bg-white shadow-sm border border-slate-100 rounded-[2.5rem] animate-fade-in-up">
            <div class="max-w-xl">
                <header class="mb-8">
                    <h2 class="text-lg font-black text-[#003459]">
                        {{ __('Foto Profil') }}
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        {{ __("Gunakan foto formal untuk identitas resmi Anda di sistem MERCU.") }}
                    </p>
                </header>

                {{-- Form Unggah Foto --}}
                <form method="post" action="{{ route('profile.update-photo') }}" enctype="multipart/form-data" class="flex flex-col md:flex-row items-center gap-8">
                    @csrf
                    
                    {{-- Preview Foto Saat Ini --}}
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-[2.5rem] overflow-hidden border-4 border-slate-50 shadow-2xl bg-slate-100 flex items-center justify-center">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <span class="text-4xl font-black text-[#00AEEF] uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Input File & Button --}}
                    <div class="flex-1 space-y-4 w-full">
                        <div class="relative">
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" required
                                class="block w-full text-xs text-slate-500 
                                file:mr-4 file:py-3 file:px-6 
                                file:rounded-2xl file:border-0 
                                file:text-[10px] file:font-black file:uppercase file:tracking-widest
                                file:bg-blue-50 file:text-[#00AEEF] 
                                hover:file:bg-blue-100 transition-all cursor-pointer">
                        </div>
                        
                        <button type="submit" class="inline-flex items-center px-8 py-3 bg-[#00AEEF] text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-400 hover:-translate-y-0.5 transition-all active:scale-95">
                            {{ __('Simpan Foto Baru') }}
                        </button>

                        @error('profile_photo')
                            <p class="text-red-500 text-[10px] font-bold uppercase mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>
        </div>

        {{-- BAGIAN 2: INFORMASI TEKS PROFIL --}}
        <div class="p-8 bg-white shadow-sm border border-slate-100 rounded-[2.5rem] animate-fade-in-up delay-100">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-black text-[#003459]">
                            {{ __('Informasi Identitas') }}
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ __("Data ini disinkronkan dengan database SDM Pelindo.") }}
                        </p>
                    </header>

                    <div class="mt-8 space-y-6">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                            <div class="px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-bold text-slate-700 flex items-center gap-3">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        {{-- Email/NIPP --}}
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Korporat / Akun</label>
                            <div class="px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-bold text-slate-700 flex items-center gap-3">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                                {{ Auth::user()->email }}
                            </div>
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Otoritas Sistem</label>
                            <div class="flex">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-[#00AEEF] rounded-xl text-[10px] font-black uppercase border border-blue-100 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00AEEF] animate-pulse"></span>
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        {{-- BAGIAN 3: AREA BAHAYA (LOGOUT) --}}
        <div class="p-8 bg-red-50 border border-red-100 rounded-[2.5rem] flex flex-col md:flex-row items-center justify-between gap-6 animate-fade-in-up delay-200">
            <div>
                <h3 class="text-red-800 font-black text-lg">Keluar dari Sesi</h3>
                <p class="text-red-600/70 text-xs font-medium mt-1">Selesaikan semua tiket laporan Anda sebelum meninggalkan portal MERCU.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="w-full md:w-auto">
                @csrf
                <button type="submit" class="w-full md:w-auto px-10 py-4 bg-white border border-red-200 text-red-600 font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl hover:bg-red-600 hover:text-white transition-all shadow-sm active:scale-95">
                    Keluar Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
