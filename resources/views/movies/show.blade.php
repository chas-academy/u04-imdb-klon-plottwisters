
<x-head-layout>
    <div class="flex flex-row w-2/3 mx-auto mt-10 h-2/3">
        <div>
            @include ('layouts.single-movie')
            @include ('layouts.ratethefilm')
            <div class="flex flex-col gap-4 mt-4">
                <p class="text-white">Rate the film</p>
                <p class="text-[#A693FF]">Director:</p>
                <p class="text-white">{{ $movie->director_name }}</p>
            
                <div class="flex flex-col">
                    @if (Auth::check())
                    <x-primary-a :href="route('movies.show', [$movie->id, 'create'] )" :active="request()->routeIs('movies.show', [$movie->id, 'create'] )">
                        {{ __('Leave a review') }}
                    </x-primary-a>
                    @endif
                    {{-- <a href="{{ route('reviews', $movie->id)}}" class="btn btn-info bg-[#20C8A6] w-40 text-center rounded-md font-bold">See all reviews</a> --}}
                </div>
                <div>
                    @if (request()->has('create'))
                    @include ('layouts.review_create')
                    @endif
                </div>
            </div>
        </div>
        <div class="flex flex-col w-2/3 mx-auto items-center gap-4">
            <iframe width="560" height="315" src="{{ $movie->trailer_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            {{-- Route to store into watchlist, right now its set to home because missing controller for watchlist --}}
            <x-primary-a :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Add to watchlist') }}
            </x-primary-a>
            <p class="text-white">{{ $movie->description }}</p>
            @foreach ($reviews as $review)
            <div class="bg-white w-full mx-auto items-center mt-4 rounded-md">
                <p class="text-center font-bold mt-4">{{$review->title}}</p>
                <p class="text-center p-8">{{$review->description}}</p>
                {{-- <a href="" class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold">Read more</a> --}}
            </div>
            @endforeach

        </div>
    </div>
</x-head-layout>

