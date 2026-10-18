<x-slot:title>
    {{ $title }}
</x-slot:title>
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


    <!-- SECTION 2: TABEL PENGGUNA & PENCARIAN -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)]">
        
        <!-- Header Tabel & Kolom Pencarian (Digabung) -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">{{ $title }}</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Data Reservasi</p>
            </div>
            
            <div class="relative w-full sm:w-72 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <!-- Ikon Kaca Pembesar (Hilang saat loading) -->
                    <svg wire:loading.remove wire:target="search" 
                        class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>

                    <!-- Ikon Spinner Loading (Hanya muncul saat loading search) -->
                    <svg wire:loading wire:target="search" 
                        class="animate-spin w-4 h-4 text-indigo-500" 
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <!-- Tambahkan debounce agar loading tidak terlalu sering berkedip -->
                <input type="text" 
                    wire:model.live.debounce.300ms="search" 
                    placeholder="Cari data..." 
                    class="w-full bg-slate-50/80 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl pl-10 pr-4 py-2.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                @if($search)
                    <button wire:click="$set('search', '')" 
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-rose-500 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto"> 
            <x-table :headers="$headers" :rows="$reservations" paginate>
            
                @interact('column_tujuan', $row)
                <span class="max-w-[250px] sm:max-w-sm whitespace-normal break-words line-clamp-2 text-slate-600 leading-relaxed">
                    {{ $row->tujuan }}
                </span>
                @endinteract

                @interact('column_tanggal', $row)
                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[11px] font-black text-slate-600 tracking-widest">
                        {{ \Carbon\Carbon::parse($row->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </span>
                </div>
                @endinteract

                @interact('column_waktu', $row)
                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[11px] font-black text-slate-600 tracking-widest">
                        {{ $row->waktu }}
                    </span>
                </div>
                @endinteract

                <!-- Kustomisasi Kolom Status -->
                @interact('column_status', $row)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider rounded-lg border
                    @if($row->status === 'Aktif') bg-emerald-50 text-emerald-700 border-emerald-200/60
                    @elif($row->status === 'Pending') bg-amber-50 text-amber-700 border-amber-200/60
                    @else bg-rose-50 text-rose-700 border-rose-200/60 @endif">
                    
                    <span class="w-1.5 h-1.5 rounded-full 
                        @if($row->status === 'booking') bg-emerald-500
                        @elif($row->status === 'selesai') bg-amber-500
                        @else bg-rose-500 @endif">
                    </span>
                    {{ $row->status }}
                </span>
                @endinteract

                <!-- Kustomisasi Kolom Aksi -->
                @interact('column_action', $row)
                <div class="flex items-center gap-2">
                    
                    @if($row->status == 'pending')
                    <button type="button" 
                            wire:click="confirmApprove({{ $row->id }})" 
                            wire:loading.attr="disabled"
                            class="group relative flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-600 hover:border-emerald-500 hover:bg-emerald-500 hover:text-white px-4 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-wider transition-all duration-300 ease-spring shadow-sm hover:shadow-[0_4px_12px_rgba(16,185,129,0.2)] active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
                        
                        <!-- State Default (Belum diklik) -->
                        <span wire:loading.remove wire:target="confirmApprove({{ $row->id }})" class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Setujui
                        </span>

                        <!-- State Loading (Saat diproses) -->
                        <span wire:loading.flex wire:target="confirmApprove({{ $row->id }})" class="items-center gap-1.5">
                            <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Memproses
                        </span>
                    </button>
                    @endif
                    @if($row->status == 'selesai')
                    <button type="button" wire:click="confirmDelete({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200/60 hover:border-rose-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                    @endif
                    
                </div>
                @endinteract
            </x-table>
        </div>
    </div>
</div>