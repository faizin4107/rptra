<div>
    <!-- CSS Khusus untuk Animasi Staggered Dashboard -->
    <style>
        .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
    </style>

    <div class="space-y-6 relative z-10">
        
        <!-- SECTION 1: METRIC CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
            
            <!-- Card 1: Residen -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(6,81,237,0.1)] transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up">
                <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 ease-out"></div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-50/80 text-indigo-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 ease-spring">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Pengguna</p>
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight leading-none"><?= number_format($total_pengguna) ?></h3>
                    </div>
                </div>
            </div>

            <!-- Card 2: DPJP -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-[0_2px_10px_-3px_rgba(16,185,129,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(16,185,129,0.1)] transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up delay-100">
                <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 ease-out"></div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50/80 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 ease-spring">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Pemesanan Pending</p>
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight leading-none"><?= number_format($total_pemesanan_pending) ?></h3>
                        
                    </div>
                </div>
            </div>

            <!-- Card 3: Modul -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up delay-200">
                <div class="absolute top-0 left-0 w-full h-1 bg-sky-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 ease-out"></div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-sky-50/80 text-sky-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 ease-spring">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Pemesanan Booking</p>
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight leading-none"><?= number_format($total_pemesanan_booking) ?></h3>
                    </div>
                </div>
            </div>

            <!-- Card 4: Pending KRS -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-[0_2px_10px_-3px_rgba(244,63,94,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(244,63,94,0.1)] transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up delay-300">
                <div class="absolute top-0 left-0 w-full h-1 bg-rose-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 ease-out"></div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-rose-50/80 text-rose-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-500 ease-spring">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Pemesanan Selesai</p>
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight leading-none"><?= number_format($total_pemesanan_selesai) ?></h3>
                    </div>
                </div>
            </div>

            <!-- Card 5: Siap Lulus (Premium Dark Accent) -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-6 shadow-lg shadow-slate-200/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 ease-spring group relative overflow-hidden animate-fade-up delay-400">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-500/20 rounded-full blur-xl pointer-events-none group-hover:scale-150 transition-transform duration-700"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-white/10 text-indigo-300 border border-white/10 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-500 ease-spring">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest leading-none mb-1.5">Total Pemesanan</p>
                        <h3 class="text-2xl font-black text-white tracking-tight leading-none"><?= number_format($total_pemesanan) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

</div>