<x-layouts.admin title="Dashboard Admin">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }
        
        @keyframes pulse-border {
            0%, 100% { border-color: rgba(59, 130, 246, 0.3); }
            50% { border-color: rgba(59, 130, 246, 0.6); }
        }
        
        .cyber-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
            transition: all 0.3s ease;
        }
        
        .cyber-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }
        
        .cyber-card:hover {
            transform: translateY(-5px);
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        }
        
        .stat-icon {
            background: linear-gradient(145deg, #3b82f6, #2563eb);
            animation: glow 3s ease-in-out infinite;
        }
        
        .stat-badge {
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.4);
            color: #93c5fd;
        }
        
        .cyber-btn {
            background: linear-gradient(145deg, #3b82f6, #2563eb);
            border: 1px solid #3b82f6;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .cyber-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }
        
        .cyber-btn:hover::before {
            transform: translateX(100%);
        }
        
        .cyber-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }
        
        .welcome-card {
            background: linear-gradient(145deg, #1e3a8a, #1e40af);
            border: 1px solid rgba(59, 130, 246, 0.5);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        .stats-item {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }
        
        .stats-item:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.4);
            transform: translateX(5px);
        }
    </style>

    <div class="min-h-screen">
        <div class="container mx-auto p-6 md:p-10">

            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                        Dashboard Admin
                    </h1>
                </div>
                <p class="text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                    [ Selamat datang kembali! Berikut ringkasan data Anda ]
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <!-- Total Event -->
                <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
                    <div class="card-body p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon p-3 text-white rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="stat-badge text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wider">
                                Active
                            </span>
                        </div>

                        <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Total Event</p>
                        <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                            {{ $totalEvents ?? 0 }}
                        </p>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
                    <div class="card-body p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon p-3 text-white rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </div>
                            <span class="stat-badge text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wider">
                                Categories
                            </span>
                        </div>

                        <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Total Kategori</p>
                        <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                            {{ $totalCategories ?? 0 }}
                        </p>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
                    <div class="card-body p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="stat-icon p-3 text-white rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2"/>
                                </svg>
                            </div>
                            <span class="stat-badge text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wider">
                                Orders
                            </span>
                        </div>

                        <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Total Transaksi</p>
                        <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                            {{ $totalOrders ?? 0 }}
                        </p>
                    </div>
                </div>

            </div>

            <!-- Additional Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Statistik Cepat -->
                <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="h-6 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                            <h3 class="text-xl font-black uppercase tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                Statistik Cepat
                            </h3>
                        </div>

                        <div class="space-y-3">
                            <div class="stats-item flex justify-between p-4 rounded-lg">
                                <span class="text-sm text-gray-400 uppercase tracking-wider">Event Aktif</span>
                                <span class="font-bold text-xl text-blue-400">{{ $totalEvents ?? 0 }}</span>
                            </div>
                            <div class="stats-item flex justify-between p-4 rounded-lg">
                                <span class="text-sm text-gray-400 uppercase tracking-wider">Total Kategori</span>
                                <span class="font-bold text-xl text-purple-400">{{ $totalCategories ?? 0 }}</span>
                            </div>
                            <div class="stats-item flex justify-between p-4 rounded-lg">
                                <span class="text-sm text-gray-400 uppercase tracking-wider">Transaksi Sukses</span>
                                <span class="font-bold text-xl text-green-400">{{ $totalOrders ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Welcome -->
                <div class="welcome-card rounded-2xl shadow-2xl overflow-hidden">
                    <div class="card-body p-6 relative z-10">
                        <div class="flex items-center gap-2 mb-4">
                            <h3 class="text-3xl font-black text-white">Selamat Datang!</h3>
                            <span class="text-3xl animate-pulse">👋</span>
                        </div>
                        <p class="text-blue-100 mb-6 text-sm leading-relaxed">
                            Kelola event dan transaksi Anda dengan mudah melalui dashboard ini. 
                            Sistem terintegrasi untuk manajemen optimal.
                        </p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="{{ route('admin.events.index') }}"
                               class="cyber-btn px-6 py-3 text-white rounded-lg text-sm font-semibold uppercase tracking-wide">
                                <span class="relative z-10">Kelola Event</span>
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                               class="px-6 py-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white rounded-lg text-sm font-semibold uppercase tracking-wide transition-all hover:scale-105 border border-white/30">
                                Kelola Kategori
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layouts.admin>