<x-layouts.admin title="Edit Lokasi">
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

        .cyber-input {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .cyber-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
            outline: none;
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

        .cyber-label {
            color: #93c5fd;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
    </style>

    <div class="container mx-auto p-10">
        {{-- HEADER --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    Edit Lokasi
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ FORM EDIT DATA ]
            </p>
        </div>

        {{-- FORM CARD --}}
        <div class="cyber-card rounded-2xl shadow-2xl p-8">
            <form action="{{ route('admin.lokasi.update', $lokasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Lokasi --}}
                <div class="mb-6">
                    <label for="nama_lokasi" class="cyber-label block mb-2">Nama Lokasi</label>
                    <input
                        type="text"
                        id="nama_lokasi"
                        name="nama_lokasi"
                        value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}"
                        class="cyber-input w-full px-4 py-3 rounded-lg text-gray-200"
                        placeholder="Masukkan nama lokasi..."
                        required>
                    @error('nama_lokasi')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Divider --}}
                <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent mb-6"></div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.lokasi.index') }}"
                       class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all">
                        Batal
                    </a>
                    <button type="submit" class="cyber-btn px-6 py-3 text-white rounded-lg font-semibold uppercase tracking-wide">
                        <span class="relative z-10">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>