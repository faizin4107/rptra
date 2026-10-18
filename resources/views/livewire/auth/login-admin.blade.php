<!-- WRAPPER UTAMA: Mengatur posisi agar persis di tengah layar (Center) -->
<!-- Hapus 'min-h-screen bg-slate-50 p-4' jika Anda sudah memiliki parent layout, ini untuk standalone page -->
<div class="min-h-screen flex items-center justify-center bg-slate-50 p-4 selection:bg-indigo-100 selection:text-indigo-900">
    
    <!-- CONTAINER FORM: Di sinilah kita "merampingkan" lebar form (max-w-[380px]) -->
    <div class="w-full max-w-[380px] animate-fade-up">
        
        <!-- Logo & Header Section -->
        

        <!-- Login Card -->
        <!-- Padding disesuaikan jadi p-7 agar proporsional dengan lebar card yang ramping -->
        <div class="bg-white/80 backdrop-blur-xl p-7 rounded-[24px] shadow-[0_8px_40px_-12px_rgba(0,0,0,0.1)] border border-slate-200/60 relative overflow-hidden">
            <div class="flex flex-col items-center mb-8">
            
                <div class="text-center space-y-1">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">LOGIN ADMIN</h2>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                        RPTRA
                    </h1>
                </div>
            </div>
            <!-- Error Message Global -->
            @error('login_failed')
                <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm font-medium mb-6 border border-rose-100 flex items-start gap-3 animate-fade-up">
                    <svg class="w-5 h-5 shrink-0 text-rose-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <!-- Form Login -->
            <form wire:submit="login" class="space-y-4 relative z-10">
                
                <!-- Field Email -->
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Email</label>
                    <input type="email" wire:model="email" 
                           class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                           placeholder="Masukkan email">
                    @error('email')
                        <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Field Password -->
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Password</label>
                    <input type="password" wire:model="password" 
                           class="w-full bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl px-4 py-3 text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button with Loading State -->
                <div class="pt-2">
                    <button type="submit" 
                        wire:loading.attr="disabled"
                        class="cursor-pointer w-full relative h-[48px] flex items-center justify-center bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 active:scale-[0.98] transition-all duration-300 group disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden">
                        
                        <!-- ISI TOMBOL NORMAL -->
                        <div wire:loading.class="opacity-0" wire:target="login" class="flex items-center justify-center gap-2 transition-opacity duration-200">
                            <span class="tracking-wide">Masuk ke Sistem</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>

                        <!-- AREA LOADING -->
                        <div wire:loading.flex wire:target="login" class="absolute inset-0 items-center justify-center gap-2 bg-inherit rounded-xl">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="tracking-wide whitespace-nowrap">Memverifikasi...</span>
                        </div>
                    </button>
                </div>

            </form>
        </div>
        
    </div>
</div>