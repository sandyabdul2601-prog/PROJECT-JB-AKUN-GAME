<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    // Pembeli upload bukti bayar
    public function upload(Request $request, $id)
    {
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::findOrFail($id);

        if ($request->hasFile('proof')) {
            $path = $request->file('proof')->store('payments', 'public');
            
            // Update status transaksi ke payment_received
            $order->update([
                'payment_proof' => $path,
                'status'        => 'payment_received',
            ]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil di-upload. Menunggu verifikasi Middleman.');
    }

    // Admin/Middleman konfirmasi pembayaran
    public function confirm($id)
    {
        $order = Order::findOrFail($id);

        // Update status ke account_received agar seller bisa/sudah kirim akun
        $order->update([
            'status' => 'account_received',
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi oleh Middleman!');
    }
}