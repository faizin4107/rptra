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
                            class="cursor-pointer flex items-center gap-3 p-1.5 pr-4 rounded-full border border-slate-200 hover:border-indigo-300 hover:shadow-[0_2px_10px_-3px_rgba(79,70,229,0.15)] transition-all bg-white group">
                        
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
                        
                        <div class="border-t border-slate-100 mt-1">
                           <livewire:auth.logout />
                        </div>
                    </div>
                </div>
            </div>
        </header>