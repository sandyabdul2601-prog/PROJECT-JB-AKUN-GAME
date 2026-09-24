<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'seller_id'  => 'required|exists:users,id',
            'listing_id' => 'required', // Tambahkan |exists:listings,id jika tabel listings sudah dibuat Orang 2
            'price'      => 'required|numeric|min:1000',
        ]);

        $price        = $request->input('price');
        $feeMm        = $price * 0.05; 
        $sellerAmount = $price - $feeMm;

        $order = Order::create([
            'buyer_id'      => Auth::id(), // Mengambil ID pembeli yang sedang login
            'seller_id'     => $request->input('seller_id'),
            'listing_id'    => $request->input('listing_id'),
            'price'         => $price,
            'fee_mm'        => $feeMm,
            'seller_amount' => $sellerAmount,
            'status'        => 'waiting_payment',
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Transaksi berhasil dibuat!');
    }

    // Method/fungsi lain milik OrderController bisa diletakkan di bawah sini
}