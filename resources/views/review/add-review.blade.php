<x-app-layout>
    <x-slot name="header">
        Beri Ulasan
    </x-slot>
    <form method="post" class="rounded-[11px] bg-white">
        <img src="{{ route('images', $shop->banner_image) }}" class="rounded-t-[11px]">

        <div class="p-5">

            <h3 class="text-xl font-bold p-4 text-center color-blue-primary">{{ $shop->name }}</h3>
                <div class="flex">

                    <svg width="240" height="48" viewBox="0 0 240 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                         class=" m-auto">
                        <path
                            d="M24 0L29.3883 16.5836H46.8254L32.7185 26.8328L38.1068 43.4164L24 33.1672L9.89315 43.4164L15.2815 26.8328L1.17464 16.5836H18.6117L24 0Z"
                            fill="#D9D9D9"/>
                        <path
                            d="M72 0L77.3883 16.5836H94.8254L80.7185 26.8328L86.1068 43.4164L72 33.1672L57.8932 43.4164L63.2815 26.8328L49.1746 16.5836H66.6117L72 0Z"
                            fill="#D9D9D9"/>
                        <path
                            d="M120 0L125.388 16.5836H142.825L128.719 26.8328L134.107 43.4164L120 33.1672L105.893 43.4164L111.281 26.8328L97.1746 16.5836H114.612L120 0Z"
                            fill="#D9D9D9"/>
                        <path
                            d="M168 0L173.388 16.5836H190.825L176.719 26.8328L182.107 43.4164L168 33.1672L153.893 43.4164L159.281 26.8328L145.175 16.5836H162.612L168 0Z"
                            fill="#D9D9D9"/>
                        <path
                            d="M216 0L221.388 16.5836H238.825L224.719 26.8328L230.107 43.4164L216 33.1672L201.893 43.4164L207.281 26.8328L193.175 16.5836H210.612L216 0Z"
                            fill="#D9D9D9"/>
                    </svg>

                </div>

                <textarea placeholder="Masukkan ulasan kamu"
                          class="mt-1 block w-full border-gray rounded-[4px] resize-none h-[100px] mt-4"></textarea>

                <x-primary-button class="w-full mt-5 text-center justify-center">Kirim</x-primary-button>
            </div>
    </form>
</x-app-layout>
