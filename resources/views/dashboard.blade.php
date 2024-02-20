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

        <div x-data="" class="p-5 rounded-[12px] bg-white mt-[22px]">
            <h2 class="color-blue-primary font-bold text-xl">Thread</h2>
            <form action="{{{route('threads.store')}}}" method="POST" class="flex flex-col mt-5" enctype="multipart/form-data">
                @csrf
                <textarea class="resize-none w-full rounded-[12px] border-gray-200 h-[150px] "
                          placeholder="Posting masalah gadget kamu di sini!"
                          name="thread_content" required></textarea>
                <img id="thread-image-preview" class="w-full max-h-[200px] object-cover rounded-[12px] hidden mt-3"/>


                <div class="flex justify-end items-center mt-5">
                    <label for="thread-image"
                           class="mr-3 px-4 py-2 bg-white border border-gray-300 text-gray-700 cursor-pointer rounded">
                        Gambar +
                    </label>
                    <input type="file" id="thread-image" class="hidden" name="thread_image" accept="image/*"
                           onchange="document.getElementById('thread-image-preview').classList.remove('hidden');document.getElementById('thread-image-preview').src = window.URL.createObjectURL(this.files[0])">

                    <x-primary-button class="w-fit">Posting</x-primary-button>
                </div>
            </form>
        </div>

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
