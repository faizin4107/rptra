<div>
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 spring-transition">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white">
                    <i class="ph ph-tree text-xl"></i>
                </div>
                <span class="font-semibold text-lg tracking-tight text-slate-900">RPTRA Pondok Labu</span>
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

    <!-- Hero Section -->
    <main class="pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto text-center mt-12 mb-20">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-sm font-medium mb-6 border border-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sistem Reservasi Terintegrasi
            </div>
            <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                Ruang Publik Nyaman, <br>
                <span class="text-gradient">Untuk Semua Kegiatan.</span>
            </h1>
            <p class="text-lg text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                Pesan fasilitas RPTRA di Kelurahan Pondok Labu dengan mudah. Cek jadwal, pilih sesi waktu, dan amankan tempat kegiatan Anda secara real-time.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/reservation" wire:navigate class="w-full sm:w-auto px-8 py-3.5 text-base font-medium text-white bg-slate-900 rounded-xl hover:bg-slate-800 active:scale-95 spring-transition flex items-center justify-center gap-2">
                    Mulai Reservasi
                    <i class="ph ph-arrow-right"></i>
                </a>
                <a href="#fasilitas" class="w-full sm:w-auto px-8 py-3.5 text-base font-medium text-slate-700 bg-white rounded-xl hover:bg-slate-50 border border-slate-200 active:scale-95 spring-transition">
                    Lihat Fasilitas
                </a>
            </div>
        </div>

        <!-- Bento Grid Venues Section -->
        <section id="fasilitas" class="max-w-7xl mx-auto mb-32 relative z-10">
            <h2 class="text-2xl font-bold text-slate-900 mb-8 text-center">Fasilitas RPTRA Tersedia</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- RPTRA 1 -->
                <div class="group bg-white p-6 rounded-3xl border border-slate-100 spring-transition hover-lift flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-6">
                            <i class="ph ph-map-pin text-2xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Bango Krukut Pola</h3>
                        <p class="text-sm text-slate-500 mb-6 line-clamp-2">Fasilitas lengkap untuk kegiatan olahraga, bermain anak, dan pertemuan warga lingkungan sekitar.</p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">Tersedia Sesi Pagi & Sore</span>
                    </div>
                </div>

                <!-- RPTRA 2 -->
                <div class="group bg-white p-6 rounded-3xl border border-slate-100 spring-transition hover-lift flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-6">
                            <i class="ph ph-map-pin text-2xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Pinang Pola</h3>
                        <p class="text-sm text-slate-500 mb-6 line-clamp-2">Lokasi strategis yang sejuk, cocok untuk kegiatan senam, edukasi PAUD, maupun acara komunitas.</p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">Max Booking 2 Bulan</span>
                    </div>
                </div>

                <!-- RPTRA 3 -->
                <div class="group bg-white p-6 rounded-3xl border border-slate-100 spring-transition hover-lift flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-6">
                            <i class="ph ph-map-pin text-2xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Pola Idaman</h3>
                        <p class="text-sm text-slate-500 mb-6 line-clamp-2">Fasilitas terpadu yang dilengkapi dengan aula serbaguna, perpustakaan mini, dan area bermain.</p>
                    </div>
                    <div class="pt-4 border-t border-slate-50 flex justify-between items-center">
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">3 Pilihan Sesi Waktu</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="kontak" class="max-w-7xl mx-auto mb-20 bg-slate-900 rounded-[2.5rem] p-10 md:p-16 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/20 blur-3xl rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row gap-12 items-start justify-between">
                <div class="max-w-md text-white">
                    <h2 class="text-3xl font-bold mb-4">Butuh Bantuan Koordinasi?</h2>
                    <p class="text-slate-400 mb-8">Setiap RPTRA memiliki koordinator khusus yang siap membantu penyesuaian jadwal atau pertanyaan terkait fasilitas pendukung kegiatan Anda.</p>
                </div>
                
                <div class="w-full md:w-auto flex flex-col gap-4">
                    <!-- Contact 1 -->
                    <a href="https://wa.me/6280000000001?text=Halo%20Admin%20Bango%20Krukut%20Pola,%20saya%20ingin%20bertanya%20seputar%20booking%20RPTRA" target="_blank" class="flex items-center gap-4 bg-white/10 hover:bg-white/20 p-4 rounded-2xl border border-white/5 spring-transition group">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                            <i class="ph ph-whatsapp-logo text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <h4 class="text-white font-medium text-sm">Koord. Bango Krukut Pola</h4>
                            <p class="text-slate-400 text-xs">Hubungi via WhatsApp</p>
                        </div>
                        <i class="ph ph-caret-right text-slate-400 group-hover:translate-x-1 spring-transition"></i>
                    </a>

                    <!-- Contact 2 -->
                    <a href="https://wa.me/6280000000002?text=Halo%20Admin%20Pinang%20Pola,%20saya%20ingin%20bertanya%20seputar%20booking%20RPTRA" target="_blank" class="flex items-center gap-4 bg-white/10 hover:bg-white/20 p-4 rounded-2xl border border-white/5 spring-transition group">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                            <i class="ph ph-whatsapp-logo text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <h4 class="text-white font-medium text-sm">Koord. Pinang Pola</h4>
                            <p class="text-slate-400 text-xs">Hubungi via WhatsApp</p>
                        </div>
                        <i class="ph ph-caret-right text-slate-400 group-hover:translate-x-1 spring-transition"></i>
                    </a>

                    <!-- Contact 3 -->
                    <a href="https://wa.me/6280000000003?text=Halo%20Admin%20Pola%20Idaman,%20saya%20ingin%20bertanya%20seputar%20booking%20RPTRA" target="_blank" class="flex items-center gap-4 bg-white/10 hover:bg-white/20 p-4 rounded-2xl border border-white/5 spring-transition group">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                            <i class="ph ph-whatsapp-logo text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <h4 class="text-white font-medium text-sm">Koord. Pola Idaman</h4>
                            <p class="text-slate-400 text-xs">Hubungi via WhatsApp</p>
                        </div>
                        <i class="ph ph-caret-right text-slate-400 group-hover:translate-x-1 spring-transition"></i>
                    </a>
                </div>
            </div>
        </section>
        
    </main>
    
</div>
