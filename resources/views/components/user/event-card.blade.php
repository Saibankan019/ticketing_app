@props(['title', 'date', 'location', 'price', 'image', 'href' => null])

@php
$formattedPrice = $price
    ? 'Rp ' . number_format($price, 0, ',', '.')
    : 'Harga tidak tersedia';

$formattedDate = $date
    ? \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y, H:i')
    : 'Tanggal tidak tersedia';

$imageUrl = $image
    ? (filter_var($image, FILTER_VALIDATE_URL)
        ? $image
        : asset('images/events/' . $image))
    : asset('assets/images/placeholder.jpg');
@endphp

<a href="{{ $href ?? '#' }}" class="group block">
    <div
        class="relative h-[26rem] rounded-2xl overflow-hidden
               bg-gradient-to-br from-gray-900 to-black
               border border-blue-500/30
               transition-all duration-300
               hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/40">

        {{-- Gradient Glow (BACKGROUND ONLY) --}}
        <div
            class="absolute inset-0 z-0
                   bg-gradient-to-br from-blue-900/40 to-purple-900/40
                   opacity-0 group-hover:opacity-100 transition">
        </div>

        {{-- IMAGE --}}
        <div class="relative z-10 h-48 overflow-hidden">
            <img
                src="{{ $imageUrl }}"
                alt="{{ $title }}"
                class="w-full h-full object-cover opacity-80
                       group-hover:scale-110 transition-transform duration-500"
            />

            {{-- Badge --}}
            <div
                class="absolute top-4 right-4 px-3 py-1
                       bg-blue-600 text-xs font-bold text-white rounded-full">
                HOT
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="relative z-10 p-6 flex flex-col h-[calc(100%-12rem)]">
            <h3 class="text-lg font-bold mb-2
                    text-white
                    group-hover:text-blue-400
                    transition">
                {{ $title }}
            </h3>



            <div class="text-sm text-gray-400 space-y-1 mb-4">
                <div>📅 {{ $formattedDate }}</div>
                <div>📍 {{ $location }}</div>
            </div>

            <div class="mt-auto pt-4 border-t border-blue-500/30 flex items-center justify-between">
                <div>
                    <div class="text-xs text-gray-500">Mulai dari</div>
                    <div class="text-xl font-bold text-blue-400">
                        {{ $formattedPrice }}
                    </div>
                </div>

                <span
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-500
                           rounded-lg text-sm font-semibold text-white transition">
                    BELI →
                </span>
            </div>
        </div>
    </div>
</a>
