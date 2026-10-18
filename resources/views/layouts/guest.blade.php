<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking RPTRA Pondok Labu</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Phosphor Icons for elegant UI icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        /* SMOOTH ANIMATION SNIPPET */
        /* Menggunakan cubic-bezier khusus agar transisi hover terasa seperti aplikasi native (60fps) */
        .spring-transition {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        /* Hardware acceleration untuk animasi transform */
        .hover-lift:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.05), 0 8px 10px -6px rgb(0 0 0 / 0.05);
        }

        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #059669, #10b981);
        }
        /* Animasi masuk form agar tidak kaku */
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-enter {
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Ambient background glow */
        .ambient-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, rgba(248, 250, 252, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* Image hover zoom effect */
        .card-zoom-image {
            transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .group:hover .card-zoom-image {
            transform: scale(1.05);
        }

        /* Confetti/Success background ambient */
        .ambient-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, rgba(248, 250, 252, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Pulse animation for pending status */
        @keyframes subtlePulse {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        .status-dot-pending {
            animation: subtlePulse 2s infinite cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-emerald-200 selection:text-emerald-900 flex flex-col min-h-screen">

    {{ $slot }}

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white pt-12 pb-8 text-center">
        <p class="text-sm text-slate-500">
            &copy; 2026 Kelurahan Pondok Labu - Sistem Reservasi RPTRA. All rights reserved.
        </p>
    </footer>
    @persist('tallstackui-interactions')
        <x-toast />
        <x-dialog />
    @endpersist
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>