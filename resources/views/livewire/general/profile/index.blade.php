<div class="max-w-4xl mx-auto">
    

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-[35px] border border-slate-100 shadow-sm flex flex-col items-center text-center">
            <div class="w-24 h-24 gradient-purple rounded-[30px] flex items-center justify-center text-3xl text-white font-bold mb-4 shadow-lg shadow-indigo-100">
               {{ $user->fullname }}
            </div>
            <h3 class="font-black text-slate-800 text-lg uppercase italic tracking-tighter leading-tight">{{ $user->fullname }}</h3>
            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-full mt-2 uppercase tracking-widest">{{ $user->role }}</span>
            
            <div class="w-full mt-8 pt-8 border-t border-slate-50 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Username</span>
                    <span class="text-sm font-semibold text-slate-700">{{ $user->username }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-bold text-slate-400 uppercase">ID Identitas</span>
                    <span class="text-sm font-semibold text-slate-700">{{ $user->id_identitas }}</span>
                </div>
            </div>
        </div>

        <div class="md:col-span-2 bg-white p-8 rounded-[35px] border border-slate-100 shadow-sm">
            <h4 class="text-sm font-black text-slate-800 uppercase italic tracking-wider mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-indigo-600 rounded-full"></span> Keamanan Akun
            </h4>

            <form wire:submit="update" class="space-y-5">
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-2">Password Saat Ini</label>
                    <input type="password" wire:model="form.old_password" 
                        class="w-full mt-1 bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-2xl px-5 py-4 text-sm focus:ring-4 focus:ring-indigo-50 transition-all font-semibold outline-none" 
                        placeholder="Masukkan password lama">
                    @error('form.old_password')
                        <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-2">Password Baru</label>
                        <input type="password" wire:model="form.new_password"  
                            class="w-full mt-1 bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-2xl px-5 py-4 text-sm focus:ring-4 focus:ring-indigo-50 transition-all font-semibold outline-none" 
                            placeholder="Min. 8 karakter">
                        @error('form.new_password')
                            <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-2">Konfirmasi Baru</label>
                        <input type="password" wire:model="form.new_password_confirmation" 
                            class="w-full mt-1 bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-2xl px-5 py-4 text-sm focus:ring-4 focus:ring-indigo-50 transition-all font-semibold outline-none" 
                            placeholder="Ulangi password baru">
                        @error('form.new_password_confirmation')
                            <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" 
                    class="cursor-pointer w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-xs hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 mt-4 uppercase italic tracking-wider">
                    Update Password Sekarang
                </button>
            </form>
        </div>
    </div>
</div>