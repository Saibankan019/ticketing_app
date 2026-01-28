<x-layouts.admin title="Detail Lokasi">
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

        .info-label {
            color: #60a5fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .info-value {
            color: #e2e8f0;
            font-size: 1.125rem;
            font-weight: 500;
        }
    </style>

    <div class="container mx-auto p-10">
        {{-- HEADER --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    Detail Lokasi
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ INFORMASI LOKASI ]
            </p>
        </div>

        {{-- DETAIL CARD --}}
        <div class="cyber-card rounded-2xl shadow-2xl p-8">
            <div class="space-y-6">
                {{-- ID --}}
                <div class="pb-4 border-b border-blue-500/20">
                    <p class="info-label mb-2">ID</p>
                    <p class="info-value">{{ $lokasi->id }}</p>
                </div>

                {{-- Nama Lokasi --}}
                <div class="pb-4 border-b border-blue-500/20">
                    <p class="info-label mb-2">Nama Lokasi</p>
                    <p class="info-value">{{ $lokasi->nama_lokasi }}</p>
                </div>

                {{-- Created At --}}
                <div class="pb-4 border-b border-blue-500/20">
                    <p class="info-label mb-2">Dibuat Pada</p>
                    <p class="info-value">{{ $lokasi->created_at->format('d M Y, H:i') }} WIB</p>
                </div>

                {{-- Updated At --}}
                <div class="pb-4 border-b border-blue-500/20">
                    <p class="info-label mb-2">Terakhir Diupdate</p>
                    <p class="info-value">{{ $lokasi->updated_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent my-8"></div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.lokasi.index') }}"
                   class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all">
                    Kembali
                </a>
                <a href="{{ route('admin.lokasi.edit', $lokasi->id) }}"
                   class="cyber-btn px-6 py-3 text-white rounded-lg font-semibold uppercase tracking-wide">
                    <span class="relative z-10">Edit Lokasi</span>
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>