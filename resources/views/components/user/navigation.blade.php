<nav class="relative z-50 bg-gradient-to-r from-gray-950 via-gray-900 to-black
            border-b border-blue-500/30">

    {{-- Glow Background --}}
    <div class="absolute inset-0 cyber-grid opacity-20"></div>

    <div class="navbar max-w-7xl mx-auto px-6 relative text-white">

        {{-- LEFT --}}
        <div class="navbar-start gap-3">
            {{-- Mobile Menu --}}
            <div class="dropdown lg:hidden">
                <label tabindex="0" class="btn btn-ghost text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
            </div>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img
                    src="{{ asset('assets/images/logo_bengkod.jpg') }}"
                    alt="Logo BengTix"
                    class="w-12 h-12 object-contain rounded-lg
                           ring-2 ring-blue-500/50 ring-offset-2 ring-offset-gray-900
                           shadow-lg shadow-blue-500/30"
                >

                <span class="hidden md:block text-xl font-black tracking-widest neon-text">
                    BENGTIX
                </span>
            </a>
        </div>

        {{-- RIGHT --}}
        <div class="navbar-end gap-3">

            @guest
                <a href="{{ route('login') }}"
                   class="px-6 py-2 bg-blue-600 hover:bg-blue-500
                          rounded-lg font-semibold transition-all hover:scale-105">
                    LOGIN
                </a>

                <a href="{{ route('register') }}"
                   class="px-6 py-2 border border-blue-500/40
                          hover:bg-blue-500/10 rounded-lg font-semibold text-blue-400">
                    REGISTER
                </a>
            @endguest

            @auth
                <div class="dropdown dropdown-end">
                    <label tabindex="0"
                           class="flex items-center gap-2 px-4 py-2
                                  bg-gray-900 border border-blue-500/30
                                  rounded-lg cursor-pointer
                                  hover:bg-blue-500/10 transition">

                        <span class="text-sm font-semibold">
                            {{ Auth::user()->name }}
                        </span>

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4 text-blue-400"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </label>

                    {{-- DROPDOWN --}}
                    <ul tabindex="0"
                        class="mt-3 w-56 rounded-xl p-2
                               bg-gradient-to-br from-gray-900 to-black
                               border border-blue-500/30
                               shadow-xl shadow-blue-500/30">

                        {{-- EDITED PART --}}
                        <li>
                            <a href="{{ route('orders.index') }}"
                               class="flex items-center gap-2 px-4 py-2 rounded-lg
                                      hover:bg-blue-500/10 transition text-sm">
                                🧾 Riwayat Pembelian
                            </a>
                        </li>

                        <li class="border-t border-blue-500/20 mt-2 pt-2">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="flex items-center gap-2 px-4 py-2 rounded-lg
                                      hover:bg-red-500/10 text-red-400 transition text-sm">
                                ⏻ Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

        </div>
    </div>
</nav>
