@php
    // Cek apakah URL saat ini mengandung parameter 'role'
    $currentRole = request()->route('role');
    $isUserMenuOpen = in_array($currentRole, ['admin']) || request()->routeIs('admin.users.admin') || request()->routeIs('admin.users.pengguna');
    $isReservationMenuOpen = in_array($currentRole, ['admin']) || request()->routeIs('admin.reservation.index');
@endphp
<aside class="fixed inset-y-0 left-0 z-50 bg-white border-r border-slate-200/80 flex flex-col transition-all duration-500 ease-spring lg:relative shadow-2xl lg:shadow-none"
           :class="[
               sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
               desktopSidebarOpen ? 'w-[280px]' : 'w-[84px]'
           ]">
        
        <!-- HEADER LOGO -->
        <div class="h-20 flex items-center px-6 border-b border-slate-100/60 shrink-0 transition-all duration-500 ease-spring"
             :class="desktopSidebarOpen ? 'justify-between' : 'justify-center px-0'">
            
            <div class="flex items-center">
                
                
                <div class="flex flex-col whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring"
                     :class="desktopSidebarOpen ? 'w-32 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">
                    <h1 class="font-extrabold text-slate-800 text-lg tracking-tight leading-none">RPTRA</h1>
                    <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mt-1">Dashboard</p>
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
                   'bg-indigo-50 text-indigo-700' => request()->routeIs('*.dashboard'),
                   'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' => !request()->routeIs('*.dashboard')
               ])
               :class="desktopSidebarOpen ? 'justify-start' : 'justify-center'">
                <!-- Indikator pakai scale-y agar tidak flick saat dirender -->
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r-md transition-transform duration-300 {{ request()->routeIs('*.dashboard') ? 'scale-y-100' : 'scale-y-0' }}"></div>
                
                <span class="text-xl shrink-0 transition-transform duration-300 ease-spring group-hover:scale-110">🏠</span>
                <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring flex items-center"
                      :class="desktopSidebarOpen ? 'w-40 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">Beranda</span>
            </a>


            <!-- ===================== -->
            <!-- MENU ROLE: ADMIN -->
            <!-- ===================== -->
            @if(auth()->user()->role == 'admin')
                
                <div class="pt-4 pb-2 whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring" :class="desktopSidebarOpen ? 'w-auto opacity-100 px-3' : 'w-0 opacity-0 h-0 pt-0 pb-0'">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Manajemen</p>
                </div>

                <div x-data="{ open: {{ $isUserMenuOpen ? 'true' : 'false' }} }" class="mt-1 relative">
                    
                    <!-- Tombol Induk (Toggle) -->
                    <button @click="if(desktopSidebarOpen) open = !open" 
                            title="Data User"
                            class="cursor-pointer group flex items-center w-full p-3 rounded-xl text-sm font-medium transition-all duration-300 ease-spring relative overflow-hidden"
                            :class="[
                                desktopSidebarOpen ? 'justify-between' : 'justify-center',
                                open ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600'
                            ]">
                        
                        <div class="flex items-center">
                            <span class="text-xl shrink-0 transition-transform duration-300 ease-spring group-hover:scale-110" :class="open ? 'scale-110' : ''">👥</span>
                            <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring text-left"
                                :class="desktopSidebarOpen ? 'w-32 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">
                                Data User
                            </span>
                        </div>
                        
                        <!-- Ikon Panah -->
                        <svg :class="[open ? 'rotate-180 text-indigo-600' : 'text-slate-400', !desktopSidebarOpen ? 'w-0 opacity-0' : 'w-4 opacity-100']" 
                            class="shrink-0 transition-all duration-300 ease-spring group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <!-- Area Sub-Menu -->
                    <div x-show="open && desktopSidebarOpen" x-collapse x-cloak>
                        <div class="pl-12 pr-3 py-2 space-y-1 relative before:content-[''] before:absolute before:left-6 before:top-0 before:bottom-3 before:w-px before:bg-slate-200">
                            
                            <!-- Sub Item 1: Admin -->
                            <a href="{{ route('admin.users.admin') }}" wire:navigate 
                            class="block py-2 text-[13px] transition-colors relative before:content-[''] before:absolute before:left-[-24px] before:top-1/2 before:-translate-y-1/2 before:w-3 before:h-px before:transition-colors {{ $currentRole === 'admin' ? 'font-bold text-indigo-600 before:bg-indigo-600' : 'font-medium text-slate-500 hover:text-indigo-600 before:bg-slate-200 hover:before:bg-indigo-600' }}">
                                Data Admin
                            </a>

                            <!-- Sub Item 2: DPJP -->
                            <a href="{{ route('admin.users.pengguna') }}" wire:navigate 
                            class="block py-2 text-[13px] transition-colors relative before:content-[''] before:absolute before:left-[-24px] before:top-1/2 before:-translate-y-1/2 before:w-3 before:h-px before:transition-colors {{ $currentRole === 'dpjp' ? 'font-bold text-indigo-600 before:bg-indigo-600' : 'font-medium text-slate-500 hover:text-indigo-600 before:bg-slate-200 hover:before:bg-indigo-600' }}">
                                Data Pengguna
                            </a>


                        </div>
                    </div>

                    <div x-data="{ open: {{ $isReservationMenuOpen ? 'true' : 'false' }} }" class="mt-1 relative">
                    
                        <!-- Tombol Induk (Toggle) -->
                        <button @click="if(desktopSidebarOpen) open = !open" 
                                title="Reservation"
                                class="cursor-pointer group flex items-center w-full p-3 rounded-xl text-sm font-medium transition-all duration-300 ease-spring relative overflow-hidden"
                                :class="[
                                    desktopSidebarOpen ? 'justify-between' : 'justify-center',
                                    open ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600'
                                ]">
                            
                            <div class="flex items-center">
                                <span class="text-xl shrink-0 transition-transform duration-300 ease-spring group-hover:scale-110" :class="open ? 'scale-110' : ''">📚</span>
                                <span class="whitespace-nowrap overflow-hidden transition-all duration-500 ease-spring text-left"
                                    :class="desktopSidebarOpen ? 'w-32 opacity-100 ml-3' : 'w-0 opacity-0 ml-0'">
                                    Reservation
                                </span>
                            </div>
                            
                            <!-- Ikon Panah -->
                            <svg :class="[open ? 'rotate-180 text-indigo-600' : 'text-slate-400', !desktopSidebarOpen ? 'w-0 opacity-0' : 'w-4 opacity-100']" 
                                class="shrink-0 transition-all duration-300 ease-spring group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Area Sub-Menu -->
                        <div x-show="open && desktopSidebarOpen" x-collapse x-cloak>
                            <div class="pl-12 pr-3 py-2 space-y-1 relative before:content-[''] before:absolute before:left-6 before:top-0 before:bottom-3 before:w-px before:bg-slate-200">
                                

                                <a href="{{ route('admin.reservation.index', ['status' => 'pending']) }}" wire:navigate 
                                class="block py-2 text-[13px] transition-colors relative before:content-[''] before:absolute before:left-[-24px] before:top-1/2 before:-translate-y-1/2 before:w-3 before:h-px before:transition-colors {{ $currentRole === 'dpjp' ? 'font-bold text-indigo-600 before:bg-indigo-600' : 'font-medium text-slate-500 hover:text-indigo-600 before:bg-slate-200 hover:before:bg-indigo-600' }}">
                                    Pending
                                </a>
                                <a href="{{ route('admin.reservation.index', ['status' => 'booking']) }}" wire:navigate 
                                class="block py-2 text-[13px] transition-colors relative before:content-[''] before:absolute before:left-[-24px] before:top-1/2 before:-translate-y-1/2 before:w-3 before:h-px before:transition-colors {{ $currentRole === 'dpjp' ? 'font-bold text-indigo-600 before:bg-indigo-600' : 'font-medium text-slate-500 hover:text-indigo-600 before:bg-slate-200 hover:before:bg-indigo-600' }}">
                                    Booking
                                </a>

                                <a href="{{ route('admin.reservation.index', ['status' => 'selesai']) }}" wire:navigate 
                                class="block py-2 text-[13px] transition-colors relative before:content-[''] before:absolute before:left-[-24px] before:top-1/2 before:-translate-y-1/2 before:w-3 before:h-px before:transition-colors {{ $currentRole === 'residen' ? 'font-bold text-indigo-600 before:bg-indigo-600' : 'font-medium text-slate-500 hover:text-indigo-600 before:bg-slate-200 hover:before:bg-indigo-600' }}">
                                    Selesai
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                
            @endif

            <!-- Area Logout Sidebar Bawah -->
            <div class="mt-8 pt-4 border-t border-slate-100/60 overflow-hidden transition-all duration-500 ease-spring"
                 :class="desktopSidebarOpen ? 'opacity-100 h-auto block' : 'opacity-0 h-0 hidden'">
                <livewire:auth.logout />
            </div>
            
        </div>
    </aside>