<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERCU - Digital Operational Care & Knowledge</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes flowProgress {
            0% { width: 0%; opacity: 0; }
            15% { opacity: 1; }
            85% { opacity: 1; }
            100% { width: 100%; opacity: 0; }
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
        .animate-progress { animation: flowProgress 3.5s ease-in-out infinite; }
        .animate-float-wa { animation: float-wa 3s ease-in-out infinite; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }

        .waves { position: absolute; bottom: 0; left: 0; width: 100%; height: 15vh; min-height: 80px; max-height: 120px; z-index: 0; }
        .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
        .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; }
        .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; }
        .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; }
        .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased font-['Inter']" 
    x-data="{ 
        mobileSidebarOpen: false, 
        modalLapor: false,
        loadingGps: false,
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
            }
        }
    }">

    @if(session('success'))
    <div class="fixed top-20 right-6 z-[100] max-w-sm animate-fade-in-up">
        <div class="bg-emerald-500 text-white p-4 rounded-2xl shadow-2xl flex items-start gap-3">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <p class="font-bold text-sm">Berhasil!</p>
                <p class="text-xs opacity-90">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="md:hidden fixed top-0 left-0 w-full h-16 bg-white border-b border-slate-200 z-40 flex items-center justify-between px-4 shadow-sm">
        <div class="flex items-center gap-2">
            <img src="{{ asset('pelindo.png') }}" alt="Logo Pelindo" class="h-8 w-auto">
            <span class="font-bold text-slate-900 text-lg ml-2 border-l-2 border-slate-200 pl-3">MERCU</span>
        </div>
        <button @click="mobileSidebarOpen = true" class="text-slate-600 p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <div x-show="mobileSidebarOpen" @click="mobileSidebarOpen = false" class="md:hidden fixed inset-0 bg-slate-900/60 z-40 backdrop-blur-sm" x-cloak x-transition></div>

    <aside :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 w-64 h-full bg-slate-50 border-r border-slate-200 z-50 flex flex-col transition-transform duration-300 md:translate-x-0 overflow-y-auto">
        <div class="p-6 border-b border-slate-200 bg-white text-center sm:text-left">
            <div class="flex items-center gap-3">
                <img src="{{ asset('pelindo.png') }}" alt="Logo" class="h-10 w-auto">
                <div>
                    <span class="text-lg font-extrabold text-slate-900 leading-none">MERCU</span>
                    <span class="text-[0.55rem] font-bold text-[#00AEEF] block uppercase">Internal SDM</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="#hero" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-[#00AEEF] hover:bg-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda
            </a>
            <a href="#kategori" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-[#00AEEF] hover:bg-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Fasilitas SDM
            </a>
            <a href="#leaderboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-[#00AEEF] hover:bg-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Papan Peringkat
            </a>
        </nav>

        <div class="p-4 border-t border-slate-200 bg-slate-100">
            @auth
                <a href="{{ route('dashboard') }}" class="w-full bg-[#00AEEF] text-white flex justify-center py-2.5 rounded-lg text-sm font-semibold shadow-lg shadow-blue-200">Dasbor Staf SDM</a>
            @else
                <a href="{{ route('login') }}" class="w-full bg-white border border-slate-300 text-slate-700 flex justify-center py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-50 transition-colors shadow-sm">Masuk Portal</a>
            @endauth
        </div>
    </aside>

    <main class="md:ml-64 min-h-screen flex flex-col bg-slate-100 pt-16 md:pt-0">
        
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

        <section id="leaderboard" class="py-24 px-6 bg-slate-100">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Papan Peringkat Kinerja</h2>
                        <p class="text-slate-500 text-sm">Staf Operasional SDM dengan tingkat penyelesaian tiket terbaik.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        // Mengambil data teknisi/staf SDM dari DB
                        $technicians = \App\Models\User::where('role', 'technician')->withCount(['handledTickets as completed' => function($q) {
                            $q->where('status', 'completed');
                        }])->orderBy('completed', 'desc')->take(3)->get();
                    @endphp

                    @forelse($technicians as $index => $tech)
                    <div class="bg-white border border-slate-200 p-8 rounded-3xl flex flex-col items-center text-center hover:shadow-xl transition-all relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-12 h-12 flex items-center justify-center text-white font-black text-sm {{ $index == 0 ? 'bg-amber-400' : ($index == 1 ? 'bg-slate-300' : 'bg-orange-400') }}">
                            #{{ $index + 1 }}
                        </div>
                        <div class="w-20 h-20 rounded-2xl bg-slate-100 mb-4 overflow-hidden border-2 border-slate-50 group-hover:scale-110 transition-transform">
                            @if($tech->profile_photo)
                                <img src="{{ asset('storage/' . $tech->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-600 font-bold text-xl uppercase">
                                    {{ substr($tech->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <h4 class="font-bold text-slate-900">{{ $tech->name }}</h4>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-4">{{ $tech->unit->name ?? 'Operasional SDM' }}</p>
                        <div class="bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100">
                            <span class="text-blue-700 font-extrabold text-xs">{{ $tech->completed }} Selesai</span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 py-12 text-center bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-medium">Belum ada data kinerja bulan ini.</p>
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
                        <p class="text-[10px] text-slate-400 font-semibold mt-1 uppercase tracking-tight">Divisi SDM & Umum Teluk Bayur &copy; {{ date('Y') }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="px-4 py-1 bg-white border border-slate-200 text-slate-500 text-[10px] font-bold rounded-lg uppercase tracking-widest shadow-sm">v.1.0 Stable</span>
                </div>
            </div>
        </footer>
    </main>

    <div x-show="modalLapor" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        <div x-show="modalLapor" @click="modalLapor = false" x-transition.opacity class="absolute inset-0 bg-slate-900/70 backdrop-blur-md"></div>
        
        <div class="relative bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl overflow-hidden animate-fade-in-up" x-show="modalLapor" x-transition>
            <div class="bg-[#003459] p-8 text-white flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black tracking-tight">Formulir Laporan</h3>
                    <p class="text-xs text-blue-200 mt-1">Sampaikan kendala fasilitas Anda di sini.</p>
                </div>
                <button @click="modalLapor = false" class="bg-white/10 p-2 rounded-xl hover:bg-white/20 transition-colors">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 max-h-[65vh] overflow-y-auto">
                @csrf
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">NIPP Pelapor</label>
                        <input type="text" name="reporter_nipp" required placeholder="NIPP" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-[#00AEEF] focus:ring-4 focus:ring-blue-50 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="reporter_name" required placeholder="Nama" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-[#00AEEF] focus:ring-4 focus:ring-blue-50 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori Fasilitas</label>
                    <select name="unit_id" required class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-[#00AEEF] outline-none appearance-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(\App\Models\Unit::all() as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Lokasi & Shareloc</label>
                    <div class="flex gap-3">
                        <input type="text" name="location" x-model="form.lokasi" required placeholder="Cth: Ruang Rapat Lt. 1" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-[#00AEEF] outline-none">
                        <button type="button" @click="getLocation" class="px-6 bg-slate-900 text-white rounded-2xl flex items-center justify-center gap-2 hover:bg-black transition-colors shadow-lg">
                            <svg x-show="!loadingGps" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <svg x-show="loadingGps" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">GPS</span>
                        </button>
                    </div>
                    <input type="hidden" name="coordinates" x-model="form.koordinat">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Masalah</label>
                    <textarea name="description" required rows="3" placeholder="Jelaskan detail kerusakan..." class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-[#00AEEF] outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Lampiran Foto Bukti</label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-3xl hover:border-blue-400 transition-colors group cursor-pointer relative">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-300 group-hover:text-blue-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            <div class="flex text-xs text-slate-400">
                                <span class="font-bold text-blue-500">Unggah file</span>
                                <p class="pl-1">atau tarik dan lepas</p>
                            </div>
                            <p class="text-[10px] text-slate-400">PNG, JPG, JPEG up to 2MB</p>
                        </div>
                        <input type="file" name="evidence_photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row gap-3">
                    <button type="button" @click="modalLapor = false" class="flex-1 py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Batalkan</button>
                    <button type="submit" class="flex-[2] bg-[#00AEEF] text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-blue-200 hover:bg-[#0091C7] transition-all active:scale-[0.98]">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-8 right-8 z-[90] w-16 h-16 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-2xl animate-float-wa hover:scale-110 transition-transform group">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 21.413l-1.428-1.424a9.927 9.927 0 0 1-5.006-1.309l-3.23.847.859-3.153a9.914 9.914 0 0 1-1.38-5.01C1.846 5.617 6.402 1.05 12.042 1.05s10.196 4.567 10.196 10.214c0 5.648-4.556 10.214-10.207 10.149z"></path></svg>
        <span class="absolute right-20 bg-white text-slate-800 px-4 py-2 rounded-xl text-xs font-bold shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Hubungi Admin MERCU</span>
    </a>

</body>
</html>
