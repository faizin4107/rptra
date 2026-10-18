<div>
    <!-- Decorative Background -->
    <div class="ambient-glow"></div>

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
    <main class="flex-grow pt-32 pb-20 px-6 flex justify-center items-start md:items-center relative z-10">
        
        <div class="w-full max-w-2xl animate-enter mt-4 md:mt-0">
            
            <!-- Header Teks Success -->
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_40px_rgba(16,185,129,0.2)]">
                    <i class="ph-fill ph-check-circle text-4xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900 mb-3">
                    Pengajuan Reservasi Diterima
                </h1>
                <p class="text-slate-500 text-sm md:text-base max-w-lg mx-auto">
                    Terima kasih, data Anda telah masuk ke sistem kami. Silakan simpan detail di bawah ini sebagai bukti pendaftaran awal.
                </p>
            </div>

            <!-- Digital Ticket Card -->
            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden relative">
                
                <!-- Ticket Header (ID & Status) -->
                <div class="p-6 md:p-8 bg-slate-50/50 border-b border-dashed border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">ID Reservasi</p>
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">{{ $pemesanan->id_reservasi }}</h2>
                    </div>
                    
                    <!-- STATUS BADGE (Menunggu Konfirmasi) -->
                    <!-- Gunakan bg-emerald-100 text-emerald-700 jika Disetujui -->
                    <!-- Gunakan bg-rose-100 text-rose-700 jika Ditolak -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-sm font-bold shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-amber-500 status-dot-pending"></span>
                        Menunggu Konfirmasi
                    </div>
                </div>

                <!-- Ticket Body (Detail Data) -->
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                        
                        <!-- Lokasi -->
                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <i class="ph ph-map-pin text-sm"></i> Lokasi RPTRA
                            </p>
                            <p class="text-base font-bold text-slate-900">{{ $pemesanan->tempat_kegiatan }}</p>
                        </div>

                        <!-- Waktu Pelaksanaan -->
                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <i class="ph ph-calendar-blank text-sm"></i> Tanggal & Sesi
                            </p>
                            <p class="text-base font-bold text-slate-900">{{ \Carbon\Carbon::parse($pemesanan->tanggal)->locale('id')->translatedFormat('d F Y') }}</p>
                            <p class="text-sm font-medium text-emerald-600 mt-0.5">{{ $pemesanan->waktu }}</p>
                        </div>

                        <!-- Penanggung Jawab -->
                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <i class="ph ph-user-focus text-sm"></i> Penanggung Jawab
                            </p>
                            <p class="text-base font-bold text-slate-900">{{ $pemesanan->nama_penanggung_jawab }}</p>
                            <p class="text-sm font-medium text-slate-500 mt-0.5">{{ $pemesanan->no_wa }}</p>
                        </div>

                        <!-- Tujuan & Peserta -->
                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                                <i class="ph ph-info text-sm"></i> Detail Kegiatan
                            </p>
                            <p class="text-base font-bold text-slate-900">{{ $pemesanan->tujuan }}</p>
                            <p class="text-sm font-medium text-slate-500 mt-0.5">Estimasi: {{ $pemesanan->jumlah_peserta }} Peserta</p>
                        </div>

                    </div>
                </div>

                <!-- Ticket Footer / Info Panel -->
                <div class="bg-blue-50/50 p-6 md:px-8 border-t border-blue-100 flex items-start gap-4">
                    <div class="mt-0.5 text-blue-500 text-xl hidden sm:block">
                        <i class="ph-fill ph-info"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-blue-900 mb-1">Langkah Selanjutnya</h4>
                        <p class="text-xs md:text-sm text-blue-700 leading-relaxed">
                            Admin (Koordinator RPTRA) akan meninjau jadwal Anda. Konfirmasi persetujuan atau perubahan jadwal akan dikirimkan melalui pesan WhatsApp ke nomor Penanggung Jawab maksimal 1x24 Jam.
                        </p>
                    </div>
                </div>
                
                <!-- Ticket Cutout decoration (Lingkaran di pinggir tiket) -->
                <div class="absolute left-[-12px] top-[102px] w-6 h-6 bg-slate-50 rounded-full border-r border-slate-200"></div>
                <div class="absolute right-[-12px] top-[102px] w-6 h-6 bg-slate-50 rounded-full border-l border-slate-200"></div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/" wire:navigate class="w-full sm:w-auto px-8 py-3.5 text-sm font-bold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 active:scale-95 spring-transition flex items-center justify-center gap-2">
                    <i class="ph ph-house text-lg"></i>
                    Kembali ke Beranda
                </a>
                
                <!-- Direct link to WA Admin based on booked RPTRA -->
                <a href="{{ route('download.tiket', ['id' => $pemesanan->id]) }}" target="_blank" 
                   class="w-full sm:w-auto px-8 py-3.5 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 active:scale-95 spring-transition flex items-center justify-center gap-2 shadow-sm shadow-emerald-600/20">
                    <i class="ph ph-download text-lg"></i>
                    Download PDF
                </a>
            </div>

        </div>
    </main>
</div>
