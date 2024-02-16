<x-app-layout>
    <x-slot name="header">
        {{ $shop->name }}
    </x-slot>

    <div class="rounded-[11px] bg-white">
        <img src="{{ route('images', $shop->banner_image) }}" class="rounded-t-[11px]">
        <h3 class="text-lg font-bold p-4">{{ $shop->name }}</h3>
        <p class="px-4 ">{{ $shop->description }}</p>

        <div class="mt-4 px-3 flex justify-between items-center">
            <strong>Sertifikat Teknisi</strong>
            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'technician-certification')" class="color-blue-primary">
                Lihat
            </button>
        </div>
        <hr>

        <div class="flex">
            <a href="https://wa.me/{{ $shop->phone_number }}"
               class="bg-blue-primary text-white py-2 px-4 rounded-[4px] ml-auto m-4">Chat</a>
        </div>


    </div>

    <div class="rounded-[11px] mt-5">
        <div id="map" class="h-[200px] rounded-[11px]">

        </div>
        <x-text-input id="coordinate" name="coordinate" type="text" :value="old('coordinate', $shop?->coordinate)"
                      disabled hidden/>
    </div>

    @if(auth()->user()->phone_number && auth()->user()->address)
        <div class="rounded-[11px] bg-white mt-5 p-4">
            @if(!$transaction)
                <h3 class="text-lg font-bold">Pilih Metode Pengambilan</h3>
                <div>
                    <input type="radio" value="1" name="pickup_method" checked> Pickup
                    <input type="radio" value="2" name="pickup_method"> Home Service
                </div>
                <p class="italic text-xs mt-3">Setelah tombol pesan diklik, silakan menunggu tukan service konfirmasi
                    dan akan
                    chat alamat Anda.</p>

                <form method="POST" action="{{ route('transaction.store') }}" class="flex mt-4">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <x-primary-button class="ml-auto">Pesan</x-primary-button>
                </form>
            @else
                <h3 class="text-lg font-bold">Status pemeasanan</h3>
                <p>Pemesanan pada toko ini sedang menunggu konfirmasi dari pemiliki toko</p>
            @endif
        </div>
    @else
        <div class="rounded-[11px] bg-white mt-5 p-4">
            <h3 class="text-lg font-bold">Anda belum bisa melakukan pemesanan</h3>
            <p>Silkakan isi alamat dan nomor telepon pada halaman profile untuk melakukan pemesanan</p>
        </div>
    @endif


    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__",
                m = document, b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
        })({
            key: "AIzaSyALXUqLrfvBoQdpgwTilcm1_BajTHxMPW4",
            v: "weekly",
        });
    </script>

    <script>
        let map;

        const coordinate = {
            lat: -6.8953642365424885,
            lng: 107.63369022919557
        }

        const [lat, lng] = document.querySelector('#coordinate').value.split(',')
        if (lat && lng) {
            coordinate.lat = parseFloat(lat)
            coordinate.lng = parseFloat(lng)
        }

        async function initMap() {
            const {Map} = await google.maps.importLibrary("maps");

            map = new Map(document.getElementById("map"), {
                center: coordinate,
                zoom: 20,
                disableDefaultUI: true,
            });

            new google.maps.Marker({
                position: coordinate,
                map,
            });


        }


        initMap();
    </script>


    <x-modal name="technician-certification" focusable>
        <img src="{{ route('images', $shop->certificate_image) }}">
    </x-modal>
</x-app-layout>
