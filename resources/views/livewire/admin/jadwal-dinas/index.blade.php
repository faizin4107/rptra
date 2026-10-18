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
            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">Tambah Jadwal Dinas</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Alokasi Waktu Residen & DPJP</p>
            </div>
        </div>

        <form wire:submit="store" class="relative z-10 space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                <!-- Pilih User (Lebar 4 kolom di Desktop) -->
                <div class="md:col-span-4 relative space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Pilih Dokter / Residen</label>
                    <select wire:model="form.add_dpjp_id" class="w-full appearance-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                        <option value="">-- Pilih User --</option>
                        @foreach ($dpjp as $item)
                            <option value="{{ $item->id }}">{{ $item->fullname }} ({{ strtoupper($item->role) }})</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 top-6 flex items-center px-4 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <!-- Pilih Hari (Lebar 3 kolom di Desktop) -->
                <div class="md:col-span-3 relative space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Hari Dinas</label>
                    <select wire:model="form.add_day" class="w-full appearance-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer bg-none">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Monday">Senin</option>
                        <option value="Tuesday">Selasa</option>
                        <option value="Wednesday">Rabu</option>
                        <option value="Thursday">Kamis</option>
                        <option value="Friday">Jumat</option>
                        <option value="Saturday">Sabtu</option>
                        <option value="Sunday">Minggu</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 top-6 flex items-center px-4 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <!-- Waktu Mulai & Selesai (Digabung dalam 3 kolom) -->
                <div class="md:col-span-3 grid grid-cols-2 gap-3">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Jam Mulai</label>
                        <input type="time" wire:model="form.add_start_time" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-3 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Jam Selesai</label>
                        <input type="time" wire:model="form.add_end_time" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-3 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                    </div>
                </div>

                <!-- Tombol Submit (Lebar 2 Kolom) -->
                <div class="md:col-span-2">
                    <button type="submit" wire:loading.attr="disabled"
                            class="w-full flex items-center justify-center gap-2 bg-slate-900 text-white py-3.5 rounded-xl font-bold text-[11px] uppercase tracking-wider hover:bg-indigo-600 active:scale-[0.98] transition-all duration-300 ease-spring group cursor-pointer shadow-[0_4px_14px_0_rgba(0,0,0,0.1)] disabled:opacity-70 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="store">Simpan</span>
                        <svg wire:loading.remove wire:target="store" class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        
                        <span wire:loading.flex wire:target="store" class="items-center gap-1.5">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
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
            <!-- <div class="relative w-full sm:w-72 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live="search" placeholder="Cari jadwal dpjp..." 
                    class="w-full bg-slate-50/80 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl pl-10 pr-4 py-2.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
            </div> -->
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
        <div class="overflow-x-auto">
            <x-table :headers="$headers" :rows="$jadwals" paginate>
                
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
                @interact('column_user', $row)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-500 shrink-0 shadow-inner">
                        {{ substr($row->dpjp->fullname, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[13px] font-bold text-slate-800 leading-none mb-1.5">{{ $row->dpjp->fullname }}</p>
                        <span class="inline-flex">
                            <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider border 
                                {{ $row->dpjp->role === 'admin' ? 'bg-purple-50 text-purple-700 border-purple-200/60' : 
                                  ($row->dpjp->role === 'dpjp' ? 'bg-sky-50 text-sky-700 border-sky-200/60' : 'bg-slate-50 text-slate-700 border-slate-200') }}">
                                {{ $row->dpjp->role }}
                            </span>
                        </span>
                    </div>
                </div>
                @endinteract


                <!-- Waktu / Jam Dinas -->
                @interact('column_time', $row)
                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[11px] font-black text-slate-600 tracking-widest">
                        {{ \Carbon\Carbon::parse($row->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row->end_time)->format('h:i A') }}
                    </span>
                </div>
                @endinteract

                <!-- Aksi (Hapus Jadwal) -->
                @interact('column_action', $row)
                <div class="flex items-center gap-1.5">
                    <a href="{{ route('admin.jadwal-dinas.residen', ['id' => $row->id, 'dpjp_id' => $row->dpjp_id]) }}" wire:navigate" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/60 hover:border-indigo-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="List">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </a>
                    <button type="button" wire:click="openCreateModal({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/60 hover:border-indigo-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Tambah">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0zM19 11v-3m0 3v3m0-3h-3m3 0h3"></path>
                        </svg>
                    </button>
                    <button type="button" wire:click="openEditModal({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/60 hover:border-indigo-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button type="button" wire:click="confirmDelete({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200/60 hover:border-rose-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
                @endinteract

            </x-table>
        </div>
    </div>

    <!-- SECTION 3: MODAL EDIT -->
    <x-modal title="Ubah Informasi" id="modal-edit-jadwal" wire="modalEdit" blur size="xl">
        
        <!-- Peningkatan Layout Modal: 2 Kolom untuk menghemat ruang vertikal -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 py-4">
            
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama</label>
                <select wire:model="form.edit_dpjp_id" class="w-full appearance-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                    <option value="">-- Pilih User --</option>
                    @foreach ($dpjp as $item)
                        <option value="{{ $item->id }}">{{ $item->fullname }} ({{ strtoupper($item->role) }})</option>
                    @endforeach
                </select>
                @error('form.edit_dpjp_id') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Hari</label>
                <select wire:model="form.edit_day" class="w-full appearance-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer bg-none">
                    <option value="">-- Pilih Hari --</option>
                    <option value="Monday">Senin</option>
                    <option value="Tuesday">Selasa</option>
                    <option value="Wednesday">Rabu</option>
                    <option value="Thursday">Kamis</option>
                    <option value="Friday">Jumat</option>
                    <option value="Saturday">Sabtu</option>
                    <option value="Sunday">Minggu</option>
                </select>
                @error('form.edit_day') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Jam Mulai</label>
                <input type="time" wire:model="form.starttime" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.starttime') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Jam Selesai</label>
                <input type="time" wire:model="form.endtime" placeholder="Kosongkan jika tidak diubah" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                @error('form.endtime') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <x-slot:footer>
            <div class="flex flex-col sm:flex-row justify-end gap-3 w-full">
                <!-- Tombol Batal -->
                <button type="button" wire:click="cancelAction" 
                    class="px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-500 hover:bg-slate-100 transition-colors cursor-pointer">
                    Batal
                </button>
                    
                <!-- Tombol Simpan -->
                <button type="button" wire:click="update" 
                    class="relative flex items-center justify-center bg-slate-900 text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/20 active:scale-[0.98] transition-all duration-300 ease-spring min-w-[180px] cursor-pointer">
                    
                    <span wire:loading.remove wire:target="update">Simpan Perubahan</span>
                    
                    <span wire:loading.flex wire:target="update" class="items-center gap-2">
                        <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </x-slot:footer>
    </x-modal>

    <!-- SECTION 3: MODAL EDIT -->
    


        <!-- Ubah size ke 5xl atau 6xl untuk ruang yang sangat luas -->
    <x-modal title="Tambah Residen ke Jadwal" id="modal-create-jadwal" wire="modalCreate" blur size="5xl">
        <div x-data="{ selected: @entangle('form.users').live || [] }">
            <div class="space-y-6">
                <!-- HEADER: Info & Search -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-slate-800 font-bold text-lg leading-none">Pilih Residen</h3>
                            <p class="text-slate-500 text-xs mt-1">Cari dan pilih residen yang akan bertugas.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <!-- Counter Instan -->
                        <div class="px-4 py-2 bg-white border border-slate-200 rounded-xl shadow-sm">
                            <span class="text-[10px] block text-slate-400 font-black uppercase tracking-widest leading-none mb-1">Terpilih</span>
                            <span x-text="selected ? selected.length : 0" class="text-indigo-600 font-bold text-lg leading-none">
                               0
                            </span>
                        </div>

                        
                        <!-- Search Bar Luas -->
                        <div class="relative min-w-[250px] lg:min-w-[350px]">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="searchResiden" placeholder="Ketik nama residen..." 
                                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none">
                            @if($searchResiden)
                                <button title="Bersihkan" wire:click="$set('searchResiden', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-rose-500 transition-colors">
                                    <svg class="cursor-pointer w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            @endif
                            
                        </div>
                    </div>
                </div>

                <!-- GRID SECTION: Menggunakan 2 Kolom pada layar medium dan tetap lebar -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                   
                    @forelse($users_residen as $row)
                        @php
                            // Cek apakah residen ini sudah ada di database untuk jadwal ini
                            $isAlreadySaved = in_array($row->id, $saved_user_ids);
                        @endphp

                        <label wire:key="residen-{{ $row->id }}" 
                            class="relative group block {{ $isAlreadySaved ? 'cursor-not-allowed opacity-70' : 'cursor-pointer' }}">
                            
                            <!-- Input Checkbox -->
                            <!-- Jika sudah ada, kita paksa 'checked' dan 'disabled' -->
                            <input type="checkbox" 
                                wire:model.live="form.users" 
                                value="{{ $row->id }}" 
                                @if($isAlreadySaved) checked disabled @endif
                                class="sr-only">
                            
                            <!-- CARD CONTAINER -->
                            <div @class([
                                'flex items-center p-4 border-2 rounded-2xl transition-all duration-300',
                                'bg-slate-50 border-slate-200' => $isAlreadySaved, // Warna abu-abu jika sudah ada
                                'bg-white border-slate-100 group-hover:border-indigo-200 group-has-[:checked]:border-indigo-500 group-has-[:checked]:bg-indigo-50/50' => !$isAlreadySaved,
                            ])>
                                
                                <!-- Avatar -->
                                <div @class([
                                    'w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm shrink-0 transition-all',
                                    'bg-slate-200 text-slate-500' => $isAlreadySaved,
                                    'bg-slate-100 text-slate-500 group-has-[:checked]:bg-indigo-600 group-has-[:checked]:text-white' => !$isAlreadySaved,
                                ])>
                                    {{ strtoupper(substr($row->fullname, 0, 2)) }}
                                </div>

                                <!-- Nama & Info -->
                                <div class="ml-4 flex-1">
                                    <h4 @class([
                                        'text-[15px] font-bold leading-tight transition-colors',
                                        'text-slate-400' => $isAlreadySaved,
                                        'text-slate-800 group-has-[:checked]:text-indigo-700' => !$isAlreadySaved,
                                    ])>
                                        {{ $row->fullname }}
                                        @if($isAlreadySaved)
                                            <span class="ml-2 text-[9px] bg-slate-200 text-slate-500 px-2 py-0.5 rounded-full uppercase tracking-tighter">Sudah Terdaftar</span>
                                        @endif
                                    </h4>
                                    <p class="text-[11px] font-medium text-slate-400 mt-1">ID: {{ $row->id_identitas }}</p>
                                </div>

                                <!-- Checkbox Indicator -->
                                <div class="ml-4">
                                    <div @class([
                                        'w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all duration-300',
                                        'bg-slate-300 border-slate-300' => $isAlreadySaved,
                                        'border-slate-200 group-has-[:checked]:bg-indigo-600 group-has-[:checked]:border-indigo-600' => !$isAlreadySaved,
                                    ])>
                                        <svg class="w-3.5 h-3.5 text-white transition-transform duration-300 {{ $isAlreadySaved ? 'scale-100' : 'scale-0 group-has-[:checked]:scale-100' }}" 
                                            fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>
                    @empty
                        <div class="col-span-full py-10 text-center text-slate-400 italic">Residen tidak ditemukan.</div>
                    @endforelse
                </div>
                
                @error('form.users') 
                    <div class="p-3 bg-rose-50 border border-rose-100 rounded-xl flex items-center gap-2 text-rose-600 text-xs font-bold">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div wire:loading wire:target="searchResiden" class="w-full py-4 text-center">
                <div class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-widest">Mencari...</span>
                </div>
            </div>
            <div wire:loading.remove wire:target="searchResiden">
                <div class="grid grid-cols-2 gap-4">
                    @forelse($users_residen as $row)
                        <!-- Konten Card Residen yang tadi kita buat -->
                    @empty
                        <!-- Tampilan jika tidak ada hasil -->
                        <div class="col-span-full py-12 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <p class="text-slate-400 font-medium italic">"{{ $searchResiden }}" tidak ditemukan...</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <x-slot:footer>
                <div class="flex items-center justify-between w-full bg-slate-50/50 -m-4 p-4 mt-4 border-t border-slate-100">
                    <button type="button" wire:click="$set('form.users', [])" class="cursor-pointer text-xs font-black text-rose-500 uppercase tracking-widest hover:text-rose-700 transition-colors">
                        Bersihkan Pilihan
                    </button>

                    <div class="flex gap-3">
                        <button type="button" wire:click="cancelAction" 
                            class="cursor-pointer px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-500 hover:bg-white hover:shadow-sm transition-all border border-transparent hover:border-slate-200">
                            Batal
                        </button>
                            
                        <button type="button" 
                            wire:click="store_residen" 
                            wire:loading.attr="disabled"
                            class="relative overflow-hidden bg-slate-900 text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-600 hover:shadow-xl hover:shadow-indigo-500/30 active:scale-[0.98] transition-all flex items-center justify-center min-w-[220px] disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
                            
                            <!-- Area Teks Normal -->
                            <div wire:loading.remove wire:target="store_residen" class="flex items-center justify-center">
                                <span>Simpan Perubahan</span>
                            </div>

                            <!-- Area Loading: Menggunakan wire:loading.flex agar konsisten -->
                            <div wire:loading.flex wire:target="store_residen" class="items-center justify-center gap-3">
                                <!-- Spinner -->
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <!-- Teks -->
                                <span class="whitespace-nowrap">Memproses...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </x-slot:footer>
        </div>
        
    </x-modal>
</div>