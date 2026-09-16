<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. Pembeli Buat Order
    public function createOrder(Request $request)
    {
        $price = $request->price;
        $feeMM = 25000; // Contoh nominal fee fix/persentase
        
        $order = Order::create([
            'buyer_id' => auth()->id() ?? 1, // Fallback ke ID 1 jika belum login
            'seller_id' => $request->seller_id,
            'listing_id' => $request->listing_id,
            'price' => $price,
            'fee_mm' => $feeMM,
            'seller_amount' => $price - $feeMM,
            'status' => 'waiting_payment'
        ]);

        return redirect()->route('order.show', $order->id);
    }

    // 2. Menampilkan Detail Order ke Tampilan Blade
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // 3. Pembeli Konfirmasi Sudah Cek Akun & Selesai
    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        
        // Cek autentikasi, jika testing baypass validasi buyer
        if (auth()->check() && auth()->id() !== $order->buyer_id) {
            return back()->with('error', 'Akses ditolak.');
        }

        $order->update(['status' => 'completed']);
        
        return back()->with('success', 'Transaksi selesai! Dana diteruskan ke seller.');
    }
}