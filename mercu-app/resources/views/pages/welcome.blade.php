<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERCU - Digital Operational Care & Knowledge</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Animasi Splash Screen */
        @keyframes pulse-logo {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .animate-pulse-logo { animation: pulse-logo 2s ease-in-out infinite; }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes move-forever {
            0% { transform: translate3d(-90px, 0, 0); }
            100% { transform: translate3d(85px, 0, 0); }
        }
        @keyframes float-wa {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        .animate-float-wa { animation: float-wa 3s ease-in-out infinite; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
        textarea::-webkit-scrollbar { width: 4px; }
        textarea::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

        .waves { position: absolute; bottom: 0; left: 0; width: 100%; height: 15vh; min-height: 80px; max-height: 120px; z-index: 0; }
        .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
        .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; }
        .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; }
        .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; }
        .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; }
        
        /* Menahan scroll saat splash aktif */
        body.splash-active { overflow: hidden; height: 100vh; }
    </style>
</head>

{{-- 
  x-init digunakan untuk menahan splash screen selama 2.2 detik,
  lalu mengubah isLoading menjadi false agar transisi fade-out berjalan.
--}}
<body class="bg-slate-50 text-slate-800 antialiased font-['Inter'] selection:bg-[#003459] selection:text-white splash-active" 
    x-data="{ 
        isLoading: true,
        mobileSidebarOpen: false, 
        modalLapor: false,
        loadingGps: false,
        photoPreview: null,
        form: {
            nipp: '',
            nama: '',
            unit_id: '',
            lokasi: '',
            koordinat: '',
            deskripsi: ''
        },
        getLocation() {
            this.loadingGps = true;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((p) => {
                    this.form.koordinat = p.coords.latitude + ',' + p.coords.longitude;
                    this.loadingGps = false;
                }, () => {
                    alert('Gagal mengambil lokasi. Pastikan GPS aktif.');
                    this.loadingGps = false;
                });
            } else {
                alert('Browser Anda tidak mendukung fitur lokasi.');
                this.loadingGps = false;
            }
        },
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.photoPreview = URL.createObjectURL(file);
            } else {
                this.photoPreview = null;
            }
        }
    }"
    x-init="setTimeout(() => { isLoading = false; document.body.classList.remove('splash-active'); }, 2200)">

    {{-- ========================================== --}}
    {{-- SPLASH SCREEN (MERCU)                      --}}
    {{-- ========================================== --}}
    <div x-show="isLoading" 
         x-transition:leave="transition ease-in-out duration-700" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 z-[9999] bg-[#003459] flex flex-col items-center justify-center">
        
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>

        <div class="relative z-10 flex flex-col items-center text-center">
            {{-- Logo Pelindo --}}
            <img src="{{ asset('pelindo.png') }}" alt="Logo Pelindo" class="h-16 md:h-20 w-auto brightness-0 invert mb-8 animate-pulse-logo">
            
            {{-- Nama & Kepanjangan MERCU --}}
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter mb-2">MERCU</h1>
            <p class="text-xs md:text-sm font-bold text-cyan-400 uppercase tracking-[0.3em] mb-12">
                Manajemen E-Report & Care Unit
            </p>

            {{-- Loading Spinner --}}
            <div class="flex flex-col items-center gap-3">
                <svg class="w-8 h-8 animate-spin text-white/50" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest animate-pulse">Menyiapkan Sistem...</p>
            </div>
        </div>
        
        <div class="absolute bottom-10 text-center">
            <p class="text-[9px] text-white/30 font-bold uppercase tracking-widest">Divisi SDM & Umum Teluk Bayur</p>
        </div>
    </div>


    {{-- Alert Sukses Laporan --}}
    @if(session('success'))
    <div class="fixed top-6 right-6 z-[200] max-w-sm animate-fade-in-up delay-300">
        <div class="bg-white border-l-4 border-emerald-600 p-4 shadow-xl flex items-start gap-3 rounded">
            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <p class="font-bold text-slate-900 text-sm">Berhasil!</p>
                <p class="text-xs text-slate-500 mt-1">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.style.display='none'" class="text-slate-400 hover:text-slate-600 ml-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
    @endif

    {{-- Konten Asli Beranda (Akan terlihat setelah splash hilang) --}}
    <div class="md:hidden fixed top-0 left-0 w-full h-16 bg-white border-b border-slate-200 z-40 flex items-center justify-between px-4 shadow-sm">
        <div class="flex items-center gap-2">
            <img src="{{ asset('pelindo.png') }}" alt="Logo Pelindo" class="h-7 w-auto">
            <div class="h-4 w-[1px] bg-slate-300 mx-1"></div>
            <span class="font-black text-[#003459] text-lg tracking-tight">MERCU</span>
        </div>
        <button @click="mobileSidebarOpen = true" class="text-slate-600 p-2 hover:bg-slate-100 rounded focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <div x-show="mobileSidebarOpen" @click="mobileSidebarOpen = false" class="md:hidden fixed inset-0 bg-slate-900/60 z-40 backdrop-blur-sm" x-cloak x-transition.opacity></div>

    <aside :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 w-64 h-full bg-white border-r border-slate-200 z-50 flex flex-col transition-transform duration-300 md:translate-x-0 shadow-2xl md:shadow-none">
        <div class="p-6 border-b border-slate-200 bg-[#003459] flex flex-col justify-center h-24">
            <div class="flex items-center gap-3">
                <img src="{{ asset('pelindo.png') }}" alt="Logo" class="h-8 w-auto brightness-0 invert">
                <div class="border-l border-white/20 pl-3">
                    <h1 class="text-xl font-black text-white leading-none tracking-tight">MERCU</h1>
                    <p class="text-[0.6rem] font-bold text-cyan-400 uppercase tracking-widest mt-1">Divisi SDM, Umum & KBL</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <p class="px-3 text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest mb-3">Direktori Menu</p>
            <a href="#hero" @click="mobileSidebarOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-[#003459] transition-colors">
                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda Utama
            </a>
            <a href="#kategori" @click="mobileSidebarOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-[#003459] transition-colors">
                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Fasilitas Layanan
            </a>
            <a href="#leaderboard" @click="mobileSidebarOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-[#003459] transition-colors">
                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Tinjauan Kinerja
            </a>
        </nav>

        <div class="p-5 border-t border-slate-100 bg-slate-50">
            @auth
                <a href="{{ route('dashboard') }}" class="w-full flex items-center justify-center gap-2 bg-[#003459] text-white py-2.5 rounded text-xs font-bold uppercase tracking-widest hover:bg-slate-800 transition-colors shadow-sm">
                    Akses Dasbor
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="w-full bg-white border border-slate-300 text-slate-700 flex items-center justify-center py-2.5 rounded text-xs font-bold uppercase tracking-widest hover:bg-slate-50 hover:border-[#003459] hover:text-[#003459] transition-colors">
                    Autentikasi Pegawai
                </a>
            @endauth
        </div>
    </aside>

    <main class="md:ml-64 min-h-screen flex flex-col bg-slate-50 pt-16 md:pt-0">
        
        <section id="hero" class="relative bg-gradient-to-br from-[#00AEEF] via-[#0070A8] to-[#003459] px-6 pb-32 pt-20 lg:pt-32 lg:pb-40 overflow-hidden">
            <div class="max-w-4xl mx-auto relative z-10 text-center md:text-left">
                <div class="animate-fade-in-up">
                    <span class="inline-flex items-center gap-2 py-1 px-3 rounded-md bg-white/10 backdrop-blur-md text-blue-50 text-xs font-semibold mb-6 border border-white/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                        Pelindo Regional 2 Teluk Bayur
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-6 leading-tight animate-fade-in-up delay-100">
                    Sistem Pelaporan <br>
                    <span class="text-blue-200">Fasilitas Kantor</span>
                </h1>
                <p class="text-lg text-blue-100 mb-10 max-w-2xl animate-fade-in-up delay-200">
                    Laporkan kendala fasilitas kantor dengan cepat. Tim SDM akan mendisposisikan laporan Anda secara real-time untuk penanganan instan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up delay-300 justify-center md:justify-start">
                    <button @click="modalLapor = true" class="bg-white text-[#004A74] font-bold px-8 py-3.5 rounded-2xl shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                        Buat Laporan Baru
                    </button>
                    <a href="#kategori" class="bg-[#003459]/30 backdrop-blur-md text-white border border-blue-300/30 px-8 py-3.5 rounded-2xl hover:bg-[#003459]/50 transition-all">
                        Daftar Layanan
                    </a>
                </div>
            </div>

            <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none">
                <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
                <g class="parallax">
                    <use href="#gentle-wave" x="48" y="0" fill="rgba(248, 250, 252, 0.2)" />
                    <use href="#gentle-wave" x="48" y="3" fill="rgba(248, 250, 252, 0.4)" />
                    <use href="#gentle-wave" x="48" y="5" fill="rgba(248, 250, 252, 0.6)" />
                    <use href="#gentle-wave" x="48" y="7" fill="#f8fafc" />
                </g>
            </svg>
        </section>

        <section class="bg-white border-b border-slate-200 py-12 relative z-10">
            <div class="max-w-5xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="group"><p class="text-3xl font-bold text-[#003459] group-hover:text-[#00AEEF] transition-colors">SDM</p><p class="text-[0.6rem] uppercase tracking-widest font-bold text-slate-400 mt-1">Pengelola</p></div>
                <div class="group"><p class="text-3xl font-bold text-[#003459] group-hover:text-[#00AEEF] transition-colors">GPS</p><p class="text-[0.6rem] uppercase tracking-widest font-bold text-slate-400 mt-1">Precise Location</p></div>
                <div class="group"><p class="text-3xl font-bold text-[#003459] group-hover:text-[#00AEEF] transition-colors">LIVE</p><p class="text-[0.6rem] uppercase tracking-widest font-bold text-slate-400 mt-1">Tracking</p></div>
                <div class="group"><p class="text-3xl font-bold text-[#003459] group-hover:text-[#00AEEF] transition-colors">100%</p><p class="text-[0.6rem] uppercase tracking-widest font-bold text-slate-400 mt-1">Terintegrasi</p></div>
            </div>
        </section>

        <section id="kategori" class="py-24 px-6 bg-slate-50">
            <div class="max-w-5xl mx-auto">
                <div class="mb-16 text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-3">Cakupan Fasilitas SDM</h2>
                    <p class="text-slate-500 text-sm max-w-lg">Kami melayani pemeliharaan lingkungan kerja internal agar produktivitas tetap terjaga.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-10 rounded-3xl border border-slate-200 hover:shadow-2xl transition-all group relative overflow-hidden">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#00AEEF] group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl mb-3 text-slate-900">Gedung & RT</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">Penanganan AC, instalasi listrik ruangan, fasilitas air bersih, dan pemeliharaan fisik kantor.</p>
                    </div>
                    <div class="bg-white p-10 rounded-3xl border border-slate-200 hover:shadow-2xl transition-all group relative overflow-hidden">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#00AEEF] group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl mb-3 text-slate-900">Aset & Meubelair</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">Perbaikan meja kerja, kursi ergonomis, lemari dokumen, serta inventaris interior kantor lainnya.</p>
                    </div>
                    <div class="bg-white p-10 rounded-3xl border border-slate-200 hover:shadow-2xl transition-all group relative overflow-hidden">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#00AEEF] group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h3 class="font-bold text-xl mb-3 text-slate-900">Layanan Staf</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">Pengurusan ID Card, seragam kerja, atribut kedinasan, dan fasilitas administrasi kepegawaian.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- LEADERBOARD IMPROVED (Card Profil & Foto Teknisi) --}}
        <section id="leaderboard" class="py-24 px-6 bg-slate-100 border-t border-slate-200 relative overflow-hidden">
            <div class="max-w-5xl mx-auto relative z-10">
                <div class="mb-12 border-l-4 border-[#003459] pl-4">
                    <h2 class="text-3xl font-black text-[#003459] tracking-tight mb-2">Tinjauan Kinerja Personel</h2>
                    <p class="text-slate-500 font-medium text-sm">Rekapitulasi penyelesaian tugas dan profil teknisi lapangan terbaik bulan ini.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        // Mengambil data teknisi dari DB beserta relasi unit
                        $technicians = \App\Models\User::where('role', 'technician')
                            ->withCount(['handledTickets as completed' => function($q) {
                                $q->where('status', 'completed');
                            }])
                            ->orderBy('completed', 'desc')
                            ->take(3)
                            ->get();
                    @endphp

                    @forelse($technicians as $index => $tech)
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group relative overflow-hidden flex flex-col">
                        
                        {{-- Banner & Rank Badge --}}
                        <div class="h-24 w-full {{ $index == 0 ? 'bg-gradient-to-r from-amber-400 to-amber-500' : ($index == 1 ? 'bg-gradient-to-r from-slate-400 to-slate-500' : 'bg-gradient-to-r from-orange-400 to-orange-500') }} relative">
                            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                            
                            {{-- Lencana Peringkat --}}
                            <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md border border-white/40 text-white font-black px-4 py-1.5 rounded-full text-sm shadow-sm">
                                Rank #{{ $index + 1 }}
                            </div>
                        </div>

                        <div class="p-6 text-center flex-1 flex flex-col items-center">
                            {{-- Foto Avatar overlapping banner --}}
                            <div class="w-24 h-24 -mt-16 rounded-full p-1.5 bg-white shadow-md relative z-10 mb-4 group-hover:scale-105 transition-transform duration-300">
                                @if($tech->profile_photo)
                                    <img src="{{ asset('storage/' . $tech->profile_photo) }}" class="w-full h-full object-cover rounded-full">
                                @else
                                    <div class="w-full h-full rounded-full bg-slate-100 flex items-center justify-center text-3xl font-black text-slate-400 border border-slate-200">
                                        {{ substr($tech->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            
                            {{-- Info Nama & NIPP --}}
                            <h3 class="font-black text-xl text-slate-800 tracking-tight">{{ $tech->name }}</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 mb-6">NIPP: {{ $tech->nipp ?? '-' }}</p>
                            
                            <div class="w-full mt-auto space-y-4">
                                {{-- Spesialisasi --}}
                                <div class="bg-slate-50 border border-slate-100 p-3 rounded-xl text-left">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Spesialisasi Unit</p>
                                    <p class="text-sm font-bold text-slate-700 truncate">{{ $tech->unit->name ?? 'Operasional Lapangan' }}</p>
                                </div>
                                
                                {{-- Metrik Kinerja --}}
                                <div class="flex items-center justify-between p-3 bg-emerald-50 border border-emerald-100 rounded-xl">
                                    <div class="text-left">
                                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-0.5">Tiket Tuntas</p>
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-2xl font-black text-emerald-700 leading-none">{{ $tech->completed }}</span>
                                            <span class="text-[10px] font-bold text-emerald-600">Tugas</span>
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-1 md:col-span-3 py-16 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-slate-600 font-black text-lg mb-1">Data Belum Tersedia</h3>
                        <p class="text-slate-400 text-sm font-medium">Belum ada catatan kinerja personel untuk periode ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        <footer class="mt-auto py-12 px-6 bg-slate-50 border-t border-slate-200">
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-5">
                    <img src="{{ asset('pelindo.png') }}" alt="Logo" class="h-8 w-auto grayscale opacity-40">
                    <div class="h-10 w-[1px] bg-slate-200 hidden md:block"></div>
                    <div>
                        <p class="text-sm font-bold text-slate-700 leading-none">Portal MERCU</p>
                        <p class="text-[10px] text-slate-400 font-semibold mt-1 uppercase tracking-tight">Divisi SDM, Umum & KBL Teluk Bayur &copy; {{ date('Y') }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="px-4 py-1 bg-white border border-slate-200 text-slate-500 text-[10px] font-bold rounded-lg uppercase tracking-widest shadow-sm">v.1.0 Stable</span>
                </div>
            </div>
        </footer>
    </main>

    {{-- MODAL LAPORAN IMPROVED (Formal Document Style) --}}
    <div x-show="modalLapor" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 overflow-y-auto" x-cloak>
        <div x-show="modalLapor" @click="modalLapor = false" x-transition.opacity class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
        
        <div class="relative bg-white w-full max-w-2xl rounded-xl shadow-2xl overflow-hidden my-auto border border-slate-300 flex flex-col max-h-[90vh]" 
             x-show="modalLapor" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="bg-white border-b-2 border-[#003459] px-8 py-5 flex justify-between items-center shrink-0">
                <div>
                    <h3 class="text-lg font-black text-[#003459] uppercase tracking-tight">Formulir Laporan Kerusakan</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Dokumen internal permohonan tindakan perbaikan fasilitas.</p>
                </div>
                <button @click="modalLapor = false" type="button" class="text-slate-400 hover:text-red-500 transition-colors focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="overflow-y-auto bg-slate-50 flex-1">
                <form id="formLaporan" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="px-8 py-6 space-y-6">
                    @csrf
                    
                    <div class="bg-white p-5 border border-slate-200 rounded shadow-sm">
                        <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-2">
                            <span class="w-5 h-5 bg-[#003459] text-white flex items-center justify-center text-xs font-bold rounded">I</span>
                            <h4 class="text-sm font-bold text-[#003459]">Identitas Pelapor</h4>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Induk Pegawai <span class="text-red-500">*</span></label>
                                <input type="text" name="reporter_nipp" required placeholder="Cth: 1002391" class="w-full px-3 py-2 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="reporter_name" required placeholder="Nama sesuai identitas" class="w-full px-3 py-2 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 border border-slate-200 rounded shadow-sm">
                        <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-2">
                            <span class="w-5 h-5 bg-[#003459] text-white flex items-center justify-center text-xs font-bold rounded">II</span>
                            <h4 class="text-sm font-bold text-[#003459]">Rincian Objek Laporan</h4>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kategori Klasifikasi <span class="text-red-500">*</span></label>
                                <select name="unit_id" required class="w-full px-3 py-2 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none">
                                    <option value="" disabled selected>-- Pilih Jenis Fasilitas --</option>
                                    @foreach(\App\Models\Unit::all() as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Lokasi Kejadian & Validasi Posisi <span class="text-red-500">*</span></label>
                                <div class="flex flex-col md:flex-row gap-2">
                                    <input type="text" name="location" x-model="form.lokasi" required placeholder="Deskripsi lokasi fisik (Misal: Pantry Lt. 1)" class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none">
                                    <button type="button" @click="getLocation" class="px-4 py-2 bg-slate-100 border border-slate-300 text-slate-700 rounded text-xs font-bold hover:bg-slate-200 transition-colors flex items-center justify-center gap-2 shrink-0">
                                        <svg x-show="!loadingGps" class="w-4 h-4 text-[#00AEEF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        <svg x-show="loadingGps" class="w-4 h-4 animate-spin text-[#00AEEF]" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span x-text="loadingGps ? 'Memproses...' : 'Ambil Koordinat GPS'"></span>
                                    </button>
                                </div>
                                <input type="hidden" name="coordinates" x-model="form.koordinat">
                                <p x-show="form.koordinat" class="text-[10px] text-emerald-600 font-bold mt-1" x-text="'Koordinat tersimpan: ' + form.koordinat"></p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Uraian Kerusakan <span class="text-red-500">*</span></label>
                                <textarea name="description" required rows="3" placeholder="Deskripsikan kondisi kerusakan secara jelas dan faktual..." class="w-full px-3 py-2 bg-white border border-slate-300 rounded text-sm focus:border-[#003459] focus:ring-1 focus:ring-[#003459] outline-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 border border-slate-200 rounded shadow-sm">
                        <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-2">
                            <span class="w-5 h-5 bg-[#003459] text-white flex items-center justify-center text-xs font-bold rounded">III</span>
                            <h4 class="text-sm font-bold text-[#003459]">Dokumentasi Pendukung <span class="text-red-500">*</span></h4>
                        </div>
                        
                        <div class="space-y-3 mt-2">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <label for="cam_upload" class="flex-1 py-4 px-2 border border-slate-300 bg-slate-50 rounded flex flex-col items-center justify-center cursor-pointer hover:bg-slate-100 hover:border-[#003459] transition-colors text-center shadow-sm">
                                    <svg class="w-6 h-6 text-[#003459] mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-xs font-bold text-slate-800">Ambil Foto Langsung</span>
                                </label>
                                <input type="file" id="cam_upload" name="evidence_photo_cam" accept="image/*" capture="environment" @change="previewImage" class="hidden">

                                <label for="gal_upload" class="flex-1 py-4 px-2 border border-slate-300 bg-slate-50 rounded flex flex-col items-center justify-center cursor-pointer hover:bg-slate-100 hover:border-[#003459] transition-colors text-center shadow-sm">
                                    <svg class="w-6 h-6 text-[#003459] mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    <span class="text-xs font-bold text-slate-800">Pilih dari Galeri/File</span>
                                </label>
                                <input type="file" id="gal_upload" name="evidence_photo" accept="image/*" @change="previewImage" class="hidden">
                            </div>
                            
                            <p class="text-[10px] text-slate-500 mt-1">Format: JPG, PNG. Ukuran maksimal: 2MB.</p>

                            <div x-show="photoPreview" class="mt-4 relative w-full h-40 border border-slate-200 rounded bg-slate-100 overflow-hidden shadow-inner" x-cloak>
                                <img :src="photoPreview" class="w-full h-full object-contain">
                                <button type="button" @click="photoPreview = null; document.getElementById('cam_upload').value = ''; document.getElementById('gal_upload').value = '';" class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded shadow hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white border-t border-slate-200 px-8 py-4 flex justify-end gap-3 shrink-0">
                <button type="button" @click="modalLapor = false" class="px-5 py-2 bg-white border border-slate-300 text-slate-700 rounded text-sm font-bold hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="button" onclick="document.getElementById('formLaporan').submit()" class="px-6 py-2 bg-[#003459] text-white rounded text-sm font-bold shadow hover:bg-slate-800 transition-colors">
                    Kirim Dokumen Laporan
                </button>
            </div>
        </div>
    </div>

    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-8 right-8 z-[90] w-16 h-16 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-2xl animate-float-wa hover:scale-110 transition-transform group">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 21.413l-1.428-1.424a9.927 9.927 0 0 1-5.006-1.309l-3.23.847.859-3.153a9.914 9.914 0 0 1-1.38-5.01C1.846 5.617 6.402 1.05 12.042 1.05s10.196 4.567 10.196 10.214c0 5.648-4.556 10.214-10.207 10.149z"></path></svg>
        <span class="absolute right-20 bg-white text-slate-800 px-4 py-2 rounded-xl text-xs font-bold shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Hubungi Admin MERCU</span>
    </a>

</body>
</html>
