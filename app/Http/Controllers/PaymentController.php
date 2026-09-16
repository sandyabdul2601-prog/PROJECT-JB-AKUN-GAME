<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Pembeli upload bukti bayar
    public function uploadPayment(Request $request, $orderId)
    {
        $path = $request->file('proof')->store('payments', 'public');
        
        Payment::create([
            'order_id' => $orderId,
            'proof_image' => $path
        ]);

        Order::where('id', $orderId)->update(['status' => 'payment_received']);

        return back()->with('success', 'Bukti terupload, menunggu konfirmasi MM.');
    }

    // MM/Admin verifikasi uang sudah masuk
    public function confirmPaymentByMM($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => 'waiting_account']);

        return back()->with('success', 'Dana terverifikasi. Menunggu seller kirim akun.');
    }
}