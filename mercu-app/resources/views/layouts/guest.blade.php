<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DOCK - Autentikasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-['Inter'] flex min-h-screen">
    <div class="hidden lg:flex w-[450px] bg-white border-r border-slate-200 flex-col justify-between p-12">
        <div>
            <div class="flex items-center gap-4 mb-12">
                <img src="{{ asset('pelindo.png') }}" class="h-10 w-auto" alt="">
                <div class="border-l-2 border-slate-200 pl-4">
                    <span class="text-2xl font-black text-slate-900 leading-none">DOCK</span>
                    <span class="text-[0.65rem] font-bold text-[#00AEEF] uppercase block">Portal Operasional</span>
                </div>
            </div>
            <h1 class="text-3xl font-black text-slate-900 mb-6">Sistem Manajemen Bantuan Internal</h1>
            <p class="text-slate-500 font-medium">Pastikan anda menggunakan email korporat resmi untuk masuk.</p>
        </div>
        <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Divisi SDM Pelindo.</p>
    </div>

    <div class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white p-8 md:p-12 rounded-[2rem] shadow-xl border border-slate-100">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
