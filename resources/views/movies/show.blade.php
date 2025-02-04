<x-head-layout>
    <div class="flex flex-row w-2/3 mx-auto mt-10">
        <div>
            @include ('layouts.single-movie')
            @include ('layouts.ratethefilm')
            <p class="text-white">Rate the film</p>
            <p class="text-[#A693FF]">Director:</p>
            <p class="text-white">{{ $movie->director_name }}</p>
            <div class="flex flex-col">
                <a href="" class ="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">Leave a review</a>
                <a href="" class="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">See all reviews</a>
            </div>
        </div>
        <div class="flex flex-col w-2/3 mx-auto items-center">
            <iframe width="560" height="315" src="{{ $movie->trailer_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            {{-- Route to store into watchlist, right now its set to home because missing controller for watchlist --}}
            <a href="{{ route('home', $movie->id) }}" class="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">Add to watchlist</a>
            <p class="text-white">{{ $movie->description }}</p>
            {{-- @foreach ($reviews as $review) --}}
            <div class="bg-white w-full mx-auto items-center mt-4">
                <p class="text-center">PLACE FOR REVIEWS</p>
                <br><br><br>
                <a href="" class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold">Read more</a>
            </div>
            {{-- @endforeach --}}
            <div class="bg-white w-full mx-auto items-center mt-4">
                <p class="text-center">PLACE FOR REVIEWS</p>
                <br><br><br>
            </div>
            <div class="bg-white w-full mx-auto items-center mt-4">
                <p class="text-center">PLACE FOR REVIEWS</p>
                <br><br><br>
            </div>
        </div>
    </div>
</x-head-layout>