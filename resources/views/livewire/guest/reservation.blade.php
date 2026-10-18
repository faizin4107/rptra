<div>
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 spring-transition">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white">
                    <i class="ph ph-tree text-xl"></i>
                </div>
                <span class="font-semibold text-lg tracking-tight text-slate-900 hidden sm:block">RPTRA Pondok Labu</span>
            </div>
            @if(Auth::guard('pengguna')->check())
                <div class="flex items-center gap-4">
                    <!-- User Profile Indicator Dummy -->
                    <div class="flex items-center gap-3 pr-4 border-r border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::guard('pengguna')->user()->nama_lengkap }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ Auth::guard('pengguna')->user()->email }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 border border-slate-200">
                            <i class="ph ph-user text-lg"></i>
                        </div>
                    </div>
                    <livewire:guest.logout />
                </div>
            @else 
                <div class="flex items-center gap-4">
                    <a href="#kontak" class="text-sm font-medium text-slate-600 hover:text-emerald-600 spring-transition hidden sm:block">Hubungi Admin</a>
                    <a href="/register" wire:navigate class="px-5 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 active:scale-95 spring-transition shadow-sm shadow-emerald-600/20">
                        Masuk / Daftar
                    </a>
                </div>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20 px-6 flex justify-center">
        
        <div class="w-full max-w-5xl animate-enter">
            <!-- Header Teks -->
            <div class="mb-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-sm font-medium mb-4 border border-emerald-100">
                    <i class="ph ph-calendar-plus text-base"></i>
                    Formulir Pemesanan
                </div>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900 mb-3">
                    Reservasi Jadwal RPTRA
                </h1>
                <p class="text-slate-500 max-w-2xl">
                    Pilih lokasi, tentukan waktu, dan lengkapi detail kegiatan Anda. Pastikan data yang dimasukkan benar untuk memudahkan koordinasi dengan Admin.
                </p>
            </div>

            <!-- Form Container -->
            <form wire:submit="reservation" class="bg-white p-6 md:p-10 rounded-[2rem] border border-slate-100 shadow-sm">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    
                    <!-- Kiri: Detail Kegiatan -->
                    <div class="space-y-6">
                        <div class="border-b border-slate-100 pb-4 mb-6">
                            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">1</span>
                                Detail Kegiatan
                            </h2>
                        </div>

                        <!-- Nama Penanggung Jawab -->
                        <div class="space-y-2">
                            <label for="pic" class="block text-sm font-medium text-slate-700">Nama Penanggung Jawab</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-600 spring-transition">
                                    <i class="ph ph-user-focus text-lg"></i>
                                </div>
                                <input type="text" wire:model="nama_penanggung_jawab" required placeholder="Nama PIC Kegiatan" 
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white spring-transition">
                            </div>
                            @error('nama_penanggung_jawab')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No WA -->
                        <div class="space-y-2">
                            <label for="wa" class="block text-sm font-medium text-slate-700">No. WhatsApp Penanggung Jawab</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-600 spring-transition">
                                    <i class="ph ph-whatsapp-logo text-lg"></i>
                                </div>
                                <input type="tel" wire:model="no_wa" required placeholder="08xxxxxxxxxx" 
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white spring-transition">
                            </div>
                            @error('no_wa')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Peserta -->
                        <div class="space-y-2">
                            <label for="peserta" class="block text-sm font-medium text-slate-700">Perkiraan Jumlah Peserta</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-600 spring-transition">
                                    <i class="ph ph-users text-lg"></i>
                                </div>
                                <input type="number" wire:model="jumlah_peserta" required min="1" placeholder="Misal: 50" 
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white spring-transition">
                            </div>
                            @error('jumlah_peserta')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keperluan -->
                        <div class="space-y-2">
                            <label for="tujuan" class="block text-sm font-medium text-slate-700">Tujuan / Keperluan Kegiatan</label>
                            <div class="relative group">
                                <div class="absolute top-3.5 left-0 pl-3.5 flex items-start pointer-events-none text-slate-400 group-focus-within:text-emerald-600 spring-transition">
                                    <i class="ph ph-text-align-left text-lg"></i>
                                </div>
                                <textarea wire:model="tujuan" required rows="3" placeholder="Jelaskan secara singkat kegiatan yang akan dilakukan..." 
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white spring-transition resize-none"></textarea>
                            </div>
                            @error('tujuan')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kanan: Jadwal & Lokasi -->
                    <div class="space-y-6">
                        <div class="border-b border-slate-100 pb-4 mb-6">
                            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">2</span>
                                Waktu & Lokasi
                            </h2>
                        </div>

                        <!-- Pemilihan RPTRA (Custom Radio Cards) -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Lokasi RPTRA</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                
                                <label class="cursor-pointer relative">
                                    <input type="radio" wire:model="tempat_kegiatan" value="bango" class="peer hidden" required>
                                    <div class="p-3 text-center bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 spring-transition">
                                        <span class="block text-sm font-bold">Bango Krukut</span>
                                    </div>
                                    <!-- Check icon that appears when selected -->
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-emerald-600 opacity-0 peer-checked:opacity-100 peer-checked:-translate-y-6 spring-transition pointer-events-none">
                                        <i class="ph-fill ph-check-circle text-lg bg-white rounded-full"></i>
                                    </div>
                                </label>

                                <label class="cursor-pointer relative">
                                    <input type="radio" wire:model="tempat_kegiatan" value="pinang" class="peer hidden">
                                    <div class="p-3 text-center bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 spring-transition">
                                        <span class="block text-sm font-bold">Pinang Pola</span>
                                    </div>
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-emerald-600 opacity-0 peer-checked:opacity-100 peer-checked:-translate-y-6 spring-transition pointer-events-none">
                                        <i class="ph-fill ph-check-circle text-lg bg-white rounded-full"></i>
                                    </div>
                                </label>

                                <label class="cursor-pointer relative">
                                    <input type="radio" wire:model="tempat_kegiatan" value="idaman" class="peer hidden">
                                    <div class="p-3 text-center bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 spring-transition">
                                        <span class="block text-sm font-bold">Pola Idaman</span>
                                    </div>
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-emerald-600 opacity-0 peer-checked:opacity-100 peer-checked:-translate-y-6 spring-transition pointer-events-none">
                                        <i class="ph-fill ph-check-circle text-lg bg-white rounded-full"></i>
                                    </div>
                                </label>

                            </div>
                        </div>

                        <!-- Pemilihan Tanggal -->
                        <div class="space-y-2 mt-6">
                            <label class="block text-sm font-medium text-slate-700 flex justify-between">
                                Tanggal Pelaksanaan
                                <span class="text-xs text-emerald-600 font-normal">*Maks 2 bulan ke depan</span>
                            </label>
                            

                            <div class="relative group"
                                x-data="{
                                    initFlatpickr() {
                                        flatpickr(this.$refs.inputTanggal, {
                                            minDate: '{{ \Carbon\Carbon::now()->format('Y-m-d') }}',
                                            maxDate: '{{ \Carbon\Carbon::now()->addMonths(2)->format('Y-m-d') }}',
                                            dateFormat: 'Y-m-d',
                                            disableMobile: true, /* Memaksa tampilan kalender kustom di HP (tidak pakai native) */
                                            onChange: (selectedDates, dateStr, instance) => {
                                                // Menggantikan fungsi wire:model.live, mengirim nilai langsung ke Livewire backend
                                                $wire.set('tanggal', dateStr);
                                            }
                                        });
                                    }
                                }"
                                x-init="initFlatpickr()"
                            >
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                    <i class="ph ph-calendar-blank text-lg"></i>
                                </div>
                            
                                <!-- 
                                    PENTING: 
                                    1. type diubah menjadi "text" 
                                    2. wire:model dihapus karena sudah dihandle oleh $wire.set di atas
                                    3. x-ref digunakan agar Alpine mengenali elemen ini
                                -->
                                <input 
                                    type="text" 
                                    x-ref="inputTanggal"
                                    id="tanggal" 
                                    placeholder="Pilih tanggal..."
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white spring-transition"
                                >
                            </div>
                            @error('tanggal')
                                <p class="text-[11px] font-medium text-rose-500 ml-1 mt-1 animate-fade-up">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pemilihan Sesi Waktu -->
                        <div class="space-y-2 mt-6">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Sesi Waktu</label>
                            <div class="grid grid-cols-1 gap-3">
                                
                                @foreach($daftarSesi as $sesi)
                                    <!-- Cek langsung ke variabel $bookedTimes -->
                                    @if(in_array($sesi['value'], $bookedTimes))
                                        
                                        <!-- OPSI PENUH / DISABLED -->
                                        <label class="relative cursor-not-allowed opacity-60">
                                            <input type="radio" name="waktu" value="{{ $sesi['value'] }}" class="hidden" disabled>
                                            <div class="flex items-center justify-between p-4 bg-slate-100 border border-slate-200 rounded-xl">
                                                <div class="flex items-center gap-3 text-slate-500">
                                                    <i class="ph ph-clock text-xl"></i>
                                                    <div>
                                                        <span class="block text-sm font-bold">{{ $sesi['judul'] }}</span>
                                                        <span class="block text-xs">{{ $sesi['jam'] }}</span>
                                                    </div>
                                                </div>
                                                <span class="text-xs font-semibold px-2 py-1 bg-red-100 text-red-600 rounded-md">Penuh</span>
                                            </div>
                                        </label>

                                    @else

                                        <!-- OPSI TERSEDIA -->
                                        <label class="cursor-pointer relative group">
                                            <!-- Ingat untuk menggunakan wire:model="waktu" di sini -->
                                            <input type="radio" wire:model="waktu" name="waktu" value="{{ $sesi['value'] }}" class="hidden" required>
                                            <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 group-has-[:checked]:border-emerald-500 group-has-[:checked]:bg-emerald-50 group-has-[:checked]:text-emerald-700 spring-transition">
                                                
                                                <div class="flex items-center gap-3">
                                                    <i class="ph ph-clock text-xl"></i>
                                                    <div>
                                                        <span class="block text-sm font-bold">{{ $sesi['judul'] }}</span>
                                                        <span class="block text-xs opacity-80">{{ $sesi['jam'] }}</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="w-5 h-5 rounded-full border-2 border-slate-300 group-has-[:checked]:border-emerald-600 group-has-[:checked]:bg-emerald-600 flex items-center justify-center spring-transition">
                                                    <div class="w-2 h-2 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100 scale-50 group-has-[:checked]:scale-100 spring-transition"></div>
                                                </div>

                                            </div>
                                        </label>

                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Divider & Submit -->
                <div class="mt-10 pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 max-w-sm text-center md:text-left">
                        Dengan menekan tombol konfirmasi, Anda menyetujui tata tertib penggunaan RPTRA Kelurahan Pondok Labu.
                    </p>
                    
                    <button type="submit" 
                        wire:loading.attr="disabled"
                        class="cursor-pointer md:w-auto px-8 py-3.5 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 active:scale-[0.98] focus:ring-4 focus:ring-emerald-500/20 spring-transition flex items-center justify-center gap-2 shadow-sm shadow-emerald-600/20">
                        
                        <!-- ISI TOMBOL NORMAL -->
                        <!-- Kita gunakan opacity untuk menyembunyikan agar ukurannya tetap menjaga lebar tombol -->
                        <div wire:loading.class="opacity-0" wire:target="reservation" class="flex items-center justify-center gap-2 transition-opacity duration-200">
                            <span class="tracking-wide">Konfirmasi Reservasi</span>
                            <i class="ph ph-check-circle text-lg"></i>
                        </div>

                        <!-- AREA LOADING (Melayang di Atas / Absolute) -->
                        <!-- inset-0 memastikan area ini memenuhi seluruh tombol -->
                        {{-- <div wire:loading.flex wire:target="reservation" class="absolute inset-0 items-center justify-center gap-2 bg-inherit rounded-xl">
                            <i class="ph ph-check-circle text-lg"></i>
                            <span class="tracking-wide whitespace-nowrap">Memverifikasi...</span>
                        </div> --}}
                    </button>
                </div>

            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white pt-8 pb-8 text-center mt-auto">
        <p class="text-sm text-slate-500">
            &copy; 2024 Kelurahan Pondok Labu - Sistem Reservasi RPTRA. All rights reserved.
        </p>
    </footer>

    <!-- Logic Script Sederhana untuk Datepicker (Maks 2 Bulan) -->
    @script
    <script>
        
    </script>
    @endscript
</div>
