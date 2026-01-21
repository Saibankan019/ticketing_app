<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentTypes = PaymentType::all();
        return view('admin.payment-types.index', compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|unique:payment_types,nama',
        ]);

        PaymentType::create($validatedData);

        return redirect()
            ->route('admin.payment-types.index')
            ->with('success', 'Tipe pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        return view('admin.payment-types.show', compact('paymentType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        return view('admin.payment-types.edit', compact('paymentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymentType = PaymentType::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|unique:payment_types,nama,' . $id,
        ]);

        $paymentType->update($validatedData);

        return redirect()
            ->route('admin.payment-types.index')
            ->with('success', 'Tipe pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->delete();

        return redirect()
            ->route('admin.payment-types.index')
            ->with('success', 'Tipe pembayaran berhasil dihapus.');
    }
}