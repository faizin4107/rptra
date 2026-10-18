<div class="space-y-8">
    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
        <h4 class="text-sm font-black text-slate-800 uppercase italic mb-6 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-rose-500 rounded-full shadow-sm shadow-rose-200"></span> 
            Form Pengajuan Mini-CEX Anestesi
        </h4>

        <form action="" method="POST" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-rose-500">I. Identitas Pasien & Kasus</label>
                    <input type="text" name="judul_kasus" placeholder="Judul Kasus (Contoh: Sectio Caesarea)" required
                           class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="diagnosis" placeholder="Diagnosis Medis" required
                           class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-medium">
                </div>
                <div class="space-y-4 pt-6">
                    <select name="id_dpjp" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700">
                        <option value="">-- Pilih DPJP Penguji --</option>
                        @foreach($dpjps as $dpjp)
                            <option value="{{ $dpjp->id }}">{{ $dpjp->fullname }} - {{ $dpjp->id_identitas }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="tgl_ujian" required value="<?= date('Y-m-d') ?>" 
                           class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold">
                </div>
            </div>

            <div class="bg-slate-50 p-6 rounded-[30px] space-y-4">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">II. Komponen Klinis Anestesi</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 mb-2 uppercase italic">Klasifikasi ASA</p>
                        <select name="asa_score" class="w-full border-none rounded-xl px-4 py-3 text-xs font-bold shadow-sm">
                            <option value="ASA 1">ASA 1</option>
                            <option value="ASA 2">ASA 2</option>
                            <option value="ASA 3">ASA 3</option>
                            <option value="ASA 4">ASA 4</option>
                            <option value="ASA 1-E">ASA 1 (Emergency)</option>
                            <option value="ASA 2-E">ASA 2 (Emergency)</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[9px] font-black text-slate-400 mb-2 uppercase italic">Rencana Teknik Anestesi</p>
                        <select name="teknik_anestesi" class="w-full border-none rounded-xl px-4 py-3 text-xs font-bold shadow-sm">
                            <option value="General Anesthesia (Intubasi)">General Anesthesia (Intubasi)</option>
                            <option value="General Anesthesia (LMA)">General Anesthesia (LMA)</option>
                            <option value="Spinal Anesthesia (SAB)">Spinal Anesthesia (SAB)</option>
                            <option value="Epidural Anesthesia">Epidural Anesthesia</option>
                            <option value="Regional Block">Regional Block</option>
                            <option value="MAC (Monitored Anesthesia Care)">MAC</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="border-2 border-dashed border-rose-100 p-6 rounded-[30px] flex gap-4">
                <div class="bg-rose-100 text-rose-500 w-12 h-12 rounded-2xl flex items-center justify-center shrink-0">
                    💡
                </div>
                <div>
                    <h5 class="text-xs font-black text-slate-800 uppercase italic mb-1">Fokus Evaluasi Penguji</h5>
                    <p class="text-[10px] text-slate-500 leading-relaxed">
                        Penguji akan menilai <b>Penalaran Klinis</b> (Pre-op), <b>Keterampilan Teknis</b> (Induksi & Intubasi/Regional), 
                        <b>Informed Consent</b>, dan <b>Manajemen Pasca-Anestesi</b> (Aldrete/Steward Score).
                    </p>
                </div>
            </div>

            <button type="submit" name="ajukan_minicex" class="w-full bg-rose-600 text-white py-6 rounded-[2rem] font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-rose-100 italic">
                Ajukan Penilaian Sekarang →
            </button>
        </form>
    </div>
</div>