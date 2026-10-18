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
                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    📅
                </div>
                <div>
                    <h4 class="font-black text-slate-800 uppercase italic text-sm">{{ $daftarHari[$row->jadwal->day] ?? $row->jadwal->day }}</h4>
                    <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mt-1">
                        ⌚ {{ \Carbon\Carbon::parse($row->jadwal->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row->jadwal->end_time)->format('h:i A') }}
                    </p>
                    <h4 class="font-black text-slate-800 uppercase italic text-sm">DPJP</h4>
                    <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mt-1">
                        ⌚ {{ $row->jadwal->dpjp->fullname }}
                    </p>
                </div>
                <div>
                    
                </div>
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