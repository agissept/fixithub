<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Shop;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(
        private readonly Request $request
    ) {
    }

    public function store($transactionId): RedirectResponse
    {
        Reviews::create([
            'transaction_id' => $transactionId,
            'review' => $this->request->get('review'),
            'rating' => $this->request->get('rating'),
        ]);

        return redirect()->route('transaction.show', ['id' => $transactionId]);
    }

    public function indexAddReview($transactionId): Application|Factory|\Illuminate\Foundation\Application|View
    {
        $transaction = Transaction::query()->where('id', $transactionId)->first();
        $shop = Shop::query()->where('id', $transaction?->shop_id)->first();
        return view('review.add-review', compact('transaction', 'shop'));
    }
}
