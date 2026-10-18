<div>
    <!-- Navigation (Konsisten dengan Home & Register) -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 spring-transition">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white">
                    <i class="ph ph-tree text-xl"></i>
                </div>
                <span class="font-semibold text-lg tracking-tight text-slate-900">RPTRA Pondok Labu</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/" wire:navigate class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-slate-100/50 hover:bg-slate-100 rounded-xl spring-transition flex items-center gap-2">
                    <i class="ph ph-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20 px-6 flex items-center justify-center">
        
        <div class="w-full max-w-md animate-enter">
            <!-- Header Teks -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-sm font-medium mb-4 border border-emerald-100">
                    <i class="ph ph-sign-in text-base"></i>
                    Selamat Datang Kembali
                </div>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900 mb-3">
                    Masuk ke Akun
                </h1>
                <p class="text-slate-500">
                    Silakan masuk untuk melanjutkan reservasi atau memantau jadwal kegiatan Anda.
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                @error('login_failed')
                    <div class="bg-rose-50 text-rose-600 p-4 rounded-xl text-sm font-medium mb-6 border border-rose-100 flex items-start gap-3 animate-fade-up">
                        <svg class="w-5 h-5 shrink-0 text-rose-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <form wire:submit="login" class="space-y-5">
                    
                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                <i class="ph ph-envelope-simple text-lg"></i>
                            </div>
                            <input type="email" wire:model="email" 
                                class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                                placeholder="Masukkan email">
                        </div>
                        @error('email')
                            <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                <i class="ph ph-lock-key text-lg"></i>
                            </div>
                            <input type="password" wire:model="password" id="password"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                                placeholder="Masukkan password">
                            <button type="button" id="togglePassword" class="cursor-pointer absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-emerald-600 focus:outline-none spring-transition" aria-label="Tampilkan password">
                                <i class="ph ph-eye text-lg" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                        @enderror

                        
                    </div>

                    

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                            wire:loading.attr="disabled"
                            class="cursor-pointer w-full relative h-[52px] flex items-center justify-center bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 active:scale-[0.98] transition-all duration-300 group disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden">
                            
                            <!-- ISI TOMBOL NORMAL -->
                            <!-- Kita gunakan opacity untuk menyembunyikan agar ukurannya tetap menjaga lebar tombol -->
                            <div wire:loading.class="opacity-0" wire:target="login" class="flex items-center justify-center gap-2 transition-opacity duration-200">
                                <span class="tracking-wide">Masuk</span>
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

                </form>

                <!-- Divider & Register Link -->
                <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                    <p class="text-sm text-slate-500">
                        Belum memiliki akun? 
                        <a href="/register" wire:navigate class="font-semibold text-emerald-600 hover:text-emerald-700 hover:underline underline-offset-4 spring-transition">Daftar sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
    @script
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle the icon
            if (type === 'text') {
                eyeIcon.classList.remove('ph-eye');
                eyeIcon.classList.add('ph-eye-closed');
            } else {
                eyeIcon.classList.remove('ph-eye-closed');
                eyeIcon.classList.add('ph-eye');
            }
        });
    </script>
    @endscript
</div>
