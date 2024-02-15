<?php

namespace App\Http\Controllers;

use App\Http\Enum\PickUpMethod;
use App\Http\Enum\TransactionStatus;
use App\Http\Enum\UserRole;
use App\Models\Transaction;
use App\Models\TransactionStatusHistory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
            });
        if (\auth()->user()->role === UserRole::CUSTOMER->value) {
            $transactions->where('transactions.user_id', Auth::id());
        } else {
            $transactions->where('shops.user_id', Auth::id());
        }
        $transactions = $transactions->groupBy('transactions.id')
            ->get([
                'transactions.id',
                'users.name as customer_username',
                'shops.name as shop_name',
                'transactions.created_at',
                DB::raw('(SELECT status FROM transaction_status_histories WHERE transaction_id = transactions.id ORDER BY id DESC LIMIT 1) as status')
            ]);

        return view('transaction.index', [
            'transactions' => $transactions,
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::query()
            ->join('shops', 'shops.id', '=', 'transactions.shop_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->where('shops.user_id', Auth::id())
            ->where('transactions.id', $id)
            ->first([
                'transactions.id',
                'users.name as customer_username',
                'transactions.created_at',
            ]);

        $transaction->status = TransactionStatusHistory::query()
            ->where('transaction_id', $id)
            ->orderBy('id', 'desc')
            ->first()
            ->status;

        $transaction->progress_histories = TransactionStatusHistory::query()
            ->where('transaction_id', $id)
            ->get();

        return view('transaction.detail', [
            'transaction' => $transaction,
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

    public function updateProgress(int $id): RedirectResponse
    {
        TransactionStatusHistory::create([
            'transaction_id' => $id,
            'status' => $this->request->transaction_status,
            'description' => $this->request->description,
            'image' => $this->uploadImage($this->request->file('image')),
            'created_at' => now(),
        ]);

        return redirect()->route('transaction.show', ['id' => $id]);
    }

    private function uploadImage(?UploadedFile $file): string
    {
        if (!$file) {
            return '';
        }
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('/upload/image'), $filename);
        return $filename;
    }
}
