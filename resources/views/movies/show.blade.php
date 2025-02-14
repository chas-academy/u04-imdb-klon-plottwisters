
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
                        <div class="bg-white p-6 rounded-md shadow-md relative">
                            @if (Auth::check() && (auth()->user()->is_admin || auth()->id() == $review->user_id))
                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="absolute top-4 right-4">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this review?')">
                                        Delete
                                    </x-primary-button>
                                </form>
                            @endif
                            
                            <h3 class="font-bold text-lg">{{ $review->title }}</h3>
                            <p class="mt-2">{{ $review->description }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                            Posted by <strong>{{ $review->user->name }}</strong>
                        </p>
                        </div>
                @endforeach
                @if (request()->has('create'))
                @include ('layouts.review_create')
                @endif
            </div>
        </div>
    </div>

</x-head-layout>

