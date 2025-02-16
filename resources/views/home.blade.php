<x-head-layout>
    {{-- @include ('layouts.navigation') --}}
    <!-- Searchbar -->
    <div class="md:hidden flex justify-center items-center py-2">
        @include('components.searchbar')
    </div>

    <div class="flex flex-1 items-start w-fit m-4 flex-col mx-auto">
        <h2 class="text-white font-bold text-3xl">Featured Movie</h2>

        @if(isset($featuredMovie) && $featuredMovie)
        <a href="{{ route('movies.show', $featuredMovie->id) }}">
            <img src="{{ $featuredMovie->image_url }}" alt="{{ $featuredMovie->title }}" class="w-96 h-auto rounded-lg shadow-lg">
        </a>
        @else
        <p class="text-white">No featured movie selected.</p>
        @endif

        <div class="flex w-full justify-end gap-4 mt-4">
            @if (Auth::check() && Auth::user()->is_admin)
            <form action="{{ route('admin.setfeatured') }}" method="GET">
                <label class="text-white mr-2">Set featured movie:</label>
                <select class="rounded-md" name="featured" onchange="this.form.submit()">
                    <option value="">All movies</option>
    
                    @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" {{ request('movie') == $movie->id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                    @endforeach
                </select>
            </form>
            {{-- <x-primary-a :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Edit Featured Movie') }}
            </x-primary-a> --}}
            <x-primary-a :href="route('home', 'addmovie')" :active="request()->routeIs('movies.create')">
                {{ __('Add Movie') }}
            </x-primary-a>
            @if (request()->has('addmovie'))
            @include ('layouts.addmovie')
            @endif

            @endif
        </div>
    </div>
        {{-- @include ('layouts.navigation') --}}

    </div>
    <div class="bg-[#F15C5F] items-center justify-center flex rounded-md w-2/3 mx-auto">
        @if($errors->addmovie)
        <p>{{$errors->addmovie->first()}}</p>
        @endif
    </div>
    <div class="w-2/3 mx-auto mb-8">
        <form action="{{ route('home') }}" method="GET">
            <select class="rounded-md" name="genre" onchange="this.form.submit()">
                <option value="">All Genres</option>

                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->genre_name }}
                </option>
                @endforeach
            </select>
        </form>
    </div>
    @include ('layouts.movies')
    <div class="pb-20">
        {{ $movies->links() }}
    </div>
</x-head-layout>

