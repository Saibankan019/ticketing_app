<x-layouts.app>
    <section class="relative max-w-5xl mx-auto py-16 px-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-10">
            <h1 class="text-3xl font-extrabold uppercase italic text-blue-400">
                Detail Pemesanan
            </h1>

            <div class="text-sm text-gray-400 mt-2 lg:mt-0">
                Order #{{ $order->id }} •
                {{ $order->order_date->translatedFormat('d F Y, H:i') }}
            </div>
        </div>

        <!-- Card -->
        <div
            class="bg-gray-900 border border-blue-500/20 rounded-xl overflow-hidden">

            <div class="flex flex-col lg:flex-row">

                <!-- Event Image -->
                <div class="lg:w-1/3 bg-gray-800 overflow-hidden">
                    <img
                        src="{{ $order->event?->gambar
                            ? (filter_var($order->event->gambar, FILTER_VALIDATE_URL)
                                ? $order->event->gambar
                                : asset('images/events/' . $order->event->gambar))
                            : asset('assets/images/placeholder.jpg')
                        }}"
                        alt="{{ $order->event?->judul ?? 'Event' }}"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                    >
                </div>

                <!-- Content -->
                <div class="flex-1 p-8">

                    <!-- Event Info -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-white">
                            {{ $order->event?->judul ?? 'Event' }}
                        </h2>
                        <p class="text-sm text-gray-400 mt-1">
                            {{ $order->event?->lokasi ?? '' }}
                        </p>
                    </div>

                    <!-- Ticket Detail -->
                    <div class="space-y-4">
                        @foreach($order->detailOrders as $d)
                            <div
                                class="flex justify-between items-center border-b border-gray-700 pb-3">
                                <div>
                                    <div class="font-semibold text-white">
                                        {{ $d->tiket->tipe }}
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        Qty: {{ $d->jumlah }}
                                    </div>
                                </div>

                                <div class="font-bold text-blue-400">
                                    Rp {{ number_format($d->subtotal_harga, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-blue-500/30">
                        <span class="text-lg font-bold text-white">
                            Total Pembayaran
                        </span>
                        <span class="text-2xl font-extrabold text-blue-400">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('orders.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg
                      bg-blue-900 text-white font-semibold
                      hover:bg-blue-800 transition">
                ← Kembali ke Riwayat Pembelian
            </a>
        </div>

    </section>
</x-layouts.app>
