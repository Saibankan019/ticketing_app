<x-layouts.admin title="History Pembelian">
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
        
        .cyber-table-header {
            background: linear-gradient(145deg, #1e3a8a, #1e40af);
            border-bottom: 2px solid #3b82f6;
        }
        
        .cyber-table-row {
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        
        .cyber-table-row:hover {
            background: rgba(59, 130, 246, 0.05);
            border-left: 3px solid #3b82f6;
        }
    </style>

    <div class="container mx-auto p-10">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    History Pembelian
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ RIWAYAT TRANSAKSI ]
            </p>
        </div>

        <!-- Table -->
        <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="cyber-table-header text-blue-100">
                        <tr>
                            <th class="text-xs uppercase tracking-wider">No</th>
                            <th class="text-xs uppercase tracking-wider">Nama Pembeli</th>
                            <th class="text-xs uppercase tracking-wider">Event</th>
                            <th class="text-xs uppercase tracking-wider">Tanggal Pembelian</th>
                            <th class="text-xs uppercase tracking-wider">Total Harga</th>
                            <th class="text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @forelse ($histories as $index => $history)
                        <tr class="cyber-table-row">
                            <th class="text-blue-400">{{ $index + 1 }}</th>
                            <td class="font-medium">{{ $history->user->name }}</td>
                            <td>{{ $history->event?->judul ?? '-' }}</td>
                            <td class="text-gray-400">{{ $history->created_at->format('d M Y') }}</td>
                            <td class="font-semibold text-green-400">Rp {{ number_format($history->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.histories.show', $history->id) }}" 
                                   class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all hover:scale-105 inline-block">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="text-gray-500">
                                    <div class="text-5xl mb-3">📋</div>
                                    <p class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                        BELUM ADA TRANSAKSI
                                    </p>
                                    <p class="text-sm mt-2">Riwayat pembelian akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>