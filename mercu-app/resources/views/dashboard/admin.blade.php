<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-[#003459] tracking-tight">Panel Manager MERCU</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Monitoring Fasilitas & SDM</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-[#00AEEF] rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div class="pr-4">
                    <p class="text-[0.6rem] font-black text-slate-400 uppercase leading-none">Status Sistem</p>
                    <p class="text-sm font-bold text-emerald-500 tracking-tight">Optimal</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:border-[#00AEEF] transition-all">
            <p class="text-[0.6rem] font-black text-slate-400 uppercase tracking-widest mb-2">Total Laporan</p>
            <p class="text-4xl font-black text-[#003459] group-hover:scale-110 transition-transform">128</p>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:border-amber-400 transition-all">
            <p class="text-[0.6rem] font-black text-slate-400 uppercase tracking-widest mb-2">Pending</p>
            <p class="text-4xl font-black text-amber-500 group-hover:scale-110 transition-transform">12</p>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:border-emerald-400 transition-all">
            <p class="text-[0.6rem] font-black text-slate-400 uppercase tracking-widest mb-2">Selesai</p>
            <p class="text-4xl font-black text-emerald-500 group-hover:scale-110 transition-transform">110</p>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:border-blue-400 transition-all">
            <p class="text-[0.6rem] font-black text-slate-400 uppercase tracking-widest mb-2">Staf Aktif</p>
            <p class="text-4xl font-black text-[#00AEEF] group-hover:scale-110 transition-transform">6</p>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <h3 class="font-black text-[#003459]">Log Aktivitas Fasilitas Terbaru</h3>
            <button class="text-xs font-bold text-[#00AEEF] hover:underline">Lihat Semua Laporan</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="p-6 text-[0.65rem] font-black uppercase text-slate-400 tracking-widest">Tiket</th>
                        <th class="p-6 text-[0.65rem] font-black uppercase text-slate-400 tracking-widest">Pelapor</th>
                        <th class="p-6 text-[0.65rem] font-black uppercase text-slate-400 tracking-widest">Kategori</th>
                        <th class="p-6 text-[0.65rem] font-black uppercase text-slate-400 tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    <tr>
                        <td class="p-6 font-bold text-[#003459]">#MERCU-9921</td>
                        <td class="p-6">
                            <p class="font-bold">Budi Santoso</p>
                            <p class="text-[10px] text-slate-400">NIPP: 230101</p>
                        </td>
                        <td class="p-6"><span class="px-3 py-1 bg-blue-50 text-[#00AEEF] rounded-lg text-xs font-bold uppercase">Gedung (RT)</span></td>
                        <td class="p-6"><span class="flex items-center gap-2 text-amber-500 font-bold"><span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span> Menunggu</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
