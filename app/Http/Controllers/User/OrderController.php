<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Event;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['event', 'paymentType'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ GANTI dari 'payment.index' ke 'orders.index'
        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'items' => 'required|array',
            'items.*.tiket_id' => 'required|exists:tikets,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $totalHarga = 0;
            $orderItems = [];

            // Calculate total and prepare items
            foreach ($validatedData['items'] as $item) {
                $tiket = \App\Models\Tiket::findOrFail($item['tiket_id']);
                
                // Check stock
                if ($tiket->stok < $item['jumlah']) {
                    return response()->json([
                        'message' => "Stok tiket {$tiket->tipe} tidak mencukupi"
                    ], 400);
                }

                $subtotal = $tiket->harga * $item['jumlah'];
                $totalHarga += $subtotal;

                $orderItems[] = [
                    'tiket_id' => $tiket->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal_harga' => $subtotal,
                ];

                // Decrease stock
                $tiket->decrement('stok', $item['jumlah']);
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'event_id' => $validatedData['event_id'],
                'payment_type_id' => $validatedData['payment_type_id'],
                'order_date' => now(),
                'total_harga' => $totalHarga,
            ]);

            // Create order details
            foreach ($orderItems as $item) {
                $order->detailOrders()->create($item);
            }

            DB::commit();

            return response()->json([
                'message' => 'Pesanan berhasil dibuat',
                'redirect' => route('orders.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Cek apakah order milik user yang sedang login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Load relasi yang dibutuhkan
        $order->load(['event', 'detailOrders.tiket', 'paymentType']);

        // ✅ GANTI dari 'payment.show' ke 'orders.show'
        return view('orders.show', compact('order'));
    }
}