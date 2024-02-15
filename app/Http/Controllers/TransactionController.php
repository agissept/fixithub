<?php

namespace App\Http\Controllers;

use App\Http\Enum\PickUpMethod;
use App\Http\Enum\TransactionStatus;
use App\Models\Transaction;
use App\Models\TransactionStatusHistory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct(private readonly Request $request)
    {
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $transactions = Transaction::query()
            ->join('shops', 'shops.id', '=', 'transactions.shop_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->leftJoin('transaction_status_histories as histories', function ($join) {
                $join->on('histories.transaction_id', '=', 'transactions.id')
                    ->whereRaw('histories.id = (SELECT MAX(id) FROM transaction_status_histories WHERE transaction_id = transactions.id)');
            })
            ->where('shops.user_id', Auth::id())
            ->groupBy('transactions.id')
            ->get([
                'transactions.id',
                'users.name as customer_username',
                'transactions.created_at',
                DB::raw('(SELECT status FROM transaction_status_histories WHERE transaction_id = transactions.id ORDER BY id DESC LIMIT 1) as status')
            ]);

        return view('transaction.index', [
            'transactions' => $transactions,
        ]);
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
