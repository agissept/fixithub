<x-app-layout>
    <x-slot name="header">
        Detail Pesanan
    </x-slot>

    <div class="bg-white rounded-[11px] p-5">
        <h2 class="color-blue-primary text-[21px] font-bold">Detail Pemesan</h2>
        <p class="font-bold mt-4">{{ $transaction->customer_username }}</p>
        <p class="mt-1">{{ $transaction->phone_number ?? '086546655113355' }}</p>
        <p class="mt-1">{{ $transaction->customer_address ?? 'Jl.Siliwangi Desa Cikiray RT/01 RW/02, SUKABUMI, CIPETEY, JAWA BARAT, ID, 43152' }}</p>
        <hr>
        <div class="flex">
            <a class="bg-blue-primary mt-5 ml-auto text-white px-4 py-2 rounded-[4px]"
               href="https://wa.me/{{ $transaction->phone_number }}">Chat</a>
        </div>
    </div>

    @if($transaction->status === \App\Http\Enum\TransactionStatus::WAITING_CONFIRMATION->name)
        <div class="bg-white rounded-[11px] p-5 mt-5">
            <h2 class="color-blue-primary text-[21px] font-bold">Konfirmasi Pesanan</h2>
            <form method="POST" class="flex justify-end mt-4"
                  action="{{route('transaction.update.progress', [$transaction->id])}}">
                @csrf
                <x-danger-button name='transaction_status'
                                 value="{{ \App\Http\Enum\TransactionStatus::REJECTED->name }}"
                                 class="mr-2">
                    Tolak
                </x-danger-button>
                <x-primary-button name='transaction_status'
                                  value="{{ \App\Http\Enum\TransactionStatus::CONFIRMED->name }}">Terima
                </x-primary-button>
            </form>
        </div>
    @elseif($transaction->status === \App\Http\Enum\TransactionStatus::REJECTED->name)
        <div class="bg-white rounded-[11px] p-5 mt-5">
            <h2 class="text-[21px] font-bold">Transaksi ini telah Anda batalkan</h2>
        </div>
    @else
        <div class="bg-white rounded-[11px] p-5 mt-5">
            <h2 class="color-blue-primary text-[21px] font-bold">Progress Pesanan</h2>
            <div class="relative">
{{--                <div class="absolute w-[4px] h-[100%] left-[8px] py-4">--}}
{{--                    <div class="bg-blue-primary  h-[100%]"></div>--}}
{{--                </div>--}}
                @foreach($transaction->progress_histories as $history)
                    <div class="flex mt-5">
                        <div class="w-[20px] h-[20px] bg-white rounded-full z-10 flex items-center justify-center absolute">
                            <div class="w-[13px] h-[13px] bg-blue-primary rounded-full top-[2px]"></div>
                        </div>
                        <div class="ml-5">
                            @switch($history->status)
                                @case(\App\Http\Enum\TransactionStatus::PICK_UP_PROCESS->name)
                                    <p>Proses pick up</p>
                                    @break
                                @case(\App\Http\Enum\TransactionStatus::WAITING_FOR_SERVICE->name)
                                    <p>Dalam antrian servie</p>
                                    @break
                                @case(\App\Http\Enum\TransactionStatus::SERVICE_PROCESS->name)
                                    <p>Proses service</p>
                                    @break
                                @case(\App\Http\Enum\TransactionStatus::WAITING_COURIER_FOR_SENDING_BACK_TO_CUSTOMER->name)
                                    <p>Proses pengembalian ke customer</p>
                                    @break
                                @case(\App\Http\Enum\TransactionStatus::DONE->name)
                                    <p>Selesai</p>
                                    @break
                                @default
                                    <p>Status tidak ditemukan</p>
                                    @break
                            @endswitch
                            @if($history->image)
                                <img src="{{ route('images', $history->image) }}" class="w-3/4"/>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <form class=" bg-white rounded-[11px] p-5 mt-5 block" method="POST"
              action="{{route('transaction.update.progress', [$transaction->id])}}"
              enctype="multipart/form-data">
            @csrf
            <h2 class="color-blue-primary text-[21px] font-bold">Update Info Pemesanan</h2>
            <div class="mt-4">
                <x-input-label for="transaction-status" :value="__('Proses')"/>
                <select id="transaction-status" name="transaction_status"
                        class="mt-1 block w-full border-gray rounded-[4px]" required>
                    <option value="{{ \App\Http\Enum\TransactionStatus::PICK_UP_PROCESS->name }}">Proses
                        pick up
                    </option>
                    <option value="{{ \App\Http\Enum\TransactionStatus::WAITING_FOR_SERVICE->name }}">
                        Dalam antrian
                        servie
                    </option>
                    <option value="{{ \App\Http\Enum\TransactionStatus::SERVICE_PROCESS->name }}">Proses
                        service
                    </option>
                    <option
                        value="{{ \App\Http\Enum\TransactionStatus::WAITING_COURIER_FOR_SENDING_BACK_TO_CUSTOMER->name }}">
                        Proses pengembalian ke customer
                    </option>
                    <option value="{{ \App\Http\Enum\TransactionStatus::DONE->name }}">Selesai</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('transaction_status')"/>
            </div>
            <div class="mt-4">
                <x-input-label for="image" :value="__('Gambar(Opsional)')"/>
                <x-text-input id="image" name="image" type="file" accept="image/*"
                              class="mt-1 block w-full"/>
                <x-input-error class="mt-2" :messages="$errors->get('image')"/>
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('Descripsi(Opsional)')"/>
                <textarea id="description" name="description"
                          class="mt-1 block w-full border-gray rounded-[4px] resize-none"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')"/>
            </div>
            <hr class="mt-4">
            <div class="flex">
                <x-primary-button class="mt-5 ml-auto">Update</x-primary-button>
            </div>
        </form>
    @endif


</x-app-layout>

