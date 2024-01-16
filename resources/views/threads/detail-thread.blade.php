<x-app-layout>
    <div class="p-[22px] flex flex-col">
        <div class="bg-white font-bold text-[18px] p-[12px] rounded-[11px]">
            {{{ $thread->username }}}
        </div>
        <p class="text-[24px] pt-[12px]">
            {{{ $thread->content }}}
        </p>
    </div>

    <div class="p-[22px]">
        @foreach($comments as $comment)
            <a href="{{{ route('threads.show', ['id' => $comment->id]) }}}"
               class="rounded-[12px] mt-5 bg-white p-[23px] block">
                <span class="font-bold">{{{ $comment->username }}}</span>
                <p class="mt-3">
                    {{{ $comment->content }}}
                </p>
            </a>
        @endforeach
    </div>

    <form class="fixed bottom-0 bg-white w-full shadow-2xl p-[12px] flex" method="POST"
          action="{{{ route('threads.store', ['id' => $thread->id]) }}}">
        @csrf
        <x-text-input class="rounded-e-none" name="thread_content" placeholder="Komentar..."></x-text-input>
        <x-primary-button class="rounded-s-none" type="submit">Kirim</x-primary-button>
    </form>
</x-app-layout>
