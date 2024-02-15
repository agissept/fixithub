<section>
    <header>
        <h2 class="text-lg font-bold color-blue-primary">
            Informasi Toko
        </h2>
    </header>

    <form method="post" action="{{ route('shop.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div>
            <x-input-label for="store_name" :value="__('Nama Toko')"/>
            <x-text-input id="store_name" name="shop_name" type="text" class="mt-1 block w-full"
                          :value="old('store_name', $shop?->name)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('store_name')"/>
        </div>

        <div>
            <x-input-label for="phone-number" :value="__('Nomor Telepon')"/>
            <x-text-input id="phone-number" name="phone_number" type="text" class="mt-1 block w-full"
                          :value="old('phone_number', $shop?->phone_number)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')"/>
        </div>

        <div>
            <x-input-label for="description" :value="__('Deskripsi Toko')"/>
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                          :value="old('description', $shop?->description)" required/>
            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
        </div>

        <div>
            <x-input-label for="banner-image" :value="__('Banner Toko')"/>
            <x-text-input id="banner-image" name="banner_image" type="file" accept="image/*" class="mt-1 block w-full"
                          :value="old('banner_image', $shop?->banner_image)"/>
            <x-input-error class="mt-2" :messages="$errors->get('Banner Toko')"/>
        </div>

        <div>
            <x-input-label for="certificate-image" :value="__('Sertifikat Teknisi')"/>
            <x-text-input id="certificate-image" name="certificate_image" type="file" class="mt-1 block w-full"
                          :value="old('certificate_image', $shop?->certificate_image)"/>
            <x-input-error class="mt-2" :messages="$errors->get('Sertifikat Teknisi')"/>
        </div>

        <div>
            <x-input-label for="address" :value="__('Alamat Toko')"/>
            <textarea id="address" name="address" class="mt-1 block w-full border-gray rounded-[4px]"
                      required>{{ old('description', $shop?->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')"/>
        </div>


        <div>
            <x-input-label for="coordinate" :value="__('Koordinat Toko')"/>
            <div class="relative">
                <x-text-input
                    id="pac-input"
                    class="controls w-[90%] mx-auto mt-4 right-0"
                    type="text"
                    placeholder="Cari alamat"
                />
                <div id="map" class="h-[300px]">

                </div>
                <div id="marker"
                     class=" h-[10px] w-[10px] absolute m-auto top-0 left-0 right-0 bottom-0">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px"
                         height="25px" viewBox="-4 0 36 36" version="1.1">
                        <g id="Vivid.JS" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Vivid-Icons" transform="translate(-125.000000, -643.000000)">
                                <g id="Icons" transform="translate(37.000000, 169.000000)">
                                    <g id="map-marker" transform="translate(78.000000, 468.000000)">
                                        <g transform="translate(10.000000, 6.000000)">
                                            <path
                                                d="M14,0 C21.732,0 28,5.641 28,12.6 C28,23.963 14,36 14,36 C14,36 0,24.064 0,12.6 C0,5.641 6.268,0 14,0 Z"
                                                id="Shape" fill="#FF6E6E">

                                            </path>
                                            <circle id="Oval" fill="#0C0058" fill-rule="nonzero" cx="14" cy="14" r="7">

                                            </circle>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <x-text-input id="coordinate" name="coordinate" type="text" class="mt-1 block w-full"
                          :value="old('coordinate', $shop?->coordinate)" readonly/>
        </div>

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
                const {SearchBox} = await google.maps.importLibrary("places")

                map = new Map(document.getElementById("map"), {
                    center: coordinate,
                    zoom: 20,
                    disableDefaultUI: true,
                });

                // Create the search box and link it to the UI element.
                const input = document.getElementById("pac-input");
                const searchBox = new SearchBox(input);

                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                // Bias the SearchBox results towards current map's viewport.
                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                    document.querySelector('#coordinate').value = `${map.getCenter().lat()},${map.getCenter().lng()}`
                });


                searchBox.addListener("places_changed", () => {
                    let places = searchBox.getPlaces();

                    if (places.length === 0) {
                        return;
                    }

                    const place = places[0]

                    const bounds = new google.maps.LatLngBounds();

                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                    map.fitBounds(bounds);
                });
            }

            initMap();
        </script>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
