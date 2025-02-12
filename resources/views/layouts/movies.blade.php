<div class="flex flex-row flex-wrap w-2/3 mx-auto gap-8">
    @foreach ($movies as $movie)
        <div class="flex flex-col flex-1 items-center m-4 gap-2">
            <p class="text-white">{{ $movie['title'] }}</p>

            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">
                <img class="w-[100px] h-[150px]" src="{{ $movie->image_url}}" alt="">
            </a>
               {{-- Add function for rating --}}
            <div class="flex flex-row items-center">
                <img src="{{ Storage::url('images/star.png')}}" alt="">
                <p class="text-[#A693FF]">3.1</p>
            </div>
             {{-- Add Movie to Watchlist Section --}}
            @if (!Auth::check())
                <p class="inline-flex items-center w-xl px-3 py-2 bg-teal-700 border border-transparent rounded-xl font-semibold text-xs text-black uppercase w-[150px] text-center">Login to create a watchlist.</p>
            @endif
            @auth
            <div x-data="{ showWatchlistDropdown: false, noWatchlists: {{ Auth::user()->watchlists->isEmpty() ? 'true' : 'false' }} }">
                {{-- Check if user has watchlists --}}
                @if (Auth::user()->watchlists->isEmpty())
                    <p class="text-white mt-2 text-center">You have no watchlists. Create one to add movies!</p>
                @else
                    {{-- Add to Watchlist Button --}}
                    <button class="inline-flex items-center w-xl px-3 py-2 bg-teal-700 border border-transparent rounded-xl font-semibold text-xs text-black uppercase w-[150px]" 
                        @click="showWatchlistDropdown = !showWatchlistDropdown" 
                        >
                        Add to Watchlist
                    </button>
                    <div x-show="showWatchlistDropdown" x-transition class="mt-4 ">
                        <form action="{{ route('watchlists.addMovie') }}" method="POST" class="flex flex-col">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <label for="watchlist_id" class="block text-sm text-white">Choose a Watchlist:</label>
                            <select name="watchlist_id" id="watchlist_id" class="mt-1 mb-2 p-2 border rounded" required>
                                @foreach (Auth::user()->watchlists as $watchlist)
                                    <option value="{{ $watchlist->id }}">{{ $watchlist->watchlist_name }}</option>
                                @endforeach
                            </select>
                            <x-primary-button type="submit">Add to Watchlist</x-primary-button>
                        </form>
                    </div>
                @endif
            </div>
            @endauth
            
        
          {{-- @if (Auth::check() && Auth::user()->name == 'admin')
            <a class="text-white" href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="text-white btn btn-delete" type="submit" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
            </form>
        @endif--}}

        @include('components.rating', ['movie'=>$movie])

    </div>
    @endforeach
</div>
{{--
            <a class="text-white" href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button class="text-white" type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
        </form>
        @endif --}}

        {{-- @include('components.rating', ['movie'=>$movie])

    </div>
    @endforeach --}}
{{-- </div> --}}