<x-guest-layout>
    {{-- Status Sesi / Alert --}}
    @if (session('status'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-medium border border-emerald-200 flex items-center gap-2 shadow-sm">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <div class="flex justify-center mb-6">
        <img src="{{ asset('pelindo.png') }}" alt="Logo Pelindo" class="h-14 md:h-16 w-auto object-contain drop-shadow-sm hover:scale-105 transition-transform duration-300" />
    </div>

    <div class="text-center mb-8">
        <h2 class="text-2xl md:text-3xl font-extrabold text-[#0A192F] tracking-tight">Portal DOCK Pelindo</h2>
        <p class="text-sm text-slate-500 mt-2 font-medium px-4">Silakan masuk menggunakan kredensial Anda untuk melanjutkan.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email Field --}}
        <div class="group">
            <label for="email" class="block text-[#0A192F] font-semibold mb-1.5 ml-1 text-sm">Email Perusahaan</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="block w-full pl-12 pr-4 py-3 border-slate-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-slate-50/50 hover:bg-slate-50 focus:bg-white text-sm" 
                    placeholder="email@pelindo.co.id">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Field --}}
        <div class="group">
            <label for="password" class="block text-[#0A192F] font-semibold mb-1.5 ml-1 text-sm">Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required 
                    class="block w-full pl-12 pr-4 py-3 border-slate-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-slate-50/50 hover:bg-slate-50 focus:bg-white text-sm" 
                    placeholder="••••••••">
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-[#0A192F] shadow-sm focus:ring-[#0A192F] transition-colors cursor-pointer w-4 h-4">
                <span class="ms-2 text-sm text-slate-500 group-hover:text-[#0A192F] font-medium transition-colors">Ingat Saya</span>
            </label>
            <a class="text-sm text-blue-600 hover:text-[#0A192F] font-semibold transition-colors hover:underline underline-offset-4" href="#">
                Lupa Kata Sandi?
            </a>
        </div>

        <div class="pt-4 mt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-[#0A192F] to-[#1a365d] hover:from-[#1a365d] hover:to-[#0A192F] text-white font-bold py-3.5 px-8 rounded-xl shadow-lg hover:shadow-xl hover:shadow-[#0A192F]/20 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                Masuk Sistem
                <svg class="w-5 h-5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</x-guest-layout>
