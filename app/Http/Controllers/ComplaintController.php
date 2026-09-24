<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    // Simpan data komplain
    public function store(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $order = Order::findOrFail($id);

        // Buat record komplain baru
        Complaint::create([
            'order_id' => $order->id,
            'user_id'  => auth()->id(),
            'reason'   => $request->input('reason'),
        ]);

        // Ubah status order menjadi complaint
        $order->update([
            'status' => 'complaint',
        ]);

        return redirect()->back()->with('error', 'Komplain berhasil diajukan. Tim Middleman akan meninjau kendala ini.');
    }
}