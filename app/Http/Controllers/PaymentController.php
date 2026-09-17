<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Upload Bukti Pembayaran (Pembeli)
     * Transisi Status: waiting_payment -> payment_received
     */
    public function uploadPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'waiting_payment') {
            return redirect()->back()->with('error', 'Status transaksi tidak valid untuk upload pembayaran.');
        }

        // Contoh update status setelah bukti di-upload
        $order->update([
            'status' => 'payment_received',
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Bukti pembayaran berhasil di-upload. Menunggu verifikasi Middleman.');
    }

    /**
     * Konfirmasi Pembayaran Diterima MM (Admin/Middleman)
     * Transisi Status: payment_received -> account_received (atau checking)
     */
    public function confirmPaymentByMM($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'payment_received') {
            return redirect()->back()->with('error', 'Pembayaran belum di-upload atau sudah dikonfirmasi.');
        }

        $order->update([
            'status' => 'account_received', // Atau 'checking'
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Pembayaran berhasil diverifikasi oleh Middleman! Seller dapat menyerahkan akun.');
    }
}