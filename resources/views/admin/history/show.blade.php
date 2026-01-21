<x-layouts.admin title="Detail Pemesanan">
    <style>
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }

        .cyber-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
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

        .detail-item {
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: rgba(59, 130, 246, 0.05);
            padding-left: 0.5rem;
            border-left: 3px solid #3b82f6;
        }
    </style>

    <section class="max-w-5xl mx-auto py-12 px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                        <h1 class="text-3xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                            Detail Pemesanan
                        </h1>
                    </div>
                    <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                        [ ORDER #{{ $order->id }} ]
                    </p>
                </div>

                <div class="ml-4 md:ml-0">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">
                        Tanggal Order
                    </div>
                    <div class="text-sm font-semibold text-blue-400">
                        {{ $order->order_date->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="lg:flex">

                <!-- IMAGE -->
                <div class="lg:w-1/3 p-6 border-r border-blue-500/20">
                    <div class="relative mb-4 rounded-lg overflow-hidden border-2 border-blue-500/30">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 blur opacity-25"></div>

                        @if($order->event && $order->event->gambar)
                            <img
                                src="{{ asset('images/events/' . $order->event->gambar) }}"
                                alt="{{ $order->event->judul }}"
                                class="relative w-full h-48 object-cover rounded-lg"
                            >
                        @else
                            <div class="relative h-48 flex items-center justify-center text-gray-500 italic">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>

                    <h2 class="font-bold text-xl text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-purple-300 mb-2">
                        {{ $order->event?->judul ?? 'Event' }}
                    </h2>

                    @if($order->event?->lokasi)
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <span>📍</span>
                            <span>{{ $order->event->lokasi }}</span>
                        </div>
                    @endif
                </div>

                <!-- DETAIL -->
                <div class="lg:w-2/3 p-6">
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="h-6 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400">
                                Detail Tiket
                            </h3>
                        </div>

                        <div class="space-y-1">
                            @foreach($order->detailOrders as $d)
                                <div class="detail-item flex justify-between items-center">
                                    <div>
                                        <div class="font-bold text-gray-200">
                                            {{ ucfirst($d->tiket->tipe) }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Qty:
                                            <span class="text-blue-400 font-semibold">
                                                {{ $d->jumlah }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="font-bold text-green-400">
                                        Rp {{ number_format($d->subtotal_harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent my-6"></div>

                    <div class="bg-blue-900/20 border border-blue-500/30 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-sm uppercase tracking-wider text-gray-400">
                                Total Pembayaran
                            </span>
                            <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.histories.index') }}"
                           class="cyber-btn px-8 py-3 text-white rounded-lg font-semibold uppercase tracking-wide">
                            ← Kembali ke Riwayat
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layouts.admin>
