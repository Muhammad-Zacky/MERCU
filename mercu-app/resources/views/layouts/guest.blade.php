<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MERCU - Autentikasi Internal</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Animasi Transisi Masuk */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }

        /* Animasi Ombak Pantai */
        @keyframes move-forever {
            0% { transform: translate3d(-90px, 0, 0); }
            100% { transform: translate3d(85px, 0, 0); }
        }
        .waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 25vh;
            min-height: 120px;
            max-height: 220px;
            z-index: 1;
        }
        .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
        .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(248, 250, 252, 0.1); }
        .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(248, 250, 252, 0.2); }
        .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(248, 250, 252, 0.4); }
        .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #f8fafc; } /* Warna ombak terdepan menyatu dengan panel kanan bg-slate-50 */
    </style>
</head>
<body class="bg-slate-50 font-['Inter'] flex min-h-screen antialiased selection:bg-[#00AEEF] selection:text-white">
    
    {{-- PANEL KIRI: Branding & Animasi Pelindo (Disembunyikan di layar HP) --}}
    <div class="hidden lg:flex w-1/2 xl:w-[55%] relative overflow-hidden flex-col justify-between p-14 xl:p-20 bg-gradient-to-br from-[#003459] via-[#004A74] to-[#00AEEF]">
        
        {{-- Tekstur Jaring Transparan --}}
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay z-0"></div>

        {{-- Konten Atas --}}
        <div class="relative z-10 animate-fade-in-up">
            <div class="flex items-center gap-4 mb-16">
                {{-- Memutihkan logo Pelindo bawaan dengan filter --}}
                <img src="{{ asset('pelindo.png') }}" class="h-10 xl:h-12 w-auto brightness-0 invert" alt="Logo Pelindo">
                <div class="border-l-2 border-white/20 pl-4">
                    <span class="text-2xl xl:text-3xl font-black text-white leading-none tracking-tight">MERCU</span>
                    <span class="text-[0.65rem] font-bold text-cyan-300 uppercase block tracking-widest mt-1">Portal Operasional</span>
                </div>
            </div>

            <h1 class="text-4xl xl:text-5xl font-black text-white mb-6 leading-tight tracking-tighter">
                Sistem Manajemen <br> <span class="text-cyan-400">Bantuan Internal.</span>
            </h1>
            <p class="text-blue-100/90 font-medium max-w-md leading-relaxed text-sm">
                Akses eksklusif untuk staf dan teknisi PT Pelabuhan Indonesia (Persero) Regional 2 Teluk Bayur. Pastikan Anda masuk menggunakan email korporat resmi.
            </p>
        </div>

        {{-- Konten Bawah --}}
        <div class="relative z-10 animate-fade-in-up delay-200">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-lg bg-white/10 border border-white/10 backdrop-blur-md mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-[10px] font-black text-white uppercase tracking-widest">Koneksi Aman & Terenkripsi</span>
            </div>
            <p class="text-[10px] text-blue-200/60 font-bold uppercase tracking-widest">
                &copy; {{ date('Y') }} Divisi SDM & Umum Pelindo.
            </p>
        </div>

        {{-- Animasi Ombak --}}
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none">
            <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
            <g class="parallax">
                <use href="#gentle-wave" x="48" y="0" />
                <use href="#gentle-wave" x="48" y="3" />
                <use href="#gentle-wave" x="48" y="5" />
                <use href="#gentle-wave" x="48" y="7" />
            </g>
        </svg>
    </div>

    {{-- PANEL KANAN: Tempat Form Login Berada --}}
    <div class="flex-1 flex items-center justify-center p-6 sm:p-12 relative z-10 bg-slate-50">
        <div class="w-full max-w-md animate-fade-in-up delay-100">
            
            {{-- Slot ini akan memanggil file login.blade.php --}}
            {{ $slot }}

        </div>
    </div>

</body>
</html>
