
<x-head-layout>
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
                @if (Auth::check() && Auth::user()->name == 'admin')
                    <x-primary-a :href="route('movies.show', [$movie->id, 'edit'])" :active="request()->routeIs('movies.create')">
                        {{ __('Edit movie') }}
                    </x-primary-a>
                    @if (request()->has('edit'))
                    @include ('layouts.addmovie')
                    @endif
                    <div>
                    @if($errors->addmovie)
                    <p>{{$errors->addmovie->first()}}</p>
                   </div>
                    @endif
                @endif
            </div>
            <p class="text-white">{{ $movie->description }}</p>
            @foreach ($reviews as $review)
            <div class="bg-white w-full mx-auto items-center mt-4 rounded-md">
                @if(Auth::check() && $review->user_id == Auth::user()->id)
                <form action="{{ route('review.destroy', [$review->id, 'delete'])}}" method="POST">
                    @csrf
                    @method ('DELETE')
                    <button class="bg-[#F15C5F] text-center rounded-md font-bold pl-2 pr-2 mx-auto mt-4 " type="submit">Delete</button>
                </form>
                @endif
                <p class="text-center font-bold mt-4">{{$review->title}}</p>
                <p class="text-center p-8">{{$review->description}}</p>
                {{-- <a href="" class="btn btn-info bg-[#20C8A6] text-center rounded-md font-bold">Read more</a> --}}
            </div>
            @endforeach
            <div>
                @if (request()->has('create'))
                @include ('layouts.review_create')
                @endif
            </div>
        </div>
    </div>

</x-head-layout>

