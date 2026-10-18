<div class="space-y-8">
    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
        <h4 class="text-sm font-black text-slate-800 uppercase italic mb-6 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-blue-500 rounded-full shadow-sm shadow-blue-200"></span> 
            Input Logbook Dasar <span class="text-blue-500 font-bold ml-1">(Tahap 1)</span>
        </h4>

        @if(count($stase) > 0)
        <form wire:submit="" class="space-y-6">
            <div class="bg-slate-50 p-6 rounded-3xl border-2 border-dashed border-slate-200">
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">No. Rekam Medis Pasien</label>
                        <input type="text" wire:model="no_rm" name="no_rm" placeholder="00-xx-xx" 
                               class="w-full mt-1 bg-white border-none rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-blue-500 font-mono shadow-sm">
                    </div>
                    <button type="button" onclick="tarikDataSimrs()" class="bg-slate-800 text-white px-8 py-4 rounded-2xl font-bold text-xs uppercase hover:bg-blue-600 transition-all shadow-lg">
                        🔍 Tarik SIMRS
                    </button>
                </div>
                <input type="hidden" id="nama_pasien_hidden" name="nama_pasien_hidden">
                <div id="info_pasien" class="mt-4 text-[11px] text-slate-500 italic px-2">
                    *Gunakan tombol tarik untuk otomatis mengisi data pasien dari database RS.
                </div>
            </div>
        </form>
         <form wire:submit="" enctype="multipart/form-data" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Stase Aktif</label>
                    <select wire:model="id_plotting" class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-blue-600">
                        <option value="">Pilih Stase</option>
                        @foreach($stase as $row)
                        <option value="{{ $row->id }}">{{ $row->master_krs->nama_mk }} - {{ $row->master_krs->kode_mk }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tanggal</label>
                    <input type="date" wire:model="tgl_kegiatan" value="<?= date('Y-m-d') ?>" class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm">
                </div>
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Peran</label>
                    <select wire:model="peran" class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm">
                        <option value="Observasi">Observasi</option>
                        <option value="Asistensi">Asistensi</option>
                        <option value="Mandiri Terpimpin">Mandiri Terpimpin</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Laporan Kegiatan/Tindakan Dasar</label>
                <textarea wire:model="kegiatan" id="kegiatan_area" placeholder="Jelaskan tindakan yang dilakukan..."
                          class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-blue-500 h-32"></textarea>
            </div>

            <div>
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Bukti Foto/Dokumen (Opsional)</label>
                <input type="file" wire:model="bukti_file" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-3xl font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-blue-100">
                Kirim Logbook Dasar →
            </button>
        </form>
        @else:
            <div class="p-10 bg-amber-50 rounded-[32px] border border-amber-100 text-amber-600 text-sm font-bold italic text-center">
                ⚠️ Modul Tahap 1 belum aktif. Selesaikan KRS terlebih dahulu.
            </div>
        @endif
    </div>

    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm overflow-hidden">
        <h4 class="text-sm font-black text-slate-800 uppercase italic mb-6">Riwayat Tindakan Dasar</h4>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-slate-400 uppercase border-b border-slate-50">
                        <th class="pb-4 px-4">Tanggal</th>
                        <th class="pb-4 px-4">Pasien</th>
                        <th class="pb-4 px-4">Detail</th>
                        <th class="pb-4 px-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium">
                   
                </tbody>
            </table>
        </div>
    </div>
</div>