<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionStatusHistory extends Model
{
    protected $fillable = [
        'transaction_id',
        'status',
        'created_at',
    ];
}
