<x-layouts.app>

    {{-- HERO SECTION --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden
                    bg-gradient-to-br from-blue-950 via-gray-900 to-purple-950">

        {{-- Animated Grid --}}
        <div class="absolute inset-0 opacity-30
                    bg-[linear-gradient(rgba(59,130,246,0.12)_1px,transparent_1px),
                         linear-gradient(90deg,rgba(59,130,246,0.12)_1px,transparent_1px)]
                    bg-[size:48px_48px]
                    animate-[gridMove_8s_linear_infinite]">
        </div>

        {{-- Floating Glow --}}
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-[28rem] h-[28rem] bg-purple-500/20 rounded-full blur-3xl animate-pulse"></div>

        {{-- Content --}}
        <div class="relative z-10 text-center px-6 max-w-5xl text-white">
            <div class="inline-block mb-6 px-4 py-1 rounded-full
                        border border-blue-500/30 bg-blue-500/10
                        text-blue-400 tracking-widest text-xs uppercase animate-pulse">
                SYSTEM ONLINE
            </div>

            <h1 class="text-6xl md:text-8xl font-black mb-6
                       text-transparent bg-clip-text
                       bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400
                       drop-shadow-[0_0_30px_rgba(59,130,246,0.35)]">
                BENGTIX
            </h1>

            <div class="h-px w-72 mx-auto mb-10
                        bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>

            <p class="text-xl md:text-2xl text-gray-300 mb-3">
                Amankan Tiketmu yuk.
            </p>

            <p class="text-lg text-blue-400 mb-12 font-light tracking-wide">
                &gt; BengTix: Beli Tiket dan Meriahkan EVENTS!!!
            </p>

            <div class="flex justify-center gap-4 flex-wrap">
                <a href="#event-list"
                   class="group relative px-8 py-4 rounded-lg font-bold
                          bg-gradient-to-r from-blue-600 to-purple-600
                          hover:from-blue-500 hover:to-purple-500
                          transition-all duration-300 hover:scale-105
                          shadow-lg shadow-blue-500/30">
                    <span class="relative z-10">LIHAT EVENTS</span>
                </a>

            </div>
        </div>
    </section>

    {{-- EVENT SECTION --}}
    <section id="event-list" class="relative max-w-7xl mx-auto py-28 px-6 text-gray-100">


        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-8">
            <div class="relative">
                <h2 class="text-4xl md:text-5xl font-black uppercase italic tracking-wider
                           text-transparent bg-clip-text
                           bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                    EVENTS//
                </h2>
                <div class="h-px w-full bg-gradient-to-r from-blue-500 to-transparent mt-3"></div>
            </div>

            {{-- Category Filter --}}
            <div class="flex gap-3 flex-wrap justify-center">
                <a href="{{ route('home') }}">
                    <x-user.category-pill
                        :label="'Semua'"
                        :active="!request('kategori')" />
                </a>

                @foreach($categories as $kategori)
                    <a href="{{ route('home', ['kategori' => $kategori->id]) }}">
                        <x-user.category-pill
                            :label="$kategori->nama"
                            :active="request('kategori') == $kategori->id" />
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Event Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($events as $event)
                <x-user.event-card
                    :title="$event->judul"
                    :date="$event->tanggal_waktu"
                    :location="$event->lokasi"
                    :price="$event->tikets_min_harga"
                    :image="$event->gambar"
                    :href="route('events.show', $event)" />
            @endforeach
        </div>
    </section>

</x-layouts.app>
