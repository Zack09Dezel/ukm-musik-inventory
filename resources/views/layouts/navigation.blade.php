<nav x-data="{ open: false }" class="bg-black/20 backdrop-blur-xl border-b border-white/10 sticky top-0 z-[100]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 no-underline group">
                        {{-- Logo --}}
                        <x-application-logo class="block h-9 w-auto fill-current text-pink-400 group-hover:text-white transition duration-300" />
                        
                        {{-- Teks di sebelah kanan logo --}}
                        <span class="text-white font-black tracking-tighter text-lg hidden md:block uppercase leading-none">
                            UKM <span class="text-pink-400">MUSIK</span>
                        </span>
                    </a>
                </div>
                
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white/70 hover:text-white no-underline border-pink-400 font-medium transition duration-300">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')" class="text-white/70 hover:text-white no-underline border-pink-400 font-medium transition duration-300">
                        {{ __('Items') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="text-white/70 hover:text-white no-underline border-pink-400 font-medium transition duration-300">
                            {{ __('Kategori') }}
                        </x-nav-link>

                        <x-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.*')" class="text-white/70 hover:text-white no-underline border-pink-400 font-medium transition duration-300">
                            {{ __('Peminjaman') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <div class="flex items-center bg-white/5 border border-white/10 px-4 py-2 rounded-xl gap-3">
                    <span class="text-white font-bold text-sm truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->role === 'admin')
                        <span class="text-[9px] bg-pink-500 text-white px-2 py-0.5 rounded-md font-black uppercase tracking-widest italic">Admin</span>
                    @endif
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-rose-500/20 hover:bg-rose-500/40 border border-rose-500/50 px-4 py-2 rounded-xl text-xs font-black text-rose-300 transition-all flex items-center gap-2 uppercase tracking-tighter">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-pink-400 hover:bg-white/10 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak class="sm:hidden bg-indigo-950 border-b border-white/10 p-4 space-y-3">
        <a href="{{ route('dashboard') }}" class="block text-white font-bold no-underline">Dashboard</a>
        <a href="{{ route('items.index') }}" class="block text-white font-bold no-underline">Items</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-rose-400 font-black uppercase text-sm">Logout</button>
        </form>
    </div>
</nav>