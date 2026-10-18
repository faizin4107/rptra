<div class="animate-fade-up">
    <!-- CSS Animasi Kustom -->
    <style>
        .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .ease-spring { transition-timing-function: cubic-bezier(0.25, 1, 0.5, 1); }
    </style>

    <div class="bg-white p-6 sm:p-8 rounded-[35px] shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] border border-slate-200/60 relative overflow-hidden">
        
        <!-- Ambient Glow (Opsional untuk kesan premium) -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>

        <!-- Header Tabel & Search Bar -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-5 mb-8 relative z-10">
            
            <!-- Judul & Deskripsi -->
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-inner border border-emerald-100/50 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none mb-1.5">Verifikasi Akun Baru</h3>
                    <p class="text-xs font-medium text-slate-500">Tinjau dan berikan akses untuk pendaftar sistem.</p>
                </div>
            </div>

            <!-- Pencarian -->
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

        <!-- Tabel Data -->
        <div class="overflow-x-auto relative z-10">
            <x-table :headers="$headers" :rows="$users" paginate>
            
                <!-- Kustomisasi Kolom Role -->
                @interact('column_role', $row)
                <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black uppercase tracking-wider rounded-lg border 
                    {{ $row->role === 'admin' ? 'bg-purple-50 text-purple-700 border-purple-200/60' : 
                      ($row->role === 'dpjp' ? 'bg-sky-50 text-sky-700 border-sky-200/60' : 'bg-slate-100 text-slate-700 border-slate-200') }}">
                    {{ $row->role }}
                </span>
                @endinteract

                <!-- Kustomisasi Kolom Aksi Manajemen -->
                @interact('column_action', $row)
                <div class="flex items-center gap-2">
                    
                    <!-- Tombol Setujui Akun Interaktif -->
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
                    
                    <!-- (Opsional) Tombol Tolak jika nanti dibutuhkan -->
                    <!-- 
                    <button type="button" class="p-2.5 text-slate-400 hover:text-rose-500 hover:bg-rose-50 border border-slate-200 hover:border-rose-200 rounded-xl transition-all duration-300 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    -->
                </div>
                @endinteract
            </x-table>
        </div>
    </div>
</div>