<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'seller_id',
        'game_id',
        'title',
        'description',
        'price',
        'level',
        'rank',
        'skin_count',
        'server',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'level' => 'integer',
        'skin_count' => 'integer',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
