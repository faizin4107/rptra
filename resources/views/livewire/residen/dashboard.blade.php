<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="gradient-purple p-8 rounded-[40px] text-white shadow-xl shadow-indigo-100">
            <p class="text-[10px] font-bold opacity-70 uppercase mb-1 italic">Indeks Prestasi</p>
            <h3 class="text-4xl font-black italic tracking-tighter"><?= number_format($ipk_real, 2) ?></h3>
            <p class="text-[10px] mt-4 font-medium bg-white/20 w-fit px-3 py-1 rounded-full">Nilai Akademik</p>
        </div>

        <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1 italic">Stase Selesai</p>
            <h3 class="text-4xl font-black italic tracking-tighter text-slate-800"><?= $stase_selesai ?> <span class="text-lg text-slate-300">/ <?= $total_stase ?></span></h3>
            <p class="text-[10px] mt-4 font-medium text-emerald-500 bg-emerald-50 w-fit px-3 py-1 rounded-full">Sisa <?= $sisa_stase ?> Stase</p>
        </div>
        
        <div class="md:col-span-2 bg-slate-900 p-8 rounded-[40px] text-white relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-[10px] font-bold opacity-50 uppercase mb-1 italic">Status Pendidikan</p>
                <h3 class="text-xl font-bold italic tracking-tight">Anestesiologi & Terapi Intensif</h3>
                <p class="text-xs mt-2 text-slate-400">RS Hermina Training Center</p>
            </div>
            <div class="absolute -right-5 -bottom-5 w-32 h-32 bg-indigo-500 rounded-full opacity-20 blur-2xl"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm flex flex-col items-center">
            <h4 class="text-sm font-black text-slate-800 uppercase italic mb-8 self-start flex items-center gap-2">
                <span class="w-1.5 h-4 bg-indigo-600 rounded-full"></span> Progress Stase
            </h4>
            <div class="relative w-full max-w-[180px] aspect-square">
                <canvas id="resumeChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-3xl font-black text-slate-800"><?= round($persen_stase) ?>%</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
            <h4 class="text-sm font-black text-slate-800 uppercase italic mb-8 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-sky-500 rounded-full"></span> Tren Nilai Stase
            </h4>
            <div class="h-[250px] w-full">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-sm font-black text-slate-800 uppercase italic">Log Kehadiran 30 Hari Terakhir</h4>
            <span class="text-[10px] bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full font-bold uppercase tracking-wider">GPS Verified</span>
        </div>
        <div class="h-[150px] w-full">
            <canvas id="absensiChart"></canvas>
        </div>
    </div>

    @script
    <script>
    </script>
    @endscript
</div>
