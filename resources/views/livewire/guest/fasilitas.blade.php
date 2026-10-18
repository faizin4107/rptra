<div>
    <!-- Decorative Background -->
    <div class="ambient-glow -top-32 -left-32"></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 spring-transition">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white">
                    <i class="ph ph-tree text-xl"></i>
                </div>
                <span class="font-semibold text-lg tracking-tight text-slate-900">RPTRA Pondok Labu</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-medium text-slate-600 hover:text-emerald-600 spring-transition hidden sm:block mr-2">Beranda</a>
                <a href="/login" class="px-5 py-2.5 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-xl hover:bg-emerald-100 spring-transition">
                    Masuk
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20 px-6 relative z-10">
        
        <div class="max-w-7xl mx-auto animate-enter">
            
            <!-- Header Section -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-sm font-medium mb-4 border border-emerald-100">
                    <i class="ph ph-camera text-base"></i>
                    Galeri & Spesifikasi
                </div>
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-4">
                    Eksplorasi Ruang Publik Kami
                </h1>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Lihat lebih dekat berbagai fasilitas unggulan yang tersedia di ke-3 RPTRA Kelurahan Pondok Labu untuk mendukung kegiatan Anda.
                </p>
            </div>

            <!-- Bento Grid Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                
                <!-- Fasilitas 1: Aula -->
                <div class="group bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 spring-transition flex flex-col">
                    <!-- Image Container -->
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <!-- Nanti src diganti foto asli RPTRA -->
                        <img src="https://images.unsplash.com/photo-1577416412292-747c6607f055?auto=format&fit=crop&w=800&q=80" alt="Aula Serbaguna" class="w-full h-full object-cover card-zoom-image">
                        <!-- Badge Lokasi -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-slate-800 shadow-sm">
                            📍 Pola Idaman
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2 text-emerald-600">
                                <i class="ph ph-chalkboard-teacher text-lg"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Ruang Pertemuan</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Aula Serbaguna</h3>
                            <p class="text-sm text-slate-500 mb-4 line-clamp-2">Ruangan semi-indoor luas yang cocok untuk kegiatan sosialisasi, rapat warga, dan senam lantai.</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 border-t border-slate-100 pt-4">
                            <span class="flex items-center gap-1"><i class="ph ph-users"></i> Kapasitas ~50 org</span>
                            <span class="flex items-center gap-1"><i class="ph ph-plug"></i> Stopkontak</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 2: Lapangan Futsal/Olahraga -->
                <div class="group bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 spring-transition flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1526232761682-d26e03ac148e?auto=format&fit=crop&w=800&q=80" alt="Lapangan Olahraga" class="w-full h-full object-cover card-zoom-image">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-slate-800 shadow-sm">
                            📍 Bango Krukut
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2 text-emerald-600">
                                <i class="ph ph-soccer-ball text-lg"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Area Olahraga</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Lapangan Futsal Terpadu</h3>
                            <p class="text-sm text-slate-500 mb-4 line-clamp-2">Lapangan olahraga dengan alas semen halus, tersedia gawang dan garis pembatas yang jelas.</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 border-t border-slate-100 pt-4">
                            <span class="flex items-center gap-1"><i class="ph ph-sun"></i> Outdoor</span>
                            <span class="flex items-center gap-1"><i class="ph ph-clock"></i> Bebas digunakan</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 3: Taman Bermain Anak -->
                <div class="group bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 spring-transition flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1596464716127-f2a82984de30?auto=format&fit=crop&w=800&q=80" alt="Taman Bermain Anak" class="w-full h-full object-cover card-zoom-image">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-slate-800 shadow-sm">
                            📍 Pinang Pola
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2 text-emerald-600">
                                <i class="ph ph-baby text-lg"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Area Edukasi Anak</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Taman Bermain (Playground)</h3>
                            <p class="text-sm text-slate-500 mb-4 line-clamp-2">Area aman khusus anak yang dilengkapi seluncuran, ayunan, dan alas ramah anak.</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 border-t border-slate-100 pt-4">
                            <span class="flex items-center gap-1"><i class="ph ph-warning-circle"></i> Dalam pengawasan</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 4: Perpustakaan Mini -->
                <div class="group bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 spring-transition flex flex-col">
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=800&q=80" alt="Perpustakaan Mini" class="w-full h-full object-cover card-zoom-image">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-slate-800 shadow-sm">
                            📍 Pola Idaman
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2 text-emerald-600">
                                <i class="ph ph-books text-lg"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Literasi & Edukasi</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Perpustakaan Mini</h3>
                            <p class="text-sm text-slate-500 mb-4 line-clamp-2">Ruang baca ber-AC yang nyaman dengan berbagai koleksi buku anak hingga buku pengetahuan umum.</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 border-t border-slate-100 pt-4">
                            <span class="flex items-center gap-1"><i class="ph ph-wind"></i> Ber-AC</span>
                            <span class="flex items-center gap-1"><i class="ph ph-chair"></i> Nyaman</span>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas 5: Amphitheater / Panggung Terbuka -->
                <div class="group bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 spring-transition flex flex-col md:col-span-2 lg:col-span-2">
                    <div class="relative aspect-video md:aspect-[21/9] overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1510515152549-b5d38f8b86d9?auto=format&fit=crop&w=1200&q=80" alt="Panggung Terbuka" class="w-full h-full object-cover card-zoom-image">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-slate-800 shadow-sm">
                            📍 Bango Krukut & Pinang Pola
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2 text-emerald-600">
                                <i class="ph ph-microphone-stage text-lg"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Kesenian & Pertunjukan</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Amphitheater / Panggung Terbuka</h3>
                            <p class="text-sm text-slate-500 mb-4 max-w-2xl">Area melingkar bergaya teater terbuka, sangat direkomendasikan untuk acara pentas seni PAUD, latihan tari, lomba kemerdekaan, atau pertemuan komunitas dengan audiens yang besar.</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 border-t border-slate-100 pt-4">
                            <span class="flex items-center gap-1"><i class="ph ph-users"></i> Kapasitas 100+ org</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Booking Call to Action (CTA) -->
            <div class="bg-slate-900 rounded-[2.5rem] p-10 md:p-14 relative overflow-hidden text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-8 shadow-xl shadow-slate-900/10">
                <!-- Background decoration -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/30 blur-3xl rounded-full pointer-events-none"></div>
                
                <div class="relative z-10 max-w-lg">
                    <h2 class="text-3xl font-bold text-white mb-3">Telah menemukan ruang yang sesuai?</h2>
                    <p class="text-slate-400 text-sm md:text-base">Amankan jadwal kegiatan Anda sekarang. Pemesanan dibuka maksimal untuk 2 bulan ke depan.</p>
                </div>
                
                <div class="relative z-10 w-full sm:w-auto shrink-0">
                    <a href="/reservasi" class="w-full sm:w-auto px-8 py-4 text-sm font-bold text-slate-900 bg-emerald-400 rounded-xl hover:bg-emerald-300 active:scale-95 spring-transition flex items-center justify-center gap-2 shadow-[0_0_20px_rgba(52,211,153,0.3)]">
                        Mulai Reservasi
                        <i class="ph ph-calendar-check text-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </main>
</div>
