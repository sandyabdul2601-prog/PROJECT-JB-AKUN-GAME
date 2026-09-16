<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = ['order_id', 'user_id', 'reason', 'evidence_image', 'status'];
}