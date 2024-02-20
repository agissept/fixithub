<x-app-layout>
    <x-slot name="header">
        Ulasan Tempat Service
    </x-slot>
    @foreach($reviews as $review)
        <div class="rounded-[11px] bg-white mt-5 p-4">
            <div class="color-blue-primary font-bold">
                {{ $review->reviewer_name }}
            </div>
            <p>
                {{ $review->review }}
            </p>
            <div>
                <div class="mt-4">
                    <select class="star-rating" data-options='{"clearable":false, "tooltip":false}' required
                            name="rating" disabled>
                        <option value="5" @selected($review->rating === 5)>Excellent</option>
                        <option value="4" @selected($review->rating === 4)>Very Good</option>
                        <option value="3" @selected($review->rating === 3)>Average</option>
                        <option value="2" @selected($review->rating === 2)>Poor</option>
                        <option value="1" @selected($review->rating === 1)>Terrible</option>
                    </select>
                </div>
            </div>
        </div>
    @endforeach


    @vite('resources/js/review.js')

</x-app-layout>
