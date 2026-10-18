<div class="space-y-6 animate-fade-up">
    <!-- CSS Animasi Kustom -->
    <style>
        .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .ease-spring { transition-timing-function: cubic-bezier(0.25, 1, 0.5, 1); }
        
        /* Menyembunyikan panah up/down default pada input type number */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
    </style>

    <!-- SECTION 1: FORM TAMBAH MODUL -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] relative overflow-hidden">
        
        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shadow-inner border border-indigo-100/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">Tambah Modul Kurikulum</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Database Mata Kuliah & Kompetensi</p>
            </div>
        </div>

        <form wire:submit="store" class="relative z-10 space-y-6">
            <!-- Grid Atas: Info Dasar Modul -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                
                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Kode Modul</label>
                    <input type="text" wire:model="form.add_kode_modul" placeholder="Contoh: AN-001"  
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 uppercase placeholder:normal-case outline-none transition-all duration-300">
                </div>

                <div class="md:col-span-5 space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Modul</label>
                    <input type="text" wire:model="form.add_nama_modul" placeholder="Masukkan nama modul..."  
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                </div>

                <!-- Input Type Number dengan Validasi >= 1 -->
                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 block text-center">Semester</label>
                    <input type="number" wire:model="form.add_semester" min="1" max="14" oninput="if(this.value !== '' && this.value < 1) this.value = '';"
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 text-center outline-none transition-all duration-300">
                </div>
                
                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1 block text-center">Bobot SKS</label>
                    <input type="number" wire:model="form.add_sks" min="1" max="20" oninput="if(this.value !== '' && this.value < 1) this.value = '';"
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 text-center outline-none transition-all duration-300">
                </div>
            </div>

            <!-- Pemetaan Kompetensi (Modern Toggle Design) -->
            <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-200/80">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3 ml-1">Pemetaan Kompetensi (Checklist ASA)</p>
                <div class="flex flex-wrap gap-3">
                    @for($i = 1; $i <= 7; $i++)
                        <label wire:key="checkbox-add-asa-{{ $i }}" class="relative flex items-center cursor-pointer group">
                            <!-- Hidden Native Checkbox -->
                            <input type="checkbox" wire:model="form.add_asa{{ $i }}" value="asa{{ $i }}" class="peer sr-only">
                            <!-- Custom Label Box -->
                            <div class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-400 uppercase tracking-wider transition-all duration-200 ease-spring peer-checked:bg-indigo-50 peer-checked:text-indigo-600 peer-checked:border-indigo-300 peer-checked:shadow-sm group-hover:border-indigo-200">
                                ASA-{{ $i }}
                            </div>
                            <!-- Ceklis Indicator (Muncul saat aktif) -->
                            <div class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-indigo-500 text-white rounded-full flex items-center justify-center scale-0 peer-checked:scale-100 transition-transform duration-300 ease-spring shadow-sm">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </label>
                    @endfor
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" wire:loading.attr="disabled"
                class="w-full flex items-center justify-center gap-2 bg-slate-900 text-white py-4 rounded-xl font-bold text-[11px] uppercase tracking-wider hover:bg-indigo-600 active:scale-[0.98] transition-all duration-300 ease-spring group cursor-pointer shadow-[0_4px_14px_0_rgba(0,0,0,0.1)] disabled:opacity-70 disabled:cursor-not-allowed">
                
                <span wire:loading.remove wire:target="store">Simpan Modul Ke Database</span>
                <svg wire:loading.remove wire:target="store" class="w-4 h-4 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                
                <span wire:loading.flex wire:target="store" class="items-center gap-1.5">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Menyimpan...
                </span>
            </button>
        </form>
    </div>

    <!-- SECTION 2: TABEL DAFTAR MODUL -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] overflow-hidden">
        
        <!-- Header Tabel & Kolom Pencarian -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-3">
                    <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none">Daftar Master Modul</h3>
                    <span class="px-2.5 py-0.5 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                        Total: {{ $total_modul }}
                    </span>
                </div>
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
            <x-table :headers="$headers" :rows="$master_modul" paginate>
                
                <!-- Kolom: Kode & Nama Modul -->
                @interact('column_modul', $row)
                <div class="flex flex-col space-y-0.5 py-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $row->kode_modul }}</p>
                    <p class="text-[13px] font-bold text-slate-800">{{ $row->nama_modul }}</p>
                </div>
                @endinteract

                <!-- Kolom: Semester & SKS -->
                @interact('column_semester_sks', $row)
                <div class="flex items-center gap-1.5">
                    <span class="bg-slate-100 border border-slate-200 text-slate-600 px-2.5 py-1 rounded-md text-[9px] font-black uppercase">Sem {{ $row->semester }}</span>
                    <span class="bg-indigo-50 border border-indigo-100 text-indigo-600 px-2.5 py-1 rounded-md text-[9px] font-black uppercase">{{ $row->sks }} SKS</span>
                </div>
                @endinteract

                <!-- Kolom: Kompetensi (AK) -->
                @interact('column_kompetensi', $row)
                <div class="flex flex-wrap gap-1">
                    @for($i = 1; $i <= 7; $i++)
                        @php
                            $fieldName = 'asa' . $i;
                            $isActive = $row->$fieldName == 1;
                        @endphp
                        <span class="w-[22px] h-[22px] flex items-center justify-center rounded-[5px] text-[8px] font-black transition-colors {{ $isActive ? 'bg-indigo-500 text-white shadow-sm' : 'bg-slate-50 border border-slate-200 text-slate-300' }}" title="ASA-{{ $i }}">
                            {{ $i }}
                        </span>
                    @endfor
                </div>
                @endinteract
           
                <!-- Kolom: Aksi -->
                @interact('column_action', $row)
                <div class="flex items-center gap-1.5">
                    <button type="button" wire:click="openEditModal({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/60 hover:border-indigo-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Edit Modul">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>

                    <button type="button" wire:click="confirmDelete({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200/60 hover:border-rose-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Hapus Modul">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
                @endinteract
            </x-table>
        </div>
    </div>

    <!-- SECTION 3: MODAL EDIT -->
    <x-modal title="Ubah Informasi Modul" id="modal-edit-modul" wire="modalEdit" blur size="xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 py-4">
            
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Kode MK</label>
                <input type="text" wire:model="form.edit_kode_modul" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 uppercase outline-none transition-all duration-300">
                @error('form.edit_kode_modul') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama MK</label>
                <input type="text" wire:model="form.edit_nama_modul" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.edit_nama_modul') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="space-y-1.5 relative">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Semester</label>
                <select wire:model="form.edit_semester" class="w-full appearance-none bg-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                    <option value="">Pilih Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">Semester {{ $i }}</option>
                    @endfor
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 top-6 flex items-center px-4 text-slate-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                @error('form.edit_semester') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Bobot SKS</label>
                <!-- Validasi angka >= 1 di modal Edit -->
                <input type="number" wire:model="form.edit_sks" min="1" max="20" oninput="if(this.value !== '' && this.value < 1) this.value = '';" 
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.edit_sks') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kompetensi di Modal Edit (Full Width) -->
            <div class="sm:col-span-2 space-y-2 mt-2">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Pemetaan Kompetensi</label>
                <div class="flex flex-wrap gap-2.5 bg-slate-50/50 p-4 rounded-2xl border border-slate-200/80">
                    @for($i = 1; $i <= 7; $i++)
                        <label wire:key="checkbox-edit-asa-{{ $i }}" class="relative flex items-center cursor-pointer group">
                            <input type="checkbox" wire:model="form.edit_asa{{ $i }}" value="asa{{ $i }}" class="peer sr-only">
                            <div class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-[11px] font-bold text-slate-400 uppercase tracking-wider transition-all duration-200 ease-spring peer-checked:bg-indigo-50 peer-checked:text-indigo-600 peer-checked:border-indigo-300 peer-checked:shadow-sm">
                                ASA-{{ $i }}
                            </div>
                        </label>
                    @endfor
                </div>
            </div>
        </div>

        <x-slot:footer>
            <div class="flex flex-col sm:flex-row justify-end gap-3 w-full">
                <button type="button" wire:click="cancelAction" 
                    class="cursor-pointer px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-500 hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                    
                <button type="button" wire:click="update" 
                    class="cursor-pointer relative flex items-center justify-center bg-slate-900 text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/20 active:scale-[0.98] transition-all duration-300 ease-spring min-w-[180px]">
                    
                    <span wire:loading.remove wire:target="update">Simpan Perubahan</span>
                    <span wire:loading.flex wire:target="update" class="items-center gap-2">
                        <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>