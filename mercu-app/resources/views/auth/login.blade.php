<x-guest-layout>
    {{-- Form Container (Tanpa background/border tambahan karena sudah di dalam container dari guest.blade.php) --}}
    <div class="w-full">
        
        {{-- Status Sesi / Alert --}}
        @if (session('status'))
            <div class="mb-8 bg-emerald-50 text-emerald-700 p-4 rounded text-[10px] font-bold uppercase tracking-widest border border-emerald-200 flex items-center gap-3 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                {{ session('status') }}
            </div>
        @endif

        {{-- Header Form untuk versi Mobile (Karena panel kiri dengan logo hilang di HP) --}}
        <div class="text-center mb-10 lg:hidden">
            <img src="{{ asset('pelindo.png') }}" alt="Logo Pelindo" class="h-8 w-auto mx-auto mb-4" />
            <h2 class="text-2xl font-black text-[#003459] tracking-tight">Portal MERCU</h2>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1.5">Sistem Internal Pelindo</p>
        </div>

        {{-- Header Form untuk Desktop (Minimalis, menyapa pengguna) --}}
        <div class="text-left mb-8 hidden lg:block">
            <h2 class="text-3xl font-black text-[#003459] tracking-tight">Otorisasi Akses</h2>
            <p class="text-xs font-bold text-slate-400 mt-1">Silakan masukkan kredensial Anda yang sah.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email Field --}}
            <div class="group">
                <label for="email" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Email Perusahaan <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#00AEEF] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="block w-full pl-12 pr-4 py-3.5 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none transition-all font-semibold text-slate-700" 
                        placeholder="karyawan@pelindo.co.id">
                </div>
                @error('email')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="group">
                <label for="password" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Kata Sandi <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#00AEEF] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required 
                        class="block w-full pl-12 pr-4 py-3.5 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none transition-all font-semibold text-slate-700" 
                        placeholder="••••••••">
                </div>
                @error('password')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-2">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-[#003459] focus:ring-[#003459] transition-colors cursor-pointer w-4 h-4">
                    <span class="ms-2 text-[11px] font-bold text-slate-500 group-hover:text-[#003459] uppercase tracking-widest transition-colors">Ingat Saya</span>
                </label>
                <a class="text-[10px] uppercase tracking-widest text-[#00AEEF] hover:text-[#003459] font-black transition-colors hover:underline underline-offset-4" href="#">
                    Lupa Sandi?
                </a>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-[#003459] hover:bg-slate-800 text-white font-black text-[10px] uppercase tracking-widest py-4 px-8 rounded shadow-md transition-all active:scale-95 flex items-center justify-center gap-3 group">
                    Masuk Ke Sistem
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
        
        {{-- Footer Form untuk versi Mobile --}}
        <div class="mt-8 text-center border-t border-slate-200 pt-6 lg:hidden">
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">&copy; {{ date('Y') }} SDM Pelindo Teluk Bayur</p>
        </div>
    </div>
</x-guest-layout>
