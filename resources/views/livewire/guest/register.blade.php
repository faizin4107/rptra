<div>
    <!-- Navigation (Konsisten dengan Home) -->
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
        
        <div class="w-full max-w-2xl animate-enter">
            <!-- Header Teks -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-sm font-medium mb-4 border border-emerald-100">
                    <i class="ph ph-user-plus text-base"></i>
                    Pendaftaran Pengguna Baru
                </div>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900 mb-3">
                    Buat Akun Anda
                </h1>
                <p class="text-slate-500 max-w-lg mx-auto">
                    Data yang valid diperlukan untuk memastikan keamanan dan menghindari jadwal fiktif pada pemesanan RPTRA.
                </p>
            </div>

            <!-- Form Card (Desain Bento style mengikuti Home) -->
            <div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-sm">
                <form wire:submit="register">
                    
                    <!-- Grid Layout untuk input -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Nama Lengkap (Full width) -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Nama Lengkap</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                    <i class="ph ph-user text-lg"></i>
                                </div>
                                <input type="text" wire:model="nama_lengkap" 
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                                    placeholder="Masukkan nama">
                            </div>
                            @error('nama_lengkap')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Nomor Induk Kependudukan</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                    <i class="ph ph-identification-card text-lg"></i>
                                </div>
                                <input type="tel" wire:model="nik" 
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                                    placeholder="Masukkan nik">
                            </div>
                            @error('nik')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">No. Telepon / WhatsApp</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                    <i class="ph ph-whatsapp-logo text-lg"></i>
                                </div>
                                <input type="tel" wire:model="telp" 
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                                    placeholder="Masukkan no telepon">
                            </div>
                            @error('telp')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
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

                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider ml-1">Instansi / Organisasi</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                    <i class="ph ph-buildings text-lg"></i>
                                </div>
                                <input type="text" wire:model="instansi" 
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 outline-none transition-all duration-300" 
                                    placeholder="Masukkan instansi">
                            </div>
                            @error('instansi')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
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


                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-slate-100 w-full my-8"></div>

                    <!-- Submit Button & Login Link -->
                    <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-4">
                        <p class="text-sm text-slate-500">
                            Sudah punya akun? 
                            <a href="/login" class="font-semibold text-emerald-600 hover:text-emerald-700 hover:underline underline-offset-4 spring-transition">Masuk</a>
                        </p>
                        <button type="submit" 
                            wire:loading.attr="disabled"
                            class="cursor-pointer w-full relative h-[52px] flex items-center justify-center bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 active:scale-[0.98] transition-all duration-300 group disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden">
                            
                            <!-- ISI TOMBOL NORMAL -->
                            <!-- Kita gunakan opacity untuk menyembunyikan agar ukurannya tetap menjaga lebar tombol -->
                            <div wire:loading.class="opacity-0" wire:target="register" class="flex items-center justify-center gap-2 transition-opacity duration-200">
                                <span class="tracking-wide">Daftar Sekarang</span>
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>

                            <!-- AREA LOADING (Melayang di Atas / Absolute) -->
                            <!-- inset-0 memastikan area ini memenuhi seluruh tombol -->
                            <div wire:loading.flex wire:target="register" class="absolute inset-0 items-center justify-center gap-2 bg-inherit rounded-xl">
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