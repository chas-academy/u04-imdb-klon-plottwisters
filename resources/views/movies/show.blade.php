
<x-head-layout>
    <!-- Searchbar -->
    <div class="md:hidden flex justify-center items-center py-2">
        @include('components.searchbar')
    </div>
    <div class="lg:flex flex-row lg:w-3/4 mx-auto mt-10 h-2/3 pb-20">
        <div class="flex w-2/3 lg:w-auto mx-auto lg:block justify-around">
            @include ('layouts.single-movie')
            {{-- @include ('layouts.ratethefilm') --}}
            <div class="flex flex-col w-48 mx-auto gap-4 mt-4">
                {{-- @include ('layouts.ratethefilm') --}}
                @include('components.rating', ['movie'=>$movie])

                {{-- <p class="text-white">Rate the film</p> --}}
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

            </div>
        </div>

        <div class="flex flex-col w-2/3 mx-auto items-center gap-4">
            <iframe width="560" height="315" src="{{ $movie->trailer_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <div class="flex w-full justify-end gap-4 mt-4">
                @if (Auth::check() && Auth::user()->is_admin == '1')
                    <x-primary-a :href="route('movies.show', ['movie' => $movie->id, 'edit', 'movieId' => $movie->id])" :active="request()->routeIs('movies.update')">
                        {{ __('Edit movie') }}
                    </x-primary-a>

                    {{-- <div>
                    @if($errors->addmovie)
                    <p>{{$errors->addmovie->first()}}</p>
                   </div>
                    @endif --}}
                @endif
            </div>
            <p class="text-white">{{ $movie->description }}</p>
            @foreach ($reviews as $review)
            {{-- @dd($reviews); --}}
            <div class="bg-white w-full mx-auto items-center mt-4 rounded-md">
                <div class="flex justify-end m-2 gap-2">
                    @if (Auth::check() && (auth()->user()->is_admin || auth()->id() == $review->user_id))
                    <form action="{{ route('review.destroy', [$review->id, 'delete'])}}" method="POST">
                        @csrf
                        @method ('DELETE')
                        <button class="inline-flex items-center w-xl px-3 py-2 bg-[#F15C5F] border border-transparent rounded-xl font-semibold text-xs text-black uppercase mr-2" type="submit" 
                            onclick="return confirm('Are you sure you want to delete this review?')">
                            Delete
                        <button>
                    </form>
                    <x-primary-a :href="route('movies.show', ['movie' => $movie->id, 'reviewEdit', 'reviewId' => $review->id])" :active="request()->routeIs('movies.show', [$movie->id, 'reviewEdit', $review->id])">
                        {{ __('Edit') }}
                    </x-primary-a>
                    @endif
                </div>
                <p class="text-center font-bold mt-4">{{$review->title}}</p>
                <p class="text-center p-8">{{$review->description}}</p>
                <p class="text-sm text-gray-500 m-2">
                    Posted by <strong>{{ $review->user->name }}</strong>
                </p>
                {{-- <a href="" class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold">Read more</a> --}}
            </div>
            {{-- {{dd($reviews); }} --}}
            @endforeach

            @if (request()->has('create'))
                @include ('layouts.review_create')
            @endif

            @if (request()->has('reviewEdit'))
            {{-- {{dd(request()->query('reviewId'));}} --}}
                @foreach ($reviews as $review) 
                    @if ($review->id == request()->query('reviewId')) 
                        @break
                    @endif
                @endforeach
                @include ('layouts.review_create')
            @endif

            @if (request()->has('edit'))
                {{-- @foreach ($movies as $movie) 
                    @if ($movie->id == request()->query('movieId')) 
                        @break
                    @endif
                @endforeach --}}
                @include ('layouts.addmovie')
            @endif
            </div>
        </div>
    </div>

</x-head-layout>

