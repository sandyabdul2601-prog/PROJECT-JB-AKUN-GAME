<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // Pembeli mengajukan komplain
    public function store(Request $request, $orderId)
    {
        $path = $request->file('evidence') ? $request->file('evidence')->store('complaints', 'public') : null;

        Complaint::create([
            'order_id' => $orderId,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'evidence_image' => $path
        ]);

        Order::where('id', $orderId)->update(['status' => 'complaint']);

        return back()->with('success', 'Komplain dikirim. Dana ditahan oleh MM.');
    }

    // MM Menyetujui Refund
    public function processRefund($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => 'refund']);

        // Logika pengembalian dana ke buyer...

        return back()->with('success', 'Transaksi dibatalkan dan dana di-refund.');
    }
}