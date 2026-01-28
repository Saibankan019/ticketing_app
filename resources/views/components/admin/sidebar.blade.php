<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>

    <style>
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 10px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
        }
        
        .menu-item-active {
            background: linear-gradient(145deg, #1e40af, #1e3a8a);
            border-left: 3px solid #3b82f6;
            animation: glow-pulse 2s ease-in-out infinite;
        }
        
        .menu-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background: rgba(59, 130, 246, 0.1);
            border-left-color: #3b82f6;
            transform: translateX(5px);
        }
        
        .cyber-sidebar {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            border-right: 1px solid rgba(59, 130, 246, 0.2);
        }
        
        .logo-glow {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
            animation: glow-pulse 3s ease-in-out infinite;
        }
    </style>

    <div class="cyber-sidebar flex min-h-full flex-col w-64 is-drawer-close:w-14 is-drawer-open:w-80 shadow-2xl">

        <!-- LOGO -->
        <div class="w-full flex justify-center p-6 border-b border-blue-500/20 bg-gradient-to-r from-gray-900 to-gray-800">
            <img src="{{ asset('favicon-bengkod.png') }}"
                 alt="BengKod Logo"
                 class="w-12 h-12 rounded-lg logo-glow">
        </div>

        <!-- MENU -->
        <ul class="menu w-full grow gap-2 p-4">

            <!-- DASHBOARD -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="menu-item flex items-center gap-3 rounded-xl px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'menu-item-active text-white' : 'text-gray-300' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                    </svg>

                    <span class="is-drawer-close:hidden font-semibold">Dashboard</span>
                </a>
            </li>

            <!-- KATEGORI -->
            <li>
                <a href="{{ route('admin.categories.index') }}"
                   class="menu-item flex items-center gap-3 rounded-xl px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'menu-item-active text-white' : 'text-gray-300' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0 3 3 0 1 0-6 0"/>
                    </svg>

                    <span class="is-drawer-close:hidden font-semibold">Kategori</span>
                </a>
            </li>

            <!-- EVENT -->
            <li>
                <a href="{{ route('admin.events.index') }}"
                   class="menu-item flex items-center gap-3 rounded-xl px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'menu-item-active text-white' : 'text-gray-300' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>

                    <span class="is-drawer-close:hidden font-semibold">Event</span>
                </a>
            </li>

            <!-- LOKASI -->
            <li>
                <a href="{{ route('admin.lokasi.index') }}"
                   class="menu-item flex items-center gap-3 rounded-xl px-4 py-3 {{ request()->routeIs('admin.lokasi.*') ? 'menu-item-active text-white' : 'text-gray-300' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>

                    <span class="is-drawer-close:hidden font-semibold">Lokasi</span>
                </a>
            </li>

            <!-- PAYMENT TYPES -->
            <li>
                <a href="{{ route('admin.payment-types.index') }}"
                   class="menu-item flex items-center gap-3 rounded-xl px-4 py-3 {{ request()->routeIs('admin.payment-types.*') ? 'menu-item-active text-white' : 'text-gray-300' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                        <line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>

                    <span class="is-drawer-close:hidden font-semibold">Payment</span>
                </a>
            </li>

            <!-- HISTORY -->
            <li>
                <a href="{{ route('admin.histories.index') }}"
                   class="menu-item flex items-center gap-3 rounded-xl px-4 py-3 {{ request()->routeIs('admin.histories.*') ? 'menu-item-active text-white' : 'text-gray-300' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>

                    <span class="is-drawer-close:hidden font-semibold">History</span>
                </a>
            </li>

        </ul>

        <!-- USER INFO (Optional) -->
        <div class="p-4 border-t border-blue-500/20">
            <div class="flex items-center gap-3 px-3 py-2 rounded-lg bg-gradient-to-r from-blue-900/30 to-purple-900/30 border border-blue-500/20 is-drawer-close:hidden">
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-white truncate">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </div>
                    <div class="text-xs text-gray-400 truncate">
                        {{ Auth::user()->email ?? '' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-blue-500/20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-xl text-white font-semibold transition-all hover:scale-105 shadow-lg">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span class="is-drawer-close:hidden">Logout</span>
                </button>
            </form>
        </div>

    </div>
</div>