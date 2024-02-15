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
            <a class="bg-blue-primary mt-5 ml-auto text-white px-4 py-2 rounded-[4px]" href="https://wa.me/{{ $transaction->phone_number }}">Chat</a>
        </div>
    </div>

    <form class="bg-white rounded-[11px] p-5 mt-5 block" method="POST" action="{{route('transaction.update.progress', [$transaction->id])}}" enctype="multipart/form-data">
        @csrf
        <h2 class="color-blue-primary text-[21px] font-bold">Update Info Pemesanan</h2>
        <div class="mt-4">
            <x-input-label for="transaction-status" :value="__('Proses')"/>
            <select id="transaction-status" name="transaction_status" class="mt-1 block w-full border-gray rounded-[4px]" required>
                <option value="{{ \App\Http\Enum\TransactionStatus::PICK_UP_PROCESS->name }}">Proses pick up</option>
                <option value="{{ \App\Http\Enum\TransactionStatus::WAITING_FOR_SERVICE->name }}">Dalam antrian servie</option>
                <option value="{{ \App\Http\Enum\TransactionStatus::SERVICE_PROCESS->name }}">Proses service</option>
                <option value="{{ \App\Http\Enum\TransactionStatus::WAITING_COURIER_FOR_SENDING_BACK_TO_CUSTOMER->name }}">Proses pengembalian ke customer</option>
                <option value="{{ \App\Http\Enum\TransactionStatus::DONE->name }}">Selesai</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('transaction_status')"/>
        </div>
        <div class="mt-4">
            <x-input-label for="image" :value="__('Gambar(Opsional)')"/>
            <x-text-input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('image')"/>
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Descripsi(Opsional)')"/>
            <textarea id="description" name="description" class="mt-1 block w-full border-gray rounded-[4px] resize-none"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
        </div>
        <hr class="mt-4">
        <div class="flex">
            <x-primary-button class="mt-5 ml-auto">Update</x-primary-button>
        </div>
    </form>

</x-app-layout>

