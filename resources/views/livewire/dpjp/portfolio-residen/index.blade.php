<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-black text-slate-800 uppercase italic tracking-tighter">Portfolio Residen</h3>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Monitoring capaian kompetensi asuhan Anda</p>
        </div>
        
        <form method="POST" class="relative group">
            <input type="text" name="search" value="" placeholder="Cari Nama / NIM..." 
                   class="bg-white border border-slate-200 py-3 pl-12 pr-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-indigo-500 focus:outline-none w-full md:w-64 transition-all shadow-sm">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">🔍</span>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-[40px] border border-slate-100 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700"></div>

            <div class="relative z-10">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-100">
                            
                            {{ substr('Dr. Budi Santoso', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 uppercase italic leading-none truncate w-32">Dr. Budi Santoso</h4>
                            <p class="text-[10px] text-slate-400 font-bold mt-1 tracking-widest uppercase">NIM: 2323232323232322</p>
                        </div>
                    </div>
                    
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-end">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-tighter">Progress Logbook Anda</span>
                        <span class="text-sm font-black text-slate-800">14%</span>
                    </div>
                    <div class="h-3 bg-slate-100 rounded-full overflow-hidden p-0.5 shadow-inner">
                        <div class=" h-full rounded-full transition-all duration-1000" style="width: 100%"></div>
                    </div>
                    <div class="flex justify-between text-[9px] font-bold text-slate-400 uppercase">
                        <span>10 Disetujui</span>
                        <span>Target: 80</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="#" class="py-3 bg-slate-900 text-white rounded-2xl text-[9px] font-black uppercase text-center hover:bg-indigo-600 transition-colors shadow-lg shadow-slate-200">
                        Verifikasi
                    </a>
                    <a href="#" target="_blank" class="py-3 bg-white border border-slate-200 text-slate-600 rounded-2xl text-[9px] font-black uppercase text-center hover:bg-slate-50 transition-colors">
                        Laporan
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</div>