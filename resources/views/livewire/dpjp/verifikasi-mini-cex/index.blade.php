<div>
    <div class="space-y-6">
        <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-sm font-black text-slate-800 uppercase italic flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-rose-500 rounded-full"></span> Panel Penilaian Mini-CEX Anestesi
                </h4>
                <span class="bg-rose-50 text-rose-500 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                    Antrean: 
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-4">
                            <th class="pb-2 pl-6">Residen & Kasus</th>
                            <th class="pb-2">Detail Klinis Anestesi</th>
                            <th class="pb-2 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalPenilaian" class="hidden fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-[40px] p-10 shadow-2xl">
            <form action="" method="POST" class="space-y-6">
                <input type="hidden" name="id_evaluasi" id="modal_id">
                
                <div class="mb-4">
                    <h3 class="text-xl font-black text-slate-800 italic" id="modal_nama">Penilaian Residen</h3>
                    <p class="text-xs text-rose-500 font-bold uppercase tracking-widest" id="modal_kasus">Kasus Anestesi</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">1. Penalaran Klinis (Pre-Op)</label>
                        <input type="number" name="skor_penalaran" min="0" max="100" required placeholder="0-100"
                            class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm font-bold focus:ring-2 focus:ring-rose-500">
                    </div>
                    <div>
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">2. Keterampilan Teknis (Intra-Op)</label>
                        <input type="number" name="skor_teknis" min="0" max="100" required placeholder="0-100"
                            class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm font-bold focus:ring-2 focus:ring-rose-500">
                    </div>
                    <div>
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">3. Komunikasi & Informed Consent</label>
                        <input type="number" name="skor_komunikasi" min="0" max="100" required placeholder="0-100"
                            class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm font-bold focus:ring-2 focus:ring-rose-500">
                    </div>
                    <div>
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">4. Profesionalisme</label>
                        <input type="number" name="skor_profesionalisme" min="0" max="100" required placeholder="0-100"
                            class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm font-bold focus:ring-2 focus:ring-rose-500">
                    </div>
                </div>

                <div>
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Umpan Balik Konstruktif</label>
                    <textarea name="feedback" required placeholder="Tulis catatan evaluasi untuk residen..."
                            class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-rose-500 h-24"></textarea>
                </div>

                <div class="flex gap-4">
                    <button type="button" onclick="tutupModal()" class="flex-1 bg-slate-100 text-slate-400 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-200 transition-all">Batal</button>
                    <button type="submit" name="simpan_nilai_minicex" class="flex-[2] bg-rose-600 text-white py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg shadow-rose-100 hover:bg-slate-900 transition-all">Simpan Penilaian</button>
                </div>
            </form>
        </div>
    </div>
</div>
