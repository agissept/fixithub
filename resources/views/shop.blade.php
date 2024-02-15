<x-app-layout>
    <div class="pt-0 flex flex-col">

        <form action="{{ route('shop.show') }}" method="GET">
            <x-text-input placeholder="Cari tempat service.." class="mx-auto w-full mt-2"></x-text-input>
        </form>

        @foreach($shops as $shop)
            <a href="{{ route('shop.show', ['id' => $shop->id]) }}" class="rounded-[12px] mt-5 bg-white flex h-[125px] ">
                <img src="{{ '/images/' . $shop->banner_image }}" class="w-[125px] h-[125px] rounded-l-[12px]">
                <div class="p-3">
                    <span class="font-bold color-blue-primary">{{ $shop->name }}</span>
                    <p class="text-sm">{{ \Illuminate\Support\Str::limit($shop->description, 45) }}</p>
                    <p class="mt-3 text-sm font-bold">
                        {{ \Illuminate\Support\Str::limit($shop->address, 20) }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
