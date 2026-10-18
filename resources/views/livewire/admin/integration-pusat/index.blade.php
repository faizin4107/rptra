<div class="space-y-6">
    <div class="bg-slate-900 p-8 rounded-[40px] text-white shadow-xl flex justify-between items-center">
        <div>
            <h3 class="text-xl font-black italic tracking-tight text-indigo-400">Data Interoperability Hub</h3>
            <p class="text-xs text-slate-400">Pilih data residen yang telah diverifikasi untuk dikirim ke sistem eksternal.</p>
        </div>
        <div class="flex gap-2">
            <span class="bg-emerald-500/20 text-emerald-400 text-[10px] font-black px-3 py-1 rounded-full border border-emerald-500/30">UAT MODE ACTIVE</span>
        </div>
    </div>

    <form method="POST" action="">
        <div class="bg-white rounded-[40px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <div class="flex gap-4 items-center">
                    <select name="target_api" required class="text-xs font-bold border-none bg-white shadow-sm rounded-xl px-4 py-2 outline-none ring-1 ring-slate-200">
                        <option value="">-- PILIH TARGET KIRIM --</option>
                        <option value="SATUSEHAT">KEMKES (SATUSEHAT)</option>
                        <option value="LLDIKTI">DIKTI (PDDIKTI)</option>
                        <option value="SIAKAD">SIAKAD KAMPUS</option>
                    </select>
                    <button type="submit" name="proses_kirim" class="bg-indigo-600 text-white px-6 py-2 rounded-xl text-xs font-black uppercase hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        🚀 Push Data Terpilih
                    </button>
                </div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Antrean Data Siap Kirim</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                            <th class="py-4 px-6 text-center"><input type="checkbox" id="selectAll" class="rounded"></th>
                            <th class="py-4 px-4">Residen</th>
                            <th class="py-4 px-4">Kegiatan</th>
                            <th class="py-4 px-4 text-center">Status Satusehat</th>
                            <th class="py-4 px-4 text-center">Status LLDIKTI</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-50">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <div class="bg-slate-900 rounded-[40px] p-8 shadow-2xl">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-500">History Pengiriman Terakhir</h4>
            <a href="?p=audit-logs" class="text-[10px] font-bold text-indigo-400 hover:text-white transition">Lihat Semua Log →</a>
        </div>
        
        <div class="space-y-3">
            
        </div>
    </div>
</div>
