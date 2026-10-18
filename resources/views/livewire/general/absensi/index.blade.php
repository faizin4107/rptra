<div 
    x-data="{
        isLoading: false,
        errorMessage: '',
        
        fetchLocation(tipe, id) {
            console.log('1. Tombol ditekan, tipe:', tipe);
            this.isLoading = true;
            this.errorMessage = '';

            if (!navigator.geolocation) {
                this.errorMessage = 'Browser tidak mendukung GPS (Atau Anda tidak menggunakan HTTPS/Localhost).';
                this.isLoading = false;
                return;
            }

            console.log('2. Meminta izin lokasi...');
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    $wire.updateLocation(lat, lng, tipe, id)
                        .then(() => {
                            console.log('Sukses dikirim ke server!');
                            this.isLoading = false;
                        })
                        .catch((err) => {
                            console.error('Error dari Livewire:', err);
                            this.errorMessage = 'Terjadi kesalahan saat menghubungi server.';
                            this.isLoading = false;
                        });
                },
                (error) => {
                    console.error('Error GPS:', error);
                    this.isLoading = false;
                    
                    if (error.code === error.PERMISSION_DENIED) {
                        this.errorMessage = 'Izin lokasi ditolak. Tolong izinkan akses GPS di pengaturan browser Anda.';
                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                        this.errorMessage = 'Sinyal GPS tidak ditemukan. Pastikan GPS HP Anda menyala.';
                    } else if (error.code === error.TIMEOUT) {
                        this.errorMessage = 'Pencarian GPS terlalu lama (Timeout).';
                    } else {
                        this.errorMessage = 'Gagal mengambil lokasi: ' + error.message;
                    }
                },
                { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
            );
        }
    }"
    class="max-w-4xl mx-auto space-y-6"
