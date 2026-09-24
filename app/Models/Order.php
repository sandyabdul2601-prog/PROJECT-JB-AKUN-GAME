<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    // Relasi ke User (Pembeli)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Relasi ke User (Penjual)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relasi ke Data Akun Game
    public function accountData()
    {
        return $this->hasOne(AccountData::class);
    }
}