<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'seller_id'  => 'required|integer',
            'listing_id' => 'required|integer',
            'price'      => 'required|numeric|min:1000',
        ]);

        $price = $request->input('price');
        $feeMm = $price * 0.05; 
        $sellerAmount = $price - $feeMm;

        $buyerId = Auth::id() ?? 1;

        $order = Order::create([
            'buyer_id'      => $buyerId,
            'seller_id'     => $request->input('seller_id'),
            'listing_id'    => $request->input('listing_id'),
            'price'         => $price,
            'fee_mm'        => $feeMm,
            'seller_amount' => $sellerAmount,
            'status'        => 'waiting_payment',
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Transaksi berhasil dibuat! Silakan upload bukti pembayaran.');
    }

    public function show($id)
    {
        // Panggil relasi secara opsional
        $order = Order::with(['accountData', 'complaint'])->findOrFail($id);

        // Pastikan nama view sesuai file resources/views/show.blade.php
        return view('show', compact('order'));
    }

    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);

        if (!in_array($order->status, ['checking', 'account_received'])) {
            return redirect()->back()->with('error', 'Transaksi belum bisa diselesaikan pada status ini.');
        }

        $order->update([
            'status' => 'completed',
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Transaksi telah selesai! Uang akan diteruskan ke Penjual.');
    }
}