>
    <!-- Card Utama -->
    <div class="bg-white p-12 rounded-[50px] border border-slate-100 shadow-xl text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 {{ (auth()->user()->role == 'dpjp') ? 'bg-emerald-50' : 'bg-indigo-50' }} rounded-full -mr-16 -mt-16 opacity-50"></div>

        <div class="relative z-10">
            <div class="w-20 h-20 bg-indigo-600 text-white rounded-[30px] flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg shadow-indigo-100">📍</div>
            
            <h2 class="text-3xl font-black text-slate-800 uppercase italic tracking-tighter">
                Presensi GPS {{ (auth()->user()->role == 'dpjp') ? 'DPJP' : 'Residen' }}
            </h2>
            
            

            <!-- Status Proses Loading Alpine -->
            <div x-show="isLoading" style="display: none;" class="mt-8 p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200 text-[10px] font-mono text-slate-500 uppercase tracking-widest">
                🛰️ Mencari Sinyal GPS...
            </div>

            <!-- Error Message Alpine -->
            <div x-show="errorMessage" x-text="errorMessage" style="display: none;" class="mt-4 p-4 bg-rose-50 rounded-2xl border border-rose-200 text-[12px] font-bold text-rose-600 uppercase tracking-widest">
            </div>

            <!-- Status Message Livewire -->
            @if(isset($statusMessage) && $statusMessage !== '') 
            <div class="mt-8 p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200 text-[10px] font-mono text-slate-500 uppercase tracking-widest">
                🛰️ {{ $statusMessage }}
            </div>
            @endif
            
            @if (count($jadwals) === 0)
                <div class="mt-10 p-8 bg-rose-50 rounded-[30px] border border-rose-100">
                    <p class="text-rose-600 font-black uppercase italic tracking-tight">Tidak Ada Jadwal Dinas</p>
                    <p class="text-rose-400 text-xs mt-1">Anda tidak memiliki jadwal praktek/jaga pada hari ini ({{ $day }}).</p>
                </div>
            @else
                <x-table :headers="$headers" :rows="$jadwals" paginate>
                    
                    <!-- Info Pengguna (Nama & Role) -->
                    @interact('column_day', $row)
                    @php
                        $daftarHari = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];
                    @endphp

                    {{ $daftarHari[$row->day] ?? $row->day }}
                    @endinteract

                    @interact('column_start_time', $row)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[11px] font-black text-slate-600 tracking-widest">
                            {{ \Carbon\Carbon::parse($row->start_time)->format('h:i A') }}
                        </span>
                    </div>
                    @endinteract

                    @interact('column_end_time', $row)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[11px] font-black text-slate-600 tracking-widest">
                            {{ \Carbon\Carbon::parse($row->end_time)->format('h:i A') }}
                        </span>
                    </div>
                    @endinteract



                    <!-- Aksi (Hapus Jadwal) -->
                    @interact('column_action', $row)
                    <div class="flex items-center gap-1.5">
                        @php
                            $daftarAbsen = $this->statusAbsen;
                            // Samakan format jam dengan yang ada di Controller (H:i)
                            $start = \Carbon\Carbon::parse($row->start_time)->format('H:i');
                            $end = \Carbon\Carbon::parse($row->end_time)->format('H:i');
                            
                            // Buat Key Unik untuk dicek ke array $statusAbsen
                            $keyMasuk = $row->day . '_' . $start . '_' . $end . '_masuk';
                            $keyPulang = $row->day . '_' . $start . '_' . $end . '_pulang';

                            // Cek apakah sudah ada di data absensi
                            $isSudahMasuk = isset($daftarAbsen[$keyMasuk]);
                            $isSudahPulang = isset($daftarAbsen[$keyPulang]);
                        @endphp

                        <!-- Monday_00:43_10:00_masuk -->
                        <!-- TOMBOL ABSEN MASUK -->
                        <button type="button" 
                            wire:click="fetchLocation('masuk', {{ $row->id }})" 
                            wire:loading.attr="disabled"
                            {{ $isSudahMasuk ? 'disabled' : '' }}
                            class="cursor-pointer group relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-wider transition-all duration-300 
                            {{ $isSudahMasuk 
                                ? 'bg-slate-200 border border-slate-300 text-slate-500 cursor-not-allowed' 
                                : 'bg-blue-600 border border-blue-700 text-white hover:bg-blue-700 active:scale-95 shadow-sm' 
                            }}">

                            <span wire:loading.remove wire:target="fetchLocation('masuk', {{ $row->id }})" class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $isSudahMasuk ? 'Sudah Absen Masuk' : 'Absen Masuk' }}
                            </span>
                            <!-- Loading state tetap sama -->
                        </button>

                        <!-- TOMBOL ABSEN PULANG -->
                        <button type="button" 
                            wire:click="fetchLocation('pulang', {{ $row->id }})" 
                            wire:loading.attr="disabled"
                            {{ ($isSudahPulang || !$isSudahMasuk) ? 'disabled' : '' }}
                            class="cursor-pointer group relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-wider transition-all duration-300
                            {{ ($isSudahPulang || !$isSudahMasuk)
                                ? 'bg-slate-200 border border-slate-300 text-slate-500 cursor-not-allowed' 
                                : 'bg-rose-600 border border-rose-700 text-white hover:bg-rose-700 active:scale-95 shadow-sm' 
                            }}">

                            <span wire:loading.remove wire:target="fetchLocation('pulang', {{ $row->id }})" class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $isSudahPulang ? 'Sudah Absen Pulang' : 'Absen Pulang' }}
                            </span>
                            <!-- Loading state tetap sama -->
                        </button>
                    </div>
                    @endinteract

                </x-table>
                <div class="flex flex-col md:flex-row justify-center gap-4 mt-10">
                    
                </div>
            @endif
        </div>
    </div>

    <!-- Log Aktivitas -->
    <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-sm">
        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Log Aktivitas Hari Ini</h4>
        <div class="space-y-4">
            @if(count($q_riwayat) == 0)
                <p class='text-xs text-slate-400 italic'>Belum ada aktivitas presensi.</p>
            @else 
                <x-table :headers="$headers_absensi" :rows="$q_riwayat" paginate>
                    

                    @interact('column_start_time', $row)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[11px] font-black text-slate-600 tracking-widest">
                            {{ \Carbon\Carbon::parse($row->start_time)->format('h:i A') }}
                        </span>
                    </div>
                    @endinteract

                    @interact('column_end_time', $row)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[11px] font-black text-slate-600 tracking-widest">
                            {{ \Carbon\Carbon::parse($row->end_time)->format('h:i A') }}
                        </span>
                    </div>
                    @endinteract



                    <!-- Aksi (Hapus Jadwal) -->
                    @interact('column_status', $row)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm">
                        <svg class="w-4 h-4 text-emerald-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-[11px] font-black text-slate-600 tracking-widest">
                            Sukses
                        </span>
                    </div>
                    @endinteract

                </x-table>
            @endif
        </div>
    </div>
</div>