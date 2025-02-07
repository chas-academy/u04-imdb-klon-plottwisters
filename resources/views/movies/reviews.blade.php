<x-head-layout>
    <div class="flex flex-row w-2/3 mx-auto mt-10">
        <div>          
            {{-- @include ('layouts.single-movie')
            @include ('layouts.ratethefilm') --}}
            <p class="text-white">Rate the film</p>
            <p class="text-[#A693FF]">Director:</p>
            {{-- <p class="text-white">{{ $movie->director_name }}</p> --}}
            <div class="flex flex-col">
                @if (Auth::check())
                <a href="{{ route('movies.show', [$movie->id, 'create'] )}}" name ="createReview" value="true"class ="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">Leave a review</a>
                @endif

                <a href="" class="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">Add to watchlist</a>

            </div>
        </div>
        <div class="flex flex-col w-2/3 mx-auto items-center">
            @foreach ($reviews as $review)
            <div class="bg-white w-full mx-auto items-center mt-4">
                <p class="text-center">{{$review->title}}</p>
                <br><br><br>
                <a href="" class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold">Read more</a>
            </div>
            @endforeach

            <div class="bg-white w-full mx-auto items-center mt-4">
                <p class="text-center">PLACE FOR REVIEWS</p>
                <br><br><br>
                <a href="" class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold">Read more</a>
            </div>
        </div>
</x-head-layout>