<div class="space-y-6 animate-fade-up">
    <!-- CSS Animasi Kustom -->
    <style>
        .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .ease-spring { transition-timing-function: cubic-bezier(0.25, 1, 0.5, 1); }
    </style>

    <!-- SECTION 1: FORM TAMBAH JADWAL -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] relative overflow-hidden">
    
    <!-- Header Form -->
    <div class="flex items-center gap-3 mb-6">
        <!-- Icon Container -->
        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shadow-inner shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>

        <!-- Text Container -->
        <div>
            <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">Data Residen</h3>
            <p class="text-[11px] font-bold text-slate-600 uppercase tracking-widest leading-none">Peserta residen yang mengikuti jadwal {{ $data->dpjp->fullname }}</p>
            <p class="text-[11px] font-bold text-slate-300 uppercase tracking-widest leading-none mt-1">Hari: {{ $data->day }}</p>
            <p class="text-[11px] font-bold text-slate-300 uppercase tracking-widest leading-none mt-1">Waktu:  {{ $data->start_time }} - {{ $data->end_time }}</p>
        </div>

        <!-- Tombol Kembali (Diletakkan di kanan) -->
        <a href="{{ route('admin.jadwal-dinas') }}" wire:navigate 
           class="ml-auto flex items-center gap-2 px-4 py-2.5 bg-slate-50 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200 hover:border-indigo-200 rounded-xl transition-all duration-300 group shadow-sm cursor-pointer">
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-[10px] font-black uppercase tracking-[0.15em]">Kembali</span>
        </a>
    </div>
    
    <!-- Isi Konten Selanjutnya -->
    <div class="space-y-4">
        <!-- List Data Residen Disini -->
    </div>
</div>

    <!-- SECTION 2: TABEL JADWAL AKTIF -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] overflow-hidden">
        
        <!-- Header Tabel & Kolom Pencarian -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">Daftar Jadwal Aktif</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Jadwal Tugas Harian</p>
            </div>
            
            <!-- Pencarian Terintegrasi -->
            <div class="relative w-full sm:w-72 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live="search" placeholder="Cari jadwal residen..." 
                    class="w-full bg-slate-50/80 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl pl-10 pr-4 py-2.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <x-table :headers="$headers" :rows="$users" paginate>
                
                <!-- Info Pengguna (Nama & Role) -->
                @interact('column_day', $row)
                @php
                    $daftarHari = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu'
                    ];
                @endphp

                {{ $daftarHari[$row->day] ?? $row->day }}
                @endinteract
                @interact('column_residen.fullname', $row)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-500 shrink-0 shadow-inner">
                        {{ substr($row->residen->fullname, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[13px] font-bold text-slate-800 leading-none mb-1.5">{{ $row->residen->fullname }}</p>
                        <span class="inline-flex">
                            <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider border 
                                {{ $row->residen->role === 'admin' ? 'bg-purple-50 text-purple-700 border-purple-200/60' : 
                                  ($row->residen->role === 'dpjp' ? 'bg-sky-50 text-sky-700 border-sky-200/60' : 'bg-slate-50 text-slate-700 border-slate-200') }}">
                                {{ $row->residen->role }}
                            </span>
                        </span>
                    </div>
                </div>
                @endinteract


                <!-- Aksi (Hapus Jadwal) -->
                @interact('column_action', $row)
                <div class="flex items-center gap-1.5">
                    <button type="button" wire:click="confirmDelete({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200/60 hover:border-rose-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Hapus Jadwal">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
                @endinteract
                
            </x-table>
        </div>
    </div>

    
</div>