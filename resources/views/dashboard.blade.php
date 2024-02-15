<x-app-layout>
    <div class="p-[22px] flex flex-col">
        @if(auth()->user()->role === \App\Http\Enum\UserRole::CUSTOMER->value)
            <x-text-input placeholder="Cari tempat service.." class="mx-auto w-full mt-2"></x-text-input>

            <div class="rounded-[12px] mt-5 bg-blue-primary p-[23px]">
                <h3 class="font-bold text-white text-[18px]">Tempat Service</h3>
                <p class="text-white mt-3">Punya masalah gadget? <br> Yuk cari tempat service di sini</p>
                <div class="flex">
                    <a href="{{ route('shop.index') }}"
                       class="ml-auto text-white border border-white rounded-[4px] px-[20px] py-[10px] mt-5">Lihat</a>
                </div>
            </div>
        @endif

        <form action="{{{route('threads.store')}}}" method="POST" class="flex flex-col">
            @csrf
            <textarea class="resize-none w-full rounded-[12px] border-gray-200 h-[150px] mt-[22px]"
                      placeholder="Posting masalah gadget kamu di sini!"
                      name="thread_content"></textarea>

            <x-primary-button class="ml-auto mt-3 w-fit">Posting</x-primary-button>
        </form>

        <div>
            @foreach($threads as $thread)
                <a href="{{{ route('threads.show', ['id' => $thread->id]) }}}"
                   class="rounded-[12px] mt-5 bg-white p-[23px] block">
                    <span class="font-bold">{{{ $thread->username }}}</span>
                    <p class="mt-3">
                        {{{ $thread->content }}}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
