<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-indigo-600 p-10 rounded-[40px] shadow-xl text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-black uppercase italic tracking-tighter">Jadwal Dinas Anda</h2>
            <p class="text-indigo-100 text-xs font-medium mt-1">Pastikan Anda hadir sesuai dengan jam operasional yang ditentukan.</p>
        </div>
        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @if(count($jadwals) > 0)
            @foreach($jadwals as $row)
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

            

            <div class="bg-white p-6 rounded-[30px] border border-slate-100 shadow-sm flex items-center gap-5 hover:border-indigo-200 transition-all">
                <!-- Icon Kalender -->
                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-xl shadow-inner flex-shrink-0">
                    📅
                </div>

                <!-- Konten Tengah -->
                <div class="flex-1 min-w-0">
                    <h4 class="font-black text-slate-800 uppercase italic text-sm">{{ $daftarHari[$row->day] ?? $row->day }}</h4>
                    <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mt-1">
                        ⌚ {{ \Carbon\Carbon::parse($row->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row->end_time)->format('h:i A') }}
                    </p>
                    
                    <div class="mt-2">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">DPJP</p>
                        <p class="text-[11px] font-bold text-slate-700 uppercase">
                            {{ $row->dpjp->fullname }}
                        </p>
                    </div>
                </div>

                <!-- Tombol Link (Anchor Tag) -->
                <a href="{{ route('dpjp.jadwal-dinas-residen', ['id' => $row->id, 'dpjp_id' => $row->dpjp_id]) }}" wire:navigate class="ml-auto inline-flex items-center justify-center w-12 h-12 bg-indigo-500 hover:bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95 group flex-shrink-0">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </a>
            </div>
            @endforeach
        @else
        <div class="col-span-full bg-slate-50 p-10 rounded-[30px] border border-dashed border-slate-200 text-center">
            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Belum ada jadwal yang diinput oleh admin.</p>
        </div>
        @endif
    </div>

    <div class="bg-amber-50 p-6 rounded-[30px] border border-amber-100">
        <div class="flex gap-3">
            <span class="text-lg">💡</span>
            <p class="text-[10px] text-amber-700 font-medium leading-relaxed">
                <b>INFO:</b> Jika terdapat ketidaksesuaian jadwal atau ingin melakukan tukar jaga (shift), silakan hubungi <b>Kepala Bagian</b> atau <b>Admin SINAR</b> minimal 24 jam sebelumnya.
            </p>
        </div>
    </div>
</div>