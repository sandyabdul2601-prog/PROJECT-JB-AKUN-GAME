<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|min:10',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'complaint',
        ]);

        Complaint::create([
            'order_id' => $order->id,
            'user_id'  => Auth::id() ?? $order->buyer_id,
            'reason'   => $request->reason,
            'status'   => 'open',
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('error', 'Komplain berhasil diajukan. Tim Middleman akan meninjau kendala ini.');
    }

    /**
     * Memproses refund dana ke pembeli (Method penambahan untuk route complaint.refund)
     */
    public function processRefund($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'refund',
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Transaksi berhasil di-refund.');
    }
}