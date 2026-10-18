<div class="space-y-6 animate-fade-up">
    <!-- CSS Animasi Kustom -->
    <style>
        .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .ease-spring { transition-timing-function: cubic-bezier(0.25, 1, 0.5, 1); }
    </style>

    <!-- SECTION 1: HEADER & FILTER (Terpadu) -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-20">
        
        <!-- Title Section -->
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-slate-50 text-slate-600 rounded-2xl flex items-center justify-center shadow-inner border border-slate-100 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none mb-1.5">Audit Trail</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Monitoring Validitas & Aktivitas</p>
            </div>
        </div>

        <!-- Filter Form -->
        <form wire:submit.prevent="search" class="flex flex-wrap lg:flex-nowrap items-center gap-3">
            
            <div class="relative w-full sm:w-auto">
                <input type="date" wire:model="date" 
                    class="w-full bg-slate-50/80 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-2.5 text-[13px] font-semibold text-slate-700 outline-none transition-all duration-300">
            </div>
            
            <div class="relative w-full sm:w-auto group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model="user" placeholder="Cari Nama / Role..." 
                    class="w-full bg-slate-50/80 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl pl-9 pr-4 py-2.5 text-[13px] font-semibold text-slate-700 outline-none transition-all duration-300 placeholder:font-medium placeholder-slate-400">
            </div>
            
            <!-- Actions -->
            <div class="flex items-center gap-2 w-full sm:w-auto mt-2 sm:mt-0">
                <button type="submit" class="flex-1 sm:flex-none flex items-center justify-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-wider hover:bg-indigo-600 active:scale-[0.98] transition-all duration-300 ease-spring shadow-[0_4px_14px_0_rgba(0,0,0,0.1)] cursor-pointer min-w-[100px]">
                    <span wire:loading.remove wire:target="search">Filter</span>
                    <span wire:loading.flex wire:target="search" class="items-center gap-1.5">
                        <svg class="animate-spin w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </span>
                </button>
                <button type="button" wire:click="resetSearch" class="flex-1 sm:flex-none bg-rose-50 text-rose-600 border border-rose-200/60 hover:bg-rose-500 hover:text-white px-5 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-wider active:scale-[0.98] transition-all duration-300 ease-spring cursor-pointer">
                    Reset
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION 2: STAT CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 relative z-10">
        <!-- Card 1: Total Aktivitas -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-[0_2px_10px_-3px_rgba(79,70,229,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(79,70,229,0.1)] transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up delay-100">
            <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 ease-out"></div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50/80 text-indigo-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 ease-spring">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Total Aktivitas</p>
                    <h4 class="text-2xl font-black text-slate-800 tracking-tight leading-none">{{ $total_logs }} <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider ml-1">Entries</span></h4>
                </div>
            </div>
        </div>

        <!-- Card 2: Peringatan SIMRS -->
        <div class="bg-rose-50 rounded-3xl p-6 border border-rose-100 shadow-[0_2px_10px_-3px_rgba(244,63,94,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(244,63,94,0.1)] hover:bg-rose-100/50 transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up delay-200">
            <div class="absolute top-0 left-0 w-full h-1 bg-rose-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 ease-out"></div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-rose-200/50 text-rose-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 ease-spring">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-rose-500 uppercase tracking-widest leading-none mb-1.5">Integrasi SIMRS</p>
                    <h4 class="text-2xl font-black text-rose-700 tracking-tight leading-none">10 <span class="text-[11px] text-rose-500 font-bold uppercase tracking-wider ml-1">Peringatan</span></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: TABLE LOGS -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] overflow-hidden min-h-[400px]">
        <div class="overflow-x-auto relative">
            <x-table :headers="$headers" :rows="$logs" paginate>
                
                <!-- Info Pengguna (Nama & Role) -->
                @interact('column_user', $row)
                <div class="flex items-center gap-3">
                    <div class="flex flex-col">
                        @if(!empty($row->user_id))
                        <p class="text-[13px] font-bold text-slate-800 leading-none mb-1.5">{{ $row->user->fullname }}</p>
                        <span class="inline-flex">
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-md text-[9px] font-black uppercase tracking-wider border border-indigo-100/50">
                                {{ $row->user->role }}
                            </span>
                        </span>
                        @elseif(!empty($row->residen_id))
                        <p class="text-[13px] font-bold text-slate-800 leading-none mb-1.5">{{ $row->residen->fullname }}</p>
                        <span class="inline-flex">
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-md text-[9px] font-black uppercase tracking-wider border border-indigo-100/50">
                                {{ $row->residen->role }}
                            </span>
                        </span>
                        @elseif(!empty($row->dpjp_id)) 
                        <p class="text-[13px] font-bold text-slate-800 leading-none mb-1.5">{{ $row->dpjp->fullname }}</p>
                        <span class="inline-flex">
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-md text-[9px] font-black uppercase tracking-wider border border-indigo-100/50">
                                {{ $row->dpjp->role }}
                            </span>
                        </span>
                        @endif
                    </div>
                </div>
                @endinteract

                <!-- Log Aktivitas & Waktu -->
                @interact('column_activity', $row)
                <div class="flex flex-col max-w-sm">
                    <p class="text-[13px] text-slate-700 font-medium leading-relaxed">{{ $row->activity }}</p>
                    <div class="flex items-center gap-1.5 mt-1 text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-[10px] font-semibold italic"><?= date('d M Y, H:i:s', strtotime($row->created_at)) ?></p>
                    </div>
                </div>
                @endinteract

                <!-- Aksi (Hapus Log) -->
                @interact('column_action', $row)
                <div class="flex items-center gap-1.5">
                    <button type="button" wire:click="confirmDelete({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200/60 hover:border-rose-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Hapus Log Aktivitas">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
                @endinteract
            </x-table>
        </div>
    </div>
</div>