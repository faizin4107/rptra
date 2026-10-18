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
        <link rel="shortcut icon" href="/assets/img/13297903.png" type="image/x-icon">

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
        <livewire:utils.sidebar />


        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 flex flex-col min-w-0 h-screen transition-all duration-500 ease-spring relative bg-slate-50/50">
            
            <!-- TOP NAVBAR (Glassmorphism + Sticky) -->
            <livewire:utils.header />
            

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