<div class="animate-fade-up">
    <!-- Header Section -->
    <div class="flex flex-col items-center mb-8">
        <div class="w-20 h-20 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] flex items-center justify-center p-3 mb-5 border border-slate-100 transition-transform hover:scale-105 duration-500 ease-spring">
            <img src="/assets/img/13297903.png" alt="Logo RS Depok" class="max-w-full max-h-full object-contain">
        </div>
        
        <div class="text-center space-y-1">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">
                Pendaftaran Akun Baru
            </p>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                Registrasi <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">Residen</span>
            </h1>
        </div>
    </div>

    <!-- Register Card -->
    <div class="bg-white/80 backdrop-blur-xl p-8 sm:p-10 rounded-3xl shadow-[0_8px_40px_-12px_rgba(0,0,0,0.1)] border border-slate-200/60 relative overflow-hidden">
        
        <!-- Subtle Background Glow -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-400/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-400/10 rounded-full blur-2xl"></div>

        <form wire:submit="register" class="space-y-4 relative z-10">
            @csrf
            
            <!-- Field Nama Lengkap -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Nama Lengkap</label>
                <input type="text" wire:model="form.fullname"  
                    placeholder="Contoh: dr. Budi Santoso" 
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                @error('form.fullname')
                    <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid 2 Kolom untuk Identitas & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Field Identitas Baru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">No. Identitas</label>
                    <input type="text" id="id_identitas" wire:model="form.id_identitas"  
                        placeholder="KTP / NIK / SIP" 
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                    @error('form.id_identitas')
                        <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Field Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Alamat Email</label>
                    <input type="email" wire:model="form.email"  
                        placeholder="nama@email.com" 
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                    @error('form.email')
                        <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
            </div>

            <!-- Grid 2 Kolom untuk Username & Role -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Field Username -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Username</label>
                    <input type="text" wire:model="form.username"  
                        placeholder="Masukkan username" 
                        class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                    @error('form.username')
                        <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Field Role (Select) -->
                <div class="space-y-1.5 relative">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Pilih Role</label>
                    <!-- Ditambahkan bg-none untuk menghindari panah ganda dari Tailwind -->
                    <select wire:model="form.role" 
                        value="residen"
                        class="w-full appearance-none bg-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                        
                        <option value="residen">Residen</option>
                        <option value="dpjp">DPJP</option>
                    </select>
                    <!-- Custom Arrow Icons -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 top-6 flex items-center px-4 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Field Password -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Buat Password</label>
                <input type="password" wire:model="form.password"  
                    placeholder="Minimal 8 karakter" 
                    class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300">
                @error('form.password')
                    <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button with Clean Solid State -->
            <div class="pt-6">
                <button type="submit" wire:loading.attr="disabled"
                        class="cursor-pointer w-full relative flex items-center justify-center bg-slate-900 text-white py-3.5 rounded-xl font-bold text-sm hover:bg-indigo-600 active:scale-[0.98] transition-all duration-300 group disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden">
                    
                    <!-- Default State -->
                    <div wire:loading.remove wire:target="register" class="flex items-center gap-2">
                        <span class="tracking-wide">Kirim Permohonan Daftar</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-y-1 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>

                    <!-- Loading State -->
                    <div wire:loading.flex wire:target="register" class="items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="tracking-wide">Memproses...</span>
                    </div>
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center pt-2">
                <p class="text-[13px] text-slate-500 font-medium">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" wire:navigate class="!no-underline cursor-pointer text-indigo-600 font-bold hover:text-indigo-700 hover:underline decoration-2 underline-offset-4 transition-all ml-1">
                        Login Disini
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Footer Minimalis -->
    <div class="mt-10 flex flex-col items-center gap-3">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] text-center">
            &copy; FAD 2026 SINAR - RS Pendidikan
        </p>
        <div class="flex gap-2.5">
            <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
            <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full shadow-[0_0_8px_rgba(129,140,248,0.8)]"></span>
            <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
        </div>
    </div>
</div>