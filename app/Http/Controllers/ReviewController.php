<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Transaction;

class ReviewController extends Controller
{
    public function indexAddReview($transactionId)
    {
        $transaction = Transaction::query()->where('id', $transactionId)->first();
        $shop  = Shop::query()->where('id', $transaction?->shop_id)->first();
        return view('review.add-review', compact('transaction', 'shop'));
    }
}
