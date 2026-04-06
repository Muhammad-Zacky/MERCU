<x-app-layout>
    {{-- CSS Animasi Transisi Halus --}}
    <style>
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 animate-fade-in-up">
            <div class="border-l-4 border-[#003459] pl-4">
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight leading-none mb-1.5">
                    Pengaturan Profil
                </h2>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Sistem Informasi Personalia MERCU</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-6 max-w-4xl mx-auto">

        {{-- Pesan Sukses (Jika ada) --}}
        @if(session('status') === 'profile-updated' || session('success'))
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-bold border border-emerald-200 shadow-sm flex items-center gap-3 animate-fade-in-up">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Pembaruan profil berhasil disimpan ke dalam sistem.
            </div>
        @endif

        {{-- BAGIAN 1: KARTU IDENTITAS & UPLOAD FOTO (Modern UI dengan Alpine.js Preview) --}}
        <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden animate-fade-in-up" 
             x-data="{ 
                photoName: null, 
                photoPreview: null,
                updatePreview(event) {
                    const file = event.target.files[0];
                    if(file) {
                        this.photoName = file.name;
                        this.photoPreview = URL.createObjectURL(file);
                    }
                }
             }">
            
            {{-- Banner Header Korporat --}}
            <div class="h-32 bg-gradient-to-r from-[#002A4A] to-[#003459] relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                <div class="absolute bottom-4 right-6 opacity-20 hidden sm:block">
                    <img src="{{ asset('pelindo.png') }}" class="h-12 w-auto brightness-0 invert" alt="Pelindo">
                </div>
            </div>

            <div class="px-6 sm:px-10 pb-8 relative">
                
                <form method="post" action="{{ route('profile.update-photo') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6 sm:gap-8 -mt-16 sm:-mt-12 mb-8">
                        {{-- Foto Profil / Avatar (Dengan Live Preview) --}}
                        <div class="relative shrink-0">
                            <div class="w-32 h-40 rounded-xl overflow-hidden border-4 border-white bg-slate-100 shadow-lg flex items-center justify-center relative group">
                                
                                {{-- Menampilkan Preview Alpine.js jika ada --}}
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                </template>

                                {{-- Menampilkan Foto Lama jika tidak ada Preview --}}
                                <template x-if="!photoPreview">
                                    <div>
                                        @if(Auth::user()->profile_photo)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-5xl font-black text-slate-300 uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                </template>

                                {{-- Overlay saat Hover --}}
                                <label for="profile_photo" class="absolute inset-0 bg-[#003459]/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-white">
                                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-[9px] font-bold uppercase tracking-widest">Ubah Foto</span>
                                </label>
                            </div>
                            
                            {{-- Input File Tersembunyi --}}
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden" @change="updatePreview">
                        </div>

                        {{-- Info Singkat Samping Foto --}}
                        <div class="flex-1 text-center sm:text-left pt-14 sm:pt-0">
                            <h3 class="text-2xl font-black text-slate-800 tracking-tight">{{ Auth::user()->name }}</h3>
                            <div class="flex items-center justify-center sm:justify-start gap-2 mt-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                                    {{ Auth::user()->role === 'admin' ? 'Manajer Operasional' : 'Staf Lapangan' }}
                                </p>
                            </div>
                        </div>

                        {{-- Tombol Simpan Foto --}}
                        <div class="shrink-0 w-full sm:w-auto">
                            <button type="submit" x-show="photoPreview" x-transition.opacity class="w-full sm:w-auto px-6 py-3 bg-[#003459] text-white font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-slate-800 transition-colors shadow-sm flex items-center justify-center gap-2" style="display: none;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Foto
                            </button>
                        </div>
                    </div>
                    
                    @error('profile_photo')
                        <p class="text-red-600 text-xs font-bold text-center sm:text-left mt-2">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>

        {{-- BAGIAN 2: INFORMASI TEKS PROFIL (Read-Only) --}}
        <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 md:p-8 animate-fade-in-up delay-100">
            <header class="mb-8 border-b border-slate-100 pb-4 flex items-center gap-3">
                <div class="p-2 bg-slate-50 rounded-lg">
                    <svg class="w-5 h-5 text-[#003459]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-black text-slate-800">Data Administratif</h2>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Disinkronisasi otomatis dari basis data SDM Pelindo.</p>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Field Nama --}}
                <div>
                    <label class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Nama Lengkap Sesuai ID
                        <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </label>
                    <div class="px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 select-none opacity-90 cursor-not-allowed">
                        {{ Auth::user()->name }}
                    </div>
                </div>

                {{-- Field Email --}}
                <div>
                    <label class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Email Korporat Aktif
                        <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </label>
                    <div class="px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 select-none opacity-90 cursor-not-allowed">
                        {{ Auth::user()->email }}
                    </div>
                </div>

                {{-- Field NIPP (Jika ada di DB) --}}
                <div>
                    <label class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Nomor Induk Pegawai (NIPP)
                        <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </label>
                    <div class="px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 font-mono select-none opacity-90 cursor-not-allowed">
                        {{ Auth::user()->nipp ?? 'Belum Terdaftar' }}
                    </div>
                </div>

                {{-- Field Unit --}}
                <div>
                    <label class="flex items-center gap-1.5 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Unit Spesialisasi
                        <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </label>
                    <div class="px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 select-none opacity-90 cursor-not-allowed">
                        {{ Auth::user()->unit->name ?? 'Operasional Umum' }}
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex items-start gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                <svg class="w-5 h-5 text-[#00AEEF] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-xs text-slate-600 font-medium leading-relaxed">
                    Perubahan data administratif (Nama, NIPP, Email) hanya dapat dilakukan oleh Administrator Sistem. Silakan hubungi bagian IT SDM jika terdapat ketidaksesuaian data.
                </p>
            </div>
        </div>

        {{-- BAGIAN 3: AREA KELUAR (Danger Zone) --}}
        <div class="bg-white border border-red-100 shadow-sm rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 animate-fade-in-up delay-200">
            <div class="flex items-start gap-4">
                <div class="p-2 bg-red-50 rounded-lg shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </div>
                <div>
                    <h3 class="text-slate-800 font-black text-lg">Akhiri Sesi Kerja</h3>
                    <p class="text-slate-500 text-xs font-medium mt-1">Pastikan seluruh penanganan laporan Anda telah tersimpan ke dalam database sebelum keluar dari portal MERCU.</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="w-full md:w-auto shrink-0">
                @csrf
                <button type="submit" class="w-full md:w-auto px-8 py-3 bg-white border border-red-200 text-red-600 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-red-50 hover:border-red-300 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-red-100">
                    Keluar Sistem
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
