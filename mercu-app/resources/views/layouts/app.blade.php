<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DOCK') }} - Portal Operasional</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Inter'] antialiased bg-slate-50 text-slate-800">
    
    <div class="min-h-screen flex">
        @include('layouts.navigation')

        <div class="flex-1 md:ml-64 flex flex-col min-h-screen transition-all duration-300 w-full pt-16 md:pt-0">
            @isset($header)
                <header class="bg-white border-b border-slate-200 sticky top-16 md:top-0 z-30 shadow-sm">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-white border-t border-slate-200 py-4 px-6 mt-auto">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-2 text-xs font-medium text-slate-400">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('pelindo.png') }}" class="h-4 grayscale opacity-60" alt="Pelindo">
                        <p>&copy; {{ date('Y') }} Divisi SDM Operasional.</p>
                    </div>
                    <p>DOCK Portal</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
