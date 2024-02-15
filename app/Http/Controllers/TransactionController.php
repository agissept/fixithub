<?php

namespace App\Http\Controllers;

use App\Http\Enum\PickUpMethod;
use App\Http\Enum\TransactionStatus;
use App\Models\Transaction;
use App\Models\TransactionStatusHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct(private readonly Request $request)
    {
    }

    public function store(): RedirectResponse
    {
        $pickUpMethod = PickUpMethod::DELIVERY;
        if ($this->request->pick_up_type === 2) {
            $pickUpMethod = PickUpMethod::SELF_PICK_UP;
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'shop_id' => $this->request->shop_id,
            'pickup_method' => $pickUpMethod->name,
            'created_at' => now(),
        ]);

        TransactionStatusHistory::create([
            'transaction_id' => $transaction->id,
            'status' => TransactionStatus::WAITING_CONFIRMATION->name,
            'created_at' => now(),
        ]);

        return redirect()->route('shop.show', ['id' => $this->request->shop_id]);
    }
}
