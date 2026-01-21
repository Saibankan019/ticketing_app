<x-layouts.admin title="Detail Tipe Pembayaran">
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
        
        .info-row {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }
        
        .info-row:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.4);
            transform: translateX(5px);
        }
    </style>

    <div class="container mx-auto p-10">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    Detail Tipe Pembayaran
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ INFORMASI LENGKAP ]
            </p>
        </div>

        <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="card-body p-8">
                <!-- Info Grid -->
                <div class="space-y-4 mb-8">
                    <div class="info-row flex justify-between items-center p-4 rounded-lg">
                        <span class="text-sm text-gray-400 uppercase tracking-wider">ID</span>
                        <span class="font-bold text-xl text-blue-400">{{ $paymentType->id }}</span>
                    </div>

                    <div class="info-row flex justify-between items-center p-4 rounded-lg">
                        <span class="text-sm text-gray-400 uppercase tracking-wider">Nama Tipe Pembayaran</span>
                        <span class="font-bold text-xl text-white">{{ $paymentType->nama }}</span>
                    </div>

                    <div class="info-row flex justify-between items-center p-4 rounded-lg">
                        <span class="text-sm text-gray-400 uppercase tracking-wider">Total Order Menggunakan</span>
                        <span class="font-bold text-xl text-green-400">{{ $paymentType->orders->count() }}</span>
                    </div>

                    <div class="info-row flex justify-between items-center p-4 rounded-lg">
                        <span class="text-sm text-gray-400 uppercase tracking-wider">Dibuat Pada</span>
                        <span class="font-bold text-gray-300">{{ $paymentType->created_at->format('d M Y, H:i') }}</span>
                    </div>

                    <div class="info-row flex justify-between items-center p-4 rounded-lg">
                        <span class="text-sm text-gray-400 uppercase tracking-wider">Terakhir Diupdate</span>
                        <span class="font-bold text-gray-300">{{ $paymentType->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent my-8"></div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.payment-types.index') }}" 
                       class="btn btn-ghost text-gray-400 hover:text-white hover:bg-gray-800">
                        Kembali
                    </a>
                    <a href="{{ route('admin.payment-types.edit', $paymentType->id) }}" 
                       class="btn cyber-btn text-white border-0 px-8">
                        <span class="relative z-10">Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>