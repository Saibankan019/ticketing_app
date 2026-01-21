<x-layouts.app>
    <section class="relative max-w-7xl mx-auto py-16 px-6">

        <!-- Title -->
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-3xl font-extrabold uppercase italic text-blue-400">
                Riwayat Pembelian
            </h1>
        </div>

        <!-- Orders -->
        <div class="space-y-6">
            @forelse($orders as $order)
                <article
                    class="flex flex-col lg:flex-row bg-gray-900 border border-blue-500/20 rounded-xl overflow-hidden hover:border-blue-500/50 transition">

                    <!-- Image -->
                    <div class="lg:w-56 h-48 lg:h-auto bg-gray-800 overflow-hidden">
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
                    <div class="flex flex-col justify-between flex-1 p-6">
                        <div>
                            <div class="text-sm text-gray-500 mb-1">
                                Order #{{ $order->id }}
                            </div>

                            <h2 class="text-lg font-bold text-white">
                                {{ $order->event?->judul ?? 'Event' }}
                            </h2>

                            <div class="text-sm text-gray-400 mt-2">
                                {{ $order->order_date->translatedFormat('d F Y, H:i') }}
                            </div>
                        </div>

                        <!-- Price & Action -->
                        <div class="flex items-center justify-between mt-6">
                            <div class="text-xl font-extrabold text-blue-400">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </div>

                            <a href="{{ route('orders.show', $order) }}"
                               class="px-5 py-2 rounded-lg bg-blue-900 text-white text-sm font-semibold
                                      hover:bg-blue-800 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="border border-blue-500/20 rounded-xl p-8 text-center text-gray-400 bg-gray-900">
                    Anda belum memiliki pesanan.
                </div>
            @endforelse
        </div>

    </section>
</x-layouts.app>
