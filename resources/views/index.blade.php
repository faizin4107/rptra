<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/img/logo-depok.png" type="image/x-icon">
    
    <tallstackui:script />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        
        /* Smooth Easing for Premium Feel (Spring Physics) */
        .ease-spring { transition-timing-function: cubic-bezier(0.25, 1, 0.5, 1); }
        
        /* Modern Gradient & Glassmorphism */
        .gradient-primary { background: linear-gradient(135deg, #4f46e5, #9333ea); }
        .bg-glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

        /* Elegant Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Pulse Badge Animasi Halus */
        .badge-pulse { animation: pulse-soft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse-soft { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: .8; transform: scale(1.05); } }
        
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="flex h-screen overflow-hidden text-slate-800 selection:bg-indigo-100 selection:text-indigo-900" x-data="{ sidebarOpen: false, desktopSidebarOpen: true }">

    <!-- OVERLAY (MOBILE) -->
    <div x-show="sidebarOpen" x-transition.opacity.duration.300ms 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-900/40 z-40 backdrop-blur-sm lg:hidden" x-cloak>
    </div>

    <!-- SIDEBAR -->
    <aside class="fixed inset-y-0 left-0 z-50 bg-white border-r border-slate-200/80 flex flex-col transition-all duration-500 ease-spring lg:relative shadow-2xl lg:shadow-none"
           :class="[
               sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
               desktopSidebarOpen ? 'w-[280px]' : 'w-[84px]'
           ]">
        
        <!-- HEADER LOGO -->
        <div class="h-20 flex items-center px-6 border-b border-slate-100/60 shrink-0 transition-all duration-500 ease-spring"
             :class="desktopSidebarOpen ? 'justify-between' : 'justify-center px-0'">
            
            <div class="flex items-center">
                <div class="w-10 h-10 shrink-0 bg-white rounded-xl flex items-center justify-center shadow-[0_4px_12px_-3px_rgba(79,70,229,0.15)] border border-slate-100 p-1.5 relative z-10 transition-transform duration-500 ease-spring"
                     :class="!desktopSidebarOpen && 'scale-110'">
                    <img src="/assets/img/logo-depok.png" alt="Logo" class="w-full h-full object-contain">
                </div>
                
                <div class="flex flex-col whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring"
                     :class="desktopSidebarOpen ? 'w-32 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">
                    <h1 class="font-extrabold text-slate-800 text-lg tracking-tight leading-none">Hermina</h1>
                    <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mt-1">Academy</p>
                </div>
            </div>

            <button @click="sidebarOpen = false" class="lg:hidden p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- MENU NAVIGASI -->
        <div class="flex-1 overflow-y-auto overflow-x-hidden p-4 space-y-1.5 pb-24 group/nav relative">
            
            <!-- 1. BERANDA UTAMA -->
            <a href="{{ route(auth()->user()->role . '.dashboard') }}" wire:navigate title="Beranda"
               @class([
                   'group flex items-center p-3 rounded-xl font-semibold text-sm transition-colors duration-200 relative overflow-hidden',
                   'bg-indigo-50 text-indigo-700' => $page == 'home',
                   'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' => $page != 'home'
               ])
               :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                <!-- Indikator pakai scale-y agar tidak flick saat dirender -->
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'home' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                
                <span class="text-xl shrink-0 transition-transform duration-300 ease-spring group-hover:scale-110">🏠</span>
                <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring flex items-center"
                      :class="desktopSidebarOpen ? 'w-40 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Beranda</span>
            </a>

            <!-- ===================== -->
            <!-- MENU ROLE: RESIDEN -->
            <!-- ===================== -->
            @if(auth()->user()->role == 'residen')
                
                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Aktivitas</p>
                </div>

                <a href="{{ route('residen.presensi-kehadiran') }}" wire:navigate title="Presensi Kehadiran"
                   @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'absensi', 'text-slate-500 hover:bg-slate-50' => $page != 'absensi'])
                   :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'absensi' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">🕒</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Presensi Kehadiran</span>
                </a>
                
                <a href="?p=my-jadwal" title="Jadwal Saya"
                   @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'my-jadwal', 'text-slate-500 hover:bg-slate-50' => $page != 'my-jadwal'])
                   :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'my-jadwal' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📅</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Jadwal Saya</span>
                </a>

                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Assessment & Logbook</p>
                </div>

                <a href="?p=krs" title="Isi KRS" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'krs', 'text-slate-500 hover:bg-slate-50' => $page != 'krs']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'krs' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📑</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Isi KRS</span>
                </a>
                <a href="?p=logbook-dasar" title="Isi Logbook" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-emerald-50 text-emerald-700' => $page == 'logbook-dasar', 'text-slate-500 hover:bg-slate-50' => $page != 'logbook-dasar']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-emerald-600 rounded-r-md transition-transform duration-300 {{ $page == 'logbook-dasar' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📝</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Isi Logbook</span>
                </a>
                <a href="?p=mini-cex" title="Daftar Mini-CEX" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-rose-50 text-rose-700' => $page == 'mini-cex', 'text-slate-500 hover:bg-slate-50' => $page != 'mini-cex']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-rose-600 rounded-r-md transition-transform duration-300 {{ $page == 'mini-cex' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">⭐</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Daftar Mini-CEX</span>
                </a>
                <a href="?p=dirgo" title="Residen Dirgo (Report)" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-purple-50 text-purple-700' => $page == 'dirgo', 'text-slate-500 hover:bg-slate-50' => $page != 'dirgo']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-purple-600 rounded-r-md transition-transform duration-300 {{ $page == 'dirgo' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📊</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Residen Dirgo (Report)</span>
                </a>

                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Hasil Studi</p>
                </div>

                <a href="?p=khs-akademik" title="KHS Akademik" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'khs-akademik', 'text-slate-500 hover:bg-slate-50' => $page != 'khs-akademik']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'khs-akademik' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">🎓</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">KHS Akademik</span>
                </a>
                <a href="?p=khs-logbook" title="Summary Logbook" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'khs-logbook', 'text-slate-500 hover:bg-slate-50' => $page != 'khs-logbook']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'khs-logbook' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📋</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Summary Logbook</span>
                </a>


            <!-- ===================== -->
            <!-- MENU ROLE: DPJP -->
            <!-- ===================== -->
            @elseif(auth()->user()->role == 'dpjp')
                
                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Aktivitas</p>
                </div>

                <a href="?p=absensi" title="Presensi Kehadiran" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'absensi', 'text-slate-500 hover:bg-slate-50' => $page != 'absensi']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'absensi' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">🕒</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Presensi Kehadiran</span>
                </a>
                <a href="?p=my-jadwal" title="Jadwal Saya" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'my-jadwal', 'text-slate-500 hover:bg-slate-50' => $page != 'my-jadwal']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'my-jadwal' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📅</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Jadwal Saya</span>
                </a>

                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Persetujuan</p>
                </div>
                
                <a href="?p=verifikasi" title="Verifikasi Logbook" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700 shadow-sm' => $page == 'verifikasi', 'text-slate-500 hover:bg-slate-50' => $page != 'verifikasi']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'verifikasi' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    
                    <div class="relative shrink-0">
                        <span class="text-xl transition-transform duration-300 group-hover:scale-110">✅</span>
                        @if($total_notif > 0 && !$desktopSidebarOpen) 
                            <span class="absolute -top-1 -right-2 w-3 h-3 bg-indigo-500 rounded-full border-2 border-white badge-pulse"></span> 
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">
                        <span>Verifikasi Logbook</span>
                        @if($total_notif > 0)
                            <span class="bg-indigo-500 text-white font-bold text-[10px] px-1.5 py-0.5 rounded-full badge-pulse shadow-sm">{{ $total_notif }}</span>
                        @endif
                    </div>
                </a>

                <a href="?p=evaluasi" title="Penilaian Mini-CEX" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-rose-50 text-rose-700 shadow-sm' => $page == 'evaluasi', 'text-slate-500 hover:bg-slate-50' => $page != 'evaluasi']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-rose-600 rounded-r-md transition-transform duration-300 {{ $page == 'evaluasi' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    
                    <div class="relative shrink-0">
                        <span class="text-xl transition-transform duration-300 group-hover:scale-110">⭐</span>
                        @if($notif_eval > 0 && !$desktopSidebarOpen) 
                            <span class="absolute -top-1 -right-2 w-3 h-3 bg-rose-500 rounded-full border-2 border-white badge-pulse"></span> 
                        @endif
                    </div>

                    <div class="flex items-center justify-between whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">
                        <span>Penilaian Mini-CEX</span>
                        @if($notif_eval > 0)
                            <span class="bg-rose-500 text-white font-bold text-[10px] px-1.5 py-0.5 rounded-full badge-pulse shadow-sm">{{ $notif_eval }}</span>
                        @endif
                    </div>
                </a>

                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Monitoring</p>
                </div>
                <a href="?p=portfolio-residen" title="Portfolio Residen" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-emerald-50 text-emerald-700' => $page == 'portfolio-residen', 'text-slate-500 hover:bg-slate-50' => $page != 'portfolio-residen']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-emerald-600 rounded-r-md transition-transform duration-300 {{ $page == 'portfolio-residen' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📊</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Portfolio Residen</span>
                </a>


            <!-- ===================== -->
            <!-- MENU ROLE: ADMIN -->
            <!-- ===================== -->
            @elseif(auth()->user()->role == 'admin')
                
                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Manajemen</p>
                </div>

                <a href="{{ route('admin.users.index') }}" wire:navigate title="Data User" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-indigo-50 text-indigo-700' => $page == 'manage_users', 'text-slate-500 hover:bg-slate-50' => $page != 'manage_users']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ $page == 'manage_users' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">👥</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Data User</span>
                </a>
                <a href="{{ route('admin.verification-users') }}" wire:navigate title="Verifikasi Akun Baru" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-orange-50 text-orange-700' => $page == 'verifikasi_residen', 'text-slate-500 hover:bg-slate-50' => $page != 'verifikasi_residen']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-orange-600 rounded-r-md transition-transform duration-300 {{ $page == 'verifikasi_residen' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">✉️</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Verifikasi Akun Baru</span>
                </a>
                <a href="{{ route('admin.audit-trail-system') }}" wire:navigate title="Audit Trail System" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-slate-100 text-slate-800' => $page == 'audit_logs', 'text-slate-500 hover:bg-slate-50' => $page != 'audit_logs']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-slate-600 rounded-r-md transition-transform duration-300 {{ $page == 'audit_logs' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">🕵️</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Audit Trail System</span>
                </a>
                <a href="{{ route('admin.jadwal-dinas') }}" wire:navigate title="Atur Jadwal Dinas" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-emerald-50 text-emerald-700' => $page == 'manage_jadwal', 'text-slate-500 hover:bg-slate-50' => $page != 'manage_jadwal']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-emerald-600 rounded-r-md transition-transform duration-300 {{ $page == 'manage_jadwal' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📅</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Atur Jadwal Dinas</span>
                </a>
                <a href="{{ route('admin.krs') }}" wire:navigate title="Master Modul KRS" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-amber-50 text-amber-700' => $page == 'manage_krs', 'text-slate-500 hover:bg-slate-50' => $page != 'manage_krs']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-amber-600 rounded-r-md transition-transform duration-300 {{ $page == 'manage_krs' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">📚</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Master Modul KRS</span>
                </a>
                <a href="{{ route('admin.modul') }}" wire:navigate title="Kelola Kuota Modul" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-blue-50 text-blue-700' => $page == 'manage_modul', 'text-slate-500 hover:bg-slate-50' => $page != 'manage_modul']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-blue-600 rounded-r-md transition-transform duration-300 {{ $page == 'manage_modul' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                    <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">⚙️</span>
                    <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Kelola Kuota Modul</span>
                </a>
                
                <!-- Separator Border -->
                <div class="mt-4 pt-4 border-t border-slate-100/80 transition-all duration-500 ease-spring">
                    <a href="{{ route('admin.integrasi-pusat') }}" wire:navigate title="Integrasi Pusat" @class(['group flex items-center p-3 rounded-xl text-sm font-medium transition-colors duration-200 relative overflow-hidden', 'bg-purple-50 text-purple-700 shadow-sm ring-1 ring-purple-100' => $page == 'integrasi_pusat', 'text-slate-500 hover:bg-slate-50' => $page != 'integrasi_pusat']) :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-purple-600 rounded-r-md transition-transform duration-300 {{ $page == 'integrasi_pusat' ? 'scale-y-100' : 'scale-y-0' }}"></div>
                        <span class="text-xl shrink-0 transition-transform duration-300 group-hover:scale-110">🌐</span>
                        <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-44 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Integrasi Pusat</span>
                    </a>
                </div>
            @endif

            <!-- Area Logout Sidebar Bawah -->
            <div class="mt-8 pt-4 border-t border-slate-100/60 overflow-hidden transition-all duration-500 ease-spring"
                 :class="desktopSidebarOpen ? 'opacity-100 h-auto block' : 'opacity-0 h-0 hidden'">
                <livewire:auth.logout />
            </div>
            
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col min-w-0 h-screen transition-all duration-500 ease-spring relative bg-slate-50/50">
        
        <!-- TOP NAVBAR (Glassmorphism + Sticky) -->
        <header class="h-20 bg-glass border-b border-slate-200/60 flex items-center justify-between px-6 z-30 sticky top-0 shadow-[0_2px_20px_-15px_rgba(0,0,0,0.1)]">
            
            <div class="flex items-center gap-5">
                <!-- Tombol Toggle Sidebar -->
                <button @click="sidebarOpen = true; desktopSidebarOpen = !desktopSidebarOpen" 
                        class="p-2.5 rounded-xl bg-white border border-slate-200/80 text-slate-500 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all duration-300 group">
                    <svg class="w-5 h-5 transition-transform duration-300 group-active:scale-90" 
                         :class="desktopSidebarOpen ? '' : 'rotate-180'"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                </button>

                <!-- Header Text -->
                <div class="hidden sm:block">
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight leading-none mb-1">
                        {{ $title ?? 'Dashboard' }}
                    </h2>
                    <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Portal Manajemen Internal</p>
                </div>
            </div>

            <!-- Profil User Kanan -->
            <div class="flex items-center gap-3 md:gap-4">
                <div x-data="{ profileOpen: false }" class="relative">
                    <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" 
                            class="flex items-center gap-3 p-1.5 pr-4 rounded-full border border-slate-200 hover:border-indigo-300 hover:shadow-[0_2px_10px_-3px_rgba(79,70,229,0.15)] transition-all bg-white group">
                        
                        <div class="w-9 h-9 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-sm shadow-inner group-active:scale-95 transition-transform">
                            {{ substr(auth()->user()->fullname, 0, 1) }}
                        </div>
                        <div class="hidden md:flex flex-col text-left">
                            <p class="text-sm font-bold text-slate-700 leading-none mb-1 group-hover:text-indigo-600 transition-colors">{{ auth()->user()->fullname }}</p>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider leading-none">{{ auth()->user()->role }}</p>
                        </div>
                        <svg :class="profileOpen ? 'rotate-180' : ''" class="w-4 h-4 text-slate-400 hidden md:block transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <!-- Dropdown Profil -->
                    <div x-show="profileOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                         class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 overflow-hidden" x-cloak>
                        
                        <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50 mb-1 md:hidden">
                            <p class="text-sm font-bold text-slate-800">{{ auth()->user()->fullname }}</p>
                            <p class="text-xs text-slate-500">{{ auth()->user()->username }}</p>
                        </div>
                        
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Profil Saya
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Pengaturan
                        </a>
                        
                        <div class="border-t border-slate-100 mt-1">
                           <livewire:auth.logout />
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT SLOT -->
        <div class="flex-1 overflow-y-auto p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </div>

    </main>
    
    @persist('tallstackui-interactions')
        <x-toast />
        <x-dialog />
    @endpersist
    @livewireScripts
</body>
</html>