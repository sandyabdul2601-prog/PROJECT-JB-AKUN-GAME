<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellController extends Controller
{
    public function create()
    {
        $games = Game::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('products.create', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'seller_price' => 'required|numeric|min:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $sellerPrice = (int) $request->seller_price;

        // Biaya platform
        $platformFee = 5000;

        // Harga yang dibayar pembeli
        $buyerPrice = $sellerPrice + $platformFee;

        // Upload gambar
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        $slug = Str::slug($request->title);

        // Supaya slug tidak bentrok
        $slug .= '-' . time();

        Product::create([
            'user_id' => auth()->id(),
            'game_id' => $request->game_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'seller_price' => $sellerPrice,
            'platform_fee' => $platformFee,
            'buyer_price' => $buyerPrice,
            'image' => $imagePath,
            'status' => 'available',
            'views' => 0,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Akun berhasil diterbitkan!');
    }
}