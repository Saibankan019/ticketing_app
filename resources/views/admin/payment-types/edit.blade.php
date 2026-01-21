<x-layouts.admin title="Edit Tipe Pembayaran">
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
            background: rgba(15, 23, 42, 0.5) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
            color: #e2e8f0 !important;
            transition: all 0.3s ease;
        }
        
        .cyber-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3) !important;
            outline: none !important;
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
        
        .label-cyber {
            color: #3b82f6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }
    </style>

    @if ($errors->any())
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert bg-gradient-to-r from-red-900/50 to-orange-900/50 border border-red-500/50 text-red-300">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 5000)
        </script>
    @endif

    <div class="container mx-auto p-10">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    Edit Tipe Pembayaran
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ FORM UPDATE DATA ]
            </p>
        </div>

        <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="card-body p-8">
                <form method="POST" action="{{ route('admin.payment-types.update', $paymentType->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Tipe Pembayaran -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-cyber">[ Nama Tipe Pembayaran ]</span>
                        </label>
                        <input
                            type="text"
                            name="nama"
                            placeholder="Contoh: Transfer Bank BCA, E-Wallet GoPay"
                            class="input cyber-input w-full"
                            value="{{ old('nama', $paymentType->nama) }}"
                            required />
                        <label class="label">
                            <span class="label-text-alt text-gray-500">Masukkan nama metode pembayaran yang jelas</span>
                        </label>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent my-8"></div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.payment-types.index') }}" 
                           class="btn btn-ghost text-gray-400 hover:text-white hover:bg-gray-800">
                            Batal
                        </a>
                        <button type="submit" class="btn cyber-btn text-white border-0 px-8">
                            <span class="relative z-10">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>