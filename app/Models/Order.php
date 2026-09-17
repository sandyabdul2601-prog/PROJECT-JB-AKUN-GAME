<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi ke data akun game
     */
    public function accountData()
    {
        return $this->hasOne(AccountData::class, 'order_id');
    }

    /**
     * Relasi ke data komplain
     */
    public function complaint()
    {
        return $this->hasOne(Complaint::class, 'order_id');
    }
}