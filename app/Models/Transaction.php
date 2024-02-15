<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'shop_id',
        'pickup_method',
        'created_at',
    ];
}
