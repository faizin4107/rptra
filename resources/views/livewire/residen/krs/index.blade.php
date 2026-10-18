<div class="space-y-8">
    <div class="gradient-purple p-8 rounded-[40px] text-white shadow-xl shadow-indigo-100 flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h2 class="text-2xl font-black italic uppercase">Pengisian KRS</h2>
            <p class="text-indigo-100 text-sm">Kurikulum Anestesiologi & Terapi Intensif <span class="font-bold underline">Semester 1</span></p>
        </div>
        <form action="" method="POST" onsubmit="return confirm('Ambil semua modul untuk semester ini?')">
            <button type="submit" name="ambil_paket" class="bg-white text-indigo-600 px-6 py-3 rounded-2xl font-black text-xs uppercase hover:bg-slate-900 hover:text-white transition-all shadow-lg flex items-center gap-2">
                📦 Ambil Paket Semester 1
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm sticky top-8">
                <h4 class="text-sm font-black text-slate-800 uppercase italic mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-indigo-600 rounded-full"></span> Tambah Modul Satuan
                </h4>
                <form wire:submit="store" class="space-y-4">
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Cari Modul</label>
                        <select wire:model="form.master_krs_id" class="w-full mt-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700">
                            <option value="">-- Pilih Modul --</option>
                            @foreach($master_krs as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_mk }} - {{ $row->kode_mk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="cursor-pointer w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-sm hover:bg-indigo-600 transition-all shadow-lg uppercase italic">
                        Tambah Ke Rencana
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-sm font-black text-slate-800 uppercase italic flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span> Modul Terdaftar
                    </h4>
                    
                    <a href="cetak_krs.php" target="_blank" class="bg-slate-50 text-slate-400 px-4 py-2 rounded-xl font-bold text-[10px] uppercase hover:bg-indigo-600 hover:text-white transition-all flex items-center gap-2 border border-slate-100">
                            🖨️ Cetak KRS
                        </a>
                </div>

                <div class="overflow-x-auto">
                    <x-table :headers="$headers" :rows="$moduls" paginate>
                
                        <!-- Kolom: Kode & Nama Modul -->
                        @interact('column_modul', $row)
                        <div class="flex flex-col space-y-0.5 py-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $row->master_krs->kode_mk }}</p>
                            <p class="text-[13px] font-bold text-slate-800">{{ $row->master_krs->nama_mk }}</p>
                        </div>
                        @endinteract

                        <!-- Kolom: Semester & SKS -->
                        @interact('column_semester_sks', $row)
                        <div class="flex items-center gap-1.5">
                            <span class="bg-slate-100 border border-slate-200 text-slate-600 px-2.5 py-1 rounded-md text-[9px] font-black uppercase">Sem {{ $row->master_krs->semester }}</span>
                            <span class="bg-indigo-50 border border-indigo-100 text-indigo-600 px-2.5 py-1 rounded-md text-[9px] font-black uppercase">{{ $row->master_krs->sks }} SKS</span>
                        </div>
                        @endinteract

                        <!-- Kolom: Kompetensi (AK) -->
                        @interact('column_status', $row)
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                            @if($row->status === 'Disetujui')
                                <svg class="w-4 h-4 text-emerald-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-[11px] font-black text-slate-600 tracking-widest">
                                    Sukses
                                </span>
                            @elseif($row->status === 'Ditolak') 
                                <svg class="w-4 h-4 text-emerald-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="text-[11px] font-black text-slate-600 tracking-widest">
                                    Ditolak
                                </span>
                            @else 
                                <svg class="w-4 h-4 text-amber-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-[11px] font-black text-slate-600 tracking-widest">
                                    Pending
                                </span>
                            @endif
                        </div>
                        
                        @endinteract
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</div>