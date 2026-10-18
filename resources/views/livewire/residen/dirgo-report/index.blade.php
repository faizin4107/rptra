<div class="space-y-6">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-[30px] p-8 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-black italic uppercase tracking-tighter">DIRGO Dashboard</h2>
            <p class="text-indigo-100 text-xs font-bold uppercase tracking-widest mt-1">Digital Report & Governance Residen</p>
        </div>
        <div class="absolute right-[-20px] top-[-20px] opacity-20 transform rotate-12">
            <svg width="150" height="150" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-[25px] border border-slate-100 shadow-sm">
            <span class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl text-xl inline-block mb-4">🏥</span>
            <h4 class="text-3xl font-black text-slate-800">10</h4>
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Total Log Klinis</p>
            <div class="mt-4 flex gap-2">
                <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">✅ <?= $data_k['verified'] ?? 0 ?> ACC</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[25px] border border-slate-100 shadow-sm">
            <span class="p-3 bg-blue-50 text-blue-600 rounded-2xl text-xl inline-block mb-4">💉</span>
            <h4 class="text-3xl font-black text-slate-800">14</h4>
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Total Log Prosedur</p>
            <div class="mt-4 flex gap-2">
                <span class="text-[9px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md">✅ <?= $data_p['verified'] ?? 0 ?> ACC</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[25px] border-2 border-indigo-100 shadow-sm">
            <span class="p-3 bg-purple-50 text-purple-600 rounded-2xl text-xl inline-block mb-4">🎓</span>
            <h4 class="text-3xl font-black text-indigo-600">20</h4>
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Skor Komulatif</p>
            <p class="mt-2 text-[10px] text-slate-500 italic">20 Belum ada evaluasi.</p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[30px] border border-slate-100 shadow-sm">
        <h3 class="text-sm font-black text-slate-800 uppercase mb-6 flex items-center gap-2">
            <span class="w-2 h-6 bg-indigo-600 rounded-full"></span> 
            Logbook Terbaru (Live)
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-slate-400 border-b uppercase font-black">
                        <th class="pb-4 px-2">Tanggal</th>
                        <th class="pb-4 px-2">Kategori</th>
                        <th class="pb-4 px-2">Kegiatan/Tindakan</th>
                        <th class="pb-4 px-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 font-medium">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>