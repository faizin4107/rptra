<div>
    <!-- Logo & Header Section -->
    <div class="flex flex-col items-center mb-8">
        <div class="w-20 h-20 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] flex items-center justify-center p-3 mb-5 border border-slate-100 transition-transform hover:scale-105 duration-500 ease-spring">
            <img src="/assets/img/13297903.png" alt="Logo RS Depok" class="max-w-full max-h-full object-contain">
        </div>
        <div class="text-center space-y-1">
            <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Sistem Informasi</h2>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                Residen <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">Academy</span>
            </h1>
        </div>
    </div>

    <!-- Login Card -->
    <div class="bg-white/80 backdrop-blur-xl p-8 sm:p-10 rounded-3xl shadow-[0_8px_40px_-12px_rgba(0,0,0,0.1)] border border-slate-200/60 relative overflow-hidden">
        
        <!-- Error Message Global -->
        @error('login_failed')
            <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm font-medium mb-6 border border-rose-100 flex items-start gap-3 animate-fade-up">
                <svg class="w-5 h-5 shrink-0 text-rose-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <!-- Form Login -->
        <form wire:submit="login" class="space-y-5 relative z-10">
            
            <!-- Field Username -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Username</label>
                <input type="text" wire:model="username" 
                       class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                       placeholder="Masukkan username">
                @error('username')
                    <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Field Password -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between ml-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Password</label>
                    <a href="{{ route('password.request') }}" wire:navigate class="!no-underlin text-xs font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition-colors">Lupa Password?</a>
                </div>
                <input type="password" wire:model="password" 
                       class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                       placeholder="••••••••">
                @error('password')
                    <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Field Role -->
             <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Role</label>
                <select wire:model="role" 
                    class="w-full appearance-none bg-none bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition-all duration-300 cursor-pointer">
                    <option value="">Pilih Role</option>
                    <option value="residen">Residen</option>
                    <option value="dpjp">DPJP</option>
                </select>
                @error('role')
                    <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Field Captcha -->
            <div class="space-y-1.5 pt-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Verifikasi Keamanan</label>
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <div class="w-full sm:w-auto shrink-0 bg-slate-50 p-1.5 rounded-xl border border-slate-200 shadow-inner">
                        <!-- Pastikan komponen captcha me-render gambar dengan baik -->
                        <livewire:utils.captcha />
                    </div>
                    <input type="text" wire:model="captcha_input" 
                           class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3.5 text-sm font-bold tracking-widest text-slate-800 uppercase outline-none transition-all duration-300 placeholder:normal-case placeholder:tracking-normal placeholder:font-semibold placeholder-slate-400" 
                           placeholder="Input Kode">
                </div>
                @error('captcha_input')
                    <p class="text-xs font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button with Loading State -->
            <div class="pt-4">
                <button type="submit" 
                    wire:loading.attr="disabled"
                    class="cursor-pointer w-full relative h-[52px] flex items-center justify-center bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 active:scale-[0.98] transition-all duration-300 group disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden">
                    
                    <!-- ISI TOMBOL NORMAL -->
                    <!-- Kita gunakan opacity untuk menyembunyikan agar ukurannya tetap menjaga lebar tombol -->
                    <div wire:loading.class="opacity-0" wire:target="login" class="flex items-center justify-center gap-2 transition-opacity duration-200">
                        <span class="tracking-wide">Masuk ke Sistem</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </div>

                    <!-- AREA LOADING (Melayang di Atas / Absolute) -->
                    <!-- inset-0 memastikan area ini memenuhi seluruh tombol -->
                    <div wire:loading.flex wire:target="login" class="absolute inset-0 items-center justify-center gap-2 bg-inherit rounded-xl">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="tracking-wide whitespace-nowrap">Memverifikasi...</span>
                    </div>
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center pt-2">
                <p class="text-[13px] text-slate-500 font-medium">
                    Belum memiliki akses? 
                    <a href="{{ route('register') }}" wire:navigate class="!no-underline text-indigo-600 font-bold hover:text-indigo-700 hover:underline decoration-2 underline-offset-4 transition-all cursor-pointer">
                        Daftar Akun Baru
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>