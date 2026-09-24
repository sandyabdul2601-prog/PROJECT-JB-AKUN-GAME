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
            'listing_id' => 'required',
            'price'      => 'required|numeric|min:1000',
        ]);

        $price        = $request->input('price');
        $feeMm        = $price * 0.05; 
        $sellerAmount = $price - $feeMm;

        $order = Order::create([
            'buyer_id'      => Auth::id(),
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

    // TAMBAHKAN METHOD SHOW DI SINI:
    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Arahkan ke file blade milikmu (misal: order_show.blade.php)
        return view('order_show', compact('order')); 
    }

    // Method untuk menyelesaikan transaksi (Optional/Lanjutan)
    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Transaksi telah selesai!');
    }
}