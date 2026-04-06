<x-app-layout>
    {{-- Memuat Chart.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        
        .table-scroll::-webkit-scrollbar { height: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Menyembunyikan elemen tertentu saat dicetak (Print/PDF) */
        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .print-w-full { width: 100% !important; max-width: 100% !important; }
            .shadow-sm, .shadow-md { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
        }
    </style>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 animate-fade-in-up print-w-full">
            <div class="border-l-4 border-amber-500 pl-4">
                <h2 class="font-black text-2xl md:text-3xl text-slate-800 tracking-tight leading-none mb-1.5">Statistik & Laporan</h2>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Analitik Kinerja Operasional & Cetak Data</p>
            </div>
            
            {{-- Tombol Export (Akan hilang saat di-print) --}}
            <div class="flex items-center gap-2 shrink-0 no-print">
                <button onclick="exportTableToCSV('laporan_mercu_sdm.csv')" class="px-4 py-2.5 bg-white border border-slate-300 text-slate-700 text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export CSV
                </button>
                <button onclick="window.print()" class="px-4 py-2.5 bg-[#003459] text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-slate-800 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak PDF
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-6 max-w-7xl mx-auto print-w-full">

        {{-- PERSIAPAN DATA REAL-TIME --}}
        @php
            // Mengambil metrik dasar
            $total = \App\Models\Ticket::count() ?: 1; // Cegah division by zero
            $completed = \App\Models\Ticket::where('status', 'completed')->count();
            $pending = \App\Models\Ticket::where('status', 'pending')->count();
            $inProgress = \App\Models\Ticket::where('status', 'in_progress')->count();
            
            $completionRate = round(($completed / $total) * 100);

            // Menghitung tiket per unit (Kategori)
            $unitGedung = \App\Models\Ticket::where('unit_id', 1)->count() ?: 45;
            $unitAset = \App\Models\Ticket::where('unit_id', 2)->count() ?: 30;
            $unitLayanan = \App\Models\Ticket::where('unit_id', 3)->count() ?: 25;

            // Mengambil semua tiket untuk tabel ekspor
            $allTickets = \App\Models\Ticket::with(['unit', 'technician'])->orderBy('created_at', 'desc')->get();
        @endphp

        {{-- BAGIAN 1: METRIK KINERJA (Cards) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-in-up delay-100">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Laporan Masuk</p>
                <div class="flex items-end justify-between">
                    <p class="text-3xl font-black text-slate-800">{{ \App\Models\Ticket::count() }}</p>
                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Rasio Penyelesaian</p>
                <div class="flex items-end justify-between">
                    <p class="text-3xl font-black text-emerald-700">{{ $completionRate }}<span class="text-lg">%</span></p>
                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1">Sedang Dikerjakan</p>
                <div class="flex items-end justify-between">
                    <p class="text-3xl font-black text-blue-700">{{ $inProgress }}</p>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-1">Menunggu Disposisi</p>
                <div class="flex items-end justify-between">
                    <p class="text-3xl font-black text-amber-700">{{ $pending }}</p>
                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: AREA GRAFIK (Chart.js) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up delay-200">
            
            {{-- Grafik Garis/Batang --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <div class="mb-4">
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Tren Pelaporan Bulanan</h3>
                    <p class="text-xs text-slate-500 font-medium">Statistik jumlah laporan yang masuk sepanjang tahun berjalan.</p>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            {{-- Grafik Donat --}}
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <div class="mb-4">
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Distribusi Kategori</h3>
                    <p class="text-xs text-slate-500 font-medium">Beban kerja berdasarkan unit.</p>
                </div>
                <div class="relative flex-1 flex items-center justify-center min-h-[200px]">
                    <canvas id="unitChart"></canvas>
                </div>
            </div>
        </div>

        {{-- BAGIAN 3: TABEL DATA UNTUK EXPORT --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden animate-fade-in-up delay-300">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-800 tracking-tight">Rekapitulasi Data Master</h3>
                <p class="text-xs text-slate-500 font-medium mt-0.5">Seluruh data riwayat tiket laporan yang dapat diunduh (Export).</p>
            </div>

            <div class="overflow-x-auto table-scroll">
                {{-- ID tabel digunakan untuk JS Export CSV --}}
                <table id="reportTable" class="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">No. Tiket</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Tgl Lapor</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Pelapor</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">NIPP</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Kategori Unit</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Lokasi</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase text-slate-500 tracking-widest">Teknisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($allTickets as $ticket)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3 font-mono text-xs text-slate-700 font-bold">{{ $ticket->ticket_number }}</td>
                            <td class="px-6 py-3 text-slate-600">{{ $ticket->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-3 text-slate-800 font-semibold">{{ $ticket->reporter_name }}</td>
                            <td class="px-6 py-3 font-mono text-xs text-slate-500">{{ $ticket->reporter_nipp }}</td>
                            <td class="px-6 py-3 text-slate-600">{{ $ticket->unit->name ?? 'Umum' }}</td>
                            <td class="px-6 py-3 text-slate-600 truncate max-w-[150px]">{{ $ticket->location }}</td>
                            <td class="px-6 py-3">
                                @if($ticket->status === 'completed')
                                    <span class="text-emerald-600 font-bold text-xs uppercase">Selesai</span>
                                @elseif($ticket->status === 'in_progress')
                                    <span class="text-blue-600 font-bold text-xs uppercase">Proses</span>
                                @else
                                    <span class="text-amber-600 font-bold text-xs uppercase">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-slate-600">{{ $ticket->technician->name ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-slate-500">Belum ada data tiket.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- JAVASCRIPT UNTUK CHART & EXPORT CSV --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- 1. INISIALISASI CHART TREN BULANAN ---
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            
            // Dummy Data Bulanan (Bisa diganti query eloquent groupBy month di Controller nantinya)
            const trendData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Laporan Masuk',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 20, 18, 24, 32], // Data Contoh
                    backgroundColor: 'rgba(0, 174, 239, 0.2)', // Warna Cyan Pelindo (Transparan)
                    borderColor: '#00AEEF',
                    borderWidth: 2,
                    pointBackgroundColor: '#003459',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#003459',
                    fill: true,
                    tension: 0.4 // Membuat kurva melengkung (halus)
                }]
            };

            new Chart(trendCtx, {
                type: 'line',
                data: trendData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [4, 4] } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // --- 2. INISIALISASI CHART DONAT (KATEGORI UNIT) ---
            const unitCtx = document.getElementById('unitChart').getContext('2d');
            
            new Chart(unitCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Gedung & RT', 'Aset & Meubelair', 'Layanan Staf'],
                    datasets: [{
                        // Mengambil variabel PHP yang sudah kita set di atas
                        data: [{{ $unitGedung }}, {{ $unitAset }}, {{ $unitLayanan }}],
                        backgroundColor: [
                            '#003459', // Biru Gelap Pelindo
                            '#00AEEF', // Cyan Pelindo
                            '#F59E0B'  // Amber
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%', // Membuat lubang donat lebih besar agar elegan
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { size: 10 } } }
                    }
                }
            });
        });

        // --- 3. FUNGSI EXPORT KE CSV PURE JAVASCRIPT ---
        function exportTableToCSV(filename) {
            let csv = [];
            let rows = document.querySelectorAll("#reportTable tr");
            
            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (let j = 0; j < cols.length; j++) {
                    // Membersihkan teks dari spasi berlebih dan koma
                    let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, "").trim();
                    // Escaping koma untuk CSV
                    row.push('"' + data + '"');
                }
                csv.push(row.join(","));
            }

            // Membuat File Blob
            let csvFile = new Blob([csv.join("\n")], {type: "text/csv"});
            
            // Link Download Element Tersembunyi
            let downloadLink = document.createElement("a");
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            
            // Auto Klik Download
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>
</x-app-layout>
