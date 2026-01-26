<x-layouts.app>
    <style>
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }
        
        .detail-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
        }
        
        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }
        
        .ticket-item {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }
        
        .ticket-item:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.4);
            transform: translateX(5px);
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
        
        .cyber-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }
        
        .payment-info {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            animation: glow 3s ease-in-out infinite;
        }
    </style>

    <section class="relative max-w-5xl mx-auto py-16 px-6">

        <!-- Header -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                        <h1 class="text-3xl font-black uppercase italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                            Detail Pemesanan
                        </h1>
                    </div>
                    <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                        [ ORDER #{{ $order->id }} ]
                    </p>
                </div>

                <div class="text-sm text-gray-400">
                    {{ $order->order_date->translatedFormat('d F Y, H:i') }}
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="detail-card rounded-2xl shadow-2xl overflow-hidden">

            <div class="flex flex-col lg:flex-row">

                <!-- Event Image -->
                <div class="lg:w-1/3 bg-gray-800 overflow-hidden">
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
                <div class="flex-1 p-8">

                    <!-- Event Info -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-purple-300 mb-2">
                            {{ $order->event?->judul ?? 'Event' }}
                        </h2>
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $order->event?->lokasi ?? '' }}
                        </div>
                    </div>

                    <!-- Payment Type Info -->
                    @if($order->paymentType)
                        <div class="payment-info rounded-lg p-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="text-3xl">💳</div>
                                <div>
                                    <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Metode Pembayaran</div>
                                    <div class="text-lg font-bold text-blue-300">{{ $order->paymentType->nama }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Ticket Detail -->
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="h-5 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400">
                                Detail Tiket
                            </h3>
                        </div>

                        <div class="space-y-3">
                            @foreach($order->detailOrders as $d)
                                <div class="ticket-item flex justify-between items-center p-4 rounded-lg">
                                    <div>
                                        <div class="font-semibold text-white">
                                            {{ $d->tiket->tipe }}
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            Qty: <span class="text-blue-400 font-semibold">{{ $d->jumlah }}</span>
                                        </div>
                                    </div>

                                    <div class="font-bold text-green-400">
                                        Rp {{ number_format($d->subtotal_harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent my-6"></div>

                    <!-- Total -->
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-sm uppercase tracking-wider text-gray-400">
                            Total Pembayaran
                        </span>
                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('orders.index') }}"
               class="cyber-btn inline-flex items-center gap-2 px-6 py-3 rounded-lg text-white font-semibold uppercase tracking-wide">
                <span class="relative z-10">
                    ← Kembali ke Riwayat
                </span>
            </a>
        </div>

    </section>
</x-layouts.app>