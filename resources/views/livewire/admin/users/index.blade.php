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

    <!-- SECTION 1: FORM TAMBAH PENGGUNA -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)] relative overflow-hidden">
        
        <!-- Header Form -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">Tambah Pengguna Baru</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Registrasi Manual Akun Sistem</p>
            </div>
        </div>

        <form wire:submit="store" class="space-y-4 relative z-10">
            @csrf
            
            <!-- Baris 1: Data Utama (3 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" wire:model="form.add_fullname" placeholder="Nama Lengkap"  
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                
                <input type="email" wire:model="form.add_email" placeholder="Alamat Email"  
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                
                <input type="text" wire:model="form.add_username" placeholder="Username / NIM"  
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                <input type="text" wire:model="form.add_id_identitas" placeholder="Identitas ID"  
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
            </div>
                
            <!-- Baris 2: Atribut & Keamanan (4 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <input type="password" wire:model="form.add_password" placeholder="Buat Password"  
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                


                <div class="relative">
                    <select wire:model="form.add_status"  class="w-full appearance-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                        <option value="">-- Status Akun --</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Pending">Pending</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 bg-slate-900 text-white py-3.5 rounded-xl font-bold text-[11px] uppercase tracking-wider hover:bg-indigo-600 active:scale-[0.98] transition-all duration-300 ease-spring group cursor-pointer shadow-[0_4px_14px_0_rgba(0,0,0,0.1)]">
                    <span wire:loading.remove wire:target="store">Simpan Akun</span>
                    <svg wire:loading.remove wire:target="store" class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    
                    <span wire:loading.flex wire:target="store" class="items-center gap-2">
                        <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- SECTION 2: TABEL PENGGUNA & PENCARIAN -->
    <div class="bg-white p-6 sm:p-8 rounded-[35px] border border-slate-200/60 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.04)]">
        
        <!-- Header Tabel & Kolom Pencarian (Digabung) -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none mb-1">Daftar Pengguna</h3>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Kelola Akses & Data Sistem</p>
            </div>
            
            <!-- Pencarian (Modern Search Bar) -->
            <!-- <div class="relative w-full sm:w-72 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live="search" placeholder="Cari nama atau username..." 
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

        <div class="overflow-x-auto"> 
            <x-table :headers="$headers" :rows="$users" paginate>
            
                <!-- Kustomisasi Kolom Role -->
                @interact('column_role', $row)
                <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black uppercase tracking-wider rounded-lg border 
                    {{ $row->role === 'admin' ? 'bg-purple-50 text-purple-700 border-purple-200/60' : 
                      ($row->role === 'dpjp' ? 'bg-sky-50 text-sky-700 border-sky-200/60' : 'bg-slate-100 text-slate-700 border-slate-200') }}">
                    {{ $row->role }}
                </span>
                @endinteract

                <!-- Kustomisasi Kolom Status -->
                @interact('column_status', $row)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider rounded-lg border
                    @if($row->status === 'Aktif') bg-emerald-50 text-emerald-700 border-emerald-200/60
                    @elif($row->status === 'Pending') bg-amber-50 text-amber-700 border-amber-200/60
                    @else bg-rose-50 text-rose-700 border-rose-200/60 @endif">
                    
                    <span class="w-1.5 h-1.5 rounded-full 
                        @if($row->status === 'Aktif') bg-emerald-500
                        @elif($row->status === 'Pending') bg-amber-500
                        @else bg-rose-500 @endif">
                    </span>
                    {{ $row->status }}
                </span>
                @endinteract

                <!-- Kustomisasi Kolom Aksi -->
                @interact('column_action', $row)
                <div class="flex items-center gap-2">
                    
                    <!-- Tombol Edit -->
                    <button type="button" wire:click="openEditModal({{ $row->id }})" 
                        class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-200/60 hover:border-indigo-200 rounded-xl transition-all duration-300 hover:-translate-y-0.5 cursor-pointer shadow-sm" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>

                    <!-- Tombol Delete -->
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
    <x-modal title="Ubah Informasi Akun" id="modal-edit-user" wire="modalEdit" blur size="xl">
        
        <!-- Peningkatan Layout Modal: 2 Kolom untuk menghemat ruang vertikal -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 py-4">
            
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <input type="text" wire:model="form.edit_fullname" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.edit_fullname') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Alamat Email</label>
                <input type="email" wire:model="form.edit_email" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.edit_email') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Username / NIM</label>
                <input type="text" wire:model="form.edit_username" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.edit_username') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Identitas ID</label>
                <input type="text" wire:model="form.edit_id_identitas" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300">
                @error('form.edit_id_identitas') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Password Baru (Opsional)</label>
                <input type="password" wire:model="form.edit_password" placeholder="Kosongkan jika tidak diubah" class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                @error('form.edit_password') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            

            <div class="space-y-1.5 relative">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Status Keaktifan</label>
                <select wire:model="form.edit_status" class="w-full appearance-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                    <option value="">Pilih Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Pending">Pending</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 top-6 flex items-center px-4 text-slate-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                @error('form.edit_status') <p class="text-rose-500 text-[11px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
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

    

</div>