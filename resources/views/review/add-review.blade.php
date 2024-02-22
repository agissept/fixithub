<x-app-layout>
    <x-slot name="header">
        Beri Ulasan
    </x-slot>
    <form method="post" class="rounded-[11px] bg-white">
        @csrf
        <img src="{{ route('images', $shop->banner_image) }}" class="rounded-t-[11px]">
        <div class="p-5">

            <h3 class="text-xl font-bold p-4 text-center color-blue-primary">{{ $shop->name }}</h3>
            <div class="block">
                <div class="flex justify-center">
                    <select class="star-rating" data-options='{"clearable":false, "tooltip":false}' required name="rating">
                        <option value="">Select a rating</option>
                        <option value="5">Excellent</option>
                        <option value="4">Very Good</option>
                        <option value="3">Average</option>
                        <option value="2">Poor</option>
                        <option value="1">Terrible</option>
                    </select>
                </div>

                <textarea placeholder="Masukkan ulasan kamu"
                          class="mt-1 block w-full border-gray rounded-[4px] resize-none h-[100px] mt-4" name="review"
                          required></textarea>

                <x-primary-button class="w-full mt-5 text-center justify-center">Kirim</x-primary-button>
            </div>
        </div>
    </form>


    @vite('resources/js/review.js')

</x-app-layout>
