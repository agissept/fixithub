@if($transaction->status === \App\Http\Enum\TransactionStatus::WAITING_CONFIRMATION->name)
    <div class="text-[11px] text-center w-[70px] bg-blue-primary text-white rounded-[4px]">Pending
    </div>
@elseif($transaction->status === \App\Http\Enum\TransactionStatus::CONFIRMED->name
        || $transaction->status === \App\Http\Enum\TransactionStatus::PICK_UP_PROCESS->name)
    <div class="text-[11px] text-center w-[70px] bg-amber-400 text-white rounded-[4px]">On Proses
    </div>
@elseif($transaction->status === \App\Http\Enum\TransactionStatus::DONE->name)
    <div class="text-[11px] text-center w-[70px] bg-green-700 text-white rounded-[4px]">Selesai
    </div>
@elseif($transaction->status === \App\Http\Enum\TransactionStatus::REJECTED->name)
    <div class="text-[11px] text-center w-[70px] bg-red-500 text-white rounded-[4px]">Batal
    </div>
@else
    <div class="text-[11px] text-center w-[70px] bg-blue-primary text-white rounded-[4px]">{{$transaction->status ?? 'empty'}}</div>
@endif

