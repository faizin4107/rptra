<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded-[30px] border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">📋</div>
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Klinis Pending</p>
                <h3 class="text-xl font-black text-slate-800">10 <span class="text-[10px] text-slate-400 font-normal italic">Log</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-[30px] border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">🩺</div>
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Prosedur Pending</p>
                <h3 class="text-xl font-black text-slate-800">20 <span class="text-[10px] text-slate-400 font-normal italic">Log</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-[30px] border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">⭐</div>
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Antrean Mini-CEX</p>
                <h3 class="text-xl font-black text-slate-800">21 <span class="text-[10px] text-slate-400 font-normal italic">Mhs</span></h3>
            </div>
        </div>

        <div class="bg-slate-900 p-5 rounded-[30px] flex items-center gap-4 shadow-xl shadow-slate-200">
            <div class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center text-xl">🎓</div>
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status Anda</p>
                <h3 class="text-lg font-black text-white italic tracking-tighter">DPJP AKTIF</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 space-y-3">
            <div class="flex items-center gap-2 mb-5">
                <span class="w-2 h-6 bg-indigo-600 rounded-full"></span>
                <h4 class="text-sm font-black text-slate-800 uppercase italic">Instrumen Kendali</h4>
            </div>
            
            
        </div>

        <div class="lg:col-span-2 bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h4 class="text-sm font-black text-slate-800 uppercase italic">Efektivitas Verifikasi</h4>
                    <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Total seluruh logbook yang masuk</p>
                </div>
                <div class="flex gap-3 text-[9px] font-black text-slate-500">
                    <span class="flex items-center gap-1.5"><span class="w-3 h-3 bg-indigo-500 rounded-full"></span> ACC</span>
                    <span class="flex items-center gap-1.5"><span class="w-3 h-3 bg-rose-500 rounded-full"></span> REJECT</span>
                </div>
            </div>
            <div class="h-[250px] w-full">
                <canvas id="chartLogbook"></canvas>
            </div>
        </div>
    </div>
</div>