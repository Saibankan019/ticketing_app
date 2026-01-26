<x-layouts.app>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .order-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }
        
        .order-card:hover {
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        
        .cyber-btn {
            background: linear-gradient(145deg, #1e40af, #1e3a8a);
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
        
        .payment-badge {
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.4);
            animation: float 3s ease-in-out infinite;
        }
    </style>

    <section class="relative max-w-7xl mx-auto py-16 px-6">
        <!-- Background Effects -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-950/20 to-transparent pointer-events-none"></div>

        <!-- Title -->
        <div class="relative mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl md:text-4xl font-black uppercase italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    Riwayat Pembelian
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ HISTORY TRANSAKSI ANDA ]
            </p>
        </div>

        <!-- Orders -->
        <div class="relative space-y-6">
            @forelse($orders as $order)
                <article class="order-card flex flex-col lg:flex-row rounded-2xl overflow-hidden">

                    <!-- Image -->
                    <div class="lg:w-64 h-48 lg:h-auto bg-gray-800 overflow-hidden">
                        <img
                            src="{{ $order->event?->gambar
                                ? (filter_var($order->event->gambar, FILTER_VALIDATE_URL)
                                    ? $order->event->gambar
                                    : asset('images/events/' . $order->event->gambar))
                                : asset('assets/images/placeholder.jpg') }}"
                            alt="{{ $order->event?->judul ?? 'Event' }}"
                            class="w-full h-full object-cover hover:scale-110 transition duration-500"
                        >
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-between flex-1 p-6">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs text-gray-500 uppercase tracking-wider">
                                    Order #{{ $order->id }}
                                </span>
                                @if($order->paymentType)
                                    <span class="payment-badge px-3 py-1 rounded-full text-xs font-semibold text-blue-300">
                                        💳 {{ $order->paymentType->nama }}
                                    </span>
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-purple-300 mb-2">
                                {{ $order->event?->judul ?? 'Event' }}
                            </h2>

                            <div class="flex items-center gap-2 text-sm text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $order->order_date->translatedFormat('d F Y, H:i') }}
                            </div>
                        </div>

                        <!-- Price & Action -->
                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-blue-500/20">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Total Pembayaran</div>
                                <div class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </div>
                            </div>

                            <a href="{{ route('orders.show', $order->id) }}"
                               class="cyber-btn px-6 py-3 rounded-lg text-white text-sm font-semibold uppercase tracking-wide">
                                <span class="relative z-10">Lihat Detail</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="order-card rounded-2xl p-12 text-center">
                    <div class="text-gray-500">
                        <div class="text-6xl mb-4">🎫</div>
                        <p class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-2">
                            BELUM ADA PESANAN
                        </p>
                        <p class="text-sm text-gray-400 mb-6">Mulai beli tiket event favoritmu sekarang!</p>
                        <a href="{{ route('home') }}" 
                           class="cyber-btn inline-block px-6 py-3 rounded-lg text-white text-sm font-semibold uppercase tracking-wide">
                            <span class="relative z-10">Jelajahi Event</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

    </section>
</x-layouts.app>