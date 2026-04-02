<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-[#003459] tracking-tight">Tugas Lapangan</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Staf Pelaksana SDM & Umum</p>
            </div>
            <div class="bg-emerald-50 px-6 py-3 rounded-2xl border border-emerald-100">
                <p class="text-[0.6rem] font-black text-emerald-600 uppercase leading-none mb-1">Poin Kinerja</p>
                <p class="text-xl font-black text-emerald-700 leading-none">850</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 hover:shadow-xl transition-all border-l-8 border-l-[#00AEEF]">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-[10px] font-black text-white bg-[#003459] px-3 py-1 rounded-full uppercase">#MERCU-9920</span>
                    <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-3 py-1 rounded-full uppercase">Urgent</span>
                </div>
                <h3 class="text-xl font-black text-[#003459] mb-1">Perbaikan AC Ruang Manager</h3>
                <p class="text-sm text-slate-500 font-medium">Lokasi: Gedung Utama, Lt. 2 - Ruang 204</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="px-8 py-4 bg-[#00AEEF] text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-200 hover:bg-blue-400 transition-all">Proses Sekarang</button>
            </div>
        </div>

        <div class="py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <p class="text-slate-400 font-bold uppercase text-[0.65rem] tracking-widest">Semua Tugas Selesai</p>
        </div>
    </div>
</x-app-layout>
