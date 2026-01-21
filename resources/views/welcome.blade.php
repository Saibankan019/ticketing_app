<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BengTix – Ticketing App</title>

    <!-- Tailwind + DaisyUI -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
        }
        
        @keyframes gridMove {
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-glow {
            animation: glow 2s ease-in-out infinite;
        }
        
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 2s linear infinite;
        }
        
        .neon-text {
            text-shadow: 
                0 0 10px rgba(59, 130, 246, 0.8),
                0 0 20px rgba(59, 130, 246, 0.6),
                0 0 30px rgba(59, 130, 246, 0.4);
        }
        
        .scan-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
            animation: scan 3s ease-in-out infinite;
        }
        
        @keyframes scan {
            0%, 100% { top: 0; opacity: 0; }
            50% { top: 100%; opacity: 1; }
        }
        
        .feature-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
            transition: all 0.3s ease;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
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
    </style>
</head>

<body class="bg-gray-950 text-gray-100 relative overflow-x-hidden">

<!-- Background Elements -->
<div class="absolute inset-0 cyber-grid opacity-30 pointer-events-none"></div>
<div class="absolute top-20 left-20 w-64 h-64 bg-blue-500 rounded-full blur-3xl opacity-20 animate-float"></div>
<div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500 rounded-full blur-3xl opacity-20 animate-float" style="animation-delay: 1s;"></div>
<div class="absolute top-1/2 left-1/2 w-48 h-48 bg-pink-500 rounded-full blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>

<!-- Scan Line Effect -->
<div class="scan-line"></div>

<!-- Navbar -->
<nav class="relative z-10 navbar bg-transparent max-w-7xl mx-auto px-6 py-4">
    <div class="navbar-start">
        <h1 class="text-2xl font-black neon-text uppercase tracking-wider">
            BengTix
        </h1>
    </div>

    <div class="navbar-end gap-2">
        @auth
            <a href="{{ route('dashboard') }}"
               class="btn btn-sm cyber-btn text-white border-0">
                <span class="relative z-10">Dashboard</span>
            </a>
        @else
            <a href="{{ route('login') }}"
               class="btn btn-sm btn-ghost text-gray-300 hover:text-white hover:bg-blue-500/10">
                Login
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="btn btn-sm cyber-btn text-white border-0">
                    <span class="relative z-10">Register</span>
                </a>
            @endif
        @endauth
    </div>
</nav>

<!-- Hero Section -->
<section class="relative z-10 max-w-7xl mx-auto px-6 py-20 md:py-32 text-center">
    <div class="mb-8 inline-block">
        <div class="text-blue-400 text-sm tracking-widest mb-4 uppercase animate-pulse">[ SISTEM AKTIF ]</div>
    </div>
    
    <h2 class="text-5xl md:text-7xl font-black mb-6 neon-text">
        Amankan Tiketmu Sekarang
    </h2>

    <div class="h-1 w-64 mx-auto mb-8 bg-gradient-to-r from-transparent via-blue-500 to-transparent animate-glow"></div>

    <p class="text-gray-300 text-lg md:text-xl max-w-3xl mx-auto mb-4 leading-relaxed">
        BengTix memudahkan pembelian tiket event secara cepat, aman,
        dan modern dalam satu platform.
    </p>
    
    <p class="text-blue-400 text-base mb-12 font-light">
        &gt; Beli tiket, auto asik_
    </p>

    <div class="flex justify-center gap-4 flex-wrap">
        @auth
            <a href="{{ route('dashboard') }}"
               class="cyber-btn px-8 py-4 text-white rounded-lg font-bold uppercase tracking-wide">
                <span class="relative z-10">Masuk Dashboard</span>
            </a>
        @else
            <a href="{{ route('login') }}"
               class="cyber-btn px-8 py-4 text-white rounded-lg font-bold uppercase tracking-wide">
                <span class="relative z-10">Mulai Sekarang</span>
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-8 py-4 border-2 border-blue-500 hover:bg-blue-500/10 text-white rounded-lg font-bold uppercase tracking-wide transition-all duration-300">
                    Daftar
                </a>
            @endif
        @endauth
    </div>
</section>

<!-- Features Section -->
<section class="relative z-10 max-w-7xl mx-auto px-6 pb-24">
    <div class="mb-12 text-center">
        <div class="inline-block">
            <h3 class="text-3xl md:text-4xl font-black uppercase italic tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 mb-2">
                FITUR UNGGULAN//
            </h3>
            <div class="h-1 w-full bg-gradient-to-r from-blue-500 to-transparent"></div>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-8 text-center">
        <!-- Feature 1 -->
        <div class="feature-card rounded-2xl p-8 overflow-hidden">
            <div class="mb-6 inline-block p-4 bg-blue-600 rounded-lg animate-glow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-300">
                MANAJEMEN EVENT
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                Buat dan kelola event secara praktis melalui dashboard admin yang powerful dan intuitif.
            </p>
        </div>

        <!-- Feature 2 -->
        <div class="feature-card rounded-2xl p-8 overflow-hidden">
            <div class="mb-6 inline-block p-4 bg-purple-600 rounded-lg animate-glow" style="animation-delay: 0.2s;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-pink-300">
                PENJUALAN TIKET
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                Sistem tiket digital yang aman, terenkripsi, dan terintegrasi dengan payment gateway.
            </p>
        </div>

        <!-- Feature 3 -->
        <div class="feature-card rounded-2xl p-8 overflow-hidden">
            <div class="mb-6 inline-block p-4 bg-pink-600 rounded-lg animate-glow" style="animation-delay: 0.4s;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-transparent bg-clip-text bg-gradient-to-r from-pink-300 to-orange-300">
                RIWAYAT & LAPORAN
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                Pantau transaksi dan histori pembelian secara real-time dengan analytics mendalam.
            </p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="relative z-10 border-t border-blue-500/30 bg-gradient-to-b from-gray-900 to-black py-8 mt-12">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <div class="text-3xl font-black neon-text mb-3">BENGTIX</div>
        <div class="text-gray-500 text-sm">
            © {{ date('Y') }} BengTix. All rights reserved. [ SYSTEM v2.0 ]
        </div>
    </div>
</footer>

</body>
</html>